<?php

class DragSortPosts {
	private $post_types = array();
	public function __construct() {
		if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			add_action( 'wp_ajax_unity3_drag_sort_posts', array( &$this, 'update_sorting' ) );
		} else {
			add_action( 'current_screen', array( &$this, 'current_screen' ) );
			add_action( 'wp_insert_post_data', array( &$this, 'check_menu_order' ), 10, 2 );

			add_filter( 'unity3/localize/admin', function ( $localize ) {
				global $current_screen;

				if ( in_array($current_screen->post_type, $this->getPostTypes()) ) {
					$post_obj = get_post_type_object($current_screen->post_type);
					$localize = array_merge($localize,   array(
						'dragsort' => array(
							'tooltip' => sprintf(__('Reorder %s', Unity3::domain), $post_obj->labels->singular_name)
						)
					));
				}

				return $localize;
			});
		}
	}

	public function Register( $post_type ) {
		if ( isset( $post_type ) && ! in_array( $post_type, $this->post_types ) ) {
			$this->post_types[] = $post_type;
		}
	}

	public function current_screen() {
		global $current_screen;

		if ( 'edit' == $current_screen->base && in_array( $current_screen->post_type, $this->getPostTypes() ) ) {
			add_filter( 'pre_get_posts', array( &$this, 'set_post_order' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue' ) );
			add_filter( "manage_{$current_screen->post_type}_posts_columns", function ( $columns ) {
				return array( 'dragsort' => '' ) + $columns;
			} );
		}
	}

	private function getPostTypes() {
		return apply_filters( 'unity3_dragsortposts', $this->post_types );
	}

	public function check_menu_order( $post_data, $postarr ) {
		//if the current post type is in our dragsort group and the current post is being created for the first time..
		if ( in_array( $post_data['post_type'], $this->getPostTypes() ) && 'auto-draft' == $postarr['post_status'] ) {
			global $wpdb;
			//update the menu_order to be on top of the stack..
			$menu_order              = $wpdb->get_var( "SELECT MAX(menu_order)+1 AS menu_order FROM {$wpdb->posts} WHERE post_type='{$post_data['post_type']}'" );
			$post_data['menu_order'] = $menu_order ? $menu_order : 0;
		}

		return $post_data;
	}

	/*
	 * Set the post order for the current admin screen
	 */
	public function set_post_order( $wp_query ) {
		$wp_query->set( 'orderby', 'menu_order' );
		$wp_query->set( 'order', 'ASC' );
	}

	public function admin_enqueue() {
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-touch-punch', Unity3::$vendor_url . '/jquery.ui.touch-punch.min.js', array( 'jquery-ui-sortable' ), '0.2.3', true );
	}

	public function update_sorting() {

		if ( isset( $_REQUEST['posts'] ) && is_array( $_REQUEST['posts'] ) ) {
			$posts = $_REQUEST['posts'];
			foreach ( $posts as $post_id => $menu_order ) {
				wp_update_post( array( 'ID' => $post_id, 'menu_order' => $menu_order ) );
			}

			do_action( 'unity3/drag_sort_posts', $posts );
		}

		wp_send_json_success();
	}
}

global $unity3_dragsort_posts;
$unity3_dragsort_posts = new DragSortPosts();


function unity3_dragsort( $post_type ) {
	if ( is_admin() ) {
		global $unity3_dragsort_posts;
		$unity3_dragsort_posts->Register( $post_type );
	}

}