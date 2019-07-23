<?php
$upload = wp_upload_dir();
if (file_exists($upload['basedir'] . '/unity3-functions.php')) {
   require_once($upload['basedir'] . '/unity3-functions.php');
}

//utility functions
require_once (Unity3::$dir . 'includes/utilities/defaults.php');
require_once (Unity3::$dir . 'includes/utilities/media-crop-fix.php');
require_once (Unity3::$dir . 'includes/utilities/pods-integration.php');
require_once (Unity3::$dir . 'includes/utilities/restrict-pages.php');
require_once (Unity3::$dir . 'includes/utilities/shortcodes.php');
require_once (Unity3::$dir . 'includes/drag-sort-posts/drag-sort-posts.php');

//custom post type functionality
require_once (Unity3::$dir . 'includes/post-types/post-types.php');



require_once (Unity3::$dir . 'includes/flexible-widget-area/plugin.php');
require_once (Unity3::$dir . 'includes/site-updated-notice/plugin.php');

require_once (Unity3::$dir . 'includes/taxonomy-metabox/plugin.php');


//require_once (Unity3::$dir . 'includes/sliderpro/sliderpro.php');


//widgets:
require_once (Unity3::$dir . 'includes/widgets/dashboard-welcome.php');
require_once (Unity3::$dir . 'includes/widgets/sliderpro.php');
require_once (Unity3::$dir . 'includes/widgets/textpro.php');
require_once (Unity3::$dir . 'includes/widgets/featured-url.php');
require_once (Unity3::$dir . 'includes/widgets/credits.php');
require_once (Unity3::$dir . 'includes/flexslider-widget/flexslider-widget.php');
