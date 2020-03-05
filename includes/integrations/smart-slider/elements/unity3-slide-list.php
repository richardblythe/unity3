<?php

namespace Unity3\Integrations\SmartSlider;
use N2Loader, N2ElementList;
use Unity3_Slides;


N2Loader::import('libraries.form.elements.list');

class N2ElementUnity3SlideList extends N2ElementList {

    protected function fetchElement() {
        
        if  ($module = unity3_modules()->Get(Unity3_Slides::ID) ) {
            
            $groups = $module->GetGroups();
            
            if (count($groups)) {
                foreach ($groups AS $group) {
                    $this->options[$group->term_id] = $group->name;
                }
    
                if ($this->getValue() == '') {
                    $this->setValue($groups[0]->term_id);
                }
            }
        }
        return parent::fetchElement();
    }
}
