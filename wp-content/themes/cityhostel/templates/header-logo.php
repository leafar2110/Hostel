<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

$cityhostel_args = get_query_var('cityhostel_logo_args');

// Site logo
$cityhostel_logo_image  = cityhostel_get_logo_image(isset($cityhostel_args['type']) ? $cityhostel_args['type'] : '');
$cityhostel_logo_text   = cityhostel_is_on(cityhostel_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$cityhostel_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($cityhostel_logo_image) || !empty($cityhostel_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($cityhostel_logo_image)) {
			$cityhostel_attr = cityhostel_getimagesize($cityhostel_logo_image);
			echo '<img src="'.esc_url($cityhostel_logo_image).'" alt="'.esc_html(basename($cityhostel_logo_image)).'"'.(!empty($cityhostel_attr[3]) ? sprintf(' %s', $cityhostel_attr[3]) : '').'>' ;
		} else {
			cityhostel_show_layout(cityhostel_prepare_macros($cityhostel_logo_text), '<span class="logo_text">', '</span>');
			cityhostel_show_layout(cityhostel_prepare_macros($cityhostel_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>