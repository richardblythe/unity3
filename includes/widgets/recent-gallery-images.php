<?php
/*
  Plugin Name: Clearbase Recent Images Widget
  Description: A widget that displays the most recent images from a specified folder
  Version: 1.0.2
  Author: Richard Blythe
  Author URI: http://unity3software.com/richardblythe
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

if( class_exists('ACF') ) :

class Recent_Gallery_Images_Widget extends WP_Widget {

    protected $gallery_images;

	public function __construct() {
		$widget_ops = array( 'classname' => 'recent-gallery-images', 'description' => __( 'Displays the most recent Unity3 Gallery Images inside a widget area', 'unity3' ) );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'recent-gallery-images-widget' );
		parent::__construct( 'recent-gallery-images-widget',
			__( 'Recent Gallery Images', 'unity3' ),
			$widget_ops,
			$control_ops
		);

		acf_add_local_field_group(array(
				'key' => $this->id_base . '_acf_group',
				'title' => 'Settings',
				'fields' => $this->Fields(),
				'location' => array (
					array (
						array (
							'param' => 'widget',
							'operator' => '==',
							'value' => $this->id_base,
						),
					),
				),
				'style' => 'seamless',
			)
		);
	}

	public function Fields( ) {

        if ( !$module = unity3_modules()->Get('unity3_gallery')) {
			return array();
		}

		//return ACF fields
		return array (
            array(
                'label' => 'Gallery Group',
                'key'   => $this->id_base . '_groups',
                'name'  => 'groups',
                'type' => 'taxonomy',
                'instructions' => 'Will show the most recent images in the specified group',
                'required' => 0,
//                'wrapper' => array(
//                    'width' => '50',
//                    'class' => '',
//                    'id' => '',
//                ),
                'taxonomy' => $module->GetTaxonomy(),
                'field_type' => 'checkbox',
                'add_term' => 0,
                'save_terms' => 0,
                'load_terms' => 0,
                'return_format' => 'id',
                'multiple' => 0,
                'allow_null' => 0,
            ),

			array(
				'type'   => 'number',
				'label'  => 'Columns',
				'name'   => 'columns',
				'key'    => $this->id_base . '_columns',
				'default_value' => 2,
			),
            array(
                'type'   => 'number',
                'label'  => 'Rows',
                'name'   => 'rows',
                'key'    => $this->id_base . '_rows',
                'default_value' => 4,
            ),

//			array(
//				'type'   => 'accordion',
//				'key'    => 'accordion_post_query_end',
//				'endpoint' => true
//			),
			//           END Query
			//************************************************************************


			//***************************************************************
			//         Thumbnails
//			array(
//				'type'   => 'accordion',
//				'label'  => 'Thumbnails',
//				'key'    => 'accordion_thumbnails'
//			),


			array(
				'type'   => 'select',
				'label'  => 'Image Size',
				'key'    => $this->id_base . 'image_size',
				'name'   => 'image_size',
				'choices' => unity3_get_image_sizes('display'),
			),

//			array(
//				'type'   => 'accordion',
//				'key'    => 'accordion_thumbnails_end',
//				'endpoint' => true
//			),
			//     END Thumbnails
			//************************************************************************
		);
	}

	// display widget
	function widget( $args, $instance ) {
		extract( $args );

		if ( !$module = unity3_modules()->Get('unity3_gallery') ) {
		    return;
        }

		echo $before_widget;

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		if ( $title )
			echo $before_title . $title . $after_title;

        $settings = get_field_objects('widget_' . $this->id, true, true);

		$this->gallery_images = unity3_gallery_get_recent_images( 'term_id', $settings['groups']['value'], intval($settings['columns']['value']) + intval( $settings['rows']['value'] ) );

		if (is_array($this->gallery_images) && count($this->gallery_images)) {

			$flattened = array();
			array_walk_recursive(array_values($this->gallery_images), function($a) use (&$flattened) { $flattened[] = $a; });

			add_filter( 'attachment_link', array(&$this, 'attachment_link_to_gallery'), 20, 2);
			add_filter('unity3/shortcode/gallery/caption', array(&$this, 'attachment_no_caption'), 20, 2 );
            add_filter( 'wp_get_attachment_image_attributes', array(&$this, 'attachment_attributes'), 20, 3);

			echo unity3_gallery_shortcode( array(
                'ids'       => $flattened,
                'size'      => $settings['image_size']['value'],
                'columns'   => intval($settings['columns']['value'])
            ));

			remove_filter( 'attachment_link', array(&$this, 'attachment_link_to_gallery'), 20, 2);
			remove_filter('unity3/shortcode/gallery/caption', array(&$this, 'attachment_no_caption'), 20, 2 );
			remove_filter( 'wp_get_attachment_image_attributes', array(&$this, 'attachment_attributes'), 20, 3);

		} else {
			echo '<div class="unity3-gallery no-images">' . __('This gallery has no images', 'unity3_gallery') . '</div>';
		}


		echo $after_widget;
	}

	public function form( $instance ) {
		$title = '';

		if (isset($instance['acf']) && isset($instance['acf']['group'])) {
			$title = is_array($instance['acf']['groups']) ? implode(',', $instance['acf']['groups']) : $instance['acf']['groups'];
		}
//        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Please Choose A Slider...', 'text_domain' );
		?>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="hidden" value="<?php echo esc_attr( $title ); ?>">
		<?php
	}


	function inject_gallery_style($style) {
		return '<style type="text/css">.cb-recent-imgs .gallery-caption { display: none; }</style>' . $style;
	}

    function attachment_attributes($attr, $attachment, $size) {
	    $attr['title'] = $attachment->post_excerpt;
        $attr['class'] .= ' unity3-img-fx-1';
	    return $attr;
    }

	function attachment_link_to_gallery($url, $attachment_id) {

	    foreach( $this->gallery_images as $key => $image_ids ) {
	        if ( in_array($attachment_id, $image_ids ) ) {
		        return get_permalink( $key );
	        }
        }

        return $url;
	}

	function attachment_no_caption( $excerpt, $attachment_id) {
	    return '';
	}
}

unity3()->AddWidget('Recent_Gallery_Images_Widget' );

endif;