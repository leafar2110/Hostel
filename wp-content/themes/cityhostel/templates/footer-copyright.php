<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0.10
 */

// Copyright area
$cityhostel_footer_scheme =  cityhostel_is_inherit(cityhostel_get_theme_option('footer_scheme')) ? cityhostel_get_theme_option('color_scheme') : cityhostel_get_theme_option('footer_scheme');
$cityhostel_copyright_scheme = cityhostel_is_inherit(cityhostel_get_theme_option('copyright_scheme')) ? $cityhostel_footer_scheme : cityhostel_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($cityhostel_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and [[...]] on the <i>...</i> and <b>...</b>
				$cityhostel_copyright = cityhostel_prepare_macros(cityhostel_get_theme_option('copyright'));
				if (!empty($cityhostel_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $cityhostel_copyright, $cityhostel_matches)) {
						$cityhostel_copyright = str_replace($cityhostel_matches[1], date(str_replace(array('{', '}'), '', $cityhostel_matches[1])), $cityhostel_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($cityhostel_copyright));
				}
			?></div>
		</div>
	</div>
</div>
