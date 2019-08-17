<?php


class Unity3_Module {

	protected $id, $settings, $args, $activated;

	public function __construct( $id ) {
		if ( !isset( $id ) ) {
			die('You must specify an ID for this module!');
		}

		if (!isset($this->settings))
			$this->settings = array();

		$this->id = $id;
		$this->activated = false;
	}

	public function ID () {
		return $this->id;
	}

	public function Activate( $args ) {

		if ($this->activated)
			return false; //did not activate because it's already been activated

		$this->args = $args;
		$this->mergeSettings( $args );
		$this->doActivate();
		return $this->activated = true;
	}

	protected function mergeSettings( $args ) {
		if (isset($args) && is_array($args))
			$this->settings = array_merge_recursive_distinct($this->settings, $args);
	}

	protected function doActivate() { }

	public function IsActivated() {
		return $this->activated;
	}

}