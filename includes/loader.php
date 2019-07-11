<?php
$upload = wp_upload_dir();
if (file_exists($upload['basedir'] . '/unity3-functions.php')) {
   require_once($upload['basedir'] . '/unity3-functions.php');
}

//utility functions
require_once (Unity3::$dir . 'includes/defaults/defaults.php');
require_once (Unity3::$dir . 'includes/drag-sort-posts/drag-sort-posts.php');

//custom post type functionality
require_once (Unity3::$dir . 'includes/post-types/post-types.php');

require_once (Unity3::$dir . 'includes/dashboard/plugin.php');
require_once (Unity3::$dir . 'includes/flexible-widget-area/plugin.php');
require_once (Unity3::$dir . 'includes/site-updated-notice/plugin.php');
require_once (Unity3::$dir . 'includes/url-shortcodes/url-shortcodes.php');
require_once (Unity3::$dir . 'includes/taxonomy-metabox/plugin.php');
require_once (Unity3::$dir . 'includes/pods-integration.php');
require_once (Unity3::$dir . 'includes/restrict-pages.php');
//require_once (Unity3::$dir . 'includes/sliderpro/sliderpro.php');


//widgets:
require_once (Unity3::$dir . 'includes/widgets/sliderpro-post.php');
require_once (Unity3::$dir . 'includes/widgets/textpro.php');
require_once (Unity3::$dir . 'includes/widgets/featured-url.php');
require_once (Unity3::$dir . 'includes/widgets/credits.php');
require_once (Unity3::$dir . 'includes/flexslider-widget/flexslider-widget.php');


//patches
require_once (Unity3::$dir . 'includes/media-crop-fix.php');