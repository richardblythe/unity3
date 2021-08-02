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
		add_action( 'init',  array(&$this, '_load_modules'), 0 );
		add_action( 'wp_loaded', function () { $this->_wp_loaded(); }, 100 );

		// see if any modules are active/deactive
		add_action('acf/save_post', array(&$this, '_module_activation'), 1);

        add_action('unity3/plugin-activate', array(&$this, '_root_plugin_activated'), 100);
        add_action('unity3/plugin-deactivate', array(&$this, '_root_plugin_deactivated'), 100);
	}

	//this is the place to fire the activation notice to theme listeners...
	public function _load_modules() {

		//load base modules...
		require_once (Unity3::$dir . 'includes/modules/class-module.php');
		require_once (Unity3::$dir . 'includes/modules/class-post-type.php');
		require_once (Unity3::$dir . 'includes/modules/class-post-group.php');

		//load bundled modules
		require_once (Unity3::$dir . 'includes/modules/class-audio.php');
        require_once (Unity3::$dir . 'includes/modules/class-audio-transcription.php');
		require_once (Unity3::$dir . 'includes/modules/class-galleries.php');
		require_once (Unity3::$dir . 'includes/modules/class-service.php');
		require_once (Unity3::$dir . 'includes/modules/class-slides.php');
		//
		require_once (Unity3::$dir . 'includes/modules/class-clearbase-converter.php');

//		require_once (Unity3::$dir . 'includes/modules/class-module-plugin.php');

//		$files = array_diff(scandir(Unity3::$dir . 'includes/modules'), array('.', '..', 'modules.php', 'class-module.php', 'class-post-type.php', 'class-post-group.php'));
//		foreach ($files as $file) {
//			require_once (Unity3::$dir . 'includes/modules/' . $file);
//		}

		do_action('unity3/modules/load' );
//		do_action('unity3/modules/plugins/load');

		//run initialization on all activated modules
		foreach ($this->GetAllActive() as $module_id => $module) {
			$module->Init();
		}

		do_action('unity3/modules/init' );
	}

	private function _wp_loaded() {
		/*
		 * Settings: Modules Metabox
		 * Page: unity3-settings-general
		 */
		if(is_admin() && function_exists('acf_add_local_field_group') ) {

			$active_modules = $this->GetAllActive();
			add_filter('acf/load_value/type=true_false', function ($value, $post_id, $field) use ($active_modules) {
				foreach ( $active_modules as $module_id => $module ) {
					if ($field['key'] === "unity3_module_{$module_id}_active") {
						return true;
					}
				}
				return $value;
			}, 10, 3);

			uasort($this->modules, function ($module1, $module2){
				return strcmp($module1->Name(), $module2->Name());
			});

			$module_fields = array();
			foreach ($this->modules as $module_id => $module) {
				$uid = "unity3_module_{$module_id}";

				$module_name_html = '<p>' . $module->Name() . '</p>';
				if ( $menu_slug = $module->GetSettingsMenuSlug() ) {
					$module_name_html .=
						'<p>'.
						'<a href="' . admin_url( 'admin.php?page=' . $menu_slug ) . '">' .
						__('Settings', Unity3::domain) .
						'</a>' .
						'</p>';
				}

				$module_description = $module->Description();

				$module_fields[] = array(
					'key' => $uid,
					'label' => '',
					'name' => $uid,
					'type' => 'group',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'layout' => 'block',
					'sub_fields' => array(
						array(
							'key' => "{$uid}_active",
							'label' => '',
							'name' => "{$uid}_active",
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '10%',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 0,
							'ui' => 1,
							'ui_on_text' => 'On',
							'ui_off_text' => 'Off',
						),
						array(
							'key' => "{$uid}_name",
							'label' => '',
							'name' => "{$uid}_name",
							'type' => 'message',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '40%',
								'class' => '',
								'id' => '',
							),
							'message' => "<p>{$module_name_html}</p>" .
							             '<p><a href="' . '#' . '"></a></p>',
							'esc_html' => 0,
						),
						array(
							'key' => "{$uid}_description",
							'label' => '',
							'name' => "{$uid}_description",
							'type' => 'message',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '40%',
								'class' => '',
								'id' => '',
							),
							'message' => "<p>{$module_description}</p>",
							'esc_html' => 0,
						),
					),
				);
			}

			acf_add_local_field_group(array(
				'key'	=> 'unity3_modules_field_group',
				'title' => 'Modules',
				'fields' => $module_fields,
				'location' => array(
					array(
						array(
							'param' => 'options_page',
							'operator' => '==',
							'value' => Unity3::$menu_slug,
						),
					),
					//todo: Need to establish location rules to check for caps()
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

	/**
	 * Attempts to get a module instance based on it's id
	 *
	 * @return Unity3_Module|null
	 */
	public function Get( $module_id ) {
		return isset($this->modules[ $module_id]) ? $this->modules[ $module_id] : null;
	}

	public function GetAllActive() {
		// get current active modules
		if (!$active_ids = get_option('unity3_modules_active')) {
			$active_ids = array(); //set an initial state
		}

		$active_modules = array();
		foreach ( $active_ids as $module_id ) {
			if (isset($this->modules[$module_id])) {
				$active_modules[$module_id] = $this->modules[$module_id];
			}
		}

		return $active_modules;
	}


	public function GetActive( $module_id ) {
		$active_modules = $this->GetAllActive();
		return isset($active_modules[$module_id]) ? $active_modules[$module_id] : null;
	}

	/**
 * Checks if the specified module_id is active
 *
 * @return bool
 */
	public function IsActive( $module_id ) {
		$active_modules = $this->GetAllActive();
		return isset($active_modules[$module_id]);
	}


	public function GetAll() {
		return $this->modules;
	}

	public function _root_plugin_activated() {
        foreach ($this->GetAllActive() as $module) {
            $module->Activate();
        }
    }

    public function _root_plugin_deactivated() {
        foreach ($this->GetAllActive() as $module) {
            $module->Deactivate();
        }
    }

	public function _module_activation() {
		$screen = get_current_screen();
		if (false !== strpos($screen->id, 'unity3-settings-general')) {
			// get all modules marked as active
			$active_modules = array();
			foreach ($_POST['acf'] as $module_field_key => $module_field_value) {
				$module_id = substr($module_field_key, strpos($module_field_key, 'unity3_module_') + 14 );
				if (unity3_modules()->Get($module_id) && $module_field_value["{$module_field_key}_active"]) {
					$active_modules[] = $module_id;
				}
			}

			// specific old field value
			if (!$prev_active_modules = get_option('unity3_modules_active')) {
				$prev_active_modules = array(); //set an initial state
			}

			//now refresh the database with the new activated modules
			update_option( 'unity3_modules_active', $active_modules, true );

			$all_module_ids = array_unique(array_merge($active_modules, $prev_active_modules));

			foreach ($all_module_ids as $module_id) {
				//if the current module was not previously active, fire the activation function on the module
				if ( !in_array( $module_id, $prev_active_modules) ) {
					$this->Get($module_id)->Activate();
				} elseif ( !in_array( $module_id, $active_modules) ) {
					$this->Get($module_id)->Deactivate();
				}
			}
		}
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