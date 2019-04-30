<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0.10
 */

// Footer menu
$cityhostel_menu_footer = cityhostel_get_nav_menu('menu_footer');
if (!empty($cityhostel_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php cityhostel_show_layout($cityhostel_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>