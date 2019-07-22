<?php


class Unity3_Post_Type {

	private $post_type, $singular, $plural, $activated;
	protected $settings;
	protected $custom_fields_id;


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

	public function Activate( $args ) {

		if ($this->activated)
			return false; //did not activate because it's already been activated

		unity3_register_post_type(
			$this->GetPostType(),
			$this->singular,
			$this->plural,
			$this->settings
		);

		apply_filters('unity3_dragsortposts', array());

		//allow the adding of Advanced Custom Fields
		$fields = apply_filters( 'unity3/post/fields', $this->GetFields(), $this->GetPostType() );

		//allow the fields to be overridden by a custom set of fields
		if (isset($args['fields'])) {
			$fields = apply_filters( "unity3/post/fields/{$args['fields']}", $fields, $this->GetPostType() );
		}

		if( isset($fields) && is_array($fields) && function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => "{$this->GetPostType()}_acf_group",
				'title' => 'Fields',
				'fields' => $fields,
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => $this->GetPostType(),
						),
					),
				),
				'style' => 'seamless',
				'hide_on_screen' => array(
					'permalink',
					'the_content',
					'excerpt',
					'custom_fields',
					'discussion',
					'comments',
					'slug',
					'author',
					'format',
					'page_attributes',
					'featured_image',
					'revisions',
					'Groups',
					'tags',
					'send-trackbacks'
				)
			));

		endif;



		return $this->activated = true;
	}

	public function IsActivated() {
		return $this->activated;
	}

	public function GetFields() {
		return null;//should be overridden by inherited class
	}

}