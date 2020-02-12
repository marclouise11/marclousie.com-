<?php
//Function to Trim Excerpt Length & more..
function pandrah_excerpt_length( $length ) {
	if (!is_admin()) {
    	return 23;
    }
}
add_filter( 'excerpt_length', 'pandrah_excerpt_length', 999 );

function pandrah_excerpt_more( $more ) {
	if (!is_admin())
    	return '...';
}
add_filter( 'excerpt_more', 'pandrah_excerpt_more' );