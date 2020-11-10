<?php
/**
 * Theme Customizer
 *
 * @package Sober_Check
 * @since   1.0
 */

use Sobercheck\Inc\SoberCheck_Theme;

$accent_colors = SoberCheck_Theme::get_instance()->accent_colors;

Kirki::add_config( 'theme', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

Kirki::add_panel( 'theme_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Theme Options', 'sobercheck' ),
    'description' => esc_html__( 'Sobercheck theme options', 'sobercheck' ),
) );

$priority = 1;

// General
Kirki::add_section( 'general', array(
    'title'          => esc_html__( 'General', 'sobercheck' ),
    'panel'          => 'theme_options',
    'priority'       => $priority++,
) );

Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'active_accent_color',
	'label'       => esc_html__( 'Active Theme Color', 'sobercheck' ),
	'section'     => 'general',
	'default'     => 'accent-01',
	'placeholder' => esc_html__( 'Select accent color', 'sobercheck' ),
	'priority'    => $priority++,
	'choices'     => array(
		'accent-01' => esc_html__( 'Accent #1', 'sobercheck' ),
		'accent-02' => esc_html__( 'Accent #2', 'sobercheck' ),
		'accent-03' => esc_html__( 'Accent #3', 'sobercheck' ),
		'accent-04' => esc_html__( 'Accent #4', 'sobercheck' ),
	),
	'preset'      => array(
		'accent-01'    => array(
			'settings' => array(
				'theme_color' => $accent_colors[0],
			),
		),
		'accent-02'    => array(
			'settings' => array(
				'theme_color' => $accent_colors[1],
			),
		),
		'accent-03'    => array(
			'settings' => array(
				'theme_color' => $accent_colors[2],
			),
		),
		'accent-04'    => array(
			'settings' => array(
				'theme_color' => $accent_colors[3],
			),
		),
	),
    'description' => esc_html__( 'Select Active Theme Color.', 'sobercheck' ),
 ) );

 Kirki::add_field( 'theme', [
	'type'        => 'color',
	'settings'    => 'theme_color',
	'label'       => esc_html__( 'Theme Color', 'sobercheck' ),
	'section'     => 'general',
	'default'     => $accent_colors[0],
    'description' => esc_html__( 'Select Theme Color.', 'sobercheck' ),
] );

Kirki::add_field( 'theme', [
	'type'        => 'color',
	'settings'    => 'color_scheme_1',
	'label'       => esc_html__( 'Color Scheme #1', 'sobercheck' ),
	'section'     => 'colors',
	'default'     => $accent_colors[0],
    'description' => esc_html__( 'Select Color Scheme.', 'sobercheck' ),
] );

Kirki::add_field( 'theme', [
	'type'        => 'color',
	'settings'    => 'color_scheme_2',
	'label'       => esc_html__( 'Color Scheme #1', 'sobercheck' ),
	'section'     => 'colors',
	'default'     => $accent_colors[1],
    'description' => esc_html__( 'Select Color Scheme.', 'sobercheck' ),
] );

Kirki::add_field( 'theme', [
	'type'        => 'color',
	'settings'    => 'color_scheme_3',
	'label'       => esc_html__( 'Color Scheme #3', 'sobercheck' ),
	'section'     => 'colors',
	'default'     => $accent_colors[2],
    'description' => esc_html__( 'Select Color Scheme.', 'sobercheck' ),
] );

Kirki::add_field( 'theme', [
	'type'        => 'color',
	'settings'    => 'color_scheme_4',
	'label'       => esc_html__( 'Color Scheme #4', 'sobercheck' ),
	'section'     => 'colors',
	'default'     => $accent_colors[3],
    'description' => esc_html__( 'Select Color Scheme.', 'sobercheck' ),
] );

// Header
Kirki::add_section( 'header', array(
    'title'          => esc_html__( 'Header', 'sobercheck' ),
    'panel'          => 'theme_options',
    'priority'       => $priority++,
) );

Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'header_style',
	'label'       => esc_html__( 'Header Style', 'sobercheck' ),
	'section'     => 'header',
	'default'     => '01',
	'placeholder' => esc_html__( 'Select header', 'sobercheck' ),
	'priority'    => $priority++,
	'choices'     => array(
		'01' => esc_html__( 'Style 01', 'sobercheck' ),
		'02' => esc_html__( 'Style 02', 'sobercheck' ),
		'03' => esc_html__( 'Style 03', 'sobercheck' ),
    ),
    'description' => esc_html__( 'Select Header Style.', 'sobercheck' ),
 ) );

Kirki::add_field( 'theme', array(
    'type'        => 'text',
    'settings'    => 'phone_number',
    'label'       => esc_html__( 'Phone Number', 'sobercheck' ),
    'section'     => 'header',
    'default'     => esc_html__( '0800 700 777', 'sobercheck' ),
    'description' => esc_html__( 'Enter Phone Number.', 'sobercheck' ),
    'priority'    => $priority++,
 ) );

 // Footer
 Kirki::add_section( 'footer', array(
    'title'          => esc_html__( 'Footer', 'sobercheck' ),
    'panel'          => 'theme_options',
    'priority'       => $priority++,
) );

Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'footer_widget_style',
	'label'       => esc_html__( 'Footer Widget Style', 'sobercheck' ),
	'section'     => 'footer',
	'default'     => '01',
	'placeholder' => esc_html__( 'Select footer style', 'sobercheck' ),
	'priority'    => $priority++,
	'choices'     => array(
		'01' => esc_html__( 'Style 01', 'sobercheck' ),
		'02' => esc_html__( 'Style 02', 'sobercheck' ),
    ),
    'description' => esc_html__( 'Select Footer Style.', 'sobercheck' ),
 ) );

 Kirki::add_field( 'theme', array(
	'type'		=> 'custom',
	'settings'	=> 'heading_divider',
	// 'label'       => esc_html__( 'This is the label', 'kirki' ), // optional
	'section'	=> 'footer',
	'default'	=> '<h3 style="padding: 15px 20px;background: #d2d2d2;margin-left: -12px;margin-right: -12px;border-bottom: 1px solid #ddd;cursor: default;font-size: 13px;font-weight: 100;text-transform: uppercase;letter-spacing: 1.5px;color: #7b7b7b;">' . esc_html__( 'Call to Action', 'sobercheck' ) . '</h3>',
	'priority'	=> $priority++,
 ) );

 Kirki::add_field( 'theme', [
	'type'			=> 'textarea',
	'settings'		=> 'footer_cta_title',
	'label'			=> esc_html__( 'Title', 'sobercheck' ),
	'section'		=> 'footer',
	// 'default'		=> __( 'Get in touch with us today <br>to discuss your needs!', 'sobercheck' ),
	'default'		=> wp_kses( __( 'Get in touch with us today <br>to discuss your needs!', 'sobercheck' ), array( 'br' => array() ) ),
	'priority'		=> $priority++,
] );

Kirki::add_field( 'theme', [
	'type'			=> 'text',
	'settings'		=> 'footer_cta_button_text',
	'label'			=> esc_html__( 'Button Text', 'sobercheck' ),
	'section'		=> 'footer',
	'default'		=> esc_html__( 'CONTACT US', 'sobercheck' ),
	'priority'		=> $priority++,
    'description'	=> esc_html__( 'Enter Button Text.', 'sobercheck' ),
] );

Kirki::add_field( 'theme', [
	'type'			=> 'link',
	'settings'		=> 'footer_cta_button_link',
	'label'			=> esc_html__( 'Button Link', 'sobercheck' ),
	'section'		=> 'footer',
	'default'		=> '/contact',
	'priority'		=> $priority++,
    'description'	=> esc_html__( 'Enter Button Text.', 'sobercheck' ),
] );

Kirki::add_field( 'theme', [
	'type'        => 'background',
	'settings'    => 'footer_cta_background',
	'label'       => esc_html__( 'Background', 'sobercheck' ),
	'section'     => 'footer',
	'default'     => [
		'background-color'      => 'rgba(20,20,20,.8)',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.sc-footer-cta',
		],
	],
    'description' => esc_html__( 'Select Background.', 'sobercheck' ),
] );

 // Social Icons
 Kirki::add_section( 'socials', array(
    'title'          => esc_html__( 'Social Network', 'sobercheck' ),
    'panel'          => 'theme_options',
    'priority'       => $priority++,
) );

Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'social_link_target',
	'label'    => esc_html__( 'Open link in a new tab.', 'sobercheck' ),
	'section'  => 'socials',
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'sobercheck' ),
		'1' => esc_html__( 'Yes', 'sobercheck' ),
	),
) );

Kirki::add_field( 'theme', array(
	'type'      => 'repeater',
	'settings'  => 'social_link',
	'section'   => 'socials',
	'priority'  => $priority ++,
	'choices'   => array(
		'labels' => array(
			'add-new-row' => esc_html__( 'Add new social network', 'sobercheck' ),
		),
	),
	'row_label' => array(
		'type'  => 'field',
		'field' => 'title',
	),
	'default'   => array(
		array(
			'title'    => esc_html__( 'Facebook', 'sobercheck' ),
			'icon_class' => 'fab fa-facebook-square',
			'link_url'   => 'https://facebook.com',
		),
		array(
			'title'    => esc_html__( 'Twitter', 'sobercheck' ),
			'icon_class' => 'fab fa-twitter',
			'link_url'   => 'https://twitter.com',
		),
	),
	'fields'    => array(
        'title'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Title', 'sobercheck' ),
			'description' => esc_html__( 'Enter your title text for your icon', 'sobercheck' ),
			'default'     => '',
		),
		'icon_class' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Icon Class', 'sobercheck' ),
			'description' => esc_html__( 'This will be the icon class for your link', 'sobercheck' ),
			'default'     => '',
		),
		'link_url'   => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Link URL', 'sobercheck' ),
			'description' => esc_html__( 'This will be the link URL', 'sobercheck' ),
			'default'     => '',
		),
	),
) );

/**
 * Build function to get setting
 */
function sc_get_setting( $option_name ) {
	$value = Kirki::get_option( 'theme', $option_name );
	$value = $value === null ? '' : $value;
	return $value;
}