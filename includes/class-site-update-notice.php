<?php

function Load_SiteUpdatedNotice() {
	class SiteUpdatedNotice {


		public function __construct() {
			if ((defined('DOING_AJAX') && DOING_AJAX)) {
				add_action( 'wp_ajax_unity3_site_updated_notice_dismiss', array(&$this, 'dismiss'));
				add_action( 'wp_ajax_unity3_site_updated_notice', array(&$this, 'update'));
			} else {
				add_action( 'admin_enqueue_scripts', array($this,'enqueue') );
				add_filter( 'unity3/localize/admin', function ( $localize ) {
				    return array_merge($localize,   array(
				    	'site_update' => array(
				    		'progress_gif' => Unity3::$assets_url . '/images/ajax-loader.gif'
				        )
				    ));
                });
				//if the user hasn't clicked the dismiss icon since the last update...
				if (1 != get_user_option('unity3_site_updated_dismiss')) {
					add_action( 'admin_notices', array(&$this, 'print_notice') );
				}

				if ( $this->is_developer() ) {
					add_action('admin_bar_menu', array($this, 'update_adminbar'), 999);
					add_action('admin_footer', array($this, 'print_dialog'));
				}
			}

		}

		protected function is_developer(){
			$current_user = wp_get_current_user();
		    return 'unity3software@gmail.com' == $current_user->user_email ||
		           'richardblythe84@gmail.com' == $current_user->user_email;
        }

		// update toolbar
		function update_adminbar($wp_adminbar) {
			// add Admin Bar menu
			$wp_adminbar->add_node(array(
				'id' => 'unity3-site-updated-notice',
				'title' => 'Update Site Notice',
				'href' => '#'
            ));
		}

		function enqueue() {
			if ($this->is_developer()) {
				//enqueue the jquery dialog box code.  This allows the update notice to be updated
				wp_enqueue_script( 'jquery-ui-dialog' );
				wp_enqueue_script( 'jquery-effects-core' );
				wp_enqueue_style( 'wp-jquery-ui-dialog' );

//				wp_localize_script('unity3-site-updated-notice', 'unity3_site_update_notice', array(
//				    'progress_gif' => Unity3::$assets_url . '/images/ajax-loader.gif'
//                ) );
			}
		}

		public function print_dialog(){
		    $option = get_option('unity3-site-update', array('time' => current_time('timestamp'), 'message' => __('God Bless!', 'unity3_site_update_notice')));
		    ?>

            <div id="unity3-site-update-dialog" title="Site Update" style="display: none">
                <label for="unity3-site-update-time">Date:</label>
                <input type="text" id="unity3-site-update-time" style="width: 99%;" autocomplete="off"
                value="<?php echo date( 'm/j/Y' ); ?>"
                >

                <label for="unity3-site-update-message">Message:</label>
                <textarea id="unity3-site-update-message" rows="4" style="width: 99%;"><?php echo stripslashes($option['message']); ?></textarea>
            </div>

            <?php
        }

		public function print_notice() {
			$option = get_option('unity3-site-update', false);
			if (false == $option) { return; }
			?>
			<div class="notice notice-info unity3-site-updated-notice is-dismissible">
                <div class="content">
                    <?php
                    $content = $this->get_notice_content($option);
                    echo $content;
                    ?>
                </div>
			</div>
			<?php
		}

		private function get_notice_content($option) {
		    return
			    '<p>' . sprintf( __('This site was updated by unity3software on %s.',Unity3::domain ), date( 'l, F j, Y',$option['time'])) . '</p>' .
			    '<p>' . stripslashes($option['message']) . '</p>';
        }

		public function update() {
		    update_option('unity3-site-update', array('time' =>  strtotime($_REQUEST['unity3_time']), 'message' => $_REQUEST['unity3_message']));
			global $wpdb;
			$wpdb->update($wpdb->usermeta, array('meta_value' => 0), array('meta_key' => 'unity3_site_updated_dismiss'));
            $option = get_option('unity3-site-update', false);
            $notice_content = $this->get_notice_content($option);
            wp_send_json_success($notice_content);
		}

		public function dismiss() {
			$user_id = get_current_user_id();
			update_user_option($user_id,'unity3_site_updated_dismiss', 1, true);
			wp_send_json_success();
		}
	}

	new SiteUpdatedNotice();
}

add_action('admin_init', 'Load_SiteUpdatedNotice');