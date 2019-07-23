<?php
class Unity3_Restrict_Pages {
	function __construct() {
		if (!(defined('DOING_AJAX') && DOING_AJAX)) {
			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('admin_menu', array(&$this, 'modify_menu'));
			add_action('admin_head', array(&$this, 'hide_add_new'));

			//add_filter('page_row_actions', array(&$this, 'modify_page_actions'), 10, 2);
		}
	}

    public function admin_init() {
		if ($roles = apply_filters('unity3_restrict_pages', array('editor', 'author'))) {

			foreach ($roles as $role_name) {
				if ($role = get_role($role_name)) {
					$role->remove_cap('publish_pages');
					$role->remove_cap('delete_pages');
					$role->remove_cap('delete_published_pages');
					$role->remove_cap('delete_others_pages');
					$role->remove_cap('delete_private_pages');
				}
			}

			if(isset($_GET['permissions_error'])) {
				add_action('admin_notices', array(&$this, 'admin_notice'));
			}
		}
	}

	public function modify_menu() {
		if (current_user_can('publish_pages'))
			return;

		if (false !== stripos($_SERVER['REQUEST_URI'], 'post-new.php?post_type=page')) {
			wp_redirect(get_option('siteurl') . '/wp-admin/index.php?permissions_error=true');
		}

		global $submenu;
		unset($submenu['edit.php?post_type=page'][10]);
		$submenu['edit.php?post_type=page'][10][1] = 'publish_pages';
	}

 	public function hide_add_new() {
		global $current_screen;
		if(('page' == $current_screen->id || 'edit-page' == $current_screen->id) && !current_user_can('publish_pages')) {
			echo '<style>.add-new-h2,.page-title-action{display: none;}</style>';
		}
	}


	public function admin_notice() {
		echo "<div id='permissions-warning' class='error fade'><p><strong>".__('You do not have permission to access that page.')."</strong></p></div>";
	}
}

new Unity3_Restrict_Pages();