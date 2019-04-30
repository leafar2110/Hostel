<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0.14
 */
$cityhostel_header_video = cityhostel_get_header_video();
if (!empty($cityhostel_header_video) && !cityhostel_is_from_uploads($cityhostel_header_video)) {
	global $wp_embed;
	if (is_object($wp_embed))
		$cityhostel_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($cityhostel_header_video) . '[/embed]' ));
	$cityhostel_embed_video = cityhostel_make_video_autoplay($cityhostel_embed_video);
	?><div id="background_video"><?php cityhostel_show_layout($cityhostel_embed_video); ?></div><?php
}
?>