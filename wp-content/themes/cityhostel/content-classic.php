<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

$cityhostel_blog_style = explode('_', cityhostel_get_theme_option('blog_style'));
$cityhostel_columns = empty($cityhostel_blog_style[1]) ? 2 : max(2, $cityhostel_blog_style[1]);
$cityhostel_expanded = !cityhostel_sidebar_present() && cityhostel_is_on(cityhostel_get_theme_option('expand_content'));
$cityhostel_post_format = get_post_format();
$cityhostel_post_format = empty($cityhostel_post_format) ? 'standard' : str_replace('post-format-', '', $cityhostel_post_format);
$cityhostel_animation = cityhostel_get_theme_option('blog_animation');

?><div class="<?php echo esc_attr($cityhostel_blog_style[0]) == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($cityhostel_columns); ?>"><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'post_item post_format_'.esc_attr($cityhostel_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($cityhostel_columns)
					. ' post_layout_'.esc_attr($cityhostel_blog_style[0]) 
					. ' post_layout_'.esc_attr($cityhostel_blog_style[0]).'_'.esc_attr($cityhostel_columns)
					); ?>
	<?php echo (!cityhostel_is_off($cityhostel_animation) ? ' data-animation="'.esc_attr(cityhostel_get_animation_classes($cityhostel_animation)).'"' : ''); ?>
	>

	<?php

	// Featured image
	cityhostel_show_post_featured( array( 'thumb_size' => cityhostel_get_thumb_size($cityhostel_blog_style[0] == 'classic'
													? (strpos(cityhostel_get_theme_option('body_style'), 'full')!==false 
															? ( $cityhostel_columns > 2 ? 'big' : 'huge' )
															: (	$cityhostel_columns > 2
																? ($cityhostel_expanded ? 'med' : 'small')
																: ($cityhostel_expanded ? 'big' : 'med')
																)
														)
													: (strpos(cityhostel_get_theme_option('body_style'), 'full')!==false 
															? ( $cityhostel_columns > 2 ? 'masonry-big' : 'full' )
															: (	$cityhostel_columns <= 2 && $cityhostel_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($cityhostel_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('cityhostel_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('cityhostel_action_before_post_meta'); 

			// Post meta
			cityhostel_show_post_meta(array(
				'categories' => false,
				'date' => true,
				'edit' => false,
				'seo' => false,
				'share' => false,
				'counters' => '',
				)
			);
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$cityhostel_show_learn_more = false; //!in_array($cityhostel_post_format, array('link', 'aside', 'status', 'quote'));
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($cityhostel_post_format, array('link', 'aside', 'status', 'quote'))) {
				the_content();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($cityhostel_post_format, array('link', 'aside', 'status', 'quote'))) {
			cityhostel_show_post_meta(array(
				'share' => false,
				'counters' => 'comments'
				)
			);
		}
		// More button
		if ( $cityhostel_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'cityhostel'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>