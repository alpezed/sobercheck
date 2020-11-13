<?php
namespace Sobercheck\Inc;

use Sobercheck\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Sober_Check
 */
class Hooks {
    use Singleton;

    public function __construct() {
        $this->hooks();
    }

    public function hooks() {
        add_action( 'body_class', array( $this, 'body_classes' ) );
        add_action( 'pingback_header', array( $this, 'pingback_header' ) );
        add_action( 'sc_back_button', array( $this, 'back_button' ) );
        add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
    }

    public function back_button() {
        if ( wp_get_referer() ) {
            echo '<button class="btn btn-link px-0 py-0 d-none d-sm-block" onclick="javascript:history.back()">' . esc_html__( 'Back', 'sobercheck' ) . '</button>';
        }
    }

    public function excerpt_length() {
        return 13;
    }

    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     * @return array
     */
    public function body_classes( $classes ) {
        // Adds a class of hfeed to non-singular pages.
        if ( ! is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if ( ! is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }

        return $classes;
    }

    /**
     * Add a pingback url auto-discovery header for single posts, pages, or attachments.
     */
    public function sobercheck_pingback_header() {
        if ( is_singular() && pings_open() ) {
            printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
        }
    }
}