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

	protected function acfGroups( ) {
		return array();
	}

	protected function mergeSettings( $args ) {
		if (isset($args) && is_array($args))
			$this->settings = array_merge_recursive_distinct($this->settings, $args);
	}
}