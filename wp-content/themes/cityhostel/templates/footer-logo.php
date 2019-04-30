<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0.10
 */

// Logo
if (cityhostel_is_on(cityhostel_get_theme_option('logo_in_footer'))) {
	$cityhostel_logo_image = '';
	if (cityhostel_get_retina_multiplier(2) > 1)
		$cityhostel_logo_image = cityhostel_get_theme_option( 'logo_footer_retina' );
	if (empty($cityhostel_logo_image)) 
		$cityhostel_logo_image = cityhostel_get_theme_option( 'logo_footer' );
	$cityhostel_logo_text   = get_bloginfo( 'name' );
	if (!empty($cityhostel_logo_image) || !empty($cityhostel_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($cityhostel_logo_image)) {
					$cityhostel_attr = cityhostel_getimagesize($cityhostel_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($cityhostel_logo_image).'" class="logo_footer_image" alt="'.esc_html(basename($cityhostel_logo_image)).'"'.(!empty($cityhostel_attr[3]) ? sprintf(' %s', $cityhostel_attr[3]) : '').'></a>' ;
				} else if (!empty($cityhostel_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($cityhostel_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>