<?php

class Unity3_Galleries extends Unity3_Post_Group {

	public function __construct() {
		parent::__construct( 'unity3_gallery', 'Gallery', 'Galleries' );

		$this->settings = wp_parse_args( array(
			'menu_position' => 9,
			'menu_icon'     => 'dashicons-format-gallery'
		), $this->settings);
	}

    public function Activate() {
	    if (!parent::Activate()) {
		    return false;
	    }

		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => "{$this->GetPostType()}_acf_group",
				'title' => 'Gallery',
				'fields' => array(
					array(
						'key' => 'field_5ca7ff0bb5422',
						'label' => 'Gallery',
						'name' => 'gallery',
						'type' => 'gallery',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'min' => '',
						'max' => '',
						'insert' => 'prepend',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => $this->GetPostType(),
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => array(
					0 => 'permalink',
					1 => 'the_content',
					2 => 'excerpt',
					3 => 'discussion',
					4 => 'comments',
					5 => 'revisions',
					6 => 'slug',
					7 => 'author',
					8 => 'format',
					9 => 'page_attributes',
					10 => 'featured_image',
					11 => 'categories',
					12 => 'tags',
					13 => 'send-trackbacks',
				),
				'active' => true,
				'description' => 'This is a metabox description',
			));

		endif;

		return true;
	}


}
////*************************
////       Register
////*************************
unity3_post_types()->Register(new Unity3_Galleries());

function unity3_media_get_galleries( $slug ) {

	return get_posts(array(
		'post_type'   => $slug,
		'post_status' => 'publish',
		'numberposts' => -1,
		'order'       => 'ASC',
		'orderby'     =>  'menu_order title'
	));
}

function unity3_media_get_gallery( $id, $format = true ) {

	if (function_exists('get_field')) {
		$post = get_post( $id );
		return get_field('gallery', $post->ID, $format);
	}

	return null;
}