<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

$cityhostel_blog_style = explode('_', cityhostel_get_theme_option('blog_style'));
$cityhostel_columns = empty($cityhostel_blog_style[1]) ? 2 : max(2, $cityhostel_blog_style[1]);
$cityhostel_post_format = get_post_format();
$cityhostel_post_format = empty($cityhostel_post_format) ? 'standard' : str_replace('post-format-', '', $cityhostel_post_format);
$cityhostel_animation = cityhostel_get_theme_option('blog_animation');
$cityhostel_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($cityhostel_columns).' post_format_'.esc_attr($cityhostel_post_format) ); ?>
	<?php echo (!cityhostel_is_off($cityhostel_animation) ? ' data-animation="'.esc_attr(cityhostel_get_animation_classes($cityhostel_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($cityhostel_image[1]) && !empty($cityhostel_image[2])) echo intval($cityhostel_image[1]) .'x' . intval($cityhostel_image[2]); ?>"
	data-src="<?php if (!empty($cityhostel_image[0])) echo esc_url($cityhostel_image[0]); ?>"
	>

	<?php
	$cityhostel_image_hover = 'icon';	//cityhostel_get_theme_option('image_hover');
	if (in_array($cityhostel_image_hover, array('icons', 'zoom'))) $cityhostel_image_hover = 'dots';
	// Featured image
	cityhostel_show_post_featured(array(
		'hover' => $cityhostel_image_hover,
		'thumb_size' => cityhostel_get_thumb_size( strpos(cityhostel_get_theme_option('body_style'), 'full')!==false || $cityhostel_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. cityhostel_show_post_meta(array(
									'categories' => true,
									'date' => true,
									'edit' => false,
									'seo' => false,
									'share' => true,
									'counters' => 'comments',
									'echo' => false
									))
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'cityhostel') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>