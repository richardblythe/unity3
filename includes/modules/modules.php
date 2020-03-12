<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('Unity3_Modules') ) :

class Unity3_Modules {

	/**
	 * Array of modules
	 *
	 * @var Unity3_Module[]
	 */
	private $modules = array();
	/**
	 * Array of module plugins
	 *
	 * @var Unity3_Module_Plugin[]
	 */
	private $plugins = array();

	function initialize() {

		//load modules immediately before the widgets! Note the priority of zero
		add_action( 'init', array($this, 'load_modules'), 0 );
	}

	//this is the place to fire the activation notice to theme listeners...
	public function load_modules() {
		//load base modules...
		require_once (Unity3::$dir . 'includes/modules/class-module.php');
		require_once (Unity3::$dir . 'includes/modules/class-post-type.php');
		require_once (Unity3::$dir . 'includes/modules/class-post-group.php');

		//load dependencies
		require_once (Unity3::$dir . 'includes/modules/class-audio.php');
		require_once (Unity3::$dir . 'includes/modules/class-galleries.php');
		require_once (Unity3::$dir . 'includes/modules/class-service.php');
		require_once (Unity3::$dir . 'includes/modules/class-slides.php');
		//
		require_once (Unity3::$dir . 'includes/modules/class-clearbase-converter.php');
		require_once (Unity3::$dir . 'includes/modules/class-module-plugin.php');

//		$files = array_diff(scandir(Unity3::$dir . 'includes/modules'), array('.', '..', 'modules.php', 'class-module.php', 'class-post-type.php', 'class-post-group.php'));
//		foreach ($files as $file) {
//			require_once (Unity3::$dir . 'includes/modules/' . $file);
//		}

		do_action('unity3/modules/load' );
		do_action('unity3/modules/plugins/load');

		
		//load the modules that are set to activate
		if ( $module_ids = get_option( 'options_unity3_modules_active', false )) {
			//now that plugins have been loaded, initialize the modules
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

	public function RegisterPlugin( $class ) {
		$result = false;
		try {
			$instance = $class;
			if ( is_string( $class ) ) {
				$instance = new $class();
			}

			if(is_object($instance) && is_subclass_of( $instance, 'Unity3_Module_Plugin') ) {
				$this->plugins[ $instance->ID() ] = $instance;
				$result = true;
			}
		} catch (Exception $e) { };

		return $result;
	}

		/**
		 * Attempts to get a module instance based on it's id
		 *
		 * @return Unity3_Module|null
		 */
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

	public function GetPlugins( $module_id = null, $display = true ) {
		if (empty($module_id)) {
			return $this->plugins;
		} else {
			$results = array();
			foreach ($this->plugins as $c) {
				if  ($c->Supports( $module_id) ) {
					$results[$c->ID()] = $display ? $c->Name() : $c;
				}
			}

			return $results;
		}
	}

	public function GetPlugin( $plugin_id ) {
		return isset($this->plugins[$plugin_id]) ? $this->plugins[$plugin_id] : null;
	}


	public function Activate( $args ) {
		throw new Exception('This function is now deprecated.');

//		if (!isset( $args ))
//			return false;
//
//		if (!is_array( $args ) ) {
//			$args = array( $args => null); //convert to an associative array
//		}
//		//check to see if the array is sequential. (we need an associative array)
//		if ( array_keys($args) === range(0, count($args) - 1) ) {
//			//convert to an associative array
//			$new_array = array();
//			foreach ($args as $key ) {
//				$new_array[$key] = null;
//			}
//			$args = $new_array; //assign the converted array;
//		}
//
//		$activated_any = false;
//		$module = null;
//		if (0 !== count($args)) {
//			foreach ($args as $id => $settings ) {
//				$module = $this->Get( $id );
//				if (isset($module) && !$module->IsActivated()) {
//					$module->Activate( $settings );
//					$activated_any = true;
//				}
//			}
//		}
//
//		return $activated_any;
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