<?php

class Unity3ModuleController {

	protected $id, $name, $module_id;
	private $initialized = false;

	public function __construct( $id, $name, $module_id) {
		if ( empty( $id ) || empty($name) || empty($module_id) ) {
			die('Insufficient data for initializing this controller!');
		}
		$this->id = $id;
		$this->name = $name;
		$this->module_id = $module_id;

		//do_action( "update_option_{$option}", $old_value, $value, $option );

//		if (is_admin()) {
//			add_action('unity3/modules/controller/activate', array(&$this, 'Activate'));
//
//			if ( $module = unity3_modules()->Get($module_id) ) {
//				if (is_subclass_of($module, 'Unity3_Post_Type') ) {
//					add_action('unity3');
//				}
//			}
//		}
	}

	public function Init() {
		if ($this->initialized) {
			return false;
		}

		return $this->initialized = true;
	}

	public function ID() {
		return $this->id;
	}

	public function Name() {
		return $this->name;
	}

	public function Supports( $module_id ) {
		return $module_id == $this->module_id;
	}

	public function Render( $args ) {
		return false; //has not handled the render request
	}
}