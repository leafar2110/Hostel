<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('cityhostel_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'cityhostel_mailchimp_theme_setup9', 9 );
	function cityhostel_mailchimp_theme_setup9() {
		if (cityhostel_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'cityhostel_mailchimp_frontend_scripts', 1100 );
			add_filter( 'cityhostel_filter_merge_styles',					'cityhostel_mailchimp_merge_styles');
			add_filter( 'cityhostel_filter_get_css',						'cityhostel_mailchimp_get_css', 10, 4);
		}
		if (is_admin()) {
			add_filter( 'cityhostel_filter_tgmpa_required_plugins',		'cityhostel_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'cityhostel_exists_mailchimp' ) ) {
	function cityhostel_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'cityhostel_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('cityhostel_filter_tgmpa_required_plugins',	'cityhostel_mailchimp_tgmpa_required_plugins');
	function cityhostel_mailchimp_tgmpa_required_plugins($list=array()) {
		if (in_array('mailchimp-for-wp', cityhostel_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('MailChimp for WP', 'cityhostel'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		return $list;
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'cityhostel_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'cityhostel_mailchimp_frontend_scripts', 1100 );
	function cityhostel_mailchimp_frontend_scripts() {
		if (cityhostel_exists_mailchimp()) {
			if (cityhostel_is_on(cityhostel_get_theme_option('debug_mode')) && cityhostel_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')!='')
				wp_enqueue_style( 'cityhostel-mailchimp-for-wp',  cityhostel_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'cityhostel_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'cityhostel_filter_merge_styles', 'cityhostel_mailchimp_merge_styles');
	function cityhostel_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}

// Add css styles into global CSS stylesheet
if (!function_exists('cityhostel_mailchimp_get_css')) {
	//Handler of the add_filter('cityhostel_filter_get_css', 'cityhostel_mailchimp_get_css', 10, 4);
	function cityhostel_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = cityhostel_get_border_radius();
			$css['fonts'] .= <<<CSS

.mc4wp-form .mc4wp-form-fields input[type="email"],
.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$rad};
	   -moz-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS


.mc4wp-form input[type="submit"] {
	color: {$colors['inverse_link']};
	background-color: {$colors['alter_link']};
}
.mc4wp-form input[type="submit"]:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['alter_link_blend']};
}
.vc_row-has-fill .wpcf7 .select_container:before,
.vc_row-has-fill .wpcf7 .select_container,
.vc_row-has-fill .wpcf7 input {
    background-color: {$colors['bg_color']};
    border-color: {$colors['bg_color']};
}
.vc_row-has-fill .wpcf7 .select_container:hover,
.vc_row-has-fill .wpcf7 input:hover,
 .vc_row-has-fill .wpcf7 .select_container:focus,
.vc_row-has-fill .wpcf7 input:focus{
    border-color: {$colors['alter_link']};
}

.vc_row-has-fill div.wpcf7-response-output {
    color: {$colors['alter_link']};
}

CSS;
		}

		return $css;
	}
}
?>