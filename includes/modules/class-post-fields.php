<?php

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Unity3_Post_Fields {

	public function __construct( $id ) {
		add_filter("unity3/post_type/fields/{$id}", array(&$this, 'GetFields'));
	}

	public function GetFields() { }
}


