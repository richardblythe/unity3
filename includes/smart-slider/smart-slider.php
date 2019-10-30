<?php

function smart_slider_load_unity3() {

    N2Loader::import('libraries.plugins.N2SliderGeneratorPluginAbstract', 'smartslider');
    
    class N2SSPluginGeneratorUnity3 extends N2SliderGeneratorPluginAbstract {
    
        protected $name = 'unity3';
    
        public function getLabel() {
            return n2_('Unity 3 Software');
        }
    
        protected function loadSources() {
    
            new N2GeneratorUnity3Gallery($this, 'unity3-gallery', n2_('Gallery'));
        }
    
        public function getPath() {
            return dirname(__FILE__) . DIRECTORY_SEPARATOR;
        }
    }
    
    N2SSGeneratorFactory::addGenerator(new N2SSPluginGeneratorUnity3);

}

add_action('smartslider3_generator', 'smart_slider_load_unity3');


function unity3_init_smartslider_controller() {

    if ( !class_exists('N2Loader') ) 
        return;

    class Unity3ControllerSmartSlider3 extends Unity3ModuleController {
        public function __construct() {
            parent::__construct( 'smartslider3', 'Smart Slider 3', 'unity3_gallery' );

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

            global $post;

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

    unity3_modules()->RegisterController( new Unity3ControllerSmartSlider3() );



}

add_action( 'unity3/modules/controllers/load', 'unity3_init_smartslider_controller' );


function unity3_smartslider_hide_css( $selectors ) {
    $current_user = wp_get_current_user();
    $is_admin_role = in_array( 'administrator', (array) $current_user->roles );
    $screen = get_current_screen();

    // SMART SLIDER HIDE IF NOT ADMIN USER
    if (!$is_admin_role && 'toplevel_page_smart-slider3' == $screen->base) {
        $selectors = $selectors + array(
            //Global
            '.n2-header-menu.n2-header-right a[href*="nextendcontroller=settings"]',
            '.n2-heading-actions',
            '#n2-ss-create-group',
            //Dashboard
            '.n2-box-new-slider',
            '.n2-box-template-library',
            '.n2-h1.n2-heading a[href*="changelog"]',
            '.n2-ss-box-slider[data-title^="_unity3"]', //reserved for Unity3 controlled slides
            //Slide Screen
            '#n2-form-matrix-slider-settings',
            '#n2-tab-widgets',
            '.n2-slider-name .n2-h1:HOVER:after',
            '.n2-ss-slides-create-action-box[data-action="empty"]',
            '.n2-ss-slides-create-action-box[data-action="static"]',
            '.n2-ss-slides-create-action-box[data-action="dynamic"]'
        );
    }
    return $selectors;
}

add_filter('unity3/admin/css/hide/', 'unity3_smartslider_hide_css');