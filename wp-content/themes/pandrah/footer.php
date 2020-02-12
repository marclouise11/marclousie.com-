<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package pandrah
 */
?>

	</div><!-- #content -->
</div><!-- #page -->

	<?php get_sidebar('footer'); ?>

	<footer id="colophon" class="site-footer title-font container" role="contentinfo">
		
		<div class="site-info">
			<?php if (is_front_page()) : ?>
				<?php _e('Designed by','pandrah') ?> <a href="<?php echo 'https://codetorank.com/pandrah/'; ?>"><?php _e('CodetoRank.com','pandrah') ?></a>. 
				<?php echo '&copy; '.date_i18n( __( 'Y', 'pandrah' ) ).' '.get_bloginfo('name').__('. All Rights Reserved. ','pandrah');  ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php _e('Go to Homepage','pandrah'); ?></a>. 
				<?php echo '&copy; '.date_i18n( __( 'Y', 'pandrah' ) ).' '.get_bloginfo('name').__('. All Rights Reserved. ','pandrah');  ?>
			<?php endif; ?>	
				
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
	

<nav id="menu" class="panel" role="navigation">
	 <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
</nav>

<?php wp_footer(); ?>

</body>
</html>
