<?php
/**
 * Blog Customizer Settings
 *
 * @package MediHealth WordPress theme
 */

	/**
	 * Section
	 */
	$wp_customize->add_section( 'medihealth_meta_section' , array(
		'title' 			=> __( 'Meta', 'medihealth' ),
		'priority' 			=> 6,
		'panel' 			=> 'medihealth_theme_options',
		) 
	);
	
		/**
		 * Blog Details Title
		 */
		$wp_customize->add_setting('medihealth_blog_details_title', array(
				'type'              	=> 'info_control',
				'capability'        	=> 'edit_theme_options',
				'sanitize_callback' 	=> 'sanitize_text_field',
			)
		);
		
		$wp_customize->add_control( new MediHealth_info( $wp_customize, 'medihealth_blog_details_title', array(
					'label' 		=> __('Post Meta', 'medihealth'),
					'section' 		=> 'medihealth_meta_section',
					'settings' 		=> 'medihealth_blog_details_title',
					'priority' 		=> 1,
				) 
			)
		);
		
			/**
			 * Blog Details - Date
			 */
			$wp_customize->add_setting( 'medihealth_blog_date', array(
					'default'           	=> '1',
					'sanitize_callback' 	=> 'medihealth_sanitize_checkbox',
				) 
			);

			$wp_customize->add_control( new MediHealth_Customizer_Toggle_Control( $wp_customize, 'medihealth_blog_date', array(
					'label'	   				=> __( 'Date', 'medihealth' ),
					'type'					=> 'checkbox',
					'section'  				=> 'medihealth_meta_section',
					'settings' 				=> 'medihealth_blog_date',
					'priority' 				=> 1,
					) 
				) 
			);			
			
			/**
			 * Blog Details - Admin
			 */
			$wp_customize->add_setting( 'medihealth_blog_user', array(
					'default'           	=> '1',
					'sanitize_callback' 	=> 'medihealth_sanitize_checkbox',
				) 
			);

			$wp_customize->add_control( new MediHealth_Customizer_Toggle_Control( $wp_customize, 'medihealth_blog_user', array(
					'label'	   				=> __( 'User', 'medihealth' ),
					'type'					=> 'checkbox',
					'section'  				=> 'medihealth_meta_section',
					'settings' 				=> 'medihealth_blog_user',
					'priority' 				=> 1,
					) 
				) 
			);			
			
			/**
			 * Blog Details - Comments
			 */
			$wp_customize->add_setting( 'medihealth_blog_comments', array(
					'default'           	=> '1',
					'sanitize_callback' 	=> 'medihealth_sanitize_checkbox',
				) 
			);

			$wp_customize->add_control( new MediHealth_Customizer_Toggle_Control( $wp_customize, 'medihealth_blog_comments', array(
					'label'	   				=> __( 'Comments', 'medihealth' ),
					'type'					=> 'checkbox',
					'section'  				=> 'medihealth_meta_section',
					'settings' 				=> 'medihealth_blog_comments',
					'priority' 				=> 1,
					) 
				) 
			);			
			
			/**
			 * Blog Details - Categories
			 */
			$wp_customize->add_setting( 'medihealth_blog_categories', array(
					'default'           	=> '1',
					'sanitize_callback' 	=> 'medihealth_sanitize_checkbox',
				) 
			);

			$wp_customize->add_control( new MediHealth_Customizer_Toggle_Control( $wp_customize, 'medihealth_blog_categories', array(
					'label'	   				=> __( 'Categories', 'medihealth' ),
					'type'					=> 'checkbox',
					'section'  				=> 'medihealth_meta_section',
					'settings' 				=> 'medihealth_blog_categories',
					'priority' 				=> 1,
					) 
				) 
			);			
			
			/**
			 * Blog Details - Tag
			 */
			$wp_customize->add_setting( 'medihealth_blog_tags', array(
					'default'           	=> '1',
					'sanitize_callback' 	=> 'medihealth_sanitize_checkbox',
				) 
			);

			$wp_customize->add_control( new MediHealth_Customizer_Toggle_Control( $wp_customize, 'medihealth_blog_tags', array(
					'label'	   				=> __( 'Tags', 'medihealth' ),
					'type'					=> 'checkbox',
					'section'  				=> 'medihealth_meta_section',
					'settings' 				=> 'medihealth_blog_tags',
					'priority' 				=> 1,
					) 
				) 
			);