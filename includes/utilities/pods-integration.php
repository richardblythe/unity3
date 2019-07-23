<?php
/**
 * Created by PhpStorm.
 * User: R_Blythe
 * Date: 4/20/2016
 * Time: 12:12 PM
 */

function unity3_pods_audio($ID, $echo = false) {
    global $post;
    $pods = pods( 'sermon', $ID );
    $attr = array(
        'preload' => 'none',
        'style'   => 'display: inline-block; width: 50%; visibility: visible'
    );
    if ($mp3 = $pods->field('mp3')) {
        $attr['mp3'] = wp_get_attachment_url($mp3['ID']);
    }
    if ($ogg = $pods->field('ogg')) {
        $attr['ogg'] = wp_get_attachment_url($ogg['ID']);
    }
    $result = wp_audio_shortcode( $attr );
    if ($echo)
        echo $result;
    else
        return $result;
}