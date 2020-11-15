 /* eslint-disable */
(
	function( $ ) {
		'use strict';

		jQuery( document ).on('ready', function( $ ) {
			'use strict';

			sobercheckPostGridInit();

			$( '.sobercheck-swiper' ).sobercheckSwiper();

			// Add isotope-hidden class for filtered items.
			if ( typeof Isotope != 'undefined' ) {
				// Add isotope-hidden class for filtered items.
				var itemReveal = Isotope.Item.prototype.reveal,
					itemHide   = Isotope.Item.prototype.hide;

				Isotope.Item.prototype.reveal = function() {
					itemReveal.apply( this, arguments );
					$( this.element )
						.removeClass( 'isotope-hidden' );
				};

				Isotope.Item.prototype.hide = function() {
					itemHide.apply( this, arguments );
					$( this.element )
						.addClass( 'isotope-hidden' );
				};
			}

			handlerTestimonials();

			handlerSliderModern();

			// re-render posts scripts on gutenberg
			document.addEventListener( 'sobercheckPostsInit', function( e ) {
				window.setTimeout( sobercheckPostsInit, 1000 );
			}, false );

			const sobercheckPostsInit = function() {
				$( '.sobercheck-swiper' ).sobercheckSwiper();
				handlerTestimonials();
				handlerSliderModern();
				sobercheckPostGridInit();
			};

		});

		$.fn.sobercheckSwiper = function() {

			this.each( function() {

				var $slider = $( this );
				var _settings = $slider.data();

				if ( _settings.queueInit == '0' ) {
					return;
				}

				var $sliderContainer = $slider.children( '.swiper-container' ).first(),
				    lgItems          = _settings.lgItems ? _settings.lgItems : 1,
				    mdItems          = _settings.mdItems ? _settings.mdItems : lgItems,
				    smItems          = _settings.smItems ? _settings.smItems : mdItems,
				    xsItems          = _settings.xsItems ? _settings.xsItems : smItems,
				    lgGutter         = _settings.lgGutter ? _settings.lgGutter : 0,
				    mdGutter         = _settings.mdGutter ? _settings.mdGutter : lgGutter,
				    smGutter         = _settings.smGutter ? _settings.smGutter : mdGutter,
				    xsGutter         = _settings.xsGutter ? _settings.xsGutter : smGutter,
				    speed            = _settings.speed ? _settings.speed : 1000;

				if ( _settings.slideWrap ) {
					$slider.children( '.swiper-container' )
					       .children( '.swiper-wrapper' )
					       .children( 'div' )
					       .wrap( "<div class='swiper-slide'><div class='swiper-slide-inner'></div></div>" );
				}

				if ( lgItems == 'auto' ) {
					var _options = {
						slidesPerView: 'auto',
						spaceBetween: lgGutter,
						breakpoints: {
							767: {
								spaceBetween: xsGutter
							},
							990: {
								spaceBetween: smGutter
							},
							1199: {
								spaceBetween: mdGutter
							}
						}
					};
				} else {
					var _options = {
						slidesPerView: lgItems, //slidesPerGroup: lgItems,
						spaceBetween: lgGutter,
						breakpoints: {
							// when window width is <=
							767: {
								slidesPerView: xsItems,
								spaceBetween: xsGutter
							},
							990: {
								slidesPerView: smItems,
								spaceBetween: smGutter
							},
							1199: {
								slidesPerView: mdItems,
								spaceBetween: mdGutter
							}
						}
					};

					if ( _settings.slidesPerGroup == 'inherit' ) {
						_options.slidesPerGroup = lgItems;

						_options.breakpoints[ 767 ].slidesPerGroup = xsItems;
						_options.breakpoints[ 990 ].slidesPerGroup = smItems;
						_options.breakpoints[ 1199 ].slidesPerGroup = mdItems;
					}
				}

				_options.el = $sliderContainer;

				_options.watchOverflow = true;

				if ( _settings.slideColumns ) {
					_options.slidesPerColumn = _settings.slideColumns;
				}

				if ( _settings.initialSlide ) {
					_options.initialSlide = _settings.initialSlide;
				}

				if ( _settings.autoHeight ) {
					_options.autoHeight = true;
				}

				if ( speed ) {
					_options.speed = speed;
				}

				// Maybe: fade, flip
				if ( _settings.effect ) {
					_options.effect = _settings.effect;
					/*_options.fadeEffect = {
						crossFade: true
					};*/
				}

				if ( _settings.loop ) {
					_options.loop = true;
				}

				if ( _settings.centered ) {
					_options.centeredSlides = true;
				}

				if ( _settings.autoplay ) {
					_options.autoplay = {
						delay: _settings.autoplay,
						disableOnInteraction: false
					};
				}

				if ( _settings.freemode ) {
					_options.freeMode = true;
				}

				var $wrapTools;

				if ( _settings.wrapTools ) {
					$wrapTools = $( '<div class="swiper-tools"></div>' );

					$slider.append( $wrapTools );
				}

				if ( _settings.nav ) {

					if ( _settings.customNav && _settings.customNav !== '' ) {
						$customBtn = $( '#' + _settings.customNav );
						var $swiperPrev = $customBtn.find( '.slider-prev-btn' );
						var $swiperNext = $customBtn.find( '.slider-next-btn' );
					} else {
						var $swiperPrev = $( '<div class="swiper-nav-button swiper-button-prev"><i class="nav-button-icon"></i></div>' );
						var $swiperNext = $( '<div class="swiper-nav-button swiper-button-next"><i class="nav-button-icon"></i></div>' );

						var $swiperNavButtons = $( '<div class="swiper-nav-buttons"></div>' );
						$swiperNavButtons.append( $swiperPrev ).append( $swiperNext );

						if ( $wrapTools ) {
							$wrapTools.append( $swiperNavButtons );
						} else {
							$slider.append( $swiperNavButtons );
						}
					}

					_options.navigation = {
						nextEl: $swiperNext,
						prevEl: $swiperPrev
					};
				}

				if ( _settings.pagination ) {
					var $swiperPagination = $( '<div class="swiper-pagination"></div>' );
					$slider.addClass( 'has-pagination' );

					if ( $wrapTools ) {
						$wrapTools.append( $swiperPagination );
					} else {
						$slider.append( $swiperPagination );
					}

					_options.pagination = {
						el: $swiperPagination,
						clickable: true
					};

					// Custom pagination 07 (Special pagination).
					if ( $slider.hasClass( 'pagination-style-07' ) ) {
						_options.pagination.type = 'custom';
						_options.pagination.renderCustom = function( swiper, current, total ) {
							var width = (
								            100 / total
							            ) * current;

							width = width.toFixed( 6 );

							if ( swiper.prevProgressBarWidth === undefined ) {
								swiper.prevProgressBarWidth = width + '%';
							}

							return '<div class="progressbar"><div class="filled" data-width="' + width + '" style="width: ' + swiper.prevProgressBarWidth + '"></div></div>';
						};
					} else if ( $slider.hasClass( 'pagination-style-08' ) ) {
						_options.pagination.type = 'custom';
						_options.pagination.renderCustom = function( swiper, current, total ) {
							var width = (
								            100 / total
							            ) * current;

							width = width.toFixed( 6 );

							if ( swiper.prevProgressBarWidth === undefined ) {
								swiper.prevProgressBarWidth = width + '%';
							}

							// Convert to string.
							var _current = current.toString();
							var _total = total.toString();

							// Add leading 0.
							_current = _current.padStart( 2, '0' );
							_total = _total.padStart( 2, '0' );

							var fraction_template = '<div class="fraction"><span class="current">' + _current + '</span>' + '<span class="separator"> / </span>' + '<span class="total">' + _total + '</span></div>';

							return fraction_template + '<div class="progressbar"><div class="filled" data-width="' + width + '" style="width: ' + swiper.prevProgressBarWidth + '"></div></div>';
						};
					}
				}

				if ( _settings.scrollbar ) {
					var $scrollbar = $( '<div class="swiper-scrollbar"></div>' );
					$sliderContainer.prepend( $scrollbar );

					_options.scrollbar = {
						el: $scrollbar,
						draggable: true,
					};

					_options.loop = false;
				}

				if ( _settings.mousewheel ) {
					_options.mousewheel = {
						enabled: true
					};
				}

				if ( _settings.vertical ) {
					_options.direction = 'vertical'
				}

				var $swiper = new Swiper( _options );

				if ( _settings.reinitOnResize ) {
					var _timer;
					$( window ).resize( function() {
						clearTimeout( _timer );

						_timer = setTimeout( function() {
							$swiper.destroy( true, true );

							$swiper = new Swiper( $sliderContainer, _options );
						}, 300 );
					} );
				}

				// Disabled auto play when focus.
				if ( _settings.autoplay ) {
					$sliderContainer.hoverIntent( function() {
						$swiper.autoplay.stop();
					}, function() {
						$swiper.autoplay.start();
					} );
				}

				// Custom pagination 07
				if ( $swiperPagination && (
					$slider.hasClass( 'pagination-style-07' ) || $slider.hasClass( 'pagination-style-08' )
				) ) {
					$swiper.on( 'slideChangeTransitionStart', function( swiper ) {
						var $filled = $swiperPagination.find( '.filled' );
						var w = $filled.data( 'width' ) + '%';

						$filled.animate( {
							width: w
						}, 300 );

						this.prevProgressBarWidth = w;

					} );
				}

				$( document ).trigger( 'sobercheckSwiperInit', [ $swiper, $slider, _options ] );

				return this;
			} );
		};

	}( jQuery )
);

var animateQueueDelay = 200,
	queueResetDelay;

/**
 * Global ajaxBusy = false
 * Desc: Status of ajax
 */
var ajaxBusy = false;
jQuery( document ).ajaxStart( function() {
	ajaxBusy = true;
} ).ajaxStop( function() {
	ajaxBusy = false;
} );

var resizeTimer;

function handlerTestimonials() {
	jQuery( '.sobercheck-testimonial' ).each( function() {
		if ( ! jQuery( this ).hasClass( 'style-modern-slider' ) && ! jQuery( this ).hasClass( 'style-modern-slider-02' ) ) {
			return;
		}

		var $slider = jQuery( this ).children( '.sobercheck-swiper' );

		var $sliderContainer = $slider.children( '.swiper-container' ).first();
		var lgItems = $slider.data( 'lg-items' ) ? $slider.data( 'lg-items' ) : 1;
		var mdItems = $slider.data( 'md-items' ) ? $slider.data( 'md-items' ) : lgItems;
		var smItems = $slider.data( 'sm-items' ) ? $slider.data( 'sm-items' ) : mdItems;
		var xsItems = $slider.data( 'xs-items' ) ? $slider.data( 'xs-items' ) : smItems;

		var lgGutter = $slider.data( 'lg-gutter' ) ? $slider.data( 'lg-gutter' ) : 0;
		var mdGutter = $slider.data( 'md-gutter' ) ? $slider.data( 'md-gutter' ) : lgGutter;
		var smGutter = $slider.data( 'sm-gutter' ) ? $slider.data( 'sm-gutter' ) : mdGutter;
		var xsGutter = $slider.data( 'xs-gutter' ) ? $slider.data( 'xs-gutter' ) : smGutter;

		var autoPlay = $slider.data( 'autoplay' );
		var speed = $slider.data( 'speed' ) ? $slider.data( 'speed' ) : 1000;
		var nav = $slider.data( 'nav' );
		var pagination = $slider.data( 'pagination' );
		var paginationType = $slider.data( 'pagination-type' ) ? $slider.data( 'pagination-type' ) : 'bullets';

		var options = {
			loop: true,
			slidesPerView: lgItems,
			spaceBetween: lgGutter,
			breakpoints: {
				// when window width is <=
				767: {
					slidesPerView: xsItems,
					spaceBetween: xsGutter
				},
				990: {
					slidesPerView: smItems,
					spaceBetween: smGutter
				},
				1199: {
					slidesPerView: mdItems,
					spaceBetween: mdGutter
				}
			}
		};

		if ( speed ) {
			options.speed = speed;
		}

		if ( autoPlay ) {
			options.autoplay = {
				delay: autoPlay,
				disableOnInteraction: false
			};
		}

		if ( nav ) {
			var $swiperPrev = jQuery( '<div class="swiper-nav-button swiper-button-prev"><i class="nav-button-icon"></i></div>' );
			var $swiperNext = jQuery( '<div class="swiper-nav-button swiper-button-next"><i class="nav-button-icon"></i></div>' );

			$slider.append( $swiperPrev ).append( $swiperNext );

			options.navigation = {
				nextEl: $swiperNext,
				prevEl: $swiperPrev,
			};
		}

		if ( pagination ) {
			var $swiperPagination = jQuery( '<div class="swiper-pagination"></div>' );
			$slider.addClass( 'has-pagination' );

			$slider.append( $swiperPagination );

			options.pagination = {
				el: $swiperPagination,
				clickable: true,
				type: paginationType
			};
		}

		var $swiper = new Swiper( $sliderContainer, options );

		var $thumbSlider = $slider.children( '.bb-testimonial-pagination' );
		var $thumbContainer = $thumbSlider.children( '.swiper-container' ).first();

		var thumbSlides = $thumbSlider.data( 'lg-items' );
		var thumbGutter = $thumbSlider.data( 'lg-gutter' );
		var centered = $thumbSlider.data( 'centered' ) && $thumbSlider.data( 'centered' ) == '1' ? true : false;

		var thumbOptions = {
			slidesPerView: thumbSlides,
			spaceBetween: thumbGutter,
			centeredSlides: centered,
			loop: true
		};

		var $swiperThumbs = new Swiper( $thumbContainer, thumbOptions );

		$swiper.on( 'slideChange', function() {
			var $_slides = $thumbContainer.children( '.swiper-wrapper' )
										.children( '.swiper-slide' );
			$_slides.each( function( i, o ) {

				if ( jQuery( this ).hasClass( 'swiper-slide-duplicate' ) ) {
					return true;
				}

				if ( jQuery( this ).data( 'swiper-slide-index' ) === $swiper.realIndex ) {
					$swiperThumbs.slideTo( i );
				}
			} );
		} );

		$swiperThumbs.on( 'slideChange', function() {
			var $_slides = $sliderContainer.children( '.swiper-wrapper' ).children( '.swiper-slide' );
			$_slides.each( function( i, o ) {

				if ( jQuery( this ).hasClass( 'swiper-slide-duplicate' ) ) {
					return true;
				}

				if ( jQuery( this ).data( 'swiper-slide-index' ) === $swiperThumbs.realIndex ) {
					$swiper.slideTo( i );
				}
			} );
		} );

		$swiperThumbs.on( 'click', function() {
			$swiperThumbs.slideTo( $swiperThumbs.clickedIndex );
		} );
	} );
}

function handlerSliderModern() {
	jQuery( '.bb-slider-modern' ).each( function() {
		var $self = jQuery( this );

		var bgList = $self.find( '.slider-bg-list' );
		var bgItems = bgList.children( '.slide-bg' );

		$self.find( '.swiper-slide' ).hoverIntent( function() {
			if ( jQuery( this ).hasClass( 'slider-modern-current' ) ) {
				return;
			}

			var index = jQuery( this ).index();

			jQuery( this ).siblings().removeClass( 'slider-modern-current' );
			jQuery( this ).addClass( 'slider-modern-current' );

			handlerSliderModernBG( index );
		}, function() {
		} );

		handlerSliderModernBG( 0 );

		function handlerSliderModernBG( index ) {
			$self.find( '.swiper-slide' ).eq( index ).addClass( 'slider-modern-current' );

			var current = bgList.children().eq( index );

			current.siblings().removeClass( 'current' );
			current.addClass( 'current' );
		}
	} );
}

function sobercheckPostGridInit() {
	jQuery('.bb-grid-wrapper').each( function() {
		var $el = jQuery( this );
		var $grid = $el.find( '.bb-block-post-grid' );
		var $gridData;
		var $items = $grid.children( '.bb-post-item' );
		var gutter = $el.data( 'gutter' ) ? $el.data( 'gutter' ) : 0;

		if ( $el.data( 'type' ) == 'masonry' ) {
			var $isotopeOptions = {
				itemSelector: '.bb-post-item',
				percentPosition: true,
			};

			if ( $el.data( 'grid-fitrows' ) ) {
				$isotopeOptions.layoutMode = 'fitRows';
			} else {
				$isotopeOptions.layoutMode = 'packery';
				$isotopeOptions.packery = {
					// Use outer width of grid-sizer for columnWidth.
					columnWidth: '.grid-sizer'
				}
			}

			if ( $isotopeOptions.layoutMode === 'fitRows' ) {
				// Set gutter for fit rows layout.
				$isotopeOptions.fitRows = {};
				$isotopeOptions.fitRows.gutter = gutter;
			} else if ( $isotopeOptions.layoutMode === 'packery' ) {
				$isotopeOptions.packery.gutter = gutter;
			} else {
				// Set gutter for masonry layout.
				//$isotopeOptions.masonry.gutter = gutter;
				$isotopeOptions.masonry = {
					gutter: gutter
				}
			}

			// Remove default transition if grid has custom animation.
			if ( $grid.hasClass( 'has-animation' ) ) {
				$isotopeOptions.transitionDuration = 0;
			}

			jQuery( window ).resize( function() {
				sobercheckGridMasonryCalculateSize( $el, $grid, $isotopeOptions );
				clearTimeout( resizeTimer );
				resizeTimer = setTimeout( function() {
					// Run code here, resizing has "stopped"
					sobercheckGridMasonryCalculateSize( $el, $grid, $isotopeOptions );
				}, 300 );
			} );

			sobercheckGridMasonryCalculateSize( $el, $grid );

			$gridData = $grid.imagesLoaded( function() {
				// init Isotope after all images have loaded
				$grid.isotope( $isotopeOptions );

				if ( $el.data( 'match-height' ) ) {
					$items.matchHeight();
				}

				jQuery( document ).trigger( 'sobercheckGridInit', [ $el, $grid, $isotopeOptions ] );
			} );

			$gridData.one( 'arrangeComplete', function() {
				sobercheckInitGridAnimation( $grid, $items );
				//sobercheckGridFilterCount( $el, $grid );
			} );
		} else {
			sobercheckInitGridAnimation( $grid, $items );
		}

		sobercheckGridFilterHandler( $el, $grid );

		if ( $el.data( 'pagination' ) == 'loadmore' ) {
			$el.children( '.bb-grid-pagination' ).find( '.bb-grid-loadmore-btn' ).on( 'click', function( e ) {
				e.preventDefault();
				if ( ! ajaxBusy ) {
					jQuery( this ).hide();
					var $queryInput = $el.find( '.bb-grid-query' )
											.first();
					var query = jQuery.parseJSON( $queryInput.val() );

					query.paged ++;
					$queryInput.val( JSON.stringify( query ) );
					sobercheckAjaxPostQuery( $el, $grid );
				}
			} );
		} else if ( $el.data( 'pagination' ) == 'infinite' ) {
			jQuery( '.bb-grid-pagination', $el ).waypoint( function( direction ) {
				if ( direction === 'down' && ! ajaxBusy ) {
					var $queryInput = $el.find( '.bb-grid-query' )
											.first();
					var query = jQuery.parseJSON( $queryInput.val() );

					query.paged ++;
					$queryInput.val( JSON.stringify( query ) );

					sobercheckAjaxPostQuery( $el, $grid );
				}
			}, {
				offset: '100%'
			} )
		}

		jQuery( document ).on( 'sobercheckGridInfinityLoad', function( e ) {
			var $queryInput = $el.find( '.bb-grid-query' ).first();
			var query = jQuery.parseJSON( $queryInput.val() );
			query.paged = 1;
			$queryInput.val( JSON.stringify( query ) );

			sobercheckAjaxPostQuery( $el, $grid, true );
		} );

		$el.addClass( 'grid-loaded' );
	} );
}

/**
 * Calculate size for grid classic + masonry.
 */
function sobercheckGridMasonryCalculateSize( $el, $grid, $isotopeOptions ) {
	var windowWidth = window.innerWidth,
		$gridWidth  = $grid[ 0 ].getBoundingClientRect().width,
		$gutter     = $el.data( 'gutter' ) ? $el.data( 'gutter' ) : 0,
		$column     = 1,
		lgColumns   = $el.data( 'lg-columns' ) ? $el.data( 'lg-columns' ) : 1,
		mdColumns   = $el.data( 'md-columns' ) ? $el.data( 'md-columns' ) : lgColumns,
		smColumns   = $el.data( 'sm-columns' ) ? $el.data( 'sm-columns' ) : mdColumns,
		xsColumns   = $el.data( 'xs-columns' ) ? $el.data( 'xs-columns' ) : smColumns;

	if ( windowWidth >= 1200 ) {
		$column = lgColumns;
	} else if ( windowWidth >= 992 ) {
		$column = mdColumns;
	} else if ( windowWidth >= 641 ) {
		$column = smColumns;
	} else {
		$column = xsColumns;
	}

	var $totalGutter = (
						$column - 1
					) * $gutter;

	var $columnWidth = (
						$gridWidth - $totalGutter
					) / $column;

	$columnWidth = Math.floor( $columnWidth );

	var $columnWidth2 = $columnWidth;
	if ( $column > 1 ) {
		$columnWidth2 = $columnWidth * 2 + $gutter;
	}

	$grid.children( '.grid-sizer' )
		.css( {
			'width': $columnWidth + 'px'
		} );

	var $columnHeight  = $columnWidth,
		$columnHeight2 = $columnHeight,
		ratio          = $el.data( 'grid-ratio' );

	if ( ratio ) {
		var res    = ratio.split( ':' ),
			ratioW = parseFloat( res[ 0 ] ),
			ratioH = parseFloat( res[ 1 ] );

		$columnHeight = (
							$columnWidth * ratioH
						) / ratioW;

		$columnHeight = Math.floor( $columnHeight );

		if ( $column > 1 ) {
			$columnHeight2 = $columnHeight * 2 + $gutter;
		} else {
			$columnHeight2 = $columnHeight;
		}
	}

	$grid.children( '.bb-post-item' ).each( function() {
		if ( jQuery( this ).data( 'width' ) == '2' ) {
			jQuery( this ).css( {
				'width': $columnWidth2 + 'px'
			} );
		} else {
			jQuery( this ).css( {
				'width': $columnWidth + 'px'
			} );
		}
		if ( ratio ) {
			if ( jQuery( this ).data( 'height' ) == '2' ) {
				jQuery( this ).css( {
					'height': $columnHeight2 + 'px'
				} );
			} else {
				jQuery( this ).css( {
					'height': $columnHeight + 'px'
				} );
			}
		}
	} );

	if ( $isotopeOptions ) {
		$grid.isotope( 'layout', $isotopeOptions );
	}
}

/**
 * Load post infinity from db.
 */
function sobercheckAjaxPostQuery( $wrapper, $grid, reset ) {
	var loader = $wrapper.children( '.bb-grid-pagination' ).find( '.bb-grid-loader' );

	loader.css( {
		'display': 'inline-block'
	} );

	setTimeout( function() {
		var $queryInput = $wrapper.find( '.bb-grid-query' )
								.first(),
			query       = jQuery.parseJSON( $queryInput.val() ),
			_data       = jQuery.param( query );

		jQuery.ajax( {
			url: sobercheck_script.ajaxurl,
			type: 'POST',
			data: _data,
			dataType: 'json',
			success: function( results ) {

				if ( results.found_posts ) {
					query.found_posts = results.found_posts;
				}

				if ( results.max_num_pages ) {
					query.max_num_pages = results.max_num_pages;
				}

				if ( results.count ) {
					query.count = results.count;
				}

				$queryInput.val( JSON.stringify( query ) );

				var html = results.template;
				var $items = jQuery( html );

				if ( reset == true ) {
					$grid.children( '.bb-post-item' ).remove();
				}

				if ( $wrapper.data( 'type' ) == 'masonry' ) {
					$grid.isotope()
						.append( $items )
						.isotope( 'appended', $items )
						.imagesLoaded()
						.always( function() {
							$grid.isotope( 'layout' );
							// Re run match height for all items.
							if ( $wrapper.data( 'match-height' ) ) {
								$grid.children( '.bb-post-item' ).matchHeight();
							}
							jQuery( document ).trigger( 'sobercheckGridUpdate', [ $wrapper, $grid, $items ] );
						} );
					//sobercheckGridFilterCount( $wrapper, $grid );
					sobercheckGridMasonryCalculateSize( $wrapper, $grid );
				} else if ( $wrapper.data( 'type' ) == 'swiper' ) {
					var $slider = $wrapper.find( '.swiper-container' )[ 0 ].swiper;
					$slider.appendSlide( $items );
					$slider.update();
				} else {
					$grid.append( $items );
				}
				sobercheckInitGridAnimation( $grid, $items );
				//sobercheckInitGalleryForNewItems( $grid, $items );
				//sobercheckInitGridOverlay( $grid, $items );
				sobercheckHidePaginationIfEnd( $wrapper, query );

				loader.hide();
			}
		} );
	}, 500 );
}

/**
 * Remove pagination if has no posts anymore
 *
 * @param $el
 * @param query
 *
 */
function sobercheckHidePaginationIfEnd( $el, query ) {
	if ( query.found_posts <= (
		query.paged * query.posts_per_page
	) ) {

		if ( $el.data( 'pagination' ) === 'loadmore_alt' ) {
			var _loadmoreBtn = jQuery( $el.data( 'pagination-custom-button-id' ) );

			_loadmoreBtn.hide();
		} else {
			$el.children( '.bb-grid-pagination' ).hide();
		}

		$el.children( '.bb-grid-messages' ).show( 1 );
		setTimeout( function() {
			$el.children( '.bb-grid-messages' ).remove();
		}, 5000 );
	} else {
		if ( $el.data( 'pagination' ) === 'loadmore_alt' ) {
			var _loadmoreBtn = jQuery( $el.data( 'pagination-custom-button-id' ) );

			_loadmoreBtn.show();
		} else {
			$el.children( '.bb-grid-pagination' ).show();
			$el.children( '.bb-grid-pagination' ).find( '.bb-grid-loadmore-btn' ).show();
		}

	}
}

function sobercheckGridFilterHandler( $el, $grid ) {
	$el.children( '.bb-filter-button' ).on( 'click', '.filter-btn', function() {
		if ( jQuery( this ).hasClass( 'active' ) ) {
			return;
		}

		if ( $el.data( 'filter-type' ) == 'ajax' ) {
			var filterValue = jQuery( this ).attr( 'data-filter' );

			var $queryInput = $el.find( '.bb-grid-query' ).first();
			var query = jQuery.parseJSON( $queryInput.val() );
			if ( filterValue === '*' ) {
				query.taxonomy = '';
				query.categories = '';
			} else {
				var tax_terms_filter = jQuery( this ).attr( 'data-ajax-filter' );
				var tax_terms = tax_terms_filter.split(':');
				query.taxonomy = tax_terms[0];
				query.categories = tax_terms[1];
			}

			$queryInput.val( JSON.stringify( query ) );

			jQuery( document ).trigger( 'sobercheckGridInfinityLoad', $el );

			jQuery( this ).siblings().removeClass( 'active' );
			jQuery( this ).addClass( 'active' );
		} else {
			var filterValue = jQuery( this ).attr( 'data-filter' );
			if ( $el.data( 'type' ) == 'masonry' ) {
				$grid.children( '.bb-post-item' ).each( function() {
					jQuery( this ).removeClass( 'animate' );
				} );

				$grid.isotope( {
					filter: filterValue
				} );

				var itemQueue = [],
					queueDelay = animateQueueDelay,
					queueTimer;

				if ( $grid.hasClass( 'has-animation' ) ) {
					$grid.children( '.bb-post-item:not(.isotope-hidden)' )
						.each( function() {
							itemQueue.push( jQuery( this ) );

							processItemQueue( itemQueue, queueDelay, queueTimer );
							queueDelay += 250;

							queueResetDelay = setTimeout( function() {
								queueDelay = animateQueueDelay;
							}, animateQueueDelay );
						} );
				}
			} else if ( $el.data( 'type' ) == 'swiper' ) {
				filterValue = filterValue.replace( '.', '' );
				$grid.children( '.bb-post-item' ).each( function() {
					if ( filterValue == '*' ) {
						jQuery( this ).show();
						jQuery( this ).addClass( 'animate' );
					} else {
						if ( ! jQuery( this ).hasClass( filterValue ) ) {
							jQuery( this ).hide();
						} else {
							jQuery( this ).show();
							jQuery( this ).addClass( 'animate' );
						}
					}
				} );
				var $slider = $el.children( '.sobercheck-swiper' )
									.children( '.swiper-container' )[ 0 ].swiper;
				$slider.update();
				$slider.slideTo( 0 );
			} else {
				$grid.children( '.bb-post-item' ).hide().removeClass( 'animate' );

				var $filterItems;

				if ( filterValue == '*' ) {
					$filterItems = $grid.children( '.bb-post-item' );
				} else {
					$filterItems = $grid.children( filterValue );
				}

				$filterItems.show();

				$filterItems.each( function( i, o ) {
					var self = jQuery( this );

					setTimeout( function() {
						self.addClass( 'animate' );
					}, i * 200 );
				} );
			}

			jQuery( this ).siblings().removeClass( 'active' );
			jQuery( this ).addClass( 'active' );
		}
	} );
}

function sobercheckInitGridAnimation( $grid, $items ) {
	if ( ! $grid.hasClass( 'has-animation' ) ) {
		return;
	}

	var itemQueue  = [],
		queueDelay = animateQueueDelay,
		queueTimer;

	$items.waypoint( function() {
		// Fix for different ver of waypoints plugin.
		var _self = this.element ? this.element : jQuery( this );

		itemQueue.push( _self );
		processItemQueue( itemQueue, queueDelay, queueTimer );
		queueDelay += 250;

		queueResetDelay = setTimeout( function() {
			queueDelay = animateQueueDelay;
		}, animateQueueDelay );
	}, {
		offset: '90%',
		triggerOnce: true
	} );
}

function processItemQueue( itemQueue, queueDelay, queueTimer, queueResetDelay ) {
	clearTimeout( queueResetDelay );
	queueTimer = window.setInterval( function() {
		if ( itemQueue !== undefined && itemQueue.length ) {
			jQuery( itemQueue.shift() ).addClass( 'animate' );
			processItemQueue();
		} else {
			window.clearInterval( queueTimer );
		}
	}, queueDelay );
}
