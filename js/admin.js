jQuery( document ).ready( function( $ ) {
	// Show SVGs that are featured images
	$( '#set-post-thumbnail img' ).each( function() {
		// Refactor: limit this to just SVGs
		$( this ).css( 'width', 'auto' ).css( 'max-height', '200px' );
	});
} );