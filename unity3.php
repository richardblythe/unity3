<?php
/*
    Plugin Name: Unity 3 Software
    Plugin URI: http://www.unity3software.com/
    Description: Core components for building Wordpress sites that are easy for the client to use.
    Version: 2.6.0
    Author: Richard Blythe
    Author URI: http://unity3software.com/richardblythe
    GitHub Plugin URI: https://github.com/richardblythe/unity3
 */
class Unity3 {
	const ver = '2.6.0';//this is referenced when enqueuing the assets folder
    const domain = 'unity3';

    const Vendor_Prefix = 'Unity3_Vendor';

    public static $dir, $url, $assets_url, $vendor_autoload, $vendor_url, $blank_img, $menu_slug;
    private static $admin_menu_uid;
    private $widgets, $min, $plugin_activated, $plugin_deactivated;

    function __construct() {
	    Unity3::$dir = plugin_dir_path( __FILE__ );
        Unity3::$url = plugin_dir_url( __FILE__ );
	    Unity3::$assets_url = Unity3::$url . 'assets/dist';
        Unity3::$vendor_autoload = Unity3::$dir  . '/vendor_build/vendor/autoload.php';
        Unity3::$vendor_url = Unity3::$url  . 'vendor';
	    Unity3::$blank_img = Unity3::$assets_url . '/images/blank.gif';
        Unity3::$menu_slug = 'unity3-settings-general';


	    $this->min = '.'; //todo (defined('WP_DEBUG') && true === WP_DEBUG) ? '.' : '.min.';
	    self::$admin_menu_uid = 10.1;
    }

    public function initialize() {

	    //load bundled plugins...
	    require_once (Unity3::$dir . '/includes/loader.php');


        register_activation_hook( __FILE__, function () { add_option( 'Unity3_Plugin_Activated', true ); } );
        register_deactivation_hook( __FILE__, function () { do_action('unity3/plugin-deactivate'); } );


	    add_filter( 'wp_page_menu_args', array(&$this, 'home_page_menu_args' ));
	    add_action( 'widgets_init', array(&$this, 'register_widgets'));

	    if (!(defined('DOING_AJAX') && DOING_AJAX)) {

	        //this can appear in both admin and frontend when the user is logged in...
            add_action('admin_bar_menu', array(&$this, 'unity3_admin_bar_logo'), 0);
		    add_action( 'admin_bar_menu', array(&$this, 'unity3_admin_bar_howdy'), 11 );
		    //
		    add_action( 'wp_before_admin_bar_render', array(&$this, 'modify_admin_bar'), 0);
		    add_action('wp_enqueue_scripts', array(&$this, 'enqueue_front'), 100);
		    add_action('admin_enqueue_scripts', array(&$this, 'enqueue_admin'), 100);
		    add_action('login_enqueue_scripts', array(&$this, 'enqueue_front'), 100);
		    add_action( 'enqueue_block_editor_assets', array(&$this, 'enqueue_editor'), 100 );



		    add_filter( 'login_message', array(&$this, 'custom_login_message') );
//		    add_filter( 'request', array(&$this, 'filter_media' ));
		    //strips <p> tags from images
		    add_filter('the_content', array(&$this, 'filter_ptags'));


		    if (is_admin()) {
                add_action('admin_init', array(&$this, 'admin_init'));
			    add_action( 'wp_loaded', function (){
				    if( current_user_can('manage_options') && function_exists('acf_add_options_page') ) {

					    acf_add_options_page(array(
						    'page_title' 	=> 'Unity 3 Software',
						    'menu_title'	=> 'Unity 3 Software',
						    'menu_slug' 	=> Unity3::$menu_slug,
						    'icon_url'      => Unity3::$assets_url . '/images/unity3_logo_admin_bar.png',
						    'capability'	=> 'manage_options',
						    'redirect'		=> false
					    ));

//                        acf_add_options_sub_page(array(
//                            'page_title' 	=> 'General Settings',
//                            'menu_title'	=> 'General Settings',
//                            'parent_slug'   => Unity3::$menu_slug,
//                            'menu_slug' 	=> Unity3::$menu_slug . '-hello-world',
//                            'capability'	=> 'manage_options',
//                            'redirect'		=> false
//                        ));
				    }
			    });
                add_filter('admin_footer_text', array(&$this,'modify_admin_footer'),999);
                add_filter('update_footer', array(&$this, 'modify_admin_version_footer'), 999);
		    }
	    } else {
		    //add_filter( 'ajax_query_attachments_args', array(&$this, 'filter_media' ));
	    }
    }

    static function AdminMenuUID() {
    	self::$admin_menu_uid += 0.1;
    	return self::$admin_menu_uid;
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

    function home_page_menu_args( $args ) {
        $args['show_home'] = true;
        return $args;
    }


    function enqueue_front() {
        wp_enqueue_script('unity3-front-js',       Unity3::$assets_url . "/scripts/unity3-front.js", array('jquery'), Unity3::ver);
        wp_enqueue_style( 'unity3-front-css', Unity3::$assets_url . "/styles/unity3-front.css", false, Unity3::ver);

        $localized = apply_filters("unity3/localize/front", array());
        if (isset($localized) && is_array($localized) && count($localized)) {
            wp_localize_script('unity3-front-js', 'unity3', $localized );
        }
    }

    function enqueue_admin() {
        wp_enqueue_script('unity3-admin-js',       Unity3::$assets_url . "/scripts/unity3-admin.js", array('jquery'), Unity3::ver);
        wp_enqueue_style( 'unity3-admin-css', Unity3::$assets_url . "/styles/unity3-admin.css", false, Unity3::ver);

        $localized = apply_filters("unity3/localize/admin", array());
        if (isset($localized) && is_array($localized) && count($localized)) {
            wp_localize_script('unity3-admin-js', 'unity3', $localized );
        }
    }

    function enqueue_editor() {

        wp_enqueue_script('unity3-editor-js',       Unity3::$assets_url . "/scripts/unity3-editor.js", array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'), Unity3::ver);
        wp_enqueue_style( 'unity3-editor-css', Unity3::$assets_url . "/styles/unity3-editor.css", false, Unity3::ver);

    }

    function unity3_admin_bar_logo($wp_admin_bar) {
        $wp_admin_bar->add_node(array(
            'id' => 'unity3-logo',
            'title' => '<img title="Thank you for choosing Unity 3 Software" src="' . Unity3::$assets_url . '/images/unity3_logo_admin_bar.png" alt="' . esc_attr__( 'Unity3' ) . '" width="32" height="24" style="vertical-align: middle;" />',
            'parent' => false
        ));
    }

    static function Vendor( $subpath ) {
    	return self::$vendor_url . '/' . $subpath;
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
    }
    
    
    
    function modify_admin_footer () {
        echo 'Thank you for choosing <a href="mailto:unity3software@gmail.com" target="_blank">Unity 3 Software</a>';
    }

    function modify_admin_version_footer() {
        echo 'Powered by <a href="http://www.wordpress.org.net" target="_blank">Wordpress</a>';
    }
    
    function admin_init() {

        if ( get_option('Unity3_Plugin_Activated') ) {
            do_action('unity3/plugin-activate');
            delete_option( 'Unity3_Plugin_Activated' );
        }

        add_filter( 'request', array(&$this, 'unity3_filter_admin_posts' ));

        if ( !function_exists( 'acf' ) )
            add_action( 'admin_notices', array( &$this, 'admin_notice_missing_plugins' ) );
    }

    function admin_notice_missing_plugins() {
       ?>
            <div class="notice notice-warning">
                <p><?php esc_html_e('Unity 3 Software requires the plugin: Advanced Custom Fields Pro'); ?></p>
            </div>
            <?php
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