<?php
namespace Unity3\Integrations\SmartSlider;
use N2Loader, N2SliderGeneratorPluginAbstract;
use N2SSGeneratorFactory;

N2Loader::import('libraries.plugins.N2SliderGeneratorPluginAbstract', 'unity3_smartslider');
N2Loader::import('library.smartslider.models.Slides.php', 'unity3_smartslider');

class N2SSPluginGeneratorUnity3 extends N2SliderGeneratorPluginAbstract {

	protected $name = 'unity3';

	public function getLabel() {
		return n2_('Unity 3 Software');
	}

	protected function loadSources() {
		new N2GeneratorUnity3Gallery($this, 'unity3-gallery', n2_('Gallery'));
		new N2GeneratorUnity3Slide($this, 'unity3-slide', n2_('Slide'));
	}


	public function getPath() {
		return dirname(__FILE__) . DIRECTORY_SEPARATOR;
	}
}

N2SSGeneratorFactory::addGenerator( new N2SSPluginGeneratorUnity3());