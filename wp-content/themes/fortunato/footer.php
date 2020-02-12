<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package fortunato
 */
?>
	</div><!-- #content -->
	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) : ?>
		<footer id="colophon" class="site-footer">
			<div class="site-info smallPart">
				<?php $copyrightText = get_theme_mod('fortunato_theme_options_copyright', '&copy; '.date('Y').' '. get_bloginfo('name')); ?>
				<?php echo wp_kses($copyrightText, fortunato_allowed_html()); ?>
				<span class="sep"> | </span>
				<?php
				/* translators: 1: theme name, 2: theme developer */
				printf( esc_html__( 'WordPress Theme: %1$s by %2$s.', 'fortunato' ), '<a target="_blank" href="https://crestaproject.com/downloads/fortunato/" rel="noopener noreferrer" title="Fortunato Theme">Fortunato</a>', 'CrestaProject' );
				?>
			</div><!-- .site-info -->
			<?php $showSocialFooter = get_theme_mod('fortunato_theme_options_socialfooter', ''); ?>
			<?php if($showSocialFooter == 1) : ?>
			<div class="site-social-footer smallPart">
				<div class="socialLine">
					<?php fortunato_social_buttons(); ?>
				</div>
			</div>
			<?php endif; ?>
		</footer><!-- #colophon -->
	<?php endif; ?>
</div><!-- #page -->
<a href="#top" id="toTop" aria-hidden="true"><i class="fArrow up"></i></a>
<?php if (is_active_sidebar( 'sidebar-1' ) ) : ?>	
	<div class="openSidebar">
	  <div id="hamburger">
		<span></span>
		<span></span>
		<span></span>
	  </div>
	  <div id="cross">
		<span></span>
		<span></span>
	  </div>
	</div>
<?php endif; ?>
<?php wp_footer(); ?>

</body>
</html>
