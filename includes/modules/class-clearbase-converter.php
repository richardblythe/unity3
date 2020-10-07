<?php
//
class Unity3_Clearbase_Converter extends Unity3_Module {


	public function __construct( ) {
        parent::__construct('unity3_clearbase_converter', 'Clearbase Converter', 'Converts Clearbase object into the Unity3 version 2 system.');

        // Check function exists.
        if( !function_exists('acf_add_options_page') )
            return;
    
        add_filter('acf/update_value/name=clearbase_folder_id', array( &$this, 'run_converter' ), 10, 3);
    }

    protected function getSettingsMenu() {
        return array(
            'page_title'    => __('Clearbase Converter'),
            'menu_title'    => __('Clearbase Converter'),
        );
    }

    protected function getSettingsFields(){
        return array(
            array(
                'key' => 'field_5d7fbd4484d00',
                'label' => 'Folder ID',
                'name' => 'clearbase_folder_id',
                'type' => 'post_object',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'clearbase_folder',
                ),
                'taxonomy' => '',
                'allow_null' => 0,
                'multiple' => 0,
                'return_format' => 'object',
                'ui' => 1,
            ),
            array(
                'key' => 'field_5d7fddacb98a3',
                'label' => 'Convert To',
                'name' => 'convert_to',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'unity3_gallery' => 'Unity3 Galleries',
                    'unity3_slide' => 'Unity3 Slides',
                ),
                'default_value' => array(
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5d810094aaee8',
                'label' => 'Clear Conversions',
                'name' => 'clear_conversions',
                'type' => 'relationship',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'unity3_gallery',
                    1 => 'unity3_slide',
                ),
                'taxonomy' => '',
                'filters' => array(
                    0 => 'search',
                    1 => 'post_type',
                    2 => 'taxonomy',
                ),
                'elements' => '',
                'min' => '',
                'max' => '',
                'return_format' => 'object',
            ),
        );
    }


    function run_converter( $folder_id, $post_id, $field  ) {
        
        $folder = clearbase_load_folder($folder_id);
        if (!$folder) {
            return $folder_id;
        }
        
        //Clear previous conversions
        if (is_array($_REQUEST['acf']['field_5d810094aaee8'])) {
            foreach($_REQUEST['acf']['field_5d810094aaee8'] as $clear_post_id) {
                wp_delete_post($clear_post_id , true);
            }
        }


        //get the desired conversion post type...
        $post_type = $_REQUEST['acf']['field_5d7fddacb98a3'];
        if (!in_array($post_type, array( 'unity3_gallery', 'unity3_slide' )) ) {
            die('Post type: ' . $post_type . ' is not supported for conversion!');
        }

        if ( !$module = unity3_modules()->Get($post_type) ) {
            die('Module does not exist: ' . $post_type);
        }

        $child_folder_ids = clearbase_get_children( $folder->ID, true );

        $taxonomy = $module->GetTaxonomy();
        
        if ( !$term = get_term_by('name', $folder->post_title, $taxonomy) ) {
            $result = wp_insert_term( $folder->post_title, $taxonomy );
            if ($result instanceof WP_Error) {
                die( "Problem creating term: {$folder->post_title}. Error message: {$result->get_error_message()}" );
            }

            $term = get_term( $result['term_id'], $taxonomy );
        }

        if ( 'unity3_gallery' == $post_type ) {

            if (!is_array($child_folder_ids))
                $child_folder_ids = array();

            foreach ($child_folder_ids as $id) {
                
                $f = clearbase_load_folder( $id );

                $attachments = clearbase_get_attachments('', $f);
                $ids = $this->get_attachment_ids( $attachments );

                $inserted_post_id = wp_insert_post( array(
                    'post_type' => $post_type,
                    'post_title' => $f->post_title,
                    'post_status' => 'publish',
                    'menu_order' => $f->menu_order,
                    'meta_input' => array(
                        'clearbase_conversion' => 1
                    ),
                    'tax_input' => array(   
                        $taxonomy => array(
                            $term->term_id
                        )
                    )
                ));

                //add attachment references to the ACF Gallery
                update_post_meta($inserted_post_id, Unity3_Galleries::IMAGES_META_FIELD,  $ids );

            }

        } else if ('unity3_slide' == $post_type) {
            
            $attachments = clearbase_get_attachments('', $folder);

            foreach ($attachments as $a) {
                $inserted_post_id = wp_insert_post( array(
                    'post_type' => $post_type,
                    'post_status' => 'publish',
                    'post_title' => $a->post_title,
                    'meta_input' => array(
                        'clearbase_conversion' => 1
                    ),
                    'tax_input' => array(   
                        $taxonomy => array(
                            $term->term_id
                        )
                    )
                ));

                //attach IMAGE to ACF field
                update_post_meta( $inserted_post_id, 'image', $a->ID );

                //attach CAPTION to ACF field
                update_field( $inserted_post_id, 'caption', $a->post_excerpt );
            }
        }

        // return
        return $folder_id;
        
    }


    function get_attachment_ids( $attachments ) {
        $ids = array();
        foreach( $attachments as $a) {
            $ids[] = $a->ID;
        }

        return $ids;
    }

}

////*************************
////       Register
////*************************
unity3_modules()->Register(new Unity3_Clearbase_Converter());