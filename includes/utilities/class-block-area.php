<?php
/**
 * Block Area
 * CPT for block-based widget areas, until WP core adds block support to widget areas
 * @link https://www.billerickson.net/wordpress-gutenberg-block-widget-areas/
 *
 * @package      CoreFunctionality
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

class Unity3_Block_Area {

    public const CPT_NAME = 'unity3_block_area';

    /**
     * Instance of the class.
     * @var object
     */
    private static $instance;

    /**
     * Class Instance.
     * @return Unity3_Block_Area
     */
    public static function instance() {
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Unity3_Block_Area ) ) {
            self::$instance = new Unity3_Block_Area();

            // Actions
            add_action( 'init',              array( self::$instance, 'register_cpt'      )    );
            add_action( 'template_redirect', array( self::$instance, 'redirect_single'   )    );
            /* Register Admin Sub Menu */
            add_action( 'admin_menu', array( self::$instance, 'admin_submenu') , 101 ); // 101 is a hack that works around a ACF bug

            add_action( 'genesis_before', array( self::$instance, 'genesis_block_areas'   )    );
        }
        return self::$instance;
    }

    /**
     * Register the custom post type
     *
     */
    function register_cpt() {

        $labels = array(
            'name'               => 'Block Areas',
            'singular_name'      => 'Block Area',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Block Area',
            'edit_item'          => 'Edit Block Area',
            'new_item'           => 'New Block Area',
            'view_item'          => 'View Block Area',
            'search_items'       => 'Search Block Areas',
            'not_found'          => 'No Block Areas found',
            'not_found_in_trash' => 'No Block Areas found in Trash',
            'parent_item_colon'  => 'Parent Block Area:',
            'menu_name'          => 'Block Areas',
        );

        $args = array(
            'labels'              => $labels,
            'hierarchical'        => false,
            'supports'            => array( 'title', 'editor', 'revisions' ),
            'public'              => false,
            'show_ui'             => true,
            'show_in_rest'	      => true,
            'show_in_menu'        => false, //we want to tuck it away under the Unity 3 Software menu
            'exclude_from_search' => true,
            'has_archive'         => false,
            'query_var'           => true,
            'can_export'          => true,
            'menu_icon'           => 'dashicons-welcome-widgets-menus',
        );

        register_post_type( self::CPT_NAME, $args );
        self::acf_init();
    }

    /**
     * Add admin menu
     * @link https://developer.wordpress.org/reference/functions/add_submenu_page/
     */
    function admin_submenu(){

        add_submenu_page(
            Unity3::$menu_slug,                 // parent slug
            'Block Areas',             // page title
            'Block Areas',             // sub-menu title
            'edit_posts',                 // capability
            'edit.php?post_type=' . self::CPT_NAME // your menu menu slug
        );

    }


    /**
     * Redirect single block areas
     *
     */
    function redirect_single() {
        if( is_singular( self::CPT_NAME ) ) {
            wp_redirect( home_url() );
            exit;
        }
    }

    function genesis_block_areas() {
        $loop = new WP_Query( array(
            'post_type'		=> self::CPT_NAME,
            'posts_per_page'	=> -1,
        ));

        if( $loop->have_posts() ): while( $loop->have_posts() ): $loop->the_post();
            $post = get_post();
            if ( $genesis_hook = get_post_meta( $post->ID, 'genesis_hook', true ) ) {
                $priority = get_post_meta( $post->ID, 'genesis_hook_priority', true );

                if ( $remove_hooks = get_post_meta($post->ID, 'genesis_remove_hooks', true )) {
                    $arr_remove_hooks =  explode(';', trim($remove_hooks));
                    foreach ( $arr_remove_hooks as $remove_hook ) {
                        remove_action( $genesis_hook, $remove_hook );
                    }
                }

                //register the dynamic Genesis action hook
                $post_id = $post->ID;
                add_action( $genesis_hook, function () use ( $post_id ) {

                    if ( $post = get_post($post_id) ) {
                        $css_classes = get_post_meta($post_id, 'additional_css_classes', true);
                        echo '<div class="block-area block-area-' . $post->post_name . ( empty($css_classes) ? '' : " {$css_classes}" ) . '">';
                        echo get_the_content( null, null, $post );
                        echo '</div>';
                    }

                }, empty($priority) ? 10 : $priority );
            }

        endwhile; endif; wp_reset_postdata();
    }

    function acf_init() {
        if( function_exists('acf_add_local_field_group') ):

            acf_add_local_field_group(array(
                'key' => 'group_5f19c14e72815',
                'title' => 'Block Area Fields',
                'fields' => array(
                    array(
                        'key' => 'field_5f19c1651582e',
                        'label' => 'Genesis Hook',
                        'name' => 'genesis_hook',
                        'type' => 'text',
                        'instructions' => 'The main Genesis hook to fire on.	See <a href="https://genesistutorials.com/visual-hook-guide/" target="_blank">Genesis Visual Hooks</a> for hook references.',
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
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f19c1c71582f',
                        'label' => 'Remove Hooks',
                        'name' => 'genesis_remove_hooks',
                        'type' => 'textarea',
                        'instructions' => 'Specifies the function references to remove from the Genesis action hook listed above.	Use this to remove hooks registered by your Genesis child theme.	(Separate each hook by a semicolon)',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'maxlength' => '',
                        'rows' => '',
                        'new_lines' => '',
                    ),
                    array(
                        'key' => 'field_5f19c51cb12d9',
                        'label' => 'Priority',
                        'name' => 'genesis_hook_priority',
                        'type' => 'number',
                        'instructions' => 'Specifies the order in which the Block Area will render.	Lower values have higher priority.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 10,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_5f19dfa33cefd',
                        'label' => 'Additional CSS class(es)',
                        'name' => 'additional_css_classes',
                        'type' => 'text',
                        'instructions' => 'Separate multiple classes with spaces.',
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
                        'maxlength' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => self::CPT_NAME,
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'side',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));

        endif;
    }
}

/**
 * The function provides access to the class methods.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * @return object
 */
function unity3_block_area() {
    return Unity3_Block_Area::instance();
}
unity3_block_area();