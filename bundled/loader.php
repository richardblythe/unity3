<?php
$upload = wp_upload_dir();
if (file_exists($upload['basedir'] . '/unity3-functions.php')) {
   require_once($upload['basedir'] . '/unity3-functions.php');
}

require_once (Unity3::$dir . 'bundled/defaults/defaults.php');
require_once (Unity3::$dir . 'bundled/dashboard/plugin.php');
require_once (Unity3::$dir . 'bundled/flexible-widget-area/plugin.php');
require_once (Unity3::$dir . 'bundled/site-updated-notice/plugin.php');
require_once (Unity3::$dir . 'bundled/url-shortcodes/url-shortcodes.php');
require_once (Unity3::$dir . 'bundled/drag-sort-posts/drag-sort-posts.php');
require_once (Unity3::$dir . 'bundled/taxonomy-metabox/plugin.php');
require_once (Unity3::$dir . 'bundled/pods-integration.php');
require_once (Unity3::$dir . 'bundled/restrict-pages.php');

//widgets:
require_once (Unity3::$dir . 'bundled/featured-url-widget/plugin.php');
require_once (Unity3::$dir . 'bundled/textpro-widget/textpro-widget.php');
require_once (Unity3::$dir . 'bundled/credits-widget/plugin.php');

//patches
require_once (Unity3::$dir . 'bundled/media-crop-fix.php');