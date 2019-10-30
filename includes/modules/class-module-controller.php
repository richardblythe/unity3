<?php

class Unity3ModuleController {

	protected $id, $name, $module_id;

	public function __construct( $id, $name, $module_id) {
		if ( empty( $id ) || empty($name) || empty($module_id) ) {
			die('Insufficient data for initializing this controller!');
		}
		$this->id = $id;
		$this->name = $name;
		$this->module_id = $module_id;
		
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