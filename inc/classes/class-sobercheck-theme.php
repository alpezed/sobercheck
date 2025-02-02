<?php
namespace Sobercheck\Inc;

use Sobercheck\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Initial setup
 */
class SoberCheck_Theme {
	use Singleton;
		
	/**
	 * Accent Colors
	 *
	 * @var array
	 */
	public $accent_colors = array();
    
    /**
     * The constructor
     *
     * @return void
     */
    public function __construct() {
		if ( class_exists( 'WooCommerce' ) ) {
			Woocommerce::get_instance();
		}
		Assets::get_instance();
		Sidebars::get_instance();
		Hooks::get_instance();
		Custom_Css::get_instance();
		Kirki::get_instance();
		Custom_Post_Types::get_instance();

		$this->accent_colors = array(
			'#1D8CBE',
			'#FF9226',
			'#1DBF8D',
			'#93629F',
		);
		// $this->get_accent_colors();

        $this->init();
    }

    public function init() {
        add_action( 'after_setup_theme', array( $this, 'setup' ) );
	}
	
	public function get_accent_colors() {
		if ( ! empty( sc_get_setting( 'color_scheme_1' ) ) ) {
			$this->accent_colors[0] = \sc_get_setting( 'color_scheme_1' );
		}

		if ( ! empty( sc_get_setting( 'color_scheme_2' ) ) ) {
			$this->accent_colors[1] = \sc_get_setting( 'color_scheme_2' );
		}

		if ( ! empty( sc_get_setting( 'color_scheme_3' ) ) ) {
			$this->accent_colors[2] = \sc_get_setting( 'color_scheme_3' );
		}

		if ( ! empty( sc_get_setting( 'color_scheme_4' ) ) ) {
			$this->accent_colors[3] = \sc_get_setting( 'color_scheme_4' );
		}

		return $this->accent_colors;
	}

    public function setup() {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Sober Check, use a find and replace
		 * to change 'sobercheck' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sobercheck', SOBER_CHECK_DIR_PATH . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'main-menu'	 => esc_html__( 'Main Menu', 'sobercheck' ),
				'primary-menu'	 => esc_html__( 'Primary Menu', 'sobercheck' ),
				'secondary-menu' => esc_html__( 'Secondary Menu', 'sobercheck' ),
				'mobile-menu' => esc_html__( 'Mobile Menu', 'sobercheck' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'sobercheck_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
        );

        /**
         * Set the content width in pixels, based on the theme's design and stylesheet.
         *
         * Priority 0 to make it available to lower priority callbacks.
         *
         * @global int $content_width
         */
		$GLOBALS['content_width'] = apply_filters( 'sobercheck_content_width', 640 );

		/**
		 * Add custom image size
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_image_size/
		 */
		add_image_size( 'sc-blog-thumb', 350, 215, true );
		add_image_size( 'sc-team-thumb', 350, 400, true );
    }
}