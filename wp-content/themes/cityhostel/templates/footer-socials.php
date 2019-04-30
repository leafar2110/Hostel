<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0.10
 */


// Socials
if ( cityhostel_is_on(cityhostel_get_theme_option('socials_in_footer')) && ($cityhostel_output = cityhostel_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php cityhostel_show_layout($cityhostel_output); ?>
		</div>
	</div>
	<?php
}
?>