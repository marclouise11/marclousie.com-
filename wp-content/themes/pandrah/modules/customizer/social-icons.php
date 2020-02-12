<?php
// Social Icons
function pandrah_customize_register_social( $wp_customize ) {
$wp_customize->add_section('pandrah_social_section', array(
    'title' => __('Social Icons','pandrah'),
    'priority' => 44 ,
));

$social_networks = array( //Redefinied in Sanitization Function.
    'none' => __('-','pandrah'),
    'facebook' => __('Facebook','pandrah'),
    'twitter' => __('Twitter','pandrah'),
    'google-plus' => __('Google Plus','pandrah'),
    'instagram' => __('Instagram','pandrah'),
    'rss' => __('RSS Feeds','pandrah'),
    'vine' => __('Vine','pandrah'),
    'vimeo-square' => __('Vimeo','pandrah'),
    'youtube' => __('Youtube','pandrah'),
    'flickr' => __('Flickr','pandrah'),
);

$social_count = count($social_networks);

for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :

    $wp_customize->add_setting(
        'pandrah_social_'.$x, array(
        'sanitize_callback' => 'pandrah_sanitize_social',
        'default' => 'none'
    ));

    $wp_customize->add_control( 'pandrah_social_'.$x, array(
        'settings' => 'pandrah_social_'.$x,
        'label' => __('Icon ','pandrah').$x,
        'section' => 'pandrah_social_section',
        'type' => 'select',
        'choices' => $social_networks,
    ));

    $wp_customize->add_setting(
        'pandrah_social_url'.$x, array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control( 'pandrah_social_url'.$x, array(
        'settings' => 'pandrah_social_url'.$x,
        'description' => __('Icon Url','pandrah'),
        'section' => 'pandrah_social_section',
        'type' => 'url',
        'choices' => $social_networks,
    ));

endfor;

function pandrah_sanitize_social( $input ) {
    $social_networks = array(
        'none' ,
        'facebook',
        'twitter',
        'google-plus',
        'instagram',
        'rss',
        'vine',
        'vimeo-square',
        'youtube',
        'flickr'
    );
    if ( in_array($input, $social_networks) )
        return $input;
    else
        return '';
}
}
add_action( 'customize_register', 'pandrah_customize_register_social' );