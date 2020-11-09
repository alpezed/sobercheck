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
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    public function enqueue_scripts() {
        $theme_color = sc_get_setting( 'theme_color' );
        $custom_css = '';
        if ( ! empty( $theme_color ) ) {
            $custom_css .= "
                ::selection {
                    color: #ffffff;
                    background-color: {$theme_color};
                }
                .btn-primary, .btn-primary:hover, .btn-primary.hover, .site-header .navbar-nav:not(.nav-menu-right) .nav-link::before, .sc-quote blockquote::after, .title-bullet::before, .btn-primary:focus, .btn-primary.focus, .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle {
                    background-color: {$theme_color};
                    border-color: {$theme_color};
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
            ";
        }
        wp_add_inline_style( 'sobercheck-style', $custom_css );
    }
}