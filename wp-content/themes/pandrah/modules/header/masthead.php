<header id="masthead" class="site-header" role="banner">
	<div class="container-fluid top-container">	
		<div class="site-branding">
	        <?php if ( has_custom_logo() ) : ?>
	            <div id="site-logo">
	                <?php the_custom_logo(); ?>
	            </div>
	        <?php else: ?>
	        <div id="text-title-desc">
		        <?php if (is_front_page()) : ?>
	            <h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		            <?php bloginfo( 'name' ); ?>
		           	</a>
		        </h1>
		        <?php else : ?>
		        	<div class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		            	<?php bloginfo( 'name' ); ?>
		           		</a>
		        	</div>
		        <?php endif; ?>
	        </div>
	        <?php endif; ?>
	    </div>
	        
		<?php get_template_part('modules/header/menu','primary'); ?>
		
		<div id="social" class="">
			<?php get_template_part('modules/social/social', 'fa'); ?>
		</div>
	</div>
		
</header><!-- #masthead -->