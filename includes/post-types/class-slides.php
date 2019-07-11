<?php
//
class Unity3_Slides extends Unity3_Post_Group {

	public function __construct( ) {
		parent::__construct('unity3_slide', 'Slide', 'Slides');

		$this->settings = wp_parse_args( array(
			'menu_position' => 9,
			'menu_icon'     => 'dashicons-images-alt2'
		), $this->settings );
	}

	public function Activate() {
		if (!parent::Activate()) {
			return false;
		}

		add_image_size('unity3_slide', 1140,460, true);

		add_filter( "get_post_metadata", array($this, 'override_default_image'), 12, 4);

		add_filter( 'get_the_excerpt', array($this, 'override_excerpt'), 12, 2 );

		if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => "{$this->GetPostType()}_acf_group",
			'title' => 'Fields',
			'fields' => array (
				array (
					'key'           => 'image',
					'label'         => '',
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'id',
					'required'      => 1,
					'mime_types'    => 'jpg,jpeg,jpe,gif,png',
					'preview_size'  => 'unity3_slide',
					'wrapper' => array (
						'width' => '100%',
						'class' => 'slide-image'
					),
				),
				array(
					'key'    => 'caption',
					'label'  => 'Caption',
					'name'   => 'caption',
					'type'   => 'text',
				)
			),
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
		));

		endif;
		return true;
	}

	public function override_default_image( $image_id, $post_id, $meta_key, $single ) {

		if ('_thumbnail_id' == $meta_key && get_post_type($post_id) === $this->GetPostType()) {
			return get_field('image', $post_id);
		}
		return $image_id;
	}

	public function override_excerpt($post_excerpt, $post) {
		if (get_post_type($post) === $this->GetPostType()) {
			return get_field('caption', $post);
		}

		return $post_excerpt;
	}
}
////*************************
////       Register
////*************************
unity3_post_types()->Register(new Unity3_Slides());
