<?php

namespace Unity3\Integrations\Juicebox;

add_action('unity3/modules/load', function() {
    require_once (plugin_dir_path( __FILE__ ) . '/class-juicebox.php');
});