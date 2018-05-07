<?php
/*
    Plugin Name: Unity 3 Software
    Plugin URI: http://www.unity3software.com/
    Description: Customized widgets and functions for client websites
    Version: 1.10.0
    Author: Richard Blythe
    Author URI: http://unity3software.com/richardblythe
    GitHub Plugin URI: https://github.com/richardblythe/unity3
 */
class Unity3 {   
    public static $dir, $url;
    function __construct() {
        add_filter( 'wp_page_menu_args', array(&$this, 'home_page_menu_args' ));
        //
        Unity3::$dir = plugin_dir_path( __FILE__ );
        Unity3::$url = plugin_dir_url( __FILE__ );
        //load bundled plugins...
        require_once (Unity3::$dir . '/bundled/loader.php');

        if (!(defined('DOING_AJAX') && DOING_AJAX)) {
            //this can appear in both admin and frontend when the user is logged in...
            add_action('admin_bar_menu', array(&$this, 'unity3_admin_bar_logo'), 0);
            add_action( 'admin_bar_menu', array(&$this, 'unity3_admin_bar_howdy'), 11 );
            //
            add_action( 'wp_before_admin_bar_render', array(&$this, 'modify_admin_bar'), 0);
            add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts_styles'));
            add_action('login_enqueue_scripts', array(&$this, 'login_enqueue_scripts_styles'));
	        add_filter( 'login_message', array(&$this, 'custom_login_message') );
            add_filter( 'request', array(&$this, 'filter_media' ));
            //strips <p> tags from images
            add_filter('the_content', array(&$this, 'filter_ptags'));

            if (is_admin()) {
                add_action('admin_init', array(&$this, 'admin_init'));
                add_action('admin_menu', array(&$this,'hide_update_notice'), 9999 );

                add_filter('admin_footer_text', array(&$this,'modify_admin_footer'),999); 
                add_filter('update_footer', array(&$this, 'modify_admin_version_footer'), 999);
            }
        } else {
            add_filter( 'ajax_query_attachments_args', array(&$this, 'filter_media' ));
        }

    }

    function custom_login_message($message) {
	    if ( empty($message) ){
		    return "<p><strong>Welcome! Please login to access the control panel</strong></p>";
	    } else {
		    return $message;
	    }
    }

    function filter_ptags($content){
        return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    }

    function hide_update_notice() {
    	//yes I want to comment this out
        // global $current_user, $wp_filter;
        // if ($current_user && !in_array('developer', $current_user->roles)) {
        //     $admin_notices = $wp_filter['admin_notices'];
        //     unset($wp_filter['admin_notices']);
        // }
    }

    function home_page_menu_args( $args ) {
        $args['show_home'] = true;
        return $args;
    }

    
    function login_enqueue_scripts_styles() {
        wp_enqueue_style('unity3-login-style', plugins_url( 'includes/css/login.css', __FILE__ ), false, '1.8');
    }
    
    function admin_enqueue_scripts_styles() {
        wp_enqueue_script('unity3-admin', plugins_url( 'includes/js/unity3.js', __FILE__ ), array('jquery'));
    }
    
    function unity3_admin_bar_logo($wp_admin_bar) {      
        $wp_admin_bar->add_node(array(
            'id' => 'unity3-logo',
            'title' => '<img title="Thank you for choosing Unity 3 Software" src="' . Unity3::$url . 'includes/images/unity3_logo_admin_bar.png" alt="' . esc_attr__( 'Unity3' ) . '" width="32" height="24" style="vertical-align: middle;" />',
            'parent' => false
        ));
    }

    function unity3_admin_bar_howdy( $wp_admin_bar ) {
        $user_id = get_current_user_id();
        $current_user = wp_get_current_user();
        $profile_url = get_edit_profile_url( $user_id );

        if ( 0 != $user_id ) {
            /* Add the "My Account" menu */
            $avatar = get_avatar( $user_id, 28 );
            $howdy = sprintf( __('Welcome, %1$s'), $current_user->display_name );
            $class = empty( $avatar ) ? '' : 'with-avatar';

            $wp_admin_bar->add_menu( array(
            'id' => 'my-account',
            'parent' => 'top-secondary',
            'title' => $howdy . $avatar,
            'href' => $profile_url,
            'meta' => array(
            'class' => $class,
            ),
            ) );
        }
    }


    function modify_admin_bar() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('wp-logo');
        $wp_admin_bar->remove_node('appearance');
        $wp_admin_bar->remove_node('updates');
        //remove the customize bar for all users who are not developers
        // $user = wp_get_current_user();
        // if ($user && !in_array('developer', $user->roles))
        //     $wp_admin_bar->remove_node('customize');
        //var_dump($wp_admin_bar);
    }
    
    
    
    function modify_admin_footer () {
        echo 'Thank you for choosing <a href="mailto:unity3software@gmail.com" target="_blank">Unity 3 Software</a>';
    }

    function modify_admin_version_footer() {
        echo 'Powered by <a href="http://www.wordpress.org.net" target="_blank">Wordpress</a>';
    }
    
    function admin_init() {
        add_filter( 'request', array(&$this, 'unity3_filter_admin_posts' ));

        //this code only runs one time
       // $user = get_user_by('login', 'unity3software');
       // if ($user && !in_array('developer', $user->roles)) {
       //      if (!get_role('developer')) {
       //          $role_admin = get_role('administrator');
       //          $role_dev = add_role('developer', 'Developer', $role_admin->capabilities);
       //      }

       //      $user->set_role('developer');
       //      //grant_super_admin($user->ID);
       //  }
    }

    function unity3_filter_admin_posts($request) {
        $screen = get_current_screen();
        if ('edit-page' == $screen->id || 'edit-post' == $screen->id) {
            $filter = apply_filters('unity3_hide_admin_posts', array());
            $filter = $filter[$request['post_type']];
            if (is_array($filter)) {
                $request['post__not_in'] = $filter;
            }
        }
        return $request;
    }
    //-------------------------------------------
    function filter_media( $request ) {
        //Only filter the structural media items from non-administrators
        if ($request['post_type'] != 'attachment' || current_user_can('manage_options'))
            return $request;

        $is_wp_media = false;
        if (isset($_REQUEST['action']) && 'query-attachments' == $_REQUEST['action'])
            $is_wp_media = true;
        //
        if (!$is_wp_media) {
            $screen = get_current_screen();
            $is_wp_media = (isset($screen) && 'upload' === $screen->id);
        }

        //if this is a wordpress media request
        if ( $is_wp_media) {
            if (apply_filters('unity3_filter_featured_media', true)) {
                global $wpdb;
                //get the media items that are featured page images
                $post_ids = $wpdb->get_col(
                    "SELECT meta_value FROM $wpdb->postmeta pm LEFT JOIN $wpdb->posts p
                        ON pm.post_id=p.ID WHERE p.post_type = 'page' AND meta_key = '_thumbnail_id'");
                //if we have results, filter out the media items that are attached to the post_ids 
                if (isset($post_ids) && count($post_ids) != 0) {
                    $request['post__not_in'] = isset($request['post__not_in']) ?
                        array_merge($request['post__not_in'], $post_ids) : $post_ids;
                }
            }

            if (apply_filters('unity3_filter_structure_media', true)) {
                $request['meta_query'] = array(
                    'relation' => 'AND',
                    array(
                        'key'     => '_wp_attachment_is_custom_background',
                        'compare' => 'NOT EXISTS',
                    ),
                    array(
                        'key'     => '_wp_attachment_is_custom_header',
                        'compare' => 'NOT EXISTS',
                    )
                );
            }
        }

        return $request;
    }
}
new Unity3();