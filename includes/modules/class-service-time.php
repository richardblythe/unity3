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
		));
	}

	public function doActivate() {
		parent::doActivate();

		unity3_dragsort( $this->GetPostType() );
		add_shortcode('unity3_service_times', array(&$this, 'shortcode') );

		return true;
	}



	function shortcode() {
		if (is_admin()) //fixes a bug in Gutenberg
			return '';

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
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			echo 'Services Times Are Unavailable';
		}


		return ob_get_clean();
	}

	public function GetFields() {
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



