<?php
abstract class Unity3_Module {


	protected $id, $name, $description, $sanitized_id, $settings, $attached_plugins, $plugin_scopes, $acf_settings_menu_slug;
	public function __construct( $id, $name, $description ) {
		if ( empty( $id ) || empty( $name ) ) {
			die('You must specify an ID and a Name for this module!');
		}

		if (!isset($this->settings))
			$this->settings = array();

		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->sanitized_id = sanitize_title($id);
		$this->acf_settings_menu_slug = null; //'_dummy_slug'; //do not remove
	}

	public function ID() {
		return $this->id;
	}

	public function Name() {
		return $this->name;
	}

	public function Description() {
		return $this->description;
	}

	public function IsActive() {
		return unity3_modules()->IsActive($this->id);
	}
	public function Activate() {}
	public function Deactivate(){}

	public function Init() {

		//if ACF is disabled on the front end, this function will not exist
		if(function_exists('acf_add_local_field_group') ) {

			if ( is_admin() ) {
				//override empty any module setting with an empty setting to the default value
				add_filter( 'acf/load_value', function ($value, $post_id, $field) {
					if ( empty($value) && isset($field['default_value']) && 0 === strpos( $field['key'], $this->sanitized_id)){
						// Use field's default_value if $value belongs to this module and the value is empty
						$value = $field['default_value'];
					}
					return $value;
				}, 10, 3);
			}

			add_action( 'wp_loaded', function () { $this->wpLoaded(); });
		}
	}

	protected function wpLoaded() {
		if ( is_admin() ) {

			//========== Settings ===============
			if ($settings_fields = $this->getSettingsFields()) {
				//the admin menu args
				$menu_args = apply_filters( 'unity3/module/settings/menu',  array(
					'page_title'    => $this->Name() . ' - Settings',
					'menu_title'    => $this->Name(),
					'menu_slug'		=> 'unity3-settings-' . $this->sanitized_id,
					'parent_slug'   => Unity3::$menu_slug,
					'autoload'      => true,
				), $this->ID() );
				$page = acf_add_options_sub_page( $menu_args );
				$this->acf_settings_menu_slug = $page['menu_slug'];

				//Add the settings field group
				acf_add_local_field_group(array(
					'key'      => $this->sanitized_id . '_settings',
					'name'     => $this->sanitized_id . '_settings',
					'title'    => 'Settings',
					'fields'   => $settings_fields,
					'location' => array(
						array(
							array(
								'param'    => 'options_page',
								'operator' => '==',
								'value'    => $this->acf_settings_menu_slug
							),
						),
					),
				));
			}
			// ============= END Settings =====================
		}

		//Init the ACF Groups
		$acf_groups = apply_filters( 'unity3/module/acf_groups', $this->ACFGroups(), $this->ID() );
		if (isset($acf_groups) && is_array($acf_groups)) {
			foreach ( $acf_groups as $group_id => $group) {
				$group['key'] = $group_id;
				acf_add_local_field_group( $group );
			}
		}

//		/*
//		 * Init the plugins that are attached to this module
//		*/
//		$attached_plugins = $this->GetAttachedPlugins();
//		if ( $attached_plugins && is_array($attached_plugins) ) {
//
//			//We will now loop through the list of plugin data that has been sorted by scope priority.
//			//If a plugin is valid in the specified scope, it's id and the stored args will be load.
//			foreach($attached_plugins as $data) {
//
//				//now let's try to load the actual plugin
//				$plugin = unity3_modules()->GetPlugin( $data["{$this->sanitized_id}_plugins_subfield_plugin"] );
//				//one final check to make sure that the plugin still exists and that it still supports this module
//				if ( isset($plugin) && $plugin->Supports( $this->ID() ) ) {
//					$plugin->Init();
//				}
//			}
//		}
	}

	public function GetSettingsMenuSlug() {
		return $this->acf_settings_menu_slug;
	}

	protected function getSettingsFields( ) {
		$fields = array();

		$fields['menu_title'] = array(
			'key' => $this->ID() . '_menu_title',
			'label' => 'Menu Title',
			'name' => $this->ID() . '_menu_title',
			'type' => 'text',
			'instructions' => 'Sets the admin menu title',
			'required' => 0,
			'wrapper' => array(
				'width' => '40%',
				'class' => '',
				'id' => '',
			),
			'placeholder' => $this->Name(),
			'default_value' => $this->Name(),
		);

		$fields['menu_position'] =	array(
			'key' => $this->ID() . '_menu_position',
			'label' => 'Menu Position',
			'name' => $this->ID() . '_menu_position',
			'type' => 'number',
			'instructions' => 'Sets the admin menu position',
			'required' => 0,
			'wrapper' => array(
				'width' => '20%',
				'class' => '',
				'id' => '',
			),
			'placeholder' => 10,
			'default_value' => 10,
		);

		$fields['menu_icon'] =	array(
			'key' => $this->ID() . '_menu_icon',
			'label' => 'Menu Icon',
			'name' => $this->ID() . '_menu_icon',
			'type' => 'text',
			'instructions' => 'Sets the admin menu icon',
			'required' => 0,
			'wrapper' => array(
				'width' => '40%',
				'class' => '',
				'id' => '',
			),
			'placeholder' => 'dashicons-admin-generic',
			'default_value' => 'dashicons-admin-generic',
		);

		return $fields;

	}


	protected function getPluginScopes() {
		$scopes = array();
		$scopes['global'] = array(
			'priority' => 1,
			'acf'	   => array(
				'label' => 'Global',
				'type' => 'message',
				'instructions' => "Controls {$this->name} on a global scope. (unless a more specfic scope is chosen)",
			),
			'validation_callback' => '__return_true' //global scope is always valid. (A post type scope would need to compare post types)
		);
		return $scopes;
	}
	
//	private function _getPluginScopes() {
//		if ( !isset( $this->plugin_scopes )) {
//			$this->plugin_scopes = apply_filters('unity3/module/plugin/scopes', $this->getPluginScopes() );
//		}
//
//		if ( !isset( $this->plugin_scopes ) || !is_array($this->plugin_scopes) )
//			$this->plugin_scopes = array();
//
//		//Sort scopes by priority
//		uasort($this->plugin_scopes, function ($item1, $item2) {
//			if ($item1['priority'] == $item2['priority']) return 0;
//			return $item1['priority'] < $item2['priority'] ? -1 : 1;
//		});
//
//		return $this->plugin_scopes;
//	}

	//Gets the plugins that have been attached to this module (From the Module Settings page)
//	public function GetAttachedPlugins() {
//
//		if ( is_null( $this->attached_plugins ) ) {
//
//			$this->attached_plugins = get_field($this->sanitized_id . '_plugins_field_plugins', 'options', false);
//
//			//loads the plugin scopes and stores them in a protected var: $this->plugin_scopes;
//			$this->_getPluginScopes();
//
//			//Sort the saved list of plugins by their scope priority values
//			if ( is_array($this->attached_plugins) ) {
//				uasort($this->attached_plugins, function ($item1, $item2) {
//					//we have a scope_id stored in both item1 and item2. We first check to make sure that both of these
//					//scope ids are valid and make sure that the priorities are not of equal value
//					if ( isset($this->plugin_scopes[$item1['scope_id']]) &&
//					     isset($this->plugin_scopes[$item2['scope_id']]) &&
//					     $this->plugin_scopes[$item1['scope_id']]['priority'] != $this->plugin_scopes[$item2['scope_id']]['priority'] ) {
//						return $this->plugin_scopes[$item1['scope_id']]['priority'] < $this->plugin_scopes[$item2['scope_id']]['priority'] ? -1 : 1;
//					} //else
//
//					return 0;
//				});
//
//				foreach($this->attached_plugins as $key => $c) {
//					$this->attached_plugins[$key]['plugin_settings'] = empty($c['plugin_settings']) ? array() : shortcode_parse_atts( $c['plugin_settings'] ); //converts stored values in att format to array
//				}
//			} else {
//				$this->attached_plugins = false;
//			}
//		}
//
//		return $this->attached_plugins;
//	}
//
//	protected function doPlugin( $data ) {
//		//Attempts to load one plugin from the saved scopes
//		$uid = $this->sanitized_id . '_plugins_field_plugins';
//
//		$attached_plugins = $this->GetAttachedPlugins();
//		$plugin_id = '';
//		$plugin_settings = '';
//
//
//		if ( $attached_plugins ) {
//
//			//We will now loop through the list of plugin data that has been sorted by scope priority.
//			//If a plugin is valid in the specified scope, it's id and the stored args will be load.
//			foreach($attached_plugins as $data) {
//
//				if ( isset($this->plugin_scopes[$data['scope_id']]['validation_callback']) &&
//					  is_callable($this->plugin_scopes[$data['scope_id']]['validation_callback']) &&
//				   	  $is_valid = call_user_func( $this->plugin_scopes[$data['scope_id']]['validation_callback'], $data )
//				    ) {
//					$plugin_id = $data['plugin_id'];
//					$plugin_settings = $data['plugin_settings'];
//				}
//			}
//		}
//
//		//now let's try to load the actual plugin
//		$plugin = unity3_modules()->GetPlugin( $plugin_id );
//		//one final check to make sure that the plugin still exists and that it still supports this module
//		if ( isset($plugin) && $plugin->Supports( $this->ID() ) ) {
//			//let the plugin do the rendering and return the results. If the plugin returns false, the module will handle rendering
//			return $plugin->Render( array(
//				'data' 		=> $data,
//				'settings'	=> $plugin_settings
//			));
//		}
//		//else
//		return false;
//	}

	protected function acfGroups( ) {

		$groups = array();
		// //============= Plugins  ======================
//
//		//Get all plugins that support this module
//		$uid            = $this->sanitized_id . '_plugins';
//		$plugin_choices = unity3_modules()->GetPlugins( $this->ID() );
//		$scopes         = $this->_getPluginScopes();
//
//		//Specify required ACF data
//		foreach ( $scopes as $scope_id => $values ) {
//			$scope_choices[ $scope_id ]                      = $values['acf']['label'];
//			$scopes[ $scope_id ]['acf']['key']               = "{$uid}_subfield_scope_{$scope_id}";
//			$scopes[ $scope_id ]['acf']['name']              = "scope_field_{$scope_id}";
//			$scopes[ $scope_id ]['acf']['conditional_logic'] = array(
//				array(
//					array(
//						'field'    => "{$uid}_subfield_scope",
//						'operator' => '==',
//						'value'    => $scope_id,
//					),
//				),
//			);
//		}
//
//		//Create a new "Plugins" group
//		$groups[ $uid ] = array(
//			'title'                 => 'Plugins',
//			'fields'                => array(
//				array(
//					'label'             => '',
//					'key'               => "{$uid}_field_plugins",
//					'name'              => "{$uid}_field_plugins",
//					'type'              => 'repeater',
//					'instructions'      => '',
//					'required'          => 0,
//					'conditional_logic' => 0,
//					'wrapper'           => array(
//						'width' => '',
//						'class' => '',
//						'id'    => '',
//					),
//					'collapsed'         => "{$uid}_subfield_plugin",
//					'min'               => 0,
//					'max'               => 0,
//					'layout'            => 'block',
//					'button_label'      => 'Add Plugin',
//					'sub_fields'        => array(
//						array(
//							'label'             => 'Plugin',
//							'key'               => "{$uid}_subfield_plugin",
//							'name'              => "plugin_id",
//							'type'              => 'select',
//							'instructions'      => '',
//							'required'          => 1,
//							'conditional_logic' => 0,
//							'wrapper'           => array(
//								'width' => '',
//								'class' => '',
//								'id'    => '',
//							),
//							'choices'           => $plugin_choices,
//							'allow_null'        => 0,
//							'multiple'          => 0,
//							'ui'                => 1,
//							'ajax'              => 0,
//							'return_format'     => 'value',
//							'placeholder'       => '',
//						),
//						array(
//							'label'             => 'Scope',
//							'key'               => "{$uid}_subfield_scope",
//							'name'              => "scope_id",
//							'type'              => 'radio',
//							'instructions'      => '',
//							'required'          => 1,
//							'conditional_logic' => 0,
//							'wrapper'           => array(
//								'width' => '50',
//								'class' => '',
//								'id'    => '',
//							),
//							'choices'           => $scope_choices,
//							'allow_null'        => 0,
//							'other_choice'      => 0,
//							'default_value'     => 'global',
//							'layout'            => 'vertical',
//							'return_format'     => 'value',
//							'save_other_choice' => 0,
//						),
//						array(
//							'label'             => 'Plugin Settings',
//							'key'               => "{$uid}_plugin_settings",
//							'name'              => "plugin_settings",
//							'type'              => 'text',
//							'instructions'      => 'Settings are stored in shortcode attribute format. (example: color="white")',
//							'required'          => 0,
//							'conditional_logic' => 0,
//							'wrapper'           => array(
//								'width' => '',
//								'class' => '',
//								'id'    => '',
//							),
//							'default_value'     => '',
//							'placeholder'       => '',
//							'prepend'           => '',
//							'append'            => '',
//							'maxlength'         => '',
//						),
//					),
//				),
//			),
//			'location'              => array(
//				array(
//					array(
//						'param'    => 'options_page',
//						'operator' => '==',
//						'value'    => $this->acf_settings_menu_slug,
//					),
//				),
//			),
//			'menu_order'            => 100,
//			'position'              => 'normal',
//			'style'                 => 'default',
//			'label_placement'       => 'top',
//			'instruction_placement' => 'label',
//			'hide_on_screen'        => '',
//			'active'                => true,
//			'description'           => '',
//		);
//		//insert plugin scopes into ACF...
//		array_splice( $groups[ $uid ]['fields'][0]['sub_fields'], 2, 0, array_column( $scopes, 'acf' ) );
//		//============ End Plugins  ==================

		return $groups;
	}

	protected function mergeSettings( $args ) {
		if (isset($args) && is_array($args))
			$this->settings = array_merge_recursive_distinct($this->settings, $args);
	}
}