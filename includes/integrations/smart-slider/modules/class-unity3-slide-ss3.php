<?php

namespace Unity3\Integrations\SmartSlider;

use N2Loader;
use N2Base as Base;
use N2SmartsliderSlidersModel;
use N2SmartsliderSlidesModel;
use Unity3;
use Unity3_Slides;

class Unity3_Slide_Smart_Slider3 extends Unity3_Module_SS3 {

	protected $preset_url, $preset_dir;

	public function __construct() {
		parent::__construct( 'unity3_slide_smartslider3', 'Slides - SS3', 'Connects Unity3 Slides to Smart Slider 3' );
		$this->required_module_id = Unity3_Slides::ID;
	}

	function getSettingsFields() {
		return null;
	}

	function Activate() {
		//scan all slide groups for ss3 integration
		if ( !$slides_module = unity3_modules()->GetActive($this->required_module_id)) {
		    return;
        }

		foreach ( $slides_module->GetGroups() as $group) {
			//creates a term slider if no ss3 slider exists
			$this->createTermSlider( $group->term_id );

			//check all slides for ss3 integration
			$slides = $slides_module->GetGroupPosts($group->term_id, 'term_id');
			foreach ( $slides as $slide ) {
				//if ss3 slide integration is not found, integrate with "custom" preset
				if ( !$slide_id = $this->maybeGetSlideID( $slide->ID ) ) {
					$this->slide_save( $slide_id, true );
				}
			}
		}
	}

	function Init() {
		parent::Init();

		//require slides to be active
		if ( !$slides_module = unity3_modules()->GetActive(Unity3_Slides::ID)) {
			return;
		}

        $this->preset_dir = Unity3::$dir . 'includes/integrations/smart-slider/presets/';
        $this->preset_url = Unity3::$url . 'includes/integrations/smart-slider/presets/';

        add_filter('acf/validate_value/name=ss3_slide_link', array(&$this, 'validate_slide_link'), 101, 4);
        add_action( 'acf/save_post', array( &$this, 'slide_save' ), 101 );
        add_action( 'trashed_post', array( &$this, 'slide_trashed' ), 101 );
        add_action( 'untrashed_post', array( &$this, 'slide_untrashed' ), 101 );
        add_action( 'before_delete_post', array( &$this, 'slide_delete' ), 101 );
        add_action( 'unity3/drag_sort_posts', array( &$this, 'unity3_slide_order_change' ));
        add_action( 'admin_notices', array(&$this, 'ss3_preset_custom_popup') );

        if ( is_admin() ) {
            $slide_tax = $slides_module->GetTaxonomy();
            add_action( "created_{$slide_tax}", array( &$this, 'createTermSlider' ) );
            add_action( 'pre_delete_term', array( &$this, 'deleteTermSlider' ), 10, 2 );

            add_action( 'current_screen', array(&$this, 'current_screen'));

            //listen for SmartSlider changes for it's own editor
            if ( isset($_REQUEST['page']) && 'smart-slider3' === $_REQUEST['page'] &&
                 isset($_REQUEST['slideid']) && $slide_id = (int)$_REQUEST['slideid']) {

                $posts = get_posts( array(
                    'post_type' => Unity3_Slides::ID,
                    'numberposts' => 1,
                    'meta_key' => $this->ID(),
                    'meta_value' => $slide_id
                ));

                if (count($posts)) {
                    //mark the post preset as custom
                    update_post_meta($posts[0]->ID, 'ss3_slide_preset', 'custom');
                }
            }
        }
	}

	function current_screen( $screen ) {
		if ( $screen->post_type != Unity3_Slides::ID)
			return;


		$images = preg_grep('~\.(jpg)$~', scandir($this->preset_dir));

		$choices = array();
		foreach ($images as $image) {
			$file_name = pathinfo($image, PATHINFO_FILENAME);
			$choices[$file_name] = ucwords($file_name);
		}

		//Position Default as the first item
		if (isset($choices['default'])) {
			$default = $choices['default'];
			unset($choices['default']);
			$choices = array('default' => 'Default') + $choices;
		}

		//Position Custom as the last item
		if (isset($choices['custom'])) {
			$default = $choices['custom'];
			unset($choices['custom']);
			$choices = $choices + array('custom' => 'Custom');
		}

		$group_key = $this->ID() . '_appearance';
		acf_add_local_field_group(array(
			'key' => $group_key,
			'title' => 'Appearance',
			'fields' => array(
				array(
					'key' => 'ss3_slide_preset',
					'label' => 'Preset Layouts',
					'name' => 'ss3_slide_preset',
					'type' => 'image_select',
					'instructions' => 'The images below are for demonstration purposes only.  If no selection is made, the layout will revert to the default',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => $choices,
					'default_value' => 'default',
					'multiple' => 0,
					'image_path' => $this->preset_url,
					'image_extension' => 'jpg',
				),
				array(
					'key' => "{$group_key}_advanced_start",
					'label' => 'Advanced',
					'name' => '',
					'type' => 'accordion',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'ss3_slide_preset',
								'operator' => '!=',
								'value' => 'custom',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'open' => 0,
					'multi_expand' => 0,
					'endpoint' => 0,
				),
				array(
					'key' => "{$group_key}_slide_link",
					'label' => 'Slide Link',
					'name' => 'ss3_slide_link',
					'type' => 'text',
					'instructions' => 'Use this field to direct visitors to another page when they click the slide',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => 'example: https://google.com',
				),
				array(
					'key' => "{$group_key}_background_color",
					'label' => 'Background Color',
					'name' => 'ss3_background_color',
					'type' => 'color_picker',
					'instructions' => 'A base color underneath the slide image',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
				),
				array(
					'key' => "{$group_key}_background_image_opacity",
					'label' => 'Slide Image Opacity',
					'name' => 'ss3_background_image_opacity',
					'type' => 'range',
					'instructions' => 'Values under 100% allow the background color to bleed through the slide image.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => -1,
					'min' => -1,
					'max' => 100,
					'step' => '',
					'prepend' => '',
					'append' => '%',
				),
				array(
					'key' => "{$group_key}_background_image_blur",
					'label' => 'Slide Image Blur',
					'name' => 'ss3_background_image_blur',
					'type' => 'range',
					'instructions' => 'Values above 0px provide a blur effect on the slide image',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => -1,
					'min' => -1,
					'max' => 50,
					'step' => '',
					'prepend' => '',
					'append' => 'px',
				),
				array(
					'key' => "{$group_key}_advanced_end",
					'label' => 'Advanced - END',
					'name' => '',
					'type' => 'accordion',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'open' => 0,
					'multi_expand' => 0,
					'endpoint' => 1,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'unity3_slide',
					),
				),
			),
			'menu_order' => 30,
//			'position' => 'side',
			'description' => '',
		));
	}

	public function ss3_preset_custom_popup() {
		$screen = get_current_screen();
		if ($screen && Unity3_Slides::ID == $screen->post_type && $edit_url = $this->getSS3EditUrl() ) :
		?>
			<div id="ss3_custom_popup" class="cd-popup" role="alert">
				<div class="cd-popup-container">
					<h2><?php _e('Important!', Unity3::domain); ?></h2>
                    <p><?php _e('Custom settings are recommended for advanced users only. Editing this slide from SmartSlider will overwrite any changes made in this screen. Would you like to access these advanced features?', Unity3::domain); ?></p>
					<img src="<?php echo SmartSlider::$url . '/images/logo.jpg'; ?>" />
                    <div class="spinner-container"><span class="spinner"></span></div>
                    <ul class="cd-buttons">
						<li><a class="status-ok" href="<?php echo $edit_url; ?>"><?php _e('Yes', Unity3::domain); ?></a></li>
						<li><a href="#" class="status-cancel cd-popup-close"><?php _e('No', Unity3::domain ); ?></a></li>
                    </ul>
					<a href="#" class="cd-popup-close top-right img-replace"><?php _e('Close', Unity3::domain); ?></a>
				</div> <!-- cd-popup-container -->
			</div> <!-- cd-popup -->
		<?php
		endif;
	}

	function validate_slide_link($valid, $value, $field, $input) {
		// bail early if empty or contains a link to an element id
		if( empty($value) ||  0 === strpos($value, '#')) {
			return $valid;
		}


		if( strpos($value, '://') !== false ) {
			// url
		} elseif( strpos($value, '//') === 0 ) {
			// relative url
		} else {
			$value = strpos($value, 'http') !== 0 ? "http://$value" : $value;
		}

		$valid = filter_var($value, FILTER_VALIDATE_URL) ? true : false;

		// return
		return $valid;
	}

	function slide_save( $slide_id = null, $force_custom_preset = false ) {
		$post = get_post( $slide_id );
		$post_id = $post->ID;
		if ( $slider_id = $this->maybeGetSliderID( $post_id )) {
			N2Loader::import(array( 'models.Sliders', 'models.Slides' ), 'smartslider');

			$slidesModel = new N2SmartsliderSlidesModel();

			//attempt to load the smartslider3 slide ref from post meta
			if ( !$slide_id = $this->maybeGetSlideID( $post_id ) ) {
				//we need to create a new slide in smartslider3
				$image_id = get_field('image');


				$slide_id = $slidesModel->createQuickPost(array(
					'title' => get_the_title(),
					'description' => get_the_excerpt(),
					'image' => wp_get_attachment_image_url($image_id, 'unity3_slide')
				), $slider_id);

				//if the smartslider3 create was successful, record the slide id in our post meta
				if ($slide_id) {
					update_post_meta($post_id, $this->ID(), $slide_id);
				}
			}

			$slide = $slide_id ? $slidesModel->get($slide_id) : null;
			//a valid slide could not be located from smartslider3
			if (!$slide) {
				return false;
			}


			//update the slide with the changes
			$slide['title'] = get_the_title($post_id);
			$slide['description'] = get_the_excerpt($post_id);
			$slide['publish_up'] = get_post_meta($post_id, 'slide_start_date', true);
			$slide['publish_down'] = get_post_meta($post_id, 'slide_end_date', true);

			$params = json_decode($slide['params'], true);
			$slide = array_merge($slide, $params);

			//Load data from preset
			$preset_name = $force_custom_preset ? 'custom' : get_post_meta($post_id, 'ss3_slide_preset', true);
			//the preset is marked 'custom' no slide preset will be saved
			if ( 'custom' !== $preset_name ) {
				$file_name = $this->preset_dir . get_post_meta($post_id, 'ss3_slide_preset', true) . '.json';
				if (!$contents = file_get_contents($file_name)) {
					//fall back to default
					$contents = file_get_contents($this->preset_dir . '/default.json');
				}

				$image_id = get_field('image');
				$slide_image = wp_get_attachment_image_url($image_id, 'unity3_slide');
				$slide_image_med = wp_get_attachment_image_url($image_id, 'unity3_slide_med');
				$slide_image_small = wp_get_attachment_image_url($image_id, 'unity3_slide_small');
				$slide_image_xsmall = wp_get_attachment_image_url($image_id, 'unity3_slide_xsmall');

				$slide_link = get_post_meta($post_id, 'ss3_slide_link', true);
				if (empty($slide_link)) {
					$slide_link = '#';
				}

				$visible_if_link = ( '#' === $slide_link ? 0 : 1);

				//replace key vars in string form before decoding the json
				$contents = str_replace(
					array('{SLIDE_IMAGE}', '{SLIDE_IMAGE_MED}', '{SLIDE_IMAGE_SMALL}', '{SLIDE_IMAGE_XSMALL}', '{SLIDE_LINK}', '{VISIBLE_IF_LINK}'),
					array($slide_image,     $slide_image_med,   $slide_image_small,     $slide_image_xsmall,    $slide_link,    $visible_if_link),
					$contents
				);

				//now decode the json string
				$preset = json_decode($contents);
				$slide = array_merge($slide, (array)$preset->data);
				$slide['slide'] = json_encode($preset->layers);


				unset($slide['params']);
				unset($slide['id']);
				unset($slide['slider']);
				unset($slide['first']);
				unset($slide['ordering']);
				unset($slide['version']);
				//
				//sync slider fields
				$slide['backgroundImage'] = $slide_image;
				$slide['thumbnail'] = $slide_image_small;

				//Check for preset overrides
				$bg_color = get_post_meta($post_id, 'ss3_background_color', true);
				if ( !empty($bg_color) ) {
					$slide['backgroundColor'] = substr($bg_color, 1) . 'FF'; //convert to rgba
				}

				$bg_opacity = get_post_meta($post_id, 'ss3_background_image_opacity', true);
				if ( !empty($bg_opacity) && '-1' != $bg_opacity ) {
					$slide['backgroundImageOpacity'] = $bg_opacity;
				}

				$bg_blur = get_post_meta($post_id, 'ss3_background_image_blur', true);
				if ( !empty($bg_opacity) && '-1' != $bg_blur ) {
					$slide['backgroundImageBlur'] = $bg_blur;
				}
			}

			$slidesModel->save($slide_id, $slide, false);
		}
	}

	function getSS3EditUrl() {
		$post_id = get_the_ID();
		$slider_id = $this->maybeGetSliderID( $post_id );
		$slide_id = $this->maybeGetSlideID( $post_id );

		if ( $slider_id && $slide_id ) {
			try {
				return Base::getApplication("smartslider")->router->createUrl(array( 'slides/edit', array('sliderid'=> $slider_id, 'slideid' => $slide_id ) ));
			} catch ( \Exception $e ) {
			}
		}

		return null;
	}

	function unity3_slide_order_change($posts) {

		//get the first post_id
		reset($posts);
		$post_id = key($posts);

		if ($slider_id = $this->maybeGetSliderID($post_id)) {
			N2Loader::import(array( 'models.Sliders', 'models.Slides' ), 'smartslider');
			global $wpdb;
			$slider_refs = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT DISTINCT pm.post_id, pm.meta_value 
				            FROM {$wpdb->postmeta} pm
				            LEFT JOIN {$wpdb->posts} p 
				            ON p.ID = pm.post_id
				            WHERE pm.meta_key = '%s'
				            AND p.post_type = '%s'",
				$this->ID(),
					Unity3_Slides::ID
				), ARRAY_A
			);

			asort($posts);
			foreach ($slider_refs as $index => $row) {
				$posts[(int)$row['post_id']] = $row['meta_value'];
			}

			$slidesModel = new N2SmartsliderSlidesModel();
			$slidesModel->order((int)$slider_id,  array_values($posts) );
		}
	}

	function slide_trashed( $post_id ) {
		if ($slide_id = $this->maybeGetSlideID($post_id)) {
			N2Loader::import(array( 'models.Sliders', 'models.Slides' ), 'smartslider');
			$slidesModel = new N2SmartsliderSlidesModel();
			$slidesModel->unPublish($slide_id);
		}
	}

	function slide_untrashed( $post_id ) {
		if ($slide_id = $this->maybeGetSlideID($post_id)) {
			N2Loader::import(array( 'models.Sliders', 'models.Slides' ), 'smartslider');
			$slidesModel = new N2SmartsliderSlidesModel();
			$slidesModel->publish($slide_id);
		}
	}

	function slide_delete( $post_id ) {
		if ($slide_id = $this->maybeGetSlideID($post_id)) {
			N2Loader::import(array( 'models.Sliders', 'models.Slides' ), 'smartslider');
			$slidesModel = new N2SmartsliderSlidesModel();
			$slidesModel->delete($slide_id);
		}
	}

	function maybeGetSliderID( $post_id ) {
		if (Unity3_Slides::ID == get_post_type($post_id)) {
			return unity3_modules()->Get(Unity3_Slides::ID)->GetPostGroupMeta( $post_id, $this->ID() );
		}
		return null;
	}

	function maybeGetSlideID( $post_id ) {
		if (Unity3_Slides::ID == get_post_type($post_id)) {
			return get_post_meta($post_id, $this->ID(), true);
		}
		return null;
	}
}

unity3_modules()->Register( new Unity3_Slide_Smart_Slider3());