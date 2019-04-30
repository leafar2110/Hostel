<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

$cityhostel_post_id    = get_the_ID();
$cityhostel_post_date  = cityhostel_get_date();
$cityhostel_post_title = get_the_title();
$cityhostel_post_link  = get_permalink();
$cityhostel_post_author_id   = get_the_author_meta('ID');
$cityhostel_post_author_name = get_the_author_meta('display_name');
$cityhostel_post_author_url  = get_author_posts_url($cityhostel_post_author_id, '');

$cityhostel_args = get_query_var('cityhostel_args_widgets_posts');
$cityhostel_show_date = isset($cityhostel_args['show_date']) ? (int) $cityhostel_args['show_date'] : 1;
$cityhostel_show_image = isset($cityhostel_args['show_image']) ? (int) $cityhostel_args['show_image'] : 1;
$cityhostel_show_author = isset($cityhostel_args['show_author']) ? (int) $cityhostel_args['show_author'] : 1;
$cityhostel_show_counters = isset($cityhostel_args['show_counters']) ? (int) $cityhostel_args['show_counters'] : 1;
$cityhostel_show_categories = isset($cityhostel_args['show_categories']) ? (int) $cityhostel_args['show_categories'] : 1;

$cityhostel_output = cityhostel_storage_get('cityhostel_output_widgets_posts');

$cityhostel_post_counters_output = '';
if ( $cityhostel_show_counters ) {
	$cityhostel_post_counters_output = '<span class="post_info_item post_info_counters">'
								. cityhostel_get_post_counters('comments')
							. '</span>';
}


$cityhostel_output .= '<article class="post_item with_thumb">';

if ($cityhostel_show_image) {
	$cityhostel_post_thumb = get_the_post_thumbnail($cityhostel_post_id, cityhostel_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($cityhostel_post_thumb) $cityhostel_output .= '<div class="post_thumb">' . ($cityhostel_post_link ? '<a href="' . esc_url($cityhostel_post_link) . '">' : '') . ($cityhostel_post_thumb) . ($cityhostel_post_link ? '</a>' : '') . '</div>';
}

$cityhostel_output .= '<div class="post_content">'
			. ($cityhostel_show_categories 
					? '<div class="post_categories">'
						. cityhostel_get_post_categories()
						. $cityhostel_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($cityhostel_post_link ? '<a href="' . esc_url($cityhostel_post_link) . '">' : '') . ($cityhostel_post_title) . ($cityhostel_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('cityhostel_filter_get_post_info', 
								'<div class="post_info">'
									. ($cityhostel_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($cityhostel_post_link ? '<a href="' . esc_url($cityhostel_post_link) . '" class="post_info_date">' : '') 
											. esc_html($cityhostel_post_date) 
											. ($cityhostel_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($cityhostel_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'cityhostel') . ' ' 
											. ($cityhostel_post_link ? '<a href="' . esc_url($cityhostel_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($cityhostel_post_author_name) 
											. ($cityhostel_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$cityhostel_show_categories && $cityhostel_post_counters_output
										? $cityhostel_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
cityhostel_storage_set('cityhostel_output_widgets_posts', $cityhostel_output);
?>