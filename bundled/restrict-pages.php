<?php
class Unity3_Restrict_Pages {
	function __construct() {
		add_action('admin_init', array(&$this, 'admin_init'));
	}

    public function admin_init() {
		if ($roles = apply_filters('unity3_restrict_pages', array('editor', 'author'))) {

			add_action('admin_menu', array(&$this, 'modify_menu'));
			add_action('admin_head', array(&$this, 'hide_add_new'));


			foreach ($roles as $role_name) {
				if ($role = get_role($role_name))
					$role->remove_cap('publish_pages');
			}

			if($_GET['permissions_error']) {
				add_action('admin_notices', array(&$this, 'admin_notice'));
			}
		}
	}

	public function modify_menu() {
		$result = stripos($_SERVER['REQUEST_URI'], 'post-new.php?post_type=page');
		if ($result!==false && !current_user_can('publish_pages')) {
			wp_redirect(get_option('siteurl') . '/wp-admin/index.php?permissions_error=true');
		}

		global $submenu;
		unset($submenu['edit.php?post_type=page'][10]);
		$submenu['edit.php?post_type=page'][10][1] = 'publish_pages';
	}

 	public function hide_add_new() {
		global $current_screen;
		if($current_screen->id == 'edit-page' && !current_user_can('publish_pages')) {
			echo '<style>.add-new-h2{display: none;}</style>';
		}
	}


	public function admin_notice() {
		echo "<div id='permissions-warning' class='error fade'><p><strong>".__('You do not have permission to access that page.')."</strong></p></div>";
	}
}

new Unity3_Restrict_Pages();