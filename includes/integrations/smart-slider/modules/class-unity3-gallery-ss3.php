<?php
namespace Unity3\Integrations\SmartSlider;

use N2Loader;
use N2SmartsliderGeneratorModel;
use N2SmartsliderSlidesModel;

class Unity3_Gallery_SmartSlider3 extends Unity3_Module_SS3 {

	protected $new_sliders;
	protected $slider_tax;

	public function __construct() {
		parent::__construct( 'unity3_gallery_ss3', 'Galleries - SS3', 'Connects Unity3 Galleries to Smart Slider 3' );
	}

	function getSettingsFields() {
		return null;
	}

	function Activate() {

		//scan all gallery groups for ss3 integration
		$gallery_module = unity3_modules()->Get(Unity3_Slides::ID);
		foreach ( $gallery_module->GetGroups() as $group) {
			//creates a term slider if no ss3 slider exists
			$this->createTermSlider( $group->term_id );
		}

	}

	function Init() {
		parent::Init();

		if ( is_admin() ) {
			$this->slider_tax = unity3_modules()->Get( 'unity3_gallery' )->GetTaxonomy();
			add_action( "created_{$this->slider_tax}", array( &$this, 'createTermSlider' ) );
			add_action( 'pre_delete_term', array( &$this, 'deleteTermSlider' ), 10, 2 );
			add_action('smartslider3_generator', array(&$this, 'maybe_new_generator_slide'), 1000);
		}
	}

	function createTermSlider( $term_id, $args = null) {
		if ( $slider_id = parent::createTermSlider( $term_id, $args ) ) {
			if (!isset($this->new_sliders)) {
				$this->new_sliders = array();
			}

			$this->new_sliders[] = $slider_id;
		}
	}

	function maybe_new_generator_slide() {

		if (!$this->new_sliders)
			return;

		foreach ($this->new_sliders as $new_slider) {
			$generatorModel = new N2SmartsliderGeneratorModel();
			$result         = $generatorModel->createGenerator($new_slider, array(
				'record-slides'     => 10000,
				'record-start'      => 1,
				'record-group'      => 1,
				'cache-expiration'  => 0,
				'group'             => 'unity3',
				'type'              => 'unity3-gallery'
			));
		}
	}

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

unity3_modules()->Register( new Unity3_Gallery_SmartSlider3());