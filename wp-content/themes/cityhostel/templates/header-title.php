<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

// Page (category, tag, archive, author) title

if ( cityhostel_need_page_title() ) {
	cityhostel_sc_layouts_showed('title', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title">
						<?php
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$cityhostel_blog_title = cityhostel_get_blog_title();
							$cityhostel_blog_title_text = $cityhostel_blog_title_class = $cityhostel_blog_title_link = $cityhostel_blog_title_link_text = '';
							if (is_array($cityhostel_blog_title)) {
								$cityhostel_blog_title_text = $cityhostel_blog_title['text'];
								$cityhostel_blog_title_class = !empty($cityhostel_blog_title['class']) ? ' '.$cityhostel_blog_title['class'] : '';
								$cityhostel_blog_title_link = !empty($cityhostel_blog_title['link']) ? $cityhostel_blog_title['link'] : '';
								$cityhostel_blog_title_link_text = !empty($cityhostel_blog_title['link_text']) ? $cityhostel_blog_title['link_text'] : '';
							} else
								$cityhostel_blog_title_text = $cityhostel_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($cityhostel_blog_title_class); ?>"><?php
								$cityhostel_top_icon = cityhostel_get_category_icon();
								if (!empty($cityhostel_top_icon)) {
									$cityhostel_attr = cityhostel_getimagesize($cityhostel_top_icon);
									?><img src="<?php echo esc_url($cityhostel_top_icon); ?>" alt="<?php echo esc_html(basename($cityhostel_top_icon)); ?>" <?php if (!empty($cityhostel_attr[3])) cityhostel_show_layout($cityhostel_attr[3]);?>><?php
								}
								echo wp_kses_data($cityhostel_blog_title_text);
							?></h1>
							<?php
							if (!empty($cityhostel_blog_title_link) && !empty($cityhostel_blog_title_link_text)) {
								?><a href="<?php echo esc_url($cityhostel_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($cityhostel_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'cityhostel_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>