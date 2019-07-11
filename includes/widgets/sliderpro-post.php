<?php
/**
 * Unity 3 SliderPro Post Widget Class
 */
class Unity3_SliderPro_Post_Widget extends WP_Widget {

    const version = '1.0';
    const group_key = 'sliderpro-widget-fields';

    protected $fields;

    public function __construct() {
        $widget_ops = array( 'classname' => 'unity3-sliderpro-post-widget', 'description' => __( 'Displays a collection of posts using SliderPro', 'unity3' ) );
        $control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'unity3-sliderpro-post-widget' );
        parent::__construct( 'unity3-sliderpro-post-widget',
            __( 'Unity3 SliderPro', 'unity3' ),
            $widget_ops, 
            $control_ops 
        );

	    acf_add_local_field_group(array(
		    'key' => 'sliderpro-widget-fields',
		    'title' => 'Media Group',
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

    // display widget
    function widget( $args, $instance ) {
        extract( $args );

        echo $before_widget;
	    $id = 'widget_' . $widget_id;
	    $settings = get_field_objects($id, true, true);

	    $args = array();

	    //------------------- Post Query Args -----------------------------

	    if (isset($settings['post_type']) && !empty($settings['post_type']['value'])) {
		    $args['post_type'] = $settings['post_type']['value'];
	    }

	    if (isset($settings['post_max']) && !empty($settings['post_max']['value'])) {
		    $args['posts_per_page'] = $settings['post_max']['value'];
	    }

	    if (isset($settings['post_offset']) && !empty($settings['post_offset']['value'])) {
		    $args['offset'] = $settings['post_offset']['value'];
	    }

	    if (isset($settings['post_orderby']) && !empty($settings['post_orderby']['value'])) {
		    $args['orderby'] = $settings['post_orderby']['value'];
	    }

	    if (isset($settings['post_order']) && !empty($settings['post_order']['value'])) {
		    $args['order'] = $settings['post_order']['value'];
	    }

	    if (isset($settings['post_meta_key']) && !empty($settings['post_meta_key']['value'])) {
		    $args['meta_key'] = $settings['post_meta_key']['value'];
	    }

	    if (isset($settings['post_paged']) && !empty($settings['post_paged']['value'])) {
		    $args['nopaging'] = !$settings['post_paged']['value'];
	    }


//	    if (isset($settings['post_show_paged']) && !empty($settings['post_show_paged']['value'])) {
//		    $args['show_paged'] = $settings['post_show_paged']['value'];
//	    }



	    //************************************************************************************
        //*****                 Tax Query

	    //Include Tax queries...
	    $include_tax_queries = array();
        if (isset($settings['post_taxonomy_include']) && !empty($settings['post_taxonomy_include']['value'])) {

	        $tax_term_selections = acf_decode_taxonomy_terms($settings['post_taxonomy_include']['value']);

	        foreach ($tax_term_selections as $tax => $terms) {
	            $include_tax_queries[] = array(
		            'taxonomy' => $tax,
		            'field'    => 'slug',
		            'terms'    => $terms
                );
            }
	    }

	    //Exclude Tax queries...
	    $exclude_tax_queries = array();
	    if (isset($settings['post_taxonomy_exclude']) && !empty($settings['post_taxonomy_exclude']['value'])) {

		    $tax_term_selections = acf_decode_taxonomy_terms($settings['post_taxonomy_exclude']['value']);

		    foreach ($tax_term_selections as $tax => $terms) {
			    $exclude_tax_queries[] = array(
				    'taxonomy' => $tax,
				    'field'    => 'slug',
				    'terms'    => $terms,
                    'operator' => 'NOT IN'
			    );
		    }
	    }

	    $args['tax_query'] = array( $include_tax_queries);

	    //*****************************************************************************


	    $query = new WP_Query( $args );


        $this->Enqueue();
        $this->Render($id, $query);

        echo $after_widget;
    }

	public function form( $instance ) {
		$title = '';

		if (isset($instance['acf']) && isset($instance['acf']['post_type'])) {
		    $title = is_array($instance['acf']['post_type']) ? implode(',', $instance['acf']['post_type']) : $instance['acf']['post_type'];
        }
//        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Please Choose A Slider...', 'text_domain' );
		?>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="hidden" value="<?php echo esc_attr( $title ); ?>">
		<?php
	}


	public function Enqueue() {
		wp_enqueue_script('sliderpro-script', Unity3::$vendor_url . '/sliderpro/dist/js/jquery.sliderPro.min.js', array( 'jquery' ), $this::version);
		wp_enqueue_style( 'sliderpro-style',  Unity3::$vendor_url . '/sliderpro/dist/css/slider-pro.min.css', false, $this::version);
	}

	public function Fields( ) {

		if ($this->fields) {
			return $this->fields;
		}

		$image_sizes = $this->get_image_sizes('display');

		//return ACF fields
		return $this->fields = apply_filters('sliderpro/fields', array (
			//************************************************************************
			//     General
			array(
				'type'   => 'accordion',
				'label'  => 'Post Query',
				'key'    => 'accordion_post_query'
			),

			array(
				'label'			=> __('Filter by Post Type','unity3'),
				'type'			=> 'select',
				'name'			=> 'post_type',
				'key'			=> 'post_type',
                'instructions'	=> '',
				'choices'		=> acf_get_pretty_post_types(),
				'multiple'		=> false,
				'ui'			=> 1,
				'allow_null'	=> false,
				'placeholder'	=> __("All post types",'unity3'),
			),

			array(
				'label'			=> __('Include Taxonomy','unity3'),
				'type'			=> 'select',
				'name'			=> 'post_taxonomy_include',
				'key'			=> 'post_taxonomy_include',
				'instructions'	=> '',
				'choices'		=> acf_get_taxonomy_terms(),
				'multiple'		=> 1,
				'ui'			=> 1,
				'allow_null'	=> 1,
				'placeholder'	=> __("No taxonomy filter",'unity3'),
			),

			array(
				'label'			=> __('Exclude Taxonomy','unity3'),
				'type'			=> 'select',
				'name'			=> 'post_taxonomy_exclude',
				'key'			=> 'post_taxonomy_exclude',
				'instructions'	=> '',
				'choices'		=> acf_get_taxonomy_terms(),
				'multiple'		=> 1,
				'ui'			=> 1,
				'allow_null'	=> 1,
				'placeholder'	=> __("No taxonomy filter",'unity3'),
			),

			array(
				'type'   => 'number',
				'label'  => 'Max Posts',
				'name'   => 'post_max',
				'key'    => 'post_max',
				'default_value' => 10,
			),

			array(
				'label'       => __( 'Number of Posts to Offset', 'unity3' ),
				'type'        => 'number',
				'name'         => 'post_offset',
				'key '         => 'post_offset',
				'description' => '',
				'default_value' => 0,
			),
			array(
				'label'       => __( 'Order By', 'unity3' ),
				'type'        => 'select',
				'name'        => 'post_orderby',
				'key'         => 'post_orderby',
				'description' => '',
				'choices'     => array(
					'date'           => __( 'Date', 'unity3' ),
					'title'          => __( 'Title', 'unity3' ),
					'parent'         => __( 'Parent', 'unity3' ),
					'menu_order'       => __( 'Menu Order', 'unity3' ),
					'ID'             => __( 'ID', 'unity3' ),
					'comment_count'  => __( 'Comment Count', 'unity3' ),
					'rand'           => __( 'Random', 'unity3' ),
					'meta_value'     => __( 'Meta Value', 'unity3' ),
					'meta_value_num' => __( 'Numeric Meta Value', 'unity3' ),
				),
			),
			array(
				'label'       => __( 'Sort Order', 'unity3' ),
				'type'        => 'select',
				'name'        => 'post_order',
				'key'         => 'post_order',
				'description' => '',
				'choices'     => array(
					'DESC' => __( 'Descending (3, 2, 1)', 'unity3' ),
					'ASC'  => __( 'Ascending (1, 2, 3)', 'unity3' ),
				),
			),
			array(
				'label'       => __( 'Meta Key', 'unity3' ),
				'type'        => 'text',
				'name'        => 'post_meta_key',
				'key'         => 'post_meta_key',
				'description' => '',
			),
			array(
				'label'       => __( 'Work with Pagination', 'unity3' ),
				'type'        => 'checkbox',
				'description' => '',
				'name'        => 'post_paged',
                'key'         => 'post_paged'
			),
			array(
				'label'       => __( 'Show Page Navigation', 'unity3' ),
				'type'        => 'checkbox',
				'description' => '',
				'save'        => false,
				'name'        => 'post_show_paged',
				'key'        => 'post_show_paged'
			),
			array(
				'type'   => 'accordion',
				'key'    => 'accordion_post_query_end',
				'endpoint' => true
			),
			//           END Query
			//************************************************************************

			//************************************************************************
			//     General
			array(
				'type'   => 'accordion',
				'label'  => 'General',
				'key'    => 'accordion_general'
			),

			array(
				'type'   => 'select',
				'label'  => 'Skin',
				'key'    => '_skin',
				'name'   => '_skin',
				'choices' => array('default' => 'Default', 'casual' => 'Casual', 'rosie' => 'Rosie'), //todo: replace with real skin choices
				'default_value' => 'default'
			),

			array(
				'type'   => 'text',
				'label'  => 'Width',
				'key'    => 'width',
				'name'   => 'width',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => '500',
			),
			array(
				'type'   => 'text',
				'label'  => 'Height',
				'key'    => 'height',
				'name'   => 'height',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => '300',
			),
			array(
				'type'   => 'select',
				'label'  => 'Orientation',
				'key'    => 'orientation',
				'name'   => 'orientation',
				'choices' => array('horizontal' => 'Horizontal', 'vertical' => 'Vertical'),
				'default_value' => 'horizontal'
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Arrows',
				'key'    => 'arrows',
				'name'   => 'arrows',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => false,
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Buttons',
				'key'    => 'buttons',
				'name'   => 'buttons',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => true,
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Wait For Layers',
				'key'    => 'waitForLayers',
				'name'   => 'waitForLayers',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => false,
			),
			array(
				'type'   => 'select',
				'label'  => 'Orientation',
				'key'    => 'orientation',
				'name'   => 'orientation',
				'choices' => array('horizontal' => 'Horizontal', 'vertical' => 'Vertical'),
				'default_value' => 'horizontal'
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Full Screen',
				'key'    => 'fullScreen',
				'name'   => 'fullScreen',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => false,
			),

			array(
				'type'   => 'accordion',
				'key'    => 'accordion_general_end',
				'endpoint' => true
			),
			//           END General
			//************************************************************************

			//*****************************************************************************
			//             Slides
			array(
				'type'   => 'accordion',
				'label'  => 'Slides',
				'key'    => 'accordion_slides'
			),
			array(
				'type'   => 'select',
				'label'  => 'Large Image Size',
				'key'    => '_sp_image_size_large',
				'name'   => '_sp_image_size_large',
				'choices' => $image_sizes,
			),
			array(
				'type'   => 'select',
				'label'  => 'Medium Image Size',
				'key'    => '_sp_image_size_medium',
				'name'   => '_sp_image_size_medium',
				'choices' => $image_sizes,
			),
			array(
				'type'   => 'select',
				'label'  => 'Small Image Size',
				'key'    => '_sp_image_size_small',
				'name'   => '_sp_image_size_small',
				'choices' => $image_sizes,
			),
			array(
				'type'   => 'select',
				'label'  => 'Image Scale Mode',
				'key'    => 'imageScaleMode',
				'name'   => 'imageScaleMode',
				'choices' => array(
					'none'    => 'None',
					'cover' => 'Cover',
					'contain'  => 'Contain',
					'exact'   => 'Exact'
				),
				'default_value' => 'cover'
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Center Image',
				'key'    => 'centerImage',
				'name'   => 'centerImage',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => true,
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Allow Scale Up',
				'key'    => 'allowScaleUp',
				'name'   => 'allowScaleUp',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => true,
			),

			array(
				'type'   => 'true_false',
				'label'  => 'Show Title',
				'key'    => '_sp_show_title',
				'name'   => '_sp_show_title',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => true,
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Show Excerpt',
				'key'    => '_sp_show_excerpt',
				'name'   => '_sp_show_excerpt',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => true,
			),
			array(
				'type'   => 'number',
				'label'  => 'Animation Duration',
				'key'    => 'slideAnimationDuration',
				'name'   => 'slideAnimationDuration',
				'default_value' => 700,
			),
			array(
				'type'   => 'number',
				'label'  => 'Fade Duration',
				'key'    => 'fadeDuration',
				'name'   => 'fadeDuration',
				'default_value' => 500,
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Fade',
				'key'    => 'fade',
				'name'   => 'fade',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => true,
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Fade Prev Slide',
				'key'    => 'fadeOutPreviousSlide',
				'name'   => 'fadeOutPreviousSlide',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => true,
			),
			array(
				'type'   => 'accordion',
				'key'    => 'accordion_slides_end',
				'endpoint' => true
			),
			//         END Slides
			//************************************************************************

			//***************************************************************
			//         Thumbnails
			array(
				'type'   => 'accordion',
				'label'  => 'Thumbnails',
				'key'    => 'accordion_thumbnails'
			),

			array(
				'type'   => 'true_false',
				'label'  => 'Show Thumbnails',
				'key'    => '_sp_show_thumbnails',
				'name'   => '_sp_show_thumbnails',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => false,
			),

			array(
				'type'   => 'select',
				'label'  => 'Thumbnail Size',
				'key'    => '_sp_thumbnail_size',
				'name'   => '_sp_thumbnail_size',
				'choices' => $this->get_image_sizes('display'),
			),

			array(
				'type'   => 'select',
				'label'  => 'Position',
				'key'    => 'thumbnailsPosition',
				'name'   => 'thumbnailsPosition',
				'choices' => array(
					'top'    => 'Top',
					'bottom' => 'Bottom',
					'right'  => 'Right',
					'left'   => 'Left'
				),
				'default_value' => 'bottom'
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Pointer',
				'key'    => 'thumbnailPointer',
				'name'   => 'thumbnailPointer',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => false,
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Arrows',
				'key'    => 'thumbnailArrows',
				'name'   => 'thumbnailArrows',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => false,
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Fade Arrows',
				'key'    => 'fadeThumbnailArrows',
				'name'   => 'fadeThumbnailArrows',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => true,
			),
			array(
				'type'   => 'true_false',
				'label'  => 'Touch Swipe',
				'key'    => 'thumbnailTouchSwipe',
				'name'   => 'thumbnailTouchSwipe',
				'wrapper' => array (
					'width' => '50%',
				),
				'default_value' => true,
			),

			array(
				'type'   => 'accordion',
				'key'    => 'accordion_thumbnails_end',
				'endpoint' => true
			),
			//     END Thumbnails
			//************************************************************************
		));
	}

	public function Render($acf_settings_id, $query ) {

		$slider_id = $acf_settings_id;


		$settings = get_field_objects($acf_settings_id, true, true);

		$skin_name = '';
		if (isset($settings['_skin']) && !empty($settings['_skin']['value'])) {
			$skin_name = $settings['_skin']['value'];
		}

		$sp_class = apply_filters('sliderpro/class', 'sliderpro ' . $skin_name, $query);
		$sp_slides_class = apply_filters('sliderpro/slides/class', 'sp-slides', $query);
		$sp_slide_class = apply_filters('sliderpro/slides/slide/class', 'sp-slide', $query);


		if (!($query instanceof WP_Query)) {
			die('You must specify a valid WP_Query to render this SliderPro');
		}

		?>
        <div id="<?php echo $slider_id; ?>" class="<?php echo $sp_class; ?>">
            <div class="<?php echo $sp_slides_class; ?>">
				<?php while ($query->have_posts()) : $query->the_post(); ?>
                    <!-- Slide -->
                    <div class="<?php echo $sp_slide_class; ?>">
						<?php $this->RenderSlide($acf_settings_id, $settings ); ?>
                    </div>
				<?php endwhile; ?>
            </div><!-- end sp-slides-->
			<?php if (isset($settings['_sp_show_thumbnails']) && $settings['_sp_show_thumbnails']['value']) : $query->rewind_posts();?>
                <div class="sp-thumbnails">
					<?php while ($query->have_posts()) : $query->the_post(); ?>
						<?php $this->RenderSlideThumbnail($acf_settings_id, $settings ); ?>
					<?php endwhile; ?>
                </div>
			<?php endif; ?>
        </div> <!-- end sliderpro-->
		<?php

		$sp_values = array();
		if (isset($settings) && is_array($settings)) {
			foreach ($settings as $field_name => $field) {
				if ("post_" === (substr( $field_name, 0, 5 ))) {
					continue; //do not include post query items
				} //else

			    if ("_sp" === substr( $field_name, 0, 3 )) {
                    //
			        //convert special fields into sliderPro js_encode ready values
					if ('_sp_thumbnail_size' == $field_name) {
						$sizes = $this->get_image_sizes('raw');
						$sp_values['thumbnailWidth'] = $sizes[$field['value']]['width'];
						$sp_values['thumbnailHeight'] = $sizes[$field['value']]['height'];
					}
				}
				else if ('number' == $field['type']) {
					$sp_values[$field_name] = (int)$field['value'];
				} else {
					$sp_values[$field_name] = $field['value'];
				}
			}
		}


		?>

        <script type="text/javascript">
            jQuery( document ).ready(function( $ ) {
                $( '#<?php echo $slider_id; ?>' ).sliderPro(
					<?php
					echo acf_json_encode($sp_values);
					?>
                );
            });
        </script>

		<?php
	}

	public function RenderSlide( $acf_settings_id, $settings ) {

		//allow custom html to be generated
		if (apply_filters('sliderpro/slides/slide/render-override', false, $acf_settings_id, $settings) ) {
			return;
		}

		$image_id = get_post_thumbnail_id();
		$image_id = apply_filters('sliderpro/slides/slide/image/id', $image_id, $acf_settings_id, $settings);

		if ($image_id) {

			$sp_image_class = apply_filters('sliderpro/slides/slide/image/class', 'sp-image', $image_id);
			?>

            <img class="<?php echo $sp_image_class; ?>"
                 src="<?php echo Unity3::$blank_img; ?>"
                 data-src="<?php echo wp_get_attachment_image_url($image_id, $settings['_sp_image_size_large']['value']); ?>"
                 data-small="<?php echo wp_get_attachment_image_url($image_id, $settings['_sp_image_size_small']['value']); ?>"
                 data-medium="<?php echo wp_get_attachment_image_url($image_id, $settings['_sp_image_size_medium']['value']); ?>"
                 data-large="<?php echo wp_get_attachment_image_url($image_id, $settings['_sp_image_size_large']['value']); ?>"
            />

			<?php if ($settings['_sp_show_title']['value']) : ?>
                <h3 class="sp-layer sp-black sp-padding"
                    data-horizontal="40" data-vertical="40"
                    data-show-transition="left">
					<?php the_title(); ?>
                </h3>
			<?php endif; ?>

			<?php if ($settings['_sp_show_excerpt']['value']) :
				$the_excerpt = get_the_excerpt();
				?>
                <p class="sp-layer sp-black sp-padding"
                   data-position="bottomLeft" data-vertical="0" data-width="100%"
                   data-show-transition="up">
					<?php echo $the_excerpt; ?>
                </p>
			<?php endif; ?>

			<?php
		}
	}

	public function RenderSlideThumbnail( $acf_settings_id, $settings ) {
		//allow custom html to be generated
		if (apply_filters('sliderpro/slides/slide/thumbnail/render-override', false, $acf_settings_id, $settings) ) {
			return;
		}

		$image_id = apply_filters('sliderpro/slides/slide/thumbnail/image/id', get_post_thumbnail_id(), $acf_settings_id, $settings);

		if ($image_id) {

			$sp_image_class = apply_filters('sliderpro/slides/slide/thumbnail/image/class', 'sp-thumbnail', $image_id);
			?>

            <img class="<?php echo $sp_image_class; ?>"
                 src="<?php echo wp_get_attachment_image_url($image_id, $settings['_sp_thumbnail_size']['value']); ?>"
            />

			<?php
		}
	}

	protected function get_image_sizes( $format = 'raw' ) {

		$builtin_sizes = array(
			'large'   => array(
				'width'  => get_option( 'large_size_w' ),
				'height' => get_option( 'large_size_h' ),
			),
			'medium'  => array(
				'width'  => get_option( 'medium_size_w' ),
				'height' => get_option( 'medium_size_h' ),
			),
			'thumbnail' => array(
				'width'  => get_option( 'thumbnail_size_w' ),
				'height' => get_option( 'thumbnail_size_h' ),
				'crop'   => get_option( 'thumbnail_crop' ),
			),
		);

		global $_wp_additional_image_sizes;
		$additional_sizes = $_wp_additional_image_sizes ? $_wp_additional_image_sizes : array();

		$sizes = array_merge( $builtin_sizes, $additional_sizes );

		if ('display' == $format) {
			$formatted = array();
			foreach ($sizes as $name => $size) {
				$formatted[$name] = (esc_html( $name ) . ' (' . absint( $size['width'] ) . 'x' . absint( $size['height'] ) . ')');
			}
			$sizes = $formatted;
		}

		return $sizes;
	}
}

unity3()->AddWidget( 'Unity3_SliderPro_Post_Widget' );