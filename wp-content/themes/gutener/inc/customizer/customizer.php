<?php
/**
 * Gutener Theme Customizer
 *
 * @package Gutener
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gutener_customize_register( $wp_customize ) {
	// Load custom control functions.
	require get_template_directory() . '/inc/customizer/controls.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'Gutener_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Gutener_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Gutener Pro', 'gutener' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'gutener' ),
				'pro_url'  => 'https://keonthemes.com/downloads/gutener-pro',
				'priority'  => 1,
			)
		)
	);
}
add_action( 'customize_register', 'gutener_customize_register' );

/**
 * Enqueue style for custom customize control.
 */
add_action( 'customize_controls_enqueue_scripts', 'gutener_custom_customize_enqueue' );
function gutener_custom_customize_enqueue() {
	wp_enqueue_style( 'gutener-customize-controls', get_template_directory_uri() . '/inc/customizer/customizer.css' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function gutener_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function gutener_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gutener_customize_preview_js() {
	wp_enqueue_script( 'gutener-customizer', get_template_directory_uri() . '/inc/customizer/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'gutener_customize_preview_js' );

/**
 * Kirki Customizer
 *
 * @return void
 */
add_action( 'init' , 'gutener_kirki_fields' );

function gutener_kirki_fields(){

	/**
	* If kirki is not installed do not run the kirki fields
	*/

	if ( !class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_config( 'gutener', array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	) );

	// Site Identity - Title & Tagline
	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Logo Image Width', 'gutener' ),
		'type'         => 'slider',
		'settings'     => 'logo_width',
		'section'      => 'title_tagline',
		'transport'    => 'postMessage',
		'priority'     => '8',
		'default'      => 320,
		'choices'      => array(
			'min'  => 50,
			'max'  => 1200,
			'step' => 10,
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Site Title Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'site_title_color',
		'section'      => 'title_tagline',
		'default'      => '#101010',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Site Tagline Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'site_tagline_color',
		'section'      => 'title_tagline',
		'default'      => '#767676',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Site Title', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_site_title',
		'section'      => 'title_tagline',
		'priority'     => '10',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Site Tagline', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_site_tagline',
		'section'      => 'title_tagline',
		'priority'     => '20',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Site Tagline Border', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_site_tagline_border',
		'section'      => 'title_tagline',
		'priority'     => '30',
		'default'      => false,
	) );

	// Colors Options
	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Body Text Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'site_body_text_color',
		'section'      => 'colors',
		'default'     => '#101010',
		'priority'    => '20',

	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'General Heading Text Color (H1 - H6)', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'site_heading_text_color',
		'section'      => 'colors',
		'default'     => '#101010',
		'priority'    => '30',

	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Page and Single Post Title', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'header_textcolor',
		'section'      => 'colors',
		'default'     => '#101010',
		'priority'    => '40',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Primary Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'site_primary_color',
		'section'      => 'colors',
		'default'     => '#f9a032',
		'priority'    => '50',
	) );
	
	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Hover Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'site_hover_color',
		'section'      => 'colors',
		'default'     => '#086abd',
		'priority'    => '60',
	) );

	// Theme Options
	Kirki::add_panel( 'theme_options', array(
	    'title' => esc_html__( 'Theme Options', 'gutener' ),
	) );

	// Theme Skin Options
	Kirki::add_section( 'skins_options', array(
	    'title'      => esc_html__( 'Skins', 'gutener' ),
	    'panel'      => 'theme_options',
	    'capability' => 'edit_theme_options',
	    'priority'   => '10',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Select Theme Skin', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'skin_select',
		'section'     => 'skins_options',
		'default'     => 'default',
		'choices'  => array(
			'default'    => esc_html__( 'Default', 'gutener' ),
			'dark'       => esc_html__( 'Dark', 'gutener' ),
			'blackwhite' => esc_html__( 'Black & White', 'gutener' ),
		)
	) );

	// Top Notification Options
	Kirki::add_section( 'notification_bar_options', array(
	    'title'      => esc_html__( 'Top Notification Bar', 'gutener' ),
	    'panel'      => 'theme_options',
	    'capability' => 'edit_theme_options',
	    'priority'   => '20',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Header Notification Bar', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_notification_bar',
		'section'     => 'notification_bar_options',
		'default'     => true,
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Background Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'notification_bar_background_color',
		'section'      => 'notification_bar_options',
		'default'      => '#1a1a1a',
		'active_callback' => array(
			array(
				'setting'  => 'disable_notification_bar',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Title Text Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'notification_bar_title_color',
		'section'      => 'notification_bar_options',
		'default'      => '#ffffff',
		'active_callback' => array(
			array(
				'setting'  => 'disable_notification_bar',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Button Background Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'notification_bar_button_background_color',
		'section'      => 'notification_bar_options',
		'default'      => '#f9a032',
		'active_callback' => array(
			array(
				'setting'  => 'disable_notification_bar',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Button Text Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'notification_bar_button_text_color',
		'section'      => 'notification_bar_options',
		'default'      => '#ffffff',
		'active_callback' => array(
			array(
				'setting'  => 'disable_notification_bar',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'    => esc_html__( 'Title', 'gutener' ),
		'type'     => 'text',
		'settings' => 'notification_bar_title',
		'section'  => 'notification_bar_options',
		'default'  => '',
		'active_callback' => array(
			array(
				'setting'  => 'disable_notification_bar',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'    => esc_html__( 'Button Text', 'gutener' ),
		'type'     => 'text',
		'settings' => 'notification_bar_button_text',
		'section'  => 'notification_bar_options',
		'default'  => '',
		'active_callback' => array(
			array(
				'setting'  => 'disable_notification_bar',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Type', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'notification_bar_button_type',
		'section'     => 'notification_bar_options',
		'default'     => 'button-primary',
		'choices'  => array(
			'button-primary' => esc_html__( 'Primary Button', 'gutener' ),
			'button-outline' => esc_html__( 'Border Button', 'gutener' ),
			'button-text'    => esc_html__( 'Text Only Button', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_notification_bar',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Border Radius (px)', 'gutener' ),
		'type'        => 'slider',
		'settings'    => 'notification_bar_button_border_radius',
		'section'     => 'notification_bar_options',
		'transport'   => 'postMessage',
		'default'     => 0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_notification_bar',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Target', 'gutener' ),
		'description' => esc_html__( 'If enabled, the page will be open in an another browser tab.', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'notification_bar_button_target',
		'section'     => 'notification_bar_options',
		'default'     => true,
		'active_callback' => array(
			array(
				'setting'  => 'disable_notification_bar',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'    => esc_html__( 'Button Link', 'gutener' ),
		'type'     => 'link',
		'settings' => 'notification_bar_button_link',
		'section'  => 'notification_bar_options',
		'default'  => '',
		'active_callback' => array(
			array(
				'setting'  => 'disable_notification_bar',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'    => esc_html__( 'Disable Sticky Position', 'gutener' ),
		'type'     => 'checkbox',
		'settings' => 'disable_sticky_notification_bar',
		'section'  => 'notification_bar_options',
		'default'  => false,
		'active_callback' => array(
			array(
				'setting'  => 'disable_notification_bar',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Header Options
	Kirki::add_section( 'header_options', array(
	    'title'      => esc_html__( 'Header', 'gutener' ),
	    'panel'      => 'theme_options',
	    'capability' => 'edit_theme_options',
	    'priority'   => '30',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Header Layouts', 'gutener' ),
		'type'        => 'radio-image',
		'settings'    => 'header_layout',
		'section'     => 'header_options',
		'default'     => 'header_one',
		'choices'  => array(
			'header_one'   => get_template_directory_uri() . '/assets/images/header-layout-1.png',
			'header_two'   => get_template_directory_uri() . '/assets/images/header-layout-2.png',
			'header_three' => get_template_directory_uri() . '/assets/images/header-layout-3.png',
		)
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Section Border', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_header_border',
		'section'      => 'header_options',
		'default'      => false,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Top Header Background Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'top_header_one_background_color',
		'section'      => 'header_options',
		'default'      => '#ffffff',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_one',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Top Header Background Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'top_header_two_background_color',
		'section'      => 'header_options',
		'default'      => '#ffffff',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Top Header Background Color', 'gutener' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'top_header_three_background_color',
		'section'      => 'header_options',
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_three',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Top Header Text Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'top_header_text_color',
		'section'      => 'header_options',
		'default'      => '#969696',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Mid Header Background Color', 'gutener' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'mid_header_background_color',
		'section'      => 'header_options',
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_one',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Mid Header Text Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'mid_header_text_color',
		'section'      => 'header_options',
		'default'      => '#101010',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_one',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Bottom Header Background Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'bottom_header_one_background_color',
		'section'      => 'header_options',
		'default'      => '#ffffff',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_one',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Bottom Header Background Color', 'gutener' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'bottom_header_two_background_color',
		'section'      => 'header_options',
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Bottom Header Background Color', 'gutener' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'bottom_header_three_background_color',
		'section'      => 'header_options',
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_three',
			),
		),
	) );

	// Header three separate logo
	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Separate Logo for Homepage', 'gutener' ),
		'type'         => 'image',
		'settings'     => 'header_separate_logo',
		'section'      => 'header_options',
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Bottom Header Text Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'bottom_header_text_color',
		'section'      => 'header_options',
		'default'      => '#333333',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Below Section Border', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_header_below_border',
		'section'      => 'header_options',
		'default'      => false,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one' ),
			),
		),
	) );

	// Header button
	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Button Background Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'header_button_background_color',
		'section'      => 'header_options',
		'default'      => '#f9a032',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two', 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Button Text Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'header_button_text_color',
		'section'      => 'header_options',
		'default'      => '#ffffff',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two', 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Header Button Text', 'gutener' ),
		'type'         => 'text',
		'settings'     => 'header_button_text',
		'section'      => 'header_options',
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two', 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Target', 'gutener' ),
		'description' => esc_html__( 'If enabled, the page will be open in an another browser tab.', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'header_button_target',
		'section'     => 'header_options',
		'default'     => true,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two', 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'    => esc_html__( 'Button Link', 'gutener' ),
		'type'     => 'link',
		'settings' => 'header_button_link',
		'section'  => 'header_options',
		'default'  => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two', 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Type', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'header_button_type',
		'section'     => 'header_options',
		'default'     => 'button-primary',
		'choices'  => array(
			'button-primary' => esc_html__( 'Primary Button', 'gutener' ),
			'button-outline' => esc_html__( 'Border Button', 'gutener' ),
			'button-text'    => esc_html__( 'Text Only Button', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two', 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Border Radius (px)', 'gutener' ),
		'type'        => 'slider',
		'settings'    => 'header_button_border_radius',
		'section'     => 'header_options',
		'transport'   => 'postMessage',
		'default'     => 0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two', 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Image Slider', 'gutener' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'header_media_options',
		'section'     => 'header_options',
		'default'     => 'slider',
		'choices'  => array(
			'slider' => esc_html__( 'Image Slider', 'gutener' ),
		)
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Height (in px)', 'gutener' ),
		'description' => esc_html__( 'These options will only apply to Desktop. Please click on below Desktop Icon to see changes.
		', 'gutener' ),
		'type'        => 'slider',
		'settings'    => 'header_image_height',
		'section'     => 'header_options',
		'transport'   => 'postMessage',
		'default'     => 220,
		'choices'     => array(
			'min'  => 0,
			'max'  => 1500,
			'step' => 5,
		),
	) );

	// Header Image / Slider Options
	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Header Image Slider', 'gutener' ),
		'description' => esc_html__( 'Recommended image size 1920x550 pixel. Add only one image to make header banner.', 'gutener' ),
		'type'        => 'repeater',
		'section'     => 'header_options',
		'row_label' => array(
			'type'  => 'text',
		),
		'button_label' => esc_html__('Add New Image', 'gutener' ),
		'settings'     => 'header_image_slider',
		'default'      => '',
		'fields' => array(
			'slider_item' => array(
				'label'       => esc_html__( 'Image', 'gutener' ),
				'type'        => 'image',
				'default'     => '',
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_media_options',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Background Image Size', 'gutener' ),
		'type'         => 'radio',
		'settings'     => 'header_image_size',
		'section'      => 'header_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'gutener' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'gutener' ),
			'norepeat' => esc_html__( 'No Repeat', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_media_options',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Slide Effect', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'header_slider_effect',
		'section'     => 'header_options',
		'default'     => 'fade',
		'choices'  => array(
			'fade'             => esc_html__( 'Fade', 'gutener' ),
			'horizontal-slide' => esc_html__( 'Slide', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_media_options',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Arrows', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_header_slider_arrows',
		'section'      => 'header_options',
		'default'      => false,
		'active_callback' => array(
			array(
				'setting'  => 'header_media_options',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Dots', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_header_slider_dots',
		'section'      => 'header_options',
		'default'      => false,
		'active_callback' => array(
			array(
				'setting'  => 'header_media_options',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Auto Play', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_header_slider_autoplay',
		'section'      => 'header_options',
		'default'      => true,
		'active_callback' => array(
			array(
				'setting'  => 'header_media_options',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Auto Play Timeout ( in sec )', 'gutener' ),
		'type'         => 'number',
		'settings'     => 'slider_header_autoplay_speed',
		'section'      => 'header_options',
		'default'      => 4,
		'choices' => array(
				'min' => '1',
				'max' => '60',
				'step'=> '1',
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_media_options',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Fade Control Time ( in sec )', 'gutener' ),
		'type'         => 'number',
		'settings'     => 'slider_header_fade_control',
		'section'      => 'header_options',
		'default'      => 5,
		'choices' => array(
				'min' => '3',
				'max' => '60',
				'step'=> '1',
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_media_options',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Parallax Scrolling', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_parallax_scrolling',
		'section'     => 'header_options',
		'default'     => true,
		'active_callback' => array(
			array(
				'setting'  => 'header_media_options',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
	    'type'        => 'custom',
	    'settings'    => 'separator' . rand(),
	    'section'     => 'header_options',
	    'default'     => '<hr><strong>Elements</strong><hr>',
	) );
	
	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Fixed Header', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_fixed_header',
		'section'     => 'header_options',
		'default'     => true,
	) );

	Kirki::add_field( 'gutener', array(
		'label'    => esc_html__( 'Disable Header Search Option', 'gutener' ),
		'type'     => 'checkbox',
		'settings' => 'disable_search_icon',
		'section'  => 'header_options',
		'default'  => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'    => esc_html__( 'Disable Hamburger Widget Menu', 'gutener' ),
		'type'     => 'checkbox',
		'settings' => 'disable_hamburger_menu_icon',
		'section'  => 'header_options',
		'default'  => false,
	) );

	// Social Media Options
	Kirki::add_section( 'social_media_options', array(
	    'title'          => esc_html__( 'Social Media', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '40',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Social Links from Header', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_header_social_links',
		'section'      => 'social_media_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Social Links from Footer', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_footer_social_links',
		'section'      => 'social_media_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Footer Social Icons Size', 'gutener' ),
		'description' => esc_html__( 'Only applicable to the footer social icons.', 'gutener' ),
		'type'        => 'number',
		'settings'    => 'social_icons_size',
		'section'     => 'social_media_options',
		'transport'   => 'postMessage',
		'default'     => 15,
		'choices'     => array(
			'min'  => 10,
			'max'  => 100,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_footer_social_links',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Social Links', 'gutener' ),
		'type'        => 'repeater',
		'description' => esc_html__( 'By default, Social Icons will appear in both header and footer section.', 'gutener' ),
		'section'     => 'social_media_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Social Link', 'gutener' ),
		),
		'settings' => 'social_media_links',
		'default' => array(
				array(
					'icon' 		=> '',
					'link' 		=> '',
					'new_tab' 	=> false,
					)			
		),
		'fields' => array(
			'icon' => array(
				'label'       => esc_html__( 'Fontawesome Icon', 'gutener' ),
				'type'        => 'text',
				'description' => esc_html__( 'Input Icon name. For Example:- fab fa-facebook. For more icons https://fontawesome.com/icons?d=gallery&m=free', 'gutener' ),
			),
			'link' => array(
				'label'       => esc_html__( 'Link', 'gutener' ),
				'type'        => 'text',
			),
			'new_tab' => array(
				'label'       => esc_html__( 'Open Link in New Tab', 'gutener' ),
				'type'        => 'checkbox',
			),			
		),
		'choices' => array(
			'limit' => 20,
		),
	) );

	// Contact Detail Options
	Kirki::add_section( 'contact_detail_options', array(
	    'title'          => esc_html__( 'Contact Details', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '45',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Contact Details', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_contact_detail',
		'section'      => 'contact_detail_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Phone Number', 'gutener' ),
		'type'         => 'text',
		'settings'     => 'contact_phone',
		'section'      => 'contact_detail_options',
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Email', 'gutener' ),
		'type'         => 'text',
		'settings'     => 'contact_email',
		'section'      => 'contact_detail_options',
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Address', 'gutener' ),
		'type'         => 'text',
		'settings'     => 'contact_address',
		'section'      => 'contact_detail_options',
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Main Slider / Image Options
	Kirki::add_section( 'main_slider_options', array(
	    'title'          => esc_html__( 'Main Slider / Banner', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '50',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Slider / Banner', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_main_slider',
		'section'     => 'main_slider_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Slider / Banner', 'gutener' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'main_slider_controls',
		'section'     => 'main_slider_options',
		'default'     => 'slider',
		'choices'  => array(
			'slider' => esc_html__( 'Slider', 'gutener' ),
			'banner' => esc_html__( 'Banner', 'gutener' ),
		)
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Height (in px)', 'gutener' ),
		'description' => esc_html__( 'These options will only apply to Desktop. Please click on below Desktop Icon to see changes.
		', 'gutener' ),
		'type'        => 'slider',
		'settings'    => 'main_slider_height',
		'section'     => 'main_slider_options',
		'transport'   => 'postMessage',
		'default'     => 550,
		'choices'     => array(
			'min'  => 50,
			'max'  => 1500,
			'step' => 10,
		),
	) );

	// Slider settings
	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Choose Category', 'gutener' ),
		'description' => esc_html__( 'Recent posts will show if any, category is not chosen.', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'slider_category',
		'section'     => 'main_slider_options',
		'default'     => 'Uncategorized',
		'placeholder' => esc_attr__( 'Select category', 'gutener' ),
		'choices'     => gutener_get_post_categories(),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'type'        => 'number',
		'settings'    => 'slider_image_overlay_opacity',
		'label'       => esc_html__( 'Image Overlay Opacity', 'gutener' ),
		'section'     => 'main_slider_options',
		'default'     => 4,
		'choices' => array(
			'min' => '0',
			'max' => '9',
			'step' => '1',
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Background Image Size', 'gutener' ),
		'type'         => 'radio',
		'settings'     => 'main_slider_image_size',
		'section'      => 'main_slider_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'gutener' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'gutener' ),
			'norepeat' => esc_html__( 'No Repeat', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Display Slider on', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'display_slider_on',
		'section'     => 'main_slider_options',
		'default'     => 'blog-page-below-header',
		'choices'  => array(
			'blog-page-below-header'       => esc_html__( 'Blog Page Below Header', 'gutener' ),
			'blog-page-above-latest-posts' => esc_html__( 'Blog Page Above Latest Posts', 'gutener' ),
			'front-page-below-header'      => esc_html__( 'Front Page Below Header', 'gutener' ),
			'front-blog-page-below-header' => esc_html__( 'Front and Blog Page Below Header', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Width Controls', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'slider_width_controls',
		'section'     => 'main_slider_options',
		'default'     => 'full',
		'choices'  => array(
			'full'   => esc_html__( 'Full', 'gutener' ),
			'boxed'  => esc_html__( 'Boxed', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Slide Effect', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'main_slider_effect',
		'section'     => 'main_slider_options',
		'default'     => 'fade',
		'choices'  => array(
			'fade'             => esc_html__( 'Fade', 'gutener' ),
			'horizontal-slide' => esc_html__( 'Slide', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Content Alignment', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'main_slider_content_alignment',
		'section'     => 'main_slider_options',
		'default'     => 'center',
		'choices'  => array(
			'center' => esc_html__( 'Center', 'gutener' ),
			'left'   => esc_html__( 'Left', 'gutener' ),
			'right'  => esc_html__( 'Right', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Arrows', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_slider_arrows',
		'section'      => 'main_slider_options',
		'default'      => false,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Dots', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_slider_dots',
		'section'      => 'main_slider_options',
		'default'      => false,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Auto Play', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_slider_autoplay',
		'section'      => 'main_slider_options',
		'default'      => true,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Auto Play Timeout ( in sec )', 'gutener' ),
		'type'         => 'number',
		'settings'     => 'slider_autoplay_speed',
		'section'      => 'main_slider_options',
		'default'      => 4,
		'choices' => array(
				'min' => '1',
				'max' => '60',
				'step'=> '1',
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Fade Control Time ( in sec )', 'gutener' ),
		'type'         => 'number',
		'settings'     => 'slider_fade_control',
		'section'      => 'main_slider_options',
		'default'      => 5,
		'choices' => array(
				'min' => '3',
				'max' => '60',
				'step'=> '1',
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Post View Number', 'gutener' ),
		'description'  => esc_html__( 'Number of posts to show.', 'gutener' ),
		'type'         => 'number',
		'settings'     => 'slider_posts_number',
		'section'      => 'main_slider_options',
		'default'      => 6,
		'choices' => array(
				'min' => '1',
				'max' => '20',
				'step' => '1',
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Title', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_title',
		'section'     => 'main_slider_options',
		'default'     => false,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Content', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_excerpt',
		'section'     => 'main_slider_options',
		'default'     => false,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Excerpt Lenght', 'gutener' ),
		'type'        => 'number',
		'settings'    => 'slider_excerpt_length',
		'section'     => 'main_slider_options',
		'default'     => 25,
		'choices' => array(
			'min' => '5',
			'max' => '100',
			'step' => '5',
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_slider_excerpt',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Button', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_button',
		'section'     => 'main_slider_options',
		'default'     => true,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Text', 'gutener' ),
		'type'        => 'text',
		'settings'    => 'slider_button_text',
		'section'     => 'main_slider_options',
		'default'     => '',
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hide_slider_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Type', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'slider_button_type',
		'section'     => 'main_slider_options',
		'default'     => 'button-outline',
		'choices'  => array(
			'button-primary' => esc_html__( 'Primary Button', 'gutener' ),
			'button-outline' => esc_html__( 'Border Button', 'gutener' ),
			'button-text'    => esc_html__( 'Text Only Button', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hide_slider_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Border Radius (px)', 'gutener' ),
		'type'        => 'slider',
		'settings'    => 'slider_button_border_radius',
		'section'     => 'main_slider_options',
		'transport'   => 'postMessage',
		'default'     => 0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hide_slider_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide category', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_category',
		'section'     => 'main_slider_options',
		'default'     => false,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Date', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_date',
		'section'     => 'main_slider_options',
		'default'     => false,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Author', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_author',
		'section'     => 'main_slider_options',
		'default'     => false,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Comments Link', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_comment',
		'section'     => 'main_slider_options',
		'default'     => false,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	// Banner settings
	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Title', 'gutener' ),
		'type'        => 'text',
		'settings'    => 'banner_title',
		'section'     => 'main_slider_options',
		'default'     => '',
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
		'partial_refresh' => array(
			'banner_title' => array(
				'selector'        => '.banner_title',
				'render_callback' => 'gutener_get_banner_title',
			)
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Subtitle', 'gutener' ),
		'type'        => 'text',
		'settings'    => 'banner_subtitle',
		'section'     => 'main_slider_options',
		'default'     => '',
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
		'partial_refresh' => array(
			'banner_subtitle' => array(
				'selector'        => '.banner_subtitle',
				'render_callback' => 'gutener_get_banner_subtitle',
			)
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Banner Buttons', 'gutener' ),
		'type'        => 'repeater',
		'section'     => 'main_slider_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Button', 'gutener' ),
		),
		'settings' => 'main_banner_buttons',
		'default' => array(
			array(
				'text' => '',
				'link' => '',
				'type' => 'button-outline',
			),		
		),
		'fields' => array(
			'text' => array(
				'label'       => esc_html__( 'Text', 'gutener' ),
				'type'        => 'text',
			),
			'link' => array(
				'label'       => esc_html__( 'Link', 'gutener' ),
				'type'        => 'text',
			),
			'type' => array(
				'label'       => esc_html__( 'Button Type', 'gutener' ),
				'type'        => 'select',
				'default'     => 'button-outline',
				'choices'  => array(
					'button-primary' => esc_html__( 'Primary Button', 'gutener' ),
					'button-outline' => esc_html__( 'Border Button', 'gutener' ),
					'button-text'    => esc_html__( 'Text Only Button', 'gutener' ),
				),
			),		
		),
		'choices' => array(
			'limit' => 10,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Border Radius (px)', 'gutener' ),
		'type'        => 'slider',
		'settings'    => 'banner_button_border_radius',
		'section'     => 'main_slider_options',
		'transport'   => 'postMessage',
		'default'     => 0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'type'        => 'image',
		'settings'    => 'banner_image',
		'label'       => esc_html__( 'Select Image', 'gutener' ),
		'description' => esc_html__( 'Recommended image size 1920x550 pixel.', 'gutener' ),
		'section'     => 'main_slider_options',
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		)
	) );

	Kirki::add_field( 'gutener', array(
		'type'        => 'number',
		'settings'    => 'banner_image_overlay_opacity',
		'label'       => esc_html__( 'Image Overlay Opacity', 'gutener' ),
		'section'     => 'main_slider_options',
		'default'     => 4,
		'choices' => array(
			'min' => '0',
			'max' => '9',
			'step' => '1',
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Background Image Size', 'gutener' ),
		'type'         => 'radio',
		'settings'     => 'main_banner_image_size',
		'section'      => 'main_slider_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'gutener' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'gutener' ),
			'norepeat' => esc_html__( 'No Repeat', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Display Banner on', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'display_banner_on',
		'section'     => 'main_slider_options',
		'default'     => 'blog-page-below-header',
		'choices'  => array(
			'blog-page-below-header'       => esc_html__( 'Blog Page Below Header', 'gutener' ),
			'blog-page-above-latest-posts' => esc_html__( 'Blog Page Above Latest Posts', 'gutener' ),
			'front-page-below-header'      => esc_html__( 'Front Page Below Header', 'gutener' ),
			'front-blog-page-below-header' => esc_html__( 'Front and Blog Page Below Header', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Width Controls', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'banner_width_controls',
		'section'     => 'main_slider_options',
		'default'     => 'full',
		'choices'  => array(
			'full'   => esc_html__( 'Full', 'gutener' ),
			'boxed'  => esc_html__( 'Boxed', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Content Alignment', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'main_banner_content_alignment',
		'section'     => 'main_slider_options',
		'default'     => 'center',
		'choices'  => array(
			'center' => esc_html__( 'Center', 'gutener' ),
			'left'   => esc_html__( 'Left', 'gutener' ),
			'right'  => esc_html__( 'Right', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	//Typography Options
	Kirki::add_section( 'typography', array(
	    'title'          => esc_html__( 'Typography', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '60',
	    'reset'          => 'typography',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Site Title', 'gutener' ),
		'type'         => 'typography',
		'settings'     => 'site_title_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'font-size'      => '62px',
			'text-transform' => 'none',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-header .site-branding .site-title',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Site Description', 'gutener' ),
		'type'         => 'typography',
		'settings'     => 'site_description_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'font-size'      => '14px',
			'text-transform' => 'none',
		),
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => '.site-header .site-branding .site-description',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Main Menu', 'gutener' ),
		'type'         => 'typography',
		'settings'     => 'main_menu_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'font-size'      => '15px',
			'text-transform' => 'none',
			'variant'        => '600',
			'line-height'    => '1.5',
		),
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => '.main-navigation ul.nav-menu > li > a',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Body', 'gutener' ),
		'type'         => 'typography',
		'settings'     => 'body_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'font-size'      => '15px',
		),
		'transport'   => 'auto',
		'output' => array( 
			array(
				'element' => 'body',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'General Title', 'gutener' ),
		'type'         => 'typography',
		'settings'     => 'general_title_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'text-transform' => 'none',
		),
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => 'h1, h2, h3, h4, h5, h6',
			),
		),	
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Page & Single Post Title', 'gutener' ),
		'type'         => 'typography',
		'settings'     => 'page_title_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'font-size'      => '48px',
			'text-transform' => 'none',
		),
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => 'body.single .page-title, body.page .page-title',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Blog Post Title', 'gutener' ),
		'description'  => esc_html__( 'Only applicable to latest post titles.', 'gutener' ),
		'type'         => 'typography',
		'settings'     => 'blog_page_title_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'font-size'      => '21px',
			'text-transform' => 'none',
		),
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => '.content-area h3.entry-title',
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Homepage Section Title', 'gutener' ),
		'type'         => 'typography',
		'settings'     => 'section_title_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'font-size'      => '24px',
			'text-transform' => 'none',
		),
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => 'h2.section-title',
			),
		),
	) );

	// Global Layouts Options
	Kirki::add_section( 'global_layout_options', array(
	    'title'          => esc_html__( 'Global Layouts', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '70',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Site Layouts', 'gutener' ),
		'description' => esc_html__( 'Default / Box / Frame / Full / Compact', 'gutener' ),
		'type'        => 'radio-image',
		'settings'    => 'site_layout',
		'section'     => 'global_layout_options',
		'default'     => 'default',
		'choices'  => array(
			'default' => get_template_directory_uri() . '/assets/images/default-layout.png',
			'box'     => get_template_directory_uri() . '/assets/images/box-layout.png',
			'frame'   => get_template_directory_uri() . '/assets/images/frame-layout.png',
			'full'    => get_template_directory_uri() . '/assets/images/full-layout.png',
			'compact' => get_template_directory_uri() . '/assets/images/compact-layout.png',
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Sidebar Layouts', 'gutener' ),
		'description' => esc_html__( 'Right / Left / None', 'gutener' ),
		'type'        => 'radio-image',
		'settings'    => 'sidebar_settings',
		'section'     => 'global_layout_options',
		'default'     => 'right',
		'choices'  => array(
			'right'      => get_template_directory_uri() . '/assets/images/right-sidebar.png',
			'left'       => get_template_directory_uri() . '/assets/images/left-sidebar.png',
			'right-left' => get_template_directory_uri() . '/assets/images/right-left-sidebar.png',
			'no-sidebar' => get_template_directory_uri() . '/assets/images/no-sidebar.png',
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Archive Post Layouts', 'gutener' ),
		'description' => esc_html__( 'Grid / List / Single', 'gutener' ),
		'type'        => 'radio-image',
		'settings'    => 'archive_post_layout',
		'section'     => 'global_layout_options',
		'default'     => 'grid',
		'choices'  => array(
			'grid'   => get_template_directory_uri() . '/assets/images/grid-layout.png',
			'list'   => get_template_directory_uri() . '/assets/images/list-layout.png',
			'single' => get_template_directory_uri() . '/assets/images/single-layout.png',
		)
	) );

	Kirki::add_field( 'gutener', array(
	    'type'        => 'custom',
	    'settings'    => 'separator' . rand(),
	    'section'     => 'global_layout_options',
	    'default'     => '<hr><strong>Elements</strong><hr>',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Site Layouts (Box & Frame) Shadow', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_site_layout_shadow',
		'section'      => 'global_layout_options',
		'default'      => false,
	) );

	// Sidebar Options
	Kirki::add_section( 'sidebar_options', array(
	    'title'          => esc_html__( 'Sidebar', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '80',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Sticky Position', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_sticky_sidebar',
		'section'      => 'sidebar_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Sidebar in Blog Page', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_sidebar_blog_page',
		'section'     => 'sidebar_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Sidebar in Single Post', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_sidebar_single_post',
		'section'     => 'sidebar_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Sidebar in Page', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_sidebar_page',
		'section'     => 'sidebar_options',
		'default'     => true,
	) );

	// Instagram Options
	Kirki::add_section( 'instagram_feed_options', array(
	    'title'          => esc_html__( 'Instagram Feed', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '90',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Instagram Feed', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_instagram',
		'section'      => 'instagram_feed_options',
		'default'      => true,
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Instagram Shortcode', 'gutener' ),
		'type'         => 'text',
		'settings'     => 'insta_shortcode',
		'section'      => 'instagram_feed_options',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Enable in Homepage Only', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'enable_instagram_homepage',
		'section'      => 'instagram_feed_options',
		'default'      => false,
	) );

	// Footer Options
	Kirki::add_section( 'footer_options', array(
	    'title'          => esc_html__( 'Footer', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '100',
	) );

	Kirki::add_field( 'gutener', array(
	    'type'        => 'custom',
	    'settings'    => 'separator' . rand(),
	    'section'     => 'footer_options',
	    'default'     => '<hr><strong>Top Footer</strong><hr>',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Footer Widget Area', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_footer_widget',
		'section'      => 'footer_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Footer Widget Title Border', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_footer_widget_title_border',
		'section'      => 'footer_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Footer Widget Item List Border ', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_footer_widget_list_item_border',
		'section'      => 'footer_options',
		'default'      => false,
	) );
	
	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Widget Columns', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'top_footer_widget_columns',
		'section'     => 'footer_options',
		'default'     => 'four_columns',
		'choices'  => array(
			'four_columns'  => esc_html__( 'Four Columns', 'gutener' ),
			'three_columns' => esc_html__( 'Three Columns', 'gutener' ),
			'two_columns'   => esc_html__( 'Two Columns', 'gutener' ),
			'one_column'    => esc_html__( 'One Column', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_footer_widget',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Top Footer Background Color', 'gutener' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'top_footer_background_color',
		'section'      => 'footer_options',
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'disable_footer_widget',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Footer Widget Title Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'top_footer_widget_title_color',
		'section'      => 'footer_options',
		'default'      => '#030303',
		'active_callback' => array(
			array(
				'setting'  => 'disable_footer_widget',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Footer Widgets Link Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'top_footer_widget_link_color',
		'section'      => 'footer_options',
		'default'      => '#656565',
		'active_callback' => array(
			array(
				'setting'  => 'disable_footer_widget',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Footer Widgets Content Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'top_footer_widget_content_color',
		'section'      => 'footer_options',
		'default'      => '#656565',
		'active_callback' => array(
			array(
				'setting'  => 'disable_footer_widget',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
	    'type'        => 'custom',
	    'settings'    => 'separator' . rand(),
	    'section'     => 'footer_options',
	    'default'     => '<hr><strong>Bottom Footer</strong><hr>',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Bottom Footer Area', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_bottom_footer',
		'section'      => 'footer_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Footer Layouts', 'gutener' ),
		'type'        => 'radio-image',
		'settings'    => 'footer_layout',
		'section'     => 'footer_options',
		'default'     => 'footer_one',
		'choices'  => array(
			'footer_one'   => get_template_directory_uri() . '/assets/images/footer-layout-1.png',
			'footer_two'   => get_template_directory_uri() . '/assets/images/footer-layout-2.png',
			'footer_three' => get_template_directory_uri() . '/assets/images/footer-layout-3.png',
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_bottom_footer',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Background Color', 'gutener' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'bottom_footer_background_color',
		'section'      => 'footer_options',
		'default'      => '',
		'active_callback' => array(
			array(
				'setting'  => 'disable_bottom_footer',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Text Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'bottom_footer_text_color',
		'section'      => 'footer_options',
		'default'      => '#656565',
		'active_callback' => array(
			array(
				'setting'  => 'disable_bottom_footer',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Text Link Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'bottom_footer_text_link_color',
		'section'      => 'footer_options',
		'default'      => '#383838',
		'active_callback' => array(
			array(
				'setting'  => 'disable_bottom_footer',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Footer Menu', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_footer_menu',
		'section'      => 'footer_options',
		'default'      => false,
		'active_callback' => array(
			array(
				'setting'  => 'disable_bottom_footer',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Footer Text', 'gutener' ),
		'type'         => 'textarea',
		'settings'     => 'footer_text',
		'section'      => 'footer_options',
		'default'      => esc_html__( 'Copyright &copy; 2020.', 'gutener' ),
		'active_callback' => array(
			array(
				'setting'  => 'disable_bottom_footer',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
	    'type'        => 'custom',
	    'settings'    => 'separator' . rand(),
	    'section'     => 'footer_options',
	    'default'     => '<hr><strong>Elements</strong><hr>',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Select Background Image', 'gutener' ),
		'description' => esc_html__( 'Recommended image size 1920x550 pixel.', 'gutener' ),
		'type'        => 'image',
		'settings'    => 'footer_image',
		'section'     => 'footer_options',
		'default'      => '',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Background Image Size', 'gutener' ),
		'type'         => 'radio',
		'settings'     => 'footer_image_size',
		'section'      => 'footer_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'gutener' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'gutener' ),
			'norepeat' => esc_html__( 'No Repeat', 'gutener' ),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Parallax Scrolling', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_footer_parallax_scrolling',
		'section'     => 'footer_options',
		'default'     => true,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Scroll to Top', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_scroll_top',
		'section'     => 'footer_options',
		'default'     => false,
	) );

	//Blog Page Options
	Kirki::add_section( 'blog_page_options', array(
	    'title'          => esc_html__( 'Blog Page', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '110',
	) );

	Kirki::add_field( 'gutener',  array(
		'label'       => esc_html__( 'Page Title', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'disable_blog_page_title',
		'section'     => 'blog_page_options',
		'default'     => 'enable_all_pages',
		'choices'     => array(
			'enable_all_pages'  => esc_html__( 'Enable in all', 'gutener' ),
			'disable_all_pages' => esc_html__( 'Disable from all', 'gutener' ),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Excerpt Length', 'gutener' ),
		'description' => esc_html__( 'Select number of words to display in excerpt', 'gutener' ),
		'type'        => 'number',
		'settings'    => 'post_excerpt_length',
		'section'     => 'blog_page_options',
		'default'     => 15,
		'choices' => array(
			'min'  => '5',
			'max'  => '60',
			'step' => '5',
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Sticky Post Excerpt Length', 'gutener' ),
		'description' => esc_html__( 'Select number of words to display in excerpt', 'gutener' ),
		'type'        => 'number',
		'settings'    => 'sticky_simple_post_excerpt_length',
		'section'     => 'blog_page_options',
		'default'     => 40,
		'choices' => array(
			'min'  => '5',
			'max'  => '60',
			'step' => '5',
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Post Title Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'blog_post_title_color',
		'section'      => 'blog_page_options',
		'default'      => '#101010',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Post Category Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'blog_post_category_color',
		'section'      => 'blog_page_options',
		'default'      => '#f9a032',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Post Meta Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'blog_post_meta_color',
		'section'      => 'blog_page_options',
		'default'      => '#7a7a7a',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Post Text Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'blog_post_text_color',
		'section'      => 'blog_page_options',
		'default'      => '#333333',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Post Button Color', 'gutener' ),
		'type'         => 'color',
		'settings'     => 'blog_post_button_color',
		'section'      => 'blog_page_options',
		'default'      => '#333333',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Button', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_post_button',
		'section'     => 'blog_page_options',
		'default'     => true,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Text', 'gutener' ),
		'type'        => 'text',
		'settings'    => 'post_button_text',
		'section'     => 'blog_page_options',
		'default'     => '',
		'active_callback' => array(
			array(
				'setting'  => 'hide_post_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Type', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'post_button_type',
		'section'     => 'blog_page_options',
		'default'     => 'button-text',
		'choices'  => array(
			'button-primary' => esc_html__( 'Primary Button', 'gutener' ),
			'button-outline' => esc_html__( 'Border Button', 'gutener' ),
			'button-text'    => esc_html__( 'Text Only Button', 'gutener' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_post_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Button Border Radius (px)', 'gutener' ),
		'type'        => 'slider',
		'settings'    => 'post_button_border_radius',
		'section'     => 'blog_page_options',
		'transport'   => 'postMessage',
		'default'     => 0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_post_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Author', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_author',
		'section'     => 'blog_page_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Date', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_date',
		'section'     => 'blog_page_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Comments Link', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_comment',
		'section'     => 'blog_page_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide category', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_category',
		'section'     => 'blog_page_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Pagination', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_pagination',
		'section'     => 'blog_page_options',
		'default'     => false,
	) );

	//Single Post Options
	Kirki::add_section( 'single_post_options', array(
	    'title'          => esc_html__( 'Single Post', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '120',
	) );

	Kirki::add_field( 'gutener',  array(
		'label'       => esc_html__( 'Post Title', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'disable_single_post_title',
		'section'     => 'single_post_options',
		'default'     => 'enable_all_pages',
		'choices'     => array(
			'enable_all_pages'    => esc_html__( 'Enable in all', 'gutener' ),
			'disable_all_pages'   => esc_html__( 'Disable from all', 'gutener' ),
		),
	) );

	Kirki::add_field( 'gutener',  array(
		'label'       => esc_html__( 'Post Title Position', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'post_title_position',
		'section'     => 'single_post_options',
		'default'     => 'below_feature_image',
		'choices'     => array(
			'below_feature_image' => esc_html__( 'Below Feature Image', 'gutener' ),
			'above_feature_image' => esc_html__( 'Above Feature Image', 'gutener' ),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Feature Image', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'single_feature_image',
		'section'     => 'single_post_options',
		'default'     => 'show_in_all_pages',
		'choices' => array(
			'show_in_all_pages'    => esc_html__( 'Show in all Pages', 'gutener' ),
			'disable_in_all_pages' => esc_html__( 'Disable in all Pages', 'gutener' ),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Date', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_single_post_date',
		'section'     => 'single_post_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Comments Link', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_single_post_comment',
		'section'     => 'single_post_options',
		'default'     => false,
	) );
	
	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide category', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_single_post_category',
		'section'     => 'single_post_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Tag Links', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_single_post_tag_links',
		'section'     => 'single_post_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Author', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_single_post_author',
		'section'     => 'single_post_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Author Section Title', 'gutener' ),
		'type'        => 'text',
		'settings'    => 'single_post_author_title',
		'section'     => 'single_post_options',
		'default'     => esc_html__( 'About the Author', 'gutener' ),
		'active_callback' => array(
			array(
				'setting'  => 'hide_single_post_author',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Related Posts', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_related_posts',
		'section'     => 'single_post_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Related Posts Section Title', 'gutener' ),
		'type'        => 'text',
		'settings'    => 'related_posts_title',
		'section'     => 'single_post_options',
		'default'     => esc_html__( 'Related Posts', 'gutener' ),
		'active_callback' => array(
			array(
				'setting'  => 'hide_related_posts',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Related Posts Items', 'gutener' ),
		'description' => esc_html__( 'Total number of related posts to show.', 'gutener' ),
		'type'        => 'number',
		'settings'    => 'related_posts_count',
		'section'     => 'single_post_options',
		'default'     => 4,
		'choices' => array(
			'min' => '1',
			'max' => '12',
			'step' => '1',
		),
	) );

	//Pages Options
	Kirki::add_section( 'pages_options', array(
	    'title'          => esc_html__( 'Pages', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '130',
	) );

	Kirki::add_field( 'gutener',  array(
		'label'       => esc_html__( 'Page Title', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'disable_page_title',
		'section'     => 'pages_options',
		'default'     => 'disable_front_page',
		'choices'     => array(
			'enable_all_pages'    => esc_html__( 'Enable in all', 'gutener' ),
			'disable_all_pages'   => esc_html__( 'Disable from all', 'gutener' ),
			'disable_front_page'  => esc_html__( 'Disable from frontpage only', 'gutener' ),
		),
	) );

	Kirki::add_field( 'gutener',  array(
		'label'       => esc_html__( 'Page Title Position', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'page_title_position',
		'section'     => 'pages_options',
		'default'     => 'below_feature_image',
		'choices'     => array(
			'below_feature_image' => esc_html__( 'Below Feature Image', 'gutener' ),
			'above_feature_image' => esc_html__( 'Above Feature Image', 'gutener' ),
		),
	) );
	
	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Feature Image', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'page_feature_image',
		'section'     => 'pages_options',
		'default'     => 'show_in_all_pages',
		'choices' => array(
			'show_in_all_pages'    => esc_html__( 'Show in all Pages', 'gutener' ),
			'disable_in_all_pages' => esc_html__( 'Disable in all Pages', 'gutener' ),
			'disable_in_frontpage' => esc_html__( 'Disable in Frontpage only', 'gutener' ),
			'show_in_frontpage'    => esc_html__( 'Show in Frontpage only', 'gutener' ),
		),
	) );
	
	//404 Error Page
	Kirki::add_section( 'error404_options', array(
	    'title'          => esc_html__( '404 Page', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '140',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Image', 'gutener' ),
		'description' => esc_html__( 'Recommended image size 360x200 pixel.', 'gutener' ),
		'type'        => 'image',
		'settings'    => 'error404_image',
		'section'     => 'error404_options',
		'default'     => '',
	) );

	// Breadcrumbs
	Kirki::add_section( 'breadcrumbs_options', array(
	    'title'          => esc_html__( 'Breadcrumbs', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '150',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Breadcrumbs', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'breadcrumbs_controls',
		'section'     => 'breadcrumbs_options',
		'default'     => 'disable_in_all_pages',
		'choices'  => array(
			'disable_in_all_pages'     => esc_html__( 'Disable in all Pages Only', 'gutener' ),
			'disable_in_all_page_post' => esc_html__( 'Disable in all Pages & Posts', 'gutener' ),
			'show_in_all_page_post'    => esc_html__( 'Show in all Pages & Posts', 'gutener' ),
		)
	) );


	// Preloader Options
	Kirki::add_section( 'preloader_options', array(
	    'title'          => esc_html__( 'Preloader', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '160',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Preloading', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_preloader',
		'section'     => 'preloader_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Preloading Animations', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'preloader_animation',
		'section'     => 'preloader_options',
		'default'     => 'animation_one',
		'choices'  => array(
			'animation_white'     => esc_html__( 'White Color to Fade', 'gutener' ),
			'animation_black'     => esc_html__( 'Black Color to Fade', 'gutener' ),
			'animation_site_logo' => esc_html__( 'Site Logo', 'gutener' ),
			'animation_one'       => esc_html__( 'Animation One', 'gutener' ),
			'animation_two'       => esc_html__( 'Animation Two', 'gutener' ),
			'animation_three'     => esc_html__( 'Animation Three', 'gutener' ),
			'animation_four'      => esc_html__( 'Animation Four', 'gutener' ),
			'animation_five'      => esc_html__( 'Animation Five', 'gutener' ),
		),
	) );

	//Responsive
	Kirki::add_section( 'responsive_options', array(
	    'title'          => esc_html__( 'Responsive', 'gutener' ),
	    'description'    => esc_html__( 'These options will only apply to Mobile devices.
', 'gutener' ),
	    'panel'          => 'theme_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '170',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Header Notification Bar', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_notification_bar',
		'section'     => 'responsive_options',
		'default'     => true,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Fixed Header', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_fixed_header',
		'section'     => 'responsive_options',
		'default'     => true,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Main Slider / Banner', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_main_slider',
		'section'     => 'responsive_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Scroll Top', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_scroll_top',
		'section'     => 'responsive_options',
		'default'     => true,
	) );

	// Sub Panel
	// Blog Homepage Options
	Kirki::add_panel( 'blog_homepage_options', array(
	    'title' => esc_html__( 'Blog Homepage Options', 'gutener' ),
	    'panel' => 'theme_options',
	    'priority' => '10',
	) );

	// Highlighted Posts Options
	Kirki::add_section( 'highlight_posts_options', array(
	    'title'          => esc_html__( 'Highlighted Posts', 'gutener' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '10',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Highlighted Posts Section', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_highlight_posts_section',
		'section'      => 'highlight_posts_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Section Title', 'gutener' ),
		'type'        => 'text',
		'settings'    => 'highlight_posts_section_title',
		'section'     => 'highlight_posts_options',
		'default'     => '',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Section Title', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_highlight_posts_section_title',
		'section'      => 'highlight_posts_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Columns', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'highlight_posts_columns',
		'section'     => 'highlight_posts_options',
		'default'     => 'three_columns',
		'placeholder' => esc_attr__( 'Select category', 'gutener' ),
		'choices'  => array(
			'one_column'    => esc_html__( '1 Column', 'gutener' ),
			'two_columns'   => esc_html__( '2 Columns', 'gutener' ),
			'three_columns' => esc_html__( '3 Columns', 'gutener' ),
			'four_columns'  => esc_html__( '4 Columns', 'gutener' ),
		)
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Choose Category', 'gutener' ),
		'description' => esc_html__( 'Recent posts will show if any, category is not chosen.', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'highlight_posts_category',
		'section'     => 'highlight_posts_options',
		'default'     => 'Uncategorized',
		'placeholder' => esc_attr__( 'Select category', 'gutener' ), 
		'choices'     => gutener_get_post_categories()
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Highlighted Posts Overlay Opacity', 'gutener' ),
		'type'        => 'number',
		'settings'    => 'highlight_posts_overlay_opacity',
		'section'     => 'highlight_posts_options',
		'default'     => 4,
		'choices' => array(
			'min' => '0',
			'max' => '9',
			'step' => '1',
		)
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Post View Number', 'gutener' ),
		'description'  => esc_html__( 'Number of posts to show.', 'gutener' ),
		'type'         => 'number',
		'settings'     => 'highlight_posts_posts_number',
		'section'      => 'highlight_posts_options',
		'default'      => 6,
		'choices' => array(
			'min' => '1',
			'max' => '48',
			'step' => '1',
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Height (in px)', 'gutener' ),
		'description'  => esc_html__( 'These options will only apply to Desktop. Please click on below Desktop Icon to see changes.
		', 'gutener' ),
		'type'         => 'slider',
		'settings'     => 'highlight_posts_height',
		'section'      => 'highlight_posts_options',
		'transport'    => 'postMessage',
		'default'      => 250,
		'choices' => array(
			'min' => '100',
			'max' => '1200',
			'step' => '10',
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Background Image Size', 'gutener' ),
		'type'         => 'radio',
		'settings'     => 'highlight_posts_image_size',
		'section'      => 'highlight_posts_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'gutener' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'gutener' ),
			'norepeat' => esc_html__( 'No Repeat', 'gutener' ),
		),
	) );


	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Post Title', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_highlight_posts_title',
		'section'     => 'highlight_posts_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Post Title Divider', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_highlight_title_divider',
		'section'     => 'highlight_posts_options',
		'default'     => false,
		'active_callback' => array(
			array(
				'setting'  => 'disable_highlight_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
	    'type'        => 'custom',
	    'settings'    => 'separator' . rand(),
	    'section'     => 'highlight_posts_options',
	    'default'     => '<hr><strong>Responsive</strong><hr>',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Highlighted Posts on Mobile', 'gutener' ),
		'description'    => esc_html__( 'These options will only apply to Mobile devices.
		', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_mobile_highlight_posts',
		'section'      => 'highlight_posts_options',
		'default'      => false,
	) );

	// Latest Posts Options
	Kirki::add_section( 'latest_posts_options', array(
	    'title'          => esc_html__( 'Latest Posts', 'gutener' ),
	    'description'    => esc_html__( 'More options are available in Page/Post Option section.', 'gutener' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '20',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Disable Latest Posts Section', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_latest_posts_section',
		'section'     => 'latest_posts_options',
		'default'     => false,
	) );

	// Featured Posts Options
	Kirki::add_section( 'feature_posts_options', array(
	    'title'          => esc_html__( 'Featured Posts', 'gutener' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '30',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Featured Posts Section', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_feature_posts_section',
		'section'      => 'feature_posts_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Section Title', 'gutener' ),
		'type'        => 'text',
		'settings'    => 'feature_posts_section_title',
		'section'     => 'feature_posts_options',
		'default'     => '',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Section Title', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_feature_posts_section_title',
		'section'      => 'feature_posts_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Choose Category', 'gutener' ),
		'description' => esc_html__( 'Recent posts will show if any, category is not chosen.', 'gutener' ),
		'type'        => 'select',
		'settings'    => 'feature_posts_category',
		'section'     => 'feature_posts_options',
		'default'     => 'Uncategorized',
		'placeholder' => esc_attr__( 'Select category', 'gutener' ),
		'choices'     => gutener_get_post_categories()
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Slider Columns', 'gutener' ),
		'type'         => 'number',
		'settings'     => 'feature_posts_slides_show',
 		'section'      => 'feature_posts_options',
		'default'      => 3,
		'choices' => array(
			'min' => '2',
			'max' => '4',
			'step'=> '1',
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Arrows', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_feature_posts_arrows',
		'section'      => 'feature_posts_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Dots', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_feature_posts_dots',
		'section'      => 'feature_posts_options',
		'default'      => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Slider Auto Play', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_feature_posts_autoplay',
		'section'      => 'feature_posts_options',
		'default'      => true,
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Slider Auto Play Timeout ( in sec )', 'gutener' ),
		'type'         => 'number',
		'settings'     => 'feature_posts_autoplay_speed',
 		'section'      => 'feature_posts_options',
		'default'      => 4,
		'choices' => array(
			'min' => '1',
			'max' => '60',
			'step'=> '1',
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Slider Post View Number', 'gutener' ),
		'description'  => esc_html__( 'Number of posts to show.', 'gutener' ),
		'type'         => 'number',
		'settings'     => 'feature_posts_posts_number',
		'section'      => 'feature_posts_options',
		'default'      => 6,
		'choices' => array(
			'min' => '1',
			'max' => '20',
			'step' => '1',
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Post Image', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_feature_posts_image',
		'section'     => 'feature_posts_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Post category', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_feature_posts_category',
		'section'     => 'feature_posts_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Post Author', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_feature_posts_author',
		'section'     => 'feature_posts_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Post Date', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_feature_posts_date',
		'section'     => 'feature_posts_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Hide Post Comment', 'gutener' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_feature_posts_comment',
		'section'     => 'feature_posts_options',
		'default'     => false,
	) );

	Kirki::add_field( 'gutener', array(
	    'type'        => 'custom',
	    'settings'    => 'separator' . rand(),
	    'section'     => 'feature_posts_options',
	    'default'     => '<hr><strong>Responsive</strong><hr>',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Disable Featured Posts on Mobile', 'gutener' ),
		'description'    => esc_html__( 'These options will only apply to Mobile devices.
		', 'gutener' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_mobile_feature_posts',
		'section'      => 'feature_posts_options',
		'default'      => false,
	) );
}