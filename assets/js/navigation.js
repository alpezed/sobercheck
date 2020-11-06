/**
 * File navigation.js.
 */
( function() {

	const sticky = document.querySelector( '.sticky-nav' );

	if ( sticky !== null ) {
		window.onscroll = function() {
			if ( window.pageYOffset > sticky.offsetTop ) {
				sticky.classList.add( 'fixed-top' );
			} else {
				sticky.classList.remove( 'fixed-top' );
			}
		};
	}
}() );