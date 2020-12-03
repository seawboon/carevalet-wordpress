<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if ( !function_exists( 'derma_care_parent_css' ) ):
    function derma_care_parent_css() {
        wp_enqueue_style( 'medihealth_css', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'medihealth-bootstrap-min-css','medihealth-all-min-css','medihealth-animate-css','medihealth-swiper-min-css','medihealth-font-awesome-min-css' ) );
		// enqueue script
    }
endif;
add_action( 'wp_enqueue_scripts', 'derma_care_parent_css', 10 );
         
if ( !function_exists( 'derma_care_configurator_css' ) ):
    function derma_care_configurator_css() {
        if ( !file_exists( trailingslashit( get_stylesheet_directory() ) . '/css/bootstrap.min.css' ) ):
            wp_deregister_style( 'medihealth-bootstrap-min-css' );
            wp_register_style( 'medihealth-bootstrap-min-css', trailingslashit( get_template_directory_uri() ) . '/css/bootstrap.min.css' );
        endif;
        if ( !file_exists( trailingslashit( get_stylesheet_directory() ) . '/css/all.min.css' ) ):
            wp_deregister_style( 'medihealth-all-min-css' );
            wp_register_style( 'medihealth-all-min-css', trailingslashit( get_template_directory_uri() ) . '/css/all.min.css' );
        endif;
        if ( !file_exists( trailingslashit( get_stylesheet_directory() ) . '/css/animate-3.7.0.css' ) ):
            wp_deregister_style( 'medihealth-animate-css' );
            wp_register_style( 'medihealth-animate-css', trailingslashit( get_template_directory_uri() ) . '/css/animate-3.7.0.css' );
        endif;
        if ( !file_exists( trailingslashit( get_stylesheet_directory() ) . '/css/font-awesome.min.css' ) ):
            wp_deregister_style( 'medihealth-font-awesome-min-css' );
            wp_register_style( 'medihealth-font-awesome-min-css', trailingslashit( get_template_directory_uri() ) . '/css/font-awesome.min.css' );
        endif;
    }
endif;
add_action( 'wp_enqueue_scripts', 'derma_care_configurator_css', 10 );

//Remove section
function derma_care_customize_register() {
	global $wp_customize;
	//$wp_customize->remove_control( 'medihealth_static_page_setting' );  //Modify this line as needed
	//$wp_customize->remove_section( 'medihealth_blog_section' );  //Modify this line as needed
	//$wp_customize->remove_section( 'medihealth_contact_panel' );  //Modify this line as needed
	//$wp_customize->remove_section( 'medihealth_meta_section' );  //Modify this line as needed
	//$wp_customize->remove_section( 'medihealth_portfolio_section' );  //Modify this line as needed
	//$wp_customize->remove_section( 'medihealth_service_section' );  //Modify this line as needed
	//$wp_customize->remove_section( 'medihealth_slider_section' );  //Modify this line as needed
	//$wp_customize->remove_section( 'medihealth_testimonial_section' );  //Modify this line as needed
}
add_action( 'customize_register', 'derma_care_customize_register', 14 );
// END ENQUEUE PARENT ACTION
