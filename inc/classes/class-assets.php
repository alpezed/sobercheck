<?php
namespace Sobercheck\Inc;

use Sobercheck\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue scripts and styles.
 */
class Assets {
    use Singleton;

    public function __construct() {
        $this->hooks();
    }

    public function hooks() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    public function enqueue_scripts() {
        wp_enqueue_style( 'sobercheck-style', get_stylesheet_uri(), array(), SOBER_CHECK_VERSION );
        wp_enqueue_style( 'fontawesome', SOBER_CHECK_ASSETS_URI . '/fonts/fontawesome/css/all.min.css', array(), SOBER_CHECK_VERSION );
        wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;700&display=swap', false );

        wp_style_add_data( 'sobercheck-style', 'rtl', 'replace' );

        // wp_enqueue_script( 'sobercheck-navigation', SOBER_CHECK_ASSETS_URI . '/js/navigation.js', array(), SOBER_CHECK_VERSION, true );
        wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', array( 'jquery' ), SOBER_CHECK_VERSION, true );
        wp_enqueue_script( 'bootstrap', SOBER_CHECK_ASSETS_URI . '/js/bootstrap.min.js', array( 'jquery' ), SOBER_CHECK_VERSION, true );

        wp_enqueue_script( 'sobercheck-bundle', SOBER_CHECK_ASSETS_URI . '/js/bundle.js', array(), SOBER_CHECK_VERSION, true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
}