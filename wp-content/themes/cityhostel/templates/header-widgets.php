<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

// Header sidebar
$cityhostel_header_name = cityhostel_get_theme_option('header_widgets');
$cityhostel_header_present = !cityhostel_is_off($cityhostel_header_name) && is_active_sidebar($cityhostel_header_name);
if ($cityhostel_header_present) { 
	cityhostel_storage_set('current_sidebar', 'header');
	$cityhostel_header_wide = cityhostel_get_theme_option('header_wide');
	ob_start();
	if ( !dynamic_sidebar($cityhostel_header_name) ) {
		// Put here html if user no set widgets in sidebar
	}
	$cityhostel_widgets_output = ob_get_contents();
	ob_end_clean();
	if (trim(strip_tags($cityhostel_widgets_output)) != '') {
		$cityhostel_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $cityhostel_widgets_output);
		$cityhostel_need_columns = strpos($cityhostel_widgets_output, 'columns_wrap')===false;
		if ($cityhostel_need_columns) {
			$cityhostel_columns = max(0, (int) cityhostel_get_theme_option('header_columns'));
			if ($cityhostel_columns == 0) $cityhostel_columns = min(6, max(1, substr_count($cityhostel_widgets_output, '<aside ')));
			if ($cityhostel_columns > 1)
				$cityhostel_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($cityhostel_columns).' widget ', $cityhostel_widgets_output);
			else
				$cityhostel_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($cityhostel_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$cityhostel_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($cityhostel_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'cityhostel_action_before_sidebar' );
				cityhostel_show_layout($cityhostel_widgets_output);
				do_action( 'cityhostel_action_after_sidebar' );
				if ($cityhostel_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$cityhostel_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>