<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package fortunato
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}
?>
<div id="page" class="hfeed site <?php echo esc_attr(fortunato_headeropt()); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fortunato' ); ?></a>
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) : ?>
		<?php 
			$headerOverlay = get_theme_mod('fortunato_theme_options_headeroverlay', '1');
			$hideSearch = get_theme_mod('fortunato_theme_options_hidesearch', '1');
			$pageforposts = get_option('page_for_posts');
		?>
		<?php if (is_singular() && '' != get_the_post_thumbnail() ) : ?>
			<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'fortunato-the-post'); ?>
			<header id="masthead" class="site-header" style="background: url(<?php echo esc_url($src[0]); ?>) 50% 50% / cover no-repeat;">
		<?php elseif (function_exists( 'is_shop' ) && is_shop() && function_exists( 'is_woocommerce' ) ) : ?>
			<?php $shopImageID = get_option( 'woocommerce_shop_page_id' ); ?>
			<?php if( '' != get_the_post_thumbnail($shopImageID) ) : ?>
				<?php $srcShop = wp_get_attachment_image_src( get_post_thumbnail_id($shopImageID), 'fortunato-the-post'); ?>
				<header id="masthead" class="site-header" style="background: url(<?php echo esc_url($srcShop[0]); ?>) 50% 50% / cover no-repeat;">
			<?php else: ?>
				<header id="masthead" class="site-header" style="background: url(<?php header_image(); ?>) 50% 50% / cover no-repeat;">
			<?php endif; ?>
		<?php elseif (is_home() && !is_front_page() && '' != get_the_post_thumbnail($pageforposts) ) : ?>
			<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id( $pageforposts ), 'fortunato-the-post' ); ?>
			<header id="masthead" class="site-header" style="background: url(<?php echo esc_url($src[0]); ?>) 50% 50% / cover no-repeat;">
		<?php else: ?>
			<header id="masthead" class="site-header" style="background: url(<?php header_image(); ?>) 50% 50% / cover no-repeat;">
		<?php endif; ?>	
			<div class="site-social">
				<div class="socialLine">
					<?php fortunato_social_buttons(); ?>
					<?php if ($hideSearch == 1 ) : ?>
						<div class="openSearch"><i class="fa fa-search"></i></div>
					<?php endif; ?>
				</div>
			</div>
			
			<?php if ($hideSearch == 1 ) : ?>
			<!-- Start: Search Form -->
			<div id="search-full">
				<div class="search-container">
					<form method="get" id="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
						<label>
							<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'fortunato' ); ?></span>
							<input type="search" name="s" id="search-field" placeholder="<?php esc_attr_e('Type here and hit enter...', 'fortunato'); ?>">
						</label>
					</form>
					<span class="closeSearch"><i class="fas fa-times spaceRight"></i><?php esc_html_e('Close', 'fortunato'); ?></span>
				</div>
			</div>
			<!-- End: Search Form -->
			<?php endif; ?>
			
			<?php if ($headerOverlay == 1 ) : ?>
				<div class="site-brand-main" style=" background-image: url(<?php echo esc_url(get_template_directory_uri()) . '/images/overlay.png'; ?>);">
			<?php else: ?>
				<div class="site-brand-main">
			<?php endif; ?>
				<div class="site-branding">
					<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;
					$fortunato_description = get_bloginfo( 'description', 'display' );
					if ( $fortunato_description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $fortunato_description; /* // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></p>
					<?php
					endif; ?>
				</div><!-- .site-branding -->
			</div>
			
			<div class="theNavigationBar">
				<nav id="site-navigation" class="main-navigation">
					<?php $mobileMenuText = get_theme_mod('fortunato_theme_options_menutext', __( 'Main Menu', 'fortunato' )); ?>
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php echo esc_attr($mobileMenuText); ?>"><?php echo esc_html($mobileMenuText); ?><i class="fas fa-bars" aria-hidden="true"></i></button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->
			</div>
		</header><!-- #masthead -->
	<?php endif; ?>
	<div id="content" class="site-content">
