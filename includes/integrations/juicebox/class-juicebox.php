<?php

namespace Unity3\Integrations\Juicebox;

class Juicebox extends \Unity3_Module
{
    public static $dir, $url;

    public function __construct()  {
        parent::__construct('unity3-galleries-juicebox', 'Galleries - Juicebox', 'Renders Unity3 Galleries in Juicebox style.');

        self::$dir = plugin_dir_path(__FILE__);
        self::$url = plugin_dir_url(__FILE__);

        add_action( 'parse_request', array( &$this, 'parse_request'), 10 );
    }

    public function parse_request( $wp ) {
        //used to load the config file
        if ( preg_match( '#^unity3-galleries-juicebox/([0-9]+)/?#', $wp->request, $matches ) ) {
            $_GET['id'] = $matches[1];

            include_once plugin_dir_path( __FILE__ ) . 'config.php';

            exit; // and exit
        }
    }

    function Init()  {
        parent::Init();

        add_filter( 'the_content', array(&$this, 'Render'), 110 );
    }

    private function rewrites() {
        $url = plugins_url('config.php?id=$1', __FILE__);
        $pos = \strpos($url, 'wp-content');
        $from_wp_content = \substr( $url, $pos );

        add_rewrite_rule('unity3-galleries-juicebox/([0-9]+)/?', $from_wp_content , 'top');
    }



    public function Render( $content ) {

        if (is_singular( 'unity3_gallery' )) {

            wp_enqueue_script('juicebox', plugins_url('/jbcore/juicebox.js', __FILE__), array('jquery'), true);

            $post_id = get_the_ID();
            $config_url = site_url( "unity3-galleries-juicebox/{$post_id}/");

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