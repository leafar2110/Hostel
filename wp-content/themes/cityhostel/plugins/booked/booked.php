<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('cityhostel_booked_theme_setup9')) {
	add_action( 'after_setup_theme', 'cityhostel_booked_theme_setup9', 9 );
	function cityhostel_booked_theme_setup9() {
		if (cityhostel_exists_booked()) {
			add_action( 'wp_enqueue_scripts', 							'cityhostel_booked_frontend_scripts', 1100 );
			add_filter( 'cityhostel_filter_merge_styles',					'cityhostel_booked_merge_styles' );
			add_filter( 'cityhostel_filter_get_css',						'cityhostel_booked_get_css', 10, 4);
		}
		if (is_admin()) {
			add_filter( 'cityhostel_filter_tgmpa_required_plugins',		'cityhostel_booked_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'cityhostel_exists_booked' ) ) {
	function cityhostel_exists_booked() {
		return class_exists('booked_plugin');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'cityhostel_booked_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('cityhostel_filter_tgmpa_required_plugins',	'cityhostel_booked_tgmpa_required_plugins');
	function cityhostel_booked_tgmpa_required_plugins($list=array()) {
		if (in_array('booked', cityhostel_storage_get('required_plugins'))) {
			$path = cityhostel_get_file_dir('plugins/booked/booked.zip');
			$list[] = array(
					'name' 		=> esc_html__('Booked Appointments', 'cityhostel'),
					'slug' 		=> 'booked',
					'source' 	=> !empty($path) ? $path : 'upload://booked.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'cityhostel_booked_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'cityhostel_booked_frontend_scripts', 1100 );
	function cityhostel_booked_frontend_scripts() {
		if (cityhostel_is_on(cityhostel_get_theme_option('debug_mode')) && cityhostel_get_file_dir('plugins/booked/booked.css')!='')
			wp_enqueue_style( 'cityhostel-booked',  cityhostel_get_file_url('plugins/booked/booked.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'cityhostel_booked_merge_styles' ) ) {
	//Handler of the add_filter('cityhostel_filter_merge_styles', 'cityhostel_booked_merge_styles');
	function cityhostel_booked_merge_styles($list) {
		$list[] = 'plugins/booked/booked.css';
		return $list;
	}
}


// Add plugin-specific rules into custom CSS
//------------------------------------------------------------------------

// Add css styles into global CSS stylesheet
if (!function_exists('cityhostel_booked_get_css')) {
	//Handler of the add_filter('cityhostel_filter_get_css', 'cityhostel_booked_get_css', 10, 4);
	function cityhostel_booked_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
body #booked-profile-page input[type="submit"],
body #booked-profile-page button,
body .booked-list-view input[type="submit"],
body .booked-list-view button,
body table.booked-calendar input[type="submit"],
body table.booked-calendar button,
body .booked-modal input[type="submit"],
body .booked-modal button {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}

CSS;
		}
		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Calendar */
.booked-calendar-wrap .booked-appt-list h2 {
	color: {$colors['text_dark']};
}
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-title {
	color: {$colors['text_link']};
}
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time {
	color: {$colors['text_dark']};
}
.booked-calendar-wrap .booked-appt-list .timeslot .spots-available {
	color: {$colors['text']};
}

/* Form fields */
#booked-page-form {
	color: {$colors['text']};
	border-color: {$colors['bd_color']};
}
#booked-page-form input[type="email"],
#booked-page-form input[type="text"],
#booked-page-form input[type="password"],
#booked-page-form textarea,
.booked-upload-wrap,
.booked-upload-wrap input {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}
#booked-page-form input[type="email"]:focus,
#booked-page-form input[type="text"]:focus,
#booked-page-form input[type="password"]:focus,
#booked-page-form textarea:focus,
.booked-upload-wrap:hover,
.booked-upload-wrap input:focus {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
	background-color: {$colors['input_bg_hover']};
}

#booked-profile-page .booked-profile-header {
	background-color: {$colors['bg_color']} !important;
	border-color: transparent !important;
	color: {$colors['text']};
}
#booked-profile-page .booked-user h3 {
	color: {$colors['text_dark']};
}
#booked-profile-page .booked-profile-header .booked-logout-button:hover {
	color: {$colors['text_link']};
}


#booked-profile-page .booked-tabs li a {
	background-color: {$colors['alter_bg_hover']};
	color: {$colors['alter_dark']};
}
#booked-profile-page .booked-tab-content {
	background-color: {$colors['bg_color']};
	border-color: {$colors['alter_bd_color']};
}

CSS;
		}

		return $css;
	}
}
?>