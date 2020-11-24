<?php
/**
 * Footer Customizer Settings
 *
 * @package MediHealth WordPress theme
 */

	/**
	 * Section
	 */
	$wp_customize->add_section( 'medihealth_footer_panel' , array(
		'title' 			=> __( 'Footer', 'medihealth' ),
		'priority' 			=> 10,
		'panel' 			=> 'medihealth_theme_options',
	) );

		/**
		 * Footer Bottom Text
		 */
		$wp_customize->add_setting('medihealth_footer_copyright_text', array(
				'default' 					=> __( '', 'medihealth' ),
				'sanitize_callback' 		=> 'sanitize_text_field'
			)
		);
		$wp_customize->add_control('medihealth_footer_copyright_text', array(
				'label' 					=> __( 'Copyright Text', 'medihealth' ),
				'section' 					=> 'medihealth_footer_panel',
				'type'		 				=> 'text',
				'description'  				=> __('Enter footer bottom text.', 'medihealth'),       
				'priority' 					=> 3,
			)
		);