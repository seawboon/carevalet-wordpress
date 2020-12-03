<?php
/**
* Loads all the components related to customizer 
*
* @since Gutener 1.0.0
*/

function gutener_modify_default_settings( $wp_customize ){

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_control( 'background_color' )->label = esc_html( 'Background', 'gutener' );

}
add_action( 'gutener_customize_register', 'gutener_modify_default_settings' );

if( !function_exists( 'gutener_hex2rgba' ) ):
/**
* Convert hexdec color string to rgb(a) string
*/
function gutener_hex2rgba($color, $opacity = false) {
 
    $default = 'rgba(0,0,0.0.1)';
 
    # Return default if no color provided
    if( empty( $color ) )
          return $default; 
 
    # Sanitize $color if "#" is provided 
    if ( $color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    # Check if color has 6 or 3 characters and get values
    if ( strlen( $color ) == 6 ) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
            return $default;
    }
 
    # Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    # Check if opacity is set(rgba or rgb)
    if( $opacity ){
        if( abs( $opacity ) > 1 )
            $opacity = 1.0;
        $output = 'rgba('.implode( ",",$rgb ).','.$opacity.')';
    } else {
        $output = 'rgb('.implode( ",",$rgb ).')';
    }

    # Return rgb(a) color string
    return $output;
}
endif;

function gutener_default_styles(){

	// begin style block
	$css = '<style>';

	# Site Title
	#Site Title Height
	$logo_width = get_theme_mod( 'logo_width', 320 );
	$css .= '
		.site-header .site-branding > a {
			max-width: '. esc_attr( $logo_width ) .'px;
			overflow: hidden;
			margin: 0 auto;
			display: inline-block;
		}
	';

	$site_title_color = get_theme_mod( 'site_title_color', '#030303' );
	$site_tagline_color = get_theme_mod( 'site_tagline_color', '#767676' );
	$css .= '
		/* Site Title */
		.header-one .site-branding .site-title,
		.header-two .site-branding .site-title,
		.home .header-three:not(.sticky-header) .site-branding .site-title {
			color: '. esc_attr( $site_title_color ) .';
		}

		/* Tagline */
		.header-one .site-branding .site-description,
		.header-two .site-branding .site-description,
		.home .header-three:not(.sticky-header) .site-branding .site-description {
			color: '. esc_attr( $site_tagline_color ) .';
		}
	';
	
	# Colors
	$site_body_text_color = get_theme_mod( 'site_body_text_color', '#383838' );
	$site_heading_text_color = get_theme_mod( 'site_heading_text_color', '#030303' );
	$header_textcolor = get_theme_mod( 'header_textcolor', '#030303' );
	$site_primary_color = get_theme_mod( 'site_primary_color', '#f9a032' );
	$site_hover_color = get_theme_mod( 'site_hover_color', '#086abd' );
	$css .= '
		.header-one .site-branding .site-description :before, 
		.header-one .site-branding .site-description :after {
			background-color: '. esc_attr( $site_tagline_color ) .';
		}
		.header-two .site-branding .site-description :before, 
		.header-two .site-branding .site-description :after {
			background-color: '. esc_attr( $site_tagline_color ) .';
		}
		.home .header-three:not(.sticky-header) .site-branding .site-description:before,
		.home .header-three:not(.sticky-header) .site-branding .site-description:after {
			background-color: '. esc_attr( $site_tagline_color ) .';
		}
		
		/* Page and Single Post Title */
		body.single .page-title, body.page .page-title {
			color: '. esc_attr( $header_textcolor ) .';
		}
		/* Site body Text */
		body, html {
			color: '. esc_attr( $site_body_text_color ) .';
		}
		/* Heading Text */
		h1, h2, h3, h4, h5, h6 {
			color: '. esc_attr( $site_heading_text_color ) .';
		}
		/* Primary Background */
		.section-title:before, .button-primary, .woocommerce span.onsale, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
			background-color: '. esc_attr( $site_primary_color ) .';
		}
		/* Primary Border */		
		.post .entry-content .entry-header .cat-links a, .attachment .entry-content .entry-header .cat-links a, .banner-content .entry-content .entry-header .cat-links a {
			border-color: '. esc_attr( $site_primary_color ) .';
		}
		/* Primary Color */
	 	blockquote:before, .post .entry-content .entry-header .cat-links a, .attachment .entry-content .entry-header .cat-links a, .banner-content .entry-content .entry-header .cat-links a, .post .entry-meta a:before, .attachment .entry-meta a:before, .banner-content .entry-meta a:before {
			color: '. esc_attr( $site_primary_color ) .';
		}
		/* Hover Background */
		input[type=button]:hover, input[type=button]:active, input[type=button]:focus, input[type=reset]:hover, input[type=reset]:active, input[type=reset]:focus, input[type=submit]:hover, input[type=submit]:active, input[type=submit]:focus, .button-primary:hover, .button-primary:focus, .button-primary:active, .button-outline:hover, .button-outline:focus, .button-outline:active, .search-form .search-button:hover, .search-form .search-button:focus, .search-form .search-button:active, .page-numbers:hover, .page-numbers:focus, .page-numbers:active, #back-to-top a:hover, #back-to-top a:focus, #back-to-top a:active, .section-feature-post .slick-control li:not(.slick-disabled):hover, .section-feature-post .slick-control li:not(.slick-disabled):focus, .section-feature-post .slick-control li:not(.slick-disabled):active, .alt-menu-icon a:hover .icon-bar, .alt-menu-icon a:focus .icon-bar, .alt-menu-icon a:active .icon-bar, .alt-menu-icon a:hover .icon-bar:before, .alt-menu-icon a:focus .icon-bar:before, .alt-menu-icon a:active .icon-bar:before, .alt-menu-icon a:hover .icon-bar:after, .alt-menu-icon a:focus .icon-bar:after, .alt-menu-icon a:active .icon-bar:after, #offcanvas-menu .close-offcanvas-menu button:hover, #offcanvas-menu .close-offcanvas-menu button:focus, #offcanvas-menu .close-offcanvas-menu button:active, .feature-post-slider .post .entry-meta .cat-links a:hover, .feature-post-slider .post .entry-meta .cat-links a:focus, .feature-post-slider .post .entry-meta .cat-links a:active, .site-footer .social-profile ul li a:hover, .site-footer .social-profile ul li a:focus, .site-footer .social-profile ul li a:active, #back-to-top a:hover, #back-to-top a:focus, #back-to-top a:active, .comments-area .comment-list .reply a:hover, .comments-area .comment-list .reply a:focus, .comments-area .comment-list .reply a:active, .widget .tagcloud a:hover, .widget .tagcloud a:focus, .widget .tagcloud a:active, .infinite-scroll #infinite-handle span:hover, .infinite-scroll #infinite-handle span:focus, .infinite-scroll #infinite-handle span:active, .slicknav_btn:hover .slicknav_icon-bar, .slicknav_btn:focus .slicknav_icon-bar, .slicknav_btn:hover .slicknav_icon-bar, .slicknav_btn:hover .slicknav_icon-bar:first-child:before, .slicknav_btn:hover .slicknav_icon-bar:first-child:after, .slicknav_btn:focus .slicknav_icon-bar:first-child:before, .slicknav_btn:focus .slicknav_icon-bar:first-child:after, .slicknav_btn:hover .slicknav_icon-bar:first-child:before, .slicknav_btn:hover .slicknav_icon-bar:first-child:after, .woocommerce #respond input#submit:hover, .woocommerce #respond input#submit:focus, .woocommerce #respond input#submit:active, .woocommerce a.button:hover, .woocommerce a.button:focus, .woocommerce a.button:active, .woocommerce button.button:hover, .woocommerce button.button:focus, .woocommerce button.button:active, .woocommerce input.button:hover, .woocommerce input.button:focus, .woocommerce input.button:active, .woocommerce a.button.alt:hover, .woocommerce a.button.alt:focus, .woocommerce a.button.alt:active, .woocommerce button.button.alt:hover, .woocommerce button.button.alt:focus, .woocommerce button.button.alt:active, .woocommerce a.added_to_cart:hover, .woocommerce a.added_to_cart:focus, .woocommerce a.added_to_cart:active, .widget-area .widget.widget_product_search [type=submit]:hover, .widget-area .widget.widget_product_search [type=submit]:focus, .widget-area .widget.widget_product_search [type=submit]:active {
			background-color: '. esc_attr( $site_hover_color ) .';
		}
		/* Hover Border */
		.button-outline:hover, .button-outline:focus, .button-outline:active, #offcanvas-menu .close-offcanvas-menu button:hover, #offcanvas-menu .close-offcanvas-menu button:focus, #offcanvas-menu .close-offcanvas-menu button:active, .page-numbers:hover, .page-numbers:focus, .page-numbers:active, #back-to-top a:hover, #back-to-top a:focus, #back-to-top a:active, .post .entry-content .entry-header .cat-links a:hover, .post .entry-content .entry-header .cat-links a:focus, .post .entry-content .entry-header .cat-links a:active, .attachment .entry-content .entry-header .cat-links a:hover, .attachment .entry-content .entry-header .cat-links a:focus, .attachment .entry-content .entry-header .cat-links a:active, .banner-content .entry-content .entry-header .cat-links a:hover, .banner-content .entry-content .entry-header .cat-links a:focus, .banner-content .entry-content .entry-header .cat-links a:active, .slick-control li:not(.slick-disabled):hover span, .slick-control li:not(.slick-disabled):focus span, .slick-control li:not(.slick-disabled):active span, .section-banner .banner-content .button-container .button-outline:hover, .section-banner .banner-content .button-container .button-outline:focus, .section-banner .banner-content .button-container .button-outline:active, #back-to-top a:hover, #back-to-top a:focus, #back-to-top a:active, .widget .tagcloud a:hover, .widget .tagcloud a:focus, .widget .tagcloud a:active {
			border-color: '. esc_attr( $site_hover_color ) .';

			}
		/* Hover Text */
		a:hover, a:focus, a:active, .main-navigation ul.nav-menu ul li a:hover, .main-navigation ul.nav-menu ul li a:focus, .main-navigation ul.nav-menu ul li a:active, .main-navigation ul.nav-menu > li:hover > a, .main-navigation ul.nav-menu > li:focus > a, .main-navigation ul.nav-menu > li:active > a, .main-navigation ul.nav-menu > li.focus > a, .main-navigation ul.nav-menu li.current-menu-item > a, .main-navigation ul.nav-menu li.current-menu-parent > a, .comment-navigation .nav-previous a:hover, .comment-navigation .nav-previous a:focus, .comment-navigation .nav-previous a:active, .comment-navigation .nav-next a:hover, .comment-navigation .nav-next a:focus, .comment-navigation .nav-next a:active, .posts-navigation .nav-previous a:hover, .posts-navigation .nav-previous a:focus, .posts-navigation .nav-previous a:active, .posts-navigation .nav-next a:hover, .posts-navigation .nav-next a:focus, .posts-navigation .nav-next a:active, .post-navigation .nav-previous a:hover, .post-navigation .nav-previous a:focus, .post-navigation .nav-previous a:active, .post-navigation .nav-next a:hover, .post-navigation .nav-next a:focus, .post-navigation .nav-next a:active, .social-profile ul li a:hover, .social-profile ul li a:focus, .social-profile ul li a:active, .post .entry-content .entry-header .cat-links a:hover, .post .entry-content .entry-header .cat-links a:focus, .post .entry-content .entry-header .cat-links a:active, .attachment .entry-content .entry-header .cat-links a:hover, .attachment .entry-content .entry-header .cat-links a:focus, .attachment .entry-content .entry-header .cat-links a:active, .banner-content .entry-content .entry-header .cat-links a:hover, .banner-content .entry-content .entry-header .cat-links a:focus, .banner-content .entry-content .entry-header .cat-links a:active, .post .entry-meta a:hover, .post .entry-meta a:focus, .post .entry-meta a:active, .attachment .entry-meta a:hover, .attachment .entry-meta a:focus, .attachment .entry-meta a:active, .banner-content .entry-meta a:hover, .banner-content .entry-meta a:focus, .banner-content .entry-meta a:active, .post .entry-meta a:hover:before, .post .entry-meta a:focus:before, .post .entry-meta a:active:before, .attachment .entry-meta a:hover:before, .attachment .entry-meta a:focus:before, .attachment .entry-meta a:active:before, .banner-content .entry-meta a:hover:before, .banner-content .entry-meta a:focus:before, .banner-content .entry-meta a:active:before, .breadcrumb-wrap .breadcrumbs .trail-items a:hover, .breadcrumb-wrap .breadcrumbs .trail-items a:focus, .breadcrumb-wrap .breadcrumbs .trail-items a:active, .site-header .site-branding .site-title a:hover, .site-header .site-branding .site-title a:focus, .site-header .site-branding .site-title a:active, .header-search-wrap .search-icon:hover, .header-search-wrap .search-icon:focus, .header-search-wrap .search-icon:active, .header-search .search-form .search-button:hover, .header-search .close-button:hover, .header-contact ul a:hover, .header-contact ul a:focus, .header-contact ul a:active, .section-banner .banner-content .entry-meta a:hover, .section-banner .banner-content .entry-meta a:focus, .section-banner .banner-content .entry-meta a:active, .site-footer .site-info a:hover, .site-footer .site-info a:focus, .site-footer .site-info a:active, .site-footer .footer-menu ul li a:hover, .site-footer .footer-menu ul li a:focus, .site-footer .footer-menu ul li a:active, .comments-area .comment-list .comment-metadata a:hover, .comments-area .comment-list .comment-metadata a:focus, .comments-area .comment-list .comment-metadata a:active, .widget ul li a:hover, .widget ul li a:focus, .widget ul li a:active, .woocommerce .product_meta .posted_in a:hover, .woocommerce .product_meta .posted_in a:focus, .woocommerce .product_meta .posted_in a:active, .woocommerce .product_meta .tagged_as a:hover, .woocommerce .product_meta .tagged_as a:focus, .woocommerce .product_meta .tagged_as a:active, .woocommerce .woocommerce-MyAccount-navigation ul li a:hover, .woocommerce .woocommerce-MyAccount-navigation ul li a:focus, .woocommerce .woocommerce-MyAccount-navigation ul li a:active, .woocommerce .woocommerce-MyAccount-content p a:hover, .woocommerce .woocommerce-MyAccount-content p a:focus, .woocommerce .woocommerce-MyAccount-content p a:active, .section-banner .banner-content .button-container .button-text:hover, .section-banner .banner-content .button-container .button-text:focus, .section-banner .banner-content .button-container .button-text:active, .dark-skin .site-header .main-navigation ul.nav-menu > li > a:hover, .social-profile ul li a:hover, .dark-skin .site-header .header-icons .search-icon:hover, .slicknav_menu ul.slicknav_nav li > a:hover, .slicknav_menu ul.slicknav_nav li > a:focus, .slicknav_menu ul.slicknav_nav li > a:active {
			color: '. esc_attr( $site_hover_color ) .';
		}
		.addtoany_content .addtoany_list a:hover svg path, .addtoany_content .addtoany_list a:focus svg path, .addtoany_content .addtoany_list a:active svg path, .widget .addtoany_list a:hover svg path, .widget .addtoany_list a:focus svg path, .widget .addtoany_list a:active svg path{
			fill: '. esc_attr( $site_hover_color ) .';
		}

		a:focus {
		  outline-color: '. esc_attr( $site_hover_color ) .';
		}
	';


	/* Site Tagline */
	if( get_theme_mod( 'disable_site_tagline_border', false ) ){
	$css .= '
		.site-header .site-branding .site-description:before, 
		.site-header .site-branding .site-description:after {
			display: none;
		}
		.site-header .site-branding .site-description, 
		.site-header .site-branding .site-description {
			padding-left: 0;
			padding-right: 0;
		}
	';
	}

	# Overlay Opacity
	$slider_image_overlay_opacity = get_theme_mod( 'slider_image_overlay_opacity', 4 );
	$banner_image_overlay_opacity = get_theme_mod( 'banner_image_overlay_opacity', 4 );
	$highlight_posts_overlay_opacity = get_theme_mod( 'highlight_posts_overlay_opacity', 4 );
	$css .= '
	/* Main Slider */
	.main-slider .banner-img .overlay {
		background-color: rgba(0, 0, 0, 0.'. esc_attr( $slider_image_overlay_opacity ) .');
	}
	 /* Main Banner */
	 .banner-img .overlay {
	 	background-color: rgba(0, 0, 0, 0.'. esc_attr( $banner_image_overlay_opacity ) .');
	 }
	 /* Highlight Posts */
	 .highlight-posts-content-wrap a:before {
	 	background-color: rgba(0, 0, 0, 0.'. esc_attr( $highlight_posts_overlay_opacity ) .');
	 }
	';

	 # Theme Skins
	#Dark Skin
	if( get_theme_mod( 'skin_select', 'default' ) == 'dark' ){
		$css .= '
			body.dark-skin,
			body.dark-skin.custom-background,
			.site-content,
			.site-header-primary .main-header {
			  	background-color: #000000;
			  	color: #c7c7c7;
			}
			h1, h2, h3, h4, h5, h6, body.single .page-title, body.page .page-title {
			  	color: #ffffff;
			}
			input[type=text], input[type=email], 
			input[type=url], input[type=password], 
			input[type=search], input[type=number], 
			input[type=tel], input[type=range], 
			input[type=date], input[type=month], 
			input[type=week], input[type=time], 
			input[type=datetime], 
			input[type=datetime-local], 
			input[type=color],
			textarea {
			  background-color: #000000;
			  border-color: #262626;
			  color: #ffffff;
			}
			input[type=text]:focus, 
			input[type=text]:active, 
			input[type=email]:focus, 
			input[type=email]:active, 
			input[type=url]:focus, 
			input[type=url]:active, 
			input[type=password]:focus, 
			input[type=password]:active, 
			input[type=search]:focus, 
			input[type=search]:active, 
			input[type=number]:focus, 
			input[type=number]:active, 
			input[type=tel]:focus, 
			input[type=tel]:active, 
			input[type=range]:focus, 
			input[type=range]:active, 
			input[type=date]:focus, 
			input[type=date]:active, 
			input[type=month]:focus, 
			input[type=month]:active, 
			input[type=week]:focus, 
			input[type=week]:active, 
			input[type=time]:focus, 
			input[type=time]:active, 
			input[type=datetime]:focus, 
			input[type=datetime]:active, 
			input[type=datetime-local]:focus, 
			input[type=datetime-local]:active, 
			input[type=color]:focus, 
			input[type=color]:active,
			textarea:focus,
			textarea:active {
			  	border-color: #ffffff;
			}
			.button-outline {
			  	border-color: #e6e6e6;
			  	color: #e6e6e6;
			}
			.button-outline:hover, 
			.button-outline:active, 
			.button-outline:focus {
		  		border-color: #086abd;
			  	color: #ffffff;
			}
			.button-text {
			  	color: #e6e6e6;
			}
			.button-text:hover, 
			.button-text:focus, 
			.button-text:active {
			  	color: #086abd;
			}
			blockquote {
			  	color: #e6e6e6;
			}
			blockquote:before {
			  	border-bottom-color: #cccccc;
			  	border-top-color: #cccccc;
			}
			blockquote:after {
			  	background-color: #000000;
			  	color: #cccccc;
			}
			.post:not(.list-post) .entry-content {
			  	border-color: #1a1a1a;
			}
			body:not(.custom-background), body.custom-background .site-content .container {
				background-color: #0a0a0a;
			}
			.wrap-detail-page .breadcrumb-wrap {
			    background-color: transparent;
			}
			.main-navigation ul.menu > li > a {
			  	color: #d9d9d9;
			}
			.mid-header {
			    border-color: #1a1a1a;
			}
			.header-two.sticky-header .bottom-header .overlay {
			    background-color: #000000;
			}
			.main-navigation ul.menu > li > a:hover, 
			.main-navigation ul.menu > li > a:focus, 
			.main-navigation ul.menu > li > a:active {
			  	color: #086abd;
			}
			.social-profile ul li a {
			    color: #969696;
			}
			.main-navigation ul.menu ul {
			  	background-color: #050505;
			}
			.main-navigation ul.menu ul li {
			  	border-color: #1a1a1a;
			}
			.main-navigation ul.menu ul li a:hover, 
			.main-navigation ul.menu ul li a:focus, 
			.main-navigation ul.menu ul li a:active {
			  	color: #086abd;
			}
			.site-header .bottom-header, 
			.site-header.sticky-header .fixed-header, 
			.site-header .top-header,
			.site-header .mid-header,
			.site-footer {
			  	background-color: #000000;
			}
			.site-header .top-header {
			  	border-bottom: 1px solid #292929;
			}
			.home .site-content {
			    border-top: 1px solid #292929;
			}
			.site-header .site-branding .site-title {
			  	color: #ffffff;
			}
			.site-header .main-navigation ul.nav-menu > li > a, 
			.social-profile ul li a,
			.site-header .header-icons .search-icon {
				color: #969696;
			}
			.site-header .alt-menu-icon .icon-bar, 
			.site-header .alt-menu-icon .icon-bar:before, 
			.site-header .alt-menu-icon .icon-bar:after {
				background-color: #969696;
			}
			.header-search {
				background-color: #000000;
			}
			.header-search .search-form .search-button,
			.header-search .close-button {
				color: #969696;
			}
			body:not(.home) .site-header .bottom-header {
				border-color: #292929;
			}
			@media screen and (max-width: 991px) {
			  	.header-search-wrap .search-button {
			    	color: #ffffff;
			  	}
			}
			.section-banner .slick-slide {
			  	background-color: #060606;
			}
			.section-banner .post {
			  	background-color: #000000;
			}
			.section-banner .slick-control ul li {
			  	background-color: #000000;
			}
			.feature-post-slider .post,
			.wrap-ralated-posts .post .entry-content {
			  	background-color: #000000;
			}
			.site-footer h1, 
			.site-footer h2, 
			.site-footer h3, 
			.site-footer h4, 
			.site-footer h5, 
			.site-footer h6 {
				color: #ffffff;
			}
			.site-footer .widget .widget-title:before {
				background-color: #ffffff;
			}
			.site-footer .site-info a {
			  	color: #ffffff;
			}
			.site-footer .site-info a:hover, 
			.site-footer .site-info a:focus, 
			.site-footer .site-info a:active {
			  	color: #086abd;
			}
			.site-footer .footer-menu ul li {
			  	border-color: #1a1a1a;
			}
			.site-footer .social-profile ul li a {
			  	color: #4d4d4d;
			}
			.site-footer .widget .widget-title:before {
			  	background-color: #ffffff;
			}
			.breadcrumb-wrap {
			  	background-color: #080808;
			}
			.comments-area .comment-list .comment-{
			  	background-color: #000000;
			  	border-color: #1a1a1a;
			}
			.comments-area .comment-list .comment-author .avatar {
			  	background-color: #1a1a1a;
			  	border-color: #000000;
			}
			.comments-area .comment-respond .comment-form .comment-notes {
			  	color: #cccccc;
			}
			.comments-area .comment-respond .comment-form .comment-notes span {
			  	color: #ffffff;
			}
			.author-info .author-content-wrap {
			  	background-color: #060606;
			}
			.post-navigation {
			  	border-bottom-color: #1a1a1a;
			  	border-top-color: #1a1a1a;
			}
			.comment-navigation .nav-previous a, 
			.comment-navigation .nav-next a,
			.post-navigation .nav-previous a,
			.post-navigation .nav-next a {
			  	color: #cccccc;
			}
			.comment-navigation .nav-previous a:hover, 
			.comment-navigation .nav-previous a:focus, 
			.comment-navigation .nav-previous a:active, 
			.comment-navigation .nav-next a:hover, 
			.comment-navigation .nav-next a:focus, 
			.comment-navigation .nav-next a:active,
			.post-navigation .nav-previous a:hover,
			.post-navigation .nav-previous a:focus,
			.post-navigation .nav-previous a:active,
			.post-navigation .nav-next a:hover,
			.post-navigation .nav-next a:focus,
			.post-navigation .nav-next a:active {
			  	color: #086abd;
			}
			.section-instagram-wrapper #sb_instagram {
			  	background-color: inherit !important;
			  	padding-bottom: 0 !important;
			}
			.comments-area .comment-respond label {
			  	color: #e6e6e6;
			}
			body.woocommerce .woocommerce-result-count,
			body.woocommerce .woocommerce-ordering select,
			body.woocommerce select {
			  	background-color: #0d0d0d;
			  	border-color: #0d0d0d;
			  	color: #cccccc;
			}
			body.woocommerce ul.products li.product .price,
			body.woocommerce-page ul.products li.product .price {
			  	color: #ffffff;
			}
			body.woocommerce ul .product-inner, 
			body.woocommerce-page ul .product-inner {
			  	border-color: #1a1a1a;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs:before {
			  	border-color: #333333;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li {
			  	background-color: #333333;
			  	border-color: #333333;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li:before {
			  	box-shadow: 2px 2px 0 #333333;
			  	border-color: #333333;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li:after {
			  	box-shadow: -2px 2px 0 #333333;
			  	border-color: #333333;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li.active {
			  	background-color: #000000;
			  	border-bottom-color: #000000;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li.active:before {
			  	box-shadow: 2px 2px 0 #000000;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li.active:after {
			  	box-shadow: -2px 2px 0 #000000;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li a {
			  	color: #d6d6d6;
			}
			.widget ul li {
			  	border-bottom-color: #1a1a1a;
			}
			.widget ul li a {
				color: #FFFFFF;
			}
			.widget .tagcloud a {
			  	background-color: #000000;
			  	color: #e6e6e6;
			}
			.widget .tagcloud a:hover, .widget .tagcloud a:focus, .widget .tagcloud a:active {
			  	background-color: #086abd;
			  	color: #ffffff;
			}
			.latest-posts-widget .post {
			  	border-bottom-color: #1a1a1a;
			}
			body.search-results .hentry,
			body.search-results .product {
			  	border-color: #1a1a1a;
			}
			.slicknav_btn .slicknav_icon span,
			.slicknav_btn .slicknav_icon span:before,
			.slicknav_btn .slicknav_icon span:after {
			  	background-color: #ffffff;
			}
			.slicknav_btn.slicknav_open span {
			  	background-color: transparent;
			}
			.section-banner .main-slider-three .post {
			  	background-color: transparent;
			}
			.slicknav_menu .slicknav_nav {
			  	background-color: #000000;
			}
			.slicknav_menu ul.slicknav_nav {
			  	background-color: #000000;
			}
			.slicknav_menu ul.slicknav_nav li > a {
			  	border-top-color: #1a1a1a;
			  	color: #cccccc;
			}
			#offcanvas-menu {
			  	background-color: #060606;
			}
			.woocommerce-Reviews {
			  	color: #404040;
			}
			body.site-layout-box, body.site-layout-frame {
			  	background-color: #0a0a0a;
			}
			body.site-layout-box .site, body.site-layout-frame .site {
			  	background-color: #000000;
			}
			.widget .tagcloud a:hover, 
			.widget .tagcloud a:focus, 
			.widget .tagcloud a:active, 
			.woocommerce button.button.alt:hover, 
			.woocommerce button.button.alt:focus, 
			.woocommerce button.button.alt:active, 
			.woocommerce .widget.widget_product_search [type=submit]:hover, 
			.woocommerce .widget.widget_product_search [type=submit]:focus, 
			.woocommerce .widget.widget_product_search [type=submit]:active,
			.site-footer .social-profile ul li a:hover, 
			.site-footer .social-profile ul li a:focus, 
			.site-footer .social-profile ul li a:active {
				background-color: '. esc_attr( $site_hover_color ) .';
			}
			.button-outline:hover, 
			.button-outline:active, 
			.button-outline:focus {
				border-color: '. esc_attr( $site_hover_color ) .';
			}
			.widget_calendar table {
			    border-color: #1a1a1a;
			}
			.widget.widget_calendar table thead th {
			    border-right-color: #1a1a1a;
			}
			.widget_calendar table th, 
			.widget_calendar table td {
			    border-bottom-color: #1a1a1a;
			}
			.slicknav_btn .slicknav_icon span, 
			.slicknav_btn .slicknav_icon span:first-child:before, 
			.slicknav_btn .slicknav_icon span:first-child:after {
				background-color: #ffffff;
			}
			.button-text:hover, .button-text:focus, 
			.button-text:active, 
			.main-navigation ul.menu > li > a:hover, 
			.main-navigation ul.menu > li > a:focus, 
			.main-navigation ul.menu > li > a:active, 
			.comment-navigation .nav-previous a:hover, 
			.comment-navigation .nav-previous a:focus, 
			.comment-navigation .nav-previous a:active, 
			.comment-navigation .nav-next a:hover, 
			.comment-navigation .nav-next a:focus, 
			.comment-navigation .nav-next a:active, 
			.post-navigation .nav-previous a:hover,
			.post-navigation .nav-previous a:focus, 
			.post-navigation .nav-previous a:active,
			.post-navigation .nav-next a:hover, 
			.post-navigation .nav-next a:focus, 
			.post-navigation .nav-next a:active,
			.site-footer .site-info a:hover, 
			.site-footer .site-info a:focus, 
			.site-footer .site-info a:active, 
			.woocommerce .product_meta .posted_in a:hover, 
			.woocommerce .product_meta .posted_in a:focus, 
			.woocommerce .product_meta .posted_in a:active, 
			.woocommerce .product_meta .tagged_as a:hover, 
			.woocommerce .product_meta .tagged_as a:focus, 
			.woocommerce .product_meta .tagged_as a:active, 
			.main-navigation ul.menu ul li a:hover, 
			.main-navigation ul.menu ul li a:focus, 
			.main-navigation ul.menu ul li a:active {
				color: '. esc_attr( $site_hover_color ) .';
			}
		';
	}

	#Black and White
	if( get_theme_mod( 'skin_select', 'default' ) == 'blackwhite' ){
		$css .= '
			body.black-white-skin .button-primary {
				background-color: #333333;
			}
			body.black-white-skin .notification-bar .button-primary {
				background-color: #fff;
				color: #333333;
			}
			body.black-white-skin .post .entry-content .entry-header .cat-links a, 
			body.black-white-skin .attachment .entry-content .entry-header .cat-links a, 
			body.black-white-skin .banner-content .entry-content .entry-header .cat-links a {
				color: #7a7a7a;
				border-bottom-color: #7a7a7a; 
			}
			body.black-white-skin .post .entry-meta a:before, 
			body.black-white-skin .attachment .entry-meta a:before, 
			body.black-white-skin .banner-content .entry-meta a:before {
				color: #7a7a7a;
			}
			.highlight-posts-content-wrap .highlight-posts-image,
			.main-slider .banner-img {
				background-blend-mode: luminosity,normal;
			}
			body.black-white-skin img,
			.highlight-posts-content-wrap a ~  .highlight-posts-image{
				filter: grayscale(100%);
				-webkit-filter: grayscale(100%);
			}
			body.black-white-skin .section-title:before {
				background-color: #030303;
			}
		';
	}
	
	# Header Color
	/* Top Header Background */
	$top_header_one_background_color = get_theme_mod( 'top_header_one_background_color', '' );
	$top_header_two_background_color = get_theme_mod( 'top_header_two_background_color', '' );
	$top_header_three_background_color = get_theme_mod( 'top_header_three_background_color', '' );
	$top_header_text_color = get_theme_mod( 'top_header_text_color', '' );
	$css .= '
		.header-one .top-header {
			background-color: '. esc_attr( $top_header_one_background_color ) .';
		}
		.header-two .top-header {
			background-color: '. esc_attr( $top_header_two_background_color ) .';
		}
		.header-three .top-header,
		.dark-skin .header-three.site-header .top-header {
			background-color: '. esc_attr( $top_header_three_background_color ) .';
		}
	';

	$css .= '
		.header-one .header-contact ul li, 
		.header-one .header-contact ul li a, 
		.header-one .social-profile ul li a,
		.header-two .header-contact ul li, 
		.header-two .header-contact ul li a, 
		.header-two .social-profile ul li a,
		.header-three:not(.sticky-header) .header-contact ul li, 
		.header-three:not(.sticky-header) .header-contact ul li a, 
		.header-three:not(.sticky-header) .social-profile ul li a,
		.header-two:not(.sticky-header) .header-icons .search-icon,
		.header-three:not(.sticky-header) .header-icons .search-icon {
			color: '. esc_attr( $top_header_text_color ) .';
		}
		.header-one .alt-menu-icon .icon-bar, 
		.header-one .alt-menu-icon .icon-bar:before, 
		.header-one .alt-menu-icon .icon-bar:after {
			background-color: '. esc_attr( $top_header_text_color ) .';
		}
		.header-two .alt-menu-icon .icon-bar, 
		.header-two .alt-menu-icon .icon-bar:before, 
		.header-two .alt-menu-icon .icon-bar:after {
			background-color: '. esc_attr( $top_header_text_color ) .';
		}
		.header-three .alt-menu-icon .icon-bar, 
		.header-three .alt-menu-icon .icon-bar:before, 
		.header-three .alt-menu-icon .icon-bar:after {
			background-color: '. esc_attr( $top_header_text_color ) .';
		}
		.header-one .header-contact ul li a:hover, 
		.header-one .header-contact ul li a:focus, 
		.header-one .header-contact ul li a:active, 
		.header-one .social-profile ul li a:hover, 
		.header-one .social-profile ul li a:focus, 
		.header-one .social-profile ul li a:active, 
		.header-two .header-contact ul li a:hover, 
		.header-two .header-contact ul li a:focus, 
		.header-two .header-contact ul li a:active, 
		.header-two .social-profile ul li a:hover, 
		.header-two .social-profile ul li a:focus, 
		.header-two .social-profile ul li a:active, 
		.header-three .header-contact ul li a:hover, 
		.header-three .header-contact ul li a:focus, 
		.header-three .header-contact ul li a:active, 
		.header-three .social-profile ul li a:hover, 
		.header-three .social-profile ul li a:focus, 
		.header-three .social-profile ul li a:active {
			color: '. esc_attr( $site_hover_color ) .';
		}
		.header-one .alt-menu-icon a:hover .icon-bar, 
		.header-one .alt-menu-icon a:focus .icon-bar, 
		.header-one .alt-menu-icon a:active .icon-bar, 
		.header-one .alt-menu-icon a:hover .icon-bar:before,
		.header-one .alt-menu-icon a:focus .icon-bar:before,
		.header-one .alt-menu-icon a:active .icon-bar:before, 
		.header-one .alt-menu-icon a:hover .icon-bar:after,
		.header-one .alt-menu-icon a:focus .icon-bar:after,
		.header-one .alt-menu-icon a:active .icon-bar:after,
		.header-two .alt-menu-icon a:hover .icon-bar, 
		.header-two .alt-menu-icon a:focus .icon-bar, 
		.header-two .alt-menu-icon a:active .icon-bar, 
		.header-two .alt-menu-icon a:hover .icon-bar:before,
		.header-two .alt-menu-icon a:focus .icon-bar:before,
		.header-two .alt-menu-icon a:active .icon-bar:before, 
		.header-two .alt-menu-icon a:hover .icon-bar:after,
		.header-two .alt-menu-icon a:focus .icon-bar:after,
		.header-two .alt-menu-icon a:active .icon-bar:after {
			background-color: '. esc_attr( $site_hover_color ) .';
		}
	';


	/* Mid Header Background */
	$mid_header_background_color = get_theme_mod( 'mid_header_background_color', '' );
	$mid_header_text_color = get_theme_mod( 'mid_header_text_color', '#101010' );
	$css .= '
		.mid-header .overlay {
			background-color: '. esc_attr( $mid_header_background_color ) .';
		}
	';

	$css .= '
		.header-one:not(.sticky-header) .mid-header {
			color: '. esc_attr( $mid_header_text_color ) .';
		}
		.slicknav_btn .slicknav_icon span,
		.slicknav_btn .slicknav_icon span:first-child:before, 
		.slicknav_btn .slicknav_icon span:first-child:after {
			color: '. esc_attr( $mid_header_text_color ) .';
		}
	';

	/* Bottom Header Background */
	$bottom_header_one_background_color = get_theme_mod( 'bottom_header_one_background_color', '#ffffff' );
	$bottom_header_two_background_color = get_theme_mod( 'bottom_header_two_background_color', '' );
	$bottom_header_three_background_color = get_theme_mod( 'bottom_header_three_background_color', '' );
	$bottom_header_text_color = get_theme_mod( 'bottom_header_text_color', '#333333' );
	$css .= '
		.header-one .bottom-header {
			background-color: '. esc_attr( $bottom_header_one_background_color ) .';
		}
	';

	$css .= '
		.header-two .bottom-header .overlay {
			background-color: '. esc_attr( $bottom_header_two_background_color ) .';
		}
	';

	$css .= '
		.header-three .bottom-header .overlay {
			background-color: '. esc_attr( $bottom_header_three_background_color ) .';
		}
	';

	$css .= '
		.header-one .main-navigation ul.nav-menu > li > a, 
		.header-one .header-icons .search-icon,
		.header-two .main-navigation ul.nav-menu > li > a,
		.home .header-three:not(.sticky-header) .main-navigation ul.nav-menu > li > a {
			color: '. esc_attr( $bottom_header_text_color ) .';
		}
		.slicknav_btn .slicknav_icon span,
		.slicknav_btn .slicknav_icon span:first-child:before, 
		.slicknav_btn .slicknav_icon span:first-child:after {
			background-color: '. esc_attr( $bottom_header_text_color ) .';
		}
		.header-one .main-navigation ul.nav-menu > li > a:hover, 
		.header-one .main-navigation ul.nav-menu > li > a:focus, 
		.header-one .main-navigation ul.nav-menu > li > a:active, 
		.header-one .header-icons .search-icon:hover, 
		.header-one .header-icons .search-icon:focus, 
		.header-one .header-icons .search-icon:active, 
		.header-two .main-navigation ul.nav-menu > li > a:hover, 
		.header-two .main-navigation ul.nav-menu > li > a:focus, 
		.header-two .main-navigation ul.nav-menu > li > a:active, 
		.header-two .header-icons .search-icon:hover, 
		.header-two .header-icons .search-icon:focus, 
		.header-two .header-icons .search-icon:active, 
		.home .header-three .main-navigation ul.nav-menu > li > a:hover, 
		.home .header-three .main-navigation ul.nav-menu > li > a:focus, 
		.home .header-three .main-navigation ul.nav-menu > li > a:active, 
		.header-three .header-icons .search-icon:hover, 
		.header-three .header-icons .search-icon:focus, 
		.header-three .header-icons .search-icon:active {
			color: '. esc_attr( $site_hover_color ) .';
		}
	';
	$css .= '
		.header-one .alt-menu-icon .icon-bar, 
		.header-one .alt-menu-icon .icon-bar:before, 
		.header-one .alt-menu-icon .icon-bar:after {
			background-color: '. esc_attr( $bottom_header_text_color ) .';
		}
	';

	# Header Button
	$header_button_background_color = get_theme_mod( 'header_button_background_color', '#f9a032' );
	$header_button_text_color = get_theme_mod( 'header_button_text_color', '#ffffff' );
	$css .= '
		.site-header .header-btn .button-primary {
			background-color: '. esc_attr( $header_button_background_color ) .';
			color: '. esc_attr( $header_button_text_color ) .';
		}
		.site-header .header-btn .button-primary:hover,
		.site-header .header-btn .button-primary:focus,
		.site-header .header-btn .button-primary:active {
			background-color: '. esc_attr( $site_hover_color ) .';
			color: #ffffff;
		}
	';

	$css .= '
		.site-header .header-btn .button-outline {
			color: '. esc_attr( $header_button_text_color ) .';
			border-color: '. esc_attr( $header_button_text_color ) .';
		}
		.site-header .header-btn .button-outline:hover,
		.site-header .header-btn .button-outline:focus,
		.site-header .header-btn .button-outline:active,
		.home .header-three:not(.sticky-header) .header-btn .button-outline:hover,
		.home .header-three:not(.sticky-header) .header-btn .button-outline:focus,
		.home .header-three:not(.sticky-header) .header-btn .button-outline:active {
			border-color: '. esc_attr( $site_hover_color ) .';
			color: #ffffff;
		}
	';

	$css .= '
		.site-header .header-btn .button-text {
			color: '. esc_attr( $header_button_text_color ) .';
			padding: 0;
		}
		.site-header .header-btn .button-text:hover,
		.site-header .header-btn .button-text:focus,
		.site-header .header-btn .button-text:active {
			color: '. esc_attr( $site_hover_color ) .';
		}
	';

	# Header Button Border Radius
	$header_button_border_radius = get_theme_mod( 'header_button_border_radius', 0 );
	$css .= '
		.site-header .header-btn a {
			border-radius: '. esc_attr( $header_button_border_radius ) .'px;
		}
	';

	# Header Border
	if( get_theme_mod( 'disable_header_border', false ) ){
		$css .= '
			.top-header {
				border-bottom: none;
			}
		';
	}

	if( get_theme_mod( 'disable_header_below_border', false ) ){
		$css .= '
			.header-one .mid-header {
				border-bottom: none;
			}
		';
	}

	# Header Image / Slider
	#Header Image Height
	$header_image_height = get_theme_mod( 'header_image_height', 220 );
	$css .= '
		@media only screen and (min-width: 992px) {
			.site-header:not(.sticky-header) .header-image-wrap {
				height: '. esc_attr( $header_image_height ) .'px;
				width: 100%;
				position: relative;
			}
		}
	';

	# Header Image Sizes
	#Cover Size
	if( get_theme_mod( 'header_image_size', 'cover' ) == 'cover' ){
		$css .= '
			.header-slide-item {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: cover;
			}
		';
	}

	#Repeat Size
	if( get_theme_mod( 'header_image_size', 'cover' ) == 'pattern' ){
		$css .= '
			.header-slide-item {
				background-position: center center;
				background-repeat: repeat;
				background-size: inherit;
			}
		';
	}

	#Fit Size
	if( get_theme_mod( 'header_image_size', 'cover' ) == 'norepeat' ){
		$css .= '
			.header-slide-item {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: inherit;
			}
		';
	}

	#Parallax Scrolling
	if( !get_theme_mod( 'disable_parallax_scrolling', true ) ){
		$css .= '
		.header-slide-item {
				background-position: center center;
				background-attachment: fixed;
			}
		';
	}

	# Header Slider
	if( get_theme_mod( 'header_media_options', 'image' ) == 'slider' ){
		$css .= '
		#customize-control-header_image {
				display: none;
			}
		';
	}

	# Preloading Animations
	if( !get_theme_mod( 'disable_preloader', false )){
		#White Color to Fade
		if( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_white' ){
			$css .= '
				#site-preloader {
	    			background-color: #ffffff;
				}
			';
		}
		#Black Color to Fade
		if( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_black' ){
			$css .= '
				#site-preloader {
	    			background-color: #000000;
				}
			';
		}
	}

	#Top Notification Bar Sticy
	if( get_theme_mod( 'disable_sticky_notification_bar', false ) ){
		$css .= '
			.notification-bar.sticky {
    			position: relative;
			}
		';
	}

	$notification_bar_background_color = get_theme_mod( 'notification_bar_background_color', '#1a1a1a' );
	$notification_bar_title_color = get_theme_mod( 'notification_bar_title_color', '#ffffff' );
	$notification_bar_button_background_color = get_theme_mod( 'notification_bar_button_background_color', '#f9a032' );
	$notification_bar_button_text_color = get_theme_mod( 'notification_bar_button_text_color', '#ffffff' );
	$css .= '
		.notification-bar {
			background-color: '. esc_attr( $notification_bar_background_color ) .';
			color: '. esc_attr( $notification_bar_title_color ) .';
		}
	';

	$css .= '
		.notification-bar .button-primary {
			background-color: '. esc_attr( $notification_bar_button_background_color ) .';
			color: '. esc_attr( $notification_bar_button_text_color ) .';
		}
		.notification-bar .button-primary:hover,
		.notification-bar .button-primary:focus,
		.notification-bar .button-primary:active {
			color: #ffffff;
		}
	';

	$css .= '
		.notification-bar .button-outline {
			color: '. esc_attr( $notification_bar_button_text_color ) .';
			border-color: '. esc_attr( $notification_bar_button_text_color ) .';
		}
		.notification-bar .button-outline:hover,
		.notification-bar .button-outline:focus,
		.notification-bar .button-outline:active {
			border-color: '. esc_attr( $site_hover_color ) .';
			color: #ffffff;
		}
	';

	$css .= '
		.notification-bar .button-container .button-text {
			color: '. esc_attr( $notification_bar_button_text_color ) .';
			padding: 0;
		}
		.notification-bar .button-container .button-text:hover,
		.notification-bar .button-container .button-text:focus,
		.notification-bar .button-container .button-text:active {
			color: '. esc_attr( $site_hover_color ) .';
		}
	';

	# Notification Button Border Radius
	$notification_bar_button_border_radius = get_theme_mod( 'notification_bar_button_border_radius', 0 );
	$css .= '
		.notification-bar .button-container a {
			border-radius: '. esc_attr( $notification_bar_button_border_radius ) .'px;
		}
	';

	# Fixed Header
	if( get_theme_mod( 'disable_mobile_fixed_header', true ) ){
		$css .= '
			@media screen and (max-width: 991px){
				.site-header.sticky-header .fixed-header {
				    position: static;
				}
				.header-one.sticky-header .mid-header {
					position: static;
				}
			}
		';
	}

	# Main Slider / Image
	#Height
	$main_slider_height = get_theme_mod( 'main_slider_height', 550 );
	$css .= '
		@media only screen and (min-width: 992px) {
			.banner-img {
				height: '. esc_attr( $main_slider_height ) .'px;
				overflow: hidden;
			}
		}
	';

	# Slider Button Border Radius
	$slider_button_border_radius = get_theme_mod( 'slider_button_border_radius', 0 );
	$css .= '
		.section-banner .slide-inner .banner-content .button-container a {
			border-radius: '. esc_attr( $slider_button_border_radius ) .'px;
		}
	';

	# Banner Button Border Radius
	$banner_button_border_radius = get_theme_mod( 'banner_button_border_radius', 0 );
	$css .= '
		.section-banner .banner-content .button-container a {
			border-radius: '. esc_attr( $banner_button_border_radius ) .'px;
		}
	';

	#Image Sizes Slider
	#Cover Size
	if( get_theme_mod( 'main_slider_image_size', 'cover' ) == 'cover' ){
		$css .= '
			.main-slider .banner-img {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: cover;
			}
		';
	}

	#Repeat Size
	if( get_theme_mod( 'main_slider_image_size', 'cover' ) == 'pattern' ){
		$css .= '
			.main-slider .banner-img {
				background-position: center center;
				background-repeat: repeat;
				background-size: inherit;
			}
		';
	}

	#Fit Size
	if( get_theme_mod( 'main_slider_image_size', 'cover' ) == 'norepeat' ){
		$css .= '
			.main-slider .banner-img {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: inherit;
			}
		';
	}

	#Image Sizes Banner
	#Cover Size
	if( get_theme_mod( 'main_banner_image_size', 'cover' ) == 'cover' ){
		$css .= '
			.banner-img {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: cover;
			}
		';
	}

	#Repeat Size
	if( get_theme_mod( 'main_banner_image_size', 'cover' ) == 'pattern' ){
		$css .= '
			.banner-img {
				background-position: center center;
				background-repeat: repeat;
				background-size: inherit;
			}
		';
	}

	#Fit Size
	if( get_theme_mod( 'main_banner_image_size', 'cover' ) == 'norepeat' ){
		$css .= '
			.banner-img {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: inherit;
			}
		';
	}

	# Footer Image Sizes
	#Cover Size
	if( get_theme_mod( 'footer_image_size', 'cover' ) == 'cover' ){
		$css .= '
			.site-footer.has-footer-bg {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: cover;
			}
		';
	}

	#Repeat Size
	if( get_theme_mod( 'footer_image_size', 'cover' ) == 'pattern' ){
		$css .= '
			.site-footer.has-footer-bg {
				background-position: center center;
				background-repeat: repeat;
				background-size: inherit;
			}
		';
	}

	#Fit Size
	if( get_theme_mod( 'footer_image_size', 'cover' ) == 'norepeat' ){
		$css .= '
			.site-footer.has-footer-bg {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: inherit;
			}
		';
	}

	# Footer Widget Borders
	if( get_theme_mod( 'disable_footer_widget_title_border', false ) ){
		$css .= '
			.site-footer .widget .widget-title::before {
				display: none;
			}
		';
	}

	if( get_theme_mod( 'disable_footer_widget_list_item_border', false ) ){
		$css .= '
			.latest-posts-widget .post,
			.widget ul li {
				border-bottom: none;
			}
		';
	}

	# Top Footer Color
	$top_footer_background_color = get_theme_mod( 'top_footer_background_color', '' );
	$top_footer_widget_title_color = get_theme_mod( 'top_footer_widget_title_color', '#030303' );
	$top_footer_widget_link_color = get_theme_mod( 'top_footer_widget_link_color', '#656565' );
	$top_footer_widget_content_color = get_theme_mod( 'top_footer_widget_content_color', '#656565' );
	$css .= '
		.top-footer {
			background-color: '. esc_attr( $top_footer_background_color ) .';
		}
	';

	$css .= '
		.site-footer h1, 
		.site-footer h2, 
		.site-footer h3, 
		.site-footer h4, 
		.site-footer h5, 
		.site-footer h6 {
			color: '. esc_attr( $top_footer_widget_title_color ) .';
		}
	';

	$css .= '
		.site-footer .widget .widget-title:before {
			background-color: '. esc_attr( $top_footer_widget_title_color ) .';
		}
	';
	$css .= '
		.site-footer a, 
		.site-footer .widget ul li a,
		.widget .tagcloud a,
		.site-footer .post .entry-meta a {
			color: '. esc_attr( $top_footer_widget_link_color ) .';
		}
		/* Hover Text */
		.site-footer a:hover, .site-footer a:focus, .site-footer a:active, 
		.site-footer .widget ul li a:hover, .site-footer .widget ul li a:focus.site-footer .widget ul li a:active,
		.site-footer .post .entry-meta a:hover, .site-footer .post .entry-meta a:focus, .site-footer .post .entry-meta a:active {
			color: '. esc_attr( $site_hover_color ) .';
		}
	';

	$css .= '
		.site-footer,
		.site-footer table th, 
		.site-footer table td,
		.site-footer .widget.widget_calendar table {
			color: '. esc_attr( $top_footer_widget_content_color ) .';
		}
	';

	# Bottom Footer Color
	$bottom_footer_background_color = get_theme_mod( 'bottom_footer_background_color', '' );
	$bottom_footer_text_color = get_theme_mod( 'bottom_footer_text_color', '' );
	$bottom_footer_text_link_color = get_theme_mod( 'bottom_footer_text_link_color', '' );
	$css .= '
		.bottom-footer {
			background-color: '. esc_attr( $bottom_footer_background_color ) .';
		}
	';

	$css .= '
		.bottom-footer {
			color: '. esc_attr( $bottom_footer_text_color ) .';
		}
	';

	$css .= '
		.site-footer .social-profile ul li a {
			background-color: '. esc_attr( gutener_hex2rgba( $bottom_footer_text_link_color, 0.1 ) ).';
		}
	';

	$css .= '
		.site-footer .social-profile ul li a {
			color: '. esc_attr( $bottom_footer_text_link_color ) .';
		}
	';
	
	$css .= '
		.site-info a, .site-footer .footer-menu ul li a {
			color: '. esc_attr( $bottom_footer_text_link_color ) .';
		}
	';

	# Social Media Size
	$social_icons_size = get_theme_mod( 'social_icons_size', 15 );
	$css .= '
		.site-footer .social-profile ul li a {
			font-size: '. esc_attr( $social_icons_size ) .'px;
		}
	';

	#Parallax Scrolling
	if( !get_theme_mod( 'disable_footer_parallax_scrolling', true ) ){
		$css .= '
		.site-footer {
				background-position: center center;
				background-attachment: fixed;
			}
		';
	}

	#Image Sizes Highlighted Posts
	#Cover Size
	if( get_theme_mod( 'highlight_posts_image_size', 'cover' ) == 'cover' ){
		$css .= '
			.highlight-posts-content-wrap .highlight-posts-image {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: cover;
			}
		';
	}

	#Repeat Size
	if( get_theme_mod( 'highlight_posts_image_size', 'cover' ) == 'pattern' ){
		$css .= '
			.highlight-posts-content-wrap .highlight-posts-image {
				background-position: center center;
				background-repeat: repeat;
				background-size: inherit;
			}
		';
	}

	#Fit Size
	if( get_theme_mod( 'highlight_posts_image_size', 'cover' ) == 'norepeat' ){
		$css .= '
			.highlight-posts-content-wrap .highlight-posts-image {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: inherit;
			}
		';
	}
	
	#Global Layouts
	if( get_theme_mod( 'disable_site_layout_shadow', false ) ){
		$css .= '
			.site-layout-box .site, .site-layout-frame .site {
    			box-shadow: none;
			}
		';
	}

    #Blog Page
    $blog_post_title_color = get_theme_mod( 'blog_post_title_color', '' );
    $blog_post_category_color = get_theme_mod( 'blog_post_category_color', '' );
    $blog_post_meta_color = get_theme_mod( 'blog_post_meta_color', '' );
    $blog_post_text_color = get_theme_mod( 'blog_post_text_color', '' );
    $blog_post_button_color = get_theme_mod( 'blog_post_button_color', '' );
    $css .= '
    	.entry-title {
    		color: '. esc_attr( $blog_post_title_color ) .';
    	}

    	.entry-title a:hover, .entry-title a:focus, .entry-title a:active {
    		color: '. esc_attr( $site_hover_color ) .';
    	}
    ';

    $css .= '
    	.post .entry-content .entry-header .cat-links a,
    	.banner-content .entry-content .entry-header .cat-links a {
    		color: '. esc_attr( $blog_post_category_color ) .';
    	}

    	.post .entry-content .entry-header .cat-links a:hover, 
    	.post .entry-content .entry-header .cat-links a:focus, 
    	.post .entry-content .entry-header .cat-links a:active {
    		color: '. esc_attr( $site_hover_color ) .';
    	}
    ';

    $css .= '
    	.post .entry-content .entry-header .cat-links a, 
    	.attachment .entry-content .entry-header .cat-links a, 
    	.banner-content .entry-content .entry-header .cat-links a {
    		border-color: '. esc_attr( $blog_post_category_color ) .';
    	}
    ';

    $css .= '
    	.hentry .entry-meta a, .banner-content .entry-meta a {
    		color: '. esc_attr( $blog_post_meta_color ) .';
    	}
    ';

    $css .= '
    	.post .entry-text {
    		color: '. esc_attr( $blog_post_text_color ) .';
    	}
    ';

    $css .= '
    	.post .button-text {
    		color: '. esc_attr( $blog_post_button_color ) .';
    	}
    	.post .button-text:hover, .post .button-text:focus, .post .button-text:active {
    		color: '. esc_attr( $site_hover_color ) .';
    	}
    ';
    
    # Post Button Border Radius
	$post_button_border_radius = get_theme_mod( 'post_button_border_radius', 0 );
	$css .= '
		.post .button-container a {
			border-radius: '. esc_attr( $post_button_border_radius ) .'px;
		}
	';

	#Responsive
	#Notification Bar
	if( get_theme_mod( 'disable_mobile_notification_bar', true ) ){
		$css .= '
			@media screen and (max-width: 767px){
				.notification-bar {
	    			display: none;
	    			padding: 0;
				}
			}
		';
	}
	#Main Slider / Banner
	if( get_theme_mod( 'disable_mobile_main_slider', false ) ){
		$css .= '
			@media screen and (max-width: 767px){
				.main-slider, .homepage-banner {
	    			display: none;
				}
			}
		';
	}

	#Scroll to Top
	if( get_theme_mod( 'disable_mobile_scroll_top', true ) ){
		$css .= '
			@media screen and (max-width: 767px){
				#back-to-top {
	    			display: none !important;
				}
			}
		';
	}

	# Blog Homepage
	#Highlight Posts
	$highlight_posts_height = get_theme_mod( 'highlight_posts_height', 250 );
	$css .= '
		@media only screen and (min-width: 992px) {
			.highlight-posts-content-wrap .highlight-posts-image {
				height: '. esc_attr( $highlight_posts_height ) .'px;
				overflow: hidden;
			}
		}
	';

	#Feature Posts
	if( get_theme_mod( 'disable_mobile_feature_posts', false ) ){
		$css .= '
			@media screen and (max-width: 767px){
				.section-feature-post {
	    			display: none;
				}
			}
		';
	}

	#Highlight Posts
	if( get_theme_mod( 'disable_highlight_title_divider', false ) ){
		$css .= '
			.highlight-posts-content-wrap .highlight-posts-content:before {
    			display: none;
			}
		';
	}

	// end style block
	$css .= '</style>';

	// return generated & compressed CSS
	echo str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css); 
}
add_action( 'wp_head', 'gutener_default_styles' );