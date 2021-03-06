<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package noblia
 */
?>

<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-image">
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail( 'noblia-thumbnail' ); ?>
		</a>
	<?php endif; ?></div>
	<div class="blog-post-body">
	<div class="post-header">
		<span class="cat"><?php the_category( ' | ' ); ?></span>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</div>


	<div class="post-date">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'noblia' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</div>

		<div class="post-entry">
			<?php the_content(); ?>
			<?php			
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'noblia' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'noblia' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			?>
		</div>
	</div>
</article>