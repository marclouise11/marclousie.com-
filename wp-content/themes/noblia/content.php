<?php
/**
 *
 * The template used for displaying articles & search results
 *
 * @package noblia
 */
$noblia_options = get_theme_mods();

?>
					<article  id="post-<?php the_ID(); ?>" <?php post_class("list-post"); ?>>

						<div class="post-inner-content">

							<div class="post-image">
								<?php if ( has_post_thumbnail() ) : 

										$noblia_thumb_size = array_key_exists('noblia_sidebar_position', $noblia_options) ? $noblia_options['noblia_sidebar_position'] : '';
										$noblia_thumbs_layout = array_key_exists('noblia_thumbs_layout', $noblia_options) ? $noblia_options['noblia_thumbs_layout'] : '';

										if ($noblia_thumbs_layout == "portrait") $noblia_thumbnail = 'noblia-portrait-thumbnail';
										else $noblia_thumbnail = 'noblia-landscape-thumbnail';
										if ($noblia_thumb_size == 'mz-full-width') $noblia_thumbnail = 'noblia-large-thumbnail';

									?>
									
									<?php echo get_the_post_thumbnail( get_the_ID(), $noblia_thumbnail ); ?>

								<?php endif; ?>
								<span class="post-cat"><?php the_category( ' ' ); ?></span>
							</div>
							<div class="list-post-body">

								<div class="post-header">

									<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

									<div class="post-meta">
										<span><i class="fa fa-calendar"></i><?php echo esc_html(get_the_date()); ?></span>
										<span><i class="fa fa-user"></i><?php echo esc_html(get_the_author()); ?></span>
										<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
											<span><i class="fa fa-commenting-o"></i><?php comments_popup_link( esc_html__( '0 Comments', 'noblia' ), esc_html__( '1 Comment', 'noblia' ), esc_html__( '% Comments', 'noblia' ) ); ?></span>
										<?php endif; ?>
									</div>


									<?php the_excerpt(); ?>
									
									<p class="read-more"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue Reading...', 'noblia' ); ?></a></p>
								</div>

								
							</div>

						</div><!-- end: post-inner-content -->

					</article>
