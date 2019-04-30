<?php
/**
 * The template to displaying popup with Theme Icons
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

$cityhostel_icons = cityhostel_get_list_icons();
if (is_array($cityhostel_icons)) {
	?>
	<div class="cityhostel_list_icons">
		<?php
		foreach($cityhostel_icons as $icon) {
			?><span class="<?php echo esc_attr($icon); ?>" title="<?php echo esc_attr($icon); ?>"></span><?php
		}
		?>
	</div>
	<?php
}
?>