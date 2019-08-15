<?php


class Unity3_Module {

	protected $id, $settings, $args, $activated;

	public function __construct( $id ) {
		if ( !isset( $id ) ) {
			die('You must specify an ID for this module!');
		}
		$this->id = $id;
	}

	public function ID () {
		return $this->id;
	}

	public function Activate( $args ) {

		if ($this->activated)
			return false; //did not activate because it's already been activated

		$this->args = $args;

		return $this->activated = true;
	}

	public function IsActivated() {
		return $this->activated;
	}

}