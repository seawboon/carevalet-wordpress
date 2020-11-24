<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Gutener
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function gutener_body_classes( $classes ) {
	// Adds a class of theme skin
	if( get_theme_mod( 'skin_select', 'default' ) == 'dark' ){
		$classes[] = 'dark-skin';
	}elseif( get_theme_mod( 'skin_select', 'default' ) == 'blackwhite' ){
		$classes[] = 'black-white-skin';
	}else{
		$classes[] = 'default-skin';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}
	if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' ){
		$classes[] = 'content-no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'gutener_body_classes' );


if( !function_exists( 'gutener_get_icon_by_post_format' ) ):
/**
* Gives a css class for post format icon
*
* @return string
* @since Gutener 1.0.0
*/
function gutener_get_icon_by_post_format(){
    $icons = array(
        'standard' => 'fas fa-thumbtack',
        'sticky'   => 'fas fa-thumbtack',
        'aside'    => 'fas fa-file-alt',
        'image'    => 'fas fa-image',
        'video'    => 'far fa-play-circle',
        'quote'    => 'fas fa-quote-right',
        'link'     => 'fas fa-link',
        'gallery'  => 'fas fa-images',
        'status'   => 'fas fa-comment',
        'audio'    => 'fas fa-volume-up',
        'chat'     => 'fas fa-comments',
    );
    $format = get_post_format();
    if( empty( $format ) ){
        $format = 'standard';
    }
    return apply_filters( 'gutener_post_format_icon', $icons[ $format ] );
}
endif;

/**
 * Page/Post title in frontpage and blog
 */
function gutener_page_title_display() {
	if ( is_singular() || ( !is_home() && is_front_page() ) ): ?>
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	<?php elseif ( is_archive() ) : 
		the_archive_title( '<h1 class="page-title">', '</h1>' );
	elseif ( is_search() ) : ?>
		<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'gutener' ), get_search_query() ); ?></h1>
	<?php elseif ( is_404() ) :
		echo '<h1 class="page-title">' . esc_html__( 'Oops! That page can&#39;t be found.', 'gutener' ) . '</h1>';
	endif;
}

/**
 * Display page title
 */
function gutener_page_title() {
	if( get_theme_mod( 'disable_page_title', 'disable_front_page' ) == 'disable_all_pages' ){
		// this condition will disable page title from all pages
		echo '';
	}elseif( is_front_page() && get_theme_mod( 'disable_page_title', 'disable_front_page' ) == 'disable_front_page' ){
		// this condition will disable page title from front page only
		echo '';
	}else {
		gutener_page_title_display();
	}
}

/**
 * Display single post title
 */
function gutener_single_page_title() {
	if( get_theme_mod( 'disable_single_post_title', 'enable_all_pages' ) == 'disable_all_pages' ){
		// this condition will disable page title from all pages
		echo '';
	}else {
		gutener_page_title_display();
	}
}

/**
 * Display blog page title
 */
function gutener_blog_page_title() {
	if( get_theme_mod( 'disable_blog_page_title', 'enable_all_pages' ) == 'disable_all_pages' ){
		// this condition will disable page title from all pages
		echo '';
	}else {
		gutener_page_title_display();
	}
}

/**
 * Adds custom size in images
 */
function gutener_image_size( $image_size ){
	$image_id = get_post_thumbnail_id();
	
	the_post_thumbnail( $image_size, array(
		'alt' => esc_attr(get_post_meta( $image_id, '_wp_attachment_image_alt', true))
	) );
}

/**
* Adds a submit button in search form
* 
* @since Gutener 1.0.0
* @param string $form
* @return string
*/
function gutener_modify_search_form( $form ){
	return str_replace( '</form>', '<button type="submit" class="search-button"><span class="fas fa-search"></span></button></form>', $form );
}
add_filter( 'get_search_form', 'gutener_modify_search_form' );

/**
 * Add breadcrumb
 */
require get_template_directory() . '/inc/breadcrumbs.php';

if ( ! function_exists( 'gutener_breadcrumb' ) ) :

	function gutener_breadcrumb() {

		// Bail if Breadcrumb disabled.
		if ( get_theme_mod( 'disable_breadcrumb', false ) ) {
			return;
		}

		// Bail if Home Page.
		if ( ! is_home() && is_front_page() ) {
			return;
		}

		$breadcrumb_args = apply_filters( 'gutener_breadcrumb_args', array(
			'show_on_front'   => false,
			'show_title'      => true,
			'show_browse'     => false
		) );

		gutener_breadcrumb_trail( $breadcrumb_args );
	}

endif;

if ( ! function_exists( 'gutener_breadcrumb_wrap' ) ) :
	/**
	 * Add Breadcrumb Wrapper
	 *
	 * @since Gutener 1.0.0
	 *
	 */
	
	function gutener_breadcrumb_wrap() {
		if( !is_home() ) { ?>
	        <div class="breadcrumb-wrap">
	        	<?php gutener_breadcrumb(); ?>
	        </div>
		<?php
		} 
	}
endif;

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function gutener_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'gutener_pingback_header' );

/**
* Add a class in body
*
* @since Gutener 1.0.0
* @param array $class
* @return array $class
*/
function gutener_body_class_modification( $class ){
	
	// Site Dark Mode
	if( !get_theme_mod( 'disable_dark_mode', true ) ){
		$class[] = 'dark-mode';
	}

	// Site Layouts
	if( get_theme_mod( 'site_layout', 'default' ) == 'default' ){
		$class[] = 'site-layout-default';
	}else if( get_theme_mod( 'site_layout', 'default' ) == 'box' ){
		$class[] = 'site-layout-box';
	}else if( get_theme_mod( 'site_layout', 'default' ) == 'frame' ){
		$class[] = 'site-layout-frame';
	}else if( get_theme_mod( 'site_layout', 'default' ) == 'full' ){
		$class[] = 'site-layout-full';
	}else if( get_theme_mod( 'site_layout', 'default' ) == 'compact' ){
		$class[] = 'site-layout-compact';
	}

	return $class;
}
add_filter( 'body_class', 'gutener_body_class_modification' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gutener_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'gutener_content_width', 720 );
}
add_action( 'after_setup_theme', 'gutener_content_width', 0 );

/**
 * Get Related Posts
 *
 * @since Gutener 1.0.0
 * @param array $taxonomy
 * @param int $per_page Default 3
 * @return bool | object
 */

if( !function_exists( 'gutener_get_related_posts' ) ):
	function gutener_get_related_posts( $taxonomy = array(), $per_page = 4, $get_params = false ){
	   
	    # Show related posts only in single page.
	    if ( !is_single() )
	        return false;

	    # Get the current post object to start of
	    $current_post = get_queried_object();

	    # Get the post terms, just the ids
	    $terms = wp_get_post_terms( $current_post->ID, $taxonomy, array( 'fields' => 'ids' ) );

	    # Lets only continue if we actually have post terms and if we don't have an WP_Error object. If not, return false
	    if ( !$terms || is_wp_error( $terms ) )
	        return false;
	    
	    # Check if the users argument is valid
	    if( is_array( $taxonomy ) && count( $taxonomy ) > 0 ){

	        $tax_query_arg = array();

	        foreach( $taxonomy as $tax ){

	            $tax = filter_var( $tax, FILTER_SANITIZE_STRING );

	            if ( taxonomy_exists( $tax ) ){

	                array_push( $tax_query_arg, array(
	                    'taxonomy'         => $tax,
	                    'terms'            => $terms,
	                    'include_children' => false
	                ) );
	                
	            }
	        }

	        if( count( $tax_query_arg ) == 0 ){
	            return false;
	        }

	        if( count( $tax_query_arg ) > 1 ){
	            $tax_query_arg[ 'relation' ] = 'OR';
	        }
	        
	    }else
	        return false;
	    
	    # Set the default query arguments
	    $args = array(
	        'post_type'      => $current_post->post_type,
	        'post__not_in'   => array( $current_post->ID ),
	        'posts_per_page' => $per_page,
	        'tax_query'      => $tax_query_arg,
	    );

	    if( $get_params ){
	        return $args;
	    }
	    
	    # Now we can query our related posts and return them
	    $q = get_posts( $args );

	    return $q;
	}
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @since Gutener 1.0.0
 */
function gutener_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Menu Sidebar', 'gutener' ),
		'id'            => 'menu-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'gutener' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'gutener' ),
		'id'            => 'left-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'gutener' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title-wrap"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'gutener' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'gutener' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title-wrap"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	for( $i = 1; $i <= 4; $i++ ){
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar', 'gutener' ) . ' ' . $i,
			'id'            => 'footer-sidebar-' . $i,
			'description'   => esc_html__( 'Add widgets here.', 'gutener' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer-item">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'gutener_widgets_init' );

/**
 * Check whether the sidebar is active or not.
 *
 * @see https://codex.wordpress.org/Conditional_Tags
 * @since Gutener 1.0.0
 * @return bool whether the sidebar is active or not.
 */
function gutener_is_active_footer_sidebar(){

	for( $i = 1; $i <= 4; $i++ ){
		if ( is_active_sidebar( 'footer-sidebar-'.$i ) ) : 
			return true;
		endif;
	}
	return false;
}


if( ! function_exists( 'gutener_sort_category' ) ):
/**
 * Helper function for gutener_get_the_category()
 *
 * @since Gutener 1.0.0
 */
function gutener_sort_category( $a, $b ){
    return $a->term_id < $b->term_id;
}
endif;

/**
 * Validation functions
 *
 * @package Gutener
 */

if ( ! function_exists( 'gutener_validate_excerpt_count' ) ) :
	/**
	 * Check if the input value is valid integer.
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return string Whether the value is valid to the current preview.
	 */
	function gutener_validate_excerpt_count( $validity, $value ){
		$value = intval( $value );
		if ( empty( $value ) || ! is_numeric( $value ) ) {
			$validity->add( 'required', esc_html__( 'You must supply a valid number.', 'gutener' ) );
		} elseif ( $value < 1 ) {
			$validity->add( 'min_slider', esc_html__( 'Minimum no of Excerpt Lenght is 1', 'gutener' ) );
		} elseif ( $value > 50 ) {
			$validity->add( 'max_slider', esc_html__( 'Maximum no of Excerpt Lenght is 50', 'gutener' ) );
		}
		return $validity;
	}
endif;

/**
 * To disable archive prefix title.
 * @since Gutener 1.0.0
 */

function gutener_modify_archive_title( $title ) {
	if( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
    } elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
    } elseif ( is_year() ) {
        $title = get_the_date( _x( 'Y', 'yearly archives date format', 'gutener' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( _x( 'F Y', 'monthly archives date format', 'gutener' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'gutener' ) );
     } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

	return $title;
}

add_filter( 'get_the_archive_title', 'gutener_modify_archive_title' );

if( ! function_exists( 'gutener_get_the_category' ) ):
/**
* Returns categories after sorting by term id descending
* 
* @since Gutener 1.0.0
* @uses gutener_sort_category()
* @return array
*/
function gutener_get_the_category( $id = false ){
    $failed = true;

    if( !$id ){
        $id = get_the_id();
    }
    
    # Check if Yoast Plugin is installed 
    # If yes then, get Primary category, set by Plugin

    if ( class_exists( 'WPSEO_Primary_Term' ) ){

        # Show the post's 'Primary' category, if this Yoast feature is available, & one is set
        $wpseo_primary_term = new WPSEO_Primary_Term( 'category', $id );
        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();

        $gutener_cat[0] = get_term( $wpseo_primary_term );

        if ( !is_wp_error( $gutener_cat[0] ) ) { 
           $failed = false;
        }
    }

    if( $failed ){

      $gutener_cat = get_the_category( $id );
      usort( $gutener_cat, 'gutener_sort_category' );  
    }
    
    return $gutener_cat;
}

endif;

/**
* Get post categoriesby by term id
* 
* @since Gutener 1.0.0
* @uses gutener_get_post_categories()
* @return array
*/
function gutener_get_post_categories(){

	$terms = get_terms( array(
	    'taxonomy' => 'category',
	    'hide_empty' => true,
	) );

	if( empty($terms) || !is_array( $terms ) ){
		return array();
	}

	$data = array();
	foreach ( $terms as $key => $value) {
		$term_id = absint( $value->term_id );
		$data[$term_id] =  esc_html( $value->name );
	}
	return $data;

}

/**
* Add a home page custom banner
* @since Gutener 1.0.0
*/
function gutener_banner(){

	$width_control = '';
	if( get_theme_mod( 'banner_width_controls', 'full' ) == 'boxed' && get_theme_mod( 'display_banner_on', 'blog-page-below-header' ) == 'blog-page-above-latest-posts' ){
		$width_control = 'boxed';
	}else if( get_theme_mod( 'banner_width_controls', 'full' ) == 'boxed' ){
		$width_control = 'container boxed';
	}
	$banner_image_url = get_theme_mod( 'banner_image' );
	$bannerImageID = attachment_url_to_postid($banner_image_url);
	$banner_obj = wp_get_attachment_image_src( $bannerImageID, 'gutener-1920-550' );
	if( !$banner_image_url ){
		$banner_image = get_theme_file_uri( '/assets/images/gutener-1920-550.jpg' );
	}else {
		$banner_image = $banner_obj[0];
	}

	$alignmentClass = 'text-center';
	if ( get_theme_mod( 'main_banner_content_alignment' , 'center' ) == 'left' ){
		$alignmentClass = 'text-left';
	}elseif ( get_theme_mod( 'main_banner_content_alignment' , 'center' ) == 'right' ){
		$alignmentClass = 'text-right';
	}
 	?>

 	<div class="section-banner <?php echo esc_attr( $width_control ); ?>">
		<div class="banner-img" style="background-image: url( <?php echo esc_url( $banner_image ); ?> );">
			<div class="banner-content <?php echo esc_attr( $alignmentClass ); ?>">
				<h2 class="entry-title">
					<?php 
					$banner_title = get_theme_mod( 'banner_title', '' );
					echo esc_html( $banner_title ? $banner_title : '' ); ?>
				</h2>
				<p class="entry-subtitle">
					<?php 
					$banner_subtitle = get_theme_mod( 'banner_subtitle', '' );
					echo esc_html( $banner_subtitle ? $banner_subtitle : '' ); 
					?> 
				</p>
				<div class="button-container">
					<?php 
				        $banner_buttons = get_theme_mod( 'main_banner_buttons' );
				        
				        if( !empty( $banner_buttons ) && is_array( $banner_buttons ) ){
				            $count = 0.2;
				            foreach( $banner_buttons as $value ){
				            	if( !empty( $value['text'] ) ){
				                	echo '<a href="' . esc_url( $value['link'] ) . '" class=" ' . esc_attr( $value['type'] ) . ' ">' . esc_html( $value['text'] ) . '</a>';
				                	$count = $count + 0.2;
				                }
				            }
        				}
    				?>
				</div>
			</div>
			<div class="overlay"></div>
		</div>
	</div>

	<?php
}

/**
* Add banner title
* @since Gutener 1.0.0
*/
function gutener_get_banner_title(){
	return esc_html( get_theme_mod( 'banner_title' ) );
}

/**
* Add banner subtitle
* @since Gutener 1.0.0
*/
function gutener_get_banner_subtitle(){
	return esc_html( get_theme_mod( 'banner_subtitle' ) );
}

/**
* Add excerpt length
* @since Gutener 1.0.0
*/
function gutener_excerpt_length( $length ) {
	if ( is_admin() ) return $length;
	$excerpt_length = get_theme_mod( 'excerpt_length' , 60 );
	return $excerpt_length;	
}
add_filter( 'excerpt_length', 'gutener_excerpt_length', 999 );

/**
* Add a wrapper div to Woocommerce product
* @since Gutener 1.0.0
*/

function gutener_before_shop_loop_item(){
	echo '<div class="product-inner">';
}

add_action( 'woocommerce_before_shop_loop_item', 'gutener_before_shop_loop_item', 9 );

function gutener_after_shop_loop_item(){
	echo '</div>';
}

/**
* Woocommerce after shop loop item
* @since Gutener 1.0.0
*/

add_action( 'woocommerce_after_shop_loop_item', 'gutener_after_shop_loop_item', 11 );

/**
* Woocommerce shop description remove from banner
* @since Gutener 1.0.0
*/
function gutener_remove_woocommerce_shop_description( $args ) {
	$args['description'] = '';
	return $args;
}

/**
* Woocommerce post type product register
* @since Gutener 1.0.0
*/
add_filter( 'woocommerce_register_post_type_product', 'gutener_remove_woocommerce_shop_description' );

/**
* Woocommerce show page title
* @since Gutener 1.0.0
*/
function gutener_woo_show_page_title(){
	return false;
}
add_filter( 'woocommerce_show_page_title', 'gutener_woo_show_page_title' );

/**
* Change number or products per row to 3
* @since Gutener 1.0.0
*/
if ( !function_exists( 'gutener_loop_columns' ) ) {
	function gutener_loop_columns() {
		return 3; // 3 products per row
	}
}
add_filter( 'loop_shop_columns', 'gutener_loop_columns' );

