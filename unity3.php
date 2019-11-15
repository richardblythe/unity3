<?php
/*
    Plugin Name: Unity 3 Software
    Plugin URI: http://www.unity3software.com/
    Description: Customized widgets and functions for client websites
    Version: 3.2.1
    Author: Richard Blythe
    Author URI: http://unity3software.com/richardblythe
    GitHub Plugin URI: https://github.com/richardblythe/unity3
 */
class Unity3 {
    public static $ver, $dir, $url, $assets_url, $vendor_url, $blank_img, $menu_slug;
    private $widgets;
    private $min;
    function __construct() {

    	$debug = (defined('WP_DEBUG') && true === WP_DEBUG);

        //
	    Unity3::$ver = '2.3.18';
        Unity3::$dir = plugin_dir_path( __FILE__ );
        Unity3::$url = plugin_dir_url( __FILE__ );
	    Unity3::$assets_url = Unity3::$url . 'assets';
        Unity3::$vendor_url = Unity3::$url  . 'vendor';
	    Unity3::$blank_img = Unity3::$assets_url . '/images/blank.gif';
        Unity3::$menu_slug = 'unity3-settings-general';
        
	    $this->min = $debug ? '.min.' : '.';
    }

    public function initialize() {

	    //load bundled plugins...
	    require_once (Unity3::$dir . '/includes/loader.php');

	    add_filter( 'wp_page_menu_args', array(&$this, 'home_page_menu_args' ));
	    add_action( 'widgets_init', array(&$this, 'register_widgets'));

	    if (!(defined('DOING_AJAX') && DOING_AJAX)) {
		    //this can appear in both admin and frontend when the user is logged in...
            add_action('admin_bar_menu', array(&$this, 'unity3_admin_bar_logo'), 0);
		    add_action( 'admin_bar_menu', array(&$this, 'unity3_admin_bar_howdy'), 11 );
		    //
		    add_action( 'wp_before_admin_bar_render', array(&$this, 'modify_admin_bar'), 0);
		    add_action('wp_enqueue_scripts', array(&$this, 'enqueue'));
		    add_action('admin_enqueue_scripts', array(&$this, 'enqueue'));
		    add_action('login_enqueue_scripts', array(&$this, 'enqueue'));
		    // Hook the enqueue functions into the editor
		    add_action( 'enqueue_block_editor_assets', array(&$this, 'enqueue_editor') );


		    add_filter( 'login_message', array(&$this, 'custom_login_message') );
//		    add_filter( 'request', array(&$this, 'filter_media' ));
		    //strips <p> tags from images
		    add_filter('the_content', array(&$this, 'filter_ptags'));


		    if (is_admin()) {
                add_action('admin_init', array(&$this, 'admin_init'));
			    add_action('admin_menu', array(&$this,'hide_update_notice'), 9999 );

			    add_filter('admin_footer_text', array(&$this,'modify_admin_footer'),999);
                add_filter('update_footer', array(&$this, 'modify_admin_version_footer'), 999);
                
                if( function_exists('acf_add_options_page') ) {
	
                    acf_add_options_page(array(
                        'page_title' 	=> 'Unity 3 Software',
                        'menu_title'	=> 'Unity 3 Software',
                        'menu_slug' 	=> Unity3::$menu_slug,
                        'icon_url'      => Unity3::$url . 'assets/images/unity3_logo_admin_bar.png',
                        'capability'	=> 'edit_posts',
                        'redirect'		=> false
                    ));
                }
		    }
	    } else {
		    //add_filter( 'ajax_query_attachments_args', array(&$this, 'filter_media' ));
	    }
    }

	function Dir( $sub_directory ) {
		return Unity3::$dir . $sub_directory;
	}

	function Url( $sub_url ) {
		return Unity3::$url . $sub_url;
	}

    public function AddWidget( $widget_name ){
    	if (!isset($this->widgets)) {
    		$this->widgets = array();
	    }

	    $this->widgets[] = $widget_name;
    }

	function register_widgets() {
    	if (isset($this->widgets)) {
    		foreach ($this->widgets as $widget) {
			    register_widget( $widget );
		    }
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

    
    function enqueue() {
	    wp_enqueue_script('unity3',       Unity3::$assets_url . "/scripts/unity3{$this->min}js", array('jquery'), Unity3::$ver);
	    wp_enqueue_style( 'unity3-style', Unity3::$assets_url . "/styles/unity3{$this->min}css", false, Unity3::$ver);
    }

    function enqueue_editor() {
		// Enqueue block editor styles
	    wp_enqueue_style(
		    'unity3-editor-css',
		    Unity3::$assets_url . "/styles/unity3-editor{$this->min}css",
		    false,
		    Unity3::$ver
	    );
    }

    function unity3_admin_bar_logo($wp_admin_bar) {      
        $wp_admin_bar->add_node(array(
            'id' => 'unity3-logo',
            'title' => '<img title="Thank you for choosing Unity 3 Software" src="' . Unity3::$url . 'assets/images/unity3_logo_admin_bar.png" alt="' . esc_attr__( 'Unity3' ) . '" width="32" height="24" style="vertical-align: middle;" />',
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
            $filter = isset($filter[$request['post_type']]) ? $filter[$request['post_type']] : null;
            if (is_array($filter)) {
                $request['post__not_in'] = $filter;
            }
        }
        return $request;
    }
}


/*
*  Unity3_Post_Types
*
*  The main function responsible for returning the one true acf Instance to functions everywhere.
*  Use this function like you would a global variable, except without needing to declare the global.
*
*  Example: <?php $Unity3_Post_Types = Unity3_Post_Types(); ?>
*
*  @type	function
*  @date	4/09/13
*  @since	4.3.0
*
*  @param	N/A
*  @return	(object)
*/

function unity3() {

	// globals
	global $unity3;


	// initialize
	if( !isset($unity3) ) {
		$unity3 = new Unity3();
		$unity3->initialize();
	}


	// return
	return $unity3;

}



// initialize
unity3();
