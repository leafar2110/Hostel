<?php
/**
 * The style "default" of the Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_blogger');

if ($args['slider']) {
	?><div class="swiper-slide"><?php
} else if ($args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}

$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$post_link = get_permalink();
$post_title = get_the_title();

?><div id="post-<?php the_ID(); ?>"	<?php post_class( 'sc_blogger_item post_format_'.esc_attr($post_format) ); ?>><?php

	// Featured image
	set_query_var('trx_addons_args_featured', array(
		'class' => 'sc_blogger_item_featured',
		'hover' => 'zoomin',
		'thumb_size' => trx_addons_get_thumb_size('post')
	));
	if (($fdir = trx_addons_get_file_dir('templates/tpl.featured.php')) != '') { include $fdir; }
	
	// Post content
	?><div class="sc_blogger_item_content entry-content"><?php

		// Post title
		?><div class="sc_blogger_item_header entry-header"><?php
            // Post meta
            trx_addons_sc_show_post_meta('sc_blogger', array(
                    'date' => true
                )
            );
			// Post title
			the_title( sprintf( '<h5 class="sc_blogger_item_title entry-title"><a href="%s" rel="bookmark">', esc_url( $post_link ) ), '</a></h5>' );
			// Post meta
			trx_addons_sc_show_post_meta('sc_blogger', array(
				'counters' => 'comments,likes'
				)
			);
		?></div><!-- .entry-header --><?php
		
	?></div><!-- .entry-content --><?php
	
?></div><!-- .sc_blogger_item --><?php

if ($args['slider'] || $args['columns'] > 1) {
	?></div><?php
}
?>