<?php
/**
 * Blog Customizer Settings
 *
 * @package MediHealth WordPress theme
 */

	/**
	 * Section
	 */
	$wp_customize->add_section( 'medihealth_blog_section' , array(
		'title' 			=> __( 'Blog', 'medihealth' ),
		'priority' 			=> 6,
		'panel' 			=> 'medihealth_theme_options',
		) 
	);

		/**
		 * Blog Section
		 */
		$wp_customize->add_setting( 'medihealth_blog_setting', array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'medihealth_sanitize_checkbox',
			) 
		);

		$wp_customize->add_control( new MediHealth_Customizer_Toggle_Control( $wp_customize, 'medihealth_blog_setting', array(
				'label'	   				=> __( 'Enable Blog Section', 'medihealth' ),
				'type'					=> 'checkbox',
				'section'  				=> 'medihealth_blog_section',
				'settings' 				=> 'medihealth_blog_setting',
				'priority' 				=> 1,
				) 
			) 
		);

		/**
		 * Blog Title
		 */
		$wp_customize->add_setting('medihealth_blog_section_title', array(
				'default' 					=> __( 'Latest Blogs', 'medihealth' ),
				'sanitize_callback' 		=> 'sanitize_text_field'
			)
		);
		$wp_customize->add_control('medihealth_blog_section_title', array(
				'label' 					=> __( 'Title', 'medihealth' ),
				'section' 					=> 'medihealth_blog_section',
				'type'		 				=> 'text',
				'description'  				=> __('Enter the title for the blog section. (For front page only)', 'medihealth'),       
				'priority' 					=> 1,
				'active_callback'			=> 'medihealth_blog_setting_cb'
			)
		);


		/**
		 * Blog Description
		 */
		$wp_customize->add_setting('medihealth_blog_section_description', array(
				'default' 					=> __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'medihealth' ),
				'sanitize_callback' 		=> 'sanitize_textarea_field'
			)
		);
		$wp_customize->add_control('medihealth_blog_section_description', array(
				'label' 					=> __( 'Description', 'medihealth' ),
				'description'	   			=> __( 'Enter the description for blog section.', 'medihealth' ),
				'section' 					=> 'medihealth_blog_section',
				'type'						=> 'textarea',
				'priority' 					=> 2,
				'active_callback'			=> 'medihealth_blog_setting_cb'
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
					'label' 		=> __('Blog Details', 'medihealth'),
					'section' 		=> 'medihealth_blog_section',
					'settings' 		=> 'medihealth_blog_details_title',
					'priority' 		=> 2,
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
					'section'  				=> 'medihealth_blog_section',
					'settings' 				=> 'medihealth_blog_date',
					'priority' 				=> 2,
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
					'section'  				=> 'medihealth_blog_section',
					'settings' 				=> 'medihealth_blog_user',
					'priority' 				=> 2,
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
					'section'  				=> 'medihealth_blog_section',
					'settings' 				=> 'medihealth_blog_comments',
					'priority' 				=> 2,
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
					'section'  				=> 'medihealth_blog_section',
					'settings' 				=> 'medihealth_blog_categories',
					'priority' 				=> 2,
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
					'section'  				=> 'medihealth_blog_section',
					'settings' 				=> 'medihealth_blog_tags',
					'priority' 				=> 2,
					) 
				) 
			);
		