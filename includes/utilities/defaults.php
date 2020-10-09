<?php
function Load_Unity3Defaults() {
	class Unity3Defaults {
		public function __construct() {
			add_action( 'admin_init', array( &$this, 'admin_init') );
			add_action( 'admin_head', array( &$this, 'admin_head') );

			add_filter( 'single_template', array( &$this, 'single_template'), 100, 3 );

			add_filter('comment_moderation_recipients', array(&$this, 'comment_moderation_recipients'), 11, 2);


			//convert Clearbase templates to Genesis
			add_action('clearbase_template_start', array(&$this, 'clearbase_template_start'));

			//this disables (among other things) the uploading of audio.
			add_filter('upload_mimes', array( &$this, 'default_mime_types' ), 10, 1 );
			/***************************************************************
			If the client is paying for Amazon S3 storage, the commented out code
			below needs to added to the theme's unity3-functions file.
            NOTE: IF USING THE POST TYPE: unity3_audio, THIS CODE IS ADDED AUTOMATICALLY
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



		/**
		 * Single template function which will choose our template
		 *
		 * @param string $single The current single template path
		 *
		 * @return string The possible filtered template path
		 */
		function single_template( $template, $type, $template_names ) {
			global $wp_query, $post;

			$paths = apply_filters( 'unity3_custom_template_path', array() );
			foreach ( $paths as $path ) {
                foreach ( (array) get_the_category() as $cat ) {
                    if ( file_exists( $path . '/single-cat-' . $cat->slug . '.php' ) ) {
                        return $path . '/single-cat-' . $cat->slug . '.php';
                    } elseif ( file_exists( $path . '/single-cat-' . $cat->term_id . '.php' ) ) {
                        return $path . '/single-cat-' . $cat->term_id . '.php';
                    }
                }
                //
                //else search for standard templates in the custom directory path
                foreach ( (array) $template_names as $template_name ) {
                    if (!$template_name) {
                        continue;
                    }
                    if (file_exists($path . '/' . $template_name)) {
                        return $path . '/' . $template_name;
                    }
                }
            }

			return $template;
		}

		public function admin_init() {
			add_action( 'pre_get_posts', array(&$this,'admin_hide_pages') );
			add_action( 'hidden_meta_boxes', array(&$this, 'remove_meta_boxes'), 1000, 2 );
			add_filter( 'mce_buttons_2', array(&$this, 'mce_buttons_2') );
			add_filter( 'tiny_mce_before_init', array(&$this, 'mce_before_init'), 10, 2 );
			add_filter('acf/load_field/type=date_time_picker', array(&$this, 'acf_default_date'));
		}

		/**
		 * Removes the category, author, post excerpt, and slug meta boxes.
		 *
		 * @since    1.0.0
		 *
		 * @param    array    $hidden    The array of meta boxes that should be hidden for Acme Post Types
		 * @param    object   $screen    The current screen object that's being displayed on the screen
		 * @return   array    $hidden    The updated array that removes other meta boxes
		 */
		function remove_meta_boxes( $hidden, $screen ) {

			global $wp_meta_boxes;

			$post_type = $screen->post_type;
			//example
            /*
             * $includes = array(
             *    'post' => array(
             *        'commentdiv' => 'equals|true',
             *        'acf_'        => 'startsWith',
             *        '_mybox'     => 'endsWith',
             *        '_editbox_'    => 'contains',
             *     )
             * );
             *
             */
			$includes = apply_filters('unity3/hide_metaboxes/include', false, $screen->post_type);
			if (!$includes) {
			    return $hidden;
            }

			$post_types = array_keys($includes);


			if( in_array($post_type, $post_types) && isset( $wp_meta_boxes[$post_type] ) )
			{
				$tmp = array();
				foreach( (array) $wp_meta_boxes[$post_type] as $context_key => $context_item )
				{
					foreach( $context_item as $priority_key => $priority_item )
					{
						foreach( $priority_item as $metabox_key => $metabox_item ) {
                            //establish the bias to remove the meta_box
							$remove_the_metabox = true;
						    //now loop through our "include" filters
                            foreach ($includes[$post_type] as $target_metabox_key => $value) {

						        switch ($value) {
                                    case 'startsWith':
	                                    if ( strpos($metabox_key, $target_metabox_key) === 0 ) {
		                                    $remove_the_metabox = false;
	                                    }
                                        break;
                                    case 'endsWith':
	                                    $len = strlen($target_metabox_key);
	                                    if ($len == 0 || substr($metabox_key, -$len) === $target_metabox_key) {
		                                    $remove_the_metabox = false;
	                                    }
	                                    break;
                                    case 'contains':
	                                    if ( strpos($metabox_key, $target_metabox_key) !== false ) {
		                                    $remove_the_metabox = false;
	                                    }
                                        break;
							        case 'equals':
							        case true:
                                    default:
								        if ($target_metabox_key == $metabox_key) {
									        $remove_the_metabox = false;
								        }
								        break;
                                }

                                if (!$remove_the_metabox)
                                    break;
                            }

							if ( $remove_the_metabox ) {
								unset($wp_meta_boxes[$post_type][$context_key][$priority_key][$metabox_key]);
							}
						}
					}
				}
			}

			return $hidden;

		}

		function acf_default_date($field) {
			if ( strpos($field['default_value'], '__') === 0 ) {
			    $field['default_value'] = strtotime(substr($field['default_value'], 2), time());
			}

			return $field;
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
		public function admin_head() {
			global $pagenow;

			$selectors = array();
			$current_user = wp_get_current_user();
			$is_admin_role = in_array( 'administrator', (array) $current_user->roles );
			$screen = get_current_screen();
			
			if (!$is_admin_role && in_array( $pagenow, array( 'edit.php', 'post.php', 'post-new.php' ))) {
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
				$selectors = $selectors + $screen_option_boxes;
				//
				$selectors = array_merge($selectors, apply_filters('unity3_hide_misc', array(
					'#wp-content-media-buttons .nf-insert-form', 
					'#add_pod_button'))
				);
			}

			//Allow the selection list to be filtered
			$selectors = apply_filters('unity3/admin/css/hide/', $selectors);

			?>
			<!-- Unity3 Hide Elements  -->
			<style type="text/css">
				<?php echo implode(',', $selectors); ?>{display:none!important;}
			</style>
			<?php

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
				 'ico' => 'image/x-icon',

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

	}
	new Unity3Defaults();
}

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



function unity3_get_image_sizes( $format = 'display' ) {

	$builtin_sizes = array(
		'large'   => array(
			'width'  => get_option( 'large_size_w' ),
			'height' => get_option( 'large_size_h' ),
		),
		'medium'  => array(
			'width'  => get_option( 'medium_size_w' ),
			'height' => get_option( 'medium_size_h' ),
		),
		'thumbnail' => array(
			'width'  => get_option( 'thumbnail_size_w' ),
			'height' => get_option( 'thumbnail_size_h' ),
			'crop'   => get_option( 'thumbnail_crop' ),
		),
	);

	global $_wp_additional_image_sizes;
	$additional_sizes = $_wp_additional_image_sizes ? $_wp_additional_image_sizes : array();

	$sizes = array_merge( $builtin_sizes, $additional_sizes );

	if ('display' == $format) {
		$formatted = array();
		foreach ($sizes as $name => $size) {
			$formatted[$name] = (esc_html( $name ) . ' (' . absint( $size['width'] ) . 'x' . absint( $size['height'] ) . ')');
		}
		$sizes = $formatted;
	}

	return $sizes;
}

/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function get_image_sizes() {
	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}

	return $sizes;
}

/**
 * Get size information for a specific image size.
 *
 * @uses   get_image_sizes()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|array $size Size data about an image size or false if the size doesn't exist.
 */
function get_image_size( $size ) {
	$sizes = get_image_sizes();

	if ( isset( $sizes[ $size ] ) ) {
		return $sizes[ $size ];
	}

	return false;
}

/**
 * Get the width of a specific image size.
 *
 * @uses   get_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Width of an image size or false if the size doesn't exist.
 */
function get_image_width( $size ) {
	if ( ! $size = get_image_size( $size ) ) {
		return false;
	}

	if ( isset( $size['width'] ) ) {
		return $size['width'];
	}

	return false;
}

/**
 * Get the height of a specific image size.
 *
 * @uses   get_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Height of an image size or false if the size doesn't exist.
 */
function get_image_height( $size ) {
	if ( ! $size = get_image_size( $size ) ) {
		return false;
	}

	if ( isset( $size['height'] ) ) {
		return $size['height'];
	}

	return false;
}

function unity3_embed_responsive( $url, $width = 123, $height = 456 ) {
    $res = array(
        'width'		=> $width,
        'height'	=> $height
    );

    // get emebed
    $embed = @wp_oembed_get( $url, $res );


    // try shortcode
    if( !$embed ) {

        // global
        global $wp_embed;


        // get emebed
        $embed = $wp_embed->shortcode($res, $url);

    }

    return $embed ? ('<div class="embed-container">' . $embed . '</div>') : '';
}