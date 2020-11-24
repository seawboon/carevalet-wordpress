<?php
/**
* Load widget components
*
* @since Gutener 1.0.0
*/
require_once get_parent_theme_file_path( '/inc/widgets/class-base-widget.php' );
require_once get_parent_theme_file_path( '/inc/widgets/latest-posts.php' );
require_once get_parent_theme_file_path( '/inc/widgets/author.php' );
/**
 * Register widgets
 *
 * @since Gutener 1.0.0
 */
/**
* Load all the widgets
* @since Gutener 1.0.0
*/
function gutener_register_widget() {

	$widgets = array(
		'Gutener_Latest_Posts_Widget',
		'Gutener_Author_Widget',
	);

	foreach ( $widgets as $key => $value) {
    	register_widget( $value );
	}
}
add_action( 'widgets_init', 'gutener_register_widget' );