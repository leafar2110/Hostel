<?php
/* Visual Composer support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('cityhostel_vc_theme_setup9')) {
	add_action( 'after_setup_theme', 'cityhostel_vc_theme_setup9', 9 );
	function cityhostel_vc_theme_setup9() {
		if (cityhostel_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'cityhostel_vc_frontend_scripts', 1100 );
			add_filter( 'cityhostel_filter_merge_styles',						'cityhostel_vc_merge_styles' );
			add_filter( 'cityhostel_filter_merge_scripts',						'cityhostel_vc_merge_scripts' );
			add_filter( 'cityhostel_filter_get_css',							'cityhostel_vc_get_css', 10, 4 );
	
			// Add/Remove params in the standard VC shortcodes
			//-----------------------------------------------------
			add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,					'cityhostel_vc_add_params_classes', 10, 3 );
			
			// Color scheme
			$scheme = array(
				"param_name" => "scheme",
				"heading" => esc_html__("Color scheme", 'cityhostel'),
				"description" => wp_kses_data( __("Select color scheme to decorate this block", 'cityhostel') ),
				"group" => esc_html__('Colors', 'cityhostel'),
				"admin_label" => true,
				"value" => array_flip(cityhostel_get_list_schemes(true)),
				"type" => "dropdown"
			);
			vc_add_param("vc_row", $scheme);
			vc_add_param("vc_row_inner", $scheme);
			vc_add_param("vc_column", $scheme);
			vc_add_param("vc_column_inner", $scheme);
			vc_add_param("vc_column_text", $scheme);
			
			// Alter height and hide on mobile for Empty Space
			vc_add_param("vc_empty_space", array(
				"param_name" => "alter_height",
				"heading" => esc_html__("Alter height", 'cityhostel'),
				"description" => wp_kses_data( __("Select alternative height instead value from the field above", 'cityhostel') ),
				"admin_label" => true,
				"value" => array(
					esc_html__('Tiny', 'cityhostel') => 'tiny',
					esc_html__('Small', 'cityhostel') => 'small',
					esc_html__('Medium', 'cityhostel') => 'medium',
					esc_html__('Large', 'cityhostel') => 'large',
					esc_html__('Huge', 'cityhostel') => 'huge',
					esc_html__('From the value above', 'cityhostel') => 'none'
				),
				"type" => "dropdown"
			));
			vc_add_param("vc_empty_space", array(
				"param_name" => "hide_on_mobile",
				"heading" => esc_html__("Hide on mobile", 'cityhostel'),
				"description" => wp_kses_data( __("Hide this block on the mobile devices, when the columns are arranged one under another", 'cityhostel') ),
				"admin_label" => true,
				"std" => 0,
				"value" => array(
					esc_html__("Hide on mobile", 'cityhostel') => "1",
					esc_html__("Hide on notebook", 'cityhostel') => "2" 
					),
				"type" => "checkbox"
			));
			
			// Add Narrow style to the Progress bars
			vc_add_param("vc_progress_bar", array(
				"param_name" => "narrow",
				"heading" => esc_html__("Narrow", 'cityhostel'),
				"description" => wp_kses_data( __("Use narrow style for the progress bar", 'cityhostel') ),
				"std" => 0,
				"value" => array(esc_html__("Narrow style", 'cityhostel') => "1" ),
				"type" => "checkbox"
			));
			
			// Add param 'Closeable' to the Message Box
			vc_add_param("vc_message", array(
				"param_name" => "closeable",
				"heading" => esc_html__("Closeable", 'cityhostel'),
				"description" => wp_kses_data( __("Add 'Close' button to the message box", 'cityhostel') ),
				"std" => 0,
				"value" => array(esc_html__("Closeable", 'cityhostel') => "1" ),
				"type" => "checkbox"
			));
		}
		if (is_admin()) {
			add_filter( 'cityhostel_filter_tgmpa_required_plugins',		'cityhostel_vc_tgmpa_required_plugins' );
			add_filter( 'vc_iconpicker-type-fontawesome',				'cityhostel_vc_iconpicker_type_fontawesome' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'cityhostel_vc_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('cityhostel_filter_tgmpa_required_plugins',	'cityhostel_vc_tgmpa_required_plugins');
	function cityhostel_vc_tgmpa_required_plugins($list=array()) {
		if (in_array('js_composer', cityhostel_storage_get('required_plugins'))) {
			$path = cityhostel_get_file_dir('plugins/js_composer/js_composer.zip');
			$list[] = array(
					'name' 		=> esc_html__('Visual Composer', 'cityhostel'),
					'slug' 		=> 'js_composer',
					'source'	=> !empty($path) ? $path : 'upload://js_composer.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if Visual Composer installed and activated
if ( !function_exists( 'cityhostel_exists_visual_composer' ) ) {
	function cityhostel_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if Visual Composer in frontend editor mode
if ( !function_exists( 'cityhostel_vc_is_frontend' ) ) {
	function cityhostel_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
		//return function_exists('vc_is_frontend_editor') && vc_is_frontend_editor();
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'cityhostel_vc_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'cityhostel_vc_frontend_scripts', 1100 );
	function cityhostel_vc_frontend_scripts() {
		if (cityhostel_exists_visual_composer()) {
			if (cityhostel_is_on(cityhostel_get_theme_option('debug_mode')) && cityhostel_get_file_dir('plugins/js_composer/js_composer.css')!='')
				wp_enqueue_style( 'cityhostel-js_composer',  cityhostel_get_file_url('plugins/js_composer/js_composer.css'), array(), null );
			if (cityhostel_is_on(cityhostel_get_theme_option('debug_mode')) && cityhostel_get_file_dir('plugins/js_composer/js_composer.js')!='')
				wp_enqueue_script( 'cityhostel-js_composer', cityhostel_get_file_url('plugins/js_composer/js_composer.js'), array('jquery'), null, true );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'cityhostel_vc_merge_styles' ) ) {
	//Handler of the add_filter('cityhostel_filter_merge_styles', 'cityhostel_vc_merge_styles');
	function cityhostel_vc_merge_styles($list) {
		$list[] = 'plugins/js_composer/js_composer.css';
		return $list;
	}
}
	
// Merge custom scripts
if ( !function_exists( 'cityhostel_vc_merge_scripts' ) ) {
	//Handler of the add_filter('cityhostel_filter_merge_scripts', 'cityhostel_vc_merge_scripts');
	function cityhostel_vc_merge_scripts($list) {
		$list[] = 'plugins/js_composer/js_composer.js';
		return $list;
	}
}
	
// Add theme icons into VC iconpicker list
if ( !function_exists( 'cityhostel_vc_iconpicker_type_fontawesome' ) ) {
	//Handler of the add_filter( 'vc_iconpicker-type-fontawesome',	'cityhostel_vc_iconpicker_type_fontawesome' );
	function cityhostel_vc_iconpicker_type_fontawesome($icons) {
		$list = cityhostel_get_list_icons();
		if (!is_array($list) || count($list) == 0) return $icons;
		$rez = array();
		foreach ($list as $icon)
			$rez[] = array($icon => str_replace('icon-', '', $icon));
		return array_merge( $icons, array(esc_html__('Theme Icons', 'cityhostel') => $rez) );
	}
}



// Shortcodes
//------------------------------------------------------------------------

// Add params to the standard VC shortcodes
if ( !function_exists( 'cityhostel_vc_add_params_classes' ) ) {
	//Handler of the add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'cityhostel_vc_add_params_classes', 10, 3 );
	function cityhostel_vc_add_params_classes($classes, $sc, $atts) {
		if (in_array($sc, array('vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text'))) {
			if (!empty($atts['scheme']) && !cityhostel_is_inherit($atts['scheme']))
				$classes .= ($classes ? ' ' : '') . 'scheme_' . $atts['scheme'];
		} else if (in_array($sc, array('vc_empty_space'))) {
			if (!empty($atts['alter_height']) && !cityhostel_is_off($atts['alter_height']))
				$classes .= ($classes ? ' ' : '') . 'height_' . $atts['alter_height'];
			if (!empty($atts['hide_on_mobile'])) {
				if (strpos($atts['hide_on_mobile'], '1')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_mobile';
				if (strpos($atts['hide_on_mobile'], '2')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_notebook';
			}
		} else if (in_array($sc, array('vc_progress_bar'))) {
			if (!empty($atts['narrow']) && (int) $atts['narrow']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_progress_bar_narrow';
		} else if (in_array($sc, array('vc_message'))) {
			if (!empty($atts['closeable']) && (int) $atts['closeable']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_message_box_closeable';
		}
		return $classes;
	}
}


// Add VC specific styles into color scheme
//------------------------------------------------------------------------

// Add styles into CSS
if ( !function_exists( 'cityhostel_vc_get_css' ) ) {
	//Handler of the add_filter( 'cityhostel_filter_get_css', 'cityhostel_vc_get_css', 10, 4 );
	function cityhostel_vc_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
.sc_skills_counter .sc_skills_total,
.vc_message_box,
.sc_price_title,
.sc_price_price,
.sc_price_price_discount,
.comments_list_wrap .comment_info,
.comments_list_wrap .comment_reply,
.post_layout_classic .post_title,
.wpcf7 input,
.trx_addons_rounded_price,
.trx_addons_rounded_price_small,
.wpcf7 .select_container,
.sc_testimonials_item_author_title, .sc_testimonials_item_author_subtitle,
.wpcf7 .select_container select,
.sc_services_default .sc_services_item_title,
.trx_addons_price_money,
.trx_addons_score,
.vc_tta.vc_general .vc_tta-panel-title,
.footer_wrap .widget_title, .footer_wrap .widgettitle,
.footer_wrap .widget .post_item .post_info,
.sc_form_detailed .sc_form_info_area .sc_form_info_title,
.sc_form_info_item_phone .sc_form_info_area .sc_form_info_data span,
.vc_progress_bar .vc_single_bar .vc_label .vc_label_units,
.vc_progress_bar .vc_single_bar .vc_label,
.sc_skills_pie.sc_skills_compact_off .sc_skills_item_title,
.sc_skills_counter .sc_skills_item_title,
.sc_skills_pie.sc_skills_compact_off .sc_skills_total,
.vc_tta.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a,
.vc_tta.vc_tta-accordion .vc_tta-panel-title .vc_tta-title-text {
	{$fonts['menu_font-family']}
}

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Row and columns */
.scheme_self.wpb_row,
.scheme_self.wpb_column > .vc_column-inner > .wpb_wrapper,
.scheme_self.wpb_text_column {
	color: {$colors['text_dark']};
}
.scheme_self.vc_row.vc_parallax[class*="scheme_"] .vc_parallax-inner:before {
	background-color: {$colors['bg_color_08']};
}
.trx_addons_rounded_price_small,
.trx_addons_rounded_price {
    color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.trx_addons_rounded_price_small .trx_addons_rounded_money,
.trx_addons_rounded_price .trx_addons_rounded_money {
    color: {$colors['alter_link']};
}
/* Accordion */
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon {
	color: {$colors['text_dark']};
	background-color: {$colors['inverse_text']};
}
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:before,
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:after {
	border-color: {$colors['text_dark']};

}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title {
	background-color: {$colors['alter_link']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a {
	color: {$colors['text_dark']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover {
	color: {$colors['inverse_text']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title:hover {
    background-color: {$colors['text_dark']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover .vc_tta-controls-icon {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon:before,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon:after {
	border-color: {$colors['text_dark']};
}
.vc_tta-color-grey.vc_tta-style-classic.vc_tta-tabs .vc_tta-panels,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-body,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-body::after,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-body::before {
    background-color: {$colors['alter_bg_color']};
    border-color: {$colors['alter_bg_color']};
}

/* Tabs */
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a {
	color: {$colors['text_dark']} !important;
	background-color: {$colors['bg_color_0']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a:hover,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab.vc_active > a {
	color: {$colors['text_dark']};
	background-color: {$colors['alter_link']};
}
.vc_tta.vc_tta-style-classic .vc_tta-tabs-list {
	border-color: {$colors['alter_link']};
}

/* Separator */
.vc_separator.vc_sep_color_grey .vc_sep_line {
	border-color: {$colors['bd_color']};
}

/* Progress bar */
.vc_progress_bar .vc_single_bar {
	background-color: {$colors['alter_bg_color']};
}
.vc_progress_bar .vc_single_bar .vc_label {
	color: {$colors['text']};
}
.vc_progress_bar .vc_single_bar .vc_label .vc_label_units {
	color: {$colors['text']};
}

.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar {
	background-color: {$colors['alter_bg_color']};
}
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label {
	color: {$colors['text_dark']};
}
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label .vc_label_units {
	color: {$colors['text_dark']};
}
.vc_message_box.vc_message_box_closeable:after {
    background-color: {$colors['text_dark_01']};
}

.vc_color-grey.vc_message_box {
    background-color: {$colors['alter_bg_color']};
    color: {$colors['text_dark']};
}
.vc_color-grey.vc_message_box.vc_message_box_closeable:after,
.vc_color-grey.vc_message_box .vc_message_box-icon {
    color: {$colors['text_dark']};
}

.vc_color-warning.vc_message_box {
    background-color: {$colors['text_link']};
    color: {$colors['inverse_text']};
}
.vc_color-warning.vc_message_box.vc_message_box_closeable:after,
.vc_color-warning.vc_message_box .vc_message_box-icon {
    color: {$colors['inverse_text']};
}

.vc_color-info.vc_message_box {
    background-color: {$colors['alter_link']};
    color: {$colors['text_dark']};
}
.vc_color-info.vc_message_box.vc_message_box_closeable:after,
.vc_color-info.vc_message_box .vc_message_box-icon {
    color: {$colors['text_dark']};
}

.vc_color-success.vc_message_box {
    background-color: {$colors['alter_hover']};
    color: {$colors['inverse_text']};
}
.vc_color-success.vc_message_box.vc_message_box_closeable:after,
.vc_color-success.vc_message_box .vc_message_box-icon {
    color: {$colors['inverse_text']};
}

CSS;
		}
		
		return $css;
	}
}
?>