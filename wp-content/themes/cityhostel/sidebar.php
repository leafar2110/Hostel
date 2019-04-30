<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

$cityhostel_sidebar_position = cityhostel_get_theme_option('sidebar_position');
if (cityhostel_sidebar_present()) {
	ob_start();
	$cityhostel_sidebar_name = cityhostel_get_theme_option('sidebar_widgets');
	cityhostel_storage_set('current_sidebar', 'sidebar');
	if ( !dynamic_sidebar($cityhostel_sidebar_name) ) {
		// Put here html if user no set widgets in sidebar
	}
	$cityhostel_out = trim(ob_get_contents());
	ob_end_clean();
	if (trim(strip_tags($cityhostel_out)) != '') {
		?>
		<div class="sidebar <?php echo esc_attr($cityhostel_sidebar_position); ?> widget_area<?php if (!cityhostel_is_inherit(cityhostel_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(cityhostel_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'cityhostel_action_before_sidebar' );
				cityhostel_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $cityhostel_out));
				do_action( 'cityhostel_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>