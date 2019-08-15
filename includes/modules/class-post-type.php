<?php


class Unity3_Post_Type extends Unity3_Module {

	private $singular, $plural;


	public function __construct( $post_type, $singular, $plural ) {
		parent::__construct( $post_type );


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
		return $this->id;
	}

	public function GetPostTypeObject() {
		return get_post_type_object($this->GetPostType());
	}

	protected function beforeActivate() { }

	public function Activate( $args ) {
		if (!parent::Activate( $args )) {
			return false;
		}

		add_filter( 'post_updated_messages', array($this, 'post_updated_messages') );


		//allow runtime args to override the post type settings
		if (isset($args['post_type_settings'])) {
			$this->settings = array_merge_recursive_distinct($this->settings, $args['post_type_settings']);
		}

		unity3_register_post_type(
			$this->GetPostType(),
			$this->singular,
			$this->plural,
			$this->settings
		);

		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group( apply_filters('unity3/post/field_group', array(
				'key' => "{$this->GetPostType()}_acf_group",
				'title' => 'Fields',
				'fields' => $this->_getFields( $args ),
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
			)), $this->GetPostType() );

		endif;

		return $this->activated = true;
	}

	public function post_updated_messages( $messages ) {
		$obj = $this->GetPostTypeObject();
		$singular = $obj->labels->singular_name;

		$messages[$this->GetPostType()]  = array(
			0  => '', // Unused. Messages start at index 1.
			1  => sprintf( __( '%s updated.' ), $singular ),//__( "Post updated." ) . $view_post_link_html,
			2  => __( 'Custom field updated.' ),
			3  => __( 'Custom field deleted.' ),
			4  => sprintf( __( '%s updated.' ), $singular ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Restored to revision from %s.' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => sprintf( __( '%s published.' ), $singular ),
			7  => sprintf( __( '%s saved.' ), $singular ),
			8  => sprintf( __( '%s submitted.' ), $singular ),
			9  => sprintf( __( '%s scheduled' ), $singular ),
			10 => sprintf( __( '%s draft updated.' ), $singular ),
		);
		return $messages;
	}

	private function _getFields( $args ) {

		//allow the fields to be overridden by a custom set of fields
		if (isset($args['fieldset'])) {
			return apply_filters( "unity3/post/fieldset/{$args['fieldset']}", null, $this->GetPostType() );
		} else {
			//allow the adding of Advanced Custom Fields
			return apply_filters( 'unity3/post/fields', $this->GetFields(), $this->GetPostType() );
		}
	}

	public function GetFields() {
		return null;//should be overridden by inherited class
	}

	public function GetHideOnScreen() {
		return null;//should be overridden by inherited class
	}

}




//quick functions
function unity3_register_post_type($slug, $singular, $plural, $args = array(), $merge_distinct = true) {
	$defaults = array(
		'label' => $plural,
		'labels' => array(
			'name' => $plural,
			'singular_name' => $singular,
			'menu_name' => $plural,
			'add_new' => "Add New $singular",
			'add_new_item' => "Add New $singular",
			'edit_item' => "Edit $singular",
			'new_item' => "New $singular",
			'view_item' => "View $singular",
			'view_items' => "View $plural",
			'search_items' => "Search $plural",
			'not_found' => "No $plural found",
			'not_found_in_trash' => "No $plural found in Trash",
			'all_items' => "All $plural",
			'archives' => "$singular Archives",
			'attributes' => "$singular Attributes",
			'insert_into_item' => "Insert into $singular"
		),
		'description' => '',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_rest' => false,
		'has_archive' => true,
		'show_in_menu' => true,
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => $slug, 'with_front' => true ),
		'query_var' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	);
	$args = $merge_distinct ? array_merge_recursive_distinct($defaults, $args) : array_merge($defaults, $args);

	if (isset($args['menu_bubble'])) {
		$post_status = $args['menu_bubble'];
		global $unity3_ctp_bubbles;
		if (!isset($unity3_ctp_bubbles))
			$unity3_ctp_bubbles = array();

		if ( false === ( $count = get_transient( "cpt_menu_bubble_{$slug}"  ) ) ) { //menu_bubble tells us the post_status to retrieve
			global $wpdb;
			$count = $wpdb->get_var( "SELECT COUNT(ID) as count FROM {$wpdb->post} WHERE `post_status`='{$post_status}' AND `post_type`='{$slug}'" );

			set_transient( "cpt_menu_bubble_{$slug}", $count, 1 * YEAR_IN_SECONDS );
		}

		$unity3_ctp_bubbles["edit.php?post_type={$slug}"] = $count;
	}

	return register_post_type($slug, $args);
}

function unity3_register_taxonomy($slug, $singular, $plural, $args = array(), $merge_distinct = true) {

}

