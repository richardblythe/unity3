<?php
class Unity3_Post_Expiration {
	protected $post_types;

	function __construct() {

		$this->post_types = array();

		add_action( 'pre_get_posts', 'filter' );
		if (is_admin()) {
			add_action( 'current_screen', 'acf' );
		}
	}

	public function acf( $current_screen ) {
		if ( in_array($current_screen->post_type, $this->post_types) && 'post' == $current_screen->base ) {
			acf_add_local_field_group(array(
				'key' => "post_exp",
				'title' => 'Post Expiration',
				'fields' => array (
					array (
						'type'          => 'date_time',
						'key'           => 'expires',
						'label'         => 'Expiration Date',
						'name'          => 'expires',
						'required'      => 0,
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => $current_screen->post_type,
						),
					),
				),
			));
		}
	}

	public function filter( $query ) {
		// doesn't affect admin screens
		if ( is_admin() )
			return;
		// check for main query
		if ( $query->is_main_query() && in_array( $query->get( 'post_type' ), $this->post_types  )) {

			//filter out expired posts
			$today = date('d-m-Y');
			$metaquery = array(
				array(
					'key' => 'expires',
					'value' => $today,
					'compare' => '<',
					'type' => 'DATE',
				)
			);
			$query->set( 'meta_query', $metaquery );
		}
	}

	public function addNew( $post_type ) {
		if (! in_array( $post_type, $this->post_types )) {
			$this->post_types[] = $post_type;
		}
	}
}

global $_unity3_post_expiration;
$_unity3_post_expiration = new Unity3_Post_Expiration();

function unity3_post_expiration( $post_type ) {
	global $_unity3_post_expiration;
	$_unity3_post_expiration->addNew( $post_type );
}