<?php

class Unity3_Module_Plugin {

	protected $id, $name, $module_id;
	private $initialized = false;

	public function __construct( $id, $name, $module_id) {
		if ( empty( $id ) || empty($name) || empty($module_id) ) {
			die('Insufficient data for initializing this controller!');
		}
		$this->id = $id;
		$this->name = $name;
		$this->module_id = $module_id;
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