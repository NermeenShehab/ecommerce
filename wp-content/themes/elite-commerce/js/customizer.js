/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

jQuery( document ).ready(function($) {
	"use strict";
	/**
	 * Dropdown Select2 Custom Control
	 */

	$('.customize-control-select2').select2({
		allowClear: true
	});

	$(".customize-control-select2").on("change", function() {
		var select2Val = $(this).val();
		$(this).parent().find('.customize-control-dropdown-select2').val(select2Val).trigger('change');
	});
});

/**
 * Remove attached events from the Upsell Section to stop panel from being able to open/close
 */
( function( $, api ) {
	api.sectionConstructor['elite-commerce-upsell'] = api.Section.extend( {

		// Remove events for this type of section.
		attachEvents: function () {},

		// Ensure this type of section is active. Normally, sections without contents aren't visible.
		isContextuallyActive: function () {
			return true;
		}
	} );
} )( jQuery, wp.customize );
