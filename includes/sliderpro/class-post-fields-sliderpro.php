<?php

class Unity3_Post_Fields_SliderPro extends Unity3_Post_Fields {

	public function __construct( ) {
		parent::__construct( 'sliderpro' );
	}

	public function GetFields() {
		return array (
			array (
				'key'           => 'image',
				'label'         => '',
				'name'          => 'image',
				'type'          => 'image',
				'return_format' => 'id',
				'required'      => 1,
				'mime_types'    => 'jpg,jpeg,jpe,gif,png',
				'preview_size'  => 'unity3_slide',
				'wrapper' => array (
					'width' => '100%',
					'class' => 'slide-image'
				),
			),
			array(
				'key' => 'caption',
				'label' => 'Caption',
				'name' => 'caption',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'advanced',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'advanced',
				'label' => 'Advanced Layouts',
				'name' => 'advanced',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'layers',
				'label' => 'Layers',
				'name' => 'layers',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'advanced',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_5d335c6bd817c',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => 'Add Slide Layer',
				'sub_fields' => array(
					array(
						'key' => 'text',
						'label' => 'Text',
						'name' => 'text',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 0,
						'delay' => 0,
					),
					array(
						'key' => 'data-width',
						'label' => 'Width',
						'name' => 'data-width',
						'type' => 'number',
						'instructions' => 'Sets the width of the layer as a percentage of the slide width.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 1,
						'max' => 100,
						'step' => 1,
					),
					array(
						'key' => 'data-position',
						'label' => 'Position',
						'name' => 'data-position',
						'type' => 'select',
						'instructions' => 'Sets the position of the layer in relation to the slide',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'topLeft' => 'Top Left',
							'topCenter' => 'Top Center',
							'topRight' => 'Top Right',
							'bottomLeft' => 'Bottom Left',
							'bottomCenter' => 'Bottom Center',
							'bottomRight' => 'Bottom Right',
							'centerLeft' => 'Center Left',
							'centerRight' => 'Center Right',
							'centerCenter' => 'Center Center',
							'custom' => 'Custom',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'data-horizontal',
						'label' => 'Horizontal',
						'name' => 'data-horizontal',
						'type' => 'text',
						'instructions' => 'Set the horizontal position of the layer',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'data-position',
									'operator' => '==',
									'value' => 'custom',
								),
							),
						),
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'data-vertical',
						'label' => 'Vertical',
						'name' => 'data-vertical',
						'type' => 'text',
						'instructions' => 'Sets the vertical position of the layer',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'data-position',
									'operator' => '==',
									'value' => 'custom',
								),
							),
						),
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5d336f0fdeb80',
						'label' => 'Effect: On Show',
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
						'endpoint' => 0,
					),
					array(
						'key' => 'data-show-transition',
						'label' => 'Direction',
						'name' => 'data-show-transition',
						'type' => 'select',
						'instructions' => 'Sets the movement direction of the layer when it appears in the slide',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'left' => 'Left',
							'right' => 'Right',
							'up' => 'Up',
							'down' => 'Down',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'data-show-offset',
						'label' => 'Distance',
						'name' => 'data-show-offset',
						'type' => 'number',
						'instructions' => 'Sets the distance that the layer will travel during the effect',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 0,
						'max' => '',
						'step' => 1,
					),
					array(
						'key' => 'data-show-duration',
						'label' => 'Duration',
						'name' => 'data-show-duration',
						'type' => 'number',
						'instructions' => 'Sets the duration of the show transition.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 1,
						'max' => '',
						'step' => 1,
					),
					array(
						'key' => 'data-show-delay',
						'label' => 'Delay',
						'name' => 'data-show-delay',
						'type' => 'number',
						'instructions' => 'Sets a delay for the show transition. This delay starts from the moment when the transition to the new slide starts',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 1,
						'max' => '',
						'step' => 1,
					),
					array(
						'key' => 'field_5d337144deb84',
						'label' => 'END - Effect: On Show',
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
					array(
						'key' => 'field_5d337196deb85',
						'label' => 'Effect: On Hide',
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
						'endpoint' => 0,
					),
					array(
						'key' => 'data-hide-transition',
						'label' => 'Direction',
						'name' => 'data-hide-transition',
						'type' => 'select',
						'instructions' => 'Sets the movement direction of the layer when it appears in the slide',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'left' => 'Left',
							'right' => 'Right',
							'up' => 'Up',
							'down' => 'Down',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'data-hide-offset',
						'label' => 'Distance',
						'name' => 'data-hide-offset',
						'type' => 'number',
						'instructions' => 'Sets the distance that the layer will travel during the effect',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 0,
						'max' => '',
						'step' => 1,
					),
					array(
						'key' => 'data-hide-duration',
						'label' => 'Duration',
						'name' => 'data-hide-duration',
						'type' => 'number',
						'instructions' => 'Sets how much time a layer will stay visible before being hidden automatically',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 1,
						'max' => '',
						'step' => 1,
					),
					array(
						'key' => 'data-hide-delay',
						'label' => 'Delay',
						'name' => 'data-hide-delay',
						'type' => 'number',
						'instructions' => 'Sets a delay for the hide transition.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 1,
						'max' => '',
						'step' => 1,
					),
					array(
						'key' => 'field_5d337270deb8a',
						'label' => 'END - Effect: On Hide',
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
			)
		);
	}
}