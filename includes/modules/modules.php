<?php

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('Unity3_Modules') ) :

class Unity3_Modules {

	/** @var array Storage for class instances */
	private $modules = array();


	function initialize() {

//		if (is_admin()) {
//			add_filter('unity3_dragsortposts',  array($this, 'register_dragsort_posts') );
//		}

		//load classes immediately before the widgets! Note the priority of zero
		add_action( 'init', array($this, 'load_classes'), 0 );
	}

	//this is the place to fire the activation notice to theme listeners...
	public function load_classes() {
		//load classes...
		require_once (Unity3::$dir . 'includes/modules/class-module.php');
		require_once (Unity3::$dir . 'includes/modules/class-post-type.php');
		require_once (Unity3::$dir . 'includes/modules/class-post-group.php');
		require_once (Unity3::$dir . 'includes/modules/class-galleries.php');
		require_once (Unity3::$dir . 'includes/modules/class-slides.php');
		require_once (Unity3::$dir . 'includes/modules/class-services.php');
		require_once (Unity3::$dir . 'includes/modules/class-audio.php');

		do_action('unity3/modules/init' );

		do_action('unity3/modules/activate');
	}

//	public function register_dragsort_posts( $post_types ) {
//		return array_merge($post_types, array_keys($this->modules));
//	}
//
//	public function admin_body_class( $classes ) {
//		$screen = get_current_screen();
//
//		foreach ( $this->modules as $type ) {
//
//			if ( $type->GetPostType() == $screen->post_type ) {
//				$classes .= " unity3-post-type {$type->GetPostType()}";
//				break;
//			}
//		}
//
//		return $classes;
//	}


	public function Register( $class ) {

		$result = false;
		try {
			$instance = $class;
			if ( is_string( $class ) ) {
				$instance = new $class();
			}

			if(is_object($instance) && is_subclass_of( $instance, 'Unity3_Module') ) {
				$this->modules[ $instance->ID() ] = $instance;
				$result = true;
			}
		} catch (Exception $e) { };

		return $result;
	}

//	public function HasPostType( $post_type ) {
//		foreach ($this->modules as $type ) {
//			if ($post_type == $type->GetPostType()) {
//				return true;
//			}
//		}
//		return false;
//	}
//
//	public function GetTaxonomy( $post_type ) {
//		foreach ($this->modules as $type ) {
//			if ($post_type == $type->GetPostType()) {
//				return $type->GetGroupType();
//			}
//		}
//		return null;
//	}

	public function Get( $id ) {
		return isset($this->modules[ $id ]) ? $this->modules[ $id ] : null;
	}

	public function Activate( $args ) {

		if (!isset( $args ))
			return false;

		if (!is_array( $args ) ) {
			$args = array( $args => null); //convert to an associative array
		}
		//check to see if the array is sequential. (we need an associative array)
		if ( array_keys($args) === range(0, count($args) - 1) ) {
			//convert to an associative array
			$new_array = array();
			foreach ($args as $key ) {
				$new_array[$key] = null;
			}
			$args = $new_array; //assign the converted array;
		}

		$activated_any = false;
		$module = null;
		if (0 !== count($args)) {
			foreach ($args as $id => $settings ) {
				$module = $this->Get( $id );
				if (isset($module) && !$module->IsActivated()) {
					$module->Activate( $settings );
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
	*  Unity3_Modules
	*
	*  The main function responsible for returning the one true acf Instance to functions everywhere.
	*  Use this function like you would a global variable, except without needing to declare the global.
	*
	*  Example: <?php $Unity3_Modules = Unity3_Modules(); ?>
	*
	*  @type	function
	*  @date	4/09/13
	*  @since	4.3.0
	*
	*  @param	N/A
	*  @return	(object)
	*/

	function unity3_modules() {

		// globals
		global $unity3_modules;


		// initialize
		if( !isset($unity3_modules) ) {
			$unity3_modules = new Unity3_Modules();
			$unity3_modules->initialize();
		}


		// return
		return $unity3_modules;

	}

	function unity3_activate( $args ) {
		unity3_modules()->Activate( $args );
	}

	// initialize
	unity3_modules();

endif; // class_exists check


?>