<?php
//
class Unity3_Audio extends Unity3_Post_Group {

	public function __construct( ) {
		parent::__construct('unity3_audio', 'Audio File', 'Audio Files');

		$this->settings = wp_parse_args( array(
			'menu_position' => 12,
			'menu_icon'     => 'dashicons-controls-volumeon',
			'menu_title'    => 'Audio'
		), $this->settings );
	}

	public function Activate( $args ) {
		if (!parent::Activate( $args )) {
			return false;
		}

		//The client should be a be paying for the audio add-on package
		add_filter( 'upload_mimes',  array( &$this, 'unity3_aws_storage_mime'), 12, 1 );


		return true;
	}

	public function unity3_aws_storage_mime( $types ) {
	   return array_merge($types, array(
	     // Audio formats.
	     'mp3|m4a|m4b' => 'audio/mpeg',
	     'ogg|oga' => 'audio/ogg',
	     'wma' => 'audio/x-ms-wma',
	   ));
	 }

	public function GetFields() {
		return array (
			array(
				'key' => 'field_5d3b597197c47',
				'label' => 'File',
				'name' => 'audio',
				'type' => 'file',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'library' => 'all',
				'min_size' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		);
	}
}

////*************************
////       Register
////*************************
unity3_post_types()->Register(new Unity3_Audio());



