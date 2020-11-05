<?php
/**
 * Sober Check functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sober_Check
 */

 /**
  * Define constant
  */
if ( ! defined( 'SOBER_CHECK_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'SOBER_CHECK_VERSION', '1.0.0' );
}

if ( ! defined( 'SOBER_CHECK_DIR_PATH' ) ) {
	define( 'SOBER_CHECK_DIR_PATH', get_template_directory() );
}

if ( ! defined( 'SOBER_CHECK_DIR_URI' ) ) {
	define( 'SOBER_CHECK_DIR_URI', get_template_directory_uri() );
}

if ( ! defined( 'SOBER_CHECK_ASSETS_URI' ) ) {
	define( 'SOBER_CHECK_ASSETS_URI', get_template_directory_uri() . '/assets' );
}

require SOBER_CHECK_DIR_PATH . '/inc/autoloader.php';

/**
 * Theme initialization
 */
function sobercheck_init() {
	\Sobercheck\Inc\SoberCheck_Theme::get_instance();
}
sobercheck_init();

/**
 * Custom template tags for this theme.
 */
require SOBER_CHECK_DIR_PATH . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require SOBER_CHECK_DIR_PATH . '/inc/functions.php';

/**
 * Customizer additions.
 */
require SOBER_CHECK_DIR_PATH . '/inc/customizer.php';

// Custom Nav Walker: wp_bootstrap4_navwalker()
require SOBER_CHECK_DIR_PATH . '/inc/wp_bootstrap_navwalker.php';
require SOBER_CHECK_DIR_PATH . '/inc/wp_bootstrap_navwalker_footer.php';