<?php
/**
 * Helper functions which enhance the theme
 *
 * @package Sober_Check
 */

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'sobercheck_woocommerce_header_cart' ) ) {
			sobercheck_woocommerce_header_cart();
		}
	?>
 */

if ( class_exists( 'WooCommerce' ) ) {

	if ( ! function_exists( 'sobercheck_woocommerce_cart_link' ) ) {
		/**
		 * Cart Link.
		 *
		 * Displayed a link to the cart including the number of items present and the cart total.
		 *
		 * @return void
		 */
		function sobercheck_woocommerce_cart_link() {
			?>
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'sobercheck' ); ?>">
				<?php
				$item_count_text = sprintf(
					/* translators: number of items in the mini cart. */
					_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'sobercheck' ),
					WC()->cart->get_cart_contents_count()
				);
				?>
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
			</a>
			<?php
		}
	}

	if ( ! function_exists( 'sobercheck_woocommerce_header_cart' ) ) {
		/**
		 * Display Header Cart.
		 *
		 * @return void
		 */
		function sobercheck_woocommerce_header_cart() {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
			?>
			<ul id="site-header-cart" class="site-header-cart">
				<li class="<?php echo esc_attr( $class ); ?>">
					<?php sobercheck_woocommerce_cart_link(); ?>
				</li>
				<li>
					<?php
					$instance = array(
						'title' => '',
					);

					the_widget( 'WC_Widget_Cart', $instance );
					?>
				</li>
			</ul>
			<?php
		}
	}
	
}

/**
 * Adjusts the color brightness by the given number of steps
 *
 * @param  string $hex   Color to adjust
 * @param  int    $steps number of steps to adjust the color by
 * @return string        the adjusted hex color
 */
function sobercheck_adjust_color_brightness( $hex, $steps ) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( -255, min( 255, $steps ) );

	if ( stripos( $hex, 'rgb' ) !== false ) {
		$hex = sobercheck_get_rgba_hex_color( $hex );
	}

	// Format the hex color string
	$hex = str_replace( '#', '', $hex );
	if ( strlen( $hex ) == 3 ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Get decimal values
	$r = hexdec( substr( $hex, 0, 2 ) );
	$g = hexdec( substr( $hex, 2, 2 ) );
	$b = hexdec( substr( $hex, 4, 2 ) );

	// Adjust number of steps and keep it inside 0 to 255
	$r = max( 0, min( 255, $r + $steps ) );
	$g = max( 0, min( 255, $g + $steps ) );
	$b = max( 0, min( 255, $b + $steps ) );

	$r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
	$g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
	$b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

	return '#' . $r_hex . $g_hex . $b_hex;
}

/**
 * Get the rgb/rgba representation of a color
 *
 * @param  string $hexcolor the hex value of the color
 * @param  int    $opacity  the opacity
 * @return string           rgb/rgba equivalent
 */
function sobercheck_get_rgb_color( $hexcolor, $opacity = null ) {
	$returnRGB = '';
	$hex       = str_replace( '#', '', $hexcolor );
	$a         = 0;

	if ( isset( $opacity ) && $opacity > 1 ) {
		$a = $opacity / 100;
	}

	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}

	if ( isset( $opacity ) ) {
		$returnRGB = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $a . ')';
	} else {
		$returnRGB = 'rgb(' . $r . ',' . $g . ',' . $b . ')';
	}

	return $returnRGB;
}

/**
 * Gets the hex portion of a rgba color
 *
 * @param  string $rgba rgba color
 * @return string       hex part of rgba color
 */
function sobercheck_get_rgba_hex_color( $rgba ) {
	$rgba = str_replace( ')', '', str_replace( 'rgba(', '', $rgba ) );
	$rgba = explode( ',', $rgba );

	$r = trim( $rgba[0] );
	$g = trim( $rgba[1] );
	$b = trim( $rgba[2] );

	if ( is_array( $r ) && sizeof( $r ) == 3 ) {
		list($r, $g, $b) = $r;
	}

	$r = intval( $r );
	$g = intval( $g );
	$b = intval( $b );

	$r = dechex( $r < 0 ? 0 : ( $r > 255 ? 255 : $r ) );
	$g = dechex( $g < 0 ? 0 : ( $g > 255 ? 255 : $g ) );
	$b = dechex( $b < 0 ? 0 : ( $b > 255 ? 255 : $b ) );

	$color  = ( strlen( $r ) < 2 ? '0' : '' ) . $r;
	$color .= ( strlen( $g ) < 2 ? '0' : '' ) . $g;
	$color .= ( strlen( $b ) < 2 ? '0' : '' ) . $b;

	return '#' . $color;
}

function do_style( $styles, $echo = false ) {
	$style = array();
	foreach ( $styles as $key => $value ) {
		$style[] = "$key: $value";
	}

	$style = implode( ';', $style );

	if ( $echo ) {
		echo $style;
	}

	return $style;
}