<?php
/**
 * Contact Customizer Options
 *
 * @package MediHealth WordPress theme
 */

	/**
	 * Section
	 */
	$wp_customize->add_section( 'medihealth_contact_panel' , array(
		'title' 			=> __( 'Contact', 'medihealth' ),
		'priority' 			=> 8,
		'panel' 			=> 'medihealth_theme_options',
		) 
	);	
	
			/**
			 * Contact Info Title
			 */
			$wp_customize->add_setting('medihealth_contact_info_title', array(
					'type'              	=> 'info_control',
					'capability'        	=> 'edit_theme_options',
					'sanitize_callback' 	=> 'sanitize_text_field',
				)
			);
			
			$wp_customize->add_control( new MediHealth_info( $wp_customize, 'medihealth_contact_info_title', array(
						'label' 		=> __('Contact Info', 'medihealth'),
						'section' 		=> 'medihealth_contact_panel',
						'settings' 		=> 'medihealth_contact_info_title',
						'priority' 		=> 1,
					) 
				)
			);

				/**
				 * TopBar
				 */
				$wp_customize->add_setting( 'medihealth_topbar_setting', array(
						'default'           	=> '',
						'sanitize_callback' 	=> 'medihealth_sanitize_checkbox',
					) 
				);

				$wp_customize->add_control( new MediHealth_Customizer_Toggle_Control( $wp_customize, 'medihealth_topbar_setting', array(
						'label'	   				=> __( 'Enable TopBar', 'medihealth' ),
						'type'					=> 'checkbox',
						'section'  				=> 'medihealth_contact_panel',
						'settings' 				=> 'medihealth_topbar_setting',
						'priority' 				=> 1,
						) 
					) 
				);

				/**
				 * Info Timings Details
				 */
				$wp_customize->add_setting('medihealth_contact_info_timings_details', array(
						'default' 					=> __( 'Open 24 Hours', 'medihealth' ),
						'sanitize_callback' 		=> 'sanitize_text_field'
					)
				);
				$wp_customize->add_control('medihealth_contact_info_timings_details', array(
						'label' 					=> __( 'Timings Details', 'medihealth' ),
						'section' 					=> 'medihealth_contact_panel',
						'type'		 				=> 'text',       
						'priority' 					=> 1,
						'active_callback'			=> 'medihealth_topbar_info_cb'
					)
				);

				/**
				 * Info Phone Details
				 */
				$wp_customize->add_setting('medihealth_contact_info_phone_details', array(
						'default' 					=> __( '+1 203 356 3596', 'medihealth' ),
						'sanitize_callback' 		=> 'sanitize_text_field'
					)
				);
				$wp_customize->add_control('medihealth_contact_info_phone_details', array(
						'label' 					=> __( 'Phone Details', 'medihealth' ),
						'section' 					=> 'medihealth_contact_panel',
						'type'		 				=> 'text',       
						'priority' 					=> 1,
						'active_callback'			=> 'medihealth_topbar_info_cb'
					)
				);		


			/**
			 * Info Email Details
			 */
			$wp_customize->add_setting('medihealth_contact_info_email_details', array(
					'default' 					=> '',
					'sanitize_callback' 		=> 'sanitize_text_field'
				)
			);
			$wp_customize->add_control('medihealth_contact_info_email_details', array(
					'label' 					=> __( 'Email Details', 'medihealth' ),
					'section' 					=> 'medihealth_contact_panel',
					'type'		 				=> 'text',       
					'priority' 					=> 1,
					'active_callback'			=> 'medihealth_topbar_info_cb'
				)
			);

				/**
				 * Info Appointment Button Text
				 */
				$wp_customize->add_setting('medihealth_contact_info_appointment_text', array(
						'default' 					=> __( 'Book Appointment', 'medihealth' ),
						'sanitize_callback' 		=> 'sanitize_text_field'
					)
				);
				$wp_customize->add_control('medihealth_contact_info_appointment_text', array(
						'label' 					=> __( 'Appointment Button Text', 'medihealth' ),
						'section' 					=> 'medihealth_contact_panel',
						'type'		 				=> 'text',       
						'priority' 					=> 1,
						'active_callback'			=> 'medihealth_topbar_info_cb'
					)
				);
				
				/**
				 * Info Appointment Button Link
				 */
				$wp_customize->add_setting('medihealth_contact_info_appointment_link', array(
						'default' 					=> __( '#', 'medihealth' ),
						'sanitize_callback' 		=> 'sanitize_text_field'
					)
				);
				$wp_customize->add_control('medihealth_contact_info_appointment_link', array(
						'label' 					=> __( 'Appointment Button Link', 'medihealth' ),
						'section' 					=> 'medihealth_contact_panel',
						'type'		 				=> 'text',       
						'priority' 					=> 1,
						'active_callback'			=> 'medihealth_topbar_info_cb'
					)
				);
				
				/**
				 * Info Appointment Button Link Target
				 */
				$wp_customize->add_setting( 'medihealth_contact_info_appointment_target', array(
						'default'           	=> __('1', 'medihealth'),
						'sanitize_callback' 	=> 'medihealth_sanitize_checkbox',
					) 
				);

				$wp_customize->add_control( new MediHealth_Customizer_Toggle_Control( $wp_customize, 'medihealth_contact_info_appointment_target', array(
						'label'	   				=> __( 'Link Target', 'medihealth' ),
						'description'			=> __( 'Enable to open link in new tab', 'medihealth' ),
						'type'					=> 'checkbox',
						'section'  				=> 'medihealth_contact_panel',
						'settings' 				=> 'medihealth_contact_info_appointment_target',
						'priority' 				=> 1,
						'active_callback'		=> 'medihealth_topbar_info_cb'
						) 
					) 
				);

			/**
			 * Social Media Title
			 */
			$wp_customize->add_setting('medihealth_social_media_title', array(
					'type'              	=> 'info_control',
					'capability'        	=> 'edit_theme_options',
					'sanitize_callback' 	=> 'sanitize_text_field',
				)
			);
			
			$wp_customize->add_control( new MediHealth_info( $wp_customize, 'medihealth_social_media_title', array(
						'label' 		=> __('Footer Social Media', 'medihealth'),
						'section' 		=> 'medihealth_contact_panel',
						'settings' 		=> 'medihealth_social_media_title',
						'priority' 		=> 2,
					) 
				)
			);	

				/**
				 * Footer Links
				 */
				$wp_customize->add_setting( 'medihealth_footer_icon_settings', array(
						'default'           	=> '',
						'sanitize_callback' 	=> 'medihealth_sanitize_checkbox',
					) 
				);

				$wp_customize->add_control( new MediHealth_Customizer_Toggle_Control( $wp_customize, 'medihealth_footer_icon_settings', array(
						'label'	   				=> __( 'Enable Footer Icons', 'medihealth' ),
						'type'					=> 'checkbox',
						'section'  				=> 'medihealth_contact_panel',
						'settings' 				=> 'medihealth_footer_icon_settings',
						'priority' 				=> 2,
						) 
					) 
				);

				/**
				 * Social Media - Icon 1 URL
				 */
				$wp_customize->add_setting('medihealth_contact_social_icon_url_1', array(
						'default' 					=> '',
						'sanitize_callback' 		=> 'sanitize_text_field'
					)
				);
				$wp_customize->add_control('medihealth_contact_social_icon_url_1', array(
						'label' 					=> __( 'Facebook URL', 'medihealth' ),
						'section' 					=> 'medihealth_contact_panel',
						'type'		 				=> 'text',       
						'priority' 					=> 2,
						'active_callback'			=> 'medihealth_footer_icon_cb'
					)
				);

				//----------------------------------------------------------------------------------//

				/**
				 * Social Media - Icon 2 URL
				 */
				$wp_customize->add_setting('medihealth_contact_social_icon_url_2', array(
						'default' 					=> '',
						'sanitize_callback' 		=> 'sanitize_text_field'
					)
				);
				$wp_customize->add_control('medihealth_contact_social_icon_url_2', array(
						'label' 					=> __( 'Instagram URL', 'medihealth' ),
						'section' 					=> 'medihealth_contact_panel',
						'type'		 				=> 'text',       
						'priority' 					=> 2,
						'active_callback'			=> 'medihealth_footer_icon_cb'
					)
				);

				//----------------------------------------------------------------------------------//

				/**
				 * Social Media - Icon 3 URL
				 */
				$wp_customize->add_setting('medihealth_contact_social_icon_url_3', array(
						'default' 					=> '',
						'sanitize_callback' 		=> 'sanitize_text_field'
					)
				);
				$wp_customize->add_control('medihealth_contact_social_icon_url_3', array(
						'label' 					=> __( 'YouTube URL', 'medihealth' ),
						'section' 					=> 'medihealth_contact_panel',
						'type'		 				=> 'text',       
						'priority' 					=> 2,
						'active_callback'			=> 'medihealth_footer_icon_cb'
					)
				);

				//----------------------------------------------------------------------------------//

				/**
				 * Social Media - Icon 4 URL
				 */
				$wp_customize->add_setting('medihealth_contact_social_icon_url_4', array(
						'default' 					=> '',
						'sanitize_callback' 		=> 'sanitize_text_field'
					)
				);
				$wp_customize->add_control('medihealth_contact_social_icon_url_4', array(
						'label' 					=> __( 'Twitter URL', 'medihealth' ),
						'section' 					=> 'medihealth_contact_panel',
						'type'		 				=> 'text',       
						'priority' 					=> 2,
						'active_callback'			=> 'medihealth_footer_icon_cb'
					)
				);

				//----------------------------------------------------------------------------------//

				/**
				 * Social Media - Icon 5 URL
				 */
				$wp_customize->add_setting('medihealth_contact_social_icon_url_5', array(
						'default' 					=> '',
						'sanitize_callback' 		=> 'sanitize_text_field'
					)
				);
				$wp_customize->add_control('medihealth_contact_social_icon_url_5', array(
						'label' 					=> __( 'LinkedIn URL', 'medihealth' ),
						'section' 					=> 'medihealth_contact_panel',
						'type'		 				=> 'text',       
						'priority' 					=> 2,
						'active_callback'			=> 'medihealth_footer_icon_cb'
					)
				);