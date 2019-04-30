<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

cityhostel_storage_set('blog_archive', true);

// Load scripts for 'Masonry' layout
if (substr(cityhostel_get_theme_option('blog_style'), 0, 7) == 'masonry') {
	wp_enqueue_script( 'classie', cityhostel_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
	wp_enqueue_script( 'imagesloaded', cityhostel_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
	wp_enqueue_script( 'masonry', cityhostel_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
	wp_enqueue_script( 'cityhostel-gallery-script', cityhostel_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );
}

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$cityhostel_classes = 'posts_container '
						. (substr(cityhostel_get_theme_option('blog_style'), 0, 7) == 'classic' ? 'columns_wrap' : 'masonry_wrap');
	$cityhostel_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$cityhostel_sticky_out = is_array($cityhostel_stickies) && count($cityhostel_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($cityhostel_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$cityhostel_sticky_out) {
		if (cityhostel_get_theme_option('first_post_large') && !is_paged() && !in_array(cityhostel_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( 'content', 'excerpt' );
		}
		
		?><div class="<?php echo esc_attr($cityhostel_classes); ?>"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($cityhostel_sticky_out && !is_sticky()) {
			$cityhostel_sticky_out = false;
			?></div><div class="<?php echo esc_attr($cityhostel_classes); ?>"><?php
		}
		get_template_part( 'content', $cityhostel_sticky_out && is_sticky() ? 'sticky' : 'classic' );
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