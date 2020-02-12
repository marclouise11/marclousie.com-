<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package fortunato
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function fortunato_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'fortunato_infinite_scroll_render',
		'footer'    => 'page',
	) );
	
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
	
	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details' => array(
			'stylesheet' => 'fortunato-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
	) );
}
add_action( 'after_setup_theme', 'fortunato_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function fortunato_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'content', get_post_format() );
	}
}
