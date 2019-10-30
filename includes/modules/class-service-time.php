<?php
//
class Unity3_Service_Time extends Unity3_Post_Type {


	public function __construct( ) {
		parent::__construct('unity3_service_time', 'Service Time', 'Service Times');

		$this->mergeSettings( array(
			'post' => array(
				'menu_position' => 9,
				'menu_icon'     => 'dashicons-clock',
				'rewrite' => array( 'slug' => 'service-times' )
			),
			'admin_columns' => array(
				'cb'           => array('header' => '<input type="checkbox" />'),
				'title'        => array('header' => 'Service Name'),
				'service_time' => array('header' => 'Service Time', 'acf' => 'service_time'),
				'date'         => array('header' => 'Date'),
			),
			'block' => array(
				'description'       => __('Displays the current list of services times'),
				'icon'              => 'clock',
				'keywords'          => array( 'services', 'service times' ),
			)
		));
	}

	public function Init() {
		parent::Init();

		unity3_dragsort( $this->GetPostType() );
		add_shortcode('unity3_service_times', array(&$this, 'shortcode') );
	}

//	function register_blocks() {
//
//		// register a testimonial block.
//		if (is_admin() || wp_doing_ajax() || wp_is_json_request() ) {
//
//			acf_register_block_type(array(
//				'name'              => 'unity3-service-times',
//				'title'             => __('Service Times'),
//				'description'       => __('Displays the current list of services times'),
//				'render_callback'   => array(&$this, 'render_block_admin'),
//				'category'          => 'formatting',
//				'icon'              => 'clock',
//				'keywords'          => array( 'services', 'service times' ),
//			));
//
//		} else {
//			//bypass ACF on the front end to speed things up
//			register_block_type('acf/unity3-service-times', array(
//				'attributes'		=> array(),
//				'render_callback'	=> array(&$this, 'render_block'),
//			));
//		}
//	}

//	public function render_block( $args ) {
//		return $this->shortcode();
//	}
//
//	public function render_block_admin($block, $content, $is_preview, $post_id ) {
//		echo $this->shortcode( true );
//	}


	function renderBlock( $data ) {
		return $this->shortcode();
	}

	function renderAdminBlock( $block, $content, $is_preview, $post_id ) {
		echo $this->shortcode( true );
	}



	function shortcode( $admin = false ) {
//		if (is_admin()) //fixes a bug in Gutenberg
//			return '';

		ob_start();

		$query = new WP_Query(array(
			'post_type' => $this->GetPostType(),
			'posts_per_page' => -1,
			'orderby' => 'menu_order',
			'order' => 'ASC'
		));

		if ( $query->have_posts() ) {
			echo '<div class="service-times">';
			while ( $query->have_posts() ) {
				$query->the_post();
				echo '<h2>' . get_the_title() . '</h2>';
				echo '<span class="service-time">' . get_field('service_time', get_the_ID() ) . '</span>';
			}
			echo '</div>';
			if ( $admin )
				$this->renderAdminBlockOverlay( $this->EditLink() );
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			echo 'Services Times Are Unavailable';
		}


		return ob_get_clean();
	}

	protected function getFields() {
		return array(
			array(
				'key' => 'field_5cfe9a375c8b6',
				'label' => 'Service Time',
				'name' => 'service_time',
				'type' => 'time_picker',
				'required' => 1,
				'display_format' => 'g:i a',
				'return_format' => 'g:i a',
			),
		);
	}
}

////*************************
////       Register
////*************************
unity3_modules()->Register(new Unity3_Service_Time());



