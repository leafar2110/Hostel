<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

$cityhostel_link = get_permalink();
$cityhostel_post_format = get_post_format();
$cityhostel_post_format = empty($cityhostel_post_format) ? 'standard' : str_replace('post-format-', '', $cityhostel_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_'.esc_attr($cityhostel_post_format) ); ?>><?php
	cityhostel_show_post_featured(array(
		'thumb_size' => cityhostel_get_thumb_size( 'big' ),
		'show_no_image' => true,
		'singular' => false
		)
	);
	?><div class="post_header entry-header"><?php
		if ( in_array(get_post_type(), array( 'post', 'attachment' ) ) ) {
			?><span class="post_date"><a href="<?php echo esc_url($cityhostel_link); ?>"><?php echo cityhostel_get_date(); ?></a></span><?php
		}
		?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url($cityhostel_link); ?>"><?php echo the_title(); ?></a></h6>
	</div>
</div>