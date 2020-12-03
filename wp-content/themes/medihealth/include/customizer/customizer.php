<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MediHealth_Customizer' ) ) :

	/**
	 * The MediHealth Customizer class
	 */
	class MediHealth_Customizer {

		/**
		 * Setup class.
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this, 'custom_controls' ) );
			add_action( 'customize_register', array( $this, 'controls_helpers' ) );
			add_action( 'customize_register', array( $this, 'customizer_selector' ) );
			add_action( 'customize_register', array( $this, 'customizer_options' ) );
		}

		/**
		 * Add custom controls
		 */
		public function custom_controls( $wp_customize ) {

			// Path
			$dir = MEDIHEALTH_THEME_DIR . '/include/customizer/controls/';

			// Load customize control classes
			require_once( $dir . 'toggle/toggle-control.php' 							);
			require_once( $dir . 'range-slider/range-slider-control.php' 				);
			require_once( $dir . 'select/select-control.php' 							);
			
		}

		/**
		 * Add customizer helpers
		 */
		public function controls_helpers() {
			require_once( MEDIHEALTH_THEME_DIR .'/include/customizer/customizer-helpers.php' );
			require_once( MEDIHEALTH_THEME_DIR .'/include/customizer/callbacks.php' );
		}

		/**
		 * Input field settings code (title + description)
		 */
		function medihealth_repeater_sanitize($input){
			$input_decoded = json_decode($input,true);

			if(!empty($input_decoded)) {
				foreach ($input_decoded as $boxk => $box ){
					foreach ($box as $key => $value){
							$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
					}
				}
				return json_encode($input_decoded);
			}
			return $input;
		}
		
		/**
		 * Add customizer Selector
		 */
		public function customizer_selector( $wp_customize ) {
			require_once( MEDIHEALTH_THEME_DIR .'/include/customizer/customizer-selector.php' );
		}
		
		/**
		 * Core modules
		 */
		public function customizer_options( $wp_customize ) {
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			/**
			 * MediHealth Theme Options Panel
			 */
			$wp_customize->add_panel( 'medihealth_theme_options' , array(
				'title' 			=> esc_html__( 'MediHealth Options', 'medihealth' ),
				'priority' 			=> 200,
			) );
			
				/**
				 *	Load customizer options
				 */

				$dir = MEDIHEALTH_THEME_DIR .'/include/customizer/settings/';

				// Customizer files array
				$files = array(
					'general',
					'footer',
					'contact',
					'slider',
					'service', 
					'testimonial',
					'portfolio', 
					'blog',
					'meta-settings',
					);
				foreach ( $files as $key ) { require( $dir . $key .'.php' ); }
		}
	}

endif;

return new MediHealth_Customizer();