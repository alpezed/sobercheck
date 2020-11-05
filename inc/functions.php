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
