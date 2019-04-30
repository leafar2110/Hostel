<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0.10
 */

// Footer sidebar
$cityhostel_footer_name = cityhostel_get_theme_option('footer_widgets');
$cityhostel_footer_present = !cityhostel_is_off($cityhostel_footer_name) && is_active_sidebar($cityhostel_footer_name);
if ($cityhostel_footer_present) { 
	cityhostel_storage_set('current_sidebar', 'footer');
	$cityhostel_footer_wide = cityhostel_get_theme_option('footer_wide');
	ob_start();
	if ( !dynamic_sidebar($cityhostel_footer_name) ) {
		// Put here html if user no set widgets in sidebar
	}
	$cityhostel_out = trim(ob_get_contents());
	ob_end_clean();
	if (trim(strip_tags($cityhostel_out)) != '') {
		$cityhostel_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $cityhostel_out);
		$cityhostel_need_columns = true;	//or check: strpos($cityhostel_out, 'columns_wrap')===false;
		if ($cityhostel_need_columns) {
			$cityhostel_columns = max(0, (int) cityhostel_get_theme_option('footer_columns'));
			if ($cityhostel_columns == 0) $cityhostel_columns = min(6, max(1, substr_count($cityhostel_out, '<aside ')));
			if ($cityhostel_columns > 1)
				$cityhostel_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($cityhostel_columns).' widget ', $cityhostel_out);
			else
				$cityhostel_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($cityhostel_footer_wide) ? ' footer_fullwidth' : ''; ?>">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$cityhostel_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($cityhostel_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'cityhostel_action_before_sidebar' );
				cityhostel_show_layout($cityhostel_out);
				do_action( 'cityhostel_action_after_sidebar' );
				if ($cityhostel_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$cityhostel_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>