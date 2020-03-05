<?php
namespace Unity3\Integrations\Genesis;

use Exception;
class Genesis {
	private static $instance;

	private function __construct() {

		//* Deprecated - Change the default footer text
		add_filter('genesis_footer_creds_text', function () {
			return unity3_footer_info_shortcode();
		});

		//Override default footer text
		add_filter( 'genesis_footer_output', function () {
			return unity3_footer_info_shortcode();
		});

		//allow for overrides on the archive pages
		add_action('template_redirect', array(&$this, 'archive_settings') );

		//Remove the URL section on comments
		if (apply_filters('unity3_remove_genesis_comment_url', true)) {
			add_filter( 'genesis_comment_form_args', array(&$this, 'url_filtered') );
			add_filter( 'comment_form_default_fields', array(&$this, 'url_filtered') );
		}

		//Tribe Events Calendar
		add_action( 'get_header', array( &$this,'tribe_genesis_bypass_genesis_do_post_content') );
	}

	static function instance() {
		if (!self::$instance) {
			self::$instance = new Genesis();
		}

		return self::$instance;
	}

	//forces the archive contents to show full content instead of excerpts
	public function archive_settings(){
		//this is a patch for the Tribe Events Calender. There is a conflict with Genesis on
		//the archive 'events' page where it pulls in the site logo as a featured image if the
		//Featured image option is selected in the Genesis archive settings
		if ( is_post_type_archive(apply_filters('unity3_archive_no_featured_image', array('tribe_events'))) ) {
			remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
			remove_action( 'genesis_post_content', 'genesis_do_post_image' );
		}

		//forces the specified archive pages to show full content instead of excerpts
		if( is_post_type_archive(apply_filters('unity3_archive_full_content', array('tribe_events'))) ){
			remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
			remove_action( 'genesis_post_content', 'genesis_do_post_content' );
			add_action( 'genesis_entry_content', 'the_content' );
			add_action( 'genesis_post_content', 'the_content' );
		}


	}

	function tribe_genesis_bypass_genesis_do_post_content() {

		if ( class_exists( 'Tribe__Events__Main' ) || class_exists( 'Tribe__Events__Pro__Main' ) ) {
			if ( tribe_is_event_query() ) { // tribe_is_month() || tribe_is_upcoming() || tribe_is_past() || tribe_is_day() || tribe_is_map() || tribe_is_photo() || tribe_is_week() || ( tribe_is_recurring_event() && ! is_singular( 'tribe_events' ) ) ) {
				remove_all_actions('genesis_entry_header');
				remove_all_actions('genesis_entry_content');
				//remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
				//remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
				add_action( 'genesis_entry_content', 'the_content', 15 );
			}
		}
	}


	protected function __clone() { }

	/**
	 * Singletons should not be restorable from strings.
	 * @throws Exception
	 */
	public function __wakeup()
	{
		throw new Exception("Cannot unserialize a singleton.");
	}
}

Genesis::instance();