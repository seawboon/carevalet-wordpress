<?php
/**
 * Selector Settings for the customizer
 *
 * @package MediHealth WordPress theme
 */

	/**
	 *	Topbar 
	 */
		//Timing
		$wp_customize->selective_refresh->add_partial( 'medihealth_contact_info_timings_details', array(
			'selector'            		=> '.header-section .contact-info .timings',
			'settings'           		=> 'medihealth_contact_info_timings_details',
			'render_callback'  			=> 'medihealth_contact_info_timings_details_callback',
		) );
		
		//Phone
		$wp_customize->selective_refresh->add_partial( 'medihealth_contact_info_phone_details', array(
			'selector'            		=> '.header-section .contact-info .phone',
			'settings'           	 	=> 'medihealth_contact_info_phone_details',
			'render_callback' 		 	=> 'medihealth_contact_info_phone_details_callback',
		) );	
		
		//Email
		$wp_customize->selective_refresh->add_partial( 'medihealth_contact_info_email_details', array(
			'selector'            		=> '.header-section .contact-info .email',
			'settings'           	 	=> 'medihealth_contact_info_email_details',
			'render_callback' 		 	=> 'medihealth_contact_info_email_details_callback',
		) );		
		
		//Appointment Button
		$wp_customize->selective_refresh->add_partial( 'medihealth_contact_info_appointment_text', array(
			'selector'            		=> '.header-section .appoint-btn .button',
			'settings'           	 	=> 'medihealth_contact_info_appointment_text',
			'render_callback' 		 	=> 'medihealth_contact_info_appointment_text_callback',
		) );

	/**
	 *	Service 
	 */
		//Title
		$wp_customize->selective_refresh->add_partial( 'medihealth_service_section_title', array(
			'selector'            		=> '.services-section .med_head h2',
			'settings'           		=> 'medihealth_service_section_title',
			'render_callback'  			=> 'medihealth_service_section_title_callback',
		) );
		
		//Description
		$wp_customize->selective_refresh->add_partial( 'medihealth_service_section_description', array(
			'selector'            		=> '.services-section .med_head p',
			'settings'           	 	=> 'medihealth_service_section_description',
			'render_callback' 		 	=> 'medihealth_service_section_description_callback',
		) );

	/**
	 *	Testimonial 
	 */
		//Title
		$wp_customize->selective_refresh->add_partial( 'medihealth_testimonial_title', array(
			'selector'            		=> '.patient-section .med_head h2',
			'settings'           		=> 'medihealth_testimonial_title',
			'render_callback'  			=> 'medihealth_testimonial_title_callback',
		) );	
		
	/**
	 *	Portfolio 
	 */
		//Title
		$wp_customize->selective_refresh->add_partial( 'medihealth_portfolio_section_title', array(
			'selector'            		=> '.portfolio-section .med_head h2',
			'settings'           		=> 'medihealth_portfolio_section_title',
			'render_callback'  			=> 'medihealth_portfolio_section_title_callback',
		) );

		//Description
		$wp_customize->selective_refresh->add_partial( 'medihealth_portfolio_section_description', array(
			'selector'            		=> '.portfolio-section .med_head p',
			'settings'           	 	=> 'medihealth_portfolio_section_description',
			'render_callback' 		 	=> 'medihealth_portfolio_section_description_callback',
		) );	
		
	/**
	 *	Blog 
	 */
		//Title
		$wp_customize->selective_refresh->add_partial( 'medihealth_blog_section_title', array(
			'selector'            		=> '.blog-section .med_head h2',
			'settings'           		=> 'medihealth_blog_section_title',
			'render_callback'  			=> 'medihealth_blog_section_title_callback',
		) );

		//Description
		$wp_customize->selective_refresh->add_partial( 'medihealth_blog_section_description', array(
			'selector'            		=> '.blog-section .med_head p',
			'settings'           	 	=> 'medihealth_blog_section_description',
			'render_callback' 		 	=> 'medihealth_blog_section_description_callback',
		) );

	/**
	 *	BottomBar
	 */
		//Copyright
		$wp_customize->selective_refresh->add_partial( 'medihealth_footer_copyright_text', array(
			'selector'            		=> '.footer-section .footer_copyright .copyright',
			'settings'           		=> 'medihealth_footer_copyright_text',
			'render_callback'  			=> 'medihealth_footer_copyright_text_callback',
		) );

		//Social Link
		$wp_customize->selective_refresh->add_partial( 'medihealth_contact_social_icon_url_1', array(
			'selector'            		=> '.footer-section .footer_copyright .footer_follow',
			'settings'           	 	=> 'medihealth_contact_social_icon_url_1',
			'render_callback' 		 	=> 'medihealth_contact_social_icon_url_1_callback',
		) );