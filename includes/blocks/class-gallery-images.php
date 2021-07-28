<?php
namespace Unity3\Blocks;

class Gallery_Images {

    public function init() {
        // Check function exists.
        if( function_exists('acf_register_block_type') ) {

            // register a testimonial block.
            acf_register_block_type(array(
                'name'              => 'unity3-gallery-images',
                'title'             => __('Gallery Images'),
                'description'       => __('Selects images uploaded to Unity3 Galleries'),
                'render_callback'   => array(&$this, 'render'),
                'category'          => 'layout',
                'mode'              => 'edit',
                'icon'              => 'edit',
                'keywords'          => array( 'gallery', 'gallery images' ),
            ));
        }

        if( function_exists('acf_add_local_field_group') ) {
            $this->register_acf_fields();
        }

//        add_action('acf/save_post', array($this, 'save_post'), 50);
    }

//    public function save_post( $post_id ) {
//        if ( $file_id = get_field( 'unity3_aws_transcribe_file' ) ) {
//            if ( !$transcription = get_post_meta( $file_id, 'unity3_aws_transcription' ) ) {
//                unity3_aws_transcribe( $file_id );
//            }
//        }
//    }

    public function render( $block, $content, $is_preview, $post_id ) {

        echo 'Gallery Images';

//        if ( !unity3_aws_transcribe_defined() ) {
//
//            echo '<p>' . __('AWS Transcribe has not been set up.'). '</p>';
//
//        } else if ( $file_id = get_field( 'unity3_aws_transcribe_file' ) ) {
//
//            if ( $transcription = get_post_meta(  $file_id, 'unity3_aws_transcription' ) ) {
//                echo '<p>' . $transcription . '</p>';
//            }
//
//        } elseif ( is_admin() && $is_preview ) {
//            ?>
<!---->
<!--            <h2>--><?php //_e('Switch to edit mode to upload an audio file for transcription.'); ?><!--</h2>-->
<!---->
<!--        --><?php
//        }

    }

    public function register_acf_fields() {

        return;

        $fields = unity3_aws_transcribe_defined() ? array(
            'key' => 'unity3_aws_transcribe_file',
            'label' => 'File To Transcribe',
            'name' => 'unity3_aws_transcribe_file',
            'type' => 'file',
            'instructions' => 'Choose/Upload and audio file to be transcribed',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'id',
            'library' => 'all',
            'min_size' => '',
            'max_size' => '',
            'mime_types' => 'mp3',
        ) : array(
            'key' => 'unity3_aws_transcribe_file_forbid',
            'label' => 'Transcribe',
            'name' => 'unity3_aws_transcribe_file',
            'type' => 'message',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => '<p>' . __('You must define AWS required constants in wp-config') . '</p>',
            'new_lines' => 'wpautop',
            'esc_html' => 0,
        );

        //register Block Fields
        acf_add_local_field_group( array(
            'key'                   => 'unity3_aws_transcribe_group',
            'title'                 => 'AWS Transcription',
            'fields'                => array( $fields ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/unity3-gallery-images',
                    ),
                ),
            ),
            'menu_order'            => 0,
            'position'              => 'normal',
            'style'                 => 'default',
            'label_placement'       => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen'        => '',
            'active'                => true,
            'description'           => '',
        ) );

    }

}

//init the class
add_action('unity3/modules/init', function (){
    $gallery_images = new Gallery_Images();
    $gallery_images->init();
});
