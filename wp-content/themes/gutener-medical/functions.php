<?php
/**
 * Theme functions and definitions
 *
 * @package Gutener Medical
 */

require get_stylesheet_directory() . '/inc/customizer/customizer.php';
require get_stylesheet_directory() . '/inc/customizer/loader.php';

if ( ! function_exists( 'gutener_medical_enqueue_styles' ) ) :
	/**
	 * @since Gutener Medical 1.0.0
	 */
	function gutener_medical_enqueue_styles() {
		wp_enqueue_style( 'gutener-medical-style-parent', get_template_directory_uri() . '/style.css' );
	}

endif;
add_action( 'wp_enqueue_scripts', 'gutener_medical_enqueue_styles', 1 );

function gutener_medical_setup() {
	remove_theme_support( 'custom-background' );
}
add_action( 'after_setup_theme', 'gutener_medical_setup', 99 );
