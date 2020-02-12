<?php
/**
 * noblia theme Customizer
 *
 * @package noblia
 */

function noblia_theme_options( $wp_customize ) {
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}

add_action( 'customize_register' , 'noblia_theme_options' );

/**
 * Options for WordPress Theme Customizer.
 */
function noblia_customizer( $wp_customize ) {

	global $noblia_site_layout, $noblia_thumbs_layout;

	/**
	 * Section: Color Settings
	 */

	// Change accent color
	$wp_customize->add_setting( 'noblia_accent_color', array(
		'default'        => '#ffda23',
		'sanitize_callback' => 'noblia_sanitize_hexcolor',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'noblia_accent_color', array(
		'label'     => __('Accent color','noblia'),
		'section'   => 'colors',
		'priority'  => 1,
	)));

	/**
	 * Section: Theme layout options
	 */

	$wp_customize->add_section('noblia_layout_section', 
		array(
			'priority' => 32,
			'title' => __('Layout options', 'noblia'),
			'description' => __('Choose website layout', 'noblia'),
			)
		);

		// Sidebar position
		$wp_customize->add_setting('noblia_sidebar_position', array(
			'default' => 'mz-sidebar-right',
			'sanitize_callback' => 'noblia_sanitize_layout'
		));

		$wp_customize->add_control('noblia_sidebar_position', array(
			'priority'  => 1,
			'label' => __('Website Layout Options', 'noblia'),
			'section' => 'noblia_layout_section',
			'type'    => 'select',
			'description' => __('Choose between different layout options to be used as default', 'noblia'),
			'choices'    => $noblia_site_layout
		));

	/**
	 * Section: Change footer text
	 */

	// Change footer copyright text
	$wp_customize->add_setting( 'noblia_footer_text', array(
		'default'        => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( 'noblia_footer_text', array(
		'label'     => __('Footer Copyright Text','noblia'),
		'section'   => 'title_tagline',
		'priority'    => 31,
	));

	/**
	 * Section: Slider settings
	 */

	$wp_customize->add_section( 
		'noblia_slider_options', 
		array(
			'priority'    => 33,
			'title'       => __( 'Slider Settings', 'noblia' ),
			'capability'  => 'edit_theme_options',
			'description' => __('Change slider settings here.', 'noblia'), 
		) 
	);

		// chose category for slider
		$wp_customize->add_setting( 'noblia_slider_cat', array(
			'default' => 0,
			'transport'   => 'refresh',
			'sanitize_callback' => 'noblia_sanitize_slidercat'
		) );	

		$wp_customize->add_control( 'noblia_slider_cat', array(
			'priority'  => 1,
			'type' => 'select',
			'label' => __('Choose a category.', 'noblia'),
			'choices' => noblia_cats(),
			'section' => 'noblia_slider_options',
		) );

		// checkbox show/hide slider
		$wp_customize->add_setting( 'show_noblia_slider', array(
			'default'        => false,
			'transport'  =>  'refresh',
			'sanitize_callback' => 'noblia_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'show_noblia_slider', array(
			'priority'  => 2,
			'label'     => __('Show Slider?','noblia'),
			'section'   => 'noblia_slider_options',
			'type'      => 'checkbox',
		) );

}

add_action( 'customize_register', 'noblia_customizer' );

/**
 * Adds sanitization for text inputs
 */
function noblia_sanitize_input($input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Adds sanitization callback function: Slider Category
 */
function noblia_sanitize_slidercat( $input ) {
	if ( array_key_exists( $input, noblia_cats()) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze checkbox for WordPress customizer
 */
function noblia_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Sanitze number for WordPress customizer
 */
function noblia_sanitize_number($input) {
	if ( isset( $input ) && is_numeric( $input ) ) {
		return $input;
	}
}

/**
 * Sanitze blog layout
 */
function noblia_sanitize_layout( $input ) {
	global $noblia_site_layout;
	if ( array_key_exists( $input, $noblia_site_layout ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze thumbs layout
 */
function noblia_sanitize_thumbs( $input ) {
	global $noblia_thumbs_layout;
	if ( array_key_exists( $input, $noblia_thumbs_layout ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze colors
 */
function noblia_sanitize_hexcolor($color)
{
	if ($unhashed = sanitize_hex_color_no_hash($color)) {
		return '#'.$unhashed;
	}

	return $color;
}