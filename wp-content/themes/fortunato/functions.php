<?php
/**
 * fortunato functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fortunato
 */

if ( ! function_exists( 'fortunato_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fortunato_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on fortunato, use a find and replace
	 * to change 'fortunato' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fortunato', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/* Support for wide images on Gutenberg */
	add_theme_support( 'align-wide' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'fortunato-the-post' , 1920, 99999);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'fortunato' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'video', 'audio', 'gallery'
	) );
	
	// Adds support for editor font sizes.
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'Small', 'fortunato' ),
			'shortName' => __( 'S', 'fortunato' ),
			'size'      => 14,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'Regular', 'fortunato' ),
			'shortName' => __( 'M', 'fortunato' ),
			'size'      => 18,
			'slug'      => 'regular'
		),
		array(
			'name'      => __( 'Large', 'fortunato' ),
			'shortName' => __( 'L', 'fortunato' ),
			'size'      => 20,
			'slug'      => 'large'
		),
		array(
			'name'      => __( 'Larger', 'fortunato' ),
			'shortName' => __( 'XL', 'fortunato' ),
			'size'      => 24,
			'slug'      => 'larger'
		)
	) );

}
endif; // fortunato_setup
add_action( 'after_setup_theme', 'fortunato_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fortunato_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fortunato_content_width', 930 );
}
add_action( 'after_setup_theme', 'fortunato_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function fortunato_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fortunato' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'fortunato_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fortunato_scripts() {
	wp_enqueue_style( 'fortunato-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );
	wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() .'/css/all.min.css', array(), '5.11.2');
	$query_args = array(
		'family' => 'Roboto+Condensed:300,400,700',
		'display' => 'swap'
	);
	wp_enqueue_style( 'fortunato-googlefonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );

	wp_enqueue_script( 'fortunato-custom', get_template_directory_uri() . '/js/jquery.fortunato.min.js', array('jquery'), wp_get_theme()->get('Version'), true );
	wp_enqueue_script( 'fortunato-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '20151215', true );
	wp_enqueue_script( 'fortunato-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20151215', true );
	
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		wp_enqueue_script( 'fortunato-nanoScroll', get_template_directory_uri() . '/js/jquery.nanoscroller.min.js', array('jquery'), '0.8.7', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/* Dequeue default WooCommerce Layout */
	wp_dequeue_style ( 'woocommerce-layout' );
	wp_dequeue_style ( 'woocommerce-smallscreen' );
	wp_dequeue_style ( 'woocommerce-general' );
}
add_action( 'wp_enqueue_scripts', 'fortunato_scripts' );

function fortunato_gutenberg_scripts() {
	wp_enqueue_style( 'fortunato-gutenberg-css', get_theme_file_uri( '/css/gutenberg-editor-style.css' ), array(), wp_get_theme()->get('Version') );
}
add_action( 'enqueue_block_editor_assets', 'fortunato_gutenberg_scripts' );

/**
 * Register all Elementor locations
 */
function fortunato_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'fortunato_register_elementor_locations' );

/**
 * WooCommerce Support
 */
if ( ! function_exists( 'fortunato_woocommerce_support' ) ) :
	function fortunato_woocommerce_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
	}
	add_action( 'after_setup_theme', 'fortunato_woocommerce_support' );
endif; // fortunato_woocommerce_support

/**
 * WooCommerce: Chenge default max number of related products to 3
 */
if ( function_exists( 'is_woocommerce' ) ) :
	if ( ! function_exists( 'fortunato_related_products_args' ) ) :
		add_filter( 'woocommerce_output_related_products_args', 'fortunato_related_products_args' );
		function fortunato_related_products_args( $args ) {
			$args['posts_per_page'] = 3;
			return $args;
		}
	endif;
endif;

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Fortunato Dynamic.
 */
require get_template_directory() . '/inc/fortunato-dynamic.php';

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/fortunato-admin-page.php';
}

/**
 * Load PRO Button in the customizer
 */
require get_template_directory() . '/inc/pro-button/class-customize.php';