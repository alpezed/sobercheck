 /* eslint-disable */
 import VanilaTilt from 'vanilla-tilt';

 /**
  * Header Class
  */
 ( function( $ ) {
     class Services {
         constructor() {
             this.render();
         }
     
         render() {
            VanillaTilt.init( document.querySelectorAll( '.sc-services-item.style-02' ), {
                max: 5,
                speed: 400,
                perspective: 1000,
            } );
         }
     }
     
     new Services();
 } )( jQuery );
 