<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($cityhostel_columns).' post_format_'.esc_attr($cityhostel_post_format) ); ?>
	<?php echo (!cityhostel_is_off($cityhostel_animation) ? ' data-animation="'.esc_attr(cityhostel_get_animation_classes($cityhostel_animation)).'"' : ''); ?>
	>

	<?php
	$cityhostel_image_hover = cityhostel_get_theme_option('image_hover');
	// Featured image
	cityhostel_show_post_featured(array(
		'thumb_size' => cityhostel_get_thumb_size(strpos(cityhostel_get_theme_option('body_style'), 'full')!==false || $cityhostel_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $cityhostel_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $cityhostel_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>