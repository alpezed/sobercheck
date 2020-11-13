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
        add_filter( 'woocommerce_pagination_args', array( $this, 'pagination_args' ) );
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

        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

        // remove_action('woocommerce_single_product_summary', 'woocommerce_before_add_to_cart_button', 30 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
        // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
        
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

        add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 80 );
        add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 70 );
        add_action( 'woocommerce_single_product_summary', array( $this, 'woocommerce_additional_info' ), 30 );
        add_action( 'woocommerce_single_product_summary', array( $this, 'woocommerce_description' ), 20 );

        add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

        add_action( 'woocommerce_before_main_content', array( $this, 'wrapper_before' ) );
        add_action( 'woocommerce_after_main_content', array( $this, 'wrapper_after' ) );

        add_action( 'woocommerce_after_add_to_cart_quantity', array( $this, 'product_enquiry_button' ) );

        add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'cart_link_fragment' ) );

        add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
            return array(
                'width' => 126,
                'height' => 67,
                'crop' => 1,
            );
        } );

        add_filter( 'woocommerce_product_related_products_heading', array( $this, 'woocommerce_related_products_heading' ) );
		
		/**
		 * WooCommerce setup function.
		 *
		 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
		 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
		 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
		 */
		add_theme_support(
			'woocommerce',
			array(
				'thumbnail_image_width' => 250,
				'single_image_width'    => 515,
				'product_grid'          => array(
					'default_rows'    => 3,
					'min_rows'        => 1,
					'default_columns' => 4,
					'min_columns'     => 1,
					'max_columns'     => 6,
				),
			)
		);
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
        
        // Enque woo scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'woocommerce_scripts' ) );
    }

    public function woocommerce_related_products_heading() {
        return __( 'Similar Products', 'sobercheck' );
    }

    public function product_enquiry_button() {
        echo '<button type="button" class="btn btn-outline-primary btn-enquiry order-1 mr-2">' . esc_html( 'Product Enquiry', 'sobercheck' ) . '</button>';
    }

    public function woocommerce_additional_info() {
        global $product;
        do_action( 'woocommerce_product_additional_information', $product );
    }
    
    public function woocommerce_description() {
        the_content();
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
                <div class="container">
                    <div class="row">
                        <div class="col">
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
                        </div>
                    </div>
                </div>
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
            'columns'        => 4,
        );
    
        $args = wp_parse_args( $defaults, $args );
    
        return $args;
    }
    
    /**
     * Pagination Products Args.
     *
     * @param array $args pagination args.
     * @return array $args pagination args.
     */
    public function pagination_args( $args ) {
        $defaults = array(
            'prev_text' => __( '<div class="post-navigation__prev"><svg xmlns="http://www.w3.org/2000/svg" width="9.371" height="16.39" viewBox="0 0 9.371 16.39"><path fill="#fff" d="M14.071,14.388l6.2-6.2a1.166,1.166,0,0,0,0-1.654,1.181,1.181,0,0,0-1.659,0l-7.027,7.022a1.169,1.169,0,0,0-.034,1.615l7.056,7.071a1.171,1.171,0,0,0,1.659-1.654Z" transform="translate(-11.246 -6.196)"/></svg></div>', 'sobercheck' ),
            'next_text' => __( '<div class="post-navigation__next"><svg xmlns="http://www.w3.org/2000/svg" width="9.371" height="16.39" viewBox="0 0 9.371 16.39"><path fill="#fff" d="M17.793,14.388l-6.2-6.2a1.166,1.166,0,0,1,0-1.654,1.181,1.181,0,0,1,1.659,0l7.027,7.022a1.169,1.169,0,0,1,.034,1.615l-7.056,7.071A1.171,1.171,0,1,1,11.6,20.59Z" transform="translate(-11.246 -6.196)"/></svg></div>', 'sobercheck' ),
            'screen_reader_text' => __( 'Posts navigation', 'sobercheck' )
        );
    
        $args = wp_parse_args( $defaults, $args );
    
        return $args;
    }
}