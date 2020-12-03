<?php
/**
 * Sanitization Callbacks
 * 
 * @package MediHealth WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Dropdown Pages
 */
if ( ! function_exists( 'medihealth_dropdown_pages' ) ) :
	function medihealth_dropdown_pages( $page_id, $setting ) {
	  // Ensure $input is an absolute integer.
	  $page_id = absint( $page_id );
	  
	  // If $page_id is an ID of a published page, return it; otherwise, return the default.
	  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}
endif;

/**
 * Dropdown Post
 */
if ( ! function_exists( 'medihealth_dropdown_posts' ) ) :

	/**
	 * Post Dropdown.
	 *
	 * @since 1.0.0	 *
	 */
	function medihealth_dropdown_posts() {

		$posts = get_posts( array( 'numberposts' => -1 ) );
		$choices = array();
		wp_reset_postdata();
		$choices[0] = esc_html__( '--Select--', 'medihealth' );
		foreach ( $posts as $post ) {
			$choices[$post->ID] = $post->post_title;
		}
		return $choices;
	}

endif;


/**
 * Checkbox sanitization callback
 *
 * @since 1.2.1
 */
function medihealth_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Image sanitization callback
 *
 * @since 1.2.1
 */
function medihealth_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}

/**
 * Number sanitization callback
 *
 * @since 1.2.1
 */
function medihealth_sanitize_number( $val ) {
	return is_numeric( $val ) ? $val : 0;
}

/**
 * Select sanitization callback
 *
 * @since 1.2.1
 */
function medihealth_sanitize_select( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 *
 *	Customizer Selector Reneder Callbacks
 *
*/