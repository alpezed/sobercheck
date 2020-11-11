<?php
namespace Sobercheck\Inc;

use Sobercheck\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit();

/**
 * Add color styling from theme
 *
 * @package Sober_Check
 */
class Custom_Css {
	use Singleton;

	public function __construct() {
		$this->hooks();
	}

	public function hooks() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function enqueue_scripts() {
		$content_padding_top    = \get_field( 'padding_top' );
		$content_padding_bottom = \get_field( 'padding_bottom' );
		$theme_color            = sc_get_setting( 'theme_color' );
		$custom_css             = '';
		if ( ! empty( $theme_color ) ) {
			$custom_css .= "
                ::selection {
                    color: #ffffff;
                    background-color: {$theme_color};
                }
                .btn-primary, .btn-primary:hover, .btn-primary.hover, .site-header .navbar-nav:not(.nav-menu-right) .nav-link::before, .sc-quote blockquote::after, .title-bullet::before, .btn-primary:focus, .btn-primary.focus, .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle, .comment-navigation__next, .comment-navigation__prev, .posts-navigation__next, .posts-navigation__prev, .post-navigation__next, .post-navigation__prev, ul.products li.product .button, .woocommerce-pagination .page-numbers li a {
                    background-color: {$theme_color};
                    border-color: {$theme_color};
				}
				.btn-primary:hover, .posts-navigation__next:hover, .posts-navigation__prev:hover, .post-navigation__next:hover, .post-navigation__prev:hover, ul.products li.product .button:hover, .woocommerce-pagination .page-numbers li a:hover {
					background-color: " . sobercheck_adjust_color_brightness( $theme_color, -20 ) . ";
					border-color: " . sobercheck_adjust_color_brightness( $theme_color, -20 ) . ";
				}
                a, a:hover, a:focus, a:active, .entry-content ul li:before, .site-header .navbar-nav:not(.nav-menu-right) .nav-link:hover, .site-header .navbar-nav.nav-menu-right .nav-link:hover {
                    color: {$theme_color};
                }
                a.text-primary:hover, a.text-primary:focus {
                    color: {$theme_color} !important;
                }
                .btn-link, .text-primary {
                    color: {$theme_color} !important;
				}
				.sc-teams .back {
					box-shadow: inset 0px 0px 0 1px {$theme_color};
				}
            ";
		}

		if ( is_numeric( $content_padding_top ) ) {
			$content_padding_top .= 'px';
		}
		if ( is_numeric( $content_padding_bottom ) ) {
			$content_padding_bottom .= 'px';
		}

		$content_padding  = ! empty( $content_padding_top ) ? "padding-top: $content_padding_top !important;" : '';
		$content_padding .= ! empty( $content_padding_bottom ) ? "padding-bottom: $content_padding_bottom !important;" : '';

		if ( ! empty( $content_padding_top ) || ( ! is_home() || ! is_archive() ) ) {
			$custom_css .= "
                .site-main { $content_padding }
            ";
		}

		wp_add_inline_style( 'sobercheck-style', html_entity_decode( $custom_css, ENT_QUOTES ) );
	}
}
