 /* eslint-disable */
 import Swiper, { Navigation, Pagination } from 'swiper';

// configure Swiper to use modules
Swiper.use([Navigation, Pagination]);

 /**
  * Header Class
  */
 ( function( $ ) {
     class ProductSlider {
         constructor() {
             this.render();
         }

         filter( $el, $grid ) {
            $el.children('.filter-wrapper').on( 'click', '.filter-wrapper__item', function() {
                if ( $( this ).hasClass( 'btn-primary' ) ) {
                    return;
                }
                var filterValue = $( this ).attr( 'data-filter' );
				$grid.children( '.sc-product-slider__item' ).each( function() {
					if ( filterValue === '*' ) {
						$( this ).show();
						$( this ).addClass( 'animate' );
					} else {
                        console.log($( this ), filterValue);
						if ( ! $( this ).hasClass( 'product_cat-' + filterValue ) ) {
							$( this ).hide();
						} else {
							$( this ).show();
							$( this ).addClass( 'animate' );
						}
					}
				} );
				var $slider = $el.children( '.swiper-container' )[ 0 ].swiper;
				$slider.update();
                $slider.slideTo( 0 );
                
                $( this ).siblings().removeClass( 'btn-primary' );
			    $( this ).addClass( 'btn-primary' );
            } );
         }
     
         render() {
            this.filter( $( '.sc-product-slider' ), $( '.products' ) );
            const swiper = new Swiper( '.swiper-container', {
                slidesPerView: 4,
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
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                }
            } );
         }
     }
     
     new ProductSlider();
 } )( jQuery );
 