<?php

function gutener_medical_kirki_fields(){

	/**
	* If kirki is not installed do not run the kirki fields
	*/

	if ( !class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Primary Color', 'gutener-medical' ),
		'type'         => 'color',
		'settings'     => 'site_primary_color',
		'section'      => 'colors',
		'default'      => '#130947',
		'priority'     => '50',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Button Background Color', 'gutener-medical' ),
		'type'         => 'color',
		'settings'     => 'notification_bar_button_background_color',
		'section'      => 'notification_bar_options',
		'default'      => '#130947',
		'active_callback' => array(
			array(
				'setting'  => 'disable_notification_bar',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Button Text Color', 'gutener-medical' ),
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
		'label'        => esc_html__( 'Post Category Color', 'gutener-medical' ),
		'type'         => 'color',
		'settings'     => 'blog_post_category_color',
		'section'      => 'blog_page_options',
		'default'      => '#130947',
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Site Description', 'gutener-medical' ),
		'type'         => 'typography',
		'settings'     => 'site_description_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
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
		'label'        => esc_html__( 'Main Menu', 'gutener-medical' ),
		'type'         => 'typography',
		'settings'     => 'main_menu_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
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
		'label'        => esc_html__( 'Body', 'gutener-medical' ),
		'type'         => 'typography',
		'settings'     => 'body_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
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
		'label'        => esc_html__( 'Site Title', 'gutener-medical' ),
		'type'         => 'typography',
		'settings'     => 'site_title_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'font-size'      => '32px',
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
		'label'        => esc_html__( 'Disable Site Tagline Border', 'gutener-medical' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_site_tagline_border',
		'section'      => 'title_tagline',
		'priority'     => '30',
		'default'      => true,
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Height (in px)', 'gutener-medical' ),
		'description' => esc_html__( 'These options will only apply to Desktop. Please click on below Desktop Icon to see changes.
		', 'gutener-medical' ),
		'type'        => 'slider',
		'settings'    => 'header_image_height',
		'section'     => 'header_options',
		'transport'   => 'postMessage',
		'default'     => 120,
		'choices'     => array(
			'min'  => 0,
			'max'  => 1500,
			'step' => 5,
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Header Layouts', 'gutener-medical' ),
		'type'        => 'radio-image',
		'settings'    => 'header_layout',
		'section'     => 'header_options',
		'default'     => 'header_two',
		'choices'  => array(
			'header_one'   => get_template_directory_uri() . '/assets/images/header-layout-1.png',
			'header_two'   => get_template_directory_uri() . '/assets/images/header-layout-2.png',
			'header_three' => get_template_directory_uri() . '/assets/images/header-layout-3.png',
		)
	) );

	Kirki::add_field( 'gutener', array(
		'label'        => esc_html__( 'Header Button Text', 'gutener-medical' ),
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
		'label'       => esc_html__( 'Columns', 'gutener-medical' ),
		'type'        => 'select',
		'settings'    => 'highlight_posts_columns',
		'section'     => 'highlight_posts_options',
		'default'     => 'four_columns',
		'placeholder' => esc_attr__( 'Select category', 'gutener-medical' ),
		'choices'  => array(
			'one_column'    => esc_html__( '1 Column', 'gutener-medical' ),
			'two_columns'   => esc_html__( '2 Columns', 'gutener-medical' ),
			'three_columns' => esc_html__( '3 Columns', 'gutener-medical' ),
			'four_columns'  => esc_html__( '4 Columns', 'gutener-medical' ),
		)
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Archive Post Layouts', 'gutener-medical' ),
		'description' => esc_html__( 'Grid / List / Single', 'gutener-medical' ),
		'type'        => 'radio-image',
		'settings'    => 'archive_post_layout',
		'section'     => 'global_layout_options',
		'default'     => 'list',
		'choices'  => array(
			'grid'   => get_template_directory_uri() . '/assets/images/grid-layout.png',
			'list'   => get_template_directory_uri() . '/assets/images/list-layout.png',
			'single' => get_template_directory_uri() . '/assets/images/single-layout.png',
		)
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Footer Layouts', 'gutener-medical' ),
		'type'        => 'radio-image',
		'settings'    => 'footer_layout',
		'section'     => 'footer_options',
		'default'     => 'footer_two',
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
		'label'       => esc_html__( 'Section Title', 'gutener-medical' ),
		'type'        => 'text',
		'settings'    => 'highlight_posts_section_title',
		'section'     => 'highlight_posts_options',
		'default'     => '',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Section Title', 'gutener-medical' ),
		'type'        => 'text',
		'settings'    => 'feature_posts_section_title',
		'section'     => 'feature_posts_options',
		'default'     => '',
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Author Section Title', 'gutener-medical' ),
		'type'        => 'text',
		'settings'    => 'single_post_author_title',
		'section'     => 'single_post_options',
		'default'     => '',
		'active_callback' => array(
			array(
				'setting'  => 'hide_single_post_author',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'gutener', array(
		'label'       => esc_html__( 'Related Posts Section Title', 'gutener-medical' ),
		'type'        => 'text',
		'settings'    => 'related_posts_title',
		'section'     => 'single_post_options',
		'default'     => '',
		'active_callback' => array(
			array(
				'setting'  => 'hide_related_posts',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );
}
add_action( 'init', 'gutener_medical_kirki_fields', 999, 1 );