<?php
/* Theme-specific action to configure ThemeREX Addons components
------------------------------------------------------------------------------- */


/* ThemeREX Addons components
------------------------------------------------------------------------------- */

if (!function_exists('cityhostel_trx_addons_theme_specific_setup1')) {
	add_action( 'after_setup_theme', 'cityhostel_trx_addons_theme_specific_setup1', 1 );
	add_action( 'trx_addons_action_save_options', 'cityhostel_trx_addons_theme_specific_setup1', 8 );
	function cityhostel_trx_addons_theme_specific_setup1() {
		if (cityhostel_exists_trx_addons()) {
			add_filter( 'trx_addons_cv_enable',				'cityhostel_trx_addons_cv_enable');
			add_filter( 'trx_addons_cpt_list',				'cityhostel_trx_addons_cpt_list');
			add_filter( 'trx_addons_sc_list',				'cityhostel_trx_addons_sc_list');
			add_filter( 'trx_addons_widgets_list',			'cityhostel_trx_addons_widgets_list');

            //Add new atts to shortcode
            add_filter('trx_addons_sc_atts',     'cityhostel_specific_sc_atts', 10, 2);

            //Add new params
            add_filter('trx_addons_sc_map',      'cityhostel_specific_sc_add_map', 10, 2);
		}
	}
}

// CV
if ( !function_exists( 'cityhostel_trx_addons_cv_enable' ) ) {
	//Handler of the add_filter( 'trx_addons_cv_enable', 'cityhostel_trx_addons_cv_enable');
	function cityhostel_trx_addons_cv_enable($enable=false) {
		// To do: return false if theme not use CV functionality
		return false;
	}
}

// CPT
if ( !function_exists( 'cityhostel_trx_addons_cpt_list' ) ) {
	//Handler of the add_filter('trx_addons_cpt_list',	'cityhostel_trx_addons_cpt_list');
	function cityhostel_trx_addons_cpt_list($list=array()) {
		// To do: Enable/Disable CPT via add/remove it in the list

        unset($list['portfolio']);
        unset($list['resume']);
        unset($list['courses']);
        unset($list['dishes']);
        unset($list['certificates']);
		return $list;
	}
}

// Shortcodes
if ( !function_exists( 'cityhostel_trx_addons_sc_list' ) ) {
	//Handler of the add_filter('trx_addons_sc_list',	'cityhostel_trx_addons_sc_list');
	function cityhostel_trx_addons_sc_list($list=array()) {
		// To do: Add/Remove shortcodes into list
		// If you add new shortcode - in the theme's folder must exists /trx_addons/shortcodes/new_sc_name/new_sc_name.php


		return $list;
	}
}

// Widgets
if ( !function_exists( 'cityhostel_trx_addons_widgets_list' ) ) {
	//Handler of the add_filter('trx_addons_widgets_list',	'cityhostel_trx_addons_widgets_list');
	function cityhostel_trx_addons_widgets_list($list=array()) {
		// To do: Add/Remove widgets into list
		// If you add widget - in the theme's folder must exists /trx_addons/widgets/new_widget_name/new_widget_name.php
        unset($list['aboutme']);
        unset($list['banner']);
        unset($list['flickr']);
        unset($list['popular_posts']);
        unset($list['recent_news']);
        unset($list['twitter']);
		return $list;
	}
}


/* Add options in the Theme Options Customizer
------------------------------------------------------------------------------- */

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('cityhostel_trx_addons_theme_specific_setup3')) {
	add_action( 'after_setup_theme', 'cityhostel_trx_addons_theme_specific_setup3', 3 );
	function cityhostel_trx_addons_theme_specific_setup3() {
		
		// Section 'Courses' - settings to show 'Courses' blog archive and single posts
		if (cityhostel_exists_courses()) {
			cityhostel_storage_merge_array('options', '', array(
				'courses' => array(
					"title" => esc_html__('Courses', 'cityhostel'),
					"desc" => wp_kses_data( __('Select parameters to display the courses pages', 'cityhostel') ),
					"type" => "section"
					),
				'expand_content_courses' => array(
					"title" => esc_html__('Expand content', 'cityhostel'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'cityhostel') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'header_style_courses' => array(
					"title" => esc_html__('Header style', 'cityhostel'),
					"desc" => wp_kses_data( __('Select style to display the site header on the courses pages', 'cityhostel') ),
					"std" => 'inherit',
					"options" => cityhostel_get_list_header_styles(true),
					"type" => "select"
					),
				'header_position_courses' => array(
					"title" => esc_html__('Header position', 'cityhostel'),
					"desc" => wp_kses_data( __('Select position to display the site header on the courses pages', 'cityhostel') ),
					"std" => 'inherit',
					"options" => cityhostel_get_list_header_positions(true),
					"type" => "select"
					),
				'header_widgets_courses' => array(
					"title" => esc_html__('Header widgets', 'cityhostel'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the courses pages', 'cityhostel') ),
					"std" => 'hide',
					"options" => cityhostel_get_list_sidebars(true, true),
					"type" => "select"
					),
				'sidebar_widgets_courses' => array(
					"title" => esc_html__('Sidebar widgets', 'cityhostel'),
					"desc" => wp_kses_data( __('Select sidebar to show on the courses pages', 'cityhostel') ),
					"std" => 'courses_widgets',
					"options" => cityhostel_get_list_sidebars(true, true),
					"type" => "select"
					),
				'sidebar_position_courses' => array(
					"title" => esc_html__('Sidebar position', 'cityhostel'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the courses pages', 'cityhostel') ),
					"refresh" => false,
					"std" => 'left',
					"options" => cityhostel_get_list_sidebars_positions(true),
					"type" => "select"
					),
				'hide_sidebar_on_single_courses' => array(
					"title" => esc_html__('Hide sidebar on the single course', 'cityhostel'),
					"desc" => wp_kses_data( __("Hide sidebar on the single course's page", 'cityhostel') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'widgets_above_page_courses' => array(
					"title" => esc_html__('Widgets above the page', 'cityhostel'),
					"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'cityhostel') ),
					"std" => 'hide',
					"options" => cityhostel_get_list_sidebars(true, true),
					"type" => "select"
					),
				'widgets_above_content_courses' => array(
					"title" => esc_html__('Widgets above the content', 'cityhostel'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'cityhostel') ),
					"std" => 'hide',
					"options" => cityhostel_get_list_sidebars(true, true),
					"type" => "select"
					),
				'widgets_below_content_courses' => array(
					"title" => esc_html__('Widgets below the content', 'cityhostel'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'cityhostel') ),
					"std" => 'hide',
					"options" => cityhostel_get_list_sidebars(true, true),
					"type" => "select"
					),
				'widgets_below_page_courses' => array(
					"title" => esc_html__('Widgets below the page', 'cityhostel'),
					"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'cityhostel') ),
					"std" => 'hide',
					"options" => cityhostel_get_list_sidebars(true, true),
					"type" => "select"
					),
				'footer_scheme_courses' => array(
					"title" => esc_html__('Footer Color Scheme', 'cityhostel'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'cityhostel') ),
					"std" => 'dark',
					"options" => cityhostel_get_list_schemes(true),
					"type" => "select"
					),
				'footer_widgets_courses' => array(
					"title" => esc_html__('Footer widgets', 'cityhostel'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'cityhostel') ),
					"std" => 'footer_widgets',
					"options" => cityhostel_get_list_sidebars(true, true),
					"type" => "select"
					),
				'footer_columns_courses' => array(
					"title" => esc_html__('Footer columns', 'cityhostel'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'cityhostel') ),
					"dependency" => array(
						'footer_widgets_courses' => array('^hide')
					),
					"std" => 0,
					"options" => cityhostel_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_courses' => array(
					"title" => esc_html__('Footer fullwide', 'cityhostel'),
					"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'cityhostel') ),
					"std" => 0,
					"type" => "checkbox"
					)
				)
			);
		}
	}
}

// Add mobile menu to the plugin's cached menu list
if ( !function_exists( 'cityhostel_trx_addons_menu_cache' ) ) {
	add_filter( 'trx_addons_filter_menu_cache', 'cityhostel_trx_addons_menu_cache');
	function cityhostel_trx_addons_menu_cache($list=array()) {
		if (in_array('#menu_main', $list)) $list[] = '#menu_mobile';
		return $list;
	}
}

// Add vars into localize array
if (!function_exists('cityhostel_trx_addons_localize_script')) {
	add_filter( 'cityhostel_filter_localize_script','cityhostel_trx_addons_localize_script' );
	function cityhostel_trx_addons_localize_script($arr) {
		$arr['alter_link_color'] = cityhostel_get_scheme_color('alter_link');
		return $arr;
	}
}


// Add theme-specific layouts to the list
if (!function_exists('cityhostel_trx_addons_theme_specific_default_layouts')) {
	add_filter( 'trx_addons_filter_default_layouts',	'cityhostel_trx_addons_theme_specific_default_layouts');
	function cityhostel_trx_addons_theme_specific_default_layouts($default_layouts=array()) {
		require_once 'trx_addons.layouts.php';
		return isset($layouts) && is_array($layouts) && count($layouts) > 0
						? array_merge($default_layouts, $layouts)
						: $default_layouts;
	}
}

// Disable override header image on team pages
if ( !function_exists( 'cityhostel_trx_addons_allow_override_header_image' ) ) {
	add_filter( 'cityhostel_filter_allow_override_header_image', 'cityhostel_trx_addons_allow_override_header_image' );
	function cityhostel_trx_addons_allow_override_header_image($allow) {
		return cityhostel_is_team_page() || cityhostel_is_portfolio_page() ? false : $allow;
	}
}

// Hide sidebar on the team pages
if ( !function_exists( 'cityhostel_trx_addons_sidebar_present' ) ) {
	add_filter( 'cityhostel_filter_sidebar_present', 'cityhostel_trx_addons_sidebar_present' );
	function cityhostel_trx_addons_sidebar_present($present) {
		return !is_single() && (cityhostel_is_team_page() || cityhostel_is_portfolio_page()) ? false : $present;
	}
}


// WP Editor addons
//------------------------------------------------------------------------

// Theme-specific configure of the WP Editor
if ( !function_exists( 'cityhostel_trx_addons_editor_init' ) ) {
	if (is_admin()) add_filter( 'tiny_mce_before_init', 'cityhostel_trx_addons_editor_init', 11);
	function cityhostel_trx_addons_editor_init($opt) {
		if (cityhostel_exists_trx_addons()) {
			// Add style 'Arrow' to the 'List styles'
			// Remove 'false &&' from condition below to add new style to the list
			if (!empty($opt['style_formats'])) {
				$style_formats = json_decode($opt['style_formats'], true);
				if (is_array($style_formats) && count($style_formats)>0 ) {
					foreach ($style_formats as $k=>$v) {
                        if ( $v['title'] == esc_html__('Inline', 'cityhostel') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Accent hovered', 'cityhostel'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_accent_hovered'
                            );
                        }
                        if ( $v['title'] == esc_html__('Inline', 'cityhostel') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Accent (yellow)', 'cityhostel'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_accent_yellow'
                            );
                        }
                        if ( $v['title'] == esc_html__('Inline', 'cityhostel') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Score value', 'cityhostel'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_score'
                            );
                        }
                        if ( $v['title'] == esc_html__('Inline', 'cityhostel') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Price text before money', 'cityhostel'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_price_text'
                            );
                        }
                        if ( $v['title'] == esc_html__('Inline', 'cityhostel') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Price text money', 'cityhostel'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_price_money'
                            );
                        }
                        if ( $v['title'] == esc_html__('Inline', 'cityhostel') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Big letter spacing', 'cityhostel'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_spacing'
                            );
                        }
                        if ( $v['title'] == esc_html__('Inline', 'cityhostel') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Rounded price', 'cityhostel'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_rounded_price'
                            );
                        }
                        if ( $v['title'] == esc_html__('Inline', 'cityhostel') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Rounded price (small)', 'cityhostel'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_rounded_price_small'
                            );
                        }
                        if ( $v['title'] == esc_html__('Inline', 'cityhostel') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Rounded price money value', 'cityhostel'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_rounded_money'
                            );
                        }
                        if ( $v['title'] == esc_html__('Inline', 'cityhostel') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Dropcap 3', 'cityhostel'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_dropcap trx_addons_dropcap_style_3'
                            );
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Dropcap 4', 'cityhostel'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_dropcap trx_addons_dropcap_style_4'
                            );
                        }
					}
					$opt['style_formats'] = json_encode( $style_formats );		
				}
			}
		}
		return $opt;
	}
}


// Theme-specific thumb sizes
//------------------------------------------------------------------------

// Replace thumb sizes to the theme-specific
if ( !function_exists( 'cityhostel_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'cityhostel_trx_addons_add_thumb_sizes');
	function cityhostel_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// Return theme-specific thumb size instead removed plugin's thumb size
if ( !function_exists( 'cityhostel_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'cityhostel_trx_addons_get_thumb_size');
	function cityhostel_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
                'trx_addons-thumb-posts',
                'trx_addons-thumb-posts-@retina',
                'trx_addons-thumb-price',
                'trx_addons-thumb-price-@retina',
                'trx_addons-thumb-post',
                'trx_addons-thumb-post-@retina',
                'trx_addons-thumb-team',
                'trx_addons-thumb-team-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'cityhostel-thumb-huge',
							'cityhostel-thumb-huge-@retina',
							'cityhostel-thumb-big',
							'cityhostel-thumb-big-@retina',
							'cityhostel-thumb-med',
							'cityhostel-thumb-med-@retina',
                                'cityhostel-thumb-posts',
                                'cityhostel-thumb-posts-@retina',
                                'cityhostel-thumb-price',
                                'cityhostel-thumb-price-@retina',
                                'cityhostel-thumb-post',
                                'cityhostel-thumb-post-@retina',
                                'cityhostel-thumb-team',
                                'cityhostel-thumb-team-@retina',
							'cityhostel-thumb-tiny',
							'cityhostel-thumb-tiny-@retina',
							'cityhostel-thumb-masonry-big',
							'cityhostel-thumb-masonry-big-@retina',
							'cityhostel-thumb-masonry',
							'cityhostel-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}

// Get thumb size for the team items
if ( !function_exists( 'cityhostel_trx_addons_team_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_team_thumb_size',	'cityhostel_trx_addons_team_thumb_size', 10, 2);
	function cityhostel_trx_addons_team_thumb_size($thumb_size='', $team_type='') {
		return $team_type == 'default' ? cityhostel_get_thumb_size('med') : $thumb_size;
	}
}



// Shortcodes support
//------------------------------------------------------------------------

// Return tag for the item's title
if ( !function_exists( 'cityhostel_trx_addons_sc_item_title_tag' ) ) {
	add_filter( 'trx_addons_filter_sc_item_title_tag', 'cityhostel_trx_addons_sc_item_title_tag');
	function cityhostel_trx_addons_sc_item_title_tag($tag='') {
		return $tag=='h1' ? 'h2' : $tag;
	}
}

// Return args for the item's button
if ( !function_exists( 'cityhostel_trx_addons_sc_item_button_args' ) ) {
	add_filter( 'trx_addons_filter_sc_item_button_args', 'cityhostel_trx_addons_sc_item_button_args');
	function cityhostel_trx_addons_sc_item_button_args($args, $sc='') {
		if (false && $sc != 'sc_button') {
			$args['type'] = 'simple';
			$args['icon_type'] = 'fontawesome';
			$args['icon_fontawesome'] = 'icon-down-big';
			$args['icon_position'] = 'top';
		}
		return $args;
	}
}

// Add new types in the shortcodes
if ( !function_exists( 'cityhostel_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'cityhostel_trx_addons_sc_type', 10, 2);
	function cityhostel_trx_addons_sc_type($list, $sc) {
        if (in_array($sc, array('trx_sc_button'))) {
            $list[ esc_html__('Bordered', 'cityhostel') ] = 'bordered';
        }
        if (in_array($sc, array('trx_sc_price'))) {
            $list[ esc_html__('Normal', 'cityhostel') ] = 'normal';
        }
		return $list;
	}
}

// Add new styles to the Google map
if ( !function_exists( 'cityhostel_trx_addons_sc_googlemap_styles' ) ) {
	add_filter( 'trx_addons_filter_sc_googlemap_styles',	'cityhostel_trx_addons_sc_googlemap_styles');
	function cityhostel_trx_addons_sc_googlemap_styles($list) {
		$list[esc_html__('Dark', 'cityhostel')] = 'dark';
        $list[esc_html__('Firm', 'cityhostel')] = 'firm';

		return $list;
	}
}

// Add params to the default shortcode's atts
if ( !function_exists( 'cityhostel_specific_sc_atts' ) ) {
    function cityhostel_specific_sc_atts($atts, $sc) {
        // Price period
        if ($sc == 'trx_sc_price')
            $atts['price_discount'] = '';
        if ($sc == 'trx_sc_form')
            $atts['form_contact'] = '';

        return $atts;
    }
}

// Add params to the shortcode
if ( !function_exists('cityhostel_specific_sc_add_map') ) {
    function cityhostel_specific_sc_add_map($params, $sc) {
        //Price period
        if (in_array($sc, array('trx_sc_price'))) {
            $params['params'][] = array(
                "param_name" => "price_discount",
                "heading" => esc_html__("Enter discount text", 'cityhostel'),
                "description" => wp_kses_data( __("Enter discount text to show on the picture", 'cityhostel') ),
                'type' => 'textfield'
            );
        }
        if (in_array($sc, array('trx_sc_form'))) {
            $params['params'][] = array(
                "param_name" => "form_contact",
                'dependency' => array(
                    'element' => 'type',
                    'value' => array('modern', 'detailed')
                ),
                "heading" => esc_html__("Show only contact info", 'cityhostel'),
                "description" => wp_kses_data( __("Show only contact info", 'cityhostel') ),
                "std" => 0,
                "value" => array(esc_html__("Show only contact info", 'cityhostel') => 1 ),
                "type" => "checkbox"
            );
        }
        return $params;
    }
}