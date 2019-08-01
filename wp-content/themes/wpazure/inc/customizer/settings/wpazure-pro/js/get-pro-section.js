/**
 * Wpazure get pro version
 *
 * @package Wpazure
 */

( function( $, api ) {
	api.sectionConstructor[ 'wpazure-pro-section' ] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function() {},

		// Always make the section active.
		isContextuallyActive: function() {
			return true;
		}
	} );
} )( jQuery, wp.customize );
