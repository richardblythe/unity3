<?php

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('Unity3_Post_Types') ) :

class Unity3_Post_Types {

	/** @var string The plugin version number */
	var $version = '1.0';

	/** @var array The plugin settings array */
	var $settings = array();

	/** @var array The plugin data array */
	var $data = array();

	/** @var array Storage for class instances */
	private $types = array();

	/*
	*  __construct
	*
	*  A dummy constructor to ensure ACF is only initialized once
	*
	*  @type	function
	*  @date	23/06/12
	*  @since	5.0.0
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function initialize() {

		//Todo: Remove For Production
		$this->version = Unity3::$ver;

		if (is_admin()) {
			add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue') );
			add_filter('unity3_dragsortposts',  array($this, 'register_dragsort_posts') );
		}

		//load classes immediately before the widgets! Note the priority of zero
		add_action( 'init', array($this, 'load_classes'), 0 );
	}

	//this is the place to fire the activation notice to theme listeners...
	public function load_classes() {
		//load classes...
		require_once (Unity3::$dir . 'includes/post-types/class-post-type.php');
		require_once (Unity3::$dir . 'includes/post-types/class-post-group.php');
		require_once (Unity3::$dir . 'includes/post-types/class-galleries.php');
		require_once (Unity3::$dir . 'includes/post-types/class-slides.php');

		do_action('unity3/post_types/init' );

		do_action('unity3/post_types/activate');
	}

	public function register_dragsort_posts( $post_types ) {
		return array_merge($post_types, array_keys($this->types));
	}

	public function admin_body_class( $classes ) {
		$screen = get_current_screen();

		foreach ( $this->types as $type ) {

			if ( $type->GetPostType() == $screen->post_type ) {
				$classes .= " unity3-post-type {$type->GetPostType()}";
				break;
			}
		}

		return $classes;
	}

	public function admin_enqueue() {
//		wp_register_script('sweetalert', plugins_url( 'js/sweetalert.all.min.js', __FILE__ ), array('jquery'));
//		wp_enqueue_script( 'unity3-media-admin-script', plugins_url( 'js/unity3-media.js', __FILE__ ), array('wp-element', 'sweetalert'), Unity3_Post_Types()->version );
//
//		wp_register_script('sweetalert-style', plugins_url( 'css/sweetalert2.min.css', __FILE__ ));
//		wp_enqueue_style( 'unity3-media-admin-style', plugins_url( 'css/admin-style.css', __FILE__ ), array(), Unity3_Post_Types()->version );

		//wp_enqueue_script( 'unity3-media-admin-script', plugins_url( 'assets/js/main.js', __FILE__ ), array('wp-element', 'wp-components'), Unity3_Post_Types()->version, true );
		wp_enqueue_style( 'unity3-post-types-style-admin', plugins_url( 'assets/style.css', __FILE__ ), array(), Unity3_Post_Types()->version );


	}

	public function Register( $class ) {
		// allow instance
		if(is_object($class) && is_subclass_of( $class, 'Unity3_Post_Type') ) {
			$this->types[$class->GetPostType()] = $class;

		// allow class name
		} else {
			$instance = new $class();
			$this->types[ $instance->GetPostType() ] = $instance;
		}
	}

//	public function HasPostType( $post_type ) {
//		foreach ($this->types as $type ) {
//			if ($post_type == $type->GetPostType()) {
//				return true;
//			}
//		}
//		return false;
//	}
//
//	public function GetTaxonomy( $post_type ) {
//		foreach ($this->types as $type ) {
//			if ($post_type == $type->GetPostType()) {
//				return $type->GetGroupType();
//			}
//		}
//		return null;
//	}

	public function GetType( $post_type ) {
		return isset($this->types[ $post_type ]) ? $this->types[ $post_type ] : null;
	}

	public function Activate( $args ) {

		if (!isset( $args ))
			return false;

		if (!is_array($args) ) {
			$args = array( $args ); //convert to an array
		}

		$activated_any = false;
		$type = null;
		if (0 !== count($args)) {
			foreach ($args as $post_type ) {
				$type = $this->GetType( $post_type );
				if (isset($type) && !$type->IsActivated()) {
					$type->Activate();
					$activated_any = true;
				}
			}
		}

		return $activated_any;
	}

    public function GetImageSizes( $format = 'raw' ) {

		$builtin_sizes = array(
			'large'   => array(
				'width'  => get_option( 'large_size_w' ),
				'height' => get_option( 'large_size_h' ),
			),
			'medium'  => array(
				'width'  => get_option( 'medium_size_w' ),
				'height' => get_option( 'medium_size_h' ),
			),
			'thumbnail' => array(
				'width'  => get_option( 'thumbnail_size_w' ),
				'height' => get_option( 'thumbnail_size_h' ),
				'crop'   => get_option( 'thumbnail_crop' ),
			),
		);

		global $_wp_additional_image_sizes;
		$additional_sizes = $_wp_additional_image_sizes ? $_wp_additional_image_sizes : array();

		$sizes = array_merge( $builtin_sizes, $additional_sizes );

		if ('display' == $format) {
			$formatted = array();
			foreach ($sizes as $name => $size) {
				$formatted[$name] = (esc_html( $name ) . ' (' . absint( $size['width'] ) . 'x' . absint( $size['height'] ) . ')');
			}
			$sizes = $formatted;
		}

		return $sizes;
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

	function unity3_post_types() {

		// globals
		global $unity3_post_types;


		// initialize
		if( !isset($unity3_post_types) ) {
			$unity3_post_types = new Unity3_Post_Types();
			$unity3_post_types->initialize();
		}


		// return
		return $unity3_post_types;

	}

	function unity3_activate( $args ) {
		unity3_post_types()->Activate( $args );
	}

	// initialize
	unity3_post_types();

endif; // class_exists check

?>