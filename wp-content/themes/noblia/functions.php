<?php
/**
 *
 * @package noblia
 */

global $noblia_site_layout;
$noblia_site_layout = array(
					'mz-sidebar-left' =>  esc_html__('Left Sidebar','noblia'),
					'mz-sidebar-right' => esc_html__('Right Sidebar','noblia'),
					'no-sidebar' => esc_html__('No Sidebar','noblia')
					);
$noblia_thumbs_layout = array(
					'landscape' =>  esc_html__('Landscape','noblia'),
					'portrait' => esc_html__('Portrait','noblia')
					);

if ( ! function_exists( 'noblia_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function noblia_setup() {

	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	*/
	load_theme_textdomain( 'noblia', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'noblia-slider-thumbnail', 700, 390, true );
	add_image_size( 'noblia-large-thumbnail', 1140, 640, true );
	add_image_size( 'noblia-landscape-thumbnail', 750, 490, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'noblia' ),
	) );

	// Set the content width based on the theme's design and stylesheet.
	global $content_width;
	if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
	} 

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'noblia_custom_background_args', array(
		'default-color' => 'FFFFFF',
		'default-image' => '',
	) ) );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 230,
		'flex-height' => true,
	) );

}
endif; // noblia_setup
add_action( 'after_setup_theme', 'noblia_setup' );


/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
if ( ! function_exists( 'noblia_the_custom_logo' ) ) :
function noblia_the_custom_logo() {
	// Try to retrieve the Custom Logo
	$output = '';
	if ((function_exists('get_custom_logo'))&&(has_custom_logo()))
		$output = get_custom_logo();

		// Nothing in the output: Custom Logo is not supported, or there is no selected logo
		// In both cases we display the site's name
	if (empty($output))
		$output = '<hgroup><h1><a href="' . esc_url(home_url('/')) . '" rel="home">' . esc_html(get_bloginfo('name')) . '</a></h1></hgroup>';

	echo $output;
}
endif; // sanremo_custom_logo


/*
 * Add Bootstrap classes to the main-content-area wrapper.
 */
if ( ! function_exists( 'noblia_content_bootstrap_classes' ) ) :
function noblia_content_bootstrap_classes() {
	if ( is_page_template( 'template-fullwidth.php' ) ) {
		return 'col-md-12';
	}
	return 'col-md-8';
}
endif; // noblia_content_bootstrap_classes


/*
 * Generate categories for slider customizer
 */
function noblia_cats() {
	$cats = array();
	$cats[0] = esc_html__("All", "noblia");
	
	foreach ( get_categories() as $categories => $category ) {
		$cats[$category->term_id] = $category->name;
	}

	return $cats;
}

/*
 * generate navigation from default bootstrap classes
 */
include( get_template_directory() . '/inc/wp_bootstrap_navwalker.php');

if ( ! function_exists( 'noblia_header_menu' ) ) :
/*
 * Header menu (should you choose to use one)
 */
function noblia_header_menu() {

	wp_nav_menu(array(
		'theme_location'    => 'primary',
		'depth'             => 3,
		'container'         => 'div',
		'container_class'   => 'collapse navbar-collapse navbar-ex2-collapse',
		'menu_class'        => 'nav navbar-nav',
		'fallback_cb'       => 'noblia_bootstrap_navwalker::fallback',
		'walker'            => new noblia_bootstrap_navwalker()
	));
} /* end header menu */
endif;

/*
 * Register Google fonts for theme.
 */
if ( ! function_exists( 'noblia_fonts_url' ) ) :
/**
 * Create your own noblia_fonts_url() function to override in a child theme.
 *
 * @since noblia 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function noblia_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Noto Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'noblia' ) ) {
		$fonts[] = 'Open Sans:400,500,700';
	}

	/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'noblia' ) ) {
		$fonts[] = 'Raleway:300,400,400italic,500,600,700,800,900,700italic';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/*
 * load css/js
 */
function noblia_scripts() {

	// Add Google Fonts
	wp_enqueue_style( 'noblia-webfonts', noblia_fonts_url(), array(), null, null );

	// Add Bootstrap default CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css' );

	// Add main theme stylesheet
	wp_enqueue_style( 'noblia-style', get_stylesheet_uri() );

	// Add JS Files
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery') );
	wp_enqueue_script( 'noblia-js', get_template_directory_uri().'/js/noblia.js', array('jquery') );

	// Threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'noblia_scripts' );

/*
 * Add custom colors css to header
 */
if (!function_exists('noblia_custom_css_output'))  {
	function noblia_custom_css_output() {

		$noblia_accent_color = get_theme_mod( 'noblia_accent_color' );

		echo '<style type="text/css" id="noblia-custom-theme-css">';

		if ( $noblia_accent_color != "") {
			echo '.list-post .read-more a:hover, .list-post-body h2 a:hover, .ot-widget-post h2 a:hover, .widget ul li a:hover { box-shadow: ' . esc_attr($noblia_accent_color) . ' 0 -3px 0 inset;}' .
			'.nav>li>a:focus, .nav>li>a:hover, .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover, .list-post .post-cat a:hover,.comment-reply-link:hover, .comment-reply-login:hover, .page-numbers .current, .page-numbers li a:hover, .widget_search button, .widget_search button:hover { background-color:  ' . esc_attr($noblia_accent_color) . ';}' .
			'.list-post .read-more a, .list-post .read-more a:hover, .comment-reply-link:hover, .comment-reply-login:hover, .page-numbers li a, .page-numbers .current, .page-numbers li a:hover, .widget_search button, .widget_search button:hover { border-color: ' . esc_attr($noblia_accent_color) . ';}' .
			'.post-header .cat a, .ot-widget-about-author .author-post .read-more a, .null-instagram-feed p a, button, input[type="button"], input[type="reset"], input[type="submit"], .post-navigation .nav-previous .meta-nav:before, .post-navigation .nav-next .meta-nav:before, .comments-title, .widget-title span, .widget_tag_cloud a:hover, #back-top a { background-color: ' . esc_attr($noblia_accent_color) . ';}' .
			'.post-meta span i, .post-header span i, blockquote:before { color: ' . esc_attr($noblia_accent_color) . ';}';
		}

		echo '</style>';

	}
}
add_action( 'wp_head', 'noblia_custom_css_output');

/*
 * Customizer additions.
 */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';

/*
 * Register widget areas.
 */

// if no title then add widget content wrapper to before widget
add_filter( 'dynamic_sidebar_params', 'noblia_check_sidebar_params' );
function noblia_check_sidebar_params( $params ) {
	global $wp_registered_widgets;

	$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
	$settings = $settings_getter->get_settings();
	$settings = $settings[ $params[1]['number'] ];

	if ( $params[0][ 'after_widget' ] == '</div></div>' && isset( $settings[ 'title' ] ) && empty( $settings[ 'title' ] ) )
		$params[0][ 'before_widget' ] .= '<div class="content">';

	return $params;
}

function noblia_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'noblia' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'noblia' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'noblia' ),
		'id'            => 'footer-widget-1',
		'description'   => __( 'Appears in the footer section of the site.', 'noblia' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'noblia' ),
		'id'            => 'footer-widget-2',
		'description'   => __( 'Appears in the footer section of the site.', 'noblia' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'noblia' ),
		'id'            => 'footer-widget-3',
		'description'   => __( 'Appears in the footer section of the site.', 'noblia' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Full Width Footer', 'noblia' ),
		'id'            => 'footer-wide-widget',
		'description'   => __( 'Full width footer area for Instagram, etc. Appears in the footer section after widgets.', 'noblia' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );

}
add_action( 'widgets_init', 'noblia_widgets_init' );

/*
 * Misc. functions
 */

/**
 * Footer credits
 */
function noblia_footer_credits() {
	$noblia_footer_text = sanitize_text_field ( get_theme_mod( 'noblia_footer_text' ) );
	?>
	<div class="site-info">
	<?php if ($noblia_footer_text == '') { ?>
	&copy; <?php echo date_i18n( __( 'Y', 'noblia' ) ); ?> <?php bloginfo( 'name' ); ?><?php esc_html_e('. All rights reserved.', 'noblia'); ?>
	<?php } else { echo esc_html( $noblia_footer_text ); } ?>
	</div><!-- .site-info -->

	<?php
	printf( esc_html__( 'Theme by %1$s Powered by %2$s', 'noblia' ) , '<a href="https://wpwarfare.com/" target="_blank">WPWarfare</a>', '<a href="http://wordpress.org/" target="_blank">WordPress</a>');
}
add_action( 'noblia_footer', 'noblia_footer_credits' );

/* Wrap Post count in a span */
add_filter('wp_list_categories', 'noblia_cat_count_span');
function noblia_cat_count_span($links) {
	$links = str_replace('</a> (', '</a> <span>', $links);
	$links = str_replace(')', '</span>', $links);
	return $links;
}

/* Change excerpt to 20 words */
function noblia_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}	
	return 20;
}
add_filter( 'excerpt_length', 'noblia_excerpt_length', 999 );