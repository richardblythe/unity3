<?php
//
class Unity3_Services extends Unity3_Module {

	public function __construct( ) {
		parent::__construct('unity3_services');

		$this->settings = wp_parse_args( array(
			'menu_title'    => 'Services',
			'menu_position' => 9,
			'menu_icon'     => 'dashicons-clock',
		), $this->settings );
	}

	public function Activate( $args ) {
		if (!parent::Activate( $args )) {
			return false;
		}

		require_once (Unity3::$dir . 'includes\modules\class-service-time.php');
		unity3_modules()->Activate( array(
			'unity3_service_time' => array(
				'post_type_settings' => array( 'show_in_menu' => false)
			)
		));


		//If the user is paying for streaming audio...
		$this->args['disable_audio'] = (isset($args['disable_audio']) && false === $args['disable_audio']);
		if ( !$this->args['disable_audio'] ) {
//			require_once (Unity3::$dir . 'includes\modules\class-service-audio.php');

			unity3_modules()->Activate(array(
				'unity3_audio' => array('post_type_settings' => array( 'show_in_menu' => false ) )
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
			$this->settings['menu_title'],
			$this->settings['menu_title'],
			'edit_others_posts',
			$main_menu_slug,
			'',
			$this->settings['menu_icon'],
			$this->settings['menu_position']
		);

		add_submenu_page(
			$main_menu_slug,
			'',
			'Service Times',
			'edit_others_posts',
			$main_menu_slug,
			''
		);


		$module = unity3_modules()->Get('unity3_audio' );

	    $term =	get_term_by( 'slug', isset($this->args['audio_group']) ? $this->args['audio_group'] : 'services', $module->GetTaxonomy() );
	    if ($term instanceof WP_Term) {
		    add_submenu_page(
			    $main_menu_slug,
			    '',
			    'Streaming Audio',
			    'edit_others_posts',
			    'edit.php?post_type=' . $module->GetPostType() . "&{$module->GetTaxonomy()}=" . $term->slug,
			    ''
		    );
	    }


	}
}

////*************************
////       Register
////*************************
unity3_modules()->Register(new Unity3_Services());



