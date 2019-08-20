<?php
//
class Unity3_Services extends Unity3_Module {

	public function __construct( ) {
		parent::__construct('unity3_services');

		$this->mergeSettings( array(
			'post' => array(
				'menu_title'    => 'Services',
				'menu_position' => 9,
				'menu_icon'     => 'dashicons-clock',
			)
		));
	}

	public function doActivate( ) {
		parent::doActivate();

		require_once (Unity3::$dir . 'includes/modules/class-service-time.php');
		unity3_modules()->Activate( array(
			'unity3_service_time' => array(
				'post' => array( 'show_in_menu' => false)
			)
		));


		//If the user is paying for streaming audio...
		$this->settings['disable_audio'] = (isset($this->settings['disable_audio']) && false === $this->settings['disable_audio']);
		if ( !$this->settings['disable_audio'] ) {
			unity3_modules()->Activate(array(
				'unity3_audio' => array( 'show_custom_group_menu' => false )
			));
		}


		//wire up admin functions
		if (is_admin()) {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		}

		return true;
	}

	function admin_menu() {
		//Add the main menu

		$module = unity3_modules()->Get('unity3_service_time' );
		$main_menu_slug = 'edit.php?post_type=' . $module->GetPostType();

		$hook = add_menu_page(
			$this->settings['post']['menu_title'],
			$this->settings['post']['menu_title'],
			'edit_others_posts',
			$main_menu_slug,
			'',
			$this->settings['post']['menu_icon'],
			$this->settings['post']['menu_position']
		);

		add_submenu_page(
			$main_menu_slug,
			'',
			'Service Times',
			'edit_others_posts',
			$main_menu_slug,
			''
		);


		if (!$this->settings['disable_audio']) {
			$module = unity3_modules()->Get('unity3_audio' );
			$term =	get_term_by( 'slug', isset($this->settings['audio_group']) ? $this->settings['audio_group'] : 'services', $module->GetTaxonomy() );
			if ($term instanceof WP_Term) {
				add_submenu_page(
					$main_menu_slug,
					'',
					$term->name,
					'edit_others_posts',
					'edit.php?post_type=' . $module->GetPostType() . "&{$module->GetTaxonomy()}=" . $term->slug,
					''
				);
			}
		}
	}
}

////*************************
////       Register
////*************************
unity3_modules()->Register(new Unity3_Services());



