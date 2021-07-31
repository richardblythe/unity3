<?php

require_once Unity3::$vendor_autoload;

use Unity3_Vendor\Aws\TranscribeService\TranscribeServiceClient;
use Unity3_Vendor\Aws\S3\S3Client;
use Unity3_Vendor\Aws\Exception\AwsException;
use Unity3_Vendor\Aws\S3\ObjectUploader;
use Unity3_Vendor\Aws\S3\MultipartUploader;
use Unity3_Vendor\Aws\Exception\MultipartUploadException;

if( class_exists('ACF') ) :

class Unity3_Audio_Transcription extends Unity3_Module {

    private $post_data;
    private $cron_hook = 'unity3_audio_transcription_check_status';

    const PM_JOB        = 'transcription_job';
    const PM_STATUS     = 'transcription_status';
    const PM_ERROR      = 'transcription_error';
    const PM_CONTENT    = 'transcription_content';
    const PM_VISIBILITY = 'transcription_visibility';

    const STATUS_UPLOADING = 'UNITY3_UPLOADING';
    const STATUS_QUEUED = 'QUEUED';
    const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const STATUS_COMPLETED = 'COMPLETED';
    const STATUS_FAILED = 'FAILED';

	public function __construct( ) {
		parent::__construct('unity3_audio_transcription', 'Audio Transcription', 'Transcribes audio from attached post media');
	}

	public function Init() {
		parent::Init();

        //$key = $this->field_name('trigger_on_post_types');
        $key = $this->field_name( 'post_types__post_type' );
        add_filter("acf/load_field/key={$key}", function ( $field ) {
            foreach ( get_post_types( '', 'names' ) as $post_type ) {
                $field['choices'][$post_type] = $post_type;
            }

            // return the field
            return $field;
        });

        //init transcription hooks
        if ( is_admin() ) {
            add_action( 'restrict_manage_posts', array(&$this, 'restrict_manage_posts' ) );
            add_action( 'pre_get_posts', array( &$this, 'restrict_manage_posts_filter') );
        } else {
            //Front End
            add_filter( 'the_content', 'unity3_audio_transcription_post_append', 999 );
        }





        add_filter('acf/prepare_field', array( &$this,'acf_prepare_field') );
        add_action( "added_post_meta", array(&$this, 'post_meta_changed'), 100, 4 );
        add_action( "updated_post_meta", array(&$this, 'post_meta_changed'), 100, 4 );

        //**********************************************
        //Cron
        add_filter( 'cron_schedules', function( $schedules ) {
            $schedules['every_minute'] = array(
                'interval' => MINUTE_IN_SECONDS,
                'display'  => esc_html__( 'Every Minute' ), );
            return $schedules;
        });

        add_action( $this->cron_hook, array($this, 'cron') );
        if ( $this->get_option('force_cron') ) {
            update_option( $this->option_name('force_cron'), false );
            $this->start_cron();
        }
        //*************************************************


	}

    public function restrict_manage_posts(){
        $screen = get_current_screen();
        if( $screen->parent_base == 'edit' && array_key_exists($screen->post_type, $this->get_post_data()) ){
            $selected_now = '';
            if ( isset( $_GET['transcription_filter'] ) ) {
                $selected_now = esc_attr( $_GET['transcription_filter'] );
            }
            echo
            '<select name="transcription_filter" id="transcription_filter">' .
                '<option value="" >' . __( 'All Transcription', 'unity3' ) . '</option>' .
                '<option value="nothing" ' . selected( $selected_now, 'nothing', false ) .
                '>' . __( 'No Transcription', 'unity3' ) . '</option>' .
                '<option value="private" ' . selected( $selected_now, 'private', false ) .
                '>' . __( 'Private Transcription', 'unity3' ) . '</option>' .
                '<option value="public" ' . selected( $selected_now, 'public', false ) .
                '>' . __( 'Public Transcription', 'unity3' ) . '</option>' .
            '</select>';
        }
    }

    function restrict_manage_posts_filter( $query ){

        if( isset( $_GET['transcription_filter'] ) ){
            $filter = sanitize_text_field( $_GET['transcription_filter'] );
            if( !empty($filter) ){

                if ( 'nothing' === $filter ) {
                    $query->set( 'meta_query', [
                        'relation' => 'OR',
                        [
                            'key'     => self::PM_CONTENT,
                            'compare' => 'NOT EXISTS',
                        ],
                        [
                            'key'     => self::PM_CONTENT,
                            'value'   => ['', ' ', '  '], //look for empty content
                            'compare' => 'IN',
                        ],
                    ]);
                } else {
                    $query->query_vars['meta_key']     = self::PM_VISIBILITY;
                    $query->query_vars['meta_value']   = $filter;
                    $query->query_vars['meta_compare'] = '=';
                }
            }
        }

    }


    function api_ready() {
	    return (
	        defined('UNITY3_AWS_ACCESS_KEY') &&
            defined('UNITY3_AWS_SECRET_ACCESS_KEY') &&
            $this->get_option('region')  &&
            $this->get_option( 'bucket' ) &&
            $this->get_option( 'folder' )
        );
    }

    function field_name( $field_name ) {
        return $this->sanitized_id . '_' . $field_name;
    }

    function option_name( $name ) {
	    return "options_{$this->field_name($name)}";
    }

    public function get_option( $name ) {
        return get_option( "options_{$this->field_name($name)}" );
    }

    /**
     * @param $post_type (Optional)
     * @return array|string|null If $post_type is specified, returns the specific post type transcription data
     */
    function get_post_data( $post_type = null ) {

	    if (!$this->post_data) {
            $this->post_data = [];

            $option_post_types = $this->field_name('post_types');
	        if ( $row_count = $this->get_option( 'post_types' ) ) {
	            for ( $i = 0; $i < $row_count; $i++ ) {
	                $p_type = $this->get_option( "post_types_{$i}_post_type" );

	                $meta_field = $this->get_option( "post_types_{$i}_audio_meta_field" );
                    $title = $this->get_option( "post_types_{$i}_title" );

	                $this->post_data[ $p_type ] = [
	                    'title'      => $title,
	                    'meta_field' => $meta_field
                    ];
                }
            }
        }
	    return !$post_type ? $this->post_data : ( isset( $this->post_data[$post_type] ) ? $this->post_data[$post_type] : null );
    }

    function Activate()
    {
        parent::Activate();
        $this->start_cron();
    }

    function Deactivate()
    {
        parent::Deactivate();
        $this->stop_cron();
    }

    public function start_cron() {
        if ( $this->api_ready() && !wp_next_scheduled( $this->cron_hook ) ) {
            wp_schedule_event( time(), 'every_minute', $this->cron_hook );
        }
    }

    public function stop_cron() {
        $timestamp = wp_next_scheduled( $this->cron_hook );
        wp_unschedule_event( $timestamp, $this->cron_hook );
    }

    public function cron() {

        if ( !$this->api_ready() ) {
            $this->stop_cron();
            return null;
        }

	    $post_data = $this->get_post_data();
	    $audio_meta_query = array('relation' => 'OR');
	    foreach ( $post_data as $post_type => $data ) {
	        $audio_meta_query[] = array(
                'key' => $data['meta_field'],
                'compare' => 'EXISTS',
            );
        }

	    $posts = get_posts([
            'post_type' => array_keys( $post_data ),
            'numberposts' => 5,// limit the results to prevent a timeout
            'meta_query' => array(
                'relation' => 'AND',
                $audio_meta_query, //an audio meta value exists
                //AND
                array(
                    'relation' => 'OR',
                    array(
                        'key' => self::PM_JOB,
                        'compare' => 'NOT EXISTS',
                    ),
                    //OR
                    array(
                        'key' => self::PM_STATUS,
                        'value' => array( self::STATUS_QUEUED, self::STATUS_IN_PROGRESS ),
                        'compare' => 'IN',
                    )
                )
            ),
        ]);

	    if ( !count($posts) ) {
            $this->stop_cron();
        } else {
            foreach ( $posts as $post ) {
                if ( !$this->check_status( $post->ID ) ) {
                    //if a transcription job does not exist, try to start one
                    $this->transcribe_start( $post->ID );
                }
            }
        }
    }

    function post_meta_changed( $meta_id, $post_id, $meta_key, $_meta_value ) {

	    $post_type = get_post_type( $post_id );
	    $post_data = $this->get_post_data();
	    $transcription_audio_meta = isset( $post_data[$post_type] ) ? $post_data[$post_type]['meta_field'] : null;

	    if ( $transcription_audio_meta === $meta_key ) {
            //reset any existing data
            delete_post_meta( $post_id, self::PM_JOB, '', true );
            delete_post_meta( $post_id, self::PM_STATUS, '', true );
            delete_post_meta( $post_id, self::PM_ERROR, '', true  );
            delete_post_meta( $post_id, self::PM_CONTENT, '', true  );
            delete_post_meta( $post_id, self::PM_VISIBILITY, '', true  );

            $this->start_cron();
        }

    }

    function get_audio_url( $post_id ) {
	    $post_type = get_post_type( $post_id );
        $post_data = $this->get_post_data();
        $audio_meta_field = isset( $post_data[$post_type] ) ? $post_data[$post_type]['meta_field'] : null;

        $meta_value = $audio_meta_field ? get_post_meta( $post_id, $audio_meta_field, true ) : null;
        $url = null;

        if ( empty( $meta_value ) ) {
            //can't do anything with nothing
        } elseif ( is_int( $meta_value ) ) {

            //get from an attachment
            $url = wp_get_attachment_url( $meta_value );

        } elseif ( is_string( $meta_value ) ) {

            $Pattern = '/(?:((?:https|http):\/\/)|(?:\/)).+(?:.mp3|ogg)/m';
            $Matches = null;
            $result = preg_match( $Pattern, $meta_value,$Matches );

            $url = count( $Matches ) ? $Matches[0] : null;

        }

        return apply_filters( 'unity3/audio_transcription/url', $url, $post_id, $meta_value );
    }

    function transcribe_start( $post_id ) {

	    if ( !$this->api_ready() )
	        return null;


        $status = get_post_meta(  $post_id,self::PM_STATUS, true );
        if ( in_array($status, [ self::STATUS_COMPLETED, self::STATUS_FAILED, self::STATUS_UPLOADING ]) )
            return $status;

        $region = $s3_folder = $this->get_option('region');;
        $bucket = $s3_folder = $this->get_option('bucket');;
        $folder = $this->get_option('folder');
        $access_key = UNITY3_AWS_ACCESS_KEY;
        $secret_access_key = UNITY3_AWS_SECRET_ACCESS_KEY;


        $status = false;
        $error_msg = '';
        // upload file on S3 Bucket
        try {

            if ( !$url = $this->get_audio_url( $post_id ) ) {
                throw new Exception( 'No valid transcription audio url specified.');
            }         
            
            // Instantiate an Amazon S3 client.
            $s3 = new S3Client([
                'version' => 'latest',
                'region'  => $region,
                'credentials' => [
                    'key'    => $access_key,
                    'secret' => $secret_access_key
                ]
            ]);

//            // Gives us access to the download_url() and wp_handle_sideload() functions.
//            require_once ABSPATH . 'wp-admin/includes/file.php';
//            // Download file to temp dir.
//            $temp_file = download_url( $url, 20 );
//
//            if ( is_wp_error( $temp_file ) ) {
//                throw new Exception( $temp_file->get_error_message() );
//            }
            

//            $result = $s3->putObject([
//                'Bucket' => $bucket,
//                'Key'    => "{$folder}/" . basename( $url ),
//                'Body'   => fopen($temp_file, 'r'),
//            ]);

            // Using stream instead of file path
            $source = fopen($url, 'rb');
            $file_key = "{$folder}/" . basename( $url );

            $uploader = new ObjectUploader(
                $s3,
                $bucket,
                $file_key,
                $source
            );

            $s3_audio_url = null;
            do {
                try {

                    $status = self::STATUS_UPLOADING;
                    //update status now because upload() is a blocking function
                    update_post_meta( $post_id, self::PM_STATUS, $status );

                    $result = $uploader->upload();
                    if ($result["@metadata"]["statusCode"] == '200') {
                        //print('<p>File successfully uploaded to ' . $result["ObjectURL"] . '.</p>');
                        $s3_audio_url = str_replace( '%2F', '/', $result["ObjectURL"] );
                    }
                    //print($result);
                } catch (MultipartUploadException $e) {
                    rewind($source);
                    $uploader = new MultipartUploader($s3, $source, [
                        'state' => $e->getState(),
                    ]);
                }
            } while (!isset($result));


            if ( !$s3_audio_url ) {
                throw new Exception('Could not upload audio to S3');
            }

            // Create Amazon Transcribe Client
            $awsTranscribeClient = new TranscribeServiceClient([
                'region' => $region,
                'version' => 'latest',
                'credentials' => [
                    'key'    => $access_key,
                    'secret' => $secret_access_key
                ]
            ]);

            // Start a Transcription Job
            $job_id = uniqid( basename( $s3_audio_url ) . '-');
            $transcriptionResult = $awsTranscribeClient->startTranscriptionJob([
                'LanguageCode' => 'en-US',
                'Media' => [
                    'MediaFileUri' => $s3_audio_url,
                ],
                'TranscriptionJobName' => $job_id,
            ]);


            update_post_meta( $post_id, self::PM_JOB, $job_id );
            $status = self::STATUS_QUEUED;

        }  catch (Exception $e) {

            $status = self::STATUS_FAILED;
            $error_msg = $e->getMessage();
            update_post_meta( $post_id, self::PM_ERROR, $e->getMessage() );
        }

        update_post_meta( $post_id, self::PM_STATUS, $status );
        return $status !== self::STATUS_FAILED;
    }

    function check_status( $post_id ) {

        if ( !$this->api_ready() )
            return null;

        if  ( !$job_id = get_post_meta(  $post_id,self::PM_JOB, true ) ) {
            return null;
        }

        $status = get_post_meta(  $post_id,self::PM_STATUS, true );
        if ( in_array($status, [ self::STATUS_COMPLETED, self::STATUS_FAILED ]) )
            return $status;

        try {

            // Create Amazon Transcribe Client
            $awsTranscribeClient = new TranscribeServiceClient([
                'region' => $this->get_option('region'),
                'version' => 'latest',
                'credentials' => [
                    'key'    => UNITY3_AWS_ACCESS_KEY,
                    'secret' => UNITY3_AWS_SECRET_ACCESS_KEY
                ]
            ]);

            $transcriptionJob = $awsTranscribeClient->getTranscriptionJob([
                'TranscriptionJobName' => $job_id
            ]);

            $status = $transcriptionJob->get('TranscriptionJob')['TranscriptionJobStatus'];

            if ($status != self::STATUS_COMPLETED) {
                update_post_meta( $post_id, self::PM_STATUS,  $status);
                return $status;
            }

            $url = $transcriptionJob->get('TranscriptionJob')['Transcript']['TranscriptFileUri'];
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $data = curl_exec($curl);
            $error_msg = curl_errno($curl) ? curl_error($curl) : null;
            curl_close($curl);


            if ( $error_msg ) {
                $status = self::STATUS_FAILED;
                update_post_meta( $post_id, self::PM_STATUS, $status );
                update_post_meta( $post_id, self::PM_ERROR, $error_msg);
                update_post_meta( $post_id, self::PM_CONTENT, '');
            } else {
                $arr_data = json_decode($data);
                update_post_meta( $post_id, self::PM_CONTENT,  $arr_data->results->transcripts[0]->transcript);
                update_post_meta( $post_id, self::PM_STATUS, $status );
                update_post_meta( $post_id, self::PM_ERROR, '');
                update_post_meta( $post_id, self::PM_VISIBILITY, 'private');
            }



        } catch (Exception $e) {
            update_post_meta( $post_id, self::PM_STATUS, self::STATUS_FAILED );
            update_post_meta( $post_id, self::PM_ERROR, $e->getMessage() );
        }

        return $status;
    }

    protected function acfGroups() {
        $groups = parent::acfGroups();
        $post_types = array_keys( $this->get_post_data() );
        if ( count($post_types) ) {

            $locations = array();
            foreach ( $post_types as $post_type ) {
                $locations[] = array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => $post_type,
                    )
                );
            }

            $groups[ $this->sanitized_id . '_post_edit_group' ] = array(
                'title' => 'Audio Transcription',
                'fields' => array(
                    array(
                        'key' => $this->field_name('post_edit_visibility'),
                        'label' => 'Transcription Visibility',
                        'name' => self::PM_VISIBILITY,
                        'type' => 'select',
                        'instructions' => 'Visibility should only be set to Public when you want the transcription to be visible on the front of the website.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'private' => 'Private',
                            'public' => 'Public',
                        ),
                        'default_value' => false,
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'return_format' => 'value',
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                    array(
                        'key' => $this->field_name('post_edit_content'),
                        'label' => 'Transcription Content',
                        'name' => self::PM_CONTENT,
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'basic',
                        'media_upload' => 0,
                        'delay' => 0,
                    ),
                    array(
                        'key' => $this->field_name('post_edit_status_message' ),
                        'label' => '',
                        'name' => '',
                        'type' => 'message',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => 'Unity 3 Software',
                        'new_lines' => 'wpautop',
                        'esc_html' => 0,
                    )
                ),
                'location' => $locations,
                'style' => 'seamless',
                'menu_order' => 0,
                'position' => 'normal',
            );
        }

        return $groups;
    }

    public function acf_prepare_field( $field ) {

	    global $post;
	    if ( !$post )
	        return $field;

        $status = get_post_meta( $post->ID, self::PM_STATUS, true );


        if ( $this->field_name('post_edit_status_message' ) === $field['key'] ) {

            if ( self::STATUS_COMPLETED === $status ) {
                return false; //dont need this when transcription is complete
            } elseif( self::STATUS_FAILED === $status ) {
                $field['message'] = 'Transcription failed. Please re-add the audio and try again';
            } elseif ( self::STATUS_UPLOADING === $status || get_post_meta( $post->ID, self::PM_JOB, true ) ) {
                //has a job going
                $field['message'] =
                    '<span class="spinner" style="float: left;visibility: visible;display: block;margin-top: 10px;"></span>'.
                    'Transcription in progress.  To check status: <button class="button" onClick="window.location.href=window.location.href">Reload Page</button>';
            } else {
                $field['message'] = apply_filters('unity3/audio/transcription/no_job_msg',
                    '<h3>No transcription job exists</h3>' .
                    '<ol>' .
                        '<li>Please specify a valid mp3 audio file</li>' .
                        '<li>Save/Update the post</li>' .
                        '<li><button class="button" onClick="window.location.href=window.location.href">Reload Page</button></li>' .
                     '</ol>' ,

                    $post
                );
            }

        } elseif ( $this->field_name('post_edit_visibility') === $field['key'] ||
                   $this->field_name('post_edit_content') === $field['key'] ) {

            if ( self::STATUS_COMPLETED !== $status ) {
                return false;
            }

        }

        return $field;
    }


    protected function getSettingsFields(){

	    $fields = [];

	    if ( !defined('UNITY3_AWS_ACCESS_KEY') || !defined('UNITY3_AWS_SECRET_ACCESS_KEY') ) {
	        $fields = array(
                array(
                    'key' => $this->field_name('uninitialized-msg' ),
                    'label' => '',
                    'name' => '',
                    'type' => 'message',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => 'Core AWS information needs to be specified in wp-config.php. 
                            Example:
                            define( \'UNITY3_AWS_ACCESS_KEY\', \'******************\' );
                            define( \'UNITY3_AWS_SECRET_ACCESS_KEY\', \'******************\' );',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                )
            );
        } else {
	        $fields = array(
                array(
                'key' => $this->field_name('region' ),
                'label' => 'Region',
                'name' => $this->field_name('region' ),
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'us-east-1' => 'US East (N. Virginia)',
                    'us-east-2' => 'US East (Ohio)',
                    'us-west-1' => 'US West (N. California)',
                    'us-west-2' => 'US West (Oregon)',
                    'af-south-1' => 'Africa (Cape Town)',
                    'ap-east-1' => 'Asia Pacific (Hong Kong)',
                    'ap-south-1' => 'Asia Pacific (Mumbai)',
                    'ap-northeast-3' => 'Asia Pacific (Osaka-Local)',
                    'ap-northeast-2' => 'Asia Pacific (Seoul)',
                ),
                'default_value' => 'us-east-1',
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
                array(
                    'label' => 'Bucket Name',
                    'key' => $this->field_name('bucket' ),
                    'name' => $this->field_name('bucket' ),
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'label' => 'Transcription Folder',
                    'key' => $this->field_name('folder' ),
                    'name' => $this->field_name('folder' ),
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'unity3-transcribe',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'label' => 'Rescan Posts',
                    'key' => $this->field_name('force_cron' ),
                    'name' => $this->field_name('force_cron' ),
                    'type' => 'true_false',
                    'instructions' => 'Forces a rescan of the post types below',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'default_value' => 0,
                    'ui' => 1,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ),
                array(
                    'key' => $this->field_name('post_types'),
                    'label' => 'Post Types',
                    'name' => $this->field_name( 'post_types' ),
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'collapsed' => $this->field_name( 'post_types__post_type' ),
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'row',
                    'button_label' => 'Add Post Type',
                    'sub_fields' => array(
                        array(
                            'key' => $this->field_name( 'post_types__post_type' ),
                            'label' => 'Post Type',
                            'name' => 'post_type',
                            'type' => 'select',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            //'choices' => [],  -- will be loaded at run time
                            'default_value' => false,
                            'allow_null' => 1,
                            'multiple' => 0,
                            'ui' => 1,
                            'ajax' => 0,
                            'return_format' => 'value',
                            'placeholder' => '',
                        ),
                        array(
                            'key' => $this->field_name( 'post_types__audio_meta_field' ),
                            'label' => 'Meta Field',
                            'name' => 'audio_meta_field',
                            'type' => 'text',
                            'instructions' => 'The post meta field that contains the transcription audio. (Url, Attachment ID)',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => $this->field_name( 'post_types__title' ),
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Is used on front (Speaker Transcripts, Episode Transcripts, etc)',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                    ),
                ),
            );
        }


	    return $fields;
    }

}

////*************************
////       Register
////*************************

unity3_modules()->Register( new Unity3_Audio_Transcription() );

//public functions

function unity3_audio_transcription_post_append( $content ){

    $post = get_post();
    $module = unity3_modules()->Get( 'unity3_audio_transcription' );
    $data = ( $post && $module) ? $module->get_post_data( $post->post_type ) : null;

    if( $data && is_single() && is_main_query() ) {

        ob_start();
        unity3_audio_transcription_post_output( $post );
        $transcription_html = ob_get_clean();

        $content .= $transcription_html;
    }
    return $content;
}

function unity3_audio_transcription_post_output( $post ) {

    $post = get_post( $post );
    $module = unity3_modules()->Get( 'unity3_audio_transcription' );
    $data = ( $post && $module) ? $module->get_post_data( $post->post_type ) : null;
    $visibility = $data ? get_post_meta( $post->ID, Unity3_Audio_Transcription::PM_VISIBILITY, true ) : null;

    if ( !$post || !$data ) {
        return;
    }

    $title = !empty( $data['title'] ) ? $data['title'] : 'Transcription';
    $content = '';

    if ( 'public' === $visibility ) {
        $content = get_post_meta( $post->ID, Unity3_Audio_Transcription::PM_CONTENT, true );
    }

    if ( empty( $content )) {
        $content = 'No transcription exists at this time';
    }

    ?>

    <div class="unity3-audio-transcription">
        <div class="tab">
            <input type="checkbox" class="tab-toggle" id="transcription-<?php echo $post->ID; ?>">
            <label class="tab-label" for="transcription-<?php echo $post->ID; ?>"><?php echo $title ?></label>
            <div class="tab-content">
                <?php the_field( Unity3_Audio_Transcription::PM_CONTENT, false, false ); ?>
            </div>
        </div>
    </div>

    <?php
}

endif;


