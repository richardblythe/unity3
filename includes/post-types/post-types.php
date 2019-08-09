<?php

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('Unity3_Post_Types') ) :

class Unity3_Post_Types {

	/** @var array The plugin settings array */
	var $settings = array();

	/** @var array The plugin data array */
	var $data = array();

	/** @var array Storage for class instances */
	private $types = array();


	function initialize() {

		if (is_admin()) {
			add_filter('unity3_dragsortposts',  array($this, 'register_dragsort_posts') );
		}

		//load classes immediately before the widgets! Note the priority of zero
		add_action( 'init', array($this, 'load_classes'), 0 );
	}

	//this is the place to fire the activation notice to theme listeners...
	public function load_classes() {
		//load classes...
		require_once (Unity3::$dir . 'includes/post-types/class-post-type.php');
		require_once (Unity3::$dir . 'includes/post-types/class-post-group.php');
		require_once (Unity3::$dir . 'includes/post-types/class-galleries.php');
		require_once (Unity3::$dir . 'includes/post-types/class-slides.php');
		require_once (Unity3::$dir . 'includes/post-types/class-service-time.php');
		require_once (Unity3::$dir . 'includes/post-types/class-audio.php');

		do_action('unity3/post_types/init' );

		do_action('unity3/post_types/activate');
	}

	public function register_dragsort_posts( $post_types ) {
		return array_merge($post_types, array_keys($this->types));
	}

	public function admin_body_class( $classes ) {
		$screen = get_current_screen();

		foreach ( $this->types as $type ) {

			if ( $type->GetPostType() == $screen->post_type ) {
				$classes .= " unity3-post-type {$type->GetPostType()}";
				break;
			}
		}

		return $classes;
	}


	public function Register( $class ) {
		// allow instance
		if(is_object($class) && is_subclass_of( $class, 'Unity3_Post_Type') ) {
			$this->types[$class->GetPostType()] = $class;

		// allow class name
		} else {
			$instance = new $class();
			$this->types[ $instance->GetPostType() ] = $instance;
		}
	}

//	public function HasPostType( $post_type ) {
//		foreach ($this->types as $type ) {
//			if ($post_type == $type->GetPostType()) {
//				return true;
//			}
//		}
//		return false;
//	}
//
//	public function GetTaxonomy( $post_type ) {
//		foreach ($this->types as $type ) {
//			if ($post_type == $type->GetPostType()) {
//				return $type->GetGroupType();
//			}
//		}
//		return null;
//	}

	public function GetType( $post_type ) {
		return isset($this->types[ $post_type ]) ? $this->types[ $post_type ] : null;
	}

	public function Activate( $args ) {

		if (!isset( $args ))
			return false;

		if (!is_array( $args ) ) {
			$args = array( $args => null); //convert to an associative array
		}
		//check to see if the array is sequential. (we need an associative array)
		if ( array_keys($args) === range(0, count($args) - 1) ) {
			//convert to an associative array
			$new_array = array();
			foreach ($args as $key ) {
				$new_array[$key] = null;
			}
			$args = $new_array; //assign the converted array;
		}

		$activated_any = false;
		$type = null;
		if (0 !== count($args)) {
			foreach ($args as $post_type => $settings ) {
				$type = $this->GetType( $post_type );
				if (isset($type) && !$type->IsActivated()) {
					$type->Activate( $settings );
					$activated_any = true;
				}
			}
		}

		return $activated_any;
	}

    public function GetImageSizes( $format = 'raw' ) {

		$builtin_sizes = array(
			'large'   => array(
				'width'  => get_option( 'large_size_w' ),
				'height' => get_option( 'large_size_h' ),
			),
			'medium'  => array(
				'width'  => get_option( 'medium_size_w' ),
				'height' => get_option( 'medium_size_h' ),
			),
			'thumbnail' => array(
				'width'  => get_option( 'thumbnail_size_w' ),
				'height' => get_option( 'thumbnail_size_h' ),
				'crop'   => get_option( 'thumbnail_crop' ),
			),
		);

		global $_wp_additional_image_sizes;
		$additional_sizes = $_wp_additional_image_sizes ? $_wp_additional_image_sizes : array();

		$sizes = array_merge( $builtin_sizes, $additional_sizes );

		if ('display' == $format) {
			$formatted = array();
			foreach ($sizes as $name => $size) {
				$formatted[$name] = (esc_html( $name ) . ' (' . absint( $size['width'] ) . 'x' . absint( $size['height'] ) . ')');
			}
			$sizes = $formatted;
		}

		return $sizes;
	}
}



	/*
	*  Unity3_Post_Types
	*
	*  The main function responsible for returning the one true acf Instance to functions everywhere.
	*  Use this function like you would a global variable, except without needing to declare the global.
	*
	*  Example: <?php $Unity3_Post_Types = Unity3_Post_Types(); ?>
	*
	*  @type	function
	*  @date	4/09/13
	*  @since	4.3.0
	*
	*  @param	N/A
	*  @return	(object)
	*/

	function unity3_post_types() {

		// globals
		global $unity3_post_types;


		// initialize
		if( !isset($unity3_post_types) ) {
			$unity3_post_types = new Unity3_Post_Types();
			$unity3_post_types->initialize();
		}


		// return
		return $unity3_post_types;

	}

	function unity3_activate( $args ) {
		unity3_post_types()->Activate( $args );
	}

	// initialize
	unity3_post_types();

endif; // class_exists check

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




?>