<?php
/**
 * Featured URL widget class.
 *
 * @since 0.1.8
 *
 * @package Genesis\Widgets
 */
class Unity3_Credits_Widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 0.1.8
	 */
	function __construct() {

		$this->defaults = array(
			'type' => 'Basic',
		);

		$widget_ops = array(
			'classname'   => 'unity3-credits',
			'description' => __( 'Displays the website credits for Unity 3 Software', 'unity3_credits' ),
		);

		$control_ops = array(
			'id_base' => 'unity3-credits',
			'width'   => 200,
			'height'  => 250,
		);

		parent::__construct( 'unity3-credits', __( 'Unity 3 Credits', 'unity3_credits' ), $widget_ops, $control_ops );

	}

	/**
	 * Echo the widget content.
	 *
	 * @since 0.1.8
	 *
	 * @global WP_Query $wp_query Query object.
	 * @global integer  $more
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {

		//* Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$type            = empty($instance['type']) ? 'basic' : $instance['type'];
        $copyright_owner = empty($instance['copyright_owner']) ? get_bloginfo('name') : $instance['copyright_owner'];

		echo $args['before_widget'];

        switch ($type) {
            case 'copyright':
                printf('<span class="copyright">&#169; %s</span> <span class="business">%s</span> 
                    <p class="copyright-content">Except as permitted by the copyright law applicable to you, 
                    you may not reproduce any of the content on this website, 
                    including files downloadable from this website, without the permission of 
                    the copyright owner.</p>
                    <p class="unity3-content">Site design by 
                        <a href="mailto:unity3software@gmail.com" 
                           title="Unity 3 Software"
                           class="credits-unity3"
                           style="white-space: nowrap;"
                        >
                          Unity 3 Software
                       </a>
                   </p>', date( 'Y' ), $copyright_owner);

                break;
            default: //'basic'
	            echo do_shortcode('[unity3_footer_info]');
                break;
        }



		echo $args['after_widget'];

	}

	/**
	 * Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @since 0.1.8
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form()
	 * @param array $old_instance Old settings for this instance
	 * @return array Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {

		$new_instance['type']            = strip_tags( $new_instance['type'] );
		$new_instance['copyright_owner'] = strip_tags( $new_instance['copyright_owner'] );
		return $new_instance;

	}

	/**
	 * Echo the settings update form.
	 *
	 * @since 0.1.8
	 *
	 * @param array $instance Current settings
	 */
	function form( $instance ) {

		//* Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );
        
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'Display Type', 'unity3' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
                <option value="basic" <?php selected( 'basic', $instance['type'] ); ?>><?php _e( 'Basic', 'unity3' ); ?></option>
				<option value="copyright" <?php selected( 'copyright', $instance['type'] ); ?>><?php _e( 'Copyright', 'unity3' ); ?></option>
			</select>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'copyright_owner' ); ?>"><?php _e( 'Copyright Owner', 'unity3' ); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'copyright_owner' ); ?>" name="<?php echo $this->get_field_name( 'copyright_owner' ); ?>" value="<?php echo esc_attr( $instance['copyright_owner'] ); ?>" class="widefat" />
        </p>

		<?php

	}

}

unity3()->AddWidget('Unity3_Credits_Widget' );
