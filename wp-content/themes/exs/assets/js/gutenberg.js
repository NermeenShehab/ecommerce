'use strict';
//custom button styles
( function() {

	//internationalization
	var __ = wp.i18n.__;

	///////////////////////////
	//image additional styles//
	///////////////////////////
	wp.blocks.registerBlockStyle( 'core/button',
		[
			{
				name:'transparent',
				label: __('Transparent', 'exs'),
				isDefault: false
			},
			{
				name:'arrow',
				label: __('With Arrow', 'exs'),
				isDefault: false
			},
			{
				name: 'arrow-transparent',
				label: __('Transparent with Arrow', 'exs'),
				isDefault: false
			}
		]
	);

	////////////////////////////////
	//media-text additional styles//
	////////////////////////////////
	wp.blocks.registerBlockStyle( 'core/media-text',
		[
			{
				name: 'text-overlap',
				label: __('Text Overlap', 'exs'),
				isDefault: false
			}
		]
	);

} )();