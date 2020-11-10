 /* eslint-disable */
import Headroom from 'headroom.js';

/**
 * Header Class
 */
( function( $ ) {
	class Header {
		constructor() {
			// grab an element
			this.navElement = document.querySelector( '.site-header--sticky' );
			this.pageContent = document.querySelector( '.site-main' );
			this.topBar = document.querySelector( '.site-header__topbar' );
	
			this.render();
			this.resizeHeader();
		}
	
		resizeHeader() {
			// window.addEventListener( 'resize', this.headerSize );
			$( window ).on( 'resize', this.headerSize );
		}
	
		headerSize() {
			if ( $( '.site-header--sticky' ).length ) {
				$( '.site-main' ).css( 'margin-top', $( '.site-header--sticky' ).outerHeight() + 'px' );
			}
		}
	
		render() {
			this.headerSize();
			// construct an instance of Headroom, passing the element
			const headroom = new Headroom( this.navElement, {
				offset: $( '.site-header--sticky' ).outerHeight(), // this.topBar ? this.topBar.offsetHeight : 0,
				tolerance: {
					up: 10,
					down: 0
				},
				onUnpin : function() {
					const topBarHeight = $( '.site-header__topbar' ).outerHeight();
					if ( $( '.site-header__topbar' ).length ) {
						$( '.site-header--sticky' ).css( 'transform', 'translateY( -' + topBarHeight + 'px )' );
					}
				},
				onPin : function() {
					$( '.site-header--sticky' ).css( 'transform', '' );
				}
			} );
			// initialise
			headroom.init();
		}
	}
	
	new Header();
} )( jQuery );
