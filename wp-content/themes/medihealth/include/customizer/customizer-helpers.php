<?php
/**
 * Active callback functions for the customizer
 *
 * @package MediHealth WordPress theme
 */

/*-------------------------------------------------------------------------------*/
/* [ Core ]
/*-------------------------------------------------------------------------------*/

/* Slider Callbacks */
function medihealth_slider_setting_pp ( $control ) { 
	return true === ( $control->manager->get_setting( 'medihealth_slider_setting' )->value() == '1' ); 
}

	// Post
	function medihealth_slider_post_1_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_slider_content_setting' )->value() == 'slider_post' && 
			$control->manager->get_setting( 'medihealth_slider_items_setting' )->value() >= '1' &&
			$control->manager->get_setting( 'medihealth_slider_setting' )->value() == '1' 
		); 
	}
	function medihealth_slider_post_2_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_slider_content_setting' )->value() == 'slider_post' && 
			$control->manager->get_setting( 'medihealth_slider_items_setting' )->value() >= '2' &&
			$control->manager->get_setting( 'medihealth_slider_setting' )->value() == '1' 
		); 
	}
	function medihealth_slider_post_3_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_slider_content_setting' )->value() == 'slider_post' && 
			$control->manager->get_setting( 'medihealth_slider_items_setting' )->value() >= '3' &&
			$control->manager->get_setting( 'medihealth_slider_setting' )->value() == '1' 
		); 
	}

	// Page
	function medihealth_slider_page_1_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_slider_content_setting' )->value() == 'slider_page' && 
			$control->manager->get_setting( 'medihealth_slider_items_setting' )->value() >= '1' &&
			$control->manager->get_setting( 'medihealth_slider_setting' )->value() == '1' 
		); 
	}
	function medihealth_slider_page_2_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_slider_content_setting' )->value() == 'slider_page' && 
			$control->manager->get_setting( 'medihealth_slider_items_setting' )->value() >= '2' &&
			$control->manager->get_setting( 'medihealth_slider_setting' )->value() == '1' 
		); 
	}
	function medihealth_slider_page_3_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_slider_content_setting' )->value() == 'slider_page' && 
			$control->manager->get_setting( 'medihealth_slider_items_setting' )->value() >= '3' &&
			$control->manager->get_setting( 'medihealth_slider_setting' )->value() == '1' 
		); 
	}


/* Service Callbacks */
function medihealth_service_setting_pp ( $control ) { 
	return true === ( $control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' ); 
}

	// Post
	function medihealth_service_post_1_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_service_content_setting' )->value() == 'service_post' && 
			$control->manager->get_setting( 'medihealth_service_items_setting' )->value() >= '1' &&
			$control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' 
		); 
	}
	function medihealth_service_post_2_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_service_content_setting' )->value() == 'service_post' && 
			$control->manager->get_setting( 'medihealth_service_items_setting' )->value() >= '2' &&
			$control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' 
		); 
	}
	function medihealth_service_post_3_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_service_content_setting' )->value() == 'service_post' && 
			$control->manager->get_setting( 'medihealth_service_items_setting' )->value() >= '3' &&
			$control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' 
		); 
	}
	function medihealth_service_post_4_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_service_content_setting' )->value() == 'service_post' && 
			$control->manager->get_setting( 'medihealth_service_items_setting' )->value() >= '4' &&
			$control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' 
		); 
	}
	function medihealth_service_post_5_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_service_content_setting' )->value() == 'service_post' && 
			$control->manager->get_setting( 'medihealth_service_items_setting' )->value() >= '5' &&
			$control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' 
		); 
	}
	function medihealth_service_post_6_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_service_content_setting' )->value() == 'service_post' && 
			$control->manager->get_setting( 'medihealth_service_items_setting' )->value() >= '6' &&
			$control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' 
		); 
	}

	// Page
	function medihealth_service_page_1_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_service_content_setting' )->value() == 'service_page' && 
			$control->manager->get_setting( 'medihealth_service_items_setting' )->value() >= '1' &&
			$control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' 
		); 
	}
	function medihealth_service_page_2_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_service_content_setting' )->value() == 'service_page' && 
			$control->manager->get_setting( 'medihealth_service_items_setting' )->value() >= '2' &&
			$control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' 
		); 
	}
	function medihealth_service_page_3_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_service_content_setting' )->value() == 'service_page' && 
			$control->manager->get_setting( 'medihealth_service_items_setting' )->value() >= '3' &&
			$control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' 
		); 
	}
	function medihealth_service_page_4_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_service_content_setting' )->value() == 'service_page' && 
			$control->manager->get_setting( 'medihealth_service_items_setting' )->value() >= '4' &&
			$control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' 
		); 
	}
	function medihealth_service_page_5_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_service_content_setting' )->value() == 'service_page' && 
			$control->manager->get_setting( 'medihealth_service_items_setting' )->value() >= '5' &&
			$control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' 
		); 
	}
	function medihealth_service_page_6_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_service_content_setting' )->value() == 'service_page' && 
			$control->manager->get_setting( 'medihealth_service_items_setting' )->value() >= '6' &&
			$control->manager->get_setting( 'medihealth_service_setting' )->value() == '1' 
		); 
	}

/* Testimonail Callbacks */
function medihealth_testimonial_setting_pp ( $control ) { 
	return true === ( $control->manager->get_setting( 'medihealth_testimonial_setting' )->value() == '1' ); 
}

	// Post
	function medihealth_testimonial_post_1_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_testimonial_content_setting' )->value() == 'testimonial_post' && 
			$control->manager->get_setting( 'medihealth_testimonial_items_setting' )->value() >= '1' &&
			$control->manager->get_setting( 'medihealth_testimonial_setting' )->value() == '1' 
		); 
	}
	function medihealth_testimonial_post_2_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_testimonial_content_setting' )->value() == 'testimonial_post' && 
			$control->manager->get_setting( 'medihealth_testimonial_items_setting' )->value() >= '2' &&
			$control->manager->get_setting( 'medihealth_testimonial_setting' )->value() == '1' 
		); 
	}
	function medihealth_testimonial_post_3_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_testimonial_content_setting' )->value() == 'testimonial_post' && 
			$control->manager->get_setting( 'medihealth_testimonial_items_setting' )->value() >= '3' &&
			$control->manager->get_setting( 'medihealth_testimonial_setting' )->value() == '1' 
		); 
	}
	function medihealth_testimonial_post_4_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_testimonial_content_setting' )->value() == 'testimonial_post' && 
			$control->manager->get_setting( 'medihealth_testimonial_items_setting' )->value() >= '4' &&
			$control->manager->get_setting( 'medihealth_testimonial_setting' )->value() == '1' 
		); 
	}

	// Page
	function medihealth_testimonial_page_1_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_testimonial_content_setting' )->value() == 'testimonial_page' && 
			$control->manager->get_setting( 'medihealth_testimonial_items_setting' )->value() >= '1' &&
			$control->manager->get_setting( 'medihealth_testimonial_setting' )->value() == '1' 
		); 
	}
	function medihealth_testimonial_page_2_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_testimonial_content_setting' )->value() == 'testimonial_page' && 
			$control->manager->get_setting( 'medihealth_testimonial_items_setting' )->value() >= '2' &&
			$control->manager->get_setting( 'medihealth_testimonial_setting' )->value() == '1' 
		); 
	}
	function medihealth_testimonial_page_3_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_testimonial_content_setting' )->value() == 'testimonial_page' && 
			$control->manager->get_setting( 'medihealth_testimonial_items_setting' )->value() >= '3' &&
			$control->manager->get_setting( 'medihealth_testimonial_setting' )->value() == '1' 
		); 
	}
	function medihealth_testimonial_page_4_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_testimonial_content_setting' )->value() == 'testimonial_page' && 
			$control->manager->get_setting( 'medihealth_testimonial_items_setting' )->value() >= '4' &&
			$control->manager->get_setting( 'medihealth_testimonial_setting' )->value() == '1' 
		); 
	}


/* Portfolio Callbacks */
function medihealth_portfolio_setting_cb ( $control ) { 
	return true === ( $control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' ); 
}

	// Post
	function medihealth_portfolio_post_1_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_portfolio_content_setting' )->value() == 'portfolio_post' && 
			$control->manager->get_setting( 'medihealth_portfolio_items_setting' )->value() >= '1' &&
			$control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' 
		); 
	}
	function medihealth_portfolio_post_2_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_portfolio_content_setting' )->value() == 'portfolio_post' && 
			$control->manager->get_setting( 'medihealth_portfolio_items_setting' )->value() >= '2' &&
			$control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' 
		); 
	}
	function medihealth_portfolio_post_3_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_portfolio_content_setting' )->value() == 'portfolio_post' && 
			$control->manager->get_setting( 'medihealth_portfolio_items_setting' )->value() >= '3' &&
			$control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' 
		); 
	}
	function medihealth_portfolio_post_4_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_portfolio_content_setting' )->value() == 'portfolio_post' && 
			$control->manager->get_setting( 'medihealth_portfolio_items_setting' )->value() >= '4' &&
			$control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' 
		); 
	}
	function medihealth_portfolio_post_5_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_portfolio_content_setting' )->value() == 'portfolio_post' && 
			$control->manager->get_setting( 'medihealth_portfolio_items_setting' )->value() >= '5' &&
			$control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' 
		); 
	}
	function medihealth_portfolio_post_6_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_portfolio_content_setting' )->value() == 'portfolio_post' && 
			$control->manager->get_setting( 'medihealth_portfolio_items_setting' )->value() >= '6' &&
			$control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' 
		); 
	}

	// Page
	function medihealth_portfolio_page_1_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_portfolio_content_setting' )->value() == 'portfolio_page' && 
			$control->manager->get_setting( 'medihealth_portfolio_items_setting' )->value() >= '1' &&
			$control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' 
		); 
	}
	function medihealth_portfolio_page_2_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_portfolio_content_setting' )->value() == 'portfolio_page' && 
			$control->manager->get_setting( 'medihealth_portfolio_items_setting' )->value() >= '2' &&
			$control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' 
		); 
	}
	function medihealth_portfolio_page_3_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_portfolio_content_setting' )->value() == 'portfolio_page' && 
			$control->manager->get_setting( 'medihealth_portfolio_items_setting' )->value() >= '3' &&
			$control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' 
		); 
	}
	function medihealth_portfolio_page_4_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_portfolio_content_setting' )->value() == 'portfolio_page' && 
			$control->manager->get_setting( 'medihealth_portfolio_items_setting' )->value() >= '4' &&
			$control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' 
		); 
	}
	function medihealth_portfolio_page_5_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_portfolio_content_setting' )->value() == 'portfolio_page' && 
			$control->manager->get_setting( 'medihealth_portfolio_items_setting' )->value() >= '5' &&
			$control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' 
		); 
	}
	function medihealth_portfolio_page_6_pp ( $control ) { 
		return true === ( 
			$control->manager->get_setting( 'medihealth_portfolio_content_setting' )->value() == 'portfolio_page' && 
			$control->manager->get_setting( 'medihealth_portfolio_items_setting' )->value() >= '6' &&
			$control->manager->get_setting( 'medihealth_portfolio_setting' )->value() == '1' 
		); 
	}

/* Blog Callbacks */
function medihealth_blog_setting_cb ( $control ) { 
	return true === ( $control->manager->get_setting( 'medihealth_blog_setting' )->value() == '1' ); 
}

/* Contact Callbacks */
function medihealth_topbar_info_cb ( $control ) { 
	return true === ( $control->manager->get_setting( 'medihealth_topbar_setting' )->value() == '1' ); 
}
function medihealth_footer_icon_cb ( $control ) { 
	return true === ( $control->manager->get_setting( 'medihealth_footer_icon_settings' )->value() == '1' ); 
}



// Extras
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

	wp_enqueue_script( 'medihealth_customizer_header', get_template_directory_uri() . '/include/customizer/assets/customizer/customizer.js', array( 'customize-preview' ), '20151215', true );
	wp_enqueue_style('customizr', MEDIHEALTH_THEME_URL .'/css/customizer.css');
	//Titles
	class MediHealth_info extends WP_Customize_Control {
		public $type = 'info';
		public $label = '';
		public function render_content() { 
		?>
			<h3 style="margin-top:30px;border:1px solid #00b3cc;padding:5px;background-color:#00b3cc;color:#fff;text-align:center;"><?php echo esc_html( $this->label ); ?></h3>
		<?php
		}
	} 

	//Font Awesome Link
	class MediHealth_Font_Awesome_Link extends WP_Customize_Control {
		public $type = 'font-awesome-link';
		public $label = '';
		public function render_content() { 
		?>
			<p><i><?php echo esc_html__('Get your icon code from fontawesome', 'medihealth' ); ?> <a href="<?php echo esc_url('https://fontawesome.com/v4.7.0/cheatsheet/'); ?>" target="_new"><?php echo esc_html__('Cheatsheet', 'medihealth' ); ?></a>.<i></p>
		<?php
		}
	}
