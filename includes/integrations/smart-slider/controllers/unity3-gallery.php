<?php
namespace Unity3\Integrations\SmartSlider;
use Unity3ModuleController;


class Unity3_Gallery_Controller extends Unity3ModuleController {
	public function __construct() {
		parent::__construct( 'Unity3_Gallery_SmartSlider3', 'Smart Slider 3', 'unity3_gallery' );

		// //code to refresh cache
		// if(class_exists("N2Loader") && class_exists("N2Cache")){
		//     add_action( 'save_post', array(&$this, 'refreshCache'), 10, 1 );
		// }
	}

	// function refreshCache( $post_id ) {

	//     $post_type = get_post_type( $post_id );
	//     $modules = unity3_modules()->GetAll(false);
	//     foreach ($modules as $module) {

	//         //we only want the modules that represent the current post_type being saved...
	//         if ( is_subclass_of( $module,'Unity3_Post_Type') && $post_type == $module->GetPostType() ) {
	//             $controllers = $module->GetAttachedControllers();
	//             foreach ($controllers as $data) {
	//                 if ( 'smartslider3' == $data['controller_id'] && isset($data['controller_settings']['slider'])  ) {
	//                     N2Loader::import("libraries.slider.abstract", "smartslider");

	//                     N2Cache::clearGroup(N2SmartSliderAbstract::getCacheId( $data['controller_settings']['slider'] ));
	//                     N2Cache::clearGroup(N2SmartSliderAbstract::getAdminCacheId( $data['controller_settings']['slider'] ));
	//                 }
	//             }
	//         }

	//     }

	// }


	public function Render($args) {

		if ( is_singular('unity3_gallery') && isset( $args['settings']['slider'] ) ) {

			// $cached = get_option( 'unity3_controller_smart_slider3_cached', array() );
			// $update_cache = !isset( $cached['post_id'] ); //this will be true if no value is currently stored in wp_options

			// //We sometimes use one smartslider to handle the rendering of multiple galleries, when this happens we need
			// //to clear smartslider's cache when were not rendering the same gallery_id stored in our own cache
			// if ( isset($cached['post_id']) && isset($cached['smartslider3_id']) && $post->ID != $cached['post_id'] ) {

			//     N2Loader::import("libraries.slider.abstract", "smartslider");

			//     N2Cache::clearGroup(N2SmartSliderAbstract::getCacheId( $cached['smartslider3_id'] ));
			//     N2Cache::clearGroup(N2SmartSliderAbstract::getAdminCacheId( $cached['smartslider3_id'] ));

			//     $update_cache = true;
			// }

			// if ( $update_cache ) {
			//     update_option( 'unity3_controller_smart_slider3_cached', array(
			//         'post_id' => $post->ID,
			//         'smartslider3_id' => isset( $args['settings']['slider'] ) ? $args['settings']['slider'] : ''
			//         ),
			//     true );
			// }


			$slider_id = 'slider="' . $args['settings']['slider'] . '"';
			return do_shortcode("[smartslider3 {$slider_id}]");
		}
		//else
		return false;

	}

}