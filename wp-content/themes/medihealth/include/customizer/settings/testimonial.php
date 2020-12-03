<?php
/**
 * Testimonial Customizer Settings
 *
 * @package MediHealth WordPress theme
 */

	/**
	 * Section
	 */
	$wp_customize->add_section( 'medihealth_testimonial_section' , array(
		'title' 			=> __( 'Testimonial', 'medihealth' ),
		'priority' 			=> 4,
		'panel' 			=> 'medihealth_theme_options',
		) 
	);

		/**
		 * Testimonial Section
		 */
		$wp_customize->add_setting( 'medihealth_testimonial_setting', array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'medihealth_sanitize_checkbox',
			) 
		);

		$wp_customize->add_control( new MediHealth_Customizer_Toggle_Control( $wp_customize, 'medihealth_testimonial_setting', array(
				'label'	   				=> __( 'Enable Testimonial Section', 'medihealth' ),
				'type'					=> 'checkbox',
				'section'  				=> 'medihealth_testimonial_section',
				'settings' 				=> 'medihealth_testimonial_setting',
				'priority' 				=> 1,
				) 
			) 
		);

		/**
		 * Testimonial Title
		 */
		$wp_customize->add_setting('medihealth_testimonial_title', array(
				'default' 					=> __( 'TESTIMONIALS', 'medihealth' ),
				'sanitize_callback' 		=> 'sanitize_text_field'
			)
		);
		$wp_customize->add_control('medihealth_testimonial_title', array(
				'label' 					=> __( 'Title', 'medihealth' ),
				'section' 					=> 'medihealth_testimonial_section',
				'type'		 				=> 'text',
				'description'  				=> __('Enter the title for the testimonial section. (For front page only)', 'medihealth'),       
				'priority' 					=> 1,
				'active_callback'			=> 'medihealth_testimonial_setting_pp',
			)
		);

		/**
		 * Testimonial - Number of Testimonials
		 */
		$wp_customize->add_setting( 'medihealth_testimonial_items_setting', array(
			'default'           	=> __( '2', 'medihealth'),
			'sanitize_callback' 	=> 'medihealth_sanitize_number',
			) 
		);

		$wp_customize->add_control( new MediHealth_Customizer_Range_Slider_Control( $wp_customize, 'medihealth_testimonial_items_setting', array(
				'label'	   				=> __( 'Number Of Testimonials', 'medihealth' ),
				'description'	   		=> __( 'Maximum is 2.', 'medihealth' ),
				'type'           		=> 'number',
				'section'  				=> 'medihealth_testimonial_section',
				'settings' 				=> 'medihealth_testimonial_items_setting',
				'priority' 				=> 2,
				'input_attrs' 			=> array(
					'min'				=> __( '1', 'medihealth'),
					'max' 				=> __( '2', 'medihealth'),
					'step' 				=> __( '1', 'medihealth'),
				),
				'active_callback'		=> 'medihealth_testimonial_setting_pp',
				) 
			) 
		);

		/**
		 * testimonial - Content Type
		 */
		$wp_customize->add_setting( 'medihealth_testimonial_content_setting', array(
			'default'           	=> __('testimonial_post', 'medihealth'),
			'sanitize_callback' 	=> 'medihealth_sanitize_select',
			) 
		);

		$wp_customize->add_control( new MediHealth_Customizer_Select_Control( $wp_customize, 'medihealth_testimonial_content_setting', array(
				'label'	   				=> __( 'Content Type', 'medihealth' ),
				'type'           		=> 'radio',
				'section'  				=> 'medihealth_testimonial_section',
				'settings' 				=> 'medihealth_testimonial_content_setting',
				'priority' 				=> 2,
				'choices' 				=> array(
					'testimonial_post'  	=> __( 'Post', 'medihealth' ),
					'testimonial_page' 		=> __( 'Page', 'medihealth' ),
				),
				'active_callback'		=> 'medihealth_testimonial_setting_pp',
				) 
			) 
		);

		// Post - 1
		$wp_customize->add_setting('medihealth_testimonial_post_1', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'medihealth_dropdown_pages'
			)
		);

		$wp_customize->add_control('medihealth_testimonial_post_1', array(
			'label'       		=> __('Select Post #1', 'medihealth'),
			'section'     		=> 'medihealth_testimonial_section',
			'settings'    		=> 'medihealth_testimonial_post_1',
			'type'        		=> 'select',
			'priority' 			=> 2,
			'choices'	  		=>  medihealth_dropdown_posts(),
			'active_callback' 	=> 'medihealth_testimonial_post_1_pp',
			)
		);

		// Post - 2
		$wp_customize->add_setting('medihealth_testimonial_post_2', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'medihealth_dropdown_pages'
			)
		);

		$wp_customize->add_control('medihealth_testimonial_post_2', array(
			'label'       		=> __('Select Post #2', 'medihealth'),
			'section'     		=> 'medihealth_testimonial_section',
			'settings'    		=> 'medihealth_testimonial_post_2',
			'type'        		=> 'select',
			'priority' 			=> 2,
			'choices'	  		=>  medihealth_dropdown_posts(),
			'active_callback' 	=> 'medihealth_testimonial_post_2_pp',
			)
		);



		// Page - 1
		$wp_customize->add_setting('medihealth_testimonial_page_1', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'medihealth_dropdown_pages'
			)
		);

		$wp_customize->add_control('medihealth_testimonial_page_1', array(
			'label'       		=> __('Select Page #1', 'medihealth'),
			'section'     		=> 'medihealth_testimonial_section',
			'settings'    		=> 'medihealth_testimonial_page_1',
			'type'        		=> 'dropdown-pages',
			'priority' 			=> 2,
			'active_callback' 	=> 'medihealth_testimonial_page_1_pp',
			)
		);


		// Page - 2
		$wp_customize->add_setting('medihealth_testimonial_page_2', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'medihealth_dropdown_pages'
			)
		);

		$wp_customize->add_control('medihealth_testimonial_page_2', array(
			'label'       		=> __('Select Page #2', 'medihealth'),
			'section'     		=> 'medihealth_testimonial_section',
			'settings'    		=> 'medihealth_testimonial_page_2',
			'type'        		=> 'dropdown-pages',
			'priority' 			=> 2,
			'active_callback' 	=> 'medihealth_testimonial_page_2_pp',
			)
		);