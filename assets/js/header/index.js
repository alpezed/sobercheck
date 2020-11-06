 /* eslint-disable */
import Headroom from 'headroom.js';

/**
 * Header Class
 */
class Header {
	constructor() {
		this.render();
	}

	render() {
		// grab an element
        const navElement = document.querySelector( '.site-header--sticky' );
        const pageContent = document.querySelector( '.site-header--sticky + .site-main' );

		// construct an instance of Headroom, passing the element
		const headroom = new Headroom( navElement, {
			offset: document.querySelector( '.site-header__topbar' ).offsetHeight,
            tolerance: 5,
            onTop : function() {
                pageContent.style.marginTop  = '';
            },
            onNotTop: function() {
                console.log(navElement.offsetHeight)
                pageContent.style.marginTop  = navElement.offsetHeight + 'px';
            }
		} );
		// initialise
		headroom.init();
	}
}

new Header();
