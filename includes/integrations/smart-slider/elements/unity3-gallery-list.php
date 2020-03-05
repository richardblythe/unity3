<?php

namespace Unity3\Integrations\SmartSlider;
use N2Loader, N2ElementList;



N2Loader::import('libraries.form.elements.list');

class N2ElementUnity3GalleryList extends N2ElementList {

    protected function fetchElement() {
        
        if  ($module = unity3_modules()->Get('unity3_gallery') ) {
            
            $groups = $module->GetGroups();
            
            if (count($groups)) {
                foreach ($groups AS $group) {
                    $this->options[$group->ID] = $group->name;
                }
    
                if ($this->getValue() == '') {
                    $this->setValue($groups[0]->ID);
                }
            }
        }




        return parent::fetchElement();
    }
}
