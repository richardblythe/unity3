<?php
add_action( 'wp_enqueue_scripts', 'unity3_flexible_widget_area_enqueue' );
function unity3_flexible_widget_area_enqueue() {
	wp_enqueue_style( 'unity3-flexible-widget-area', plugins_url('style.css', __FILE__ ));
}

//can be used for other custom flexible widget area
function unity3_flexible_widget_area_class( $id ) {
	$sidebars_widgets = wp_get_sidebars_widgets();
	$count = count( $sidebars_widgets[ $id ] );

	//allow function to be overridden
	$class = apply_filters('unity3_flexible_widgets_area_class_pre', '', $id, $count);

	if (empty($class)) {
		$class = 'widget-area unity3-flexible-widget-area';
		if ( $count == 1 ) {
			$class .= ' widget-full';
		} elseif ($count < 5) {
			switch ($count) {
				case 2:
					$class .= ' widget-halves';
					break;
				case 3:
					$class .= ' widget-thirds';
					break;
				default:
					$class .= ' widget-fourths';
					break;
			}
		} elseif ( $count % 3 == 1 ) {
			$class .= ' widget-thirds';
		} elseif ( $count % 4 == 1 ) {
			$class .= ' widget-fourths';
		} elseif ( $count % 2 == 0 ) {
			$class .= ' widget-halves uneven';
		} else {
			$class .= ' widget-halves';
		}
	}


	return apply_filters('unity3_flexible_widgets_area_class', $class, $id, $count);
}
/**************************************************************************/
/*************    A default flexible widget area  *************************/
function Init_Unity3Footer() {
  class Unity3Footer {
    public function __construct() {

	    add_action( 'widgets_init', array($this, 'register') );
	    add_action( 'genesis_footer', array($this, 'customize'), 0 );
    }

    public function register() {
	    //register a default flexible widget area in the footer
	    genesis_register_sidebar( array(
		    'id' => 'unity3-footer',
		    'name' => __( 'Flexible Footer', 'genesis' ),
		    'description' => __( 'Add a dynamic number of footer widgets to this area', 'unity3' ),
	    ) );
    }

    public function customize() {
	    if ( is_active_sidebar( 'unity3-footer' ) ) {
		    remove_action( 'genesis_footer', 'genesis_do_footer' );
		    add_action( 'genesis_footer', array($this, 'add_footer_area') );
	    }
    }

	public function add_footer_area() {
		  genesis_widget_area( 'unity3-footer', array(
			  'before' => '<div class="'. unity3_flexible_widget_area_class('unity3-footer') .'">',
			  'after'  => '</div>',
		  ) );
    }
  }
  //allow the footer to be 'turned off'
  if (apply_filters('unity3_flexible_widgets_area_load_unity3-footer', true)) {
	  new Unity3Footer();
  }
}

add_action('genesis_init', 'Init_Unity3Footer');

