<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

$cityhostel_link = get_permalink();
$cityhostel_post_format = get_post_format();
$cityhostel_post_format = empty($cityhostel_post_format) ? 'standard' : str_replace('post-format-', '', $cityhostel_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($cityhostel_post_format) ); ?>><?php
	cityhostel_show_post_featured(array(
		'thumb_size' => cityhostel_get_thumb_size( 'big' ),
		'show_no_image' => true,
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">' . cityhostel_get_post_categories('') . '</div>'
							. '<h6 class="post_title entry-title"><a href="' . esc_url($cityhostel_link) . '">' . get_the_title() . '</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="' . esc_url($cityhostel_link) . '">' . cityhostel_get_date() . '</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>