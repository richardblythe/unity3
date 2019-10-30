<?php
class Unity3_Module {

	protected $id, $name, $sanitized_id, $settings, $attached_controllers, $controller_scopes, $acf_settings_menu_slug;

	public function __construct( $id, $name ) {
		if ( empty( $id ) || empty( $name ) ) {
			die('You must specify an ID and a Name for this module!');
		}

		if (!isset($this->settings))
			$this->settings = array();

		$this->id = $id;
		$this->name = $name;
		$this->sanitized_id = sanitize_title($id);
	}

	public function ID() {
		return $this->id;
	}

	public function Name() {
		return $this->name;
	}

	public function Init() {
		$menu_args = $this->GetSettingsMenu();
		if (is_admin() && is_array($menu_args) && function_exists('acf_add_options_sub_page')) {
			$menu_args = array_merge( array(
				'page_title'  => $this->sanitized_id . ' Page Title',
				'menu_title'  => $this->sanitized_id . ' Menu Title',
				'parent_slug' => Unity3::$menu_slug,
				'autoload'    => true,
			), $menu_args );
			$page = acf_add_options_sub_page( $menu_args );
			$this->acf_settings_menu_slug = $page['menu_slug'];
		}

		//if ACF is disabled on the front end, this function will not exist
		if(function_exists('acf_add_local_field_group') ) {
			
			$acf_groups = apply_filters( 'unity3/module/acf_groups', $this->ACFGroups( array() ), $this->ID() );
			if (isset($acf_groups) && is_array($acf_groups)) {
				foreach ( $acf_groups as $group_id => $group) {
					$group['key'] = $group_id;
					acf_add_local_field_group( $group );
				}
			}
		}
	}
	
	protected function getSettingsMenu() { 
		return array(
			'page_title' 	=> $this->Name() . ' Page Title',
			'menu_title'	=> $this->Name() . ' Menu Title',
			'menu_slug'		=> 'unity3-settings-' . $this->sanitized_id,
			'parent_slug'	=> Unity3::$menu_slug,
		);
	}

	protected function getSettingsFields() { return array(); }

	protected function getControllerScopes() {
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
	
	private function _getControllerScopes() {
		if ( !isset( $this->controller_scopes )) {
			$this->controller_scopes = apply_filters('unity3/module/controller/scopes', $this->getControllerScopes() );
		}

		if ( !isset( $this->controller_scopes ) || !is_array($this->controller_scopes) )
			$this->controller_scopes = array();

		//Sort scopes by priority
		uasort($this->controller_scopes, function ($item1, $item2) {
			if ($item1['priority'] == $item2['priority']) return 0;
			return $item1['priority'] < $item2['priority'] ? -1 : 1;
		});

		return $this->controller_scopes;
	}

	//Gets the controllers that have been attached to this module (From the Module Settings page)
	public function GetAttachedControllers() {
		
		if ( !$this->attached_controllers ) {

			$this->attached_controllers = get_field($this->sanitized_id . '_controllers_field_controllers', 'options');

			//loads the controller scopes and stores them in a protected var: $this->controller_scopes;
			$this->_getControllerScopes();

			//Sort the saved list of controllers by their scope priority values
			uasort($this->attached_controllers, function ($item1, $item2) {
				//we have a scope_id stored in both item1 and item2. We first check to make sure that both of these
				//scope ids are valid and make sure that the priorities are not of equal value
				if ( isset($this->controller_scopes[$item1['scope_id']]) && 
					 isset($this->controller_scopes[$item2['scope_id']]) &&
					 $this->controller_scopes[$item1['scope_id']]['priority'] != $this->controller_scopes[$item1['scope_id']]['priority'] ) {
						return $this->controller_scopes[$item1['scope_id']]['priority'] < $this->controller_scopes[$item2['scope_id']]['priority'] ? -1 : 1;
				} //else
				
				return 0;
			});

			foreach($this->attached_controllers as $key => $c) {
				$this->attached_controllers[$key]['controller_settings'] = empty($c['controller_settings']) ? array() : shortcode_parse_atts( $c['controller_settings'] ); //converts stored values in att format to array
			}
		}

		return $this->attached_controllers;
	}

	protected function doController( $data ) {
		//Attempts to load one controller from the saved scopes
		$uid = $this->sanitized_id . '_controllers_field_controllers';

		$attached_controllers = $this->GetAttachedControllers();
		$controller_id = '';
		$controller_settings = '';
		
		
		if ( $attached_controllers ) {

			//We will now loop through the list of controller data that has been sorted by scope priority.  
			//If a controller is valid in the specified scope, it's id and the stored args will be load.
			foreach($attached_controllers as $data) {

				if ( isset($this->controller_scopes[$data['scope_id']]['validation_callback']) && 
					  is_callable($this->controller_scopes[$data['scope_id']]['validation_callback']) &&
				   	  $is_valid = call_user_func( $this->controller_scopes[$data['scope_id']]['validation_callback'], $data )
				    ) {
					$controller_id = $data['controller_id'];
					$controller_settings = $data['controller_settings'];
				}
			}
		}

		//now let's try to load the actual controller
		$controller = unity3_modules()->GetController( $controller_id );
		//one final check to make sure that the controller still exists and that it still supports this module
		if ( isset($controller) && $controller->Supports( $this->ID() ) ) {
			//let the controller do the rendering and return the results. If the controller returns false, the module will handle rendering
			return $controller->Render( array(
				'data' 		=> $data,
				'settings'	=> $controller_settings
			));
		} 
		//else
		return false;
	}

	protected function acfGroups( $groups ) {
		if (!is_array($groups)) {
			$groups = array();
		}


		//========== Settings ===============
		$fields = $this->getSettingsFields();
		if (is_array($fields) && count($fields)) {
			$groups[$this->sanitized_id . '_settings'] = array(
				'title' => 'Settings',
				'fields' => $fields,
				'location' => array (
					array (
						array (
							'param' => 'options_page',
							'operator' => '==',
							'value' => $this->acf_settings_menu_slug
						),
					),
				),
			);
		}

		// //============= END Settings =====================

		// //============= Controllers  ======================

		//Get all controllers that support this module
		$uid = $this->sanitized_id . '_controllers';
		$controller_choices = unity3_modules()->GetControllers($this->ID());
		$scopes = $this->_getControllerScopes();
			
		//Specify required ACF data
		foreach ($scopes as $scope_id => $values) {		
			$scope_choices[$scope_id] = $values['acf']['label'];
			$scopes[$scope_id]['acf']['key'] = "{$uid}_subfield_scope_{$scope_id}";
			$scopes[$scope_id]['acf']['name'] = "scope_field_{$scope_id}";
			$scopes[$scope_id]['acf']['conditional_logic'] = array(
				array(
					array(
						'field' => "{$uid}_subfield_scope",
						'operator' => '==',
						'value' => $scope_id,
					),
				),
			);
		}
			
		if (current_user_can('manage_options')) {
			//Create a new "Controllers" group
			$groups[$uid] = array(
				'title' => 'Controllers',
				'fields' => array(
					array(
						'label' => '',
						'key' => "{$uid}_field_controllers",
						'name' => "{$uid}_field_controllers",
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' =>"{$uid}_subfield_controller",
						'min' => 0,
						'max' => 0,
						'layout' => 'block',
						'button_label' => 'Add Controller',
						'sub_fields' => array(
							array(
								'label' => 'Controller',
								'key' => "{$uid}_subfield_controller",
								'name' => "controller_id",
								'type' => 'select',
								'instructions' => '',
								'required' => 1,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => $controller_choices,
								'allow_null' => 0,
								'multiple' => 0,
								'ui' => 1,
								'ajax' => 0,
								'return_format' => 'value',
								'placeholder' => '',
							),
							array(
								'label' => 'Scope',
								'key' => "{$uid}_subfield_scope",
								'name' => "scope_id",
								'type' => 'radio',
								'instructions' => '',
								'required' => 1,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '50',
									'class' => '',
									'id' => '',
								),
								'choices' => $scope_choices,
								'allow_null' => 0,
								'other_choice' => 0,
								'default_value' => 'global',
								'layout' => 'vertical',
								'return_format' => 'value',
								'save_other_choice' => 0,
							),
							array(
								'label' => 'Controller Settings',
								'key' => "{$uid}_controller_settings",
								'name' => "controller_settings",
								'type' => 'text',
								'instructions' => 'Settings are stored in shortcode attribute format. (example: color="white")',
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
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'options_page',
							'operator' => '==',
							'value' => $this->acf_settings_menu_slug,
						),
					),
				),
				'menu_order' => 100,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			);
			//insert controller scopes into ACF...
			array_splice( $groups[$uid]['fields'][0]['sub_fields'], 2, 0, array_column($scopes, 'acf') );
			//============ End Controllers  ==================
		}
		return $groups;
	}

	protected function mergeSettings( $args ) {
		if (isset($args) && is_array($args))
			$this->settings = array_merge_recursive_distinct($this->settings, $args);
	}
}