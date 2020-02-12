<?php
/**
 * Enqueue scripts and styles.
 */
function pandrah_scripts() {
    wp_enqueue_style( 'pandrah-style', get_stylesheet_uri() );

    wp_enqueue_style( 'pandrah-main-theme-style', get_template_directory_uri() . '/assets/theme-styles/css/default.css', array(), mt_rand(0,900000));
			
    wp_enqueue_script( 'jquery-bigslide', get_template_directory_uri() . '/assets/js/bigSlide.min.js', array('jquery'), null, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    
    wp_enqueue_style('pandrah-title-font', '//fonts.googleapis.com/css?family=Muli:300,400,400i,600,700' );

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'pandrah_scripts' );