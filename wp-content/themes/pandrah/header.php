<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package pandrah
 */
?>
<?php get_template_part('modules/header/head'); ?>

<body <?php body_class(); ?>>

<?php get_template_part('modules/header/masthead'); ?>
<?php get_template_part('modules/header/jumbosearch'); ?>

<?php if (is_front_page() && has_header_image() ) : ?>
<div id="header-image" class="container">
	<img src="<?php header_image(); ?>" alt="<?php the_title(); ?>">
</div>
<?php endif; ?>

<div id="page" class="hfeed site">
	
	
	<div class="mega-container">
	
		<div id="content" class="site-content container">