<?php

use Unity3\IModuleRender;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('Unity3_Modules') ) :

class Unity3_Modules {

	/** @var array Storage for class instances */
	private $modules = array();
	private $controllers = array();

	function initialize() {

//		if (is_admin()) {
//			add_filter('unity3_dragsortposts',  array($this, 'register_dragsort_posts') );
//		}

		//load modules immediately before the widgets! Note the priority of zero
		add_action( 'init', array($this, 'load_modules'), 0 );
	}

	//this is the place to fire the activation notice to theme listeners...
	public function load_modules() {
		//load base modules...
		require_once (Unity3::$dir . 'includes/modules/class-module.php');
		require_once (Unity3::$dir . 'includes/modules/class-post-type.php');
		require_once (Unity3::$dir . 'includes/modules/class-post-group.php');


		$files = array_diff(scandir(Unity3::$dir . 'includes/modules'), array('.', '..', 'modules.php', 'class-module.php', 'class-post-type.php', 'class-post-group.php'));
		foreach ($files as $file) {
			require_once (Unity3::$dir . 'includes/modules/' . $file);
		}

		do_action('unity3/modules/load' );
		do_action('unity3/modules/controllers/load');

		
		//load the modules that are set to activate
		if ( $module_ids = get_option( 'options_unity3_modules_active', false )) {
			//now that controllers have been loaded, initialize the modules
			foreach ($module_ids as $m) {
				if ( $module = $this->Get($m) ) {
					$module->Init();
				}
			}
		}
		do_action('unity3/modules/init' );

		//Add modules list to the Unity 3 Software general settings page
		if(is_admin() && function_exists('acf_add_local_field_group') ) {

			acf_add_local_field_group(array(
				'key'	=> 'unity3_modules',
				'title' => 'Modules',
				'fields' => array(
					array(
						'label' => '',
						'key' => 'unity3_modules_active',
						'name' => 'unity3_modules_active',
						'type' => 'checkbox',
						'instructions' => '',
						'choices' => $this->GetAll(),
						'allow_custom' => 0,
						'layout' => 'vertical',
						'toggle' => 1,
						'return_format' => 'value',
						'save_custom' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'options_page',
							'operator' => '==',
							'value' => Unity3::$menu_slug,
						),
					),
				),
			));
		}

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

	public function RegisterController( $class ) {
		$result = false;
		try {
			$instance = $class;
			if ( is_string( $class ) ) {
				$instance = new $class();
			}

			if(is_object($instance) && is_subclass_of( $instance, 'Unity3ModuleController') ) {
				$this->controllers[ $instance->ID() ] = $instance;
				$result = true;
			}
		} catch (Exception $e) { };

		return $result;
	}

	public function Get( $module_id ) {
		return isset($this->modules[ $module_id]) ? $this->modules[ $module_id] : null;
	}

	public function GetAll( $display = true ) {

		if ( $display ) {
			$arr = array();
			foreach ( $this->modules as $m ) {
				$arr[$m->ID()] = $m->Name();
			}
			return $arr;
		}
		return $this->modules;
	}

	public function GetControllers( $module_id = null, $display = true ) {
		if (empty($module_id)) {
			return $this->controllers;
		} else {
			$results = array();
			foreach ($this->controllers as $c) {
				if  ($c->Supports( $module_id) ) {
					$results[$c->ID()] = $display ? $c->Name() : $c;
				}
			}

			return $results;
		}
	}

	public function GetController( $controller_id ) {
		return empty($controller_id) ? null : $this->controllers[$controller_id];		
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
		//deprecated...
		//unity3_modules()->Activate( $args );
	}

	// initialize
	unity3_modules();

endif; // class_exists check


?>