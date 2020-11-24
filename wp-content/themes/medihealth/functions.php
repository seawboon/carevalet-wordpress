<?php
/**
 * MediHealth Theme Functions
 */

//MediHealth Theme URL
define("MEDIHEALTH_THEME_URL", get_template_directory_uri());
define("MEDIHEALTH_THEME_DIR", get_template_directory());

//MediHealth Theme Option Panel CSS and JS Backend
add_action('wp_enqueue_scripts','medihealth_backend_resources');

// On theme activation add defaults theme settings and data
add_action( 'after_setup_theme', 'medihealth_default_theme_options_setup' );

function medihealth_default_theme_options_setup() {
	// Load text domain for translation-ready
	//load_theme_textdomain( 'medihealth', MEDIHEALTH_THEME_DIR . '/languages' );

	// Add Theme support Title Tag
	add_theme_support( 'title-tag' );

	// Logo
	add_theme_support( 'custom-logo', array(
		'width'			=> 250,
		'height'		=> 250,
		'flex-width'	=> true,
		'flex-height'	=> true,
	));

	// Set the content_width with 900
	if ( ! isset( $content_width ) ) $content_width = 900;

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'medihealth_custom_background_args', 
		array(
			'default-color' => 'fff',
			'default-image' => '',
		) 
	));

	//Featured Image
	add_theme_support( 'post-thumbnails' ); 

	//RSS Feed
	add_theme_support( 'automatic-feed-links' );

	//Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	//Image Cropping
	add_image_size( 'medihealth_blog_300', 450, 225 ); 
	
	// woo-commerce theme support
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );	

}

//Include Customizer File
require get_template_directory() . '/include/customizer/customizer.php';

//Add Meta Box To Custom Post
add_action( 'add_meta_boxes','medihealth_admin_add_meta_box_' );
add_action( 'wp_ajax_media_slider_js',  'ajax_portfolio' );

//Save Meta Box Data
add_action( 'save_post', 'medihealth_save_icon_settings_');
add_action( 'save_post', 'medihealth_save_designation_settings_');

/**
 * MediHealth - Load Theme Option Panel CSS and JS Start
 */
function medihealth_backend_resources(){
	// MediHealth theme CSS
	wp_enqueue_style( 'medihealth-bootstrap-min-css', trailingslashit( get_template_directory_uri() ) . '/css/bootstrap.min.css');
	wp_enqueue_style( 'medihealth-all-min-css', trailingslashit( get_template_directory_uri() ) . '/css/all.min.css');
	wp_enqueue_style( 'medihealth-animate-css', trailingslashit( get_template_directory_uri() ) . '/css/animate-3.7.0.css');
	wp_enqueue_style( 'medihealth-swiper-min-css', trailingslashit( get_template_directory_uri() ) . '/css/swiper.min.css');
	wp_enqueue_style( 'medihealth-font-awesome-min-css', trailingslashit( get_template_directory_uri() ) . '/css/font-awesome.min.css');
	wp_enqueue_style('style', get_stylesheet_uri());

	wp_enqueue_style( 'medihealth-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i', false );

	wp_enqueue_script('jquery');
	wp_enqueue_script('medihealth-screen-reader-text.js', trailingslashit( get_template_directory_uri() ) . '/js/screen-reader-text.js', array('jquery'), '', false);
	wp_enqueue_script('medihealth-menu.js', trailingslashit( get_template_directory_uri() ) . '/js/menu.js', array('jquery'), '', true);
	wp_enqueue_script('medihealth-mobile-menu.js', trailingslashit( get_template_directory_uri() ) . '/js/mobile-menu.js', array('jquery'), '', true);
	wp_enqueue_script('medihealth-sections-scripts.js', trailingslashit( get_template_directory_uri() ) . '/js/sections-scripts.js');
	wp_enqueue_script('medihealth-jquery-easing-1-3-js', trailingslashit( get_template_directory_uri() ) . '/js/jquery.easing.1.3.js');
	wp_enqueue_script('medihealth-bootstrap-min-js', trailingslashit( get_template_directory_uri() ) . '/js/bootstrap.min.js');
	wp_enqueue_script('medihealth-swiper-min-js', trailingslashit( get_template_directory_uri() ) . '/js/swiper.min.js');
	wp_enqueue_script('medihealth-isotope-pkgd-min-js', trailingslashit( get_template_directory_uri() ) . '/js/isotope.pkgd.min.js', array('jquery'), '', false);
	
	//search form (search icon) CSS/JS
	wp_enqueue_script('medihealth-search-js', trailingslashit( get_template_directory_uri() ) . '/js/search-form.js','', true);
	wp_enqueue_style( 'medihealth-search-css', trailingslashit( get_template_directory_uri() ) .  '/css/search-form.css');

}
//MediHealth - Load Theme Option Panel CSS and JS End

//Register area for custom menu
add_action( 'init', 'medihealth_menu' );
function medihealth_menu() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu','medihealth' ) );
}

/**
 * MediHealth Widgets Start
 */
require get_template_directory() . '/include/widget/sidebars.php';
//MediHealth Widgets End

//MediHealth add meta box start
function medihealth_admin_add_meta_box_() {
	// Syntax: add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
	add_meta_box( 'medihealth_post_icon', __('Icon', 'medihealth'), 'medihealth_post_icon', 'post', 'side', 'default', NULL);
	add_meta_box( 'medihealth_page_icon', __('Icon', 'medihealth'), 'medihealth_page_icon', 'page', 'side', 'default', NULL);
	add_meta_box( 'medihealth_post_designation', __('Testimonial Designation', 'medihealth'), 'medihealth_post_designation', 'post', 'side', 'default', NULL);
	add_meta_box( 'medihealth_page_designation', __('Testimonial Designation', 'medihealth'), 'medihealth_page_designation', 'page', 'side', 'default', NULL);
}

//MediHealth Icon meta box function start
function medihealth_post_icon($post) { require_once('include/meta/medihealth-icon-meta.php'); }
function medihealth_page_icon($post) { require_once('include/meta/medihealth-icon-meta.php'); }
//MediHealth Icon meta box function End

//MediHealth Designation meta box function start
function medihealth_post_designation($post) { require_once('include/meta/medihealth-designation-meta.php'); }
function medihealth_page_designation($post) { require_once('include/meta/medihealth-designation-meta.php'); }
//MediHealth Designation meta box function End

/**
 * Save Post Meta Setting Start
 */
function medihealth_save_icon_settings_($post_id) {
	if(isset($_POST['medihealth_icons_settings_nonce'])) {
		//Post/Page Slide Icon
		if (!wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['medihealth_icons_settings_nonce'] ) ), 'medihealth_save_icon_settings' ) ) { 
			print 'Sorry, your nonce did not verify.';
			exit;
		} else {
			if(isset($_POST['medihealth_service_icon'])) {
				$medihealth_icon = sanitize_text_field( wp_unslash( $_POST['medihealth_service_icon'] ) );
				update_post_meta($post_id, 'medihealth_service_icon', $medihealth_icon);
			}
		}
	}
}

function medihealth_save_designation_settings_($post_id) {
	if(isset($_POST['medihealth_designations_settings_nonce'])) {
		//Post/Page Designation
		 if (!wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['medihealth_designations_settings_nonce'] ) ), 'medihealth_save_designation_settings' ) ) {
			print 'Sorry, your nonce did not verify.';
			exit;
		} else {
			if(isset($_POST['medihealth_testimonail_designation'])) {
				$medihealth_designation = sanitize_text_field( wp_unslash( $_POST['medihealth_testimonail_designation'] ) );
				update_post_meta($post_id, 'medihealth_testimonail_designation', $medihealth_designation);
			}
		}
	}
}
// Save All Post Meta Setting End

/**
 * Add excerpt limit
 */
function medihealth_custom_excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . '...';
	} else {
		$excerpt = implode(" ", $excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
	return $excerpt;
}

/**
 * Implement the Theme Custom Header feature.
 */
require get_template_directory() . '/include/custom-header.php';

/**
 * Skip Link
 *
 */
add_action('wp_head', 'medihealth_skip_to_content');
function medihealth_skip_to_content(){
	echo '<a class="skip-link screen-reader-text" href="#main-content">'. esc_html__( 'Skip to content', 'medihealth' ) .'</a>';
}

/**
 * Register Custom Navigation Walker
 */
function medihealth_register_navwalker(){
	require_once get_template_directory() . '/include/medihealth-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'medihealth_register_navwalker' );



/**
 * Customizer comments display
 */
require_once( 'custom-comments.php' );

/**
 * Upsell 
 */
require get_template_directory() . '/include/custom-edition/upgrade/class-customize.php';