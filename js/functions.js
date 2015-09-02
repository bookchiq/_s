svgeezy.init( 'nocheck', 'png' );

jQuery( document ).ready( function( $ ) {
	/***** Change menu toggle wording to reflect current state *****/
	$( '.menu-toggle' ).click( function(event) {
		if ( 'Explore' == $( this ).text() ) {
			$( this ).text( 'Hide Menu' );
		} else if ( 'Hide Menu' == $( this ).text() ) {
			$( this ).text( 'Explore' );
		}
	});


	/***** Make external links open in new browser window/tab *****/
	$( 'a:not([id^="vc_"])' ).each(function() {
		var a = new RegExp( '/' + window.location.host + '/' );

		if(
			( ! a.test( this.href ) ) && 
			( -1 === this.href.indexOf( 'mailto:' ) ) && 
			( -1 === this.href.indexOf( 'tel://' ) ) // && 
		) {
			$( this ).click( function( event ) {
				event.preventDefault();
				event.stopPropagation();
				window.open( this.href, '_blank' );
			});
		}
	});


	/***** Make iFrames responsive *****/
	$( 'iframe' ).each( function() {
		var videoRatio = ( $( this ).attr( 'height' ) / $( this ).attr( 'width' ) ) * 100;
		if ( 0 < videoRatio ) {
			$( this )
			.css( 'position', 'absolute')
			.css( 'top', '0')
			.css( 'left', '0')
			.attr( 'width', '100%')
			.attr( 'height', '100%')
			.wrap( '<div class="fluid-vids" style="position: relative; padding-top: ' + videoRatio + '%; width: 100%;"></div>');
		}
	});
} );