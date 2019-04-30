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
$cityhostel_columns = empty($cityhostel_blog_style[1]) ? 1 : max(1, $cityhostel_blog_style[1]);
$cityhostel_expanded = !cityhostel_sidebar_present() && cityhostel_is_on(cityhostel_get_theme_option('expand_content'));
$cityhostel_post_format = get_post_format();
$cityhostel_post_format = empty($cityhostel_post_format) ? 'standard' : str_replace('post-format-', '', $cityhostel_post_format);
$cityhostel_animation = cityhostel_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($cityhostel_columns).' post_format_'.esc_attr($cityhostel_post_format) ); ?>
	<?php echo (!cityhostel_is_off($cityhostel_animation) ? ' data-animation="'.esc_attr(cityhostel_get_animation_classes($cityhostel_animation)).'"' : ''); ?>
	>

	<?php
	// Add anchor
	if ($cityhostel_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Featured image
	cityhostel_show_post_featured( array(
											'class' => $cityhostel_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => cityhostel_get_thumb_size(
																	strpos(cityhostel_get_theme_option('body_style'), 'full')!==false
																		? ( $cityhostel_columns > 1 ? 'huge' : 'original' )
																		: (	$cityhostel_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('cityhostel_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('cityhostel_action_before_post_meta'); 

			// Post meta
			$cityhostel_post_meta = cityhostel_show_post_meta(array(
									'categories' => false,
									'date' => true,
									'edit' => false,
									'seo' => false,
									'share' => false,
									'counters' => false,
									'echo' => false
									)
								);
			cityhostel_show_layout($cityhostel_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$cityhostel_show_learn_more = !in_array($cityhostel_post_format, array('link', 'aside', 'status', 'quote'));
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
				cityhostel_show_layout($cityhostel_post_meta);
			}
			// More button
			if ( $cityhostel_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'cityhostel'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>