<?php
function Load_Unity3Defaults() {
	class Unity3Defaults {
		public function __construct() {
			add_action( 'admin_init', array(&$this, 'admin_init') );
			add_action( 'admin_head', array(&$this, 'admin_hide_meta_boxes'));

			add_filter('comment_moderation_recipients', array(&$this, 'comment_moderation_recipients'), 11, 2);
			//Remove the URL section on comments
			if (apply_filters('unity3_remove_genesis_comment_url', true)) {
				add_filter( 'genesis_comment_form_args', array(&$this, 'url_filtered') );
				add_filter( 'comment_form_default_fields', array(&$this, 'url_filtered') );
			}

			//convert Clearbase templates to Genesis
			add_action('clearbase_template_start', array(&$this, 'clearbase_template_start'));

			//allow for overrides on the archive pages
			add_action('template_redirect', array(&$this, 'archive_settings') );

			//* Change the footer text
			add_filter('genesis_footer_creds_text', array(&$this, 'genesis_footer_creds') );

			//this disables (among other things) the uploading of audio.
			add_filter('upload_mimes', array( &$this, 'default_mime_types' ), 10, 1 );
			/***************************************************************
			If the client is paying for Amazon S3 storage, the commented out code
			below needs to added to the theme's unity3-functions file:
			//***************************************************************/
			// function unity3_aws_storage_mime( $types ) {
			//   return array_merge($types, array(
			//     // Audio formats.
			//     'mp3|m4a|m4b' => 'audio/mpeg',
			//     'ogg|oga' => 'audio/ogg',
			//     'wma' => 'audio/x-ms-wma',
			//   ));
			// }
			// add_filter('upload_mimes', 'unity3_aws_storage_mime', 12, 1);
			//*****************************************************************

			add_filter( 'as3cf_allowed_mime_types', array( &$this, 'aws_allowed_mime_types' ), 10, 1 );
			//allows a caller to use this action to safely use the unity3_register_post_type() method
			do_action('unity3_register_post_types');
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

		public function admin_init() {
			add_action( 'pre_get_posts', array(&$this,'admin_hide_pages') );
			add_filter( 'mce_buttons_2', array(&$this, 'mce_buttons_2') );
			add_filter( 'tiny_mce_before_init', array(&$this, 'mce_before_init'), 10, 2 );

			add_editor_style( plugins_url('/css/genesis-editor-columns.css', __FILE__) );
		}

		/**
		 * Filters wp_notify_moderator() recipients: $emails includes only author e-mail,
		 * unless the authors e-mail is missing or the author has no moderator rights.
		 *
		 * @since 0.4
		 *
		 * @param array $emails     List of email addresses to notify for comment moderation.
		 * @param int   $comment_id Comment ID.
		 * @return array
		 */
		public function comment_moderation_recipients($emails, $comment_id)
		{
			$comment = get_comment($comment_id);
			$post = get_post($comment->comment_post_ID);
			$user = get_userdata($post->post_author);

			// Return only the post author if the author can modify.
			if ( user_can($user->ID, 'edit_comment', $comment_id) && !empty($user->user_email) )
				return array( $user->user_email );

			return $emails;
		}
		public function admin_hide_meta_boxes() {
			global $pagenow;
			if (!in_array( $pagenow, array( 'edit.php', 'post.php', 'post-new.php' ), FALSE ) )
				return;

			$current_user = wp_get_current_user();
			if ('unity3software' != $current_user->user_login) {
				//Get a list of all the metaboxes to be hidden
				$selectors = apply_filters('unity3_hide_meta_boxes', array('#pageparentdiv', '#trackbacksdiv', '#slugdiv',
						'#postcustom', '#genesis_inpost_seo_box', '#genesis_inpost_layout_box', '#genesis_inpost_scripts_box',
						'#ninja_forms_selector', '#twitter-custom',
						'.post-type-tribe_events #event_venue', '.post-type-tribe_events #event_organizer',
						'.post-type-tribe_events #event_url', '.post-type-tribe_events #event_cost')
				);
				//now we will hide the Screen Option boxes that are related to the meta boxes
				$screen_option_boxes = array();
				foreach ($selectors as $selector) {
					if (0 === strpos($selector, '#'))
						$screen_option_boxes[] = 'label[for="'. substr($selector, 1) .'-hide"]';
				}
				$selectors = array_merge($selectors, $screen_option_boxes);
				//
				$misc_elements = apply_filters('unity3_hide_misc', array('#wp-content-media-buttons .nf-insert-form', '#add_pod_button'));
				//
				$selectors = array_merge($selectors, $misc_elements);
				?>
                <!-- Unity3 Hide Elements  -->
                <style type="text/css">
                    <?php echo implode(',', $selectors); ?>{display:none !important;}
                </style>
				<?php
			}
		}



		public function admin_hide_pages( $query ) {
			if( isset( $_GET['post_type'] )
			    && $_GET['post_type'] == 'page'
			    && $query->query['post_type'] == 'page'
			    && !current_user_can( 'manage_options' ) ) {
				$query->set( 'post__not_in', apply_filters('unity3_admin_hide_pages', array()));
			}
		}

		public function clearbase_template_start() {
			remove_action('clearbase_controller_before', 'clearbase_controller_before');
			remove_action('clearbase_controller_after', 'clearbase_controller_after');

			add_action('clearbase_controller_before', array(&$this, 'clearbase_controller_before'));
			add_action('clearbase_controller_after', array(&$this, 'clearbase_controller_after'));
		}

		public function clearbase_controller_before() {
			echo '<main class="content">';
		}

		public function clearbase_controller_after() {
			echo '</main>';
		}

		/**
		 * Show the style dropdown on the second row of the editor toolbar.
		 *
		 * @param array $buttons Exising buttons
		 * @return array Amended buttons
		 */
		function mce_buttons_2( $buttons ) {

			// Check if style select has not already been added
			if ( isset( $buttons['styleselect'] ) )
				return;

			// Appears not, so add it ourselves.
			array_unshift( $buttons, 'styleselect' );
			return $buttons;

		}

		/**
		 * Add column entries to the style dropdown.
		 *
		 * 'unity3-defaults' should be replaced with your theme or plugin text domain for
		 * translations.
		 *
		 * @param array $settings Existing settings for all toolbar items
		 * @return array Amended settings
		 */
		function mce_before_init( $settings ) {

			$style_formats = array(
				array(
					'title' => __( 'First Half', 'unity3-defaults' ),
					'block' => 'div',
					'classes' => 'one-half first'
				),
				array(
					'title' => __( 'Half', 'unity3-defaults' ),
					'block' => 'div',
					'classes' => 'one-half'
				),
				array(
					'title' => __( 'First Third', 'unity3-defaults' ),
					'block' => 'div',
					'classes' => 'one-third first'
				),
				array(
					'title' => __( 'Third', 'unity3-defaults' ),
					'block' => 'div',
					'classes' => 'one-third'
				),
				array(
					'title' => __( 'First Quarter', 'unity3-defaults' ),
					'block' => 'div',
					'classes' => 'one-fourth first'
				),
				array(
					'title' => __( 'Quarter', 'unity3-defaults' ),
					'block' => 'div',
					'classes' => 'one-fourth'
				),
				array(
					'title' => __( 'First Fifth', 'unity3-defaults' ),
					'block' => 'div',
					'classes' => 'one-fifth first'
				),
				array(
					'title' => __( 'Fifth', 'unity3-defaults' ),
					'block' => 'div',
					'classes' => 'one-fifth'
				),
				array(
					'title' => __( 'First Sixth', 'unity3-defaults' ),
					'block' => 'div',
					'classes' => 'one-sixth first'
				),
				array(
					'title' => __( 'Sixth', 'unity3-defaults' ),
					'block' => 'div',
					'classes' => 'one-sixth'
				)
			);

			// Check if there are some styles already
			if ( isset($settings['style_formats'] ) )
				$settings['style_formats'] = array_merge( $settings['style_formats'], json_encode( $style_formats ) );
			else
				$settings['style_formats'] = json_encode( $style_formats );

			return $settings;

		}

		public function url_filtered( $fields ) {
			if ( isset( $fields['url'] ) )
				unset( $fields['url'] );

			if ( isset( $fields['fields']['url'] ) )
				unset( $fields['fields']['url'] );

			return $fields;
		}


		public function default_mime_types( $types ) {
			return array(
				// Image formats.
				'jpg|jpeg|jpe' => 'image/jpeg',
				'gif' => 'image/gif',
				'png' => 'image/png',
				// 'bmp' => 'image/bmp',
				// 'tiff|tif' => 'image/tiff',
				// 'ico' => 'image/x-icon',

				// Video formats.
				// 'asf|asx' => 'video/x-ms-asf',
				// 'wmv' => 'video/x-ms-wmv',
				// 'wmx' => 'video/x-ms-wmx',
				// 'wm' => 'video/x-ms-wm',
				// 'avi' => 'video/avi',
				// 'divx' => 'video/divx',
				// 'flv' => 'video/x-flv',
				// 'mov|qt' => 'video/quicktime',
				// 'mpeg|mpg|mpe' => 'video/mpeg',
				// 'mp4|m4v' => 'video/mp4',
				// 'ogv' => 'video/ogg',
				// 'webm' => 'video/webm',
				// 'mkv' => 'video/x-matroska',
				// '3gp|3gpp' => 'video/3gpp', // Can also be audio
				// '3g2|3gp2' => 'video/3gpp2', // Can also be audio

				// Text formats.
				'txt|asc|c|cc|h|srt' => 'text/plain',
				'csv' => 'text/csv',
				'tsv' => 'text/tab-separated-values',
				'ics' => 'text/calendar',
				'rtx' => 'text/richtext',
				'css' => 'text/css',
				'htm|html' => 'text/html',
				'vtt' => 'text/vtt',
				'dfxp' => 'application/ttaf+xml',
				// Audio formats.
				// 'mp3|m4a|m4b' => 'audio/mpeg',
				// 'ra|ram' => 'audio/x-realaudio',
				// //'wav' => 'audio/wav',
				// 'ogg|oga' => 'audio/ogg',
				// //'mid|midi' => 'audio/midi',
				// 'wma' => 'audio/x-ms-wma',
				// //'wax' => 'audio/x-ms-wax',
				// //'mka' => 'audio/x-matroska',

				// Misc application formats.
				'rtf' => 'application/rtf',
				// 'js' => 'application/javascript',
				'pdf' => 'application/pdf',
				// 'swf' => 'application/x-shockwave-flash',
				// 'class' => 'application/java',
				'tar' => 'application/x-tar',
				'zip' => 'application/zip',
				// 'gz|gzip' => 'application/x-gzip',
				// 'rar' => 'application/rar',
				// '7z' => 'application/x-7z-compressed',
				// 'exe' => 'application/x-msdownload',
				// 'psd' => 'application/octet-stream',
				// 'xcf' => 'application/octet-stream',
				// MS Office formats.
				'doc' => 'application/msword',
				// 'pot|pps|ppt' => 'application/vnd.ms-powerpoint',
				// 'wri' => 'application/vnd.ms-write',
				// 'xla|xls|xlt|xlw' => 'application/vnd.ms-excel',
				// 'mdb' => 'application/vnd.ms-access',
				// 'mpp' => 'application/vnd.ms-project',
				'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'docm' => 'application/vnd.ms-word.document.macroEnabled.12',
				'dotx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
				'dotm' => 'application/vnd.ms-word.template.macroEnabled.12',
				'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				'xlsm' => 'application/vnd.ms-excel.sheet.macroEnabled.12',
				'xlsb' => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
				'xltx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
				'xltm' => 'application/vnd.ms-excel.template.macroEnabled.12',
				'xlam' => 'application/vnd.ms-excel.addin.macroEnabled.12',
				'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
				'pptm' => 'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
				'ppsx' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
				'ppsm' => 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
				'potx' => 'application/vnd.openxmlformats-officedocument.presentationml.template',
				'potm' => 'application/vnd.ms-powerpoint.template.macroEnabled.12',
				'ppam' => 'application/vnd.ms-powerpoint.addin.macroEnabled.12',
				'sldx' => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
				'sldm' => 'application/vnd.ms-powerpoint.slide.macroEnabled.12',
				'onetoc|onetoc2|onetmp|onepkg' => 'application/onenote',
				'oxps' => 'application/oxps',
				'xps' => 'application/vnd.ms-xpsdocument',
				// OpenOffice formats.
				'odt' => 'application/vnd.oasis.opendocument.text',
				'odp' => 'application/vnd.oasis.opendocument.presentation',
				'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
				'odg' => 'application/vnd.oasis.opendocument.graphics',
				'odc' => 'application/vnd.oasis.opendocument.chart',
				'odb' => 'application/vnd.oasis.opendocument.database',
				'odf' => 'application/vnd.oasis.opendocument.formula',
				// WordPerfect formats.
				'wp|wpd' => 'application/wordperfect',
				// iWork formats.
				'key' => 'application/vnd.apple.keynote',
				'numbers' => 'application/vnd.apple.numbers',
				'pages' => 'application/vnd.apple.pages',
			);
		}

		/**
		 * This AWS filter allows your limit specific mime types of files that
		 * can be uploaded to S3. They will still be uploaded to the WordPress media library
		 * but ignored from the S3 upload process
		 */
		public function aws_allowed_mime_types( $types ) {
			// we only want...
			return array(
				// Audio formats.
				'mp3|m4a|m4b' => 'audio/mpeg',
				'ra|ram' => 'audio/x-realaudio',
				'wav' => 'audio/wav',
				'ogg|oga' => 'audio/ogg',
				'mid|midi' => 'audio/midi',
				'wma' => 'audio/x-ms-wma',
				'wax' => 'audio/x-ms-wax',
				'mka' => 'audio/x-matroska',
				// Video formats.
				'asf|asx' => 'video/x-ms-asf',
				'wmv' => 'video/x-ms-wmv',
				'wmx' => 'video/x-ms-wmx',
				'wm' => 'video/x-ms-wm',
				'avi' => 'video/avi',
				'divx' => 'video/divx',
				'flv' => 'video/x-flv',
				'mov|qt' => 'video/quicktime',
				'mpeg|mpg|mpe' => 'video/mpeg',
				'mp4|m4v' => 'video/mp4',
				'ogv' => 'video/ogg',
				'webm' => 'video/webm',
				'mkv' => 'video/x-matroska',
				'3gp|3gpp' => 'video/3gpp', // Can also be audio
				'3g2|3gp2' => 'video/3gpp2', // Can also be audio
			);
		}

		public function genesis_footer_creds( $creds ) {
			return unity3_footer_info_shortcode();
		}

	}
	new Unity3Defaults();
}
function unity3_footer_info_shortcode( ) {
	return '&#169;' . date( 'Y' ) . ' &middot; Site design by 
    <a href="mailto:unity3software@gmail.com" 
       title="Unity 3 Software"
       class="credits-unity3"
       style="white-space: nowrap;"
    >
      Unity 3 Software
   </a>';
}
add_shortcode( 'unity3_footer_info', 'unity3_footer_info_shortcode' );



function array_merge_recursive_distinct(array &$array1, array &$array2)
{
	$merged = $array1;
	foreach ($array2 as $key => &$value)
	{
		if (is_array($value) && isset($merged[$key]) && is_array($merged[$key]))
		{
			$merged[$key] = array_merge_recursive_distinct($merged[$key], $value);
		}
		else
		{
			$merged[$key] = $value;
		}
	}
	return $merged;
}


function unity3_cpt_menu_bubble( $menu ) {
	global $unity3_ctp_bubbles;
	if (isset($unity3_ctp_bubbles) && 0 !== count($unity3_ctp_bubbles)) {
		foreach( $menu as $menu_key => $menu_data )
		{
			$count = isset($unity3_ctp_bubbles[$menu_data[2]]) ? $unity3_ctp_bubbles[$menu_data[2]] : false;
			if( $count) {
				$menu[$menu_key][0] .= " <span class='update-plugins count-{$count}'><span class='plugin-count'>{$count}</span></span>";
			}
		}
	}
	return $menu;
}
add_filter( 'add_menu_classes', 'unity3_cpt_menu_bubble');


function unity3_post_status_changed( $new_status, $old_status, $post ) {
	$post_type = get_post_type($post);
	if ( $new_status == 'publish' && !in_array($post_type, array('post', 'page'))) {
		delete_transient( "cpt_menu_bubble_{$post_type}");
	}
}
add_action( 'transition_post_status', 'unity3_post_status_changed', 10, 3 );

add_action('init', 'Load_Unity3Defaults');