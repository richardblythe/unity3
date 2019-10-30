<?php

class Unity3_Galleries extends Unity3_Post_Group {

	protected $acf_gallery_field_name, $archive_columns, $archive_image_size;

	public function __construct() {
		parent::__construct( 'unity3_gallery', 'Gallery', 'Galleries' );

		$this->acf_gallery_field_name = 'gallery';

		$this->mergeSettings( array(
			'post' => array(
				'menu_position' => 9,
				'menu_icon'     => 'dashicons-format-gallery'
			),
			'group_rewrite' => array( 'base' => 'galleries' )
		));
	}

	public function Init() 	{
		parent::Init();
		if ( is_admin() ) {
			unity3_dragsort( $this->GetPostType() );
		} else {
			//configure the default genesis configuration. Can be overriden by theme
			add_action( 'genesis_before', 'unity3_gallery_genesis_before' );
			add_filter( 'post_class', 'unity3_gallery_archive_post_class' );
		}
	}

	// protected function ThemeSetup() {
	// 	if (is_tax($this->GetTaxonomy())) {	
	// 		add_action( 'genesis_before',  'unity3_gallery_do_genesis_tax' );
	// 	} else if ( is_singular( $this->GetPostType() ) ) {
	// 		add_action( 'genesis_before',  'unity3_gallery_do_genesis_single' );
	// 	}
	// }

    protected function getFields() {
		return array(
			array(
				'label' => 'Gallery',
				'key' => $this->GetPostType() . '_field_gallery',
				'name' => $this->acf_gallery_field_name,
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
		);
	}

	protected function getSettingsFields() {
		$fields = parent::getSettingsFields();
		$fields[] =	array(
			'label' => 'Archive Columns',
			'key' => $this->GetPostType() . '_archive_columns',
			'name' => $this->GetPostType() . '_archive_columns',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'choices' => array(
				'one'        => '1 Column',
				'one-half'   => '2 Columns',
				'one-third'  => '3 Columns',
				'one-fourth' => '4 Columns',
				'one-fifth'  => '5 Columns',
				'one-sixth'  => '6 Columns'
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'one-third',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		);
		$fields[] =	array(
			'label' => 'Archive Featured Image Size',
			'key' => $this->GetPostType() . '_archive_image_size',
			'name' => $this->GetPostType() . '_archive_image_size',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'choices' => unity3_get_image_sizes(),
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
		);

		return $fields;
	}

	public function Render( $content ) 	{

		//TODO: DELETE DEV CODE BELOW
//		$images = unity3_gallery_get_recent_images('term_slug', 'photos', 10);
//		//---------- End Dev Code

		//if the "cached" value is not set from wp_options, load it once
		if ( !isset( $this->archive_image_size )) {
			//stored value is used when rendering the post content;
			$this->archive_image_size = get_option( 'options_' . $this->GetPostType() . '_archive_image_size', '' );
		}

		if ( is_tax($this->GetTaxonomy()) ) {
			$featured_image = get_the_post_thumbnail();

			if ( empty($featured_image) ) {
				$images = get_post_meta( get_the_ID(), $this->acf_gallery_field_name, true );
				if (is_array($images) && count($images)) {
					$featured_image = wp_get_attachment_image( $images[0], $this->archive_image_size );
				}
			} 

			//Todo: Maybe add code for a default featured image?
			return empty($featured_image) ? '' : 
				'<a href="'  . get_the_permalink() . 
				 '" title="' . esc_attr( get_the_title() ) . 
				 '">' . $featured_image . '</a>';

		} else if (is_singular( $this->GetPostType() )) {

			$images = get_post_meta( get_the_ID(), 'gallery', true );
			if (is_array($images) && count($images)) {
				return do_shortcode('[gallery ids="' . implode(',', $images) . '" size="'. $this->archive_image_size .'"]');
			} else {
				return '<div class="unity3-gallery no-images">' . __('This gallery has no images', 'unity3_gallery') . '</div>';
			}
		}
		
	}

	public function archive_post_class( $classes ) {
			
		// Don't run on single posts or pages
		if( is_singular() )
			return $classes;

		if ( !isset( $this->archive_columns ) ) {
			$this->archive_columns = get_option( 'options_' . $this->GetPostType() . '_archive_columns', 'one-third' );
		}

		$classes[] = $this->archive_columns;
		global $wp_query;

		$new_row = false;
		switch ($this->archive_columns) {
			case 'one-half':
				$new_row = ( 0 == $wp_query->current_post % 2 );
			break;
			case 'one-third':
				$new_row = ( 0 == $wp_query->current_post % 3 );
			break;
			case 'one-fourth':
				$new_row = ( 0 == $wp_query->current_post % 4 );
			break;
			case 'one-fifth':
				$new_row = ( 0 == $wp_query->current_post % 5 );
			break;
			case 'one-sixth':
				$new_row = ( 0 == $wp_query->current_post % 6 );
			break;
			default:
				//do nothing
			break;
		}

		if ($new_row || 0 == $wp_query->current_post )
			$classes[] = 'first';
			
		return $classes;
	}


	public function GetRecentImages( $selector, $id, $count = 10 ) {
		$post_args = array(
			'post_type' => $this->GetPostType(),
			'numberposts' => -1
		);

		//convert to an array so our code logic will be cleaner
		$arr_id = is_array($id) ? $id : array( $id );

		switch ($selector) {
			case 'term_id':
			case 'term_slug':
				$post_args['tax_query'] = array(
					'taxonomy' => $this->GetTaxonomy(),
					'field' => 'term_id' == $selector ? 'id' : 'slug',
					'terms' => 'term_id' == $selector ? array_map('intval', $arr_id) : $arr_id,
					'include_children' => false
				);
				break;
			case 'post_id':
				$post_args['include'] = $arr_id;
				break;
		}



		if ( $posts = get_posts($post_args) ) {
			global $wpdb;
			$table_name = "{$wpdb->prefix}postmeta";
			$post_ids = wp_list_pluck( $posts, 'ID' );
			$in_str_arr = array_fill( 0,  count( $post_ids ) , '%s' );
			$in_str = join( ',', $in_str_arr );
			$meta_rows = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT `post_id`, `meta_value` ".
					"FROM `$table_name` ".
					"WHERE `meta_key` = '{$this->acf_gallery_field_name}' AND `post_id` IN ( $in_str )",
					$post_ids
				),
				ARRAY_A
			);

			$gallery_images = array();
			foreach ( $meta_rows as $row ) {
				$values = maybe_unserialize( $row['meta_value'] );
				if ( is_array($values) && count($values) ) {
					$gallery_images[$row['post_id']] = $values;
				}
			}

			$flattened = array();
			array_walk_recursive(array_values($gallery_images), function($a) use (&$flattened) { $flattened[] = $a; });

			//now attempt to get the images that are still in the db.  Some may have been deleted
			$attachments = get_posts( array(
					'post_type'         => 'attachment',
					'post_status'       => 'any',
					'post__in'          => $flattened,
					'orderby'           => 'post__in modified',
					'posts_per_page'    => $count
				)
			);

			$attachment_ids = wp_list_pluck( $attachments, 'ID' );
			foreach ( $gallery_images as $gallery_id => $image_ids ) {
				//use array_intersect to extract only the image id's that still existed in the db
				$gallery_images[$gallery_id] = array_intersect( $image_ids, $attachment_ids );
				//if no images are valid for this gallery, remove it from the list.
				if ( !count($gallery_images[$gallery_id]) ) {
					unset( $gallery_images[$gallery_id] );
				}
			}

			return $gallery_images;
		}

		return array();
	}


}
////*************************
////       Register
////*************************
unity3_modules()->Register(new Unity3_Galleries());

function unity3_gallery_genesis_before() {
	// HTML5 Hooks.
	remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
	// remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	// remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	// remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	// remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
	// remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
	// remove_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );

	// remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
	// remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

	remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );
	remove_action( 'genesis_after_entry', 'genesis_adjacent_entry_nav' );
	remove_action( 'genesis_after_entry', 'genesis_get_comments_template' );
}

function unity3_gallery_archive_post_class( $classes ) {
	
	if ( $module = unity3_modules()->Get('unity3_gallery') ) {
		return $module->archive_post_class( $classes );
	}
	return $classes;
}



function unity3_gallery_do_genesis_single() {

	if ( $module = unity3_modules()->Get('unity3_gallery') ) {
		$module->genesis_single();
	}
}

//Get an array of images grouped by their parent unity3_gallery id
function unity3_gallery_get_recent_images( $selector, $id, $count ) {
	$module = unity3_modules()->Get('unity3_gallery');
	return $module ? $module->GetRecentImages( $selector, $id, $count ) : array();
}



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