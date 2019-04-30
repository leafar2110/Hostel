<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

$cityhostel_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$cityhostel_post_format = get_post_format();
$cityhostel_post_format = empty($cityhostel_post_format) ? 'standard' : str_replace('post-format-', '', $cityhostel_post_format);
$cityhostel_animation = cityhostel_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($cityhostel_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($cityhostel_post_format) ); ?>
	<?php echo (!cityhostel_is_off($cityhostel_animation) ? ' data-animation="'.esc_attr(cityhostel_get_animation_classes($cityhostel_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	cityhostel_show_post_featured(array(
		'thumb_size' => cityhostel_get_thumb_size($cityhostel_columns==1 ? 'big' : ($cityhostel_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($cityhostel_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
			// Post meta
			cityhostel_show_post_meta();
			?>
		</div><!-- .entry-header -->
		<?php
	}
    // Post content area
    ?><div class="post_content_inner"><?php
            if (has_excerpt()) {
                the_excerpt();
            } else if (strpos(get_the_content('!--more'), '!--more')!==false) {
                the_content( '' );
            } else if (in_array($cityhostel_post_format, array('link', 'aside', 'status', 'quote'))) {
                the_content();
            } else if (substr(get_the_content(), 0, 1)!='[') {
                the_excerpt();
            }
            ?></div><?php
        ?>
</article></div>