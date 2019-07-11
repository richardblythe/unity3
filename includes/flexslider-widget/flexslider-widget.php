<?php
/**
 * Unity 3 Flexslider Widget Class
 */
class unity3_flexslider_widget extends WP_Widget {

    const version = '1.0';

    public function __construct() {
        $widget_ops = array( 'classname' => 'unity3-flexslider-widget', 'description' => __( 'Displays a slideshow inside a widget area', 'unity3_flexslider' ) );
        $control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'unity3-flexslider-widget' );
        parent::__construct( 'unity3-flexslider-widget',
            __( 'Unity3 Flex Slider', 'unity3_flexslider' ), 
            $widget_ops, 
            $control_ops 
        );

	    acf_add_local_field_group(array(
		    'key' => "flexslider-widget",
		    'title' => 'Media Group',
		    'fields' => array (
			    array(
				    'type'   => 'select',
				    'label'  => 'Slider Type',
				    'key'    => 'slider_type',
				    'name'   => 'slider_type',
				    //'choices' => unity3_media_slider_get('post_types', array('format' => true) )
			    ),
                array(
	                'type'   => 'select',
	                'label'  => 'Image Size',
	                'key'    => 'image_size',
                    'name'   => 'image_size',
	                //'choices' => unity3_media_get_image_sizes('display'),
                ),
			    array(
				    'type'   => 'true_false',
				    'label'  => 'Show Title',
				    'key'    => 'show_title',
				    'name'   => 'show_title',
				    'wrapper' => array (
					    'width' => '50%',
				    ),
				    'default_value' => true,
			    ),
			    array(
				    'type'   => 'true_false',
				    'label'  => 'Show Caption',
				    'key'    => 'show_caption',
				    'name'   => 'show_caption',
				    'wrapper' => array (
					    'width' => '50%',
				    ),
				    'default_value' => true,
			    ),
			    array(
				    'type'   => 'select',
				    'label'  => 'Animation',
				    'key'    => 'animation',
				    'name'   => 'animation',
				    'choices' => array(
					    'fade' => 'Fade',
					    'slide' => 'Slide'
				    ),
				    'default_value' => 'fade',
			    ),
			    array(
				    'type'   => 'number',
				    'label'  => 'Animation Duration',
				    'key'    => 'animation_duration',
				    'name'   => 'animation_duration',
				    'default_value' => 800,
			    ),
			    array(
				    'type'   => 'true_false',
				    'label'  => 'Direction Nav',
				    'key'    => 'direction_nav',
				    'name'   => 'direction_nav',
				    'wrapper' => array (
					    'width' => '50%',
				    ),
				    'default_value' => true,
			    ),
			    array(
				    'type'   => 'true_false',
				    'label'  => 'Control Nav',
				    'key'    => 'control_nav',
				    'name'   => 'control_nav',
				    'wrapper' => array (
					    'width' => '50%',
				    ),
				    'default_value' => true,
			    ),
			    array(
				    'type'   => 'number',
				    'label'  => 'Slideshow Speed',
				    'key'    => 'slideshow_speed',
				    'name'   => 'slideshow_speed',
				    'default_value' => 4000,
			    ),
		    ),
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

	    wp_enqueue_script('unity3-flexslider-script', plugins_url('jquery.flexslider.min.js', __FILE__), array( 'jquery' ), $this::version);
	    wp_enqueue_style( 'unity3-flexslider-style', plugins_url('flexslider.min.css', __FILE__), array(), $this::version );

        $id = 'widget_' . $widget_id;

	    $classes = apply_filters('unity3_flexslider_classes', 'flexslider unity3-flexslider-widget');
	    $image_size =   get_field('image_size', $id);
	    $show_title =   get_field('show_title', $id);
	    $show_caption = get_field('show_caption', $id);

        $query = unity3_media_slider_get('query', array( 'post_type' => get_field('slider_type', $id) ) );
	    ?>

        <div id="<?php echo $id; ?>" class="<?php echo $classes ?>">
            <ul class="slides" style="visibility: hidden;">
			    <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <li>
                        <div class="aspect-ratio">
                            <div class="content">
							    <?php if (get_field('click_url')) : ?>
                                    <a href="<?php echo get_field('click_url'); ?>" rel="bookmark">
									    <?php echo wp_get_attachment_image( get_field('image'), $image_size); ?>
                                    </a>
							    <?php else: ?>
								    <?php echo wp_get_attachment_image( get_field('image'), $image_size); ?>
							    <?php endif; ?>
                            </div><!-- end .content -->
                        </div><!-- end .aspect-ratio -->
					    <?php if ( $show_title && $show_caption ) : ?>
                            <div class="slide-excerpt slide-<?php the_ID(); ?>">
                                <div class="slide-excerpt-inner">
								    <?php if ( $show_title ) : ?>
                                        <h2>
										    <?php echo esc_html(get_the_title()); ?>
                                        </h2>
								    <?php endif; ?>
								    <?php if ( $show_caption ) : ?>
                                        <p>
										    <?php echo esc_html(get_field('caption')); ?>
                                        </p>
								    <?php endif; ?>

                                </div><!-- end .slide-excerpt-inner  -->
                            </div><!-- end .slide-excerpt  -->
					    <?php endif; ?>
                    </li>
			    <?php endwhile; ?>
            </ul><!-- end ul.slides -->
        </div><!-- eflexslider-widgetider -->

	    <?php

	    $output =
		    'jQuery(document).ready(function($) {
                $("#' . $id .'").flexslider({
                    animation: "' . esc_js( get_field('animation', $id) ) . '",
                    animationDuration: ' . get_field('animation_duration', $id) . ',
                    directionNav: ' . (get_field('direction_nav', $id) ? 'true' : 'false') . ',
                    controlNav: ' . (get_field('control_nav', $id) ? 'true' : 'false') . ',
                    slideshowSpeed: ' . get_field('slideshow_speed', $id) . '
                }).find("ul.slides").css("visibility", "visible");
              });';

	    $output = str_replace( array( "\n", "\t", "\r" ), '', $output );
	    echo '<script type=\'text/javascript\'>' . $output . '</script>';

        echo $after_widget;
    }

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Please Choose A Slider...', 'text_domain' );
		?>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="hidden" value="<?php echo esc_attr( $title ); ?>">
		<?php
	}




}

function _unity3_flexslider_widget_register() {
	register_widget( 'unity3_flexslider_widget' );
}
add_action( 'widgets_init', '_unity3_flexslider_widget_register');