<?php
//
class Unity3_Audio extends Unity3_Post_Group {

	public function __construct( ) {
		parent::__construct('unity3_audio', 'Audio File', 'Audio Files');

		$this->settings = wp_parse_args( array(
			'menu_position' => 12,
			'menu_icon'     => 'dashicons-controls-volumeon',
			'menu_title'    => 'Audio'
		), $this->settings );
	}

	public function Activate( $args ) {
		if (!parent::Activate( $args )) {
			return false;
		}

		//The client should be a be paying for the audio add-on package
		add_filter( 'upload_mimes',  array( &$this, 'unity3_aws_storage_mime'), 12, 1 );

		add_shortcode('unity3_audio', array(&$this, 'shortcode') );


		return true;
	}

	public function shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'post' => '',
			'group' => '',
			'show_title' => 'true'
		), $atts );


		$post = null;
		$args = array(
			'post_type'      => $this->GetPostType(),
			'numberposts' => '1',
			'orderby'        => 'date',
			'order'          => 'DESC',
		);


		//Get the latest post in the specified group...
		if ( isset($atts['group']) && !empty($atts['group']) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => $this->GetTaxonomy(),
					'field' => 'slug',
					'terms' => $atts['group']
				)
			);
		}

		if ( isset($atts['post']) && !empty($atts['post']) ) {
			$args['post__in'] = $atts['post'];
		}

		//get the post...
		$posts = get_posts( $args );

		if (isset($posts) && count($posts) == 1 ) {

			$post_id = $posts[0]->ID;
			$field = get_field('audio', $post_id);

			$attr = array(
				'src'      => $field['url'],
				'loop'     => '',
				'autoplay' => '',
				'preload'  => 'none',
				'style'    => 'light'
			);

			$title = '';
			if ( isset($atts['show_title']) && 'true' == $atts['show_title'] ) {
				$title = '<h2>' . get_the_title( $post_id ) . '</h2>';
			}

			return '<div class="unity3_audio">' . $title . wp_audio_shortcode( $attr ) . '</div>';
		}

		return '';
	}

	public function unity3_aws_storage_mime( $types ) {
	   return array_merge($types, array(
	     // Audio formats.
	     'mp3|m4a|m4b' => 'audio/mpeg',
	     'ogg|oga' => 'audio/ogg',
	     'wma' => 'audio/x-ms-wma',
	   ));
	 }

	public function GetFields() {
		return array (
			array(
				'key' => 'field_5d3b597197c47',
				'label' => 'File',
				'name' => 'audio',
				'type' => 'file',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'library' => 'all',
				'min_size' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		);
	}
}



////*************************
////       Register
////*************************
unity3_modules()->Register(new Unity3_Audio());



