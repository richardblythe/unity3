<?php

namespace Unity3\Integrations\SmartSlider;
use Unity3_Slides, N2Loader, N2GeneratorAbstract, N2Tab;


N2Loader::import('libraries.slider.generator.abstract', 'smartslider');

class N2GeneratorUnity3Slide extends N2GeneratorAbstract {

    protected $layout = 'image';

     public function renderFields($form) {
         parent::renderFields($form);

         $filter = new N2Tab($form, 'Filter', n2_('Filter'));

         new N2ElementUnity3SlideList($filter, 'slide-group', n2_('Slide Group'), '');
     }

    protected function _getData($count, $startIndex) {

	    $data = array();
	    $slide_group = $this->data->get('slide-group', '');
	    if ($slide_group && $slides = Unity3_Slides::Get($slide_group)) {
		    $i = 0;
		    foreach ($slides as $slide) {
			    $data[$i]['image']       = get_the_post_thumbnail_url($slide->ID, 'unity3_slide');
			    $data[$i]['thumbnail']   = get_the_post_thumbnail_url($slide->ID, 'unity3_slide_small');
			    $data[$i]['title']       = $slide->post_title;
			    $data[$i]['caption'] = $slide->post_excerpt;
			    $i++;
		    }
	    }
	    return $data;
    }
}