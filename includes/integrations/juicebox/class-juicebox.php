<?php

namespace Unity3\Integrations\Juicebox;

class Juicebox extends \Unity3_Module
{
    public static $dir, $url;

    public function __construct()  {
        parent::__construct('unity3-galleries-juicebox', 'Galleries - Juicebox', 'Renders Unity3 Galleries in Juicebox style.');

        self::$dir = plugin_dir_path(__FILE__);
        self::$url = plugin_dir_url(__FILE__);
    }

    function Init()  {
        parent::Init();
//        add_action('wp_enqueue_scripts', array(&$this, 'enqueue'));
        add_filter( 'the_content', array(&$this, 'Render'), 110 );
    }

    public function Render( $content ) {

        if (is_singular( 'unity3_gallery' )) {

            wp_enqueue_script('juicebox', plugins_url('/jbcore/juicebox.js', __FILE__), array('jquery'), true);

            $post_id = get_the_ID();
            $config_url = plugins_url('config.php?id='. $post_id, __FILE__);

            $content = "<div id=\"juicebox-{$post_id}\" style=\"display:inline-block;\"></div>        
                <script>
                jQuery( document ).ready(function() {
                    var jb = new juicebox({
                        configURL:  '{$config_url}',
                        containerId : 'juicebox-{$post_id}',
                        galleryWidth: '100%',
                        galleryHeight: '80%',
                        backgroundColor: '#222222',
                        captionBackColor: 'rgba(0,0,0,.7)',
                        buttonBarHAlign: 'LEFT',
                        showOpenButton: false,
                        showAutoPlayButton: true,
                        showImageOverlay: 'ALWAYS',
                        autoPlayOnLoad: true,
                        displayTime: 10,
                        showNavButtons: true,
                        enableLooping: true,
                        screenMode: 'AUTO'
                    });
                });
                </script>";
        }

        return $content;
    }
}

////*************************
////       Register
////*************************
unity3_modules()->Register(new Juicebox());