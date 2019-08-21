<?php


class Unity3_Post_Type extends Unity3_Module {

	public function __construct( $post_type, $singular, $plural ) {
		parent::__construct( $post_type );


		if (!isset( $singular ) || !isset( $plural )) {
			die('Required initialization data for the post type was not specified!');
		}

		$this->mergeSettings( array(
			'post' => array(
				'labels' => array(
					'name' => $plural,
					'singular_name' => $singular,
				),
				'page_title'    => $plural,
				'menu_title'    => $plural,
				'menu_position' => 12,
				'menu_icon'     => 'dashicons-admin-media',
			),
			'admin_columns' => false, //array('key' => array('title' => '', 'image_size' => 'thumbnail');
			'admin_inline_styles' => array(),
		) );
	}

	public function GetPostType() {
		return $this->id;
	}

	public function GetPostTypeObject() {
		return get_post_type_object($this->GetPostType());
	}

	public function doActivate( ) {
		parent::doActivate();

		if ( $this->settings['admin_columns'] ) {
			add_filter( "manage_{$this->GetPostType()}_posts_custom_column", array(&$this, "admin_post_columns_content" ) );
			add_filter( "manage_{$this->GetPostType()}_posts_columns", array(&$this, "admin_post_columns") );
			add_action( 'admin_footer', array(&$this, '_admin_inline_scripts_styles') );
		}
		add_filter( 'post_updated_messages', array($this, 'post_updated_messages') );

		unity3_register_post_type(
			$this->GetPostType(),
			$this->settings['post']['labels']['singular_name'],
			$this->settings['post']['labels']['name'],
			$this->settings['post']
		);

		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group( apply_filters('unity3/post/field_group', array(
				'key' => "{$this->GetPostType()}_acf_group",
				'title' => 'Fields',
				'fields' => $this->_getFields(),
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

	function _admin_inline_scripts_styles() {

		$styles = isset($this->settings['admin_inline_styles']) ? $this->settings['admin_inline_styles'] : false;

		if ( is_array($styles) && count($styles) ) {

			$css = '';

			foreach ($styles as $selector => $value) {
				$css .= ($selector . ' {' . $value . ' }');
			}

			echo "<style>$css</style>";
		}

	}

	function admin_post_columns( $columns ) {
		//Get access to the current post being listed
		global $post;
		//Get the ID of that post
		$post_id = $post->ID;
		$new_cols = array();

		foreach ($this->settings['admin_columns'] as $key => $column) {
			$field = isset($column['acf']) ? get_field_object($column['acf'], $post_id, false) : null;

			if (isset($column['header']))
				$new_cols[$key] = $column['header'];
			else if (isset($field['name']))
				$new_cols[$key] = $field['name'];
		}

		return count($new_cols) ? $new_cols : $columns;
	}


	function admin_post_columns_content( $column_key ) {
		//Get access to the current post being listed
		global $post;
		//Get the ID of that post
		$post_id = $post->ID;


		foreach ($this->settings['admin_columns'] as $key => $col) {
			if ($column_key != $key)
				continue;

			$field = isset($col['acf']) ? get_field_object($col['acf'], $post_id, false) : null;
			$html = '';
			if (isset($field)) {
				switch ($field['type']) {
					case 'image':

						$image_size = isset($col['image_size']) ? $col['image_size'] : 'thumbnail';
						$html = wp_get_attachment_image(
							$field['value'],
							$image_size
						);
						break;
					default:
						$html = get_field($col['acf'], $post_id);
				}
			}

			echo apply_filters('unity3/post/column/content', $html, $column_key, $post_id);
		}
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

	private function _getFields( ) {

		//allow the fields to be overridden by a custom set of fields
		if (isset($this->settings['fieldset'])) {
			return apply_filters( "unity3/post/fieldset/{$this->settings['fieldset']}", null, $this->GetPostType() );
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

function unity3_register_taxonomy($taxonomy, $object_type, $singular, $plural, $args = array(), $merge_distinct = true) {
	$defaults = array(
		'labels' => array(
			'name'                       => _x( $plural, 'taxonomy general name', 'textdomain' ),
			'singular_name'              => _x( $singular, 'taxonomy singular name', 'textdomain' ),
			'search_items'               => sprintf( __( 'Search %s', 'unity3' ), $plural ),
			'popular_items'              => sprintf( __( 'Popular %s', 'unity3' ), $plural ),//__( 'Popular Groups', 'textdomain' ),
			'all_items'                  => sprintf( __( 'All %s', 'unity3' ), $plural ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => sprintf( __( 'Edit %s', 'unity3' ), $singular ),
			'update_item'                => sprintf( __( 'Update %s', 'unity3' ), $singular ),
			'add_new_item'               => sprintf( __( 'Add New %s', 'unity3' ), $singular ),
			'new_item_name'              => sprintf( __( 'New %s Type', 'unity3' ), $singular ),
			'separate_items_with_commas' => sprintf( __( 'Separate %s with commas', 'unity3' ), $plural ),
			'add_or_remove_items'        => sprintf( __( 'Add or remove %s', 'unity3' ), $plural ),
			'choose_from_most_used'      => sprintf( __( 'Choose from the most used %s', 'unity3' ), $plural ),
			'not_found'                  => sprintf( __( 'No %s found', 'unity3' ), $plural ),
			'menu_name'                  => sprintf( __( 'All %s', 'unity3' ), $plural ),
		),
		'hierarchical'          => true,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'query_var'             => true,
	);

	$args = $merge_distinct ? array_merge_recursive_distinct($defaults, $args) : array_merge($defaults, $args);

    return register_taxonomy( $taxonomy, $object_type, $args );
}

