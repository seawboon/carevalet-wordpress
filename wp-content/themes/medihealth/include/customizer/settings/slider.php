<?php
/**
 * Slider Customizer Settings
 *
 * @package MediHealth WordPress theme
 */

	/**
	 * Section
	 */
	$wp_customize->add_section( 'medihealth_slider_section' , array(
		'title' 			=> __( 'Slider', 'medihealth' ),
		'priority' 			=> 1,
		'panel' 			=> 'medihealth_theme_options',
		) 
	);

		/**
		 * Slider Section
		 */
		$wp_customize->add_setting( 'medihealth_slider_setting', array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'medihealth_sanitize_checkbox',
			) 
		);

		$wp_customize->add_control( new MediHealth_Customizer_Toggle_Control( $wp_customize, 'medihealth_slider_setting', array(
				'label'	   				=> __( 'Enable Featured Slider', 'medihealth' ),
				'type'					=> 'checkbox',
				'section'  				=> 'medihealth_slider_section',
				'settings' 				=> 'medihealth_slider_setting',
				'priority' 				=> 1,
				) 
			) 
		);


		/**
		 * Slider - Number of Slides
		 */
		$wp_customize->add_setting( 'medihealth_slider_items_setting', array(
			'default'           	=> __( '2', 'medihealth'),
			'sanitize_callback' 	=> 'medihealth_sanitize_number',
			) 
		);

		$wp_customize->add_control( new MediHealth_Customizer_Range_Slider_Control( $wp_customize, 'medihealth_slider_items_setting', array(
				'label'	   				=> __( 'Number Of Slides', 'medihealth' ),
				'description'	   		=> __( 'Maximum is 3.', 'medihealth' ),
				'type'           		=> 'number',
				'section'  				=> 'medihealth_slider_section',
				'settings' 				=> 'medihealth_slider_items_setting',
				'priority' 				=> 1,
				'input_attrs' 			=> array(
					'min'				=> __( '1', 'medihealth'),
					'max' 				=> __( '3', 'medihealth'),
					'step' 				=> __( '1', 'medihealth'),
				),
				'active_callback'		=> 'medihealth_slider_setting_pp',
				) 
			) 
		);

		/**
		 * Slider - Content Type
		 */
		$wp_customize->add_setting( 'medihealth_slider_content_setting', array(
			'default'           	=> __('slider_post', 'medihealth'),
			'sanitize_callback' 	=> 'medihealth_sanitize_select',
			) 
		);

		$wp_customize->add_control( new MediHealth_Customizer_Select_Control( $wp_customize, 'medihealth_slider_content_setting', array(
				'label'	   				=> __( 'Content Type', 'medihealth' ),
				'type'           		=> 'radio',
				'section'  				=> 'medihealth_slider_section',
				'settings' 				=> 'medihealth_slider_content_setting',
				'priority' 				=> 1,
				'choices' 				=> array(
					'slider_post'  		=> __( 'Post', 'medihealth' ),
					'slider_page' 		=> __( 'Page', 'medihealth' ),
				),
				'active_callback'		=> 'medihealth_slider_setting_pp',
				) 
			) 
		);

		// Post - 1
		$wp_customize->add_setting('medihealth_slider_post_1', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'medihealth_dropdown_pages'
			)
		);

		$wp_customize->add_control('medihealth_slider_post_1', array(
			'label'       		=> __('Select Post #1', 'medihealth'),
			'section'     		=> 'medihealth_slider_section',
			'settings'    		=> 'medihealth_slider_post_1',
			'type'        		=> 'select',
			'choices'	  		=>  medihealth_dropdown_posts(),
			'active_callback' 	=> 'medihealth_slider_post_1_pp',
			)
		);

		// Post - 2
		$wp_customize->add_setting('medihealth_slider_post_2', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'medihealth_dropdown_pages'
			)
		);

		$wp_customize->add_control('medihealth_slider_post_2', array(
			'label'       		=> __('Select Post #2', 'medihealth'),
			'section'     		=> 'medihealth_slider_section',
			'settings'    		=> 'medihealth_slider_post_2',
			'type'        		=> 'select',
			'choices'	  		=>  medihealth_dropdown_posts(),
			'active_callback' 	=> 'medihealth_slider_post_2_pp',
			)
		);

		// Post - 3
		$wp_customize->add_setting('medihealth_slider_post_3', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'medihealth_dropdown_pages'
			)
		);

		$wp_customize->add_control('medihealth_slider_post_3', array(
			'label'       		=> __('Select Post #3', 'medihealth'),
			'section'     		=> 'medihealth_slider_section',
			'settings'    		=> 'medihealth_slider_post_3',
			'type'        		=> 'select',
			'choices'	  		=>  medihealth_dropdown_posts(),
			'active_callback' 	=> 'medihealth_slider_post_3_pp',
			)
		);

		// Page - 1
		$wp_customize->add_setting('medihealth_slider_page_1', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'medihealth_dropdown_pages'
			)
		);

		$wp_customize->add_control('medihealth_slider_page_1', array(
			'label'       		=> __('Select Page #1', 'medihealth'),
			'section'     		=> 'medihealth_slider_section',
			'settings'    		=> 'medihealth_slider_page_1',
			'type'        		=> 'dropdown-pages',
			'active_callback' 	=> 'medihealth_slider_page_1_pp',
			)
		);

		// Page - 2
		$wp_customize->add_setting('medihealth_slider_page_2', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'medihealth_dropdown_pages'
			)
		);

		$wp_customize->add_control('medihealth_slider_page_2', array(
			'label'       		=> __('Select Page #2', 'medihealth'),
			'section'     		=> 'medihealth_slider_section',
			'settings'    		=> 'medihealth_slider_page_2',
			'type'        		=> 'dropdown-pages',
			'active_callback' 	=> 'medihealth_slider_page_2_pp',
			)
		);

		// Page - 3
		$wp_customize->add_setting('medihealth_slider_page_3', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'medihealth_dropdown_pages'
			)
		);

		$wp_customize->add_control('medihealth_slider_page_3', array(
			'label'       		=> __('Select Page #3', 'medihealth'),
			'section'     		=> 'medihealth_slider_section',
			'settings'    		=> 'medihealth_slider_page_3',
			'type'        		=> 'dropdown-pages',
			'active_callback' 	=> 'medihealth_slider_page_3_pp',
			)
		);