<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

cityhostel_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	?><div class="posts_container"><?php
	
	$cityhostel_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$cityhostel_sticky_out = is_array($cityhostel_stickies) && count($cityhostel_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($cityhostel_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($cityhostel_sticky_out && !is_sticky()) {
			$cityhostel_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $cityhostel_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($cityhostel_sticky_out) {
		$cityhostel_sticky_out = false;
		?></div><?php
	}
	
	?></div><?php

	cityhostel_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>