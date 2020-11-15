 /* eslint-disable */
 import Swiper, { Navigation, Pagination } from 'swiper';

// configure Swiper to use modules
Swiper.use([Navigation, Pagination]);

 /**
  * Header Class
  */
 ( function( $ ) {
     class BlogSlide {
         constructor() {
             this.render();
         }
     
         render() {
            const swiper = new Swiper( '.swiper-container', {
                slidesPerView: 3,
                spaceBetween: 30,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 0
                    },
                    // when window width is >= 480px
                    // 480: {
                    //     slidesPerView: 3,
                    //     spaceBetween: 20
                    // },
                    // when window width is >= 640px
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                }
            } );
         }
     }
     
     new BlogSlide();
 } )( jQuery );
 