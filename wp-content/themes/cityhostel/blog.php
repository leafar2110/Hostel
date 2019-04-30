<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the Visual Composer to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$cityhostel_content = '';
$cityhostel_blog_archive_mask = '%%CONTENT%%';
$cityhostel_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $cityhostel_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($cityhostel_content = apply_filters('the_content', get_the_content())) != '') {
		if (($cityhostel_pos = strpos($cityhostel_content, $cityhostel_blog_archive_mask)) !== false) {
			$cityhostel_content = preg_replace('/(\<p\>\s*)?'.$cityhostel_blog_archive_mask.'(\s*\<\/p\>)/i', $cityhostel_blog_archive_subst, $cityhostel_content);
		} else
			$cityhostel_content .= $cityhostel_blog_archive_subst;
		$cityhostel_content = explode($cityhostel_blog_archive_mask, $cityhostel_content);
	}
}

// Prepare args for a new query
$cityhostel_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$cityhostel_args = cityhostel_query_add_posts_and_cats($cityhostel_args, '', cityhostel_get_theme_option('post_type'), cityhostel_get_theme_option('parent_cat'));
$cityhostel_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($cityhostel_page_number > 1) {
	$cityhostel_args['paged'] = $cityhostel_page_number;
	$cityhostel_args['ignore_sticky_posts'] = true;
}
$cityhostel_ppp = cityhostel_get_theme_option('posts_per_page');
if ((int) $cityhostel_ppp != 0)
	$cityhostel_args['posts_per_page'] = (int) $cityhostel_ppp;
// Make a new query
query_posts( $cityhostel_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($cityhostel_content) && count($cityhostel_content) == 2) {
	set_query_var('blog_archive_start', $cityhostel_content[0]);
	set_query_var('blog_archive_end', $cityhostel_content[1]);
}

get_template_part('index');
?>