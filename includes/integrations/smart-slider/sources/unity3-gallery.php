<?php

namespace Unity3\Integrations\SmartSlider;
use Unity3, Unity3_Galleries, N2Loader, N2GeneratorAbstract;

N2Loader::import('libraries.slider.generator.abstract', 'smartslider');

class N2GeneratorUnity3Gallery extends N2GeneratorAbstract {

    protected $layout = 'image';

    protected function _getData($count, $startIndex) {

        if (is_admin() ) {
            //create dummy slide data for design purposes
            return array(
                array(
                    'image'       => Unity3::$assets_url . '/images/sample-image.jpg',
                    'thumbnail'   => Unity3::$assets_url . '/images/sample-image.jpg',
                    'title'       => 'Sample Title',
                    'description' => 'Sample Description',
                    'caption'     => 'Sample Caption'
                )
            );
        }
            
        //Get the global post that is being requested
        $post = get_post();
        $images = get_post_meta($post->ID, Unity3_Galleries::IMAGES_META_FIELD, true);
        
        $data = array();
        if (false == $images)
            return $data;

        $i = 0;
        foreach ($images as $image_id) {

            $image = get_post($image_id);

            $data[$i]['image']       = wp_get_attachment_image_url( $image_id, 'large' );
            $data[$i]['thumbnail']   = wp_get_attachment_image_url( $image_id, 'thumbnail' );
            $data[$i]['title']       = $image->post_title;
            $data[$i]['description'] = $image->post_content;
            $data[$i]['caption'] = wp_get_attachment_caption( $image_id );
            $i++;
        }

        return $data;
    }
}