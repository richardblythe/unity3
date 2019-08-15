<?php
//
class Unity3_Service_Time extends Unity3_Post_Type {


	public function __construct( ) {
		parent::__construct('unity3_service_time', 'Service Time', 'Service Times');

		$this->settings = wp_parse_args( array(
			'menu_position' => 9,
			'menu_icon'     => 'dashicons-clock',
		), $this->settings );
	}

	public function Activate( $args ) {
		if (!parent::Activate( $args )) {
			return false;
		}


		add_filter( "manage_{$this->GetPostType()}_posts_custom_column", array(&$this, "post_columns_content" ) );
		add_filter( 'unity3_dragsortposts', array(&$this, 'dragsort') );
		add_filter( "manage_{$this->GetPostType()}_posts_columns", array(&$this, "post_columns") );

		add_shortcode('unity3_service_times', array(&$this, 'shortcode') );

		return true;
	}

	function dragsort( $post_types ) {
		$post_types[] = $this->GetPostType();
		return $post_types;
	}



	function post_columns( $columns ) {
		$columns = array(
			//Define the columns in order from left to right
			'cb'    => '<input type="checkbox" />',
			'title' => ( 'Service Name' ),
			'time'  => ( 'Service Time' )
		);

		return $columns;
	}


	function post_columns_content( $columns ) {
		//Get access to the current post being listed
		global $post;
		//Get the ID of that post
		$post_id = $post->ID;

		/* If the column being listed is equal to the slug of the custom post type
			My custom post type's slug is "filed" */
		if ( $columns == 'time' ) {
			//The category is the custom field for this specific post being listed
			$service_time = get_field( 'service_time', $post->ID );
			//If the category exists
			if ( $service_time ) {
				//Display it.
				echo $service_time;
			}
		}

		return;
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



