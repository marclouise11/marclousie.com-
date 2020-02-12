<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package fortunato
 */

if ( ! function_exists( 'fortunato_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function fortunato_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	
	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	echo '<span class="posted-on"><i class="far fa-clock spaceRight" aria-hidden="true"></i>' . $posted_on . '</span><span class="byline"><i class="far fa-user spaceLeftRight" aria-hidden="true"></i>' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	
	if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="far fa-comments spaceLeftRight" aria-hidden="true"></i>';
		comments_popup_link( esc_html__( 'Leave a comment', 'fortunato' ), esc_html__( '1 Comment', 'fortunato' ), esc_html__( '% Comments', 'fortunato' ) );
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'fortunato_entry_footer' ) ) :
function fortunato_entry_footer() {
	if ( 'post' == get_post_type() ) {
		$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ) {
			echo '<span class="tags-links"><i class="fa fa-tags spaceRight" aria-hidden="true"></i>' . $tags_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	edit_post_link( esc_html__( 'Edit', 'fortunato' ), '<span class="edit-link"><i class="fa fa-wrench spaceRight" aria-hidden="true"></i>', '</span>' );
}
endif;

if ( ! function_exists( 'fortunato_single_category' ) ) :
function fortunato_single_category() {
	if ( 'post' == get_post_type() ) {
		$categories_list = get_the_category_list(' ');
		if ( $categories_list ) {
			echo '<span class="cat-links smallPart">' . $categories_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
endif;