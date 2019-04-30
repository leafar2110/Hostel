<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0.10
 */

$cityhostel_footer_scheme =  cityhostel_is_inherit(cityhostel_get_theme_option('footer_scheme')) ? cityhostel_get_theme_option('color_scheme') : cityhostel_get_theme_option('footer_scheme');
$cityhostel_footer_id = str_replace('footer-custom-', '', cityhostel_get_theme_option("footer_style"));
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($cityhostel_footer_id); ?> scheme_<?php echo esc_attr($cityhostel_footer_scheme); ?>">
	<?php
    // Custom footer's layout
    do_action('cityhostel_action_show_layout', $cityhostel_footer_id);
	?>
</footer><!-- /.footer_wrap -->
