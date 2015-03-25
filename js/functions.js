svgeezy.init( 'nocheck', 'png' );

jQuery( document ).ready( function( $ ) {
	// Change menu toggle wording to reflect current state
	$( '.menu-toggle' ).click( function(event) {
		if ( 'Show Menu' == $( this ).text() ) {
			$( this ).text( 'Hide Menu' );
		} else if ( 'Hide Menu' == $( this ).text() ) {
			$( this ).text( 'Show Menu' );
		}
	});
} );