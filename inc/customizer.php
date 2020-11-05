<?php
/**
 * Sober Check Theme Customizer
 *
 * @package Sober_Check
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sobercheck_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'sobercheck_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'sobercheck_customize_partial_blogdescription',
			)
		);
	}

	/**
	 * Add our Sample Section
	 */
	$prefix = 'sobercheck';
	$wp_customize->add_section( "{$prefix}_options",
		array(
			'title' => __( 'Theme options' ),
			'priority' => 30, // Not typically needed. Default is 160
			'capability' => 'edit_theme_options',
		)
	);

	/*
	 * Settings
	 */
	$wp_customize->add_setting( "phone_number",
		array(
			'default' => '', // Optional.
			'transport' => 'refresh', // Optional. 'refresh' or 'postMessage'. Default: 'refresh'
			'default' => __( '0800 700 777', 'sobercheck' ),
			'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
		)
	);
	
	$wp_customize->add_setting( "footer_text",
		array(
			'default' => '', // Optional.
			'transport' => 'refresh', // Optional. 'refresh' or 'postMessage'. Default: 'refresh'
			'default' => __( '<p class="copyright"><img src="/wp-content/uploads/2020/11/footer-icon.png" alt="" width="22" class="mr-2"> <span class="text">&copy; Copyright 2020 ' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '. <span class="site-author d-block d-lg-inline-block">Designed by The Web Guys.</span></span></p>', 'sobercheck' ),
			'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
		)
	);

	$wp_customize->add_control( 'phone_number', array(
		'label' => __( 'Phone Number' ),
		'type' => 'text',
		'section' => "{$prefix}_options",
		'settings' => "phone_number",
		'description' => __( 'Phone number here', 'sobercheck' ),
	) );
	
	$wp_customize->add_control( 'footer_text', array(
		'label' => __( 'Footer Text' ),
		'type' => 'textarea',
		'section' => "{$prefix}_options",
		'settings' => "footer_text",
		'description' => __( 'Add footer text here', 'sobercheck' ),
	) );
}
add_action( 'customize_register', 'sobercheck_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function sobercheck_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function sobercheck_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sobercheck_customize_preview_js() {
	wp_enqueue_script( 'sobercheck-customizer', SOBER_CHECK_DIR_URI . '/js/customizer.js', array( 'customize-preview' ), SOBER_CHECK_VERSION, true );
}
add_action( 'customize_preview_init', 'sobercheck_customize_preview_js' );
