<?php
namespace Unity3\Integrations\SmartSlider;

use N2Loader;
use N2Base as Base;
use N2SmartsliderSlidersModel;
use N2SmartsliderSlidesModel;

abstract class Unity3_Module_SS3 extends \Unity3_Module {

	protected $required_module_id;

	function Init() {
		parent::Init();

		add_action( 'admin_notices', function (){
			if ( $this->required_module_id && !unity3_modules()->IsActive($this->required_module_id) ) {
				$module = unity3_modules()->Get($this->required_module_id);
				$required_module_name = $module ? $module->Name() : $this->required_module_id;
				?>
				<div class="notice notice-error">
					<p><?php echo sprintf( __('%s requires the following module to be active: %s'), $this->Name(), $required_module_name ) ?></p>
				</div>
				<?php
			}
		} );
	}

	function createTermSlider( $term_id, $args = array() ) {

		//see if a slider has already been created for this term
		if ($slider_id = get_term_meta( $term_id, $this->ID(), true) )
			return false;

		$term = get_term($term_id);
		$args = array_merge(
			array(
				'title'       => $term->name,
				'type'        => 'simple',
				'width'       => 1200,
				'height'      => 500,
				'widgetarrow' => 'imageEmpty',
			), is_array($args) ? $args : array()
		);


		N2Loader::import(array( 'models.Sliders' ), 'smartslider');
		$slidersModel = new N2SmartsliderSlidersModel();

		$args = apply_filters( "{$this->ID()}/create/args", $args );

		//create the new slider
		if ( $slider_id = $slidersModel->create( $args ) ) {
			update_term_meta( $term_id, $this->ID(), $slider_id );
		}
		return $slider_id ? $slider_id : false;
	}

	function deleteTermSlider( $term_id ) {
		//see if a slider has been created for this term
		if ( !$slider_id = (int)get_term_meta( $term_id, $this->ID(), true)) {
			return false;
		}

		N2Loader::import(array( 'models.Sliders' ), 'smartslider');
		$slidersModel = new N2SmartsliderSlidersModel();

		//delete the slider from smartslider3
		$slidersModel->delete($slider_id);

		return true;
	}

	function createSlide($sliderID, $slide) {

	}
}