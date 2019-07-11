<?php


class Unity3_Post_Type {

	private $post_type, $singular, $plural, $activated;
	protected $settings;

	public function __construct( $post_type, $singular, $plural ) {

		if (!isset( $post_type ) || !isset( $singular ) || !isset( $plural )) {
			die('Required initialization data for the post type was not specified!');
		}

		$this->post_type = $post_type;
		$this->singular = $singular;
		$this->plural = $plural;

		$this->settings = wp_parse_args( $this->settings, array(
			'page_title'    => $this->plural,
			'menu_title'    => $this->plural,
			'menu_position' => 12,
			'menu_icon'     => 'dashicons-admin-media',
		) );
	}

	public function GetPostType() {
		return $this->post_type;
	}

	public function GetPostTypeObject() {
		return get_post_type_object($this->GetPostType());
	}

	protected function beforeActivate() { }

	public function Activate() {

		if ($this->activated)
			return false; //did not activate because it's already been activated

		unity3_register_post_type(
			$this->GetPostType(),
			$this->singular,
			$this->plural,
			$this->settings
		);

		apply_filters('unity3_dragsortposts', array());

		return $this->activated = true;
	}

	public function IsActivated() {
		return $this->activated;
	}

}