<?php

namespace Unity3\Integrations\SmartSlider;
use Exception;
use Unity3;

class SmartSlider {
	public static $dir, $url;
	private static $instance;

	public function __construct() {
		self::$dir = plugin_dir_path( __FILE__ );
		self::$url = plugin_dir_url( __FILE__ );
	}

	function init() {
		add_action('smartslider3_generator', function() {
			require_once ( self::$dir . 'class-generator.php' );
		});

		add_action( 'unity3/modules/load', array(&$this, 'load_modules') );
	}

	function load_modules() {

		if ( !defined('NEXTEND_SMARTSLIDER_3') )
			return;

		require_once(self::$dir . '/modules/class-unity3-module-ss3.php');
		require_once(self::$dir . '/modules/class-unity3-gallery-ss3.php');
		require_once(self::$dir.  '/modules/class-unity3-slide-ss3.php');

		//
        add_filter('unity3/admin/css/hide/',  array( &$this, 'smartslider_hide_css') );
        add_action('admin_enqueue_scripts', array(&$this, 'enqueue'));
	}

	function enqueue() {
//		$folder = is_admin() ? 'admin' : 'front';
		;

		//currently there is only an admin scripts folder
		if (get_current_screen() && get_current_screen()->post_type == \Unity3_Slides::ID ) {
			wp_enqueue_script( 'unity3_slide_smartslider-admin-script',SmartSlider::$url . "scripts/admin/unity3-smart-slider.js", array('jquery', 'acf-input'), Unity3::ver, false);
			wp_enqueue_style( 'unity3_slide_smartslider-admin-style', SmartSlider::$url . "/styles/admin/unity3-smart-slider.css", false, Unity3::ver);
		}

//		wp_enqueue_style( 'unity3-style', Unity3::$assets_url . "/styles/{$folder}/unity3-{$folder}{$this->min}css", false, Unity3::ver);
	}

	function smartslider_hide_css( $selectors ) {
		$current_user = wp_get_current_user();
		$is_admin_role = in_array( 'administrator', (array) $current_user->roles );
		$screen = get_current_screen();

		// SMART SLIDER HIDE IF NOT ADMIN USER
		if (!$is_admin_role && 'toplevel_page_smart-slider3' == $screen->base) {
			$selectors = $selectors + array(
					//Global
					'.n2-header-menu.n2-header-right a[href*="nextendplugin=settings"]',
					'.n2-heading-actions',
					'#n2-ss-create-group',
					//Dashboard
					'.n2-ss-sliders-header .n2-bulk-select',
					'.n2-box-new-slider',
					'.n2-box-template-library',
					'.n2-ss-box-slider .n2-ss-box-select',
					'#n2-ss-slider-menu',
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
}

$smartslider = new SmartSlider();
$smartslider->init();



