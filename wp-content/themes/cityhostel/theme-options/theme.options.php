<?php
/**
 * Default Theme Options and Internal Theme Settings
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('cityhostel_options_theme_setup1') ) {
	add_action( 'after_setup_theme', 'cityhostel_options_theme_setup1', 1 );
	function cityhostel_options_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		cityhostel_storage_set('settings', array(
			
			'ajax_views_counter'		=> true,						// Use AJAX for increment posts counter (if cache plugins used) 
																		// or increment posts counter then loading page (without cache plugin)
			'disable_jquery_ui'			=> false,						// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'max_load_fonts'			=> 3,							// Max fonts number to load from Google fonts or from uploaded fonts
		
			'use_mediaelements'			=> true,						// Load script "Media Elements" to play video and audio
		
			'max_excerpt_length'		=> 60,							// Max words number for the excerpt in the blog style 'Excerpt'.
																		// For style 'Classic' - get half from this value
			'message_maxlength'			=> 1000							// Max length of the message from contact form
			
		));
		
		
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		cityhostel_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Droid Serif',
				'family' => 'serif',
				'styles' => '400,700'		// Parameter 'style' used only for the Google fonts
				),
            array(
                'name'	 => 'Oswald',
                'family' => 'san-serif',
                'styles' => '400,700'		// Parameter 'style' used only for the Google fonts
            ),
            array(
                'name'	 => 'Sansita One',
                'family' => 'serif',
                'styles' => '400'		// Parameter 'style' used only for the Google fonts
            ),

		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		cityhostel_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		cityhostel_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'cityhostel'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'cityhostel'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.715em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.7em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'cityhostel'),
				'font-family'		=> 'Sansita One, serif',
				'font-size' 		=> '7.143rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '0.95em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.1em',
				'margin-bottom'		=> '0.44em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'cityhostel'),
				'font-family'		=> 'Sansita One, serif',
				'font-size' 		=> '5.714rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.07em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.98em',
				'margin-bottom'		=> '0.56em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'cityhostel'),
				'font-family'		=> 'Sansita One, serif',
				'font-size' 		=> '4.286em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.09em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.16em',
				'margin-bottom'		=> '0.72em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'cityhostel'),
				'font-family'		=> 'Sansita One, serif',
				'font-size' 		=> '3.214em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.15em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0.6px',
				'margin-top'		=> '1.54em',
				'margin-bottom'		=> '0.53em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'cityhostel'),
				'font-family'		=> 'Oswald, sans-serif',
				'font-size' 		=> '1.429em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '-0.4px',
				'margin-top'		=> '2.25em',
				'margin-bottom'		=> '0.8em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'cityhostel'),
				'font-family'		=> 'Oswald, sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.85em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.7px',
				'margin-top'		=> '3em',
				'margin-bottom'		=> '1.75em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'cityhostel'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'cityhostel'),
				'font-family'		=> 'Sansita One, serif',
				'font-size' 		=> '1.786em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'cityhostel'),
				'font-family'		=> 'Oswald, sans-serif',
				'font-size' 		=> '12px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '2.2px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'cityhostel'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'cityhostel'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> 'normal',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'cityhostel'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'cityhostel'),
				'font-family'		=> 'Oswald, sans-serif',
				'font-size' 		=> '12px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '2.5px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'cityhostel'),
				'description'		=> esc_html__('Font settings of the main menu items', 'cityhostel'),
				'font-family'		=> 'Oswald, sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.7px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'cityhostel'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'cityhostel'),
				'font-family'		=> 'Oswald, sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		cityhostel_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'cityhostel'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#ffffff',   //
					'bd_color'				=> '#f0f0ef',   //
		
					// Text and links colors
					'text'					=> '#928f88',   //
					'text_light'			=> '#b7b7b7',
					'text_dark'				=> '#444349',   //
					'text_link'				=> '#fd7444',   //
					'text_hover'			=> '#fe7259',
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#f7f5f2',   //
					'alter_bg_hover'		=> '#fbfaf8',   //
					'alter_bd_color'		=> '#e5e4e1',   //
					'alter_bd_hover'		=> '#dadada',
					'alter_text'			=> '#cecdcb',   //
					'alter_light'			=> '#b7b7b7',
					'alter_dark'			=> '#3d3c3f',   //
					'alter_link'			=> '#ffdb74',   //
					'alter_hover'			=> '#8abb6a',   //
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#e7eaed',	//'rgba(221,225,229,0.3)',
					'input_bg_hover'		=> '#e7eaed',	//'rgba(221,225,229,0.3)',
					'input_bd_color'		=> '#e7eaed',	//'rgba(221,225,229,0.3)',
					'input_bd_hover'		=> '#e0e0e0',
					'input_text'			=> '#b7b7b7',
					'input_light'			=> '#e5e5e5',
					'input_dark'			=> '#1d1d1d',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#ffffff',   //
					'inverse_light'			=> '#333333',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',
					'inverse_hover'			=> '#1d1d1d',
		
					// Additional accented colors (if used in the current theme)
					// For example:
					//'accent2'				=> '#faef81'
				
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'cityhostel'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#0e0d12',
					'bd_color'				=> '#1c1b1f',
		
					// Text and links colors
					'text'					=> '#928f88',   //
					'text_light'			=> '#5f5f5f',
					'text_dark'				=> '#ffffff',   //
					'text_link'				=> '#fd7444',   //
					'text_hover'			=> '#ffaa5f',
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#3d3c3f',   //
					'alter_bg_hover'		=> '#28272e',
					'alter_bd_color'		=> '#313131',
					'alter_bd_hover'		=> '#3d3d3d',
					'alter_text'			=> '#a6a6a6',
					'alter_light'			=> '#5f5f5f',
					'alter_dark'			=> '#ffffff',
					'alter_link'			=> '#ffdb74',   //
					'alter_hover'			=> '#fe7259',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#2e2d32',	//'rgba(62,61,66,0.5)',
					'input_bg_hover'		=> '#2e2d32',	//'rgba(62,61,66,0.5)',
					'input_bd_color'		=> '#2e2d32',	//'rgba(62,61,66,0.5)',
					'input_bd_hover'		=> '#353535',
					'input_text'			=> '#000000',   //
					'input_light'			=> '#5f5f5f',
					'input_dark'			=> '#ffffff',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#444349',   //
					'inverse_light'			=> '#5f5f5f',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',
					'inverse_hover'			=> '#1d1d1d',
				
					// Additional accented colors (if used in the current theme)
					// For example:
					//'accent2'				=> '#ff6469'
		
				)
			)
		
		));
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('cityhostel_options_create')) {

	function cityhostel_options_create() {

		cityhostel_storage_set('options', array(
		
			// Section 'Title & Tagline' - add theme options in the standard WP section
			'title_tagline' => array(
				"title" => esc_html__('Title, Tagline & Site icon', 'cityhostel'),
				"desc" => wp_kses_data( __('Specify site title and tagline (if need) and upload the site icon', 'cityhostel') ),
				"type" => "section"
				),
		
		
			// Section 'Header' - add theme options in the standard WP section
			'header_image' => array(
				"title" => esc_html__('Header', 'cityhostel'),
				"desc" => wp_kses_data( __('Select or upload logo images, select header type and widgets set for the header', 'cityhostel') ),
				"type" => "section"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'cityhostel'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'cityhostel')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'cityhostel'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'cityhostel')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'cityhostel'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'cityhostel')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'header_style' => array(
				"title" => esc_html__('Header style', 'cityhostel'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'cityhostel')
				),
				"std" => 'header-default',
				"options" => cityhostel_get_list_header_styles(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'cityhostel'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'cityhostel')
				),
				"std" => 'default',
				"options" => cityhostel_get_list_header_positions(),
				"type" => "select"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'cityhostel'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'cityhostel'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'cityhostel') ),
				),
				"std" => 'hide',
				"options" => cityhostel_get_list_sidebars(false, true),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'cityhostel'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'cityhostel')
				),
				"dependency" => array(
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => cityhostel_get_list_range(0,6),
				"type" => "select"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'cityhostel'),
				"desc" => wp_kses_data( __('Select color scheme to decorate header area', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'cityhostel')
				),
				"std" => 'inherit',
				"options" => cityhostel_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'menu_info' => array(
				"title" => esc_html__('Menu settings', 'cityhostel'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'cityhostel') ),
				"type" => "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'cityhostel'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'cityhostel')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'cityhostel'),
					'left'	=> esc_html__('Left',	'cityhostel'),
					'right'	=> esc_html__('Right',	'cityhostel')
				),
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'cityhostel'),
				"desc" => wp_kses_data( __('Select color scheme to decorate main menu area', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'cityhostel')
				),
				"std" => 'inherit',
				"options" => cityhostel_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'cityhostel'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'cityhostel') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'cityhostel'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'cityhostel') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'cityhostel'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'cityhostel') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo settings', 'cityhostel'),
				"desc" => wp_kses_data( __('Select logo images for the normal and Retina displays', 'cityhostel') ),
				"type" => "info"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'cityhostel'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'cityhostel') ),
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'cityhostel'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'cityhostel') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse' => array(
				"title" => esc_html__('Logo inverse', 'cityhostel'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it on the dark background', 'cityhostel') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse_retina' => array(
				"title" => esc_html__('Logo inverse for Retina', 'cityhostel'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'cityhostel') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'cityhostel'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'cityhostel') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'cityhostel'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'cityhostel') ),
				"std" => '',
				"type" => "image"
				),
			'logo_text' => array(
				"title" => esc_html__('Logo from Site name', 'cityhostel'),
				"desc" => wp_kses_data( __('Do you want use Site name and description as Logo if images above are not selected?', 'cityhostel') ),
				"std" => 1,
				"type" => "checkbox"
				),
			
		
		
			// Section 'Content'
			'content' => array(
				"title" => esc_html__('Content', 'cityhostel'),
				"desc" => wp_kses_data( __('Options for the content area', 'cityhostel') ),
				"type" => "section",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'cityhostel'),
				"desc" => wp_kses_data( __('Select width of the body content', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'cityhostel')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'cityhostel'),
					'wide'		=> esc_html__('Wide',		'cityhostel'),
					'fullwide'	=> esc_html__('Fullwide',	'cityhostel'),
					'fullscreen'=> esc_html__('Fullscreen',	'cityhostel')
				),
				"type" => "select"
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'cityhostel'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site. Attention! Case "Inherit" can be used only for custom pages, not for root site content in the Appearance - Customize', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'cityhostel')
				),
				"std" => 'default',
				"options" => cityhostel_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'cityhostel'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'cityhostel') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'cityhostel')
				),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'cityhostel'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'cityhostel') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'cityhostel')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'cityhostel'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'cityhostel') ),
				"std" => 0,
				"type" => "checkbox"
				),
            'privacy_text' => array(
                "title" => esc_html__("Text with Privacy Policy link", 'cityhostel'),
                "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'cityhostel') ),
                "std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'cityhostel') ),
                "type"  => "text"
            ),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'cityhostel'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'cityhostel') ),
				"std" => 0,
				"type" => "text"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'cityhostel'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'cityhostel') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'cityhostel')
				),
				"std" => '',
				"type" => "image"
				),
			'no_image' => array(
				"title" => esc_html__('No image placeholder', 'cityhostel'),
				"desc" => wp_kses_data( __('Select or upload image, used as placeholder for the posts without featured image', 'cityhostel') ),
				"std" => '',
				"type" => "image"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'cityhostel'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'cityhostel') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'cityhostel')
				),
				"std" => 'hide',
				"options" => cityhostel_get_list_sidebars(false, true),
				"type" => "select"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'cityhostel'),
				"desc" => wp_kses_data( __('Select color scheme to decorate sidebar', 'cityhostel') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'cityhostel')
				),
				"std" => 'inherit',
				"options" => cityhostel_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'cityhostel'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'cityhostel') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'cityhostel')
				),
				"refresh" => false,
				"std" => 'right',
				"options" => cityhostel_get_list_sidebars_positions(),
				"type" => "select"
				),
			'hide_sidebar_on_single' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'cityhostel'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'cityhostel') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets above the page', 'cityhostel'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'cityhostel')
				),
				"std" => 'hide',
				"options" => cityhostel_get_list_sidebars(false, true),
				"type" => "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'cityhostel'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'cityhostel')
				),
				"std" => 'hide',
				"options" => cityhostel_get_list_sidebars(false, true),
				"type" => "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'cityhostel'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'cityhostel')
				),
				"std" => 'hide',
				"options" => cityhostel_get_list_sidebars(false, true),
				"type" => "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets below the page', 'cityhostel'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'cityhostel')
				),
				"std" => 'hide',
				"options" => cityhostel_get_list_sidebars(false, true),
				"type" => "select"
				),
		
		
		
			// Section 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'cityhostel'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number for the site footer', 'cityhostel') ),
				"type" => "section"
				),
			'footer_style' => array(
				"title" => esc_html__('Footer style', 'cityhostel'),
				"desc" => wp_kses_data( __('Select style to display the site footer', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Footer', 'cityhostel')
				),
				"std" => 'footer-default',
				"options" => apply_filters('cityhostel_filter_list_footer_styles', array(
					'footer-default' => esc_html__('Default Footer',	'cityhostel')
				)),
				"type" => "select"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'cityhostel'),
				"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'cityhostel') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'cityhostel')
				),
				"std" => '',
				"options" => cityhostel_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'cityhostel'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'cityhostel') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'cityhostel')
				),
				"std" => 'footer_widgets',
				"options" => cityhostel_get_list_sidebars(false, true),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'cityhostel'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'cityhostel') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'cityhostel')
				),
				"dependency" => array(
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => cityhostel_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'cityhostel'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'cityhostel') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'cityhostel')
				),
				"std" => 0,
				"type" => "hidden"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'cityhostel'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'cityhostel') ),
				'refresh' => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'cityhostel'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'cityhostel') ),
				"dependency" => array(
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'cityhostel'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'cityhostel') ),
				"dependency" => array(
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'cityhostel'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'cityhostel') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'cityhostel'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'cityhostel') ),
				"std" => esc_html__('AxiomThemes &copy; {Y}. All rights reserved.', 'cityhostel'),
				"refresh" => false,
				"type" => "textarea"
				),
		
		
		
			// Section 'Homepage' - settings for home page
			'homepage' => array(
				"title" => esc_html__('Homepage', 'cityhostel'),
				"desc" => wp_kses_data( __('Select blog style and widgets to display on the homepage', 'cityhostel') ),
				"type" => "section"
				),
			'expand_content_home' => array(
				"title" => esc_html__('Expand content', 'cityhostel'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the Homepage', 'cityhostel') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style_home' => array(
				"title" => esc_html__('Blog style', 'cityhostel'),
				"desc" => wp_kses_data( __('Select posts style for the homepage', 'cityhostel') ),
				"std" => 'excerpt',
				"options" => cityhostel_get_list_blog_styles(),
				"type" => "select"
				),
			'first_post_large_home' => array(
				"title" => esc_html__('First post large', 'cityhostel'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of the Homepage', 'cityhostel') ),
				"dependency" => array(
					'blog_style_home' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style_home' => array(
				"title" => esc_html__('Header style', 'cityhostel'),
				"desc" => wp_kses_data( __('Select style to display the site header on the homepage', 'cityhostel') ),
				"std" => 'inherit',
				"options" => cityhostel_get_list_header_styles(true),
				"type" => "select"
				),
			'header_position_home' => array(
				"title" => esc_html__('Header position', 'cityhostel'),
				"desc" => wp_kses_data( __('Select position to display the site header on the homepage', 'cityhostel') ),
				"std" => 'inherit',
				"options" => cityhostel_get_list_header_positions(true),
				"type" => "select"
				),
			'header_widgets_home' => array(
				"title" => esc_html__('Header widgets', 'cityhostel'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the homepage', 'cityhostel') ),
				"std" => 'header_widgets',
				"options" => cityhostel_get_list_sidebars(true, true),
				"type" => "select"
				),
			'sidebar_widgets_home' => array(
				"title" => esc_html__('Sidebar widgets', 'cityhostel'),
				"desc" => wp_kses_data( __('Select sidebar to show on the homepage', 'cityhostel') ),
				"std" => 'inherit',
				"options" => cityhostel_get_list_sidebars(true, true),
				"type" => "select"
				),
			'sidebar_position_home' => array(
				"title" => esc_html__('Sidebar position', 'cityhostel'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the homepage', 'cityhostel') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => cityhostel_get_list_sidebars_positions(true),
				"type" => "select"
				),
			'widgets_above_page_home' => array(
				"title" => esc_html__('Widgets above the page', 'cityhostel'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'cityhostel') ),
				"std" => 'hide',
				"options" => cityhostel_get_list_sidebars(true, true),
				"type" => "select"
				),
			'widgets_above_content_home' => array(
				"title" => esc_html__('Widgets above the content', 'cityhostel'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'cityhostel') ),
				"std" => 'hide',
				"options" => cityhostel_get_list_sidebars(true, true),
				"type" => "select"
				),
			'widgets_below_content_home' => array(
				"title" => esc_html__('Widgets below the content', 'cityhostel'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'cityhostel') ),
				"std" => 'hide',
				"options" => cityhostel_get_list_sidebars(true, true),
				"type" => "select"
				),
			'widgets_below_page_home' => array(
				"title" => esc_html__('Widgets below the page', 'cityhostel'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'cityhostel') ),
				"std" => 'hide',
				"options" => cityhostel_get_list_sidebars(true, true),
				"type" => "select"
				),
			
		
		
			// Section 'Blog archive'
			'blog' => array(
				"title" => esc_html__('Blog archive', 'cityhostel'),
				"desc" => wp_kses_data( __('Options for the blog archive', 'cityhostel') ),
				"type" => "section",
				),
			'expand_content_blog' => array(
				"title" => esc_html__('Expand content', 'cityhostel'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the blog archive', 'cityhostel') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style' => array(
				"title" => esc_html__('Blog style', 'cityhostel'),
				"desc" => wp_kses_data( __('Select posts style for the blog archive', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'cityhostel')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"std" => 'excerpt',
				"options" => cityhostel_get_list_blog_styles(),
				"type" => "select"
				),
			'blog_columns' => array(
				"title" => esc_html__('Blog columns', 'cityhostel'),
				"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'cityhostel') ),
				"std" => 2,
				"options" => cityhostel_get_list_range(2,4),
				"type" => "hidden"
				),
			'post_type' => array(
				"title" => esc_html__('Post type', 'cityhostel'),
				"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'cityhostel')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"linked" => 'parent_cat',
				"refresh" => false,
				"hidden" => true,
				"std" => 'post',
				"options" => cityhostel_get_list_posts_types(),
				"type" => "select"
				),
			'parent_cat' => array(
				"title" => esc_html__('Category to show', 'cityhostel'),
				"desc" => wp_kses_data( __('Select category to show in the blog archive', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'cityhostel')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"refresh" => false,
				"hidden" => true,
				"std" => '0',
				"options" => cityhostel_array_merge(array(0 => esc_html__('- Select category -', 'cityhostel')), cityhostel_get_list_categories()),
				"type" => "select"
				),
			'posts_per_page' => array(
				"title" => esc_html__('Posts per page', 'cityhostel'),
				"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'cityhostel')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"hidden" => true,
				"std" => '10',
				"type" => "text"
				),
			"blog_pagination" => array( 
				"title" => esc_html__('Pagination style', 'cityhostel'),
				"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'cityhostel')
				),
				"std" => "links",
				"options" => array(
					'pages'	=> esc_html__("Page numbers", 'cityhostel'),
					'links'	=> esc_html__("Older/Newest", 'cityhostel'),
					'more'	=> esc_html__("Load more", 'cityhostel'),
					'infinite' => esc_html__("Infinite scroll", 'cityhostel')
				),
				"type" => "select"
				),
			'show_filters' => array(
				"title" => esc_html__('Show filters', 'cityhostel'),
				"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'cityhostel')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
					'blog_style' => array('portfolio', 'gallery')
				),
				"hidden" => true,
				"std" => 0,
				"type" => "checkbox"
				),
			'first_post_large' => array(
				"title" => esc_html__('First post large', 'cityhostel'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of blog archive', 'cityhostel') ),
				"dependency" => array(
					'blog_style' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			"blog_content" => array( 
				"title" => esc_html__('Posts content', 'cityhostel'),
				"desc" => wp_kses_data( __("Show full post's content in the blog or only post's excerpt", 'cityhostel') ),
				"std" => "excerpt",
				"options" => array(
					'excerpt'	=> esc_html__('Excerpt',	'cityhostel'),
					'fullpost'	=> esc_html__('Full post',	'cityhostel')
				),
				"type" => "select"
				),
			'time_diff_before' => array(
				"title" => esc_html__('Time difference', 'cityhostel'),
				"desc" => wp_kses_data( __("How many days show time difference instead post's date", 'cityhostel') ),
				"std" => 5,
				"type" => "text"
				),
			'related_posts' => array(
				"title" => esc_html__('Related posts', 'cityhostel'),
				"desc" => wp_kses_data( __('How many related posts should be displayed in the single post?', 'cityhostel') ),
				"std" => 2,
				"options" => cityhostel_get_list_range(2,4),
				"type" => "select"
				),
			'related_style' => array(
				"title" => esc_html__('Related posts style', 'cityhostel'),
				"desc" => wp_kses_data( __('Select style of the related posts output', 'cityhostel') ),
				"std" => 2,
				"options" => cityhostel_get_list_styles(1,2),
				"type" => "select"
				),
			"blog_animation" => array( 
				"title" => esc_html__('Animation for the posts', 'cityhostel'),
				"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'cityhostel')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"std" => "none",
				"options" => cityhostel_get_list_animations_in(),
				"type" => "select"
				),
			'header_style_blog' => array(
				"title" => esc_html__('Header style', 'cityhostel'),
				"desc" => wp_kses_data( __('Select style to display the site header on the blog archive', 'cityhostel') ),
				"std" => 'inherit',
				"options" => cityhostel_get_list_header_styles(true),
				"type" => "select"
				),
			'header_position_blog' => array(
				"title" => esc_html__('Header position', 'cityhostel'),
				"desc" => wp_kses_data( __('Select position to display the site header on the blog archive', 'cityhostel') ),
				"std" => 'inherit',
				"options" => cityhostel_get_list_header_positions(true),
				"type" => "select"
				),
			'header_widgets_blog' => array(
				"title" => esc_html__('Header widgets', 'cityhostel'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the blog archive', 'cityhostel') ),
				"std" => 'inherit',
				"options" => cityhostel_get_list_sidebars(true, true),
				"type" => "select"
				),
			'sidebar_widgets_blog' => array(
				"title" => esc_html__('Sidebar widgets', 'cityhostel'),
				"desc" => wp_kses_data( __('Select sidebar to show on the blog archive', 'cityhostel') ),
				"std" => 'inherit',
				"options" => cityhostel_get_list_sidebars(true, true),
				"type" => "select"
				),
			'sidebar_position_blog' => array(
				"title" => esc_html__('Sidebar position', 'cityhostel'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the blog archive', 'cityhostel') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => cityhostel_get_list_sidebars_positions(true),
				"type" => "select"
				),
			'hide_sidebar_on_single_blog' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'cityhostel'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post", 'cityhostel') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page_blog' => array(
				"title" => esc_html__('Widgets above the page', 'cityhostel'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'cityhostel') ),
				"std" => 'inherit',
				"options" => cityhostel_get_list_sidebars(true, true),
				"type" => "select"
				),
			'widgets_above_content_blog' => array(
				"title" => esc_html__('Widgets above the content', 'cityhostel'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'cityhostel') ),
				"std" => 'inherit',
				"options" => cityhostel_get_list_sidebars(true, true),
				"type" => "select"
				),
			'widgets_below_content_blog' => array(
				"title" => esc_html__('Widgets below the content', 'cityhostel'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'cityhostel') ),
				"std" => 'inherit',
				"options" => cityhostel_get_list_sidebars(true, true),
				"type" => "select"
				),
			'widgets_below_page_blog' => array(
				"title" => esc_html__('Widgets below the page', 'cityhostel'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'cityhostel') ),
				"std" => 'inherit',
				"options" => cityhostel_get_list_sidebars(true, true),
				"type" => "select"
				),
			
		
		
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('* Color scheme editor', 'cityhostel'),
				"desc" => wp_kses_data( __("<b>Simple settings</b> - you can change only accented color, used for links, buttons and some accented areas.", 'cityhostel') )
						. '<br>'
						. wp_kses_data( __("<b>Advanced settings</b> - change all scheme's colors and get full control over the appearance of your site!", 'cityhostel') ),
				"priority" => 1000,
				"type" => "section"
				),
		
			'color_settings' => array(
				"title" => esc_html__('Color settings', 'cityhostel'),
				"desc" => '',
				"std" => 'simple',
				"options" => array(
					"simple"  => esc_html__("Simple", 'cityhostel'),
					"advanced" => esc_html__("Advanced", 'cityhostel')
				),
				"refresh" => false,
				"type" => "switch"
				),
		
			'color_scheme_editor' => array(
				"title" => esc_html__('Color Scheme', 'cityhostel'),
				"desc" => wp_kses_data( __('Select color scheme to edit colors', 'cityhostel') ),
				"std" => 'default',
				"options" => cityhostel_get_list_schemes(),
				"refresh" => false,
				"type" => "select"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Colors storage', 'cityhostel'),
				"desc" => esc_html__('Hidden storage of the all color from the all color shemes (only for internal usage)', 'cityhostel'),
				"std" => '',
				"refresh" => false,
				"type" => "hidden"
				),
		
			'scheme_info_single' => array(
				"title" => esc_html__('Colors for single post/page', 'cityhostel'),
				"desc" => wp_kses_data( __('Specify colors for single post/page (not for alter blocks)', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
				
			'bg_color' => array(
				"title" => esc_html__('Background color', 'cityhostel'),
				"desc" => wp_kses_data( __('Background color of the whole page', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'bd_color' => array(
				"title" => esc_html__('Border color', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the bordered elements, separators, etc.', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'text' => array(
				"title" => esc_html__('Text', 'cityhostel'),
				"desc" => wp_kses_data( __('Plain text color on single page/post', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_light' => array(
				"title" => esc_html__('Light text', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the post meta: post date and author, comments number, etc.', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_dark' => array(
				"title" => esc_html__('Dark text', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the headers, strong text, etc.', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_link' => array(
				"title" => esc_html__('Links', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of links and accented areas', 'cityhostel') ),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_hover' => array(
				"title" => esc_html__('Links hover', 'cityhostel'),
				"desc" => wp_kses_data( __('Hover color for links and accented areas', 'cityhostel') ),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_alter' => array(
				"title" => esc_html__('Colors for alternative blocks', 'cityhostel'),
				"desc" => wp_kses_data( __('Specify colors for alternative blocks - rectangular blocks with its own background color (posts in homepage, blog archive, search results, widgets on sidebar, footer, etc.)', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'alter_bg_color' => array(
				"title" => esc_html__('Alter background color', 'cityhostel'),
				"desc" => wp_kses_data( __('Background color of the alternative blocks', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bg_hover' => array(
				"title" => esc_html__('Alter hovered background color', 'cityhostel'),
				"desc" => wp_kses_data( __('Background color for the hovered state of the alternative blocks', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_color' => array(
				"title" => esc_html__('Alternative border color', 'cityhostel'),
				"desc" => wp_kses_data( __('Border color of the alternative blocks', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_hover' => array(
				"title" => esc_html__('Alternative hovered border color', 'cityhostel'),
				"desc" => wp_kses_data( __('Border color for the hovered state of the alter blocks', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_text' => array(
				"title" => esc_html__('Alter text', 'cityhostel'),
				"desc" => wp_kses_data( __('Text color of the alternative blocks', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_light' => array(
				"title" => esc_html__('Alter light', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with alternative background', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_dark' => array(
				"title" => esc_html__('Alter dark', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the headers inside block with alternative background', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_link' => array(
				"title" => esc_html__('Alter link', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the links inside block with alternative background', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_hover' => array(
				"title" => esc_html__('Alter hover', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with alternative background', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_input' => array(
				"title" => esc_html__('Colors for the form fields', 'cityhostel'),
				"desc" => wp_kses_data( __('Specify colors for the form fields and textareas', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'input_bg_color' => array(
				"title" => esc_html__('Inactive background', 'cityhostel'),
				"desc" => wp_kses_data( __('Background color of the inactive form fields', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bg_hover' => array(
				"title" => esc_html__('Active background', 'cityhostel'),
				"desc" => wp_kses_data( __('Background color of the focused form fields', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_color' => array(
				"title" => esc_html__('Inactive border', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the border in the inactive form fields', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_hover' => array(
				"title" => esc_html__('Active border', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the border in the focused form fields', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_text' => array(
				"title" => esc_html__('Inactive field', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the text in the inactive fields', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_light' => array(
				"title" => esc_html__('Disabled field', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the disabled field', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_dark' => array(
				"title" => esc_html__('Active field', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the active field', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_inverse' => array(
				"title" => esc_html__('Colors for inverse blocks', 'cityhostel'),
				"desc" => wp_kses_data( __('Specify colors for inverse blocks, rectangular blocks with background color equal to the links color or one of accented colors (if used in the current theme)', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'inverse_text' => array(
				"title" => esc_html__('Inverse text', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the text inside block with accented background', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_light' => array(
				"title" => esc_html__('Inverse light', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with accented background', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_dark' => array(
				"title" => esc_html__('Inverse dark', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the headers inside block with accented background', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_link' => array(
				"title" => esc_html__('Inverse link', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the links inside block with accented background', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_hover' => array(
				"title" => esc_html__('Inverse hover', 'cityhostel'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with accented background', 'cityhostel') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$cityhostel_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),


			// Section 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'cityhostel'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'cityhostel') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'cityhostel')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'cityhostel'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'cityhostel') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'cityhostel')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// Panel 'Fonts' - manage fonts loading and set parameters of the base theme elements
			'fonts' => array(
				"title" => esc_html__('* Fonts settings', 'cityhostel'),
				"desc" => '',
				"priority" => 1500,
				"type" => "panel"
				),

			// Section 'Load_fonts'
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'cityhostel'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'cityhostel') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'cityhostel') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'cityhostel'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'cityhostel') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'cityhostel') ),
				"refresh" => false,
				"std" => '$cityhostel_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=cityhostel_get_theme_setting('max_load_fonts'); $i++) {
			$fonts["load_fonts-{$i}-info"] = array(
				"title" => esc_html(sprintf(__('Font %s', 'cityhostel'), $i)),
				"desc" => '',
				"type" => "info",
				);
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'cityhostel'),
				"desc" => '',
				"refresh" => false,
				"std" => '$cityhostel_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'cityhostel'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'cityhostel') )
							: '',
				"refresh" => false,
				"std" => '$cityhostel_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'cityhostel'),
					'serif' => esc_html__('serif', 'cityhostel'),
					'sans-serif' => esc_html__('sans-serif', 'cityhostel'),
					'monospace' => esc_html__('monospace', 'cityhostel'),
					'cursive' => esc_html__('cursive', 'cityhostel'),
					'fantasy' => esc_html__('fantasy', 'cityhostel')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'cityhostel'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'cityhostel') )
											. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'cityhostel') )
							: '',
				"refresh" => false,
				"std" => '$cityhostel_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Sections with font's attributes for each theme element
		$theme_fonts = cityhostel_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(__('%s settings', 'cityhostel'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'cityhostel'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = cityhostel_get_list_load_fonts(true);
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'cityhostel'),
						'100' => esc_html__('100 (Light)', 'cityhostel'), 
						'200' => esc_html__('200 (Light)', 'cityhostel'), 
						'300' => esc_html__('300 (Thin)',  'cityhostel'),
						'400' => esc_html__('400 (Normal)', 'cityhostel'),
						'500' => esc_html__('500 (Semibold)', 'cityhostel'),
						'600' => esc_html__('600 (Semibold)', 'cityhostel'),
						'700' => esc_html__('700 (Bold)', 'cityhostel'),
						'800' => esc_html__('800 (Black)', 'cityhostel'),
						'900' => esc_html__('900 (Black)', 'cityhostel')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'cityhostel'),
						'normal' => esc_html__('Normal', 'cityhostel'), 
						'italic' => esc_html__('Italic', 'cityhostel')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'cityhostel'),
						'none' => esc_html__('None', 'cityhostel'), 
						'underline' => esc_html__('Underline', 'cityhostel'),
						'overline' => esc_html__('Overline', 'cityhostel'),
						'line-through' => esc_html__('Line-through', 'cityhostel')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'cityhostel'),
						'none' => esc_html__('None', 'cityhostel'), 
						'uppercase' => esc_html__('Uppercase', 'cityhostel'),
						'lowercase' => esc_html__('Lowercase', 'cityhostel'),
						'capitalize' => esc_html__('Capitalize', 'cityhostel')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"refresh" => false,
					"std" => '$cityhostel_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters into Theme Options
		cityhostel_storage_merge_array('options', '', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			cityhostel_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'cityhostel'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'cityhostel') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'cityhostel')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}




// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('cityhostel_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'cityhostel_options_theme_setup2', 2 );
	function cityhostel_options_theme_setup2() {
		cityhostel_options_create();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('cityhostel_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'cityhostel_options_theme_setup5', 5 );
	function cityhostel_options_theme_setup5() {
		cityhostel_storage_set('options_reloaded', false);
		cityhostel_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('cityhostel_load_custom_options')) {
		add_action( 'wp_loaded', 'cityhostel_load_custom_options' );
		function cityhostel_load_custom_options() {
			if (!cityhostel_storage_get('options_reloaded')) {
				cityhostel_storage_set('options_reloaded', true);
				cityhostel_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('cityhostel_load_theme_options') ) {
	function cityhostel_load_theme_options() {
		$options = cityhostel_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				if (strpos($v['std'], '$cityhostel_')!==false) {
					$func = substr($v['std'], 1);
					if (function_exists($func)) {
						$v['std'] = $func($k);
					}
				}
				$value = $v['std'];
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = $_GET[$k];
					else {
						$tmp = get_theme_mod($k, -987654321);
						if ($tmp != -987654321) $value = $tmp;
					}
				}
				cityhostel_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			cityhostel_customizer_save_css();
		} else {
			do_action('cityhostel_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('cityhostel_override_theme_options') ) {
	add_action( 'wp', 'cityhostel_override_theme_options', 1 );
	function cityhostel_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			cityhostel_storage_set('blog_archive', true);
			cityhostel_storage_set('blog_template', get_the_ID());
		}
		cityhostel_storage_set('blog_mode', cityhostel_detect_blog_mode());
		if (is_singular()) {
			cityhostel_storage_set('options_meta', get_post_meta(get_the_ID(), 'cityhostel_options', true));
		}
	}
}


// Return customizable option value
if (!function_exists('cityhostel_get_theme_option')) {
	function cityhostel_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;
		if ($post_id > 0) {
			if (!cityhostel_storage_isset('post_options_meta', $post_id))
				cityhostel_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'cityhostel_options', true));
			if (cityhostel_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = cityhostel_storage_get_array('post_options_meta', $post_id, $name);
				if (!cityhostel_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}
		if (!$from_post_meta && cityhostel_storage_isset('options')) {
			if ( !cityhostel_storage_isset('options', $name) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						$s = debug_backtrace();
						//array_shift($s);
						$s = array_shift($s);
						echo '<pre>' . sprintf(esc_html__('Undefined option "%s" called from:', 'cityhostel'), $name);
						if (function_exists('dco')) dco($s);
						else print_r($s);
						echo '</pre>';
						die();
					} else
						$rez = $defa;
				}
			} else {
				$blog_mode = cityhostel_storage_get('blog_mode');
				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = $_REQUEST[$name . '_' . $blog_mode];
				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = $_REQUEST[$name];
				// Override option from current page settings (if exists)
				} else if (cityhostel_storage_isset('options_meta', $name) && !cityhostel_is_inherit(cityhostel_storage_get_array('options_meta', $name))) {
					$rez = cityhostel_storage_get_array('options_meta', $name);
				// Override option from current blog mode settings: 'home', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && cityhostel_storage_isset('options', $name . '_' . $blog_mode, 'val') && !cityhostel_is_inherit(cityhostel_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = cityhostel_storage_get_array('options', $name . '_' . $blog_mode, 'val');
				// Get saved option value
				} else if (cityhostel_storage_isset('options', $name, 'val')) {
					$rez = cityhostel_storage_get_array('options', $name, 'val');
				// Get ThemeREX Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);
				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('cityhostel_check_theme_option')) {
	function cityhostel_check_theme_option($name) {
		return cityhostel_storage_isset('options', $name);
	}
}

// Get dependencies list from the Theme Options
if ( !function_exists('cityhostel_get_theme_dependencies') ) {
	function cityhostel_get_theme_dependencies() {
		$options = cityhostel_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}

// Return internal theme setting value
if (!function_exists('cityhostel_get_theme_setting')) {
	function cityhostel_get_theme_setting($name) {
		return cityhostel_storage_isset('settings', $name) ? cityhostel_storage_get_array('settings', $name) : false;
	}
}


// Set theme setting
if ( !function_exists( 'cityhostel_set_theme_setting' ) ) {
	function cityhostel_set_theme_setting($option_name, $value) {
		if (cityhostel_storage_isset('settings', $option_name))
			cityhostel_storage_set_array('settings', $option_name, $value);
	}
}
?>