<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Sober_Check
 */
namespace Sobercheck\Inc;

use Sobercheck\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * WooCommerce Compatibility class
 */
class Woocommerce {
    use Singleton;

    public function __construct() {
        $this->hooks();
    }

    public function hooks() {
        add_filter( 'body_class', array( $this, 'active_body_class' ) );
        add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
        /**
         * Disable the default WooCommerce stylesheet.
         *
         * Removing the default WooCommerce stylesheet and enqueing your own will
         * protect you during WooCommerce core updates.
         *
         * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
         */
        add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

        /**
         * Remove default WooCommerce wrapper.
         */
        remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
        remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

        add_action( 'woocommerce_before_main_content', array( $this, 'wrapper_before' ) );
        add_action( 'woocommerce_after_main_content', array( $this, 'wrapper_after' ) );

        add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'cart_link_fragment' ) );

        add_action( 'wp_enqueue_scripts', array( $this, 'woocommerce_scripts' ) );
    }

    /**
     * WooCommerce specific scripts & stylesheets.
     *
     * @return void
     */
    public function woocommerce_scripts() {
        wp_enqueue_style( 'sobercheck-woocommerce-style', SOBER_CHECK_DIR_URI . '/woocommerce.css', array(), SOBER_CHECK_VERSION );

        $font_path   = \WC()->plugin_url() . '/assets/fonts/';
        $inline_font = '@font-face {
                font-family: "star";
                src: url("' . $font_path . 'star.eot");
                src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
                    url("' . $font_path . 'star.woff") format("woff"),
                    url("' . $font_path . 'star.ttf") format("truetype"),
                    url("' . $font_path . 'star.svg#star") format("svg");
                font-weight: normal;
                font-style: normal;
            }';

        wp_add_inline_style( 'sobercheck-woocommerce-style', $inline_font );
    }

    /**
     * Add 'woocommerce-active' class to the body tag.
     *
     * @param  array $classes CSS classes applied to the body tag.
     * @return array $classes modified to include 'woocommerce-active' class.
     */
    public function active_body_class( $classes ) {
        $classes[] = 'woocommerce-active';

        return $classes;
    }

    /**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	public function cart_link_fragment( $fragments ) {
		ob_start();
		sobercheck_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}

    /**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	public function wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
    }
    
    /**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	public function wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}

    /**
     * Related Products Args.
     *
     * @param array $args related products args.
     * @return array $args related products args.
     */
    public function related_products_args( $args ) {
        $defaults = array(
            'posts_per_page' => 3,
            'columns'        => 3,
        );
    
        $args = wp_parse_args( $defaults, $args );
    
        return $args;
    }
}