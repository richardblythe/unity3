<?php
namespace Unity3\Blocks;

class Author_Signature {

    public function init() {
        // Check function exists.
        if( function_exists('acf_register_block_type') ) {

            // register a testimonial block.
            acf_register_block_type(array(
                'name'              => 'unity3-author-signature',
                'title'             => __('Author Signature'),
                'description'       => __('Displays the author\'s signature. Set in the User Profile page'),
                'render_callback'   => array(&$this, 'render'),
                'category'          => 'layout',
                'mode'              => 'preview',
                'icon'              => 'edit',
                'keywords'          => array( 'author', 'author signature', 'signature'),
            ));

            add_image_size( 'author-signature', 600, 300);
            add_image_size( 'author-signature-medium', 400, 200 );
            add_image_size( 'author-signature-small', 200, 100 );
        }

        if( function_exists('acf_add_local_field_group') ) {
            $this->register_acf_fields();
        }
    }

    public function render( $block, $content, $is_preview, $post_id ) {

        if ( $author_id = get_post_field( 'post_author', $post_id ) ) {

            // Create class attribute allowing for custom "className" and "align" values.
            $className = 'author-signature';
            if( !empty($block['className']) ) {
                $className .= ' ' . $block['className'];
            }
            if( !empty($block['align']) ) {
                $className .= ' align' . $block['align'];
            }

            $closing_text = get_user_meta( $author_id, 'signature_closing_text', true );
            $signature = get_user_meta( $author_id, 'signature_image', true );

            if ( !empty($signature) ) {
                  $post_thumbnail_srcset = wp_get_attachment_image_srcset( $signature, 'author-signature-medium' );
                  $image_size = get_field('signature_size');
            ?>

            <div>
                <span><?php echo esc_html($closing_text); ?></span>
                <img
                  src="<?php echo esc_url( wp_get_attachment_image_url( $signature, $image_size ) ); ?>"
                  class="<?php echo esc_attr($className); ?>"
                  alt="<?php _e('Author\'s signature'); ?>"
                >
            </div>

            <?php
            } elseif ( is_admin() ) {
                ?>

                <h2><?php _e('No Signature Uploaded'); ?></h2>
                <a href="<?php echo admin_url( 'user-edit.php?user_id=' . $author_id); ?>"><?php _e('Upload Signature'); ?></a>

            <?php
            }
        }

    }

    public function register_acf_fields() {


        $user_roles = apply_filters( 'author_signature_roles', array('administrator', 'editor', 'author') );
        $locations = array();
        foreach ( $user_roles as $role ) {
            $locations[] = array(
                array(
                    'param'    => 'user_form',
                    'operator' => '==',
                    'value'    => 'edit',
                ),
                array(
                    'param'    => 'current_user_role',
                    'operator' => '==',
                    'value'    => $role,
                ),
            );
        }


        //register User Profile meta fields
        acf_add_local_field_group( array(
            'key'                   => 'unity3_author_signature_group',
            'title'                 => 'Author Signature',
            'fields'                => array(
                array(
                    'key'               => 'unity3_author_signature_closing_text',
                    'label'             => 'Closing Text',
                    'name'              => 'signature_closing_text',
                    'type'              => 'text',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width' => '',
                        'class' => '',
                        'id'    => '',
                    ),
                    'placeholder'       => 'Something like: Sincerely, Regards, etc',
                    'prepend'           => '',
                    'append'            => '',
                    'maxlength'         => '',
                ),
                array(
                    'key'               => 'unity3_author_signature_image',
                    'label'             => 'Signature',
                    'name'              => 'signature_image',
                    'type'              => 'image',
                    'instructions'      => 'An image of the author\'s handwritten signature',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width' => '',
                        'class' => '',
                        'id'    => '',
                    ),
                    'return_format'     => 'id',
                    'preview_size'      => 'medium',
                    'library'           => 'all',
                    'min_width'         => '',
                    'min_height'        => '',
                    'min_size'          => '',
                    'max_width'         => '',
                    'max_height'        => '',
                    'max_size'          => '',
                    'mime_types'        => '',
                ),
            ),
            'location'              => $locations,
            'menu_order'            => 0,
            'position'              => 'normal',
            'style'                 => 'default',
            'label_placement'       => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen'        => '',
            'active'                => true,
            'description'           => '',
        ) );

        //register Block Fields
        acf_add_local_field_group( array(
            'key'                   => 'unity3_author_signature_block',
            'title'                 => 'Author Signature',
            'fields'                => array(
                array(
                    'key' => 'field_60242d7df2014',
                    'label' => 'Signature Size',
                    'name' => 'signature_size',
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
                        'author-signature' => 'Large',
                        'author-signature-medium' => 'Medium',
                        'author-signature-small' => 'Small',
                    ),
                    'default_value' => 'medium',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'return_format' => 'value',
                    'ajax' => 0,
                    'placeholder' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/unity3-author-signature',
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
    $author_signature = new Author_Signature();
    $author_signature->init();
});

