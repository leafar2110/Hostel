<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

$cityhostel_header_css = $cityhostel_header_image = '';
$cityhostel_header_video = cityhostel_get_header_video();
if (true || empty($cityhostel_header_video)) {
	$cityhostel_header_image = get_header_image();
	if (cityhostel_is_on(cityhostel_get_theme_option('header_image_override')) && apply_filters('cityhostel_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($cityhostel_cat_img = cityhostel_get_category_image()) != '')
				$cityhostel_header_image = $cityhostel_cat_img;
		} else if (is_singular() || cityhostel_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$cityhostel_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($cityhostel_header_image)) $cityhostel_header_image = $cityhostel_header_image[0];
			} else
				$cityhostel_header_image = '';
		}
	}
}

?><header class="top_panel top_panel_default<?php
					echo !empty($cityhostel_header_image) || !empty($cityhostel_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($cityhostel_header_video!='') echo ' with_bg_video';
					if ($cityhostel_header_image!='') echo ' '.esc_attr(cityhostel_add_inline_style('background-image: url('.esc_url($cityhostel_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (cityhostel_is_on(cityhostel_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
					?> scheme_<?php echo esc_attr(cityhostel_is_inherit(cityhostel_get_theme_option('header_scheme')) 
													? cityhostel_get_theme_option('color_scheme') 
													: cityhostel_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($cityhostel_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (cityhostel_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	get_template_part( 'templates/header-single' );

?></header>