<?php
namespace Unity3\Blocks;

class Recent_Images {
    private static $image_ids_by_gallery;
    public function __construct()  {
        self::$image_ids_by_gallery = [];
    }

    public function init() {
        // Check function exists.
        if( function_exists('acf_register_block_type') ) {

            // register a testimonial block.
            acf_register_block_type(array(
                'name'              => 'unity3-recent-images',
                'title'             => __('Recent Images'),
                'description'       => __('Displays a gallery of the most recently added images'),
                'render_callback'   => array(&$this, 'render'),
                'category'          => 'formatting',
                'icon'              => 'admin-comments',
                'keywords'          => array( 'image', 'latest images', 'recent images'),
            ));
        }

        if( function_exists('acf_add_local_field_group') ) {
            $this->register_acf_fields();
        }
    }

    public function render( $block, $content, $is_preview, $post_id ) {
        $columns = get_field('columns');
        $max_images = get_field('max_images');
        $image_size = get_field( 'image_size');

        $args = array(
            'post_type' => 'unity3_gallery',
            'posts_per_page' => -1
        );

        if ( $include_filter = get_field('include_filter') ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'unity3_gallery_group',
                    'field'    => 'term_id',
                    'terms'    => $include_filter,
                ),
            );
        }

        $posts = get_posts( $args );
        $image_ids = [];
        foreach ( $posts as $post) {
            if ( $ids = get_post_meta($post->ID, \Unity3_Galleries::IMAGES_META_FIELD, true)) {
                $unique = array_diff($ids, $image_ids);
                $image_ids = array_merge($image_ids, $unique);
                if (count($unique)) {
                    self::$image_ids_by_gallery[$post->ID] = $unique;
                }
            }
        }

        $attachments = count($image_ids) ? get_posts( array(
            'post_type' => 'attachment',
            'numberposts' => $max_images,
            'post__in' => $image_ids,
            'order_by' => 'modified',
            'order' => 'DESC',
            'fields' => 'ids'
        )) : null;


        $output = null;
        if (is_array($attachments) && count($attachments)) {
            add_filter( 'attachment_link', array($this, 'custom_attachment_link'), 100, 2);
            //
            $output = do_shortcode('[gallery ids="' . implode(',', $attachments) . '" columns="' . $columns . '" size="' . $image_size . '" link="permalink"]');
            //
            remove_filter( 'attachment_link', array($this, 'custom_attachment_link'), 100, 2);
        } else {
            $output = '<div class="unity3-recent-images-block no-images">' . __('This gallery has no images', 'unity3-recent-images') . '</div>';
        }

        if ( is_admin() ) {
            echo $output;
        } else {
            echo $output;
        }
    }

    public function custom_attachment_link($url, $attachment_id) {
        if (count(self::$image_ids_by_gallery)) {
            foreach ( self::$image_ids_by_gallery as $gallery_id => $image_ids ) {
                if ( in_array( $attachment_id, $image_ids ) ) {
                    $url = get_permalink( $gallery_id );
                }
            }
        }
        return $url;
    }

    public function register_acf_fields() {
        acf_add_local_field_group(array(
            'key' => 'group_5f4ed94c23f6c',
            'title' => 'Recent Images Block',
            'fields' => array(
                array(
                    'key' => 'field_5f4ed96051cb1',
                    'label' => 'Include Filter',
                    'name' => 'include_filter',
                    'type' => 'taxonomy',
                    'instructions' => 'Filters the returned images based on the selected group',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'taxonomy' => 'unity3_gallery_group',
                    'field_type' => 'checkbox',
                    'add_term' => 0,
                    'save_terms' => 0,
                    'load_terms' => 0,
                    'return_format' => 'id',
                    'multiple' => 0,
                    'allow_null' => 0,
                ),
                array(
                    'key' => 'field_5f4ee0fa1aee7',
                    'label' => 'Columns',
                    'name' => 'columns',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 0,
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
                    'min' => 1,
                    'max' => '',
                    'step' => '',
                ),
                array(
                    'key' => 'field_5f51007e8f31c',
                    'label' => 'Max Images',
                    'name' => 'max_images',
                    'type' => 'number',
                    'instructions' => 'Gets the maximum number of recent images',
                    'required' => 0,
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
                    'min' => 1,
                    'max' => '',
                    'step' => 1,
                ),
                array(
                    'key' => 'field_5f510338f32f9',
                    'label' => 'Image Size',
                    'name' => 'image_size',
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
                        'thumbnail' => 'Thumbnail',
                        'medium' => 'Medium',
                        'full' => 'Full',
                    ),
                    'default_value' => 'thumbnail',
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
                        'value' => 'acf/unity3-recent-images',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));
    }

}

//only init this class if the gallery module is active
add_action('unity3/modules/init', function (){
    if (unity3_modules()->IsActive('unity3_gallery')) {
        $recent_images = new Recent_Images();
        $recent_images->init();
    }
});

