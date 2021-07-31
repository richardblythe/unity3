<?php
$upload = wp_upload_dir();
if (file_exists($upload['basedir'] . '/unity3-functions.php')) {
   require_once($upload['basedir'] . '/unity3-functions.php');
}

//vendor
require_once (Unity3::$vendor_dir . '/acf-image-select/acf-image-select.php');

//utility functions
require_once (Unity3::$dir . 'includes/utilities/defaults.php');
require_once (Unity3::$dir . 'includes/utilities/media-crop-fix.php');
require_once (Unity3::$dir . 'includes/utilities/pods-integration.php');
require_once (Unity3::$dir . 'includes/utilities/restrict-pages.php');
require_once (Unity3::$dir . 'includes/utilities/shortcodes.php');
require_once (Unity3::$dir . 'includes/utilities/class-block-area.php');
require_once (Unity3::$dir . 'includes/class-drag-sort-posts.php');

//custom post type functionality
require_once (Unity3::$dir . 'includes/modules/modules.php');

//load integrations
//require_once (Unity3::$dir . 'includes/integrations/smart-slider/smart-slider.php');
require_once (Unity3::$dir . 'includes/integrations/juicebox/juicebox.php');
require_once (Unity3::$dir . 'includes/integrations/genesis/genesis.php');
require_once (Unity3::$dir . 'includes/integrations/aos/aos.php');


require_once (Unity3::$dir . 'includes/flexible-widget-area/plugin.php');
require_once (Unity3::$dir . 'includes/class-site-update-notice.php');

require_once (Unity3::$dir . 'includes/taxonomy-metabox/plugin.php');




//widgets:
$files = array_diff(scandir(Unity3::$dir . 'includes/widgets'), array('.', '..') );
foreach ($files as $file) {
	require_once (Unity3::$dir . 'includes/widgets/' . $file);
}
//require_once (Unity3::$dir . 'includes/widgets/dashboard-welcome.php');
//require_once (Unity3::$dir . 'includes/widgets/textpro.php');
//require_once (Unity3::$dir . 'includes/widgets/featured-url.php');
//require_once (Unity3::$dir . 'includes/widgets/credits.php');
//require_once (Unity3::$dir . 'includes/flexslider-widget/flexslider-widget.php');

//BLOCKS
require_once (Unity3::$dir . 'includes/blocks/class-author-signature.php');
require_once (Unity3::$dir . 'includes/blocks/class-recent-images.php');
require_once (Unity3::$dir . 'includes/blocks/class-gallery-images.php');