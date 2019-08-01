( function( api ) {

	// Extends our custom "bread-and-cake" section.
	api.sectionConstructor['bread-and-cake'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );