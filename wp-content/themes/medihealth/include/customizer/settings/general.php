<?php
/**
 * General Customizer Settings
 *
 * @package MediHealth WordPress theme
 */

	/**
	 * Section
	 */
	$wp_customize->add_section( 'medihealth_general_section' , array(
		'title' 			=> __( 'General', 'medihealth' ),
		'priority' 			=> 1,
		'panel' 			=> 'medihealth_theme_options',
	) );

		/**
		 * Breadcrumb
		 */
		$wp_customize->add_setting( 'medihealth_breadcrumb_setting', array(
				'default'           	=> '1',
				'sanitize_callback' 	=> 'medihealth_sanitize_checkbox',
			) 
		);

		$wp_customize->add_control( new MediHealth_Customizer_Toggle_Control( $wp_customize, 'medihealth_breadcrumb_setting', array(
				'label'	   				=> __( 'Enable Breadcrumb', 'medihealth' ),
				'type'					=> 'checkbox',
				'section'  				=> 'medihealth_general_section',
				'settings' 				=> 'medihealth_breadcrumb_setting',
				'priority' 				=> 1,
				) 
			) 
		);

		/**
		 * Page Layout
		 */
		$wp_customize->add_setting( 'medihealth_page_layout', array(
			'default'           	=> __('fullwidth', 'medihealth'),
			'sanitize_callback' 	=> 'medihealth_sanitize_select',
			) 
		);

		$wp_customize->add_control( new MediHealth_Customizer_Select_Control( $wp_customize, 'medihealth_page_layout', array(
				'label'	   				=> __( 'Page Layout', 'medihealth' ),
				'type'           		=> 'radio',
				'section'  				=> 'medihealth_general_section',
				'settings' 				=> 'medihealth_page_layout',
				'priority' 				=> 1,
				'choices' 				=> array(
					'leftsidebar'  		=> __( 'Left Sidebar', 'medihealth' ),
					'fullwidth' 		=> __( 'Full Width', 'medihealth' ),
					'rightsidebar' 		=> __( 'Right Sidebar', 'medihealth' ),
				),
				) 
			) 
		);

		/**
		 * Single Page Layout
		 */
		$wp_customize->add_setting( 'medihealth_single_page_layout', array(
			'default'           	=> __('fullwidth', 'medihealth'),
			'sanitize_callback' 	=> 'medihealth_sanitize_select',
			) 
		);

		$wp_customize->add_control( new MediHealth_Customizer_Select_Control( $wp_customize, 'medihealth_single_page_layout', array(
				'label'	   				=> __( 'Single Page Layout', 'medihealth' ),
				'type'           		=> 'radio',
				'section'  				=> 'medihealth_general_section',
				'settings' 				=> 'medihealth_single_page_layout',
				'priority' 				=> 1,
				'choices' 				=> array(
					'leftsidebar'  		=> __( 'Left Sidebar', 'medihealth' ),
					'fullwidth' 		=> __( 'Full Width', 'medihealth' ),
					'rightsidebar' 		=> __( 'Right Sidebar', 'medihealth' ),
				),
				) 
			) 
		);

		/**
		 * Archive Page Layout
		 */
		$wp_customize->add_setting( 'medihealth_archive_page_layout', array(
			'default'           	=> __('rightsidebar', 'medihealth'),
			'sanitize_callback' 	=> 'medihealth_sanitize_select',
			) 
		);

		$wp_customize->add_control( new MediHealth_Customizer_Select_Control( $wp_customize, 'medihealth_archive_page_layout', array(
				'label'	   				=> __( 'Archive Pages Layout', 'medihealth' ),
				'type'           		=> 'radio',
				'section'  				=> 'medihealth_general_section',
				'settings' 				=> 'medihealth_archive_page_layout',
				'priority' 				=> 1,
				'choices' 				=> array(
					'leftsidebar'  		=> __( 'Left Sidebar', 'medihealth' ),
					'fullwidth' 		=> __( 'Full Width', 'medihealth' ),
					'rightsidebar' 		=> __( 'Right Sidebar', 'medihealth' ),
				),
				) 
			) 
		);

		/**
		 * nable Static Page = MOVED TO STATIC PAGE static_front_page
		 */
		$wp_customize->add_setting( 'medihealth_static_page_setting', array(
				'default'      		=> 'active',
				'sanitize_callback' => 'medihealth_sanitize_select'
			)
		);
		$wp_customize->add_control('medihealth_static_page_setting', array(
				'type'     		 => 'radio',
				'label'   	 	 => __('Static Page Content', 'medihealth'),
				'description'    => __('Show content on static Front Page', 'medihealth'),
				'section'  		 => 'static_front_page',
				'priority' 		 => 45,
				'choices'  		 => array(
					'active'       => __( 'Show', 'medihealth' ),
					'inactive'     => __( 'Hide', 'medihealth' ),
				),
			)
		);