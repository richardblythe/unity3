<?php
N2Loader::import('libraries.slider.generator.abstract', 'smartslider');

class N2GeneratorUnity3Gallery extends N2GeneratorAbstract {

    protected $layout = 'image';

    // public function renderFields($form) {
    //     parent::renderFields($form);

    //     $filter = new N2Tab($form, 'Filter', n2_('Filter'));

    //     new N2ElementUnity3GalleryList($filter, 'group', n2_('Gallery Group'), '');
    // }

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
        $images = get_post_meta($post->ID, 'gallery', true);
        
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