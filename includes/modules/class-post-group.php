<?php


class Unity3_Post_Group extends Unity3_Post_Type {

	protected $show_custom_group_menu;

	public function __construct( $post_type, $singular, $plural ) {
		parent::__construct( $post_type, $singular, $plural );

		$this->settings = wp_parse_args( array(
			'menu_position' => 12,
			'menu_icon'     => 'dashicons-admin-media',
			'show_in_menu' => false,
		), $this->settings );

	}

	public function GetTaxonomy() {
		return $this->GetPostType() . '_group';
	}

	public function GetTaxonomyObject() {
		return get_taxonomy($this->GetTaxonomy());
	}

	public function Activate( $args ) {
		//the $settings disables the default post type menu, but we also allow the user to turn off the custom
		//generated menu by this class.  So, we will show the menu if a setting has not been specified or if a
		//a settings is specified and the value is: true
		$this->show_custom_group_menu = true;
		if (isset($args['post_type_settings']['show_in_menu'])) {
			$this->show_custom_group_menu = $args['post_type_settings']['show_in_menu'];
			$args['post_type_settings']['show_in_menu'] = false; //prevent unwanted menus when the post type is registered
		}

		if (!parent::Activate( $args )) {
			return false;
		}

		// Add new taxonomy
		$labels = array(
			'name'                       => _x( 'Groups', 'taxonomy general name', 'textdomain' ),
			'singular_name'              => _x( 'Group', 'taxonomy singular name', 'textdomain' ),
			'search_items'               => __( 'Search Groups', 'textdomain' ),
			'popular_items'              => __( 'Popular Groups', 'textdomain' ),
			'all_items'                  => __( 'All Groups', 'textdomain' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Group', 'textdomain' ),
			'update_item'                => __( 'Update Group', 'textdomain' ),
			'add_new_item'               => __( 'Add New Group', 'textdomain' ),
			'new_item_name'              => __( 'New Group Type', 'textdomain' ),
			'separate_items_with_commas' => __( 'Separate Groups with commas', 'textdomain' ),
			'add_or_remove_items'        => __( 'Add or remove Groups', 'textdomain' ),
			'choose_from_most_used'      => __( 'Choose from the most used Groups', 'textdomain' ),
			'not_found'                  => __( 'No Groups found.', 'textdomain' ),
			'menu_name'                  => __( 'All Groups', 'textdomain' ),
		);

		$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => false,
//		    'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
//			'rewrite'               => array( 'slug' => 'Group' ),
		);

		register_taxonomy( $this->GetTaxonomy(), $this->GetPostType(), $args );


		//wire up admin functions
		if (is_admin()) {
			add_action( 'admin_body_class', array($this, 'admin_body_class'));
			add_action( 'admin_menu', array($this, 'admin_menu') );
			add_action( 'admin_notices', array($this, 'admin_notices') );
			//Customize the Taxonomy Table
			add_filter( "manage_edit-{$this->GetTaxonomy()}_columns" , array($this,'custom_columns') );
			add_filter( "manage_{$this->GetTaxonomy()}_custom_column", array($this,'custom_columns_content'),10,3);
			add_filter( 'list_table_primary_column', array($this, 'default_primary_column'), 10, 2 );
			add_filter( "{$this->GetTaxonomy()}_row_actions", array($this, 'tax_row_actions'), 10, 2);
			//			
			add_filter( 'admin_url', array($this, 'add_new_post_url'), 10, 3 );
			add_action( 'save_post', array($this, 'auto_set_group'), 100, 2 );




			//add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue') );
			//add_filter( 'unity3_dragsortposts',  array($this, 'register_drag_sort') );
		}

		return $this->IsActivated();
	}

	function add_new_post_url( $url, $path, $blog_id ) {

		if ( $path == "post-new.php?post_type={$this->GetPostType()}" ) {
			global $post;
			if ($post) {
				//get the target term from the current post
				$result = wp_get_post_terms($post->ID, $this->GetTaxonomy());
				if (count($result)) {
					$term = $result[0];
					$url = "post-new.php?post_type={$this->GetPostType()}&{$this->GetTaxonomy()}={$term->slug}";
				}
			} else {
				$url = "post-new.php?post_type={$this->GetPostType()}&{$this->GetTaxonomy()}={$this->get_current_term()}";
			}
		}

		return $url;
	}

	function auto_set_group( $post_id, $post ) {
		if ( 'auto-draft' === $post->post_status && $post->post_type == $this->GetPostType() && $this->get_current_term()) {
			wp_set_object_terms( $post_id, $this->get_current_term(), $this->GetTaxonomy() );
		}
	}


	function admin_body_class( $classes ) {
		
		if (!current_user_can('manage_options')) {
			$classes .= ' unity3-post-group-hide-add-term';
		}
		return $classes;
	}

	function admin_notices(){
		global $current_screen;
		if ( ($current_screen->id == "edit-{$this->GetPostType()}" && $this->get_current_term()) ||
		     ($current_screen->id == "edit-{$this->GetTaxonomy()}")
			) {

			$title = '';
			if ("edit-{$this->GetPostType()}" == $current_screen->id) {
				$term = get_term_by('slug', $this->get_current_term(), $this->GetTaxonomy());
				$title = $term->name;
			}
			else if ("edit-{$this->GetTaxonomy()}" == $current_screen->id) {
				$post_obj = $this->GetPostTypeObject();
				$tax_obj = $this->GetTaxonomyObject();
				$title = $post_obj->labels->singular_name . ' ' . $tax_obj->labels->name;
			}

			$class = sanitize_html_class($this->settings['menu_icon']);
			if (false !== strpos($class, 'dashicons')) {
				$class .= ' dashicons-before';
			}

			echo '<div class="unity3-post-group-header ' . $class . '"><h2 class="title">'. $title . '</h2></div>';
		}

	}


	protected function get_current_term() {
		$result = sanitize_text_field( $_GET[$this->GetTaxonomy()] );
		return empty($result) ? null : $result;
	}

	function default_primary_column($default, $screen_id) {
		return "edit-{$this->GetTaxonomy()}" == $screen_id ? 'custom_tax_edit' : $default;
	}



	function custom_columns( $columns ) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'custom_tax_edit' => __( 'Group Name' ),
			'description' => __( 'Description' )
		);

		return $columns;
	}

	function custom_columns_content($content,$column_name,$term_id){
		$term = get_term($term_id);
		switch ($column_name) {
			case 'custom_tax_edit':
				//do your stuff here with $term or $term_id
				return $this->column_name( $term );
				break;
			default:
				break;
		}
		return $content;
	}

	/**
	 * @param WP_Term $tag Term object.
	 * @return string
	 */
	protected function column_name( $tag ) {
		$screen = get_current_screen();
		$taxonomy = $screen->taxonomy;

		$pad = '';//str_repeat( '&#8212; ', max( 0, $this->level ) );

		/**
		 * Filters display of the term name in the terms list table.
		 *
		 * The default output may include padding due to the term's
		 * current level in the term hierarchy.
		 *
		 * @since 2.5.0
		 *
		 * @see WP_Terms_List_Table::column_name()
		 *
		 * @param string $pad_tag_name The term name, padded if not top-level.
		 * @param WP_Term $tag         Term object.
		 */
		$name = apply_filters( 'term_name', $pad . ' ' . $tag->name, $tag );

		$qe_data = get_term( $tag->term_id, $taxonomy, OBJECT, 'edit' );

		$uri = wp_doing_ajax() ? wp_get_referer() : $_SERVER['REQUEST_URI'];

		$edit_link = 'edit.php?post_type=' . $this->GetPostType() . "&{$this->GetTaxonomy()}=" . $tag->slug;

		$out = sprintf(
			'<strong><a class="row-title" href="%s" aria-label="%s">%s</a></strong><br />',
			esc_url( $edit_link ),
			/* translators: %s: taxonomy term name */
			esc_attr( sprintf( __( '&#8220;%s&#8221; (Edit)' ), $tag->name ) ),
			$name
		);

		$out .= '<div class="hidden" id="inline_' . $qe_data->term_id . '">';
		$out .= '<div class="name">' . $qe_data->name . '</div>';

		/** This filter is documented in wp-admin/edit-tag-form.php */
		$out .= '<div class="slug">' . apply_filters( 'editable_slug', $qe_data->slug, $qe_data ) . '</div>';
		$out .= '<div class="parent">' . $qe_data->parent . '</div></div>';

		return $out;
	}

	public function tax_row_actions( $actions, $tag ){
		$actions['edit'] = ('<a href="' . esc_url(
			'edit.php?post_type=' . $this->GetPostType() . "&{$this->GetTaxonomy()}=" . $tag->slug
		) . '">Edit</a>');

	    $tag_edit_link = esc_url( get_edit_tag_link( $tag->term_id, $tag->taxonomy) );

//	    $slice1 = array_slice($actions, 0, 3, true);
//
//	    $slice2 = array_slice($actions, 3, count($actions)-1, true);

		$actions = (array_slice($actions, 0, 1, true) +
		array("properties" => "<a href='{$tag_edit_link}'>Properties</a>") +
		array_slice($actions, 1, count($actions)-1, true));

		return $actions;
	}

	function admin_menu() {

		//remove tax metabox
		remove_meta_box( $this->GetTaxonomy() . 'div', $this->GetPostType(), 'side' );

		//if a runtime arg has been specified to hide the custom menu
		if ( !$this->show_custom_group_menu )
			return;


		$top_level_menu_slug = '';
		//Now add our taxonomies/groups to the admin menu...
		$terms = get_terms( array(
			'taxonomy' => $this->GetTaxonomy(),
			'hide_empty' => false,
		) );

		$force_single_term = null;
		if ( isset($this->args['force_single']) && !$terms instanceof WP_Error ) {
			foreach ($terms as $t) {
				if ($t->slug == $this->args['force_single']) {
					$force_single_term = $t;
					break;
				}
			}
		}

		if ( isset($force_single_term) ) {
			$top_level_menu_slug = 'edit.php?post_type=' . $this->GetPostType() . "&{$this->GetTaxonomy()}=" . $force_single_term->slug;
		} else {
			$top_level_menu_slug = "edit-tags.php?taxonomy={$this->GetTaxonomy()}&post_type={$this->GetPostType()}";
		}

		//Add the main menu
		$hook = add_menu_page(
			$this->settings['menu_title'],
			$this->settings['menu_title'],
			'edit_others_posts',
			$top_level_menu_slug,
			'',
			$this->settings['menu_icon'],
			$this->settings['menu_position']
		);


		if ( isset($force_single_term) ) {

			//Add the all items menu
			$post_obj = $this->GetPostTypeObject();
			add_submenu_page(
				$top_level_menu_slug,
				$post_obj->labels->all_items,
				$post_obj->labels->all_items,
				'edit_others_posts',
				'edit.php?post_type=' . $this->GetPostType() . "&{$this->GetTaxonomy()}=" . $force_single_term->slug,
				''
			);

			//create the Add New menu
			add_submenu_page(
				$top_level_menu_slug,
				$post_obj->labels->add_new_item,
				$post_obj->labels->add_new_item,
				'edit_others_posts',
				'post-new.php?post_type=' . $this->GetPostType() . "&{$this->GetTaxonomy()}=" . $force_single_term->slug,
				''
			);

		} else {
			$tax = $this->GetTaxonomyObject();

			add_submenu_page(
				$top_level_menu_slug,
				$tax->labels->menu_name,
				$tax->labels->menu_name,
				'edit_others_posts',
				$top_level_menu_slug,
				''
			);

			if ( ! $terms instanceof WP_Error ) {
				foreach ( $terms as $term ) {
					add_submenu_page(
						$top_level_menu_slug,
						$term->name,
						$term->name,
						'edit_others_posts',
						'edit.php?post_type=' . $this->GetPostType() . "&{$this->GetTaxonomy()}=" . $term->slug,
						''
					);
				}
			}
		}
	}

	public function admin_columns( $columns ) {
		if ( ! is_array( $columns ) ) {
			$columns = array();
		}

		$new_columns = array();
		foreach ( $columns as $key => $title ) {
			// Put the Thumbnail column before the Title column
			if ( $key == 'title' ) {
				$new_columns[ "unity3-media-{$this->id}-thumbnail" ] = ' '; //image column needs not name
			}

			$new_columns[ $key ] = $title;
		}

		return $new_columns;
	}

	protected function get_admin_column_thumbnail( $post_id ) {	}

	public function admin_column_data( $column_name, $post_id ) {
		if ( "unity3-media-{$this->id}-thumbnail" != $column_name ) {
			return;
		}

		$thumbnail = $this->get_admin_column_thumbnail( $post_id );
		$thumbnail   = apply_filters( "unity3_media_{$this->id}_admin_thumbnail", $thumbnail, $column_name, $post_id);

		if ( ! empty( $thumbnail ) ) {
			$edit_link = get_edit_post_link( $post_id );
			echo '<a href="' . $edit_link . '">' . $thumbnail . '</a>';
			return;
		}

		echo "&nbsp;"; // This helps prevent issues with empty cells
	}
}