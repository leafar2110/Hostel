<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

cityhostel_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'classie', cityhostel_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'imagesloaded', cityhostel_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
wp_enqueue_script( 'masonry', cityhostel_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
wp_enqueue_script( 'cityhostel-gallery-script', cityhostel_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$cityhostel_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$cityhostel_sticky_out = is_array($cityhostel_stickies) && count($cityhostel_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$cityhostel_cat = cityhostel_get_theme_option('parent_cat');
	$cityhostel_post_type = cityhostel_get_theme_option('post_type');
	$cityhostel_taxonomy = cityhostel_get_post_type_taxonomy($cityhostel_post_type);
	$cityhostel_show_filters = cityhostel_get_theme_option('show_filters');
	$cityhostel_tabs = array();
	if (!cityhostel_is_off($cityhostel_show_filters)) {
		$cityhostel_args = array(
			'type'			=> $cityhostel_post_type,
			'child_of'		=> $cityhostel_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $cityhostel_taxonomy,
			'pad_counts'	=> false
		);
		$cityhostel_portfolio_list = get_terms($cityhostel_args);
		if (is_array($cityhostel_portfolio_list) && count($cityhostel_portfolio_list) > 0) {
			$cityhostel_tabs[$cityhostel_cat] = esc_html__('All', 'cityhostel');
			foreach ($cityhostel_portfolio_list as $cityhostel_term) {
				if (isset($cityhostel_term->term_id)) $cityhostel_tabs[$cityhostel_term->term_id] = $cityhostel_term->name;
			}
		}
	}
	if (count($cityhostel_tabs) > 0) {
		$cityhostel_portfolio_filters_ajax = true;
		$cityhostel_portfolio_filters_active = $cityhostel_cat;
		$cityhostel_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters cityhostel_tabs cityhostel_tabs_ajax">
			<ul class="portfolio_titles cityhostel_tabs_titles">
				<?php
				foreach ($cityhostel_tabs as $cityhostel_id=>$cityhostel_title) {
					?><li><a href="<?php echo esc_url(cityhostel_get_hash_link(sprintf('#%s_%s_content', $cityhostel_portfolio_filters_id, $cityhostel_id))); ?>" data-tab="<?php echo esc_attr($cityhostel_id); ?>"><?php echo esc_html($cityhostel_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$cityhostel_ppp = cityhostel_get_theme_option('posts_per_page');
			if (cityhostel_is_inherit($cityhostel_ppp)) $cityhostel_ppp = '';
			foreach ($cityhostel_tabs as $cityhostel_id=>$cityhostel_title) {
				$cityhostel_portfolio_need_content = $cityhostel_id==$cityhostel_portfolio_filters_active || !$cityhostel_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $cityhostel_portfolio_filters_id, $cityhostel_id)); ?>"
					class="portfolio_content cityhostel_tabs_content"
					data-blog-template="<?php echo esc_attr(cityhostel_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(cityhostel_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($cityhostel_ppp); ?>"
					data-post-type="<?php echo esc_attr($cityhostel_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($cityhostel_taxonomy); ?>"
					data-cat="<?php echo esc_attr($cityhostel_id); ?>"
					data-parent-cat="<?php echo esc_attr($cityhostel_cat); ?>"
					data-need-content="<?php echo (false===$cityhostel_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($cityhostel_portfolio_need_content) 
						cityhostel_show_portfolio_posts(array(
							'cat' => $cityhostel_id,
							'parent_cat' => $cityhostel_cat,
							'taxonomy' => $cityhostel_taxonomy,
							'post_type' => $cityhostel_post_type,
							'page' => 1,
							'sticky' => $cityhostel_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		cityhostel_show_portfolio_posts(array(
			'cat' => $cityhostel_cat,
			'parent_cat' => $cityhostel_cat,
			'taxonomy' => $cityhostel_taxonomy,
			'post_type' => $cityhostel_post_type,
			'page' => 1,
			'sticky' => $cityhostel_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>