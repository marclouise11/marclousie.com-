<?php
//Settings for Header Image
function pandrah_customize_register_header( $wp_customize ) {
$wp_customize->add_setting( 'pandrah_himg_style' , array(
    'default'     => 'cover',
    'sanitize_callback' => 'pandrah_sanitize_himg_style'
) );

/* Sanitization Function */
function pandrah_sanitize_himg_style( $input ) {
    if (in_array( $input, array('contain','cover') ) )
        return $input;
    else
        return '';
}

$wp_customize->add_control(
    'pandrah_himg_style', array(
    'label' => __('Header Image Arrangement','pandrah'),
    'section' => 'header_image',
    'settings' => 'pandrah_himg_style',
    'type' => 'select',
    'choices' => array(
        'contain' => __('Contain','pandrah'),
        'cover' => __('Cover Completely (Recommended)','pandrah'),
    )
) );

$wp_customize->add_setting( 'pandrah_himg_align' , array(
    'default'     => 'center',
    'sanitize_callback' => 'pandrah_sanitize_himg_align'
) );

/* Sanitization Function */
function pandrah_sanitize_himg_align( $input ) {
    if (in_array( $input, array('center','left','right') ) )
        return $input;
    else
        return '';
}

$wp_customize->add_control(
    'pandrah_himg_align', array(
    'label' => __('Header Image Alignment','pandrah'),
    'section' => 'header_image',
    'settings' => 'pandrah_himg_align',
    'type' => 'select',
    'choices' => array(
        'center' => __('Center','pandrah'),
        'left' => __('Left','pandrah'),
        'right' => __('Right','pandrah'),
    )
) );

$wp_customize->add_setting( 'pandrah_himg_repeat' , array(
    'default'     => true,
    'sanitize_callback' => 'pandrah_sanitize_checkbox'
) );

$wp_customize->add_control(
    'pandrah_himg_repeat', array(
    'label' => __('Repeat Header Image','pandrah'),
    'section' => 'header_image',
    'settings' => 'pandrah_himg_repeat',
    'type' => 'checkbox',
) );
}
add_action( 'customize_register', 'pandrah_customize_register_header' );