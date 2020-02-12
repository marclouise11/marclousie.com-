<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package pandrah
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function pandrah_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer' => false,
		'type' => 'click',
		'render' => 'pandrah_jetpack_render_posts',
		'posts_per_page' => 10
	) );
}
add_action( 'after_setup_theme', 'pandrah_jetpack_setup' );

function pandrah_jetpack_render_posts() {
		while( have_posts() ) {
	    the_post();
	    do_action('pandrah_blog_layout'); 
	}
}

function pandrah_filter_jetpack_infinite_scroll_js_settings( $settings ) {
    $settings['text'] = __( 'Load more posts...', 'pandrah' );
    return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'pandrah_filter_jetpack_infinite_scroll_js_settings' );