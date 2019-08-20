<?php
//
class Unity3_Slides extends Unity3_Post_Group {

	public function __construct( ) {
		parent::__construct('unity3_slide', 'Slide', 'Slides');

		$this->mergeSettings( array(
			'post' => array(
				'menu_position' => 9,
				'menu_icon'     => 'dashicons-images-alt2'
			),
			'group_rewrite' => array( 'base' => 'slides'),
			'admin_columns' => array(
				'cb'    => array('header' => '<input type="checkbox" />'),
				'slide-image' => array('header' => '', 'acf' => 'image', 'image_size' => 'unity3_slide_col'),
				'title' => array('header' => 'Title'),
				'date'  => array('header' => 'Date'),
			),
		));

	}

	public function doActivate( ) {
		parent::doActivate();

		add_image_size('unity3_slide', 1140,460, true);
		add_image_size('unity3_slide_col', 200,100, true);

		add_filter( "get_post_metadata", array($this, 'override_default_image'), 12, 4);

		add_filter( 'get_the_excerpt', array($this, 'override_excerpt'), 12, 2 );

		unity3_dragsort( $this->GetPostType() );

		return true;
	}

	public function GetFields() {
		return array (
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
				'key' => 'caption',
				'label' => 'Caption',
				'name' => 'caption',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			)
		);
	}

//  Todo: Toobar code from ACF
//    public function my_toolbars( $toolbars )
//	{
//		// Uncomment to view format of $toolbars
//		/*
//		echo '< pre >';
//			print_r($toolbars);
//		echo '< /pre >';
//		die;
//		*/
//
//		// Add a new toolbar called "Very Simple"
//		// - this toolbar has only 1 row of buttons
//		$toolbars['Very Simple' ] = array();
//		$toolbars['Very Simple' ][1] = array('bold' , 'italic' , 'underline' );
//
//		// Edit the "Full" toolbar and remove 'code'
//		// - delete from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
//		if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
//		{
//			unset( $toolbars['Full'][2][$key] );
//		}
//
//		// remove the 'Basic' toolbar completely
//		unset( $toolbars['Basic' ] );
//
//	// return $toolbars - IMPORTANT!
//		return $toolbars;
//	}

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
unity3_modules()->Register(new Unity3_Slides());



