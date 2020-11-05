<?php
namespace Sobercheck\Inc;

use Sobercheck\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
class Sidebars {
    use Singleton;

    public function __construct() {
        $this->hooks();
    }

    public function hooks() {
        add_action( 'widgets_init', array( $this, 'widgets_init' ) );
    }

    public function widgets_init() {
        register_sidebar(
            array(
                'name'          => esc_html__( 'Sidebar', 'sobercheck' ),
                'id'            => 'sidebar-1',
                'description'   => esc_html__( 'Add widgets here.', 'sobercheck' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    
        /**
         * Generate footer widgets
         */
        $footer_map = array( 'One', 'Two', 'Three' );
        for ( $i = 1; $i <= 3; $i++ ) { 
            register_sidebar(
                array(
                    'name'          => sprintf( __( 'Footer %1$s', 'sobercheck' ), $footer_map[ $i - 1 ] ),
                    'id'            => 'footer-widget-' . $i,
                    'description'   => esc_html__( 'Add footer widgets here.', 'sobercheck' ),
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h2 class="widget-title">',
                    'after_title'   => '</h2>',
                )
            );
        }
    }
}