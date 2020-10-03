import assign from 'lodash.assign';

const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorControls } = wp.editor;
const { PanelBody, SelectControl } = wp.components;
const { addFilter } = wp.hooks;
const { __ } = wp.i18n;

// Enable effect control on the following blocks
// const enableSpacingControlOnBlocks = [
// 	'core/image',
// ];

// Available effect control options
const effectControlOptions = [
	{
		label: __( 'None' ),
		value: '',
	},
	{
		label: __( 'Fade' ),
		value: 'fade',
	},
	{
		label: __( 'Fade Up' ),
		value: 'fade-up',
	},
	{
		label: __( 'Fade Down' ),
		value: 'fade-down',
	},
	{
		label: __( 'Fade Right' ),
		value: 'fade-right',
	},
	{
		label: __( 'Fade Up Down' ),
		value: 'fade-up-right',
	},
	{
		label: __( 'Fade Up Left' ),
		value: 'fade-up-left',
	},
	{
		label: __( 'Fade Down Right' ),
		value: 'fade-down-right',
	},
	{
		label: __( 'Fade Down Left' ),
		value: 'fade-down-left',
	},
	{
		label: __( 'Flip Up' ),
		value: 'flip-up',
	},
	{
		label: __( 'Flip Down' ),
		value: 'flip-down',
	},
	{
		label: __( 'Flip Left' ),
		value: 'flip-left',
	},
	{
		label: __( 'Flip Right' ),
		value: 'flip-right',
	},
	{
		label: __( 'Slide Up' ),
		value: 'slide-up',
	},
	{
		label: __( 'Slide Down' ),
		value: 'slide-down',
	},
	{
		label: __( 'Slide left' ),
		value: 'slide-left',
	},
	{
		label: __( 'Slide Right' ),
		value: 'slide-right',
	},
	{
		label: __( 'Zoom In' ),
		value: 'zoom-in',
	},
	{
		label: __( 'Zoom In Up' ),
		value: 'zoom-in-up',
	},
	{
		label: __( 'Zoom In Down' ),
		value: 'zoom-in-down',
	},
	{
		label: __( 'Zoom In Left' ),
		value: 'zoom-in-left',
	},
	{
		label: __( 'Zoom In Right' ),
		value: 'zoom-in-right',
	},
	{
		label: __( 'Zoom Out' ),
		value: 'zoom-out',
	},
	{
		label: __( 'Zoom Out Up' ),
		value: 'zoom-out-up',
	},
	{
		label: __( 'Zoom Out Down' ),
		value: 'zoom-out-down',
	},
	{
		label: __( 'Zoom Out Left' ),
		value: 'zoom-out-left',
	},
	{
		label: __( 'Zoom Out Right' ),
		value: 'zoom-out-right',
	},
	/*
	 */
];

/**
 * Add effect control attribute to block.
 *
 * @param {object} settings Current block settings.
 * @param {string} name Name of block.
 *
 * @returns {object} Modified block settings.
 */
const addSpacingControlAttribute = ( settings, name ) => {
	// // Do nothing if it's another block than our defined ones.
	// if ( ! enableSpacingControlOnBlocks.includes( name ) ) {
	// 	return settings;
	// }

	// Use Lodash's assign to gracefully handle if attributes are undefined
	settings.attributes = assign( settings.attributes, {
		aosEffect: {
			type: 'string',
			default: effectControlOptions[ 0 ].value,
		},
	} );

	return settings;
};

addFilter( 'blocks.registerBlockType', 'aos/attribute/effect', addSpacingControlAttribute );

/**
 * Create HOC to add effect control to inspector controls of block.
 */
const withSpacingControl = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		// // Do nothing if it's another block than our defined ones.
		// if ( ! enableSpacingControlOnBlocks.includes( props.name ) ) {
		// 	return (
		// 		<BlockEdit { ...props } />
		// );
		// }

		const { aosEffect } = props.attributes;

		return (
			<Fragment>
			<BlockEdit { ...props } />
		<InspectorControls>
		<PanelBody
		title={ __( 'AOS Effect' ) }
		initialOpen={ true }
			>
			<SelectControl
		label={ __( 'Effect' ) }
		value={ aosEffect }
		options={ effectControlOptions }
		onChange={ ( selectedSpacingOption ) => {
			props.setAttributes( {
				aosEffect: selectedSpacingOption,
			} );
		} }
		/>
		</PanelBody>
		</InspectorControls>
		</Fragment>
	);
	};
}, 'withSpacingControl' );

addFilter( 'editor.BlockEdit', 'aos/with-effect-control', withSpacingControl );

/**
 * Add margin style attribute to save element of block.
 *
 * @param {object} saveElementProps Props of save element.
 * @param {Object} blockType Block type information.
 * @param {Object} attributes Attributes of block.
 *
 * @returns {object} Modified props of save element.
 */
const addSpacingExtraProps = ( saveElementProps, blockType, attributes ) => {
	// // Do nothing if it's another block than our defined ones.
	// if ( ! enableSpacingControlOnBlocks.includes( blockType.name ) ) {
	// 	return saveElementProps;
	// }

	// const margins = {
	// 	small: '5px',
	// 	medium: '15px',
	// 	large: '30px',
	// };

	// if ( attributes.effect in margins ) {
	// 	// Use Lodash's assign to gracefully handle if attributes are undefined
	// 	assign( saveElementProps, { style: { 'margin-bottom': margins[ attributes.effect ] } } );
	// }

	// Use Lodash's assign to gracefully handle if attributes are undefined
	// assign( saveElementProps, { style: { 'margin-bottom': margins[ attributes.effect ] } } );

	// return saveElementProps;

	if ( attributes.aosEffect ) {
		const extraAttrs = {};
		extraAttrs[ 'data-aos' ] = escape( attributes.aosEffect );
		assign( saveElementProps, extraAttrs );
	}

	return saveElementProps;
};

addFilter( 'blocks.getSaveContent.extraProps', 'aos/get-save-content/extra-props', addSpacingExtraProps );
