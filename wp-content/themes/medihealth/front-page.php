<?php 
/**
 * Theme HomePage
 *
 * @package MediHealth WordPress theme
 */
 
get_header();

if ( 'posts' == get_option( 'show_on_front' ) ) {
	get_template_part('index');
} else {
	
	/* Theme Sections */
	$slider_section = get_theme_mod('medihealth_slider_setting', '');
	$service_section = get_theme_mod('medihealth_service_setting', '');
	$testimonial_section = get_theme_mod('medihealth_testimonial_setting', '');
	$portfolio_section = get_theme_mod('medihealth_portfolio_setting', '');
	$blog_section = get_theme_mod('medihealth_blog_setting', '');
	$medihealth_static_page_setting = get_theme_mod('medihealth_static_page_setting', 'active');

	/* Main */
	if($slider_section == '1') { 
		get_template_part('sections/index', 'slider'); 
	}
	if($service_section == '1') { 
		get_template_part('sections/index', 'service'); 
	}
	if($testimonial_section == '1') { 
		get_template_part('sections/index', 'testimonials'); 
	}
	if($portfolio_section == '1') { 
		get_template_part('sections/index', 'portfolio'); 
	}
	if($blog_section == '1') { 
		get_template_part('sections/index', 'blog'); 
	}

	if($medihealth_static_page_setting == 'active') {
		get_template_part('page');
	}
}
get_footer();