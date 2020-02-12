<?php
	
//Import Admin Modules
require get_template_directory() . '/modules/admin_modules/register_styles.php';
require get_template_directory() . '/modules/admin_modules/register_widgets.php';
require get_template_directory() . '/modules/admin_modules/theme_setup.php';
require get_template_directory() . '/modules/admin_modules/excerpt_length.php';

/*
**	Determining Sidebar and Primary Width
*/
function pandrah_primary_class() {
	$class = "md-8";
	echo $class;
}
add_action('pandrah_primary-width', 'pandrah_primary_class');

function pandrah_secondary_class() {
	$class = "md-4";
	echo $class;
}
add_action('pandrah_secondary-width', 'pandrah_secondary_class');


/*
** Function to Get Theme Layout 
*/
function pandrah_get_blog_layout(){
	$ldir = 'modules/content/content';
	if (get_theme_mod('pandrah_blog_layout') ) :
		get_template_part( $ldir , get_theme_mod('pandrah_blog_layout') );
	else :
		get_template_part( $ldir ,'pandrah');	
	endif;	
}
add_action('pandrah_blog_layout', 'pandrah_get_blog_layout');
	
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/modules/customizer/init.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
