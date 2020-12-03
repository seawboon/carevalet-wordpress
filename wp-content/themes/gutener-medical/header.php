<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gutener Medical
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<?php if( !get_theme_mod( 'disable_preloader', false )): ?>
	<div id="site-preloader">
		<div class="preloader-content">
			<?php
				$src = '';
				if( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_one' ){
					$src = get_template_directory_uri() . '/assets/images/preloader1.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_two' ){
					$src = get_template_directory_uri() . '/assets/images/preloader2.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_three' ){
					$src = get_template_directory_uri() . '/assets/images/preloader3.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_four' ){
					$src = get_template_directory_uri() . '/assets/images/preloader4.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_five' ){
					$src = get_template_directory_uri() . '/assets/images/preloader5.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_site_logo' ){
					$src = gutener_get_custom_logo_url();
				}

				echo apply_filters( 'gutener_preloader',
				sprintf( '<img src="%s" alt="%s">',
					esc_url( $src ), ''
				)); 
			?>
		</div>
	</div>
<?php endif; ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gutener-medical' ); ?></a>

	<?php
	if ( !empty( get_theme_mod( 'notification_bar_title', '' ) ) || !empty( get_theme_mod( 'notification_bar_button_text', '' ) ) ) {
		$link_target = '';
		if( get_theme_mod( 'notification_bar_button_target', true ) ){
			$link_target = '_blank';
		}else {
			$link_target = '';
		}
		if( !get_theme_mod( 'disable_sticky_notification_bar', false ) ){
			$sticky_class = 'sticky';
		}else {
			$sticky_class = '';
		}

		$button_type = 'button-primary';
		if ( get_theme_mod( 'notification_bar_button_type', 'button-primary' ) == 'button-outline' ){
			$button_type = 'button-outline';
		}elseif ( get_theme_mod( 'notification_bar_button_type', 'button-primary' ) == 'button-text' ){
			$button_type = 'button-text';
		}

		if( !get_theme_mod( 'disable_notification_bar', true ) ){ ?>
			<div class="notification-bar <?php echo esc_html( $sticky_class ); ?>">
				<header class="notification-content">
					<span><?php echo esc_html(get_theme_mod( 'notification_bar_title', '' ));?></span>
				</header>
				<?php 
					if ( !empty( get_theme_mod( 'notification_bar_button_text', 'View More' ) ) ) {
				?>
						<div class="button-container">
							<a href="<?php echo esc_url(get_theme_mod( 'notification_bar_button_link', '' )); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="<?php echo esc_attr( $button_type ); ?>">
							<?php echo esc_html(get_theme_mod( 'notification_bar_button_text', '' ));?>
						</a>
						</div>
				<?php } ?>
			</div>
	<?php }
	}
	// Header Layouts
	$header_image_slider = get_theme_mod( 'header_image_slider', '' );
	?>

	<?php if( get_theme_mod( 'header_layout', 'header_two' ) == '' || get_theme_mod( 'header_layout', 'header_two' ) == 'header_one' ){ ?>
		<header id="masthead" class="site-header header-one">
			<?php
				$social_icons = get_theme_mod( 'social_media_links' );
				if( ( !get_theme_mod( 'disable_header_social_links', false ) && !empty( $social_icons ) ) || ( !get_theme_mod( 'disable_contact_detail', false ) && ( !empty(get_theme_mod( 'contact_phone', '' ) ) || !empty(get_theme_mod( 'contact_email', '' ) ) || !empty(get_theme_mod( 'contact_address', '' ) ) ) ) ){ ?>
					<div class="top-header">
						<div class="container">
							<div class="row align-items-center">
								<div class="col-lg-7">
									<?php get_template_part( 'template-parts/header', 'contact' ); ?>
								</div>
								<div class="col-lg-5">
									<div class="header-icons">
										<div class="social-profile">
											<?php
										        if( !get_theme_mod( 'disable_header_social_links', false ) && !empty( $social_icons ) && is_array( $social_icons ) ){

										            echo '<ul class="social-group">';
										            $count = 0.2;
										            foreach( $social_icons as $value ){
										                echo '<li><a href="' . esc_url( $value['link'] ) . '"><i class=" ' . esc_attr( $value['icon'] ) . '"></i></a></li>';
										                $count = $count + 0.2;
										            }
										            echo '</ul>';
						        				}
					        				?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			<?php } ?>

			<div class="mid-header header-image-wrap">
			<?php 
			if( get_theme_mod( 'header_media_options', 'slider' ) == 'slider' ){
				if( get_theme_mod( 'header_image_slider', '' ) ){ ?>
					<div class="header-image-slider">
					    <?php foreach( $header_image_slider as $slider_item ) : ?>
					      <div class="header-slide-item" style="background-image: url( <?php echo esc_url( wp_get_attachment_url( $slider_item['slider_item'] ) ); ?> )"><div class="slider-inner"></div>
					      </div>
					    <?php endforeach; ?>
					</div>
					<?php if( !get_theme_mod( 'disable_header_slider_arrows', false ) ) { ?>
						<ul class="slick-control">
					        <li class="header-slider-prev">
					        	<span></span>
					        </li>
					        <li class="header-slider-next">
					        	<span></span>
					        </li>
					    </ul>
					<?php }
					}
			} ?>
				<div class="container">
					<?php get_template_part( 'template-parts/site', 'branding' ); ?>
					<div id="slicknav-mobile" class="d-block d-lg-none"></div>
				</div>
				<div class="overlay"></div>
			</div>
			<?php 
			if( has_nav_menu( 'menu-1') || !get_theme_mod( 'disable_search_icon', false ) || !get_theme_mod( 'disable_hamburger_menu_icon', false ) ){ ?>
				<div class="bottom-header fixed-header">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-lg-10">
								<?php if( has_nav_menu( 'menu-1') ) { ?>
									<nav id="site-navigation" class="main-navigation d-none d-lg-block">
										<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'gutener-medical' ); ?></button>
										<?php
										wp_nav_menu( array(
											'theme_location' => 'menu-1',
											'menu_id'        => 'primary-menu',
										) );
										?>
									</nav><!-- #site-navigation -->
								<?php } ?>
							</div>
							<div class="col-lg-2">
								<div class="header-icons">
									<!-- Search form structure -->
									<?php if( !get_theme_mod( 'disable_search_icon', false ) ): ?>
										<div id="search-form" class="header-search-wrap ">
											<button class="search-icon">
												<span class="fas fa-search"></span>
											</button>
										</div>
									<?php endif; ?>
									<?php if( !get_theme_mod( 'disable_hamburger_menu_icon', false ) && is_active_sidebar( 'menu-sidebar' ) ){ ?>
										<div class="alt-menu-icon d-none d-lg-inline-block">
											<a class="offcanvas-menu-toggler" href="#">
												<span class="icon-bar"></span>
											</a>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>	
					<!-- header search form -->
					<div class="header-search">
						<div class="container">
							<?php get_search_form(); ?>
							<button class="close-button">
								<span class="fas fa-times"></span>
							</button>
						</div>
					</div>
					<!-- header search form end-->
				</div>
			<?php } ?>
			<?php get_template_part( 'template-parts/offcanvas', 'menu' ); ?>
		</header><!-- #masthead -->
	<?php  }?>

	<?php if( get_theme_mod( 'header_layout', 'header_two' ) == 'header_two' ){ ?>
		<header id="masthead" class="site-header header-two">
			<?php
			 	$social_icons = get_theme_mod( 'social_media_links' );
				if( ( !get_theme_mod( 'disable_header_social_links', false ) && !empty( $social_icons ) ) || ( !get_theme_mod( 'disable_contact_detail', false ) && ( !empty(get_theme_mod( 'contact_phone', '' ) ) || !empty(get_theme_mod( 'contact_email', '' ) ) || !empty(get_theme_mod( 'contact_address', '' ) ) ) ) || !get_theme_mod( 'disable_search_icon', false ) || !get_theme_mod( 'disable_hamburger_menu_icon', false ) ){ ?>
					<div class="top-header">
						<div class="container">
							<div class="row align-items-center">
								<div class="col-lg-8">
									<?php get_template_part( 'template-parts/header', 'contact' ); ?>
								</div>
								<div class="col-lg-4">
									<div class="header-icons">
										<div class="social-profile">
											<?php								       
										        if( !get_theme_mod( 'disable_header_social_links', false ) && !empty( $social_icons ) && is_array( $social_icons ) ){

										            echo '<ul class="social-group">';
										            $count = 0.2;
										            foreach( $social_icons as $value ){
										                echo '<li><a href="' . esc_url( $value['link'] ) . '"><i class=" ' . esc_attr( $value['icon'] ) . '"></i></a></li>';
										                $count = $count + 0.2;
										            }
										            echo '</ul>';
						        				}
					        				?>
										</div>
										<!-- Search form structure -->
										<?php if( !get_theme_mod( 'disable_search_icon', false ) ): ?>
											<div id="search-form" class="header-search-wrap ">
												<button class="search-icon">
													<span class="fas fa-search"></span>
												</button>
											</div>
										<?php endif; ?>
										<?php if( !get_theme_mod( 'disable_hamburger_menu_icon', false ) && is_active_sidebar( 'menu-sidebar' ) ){ ?>
											<div class="alt-menu-icon d-none d-lg-inline-block">
												<a class="offcanvas-menu-toggler" href="#">
													<span class="icon-bar"></span>
												</a>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<!-- header search form -->
						<div class="header-search">
							<div class="container">
								<?php get_search_form(); ?>
								<button class="close-button">
									<span class="fas fa-times"></span>
								</button>
							</div>
						</div>
						<!-- header search form end-->
					</div>
			<?php } ?>
			<?php get_template_part( 'template-parts/offcanvas', 'menu' ); ?>
			<div class="bottom-header header-image-wrap fixed-header">
				<?php 
					if( get_theme_mod( 'header_media_options', 'slider' ) == 'slider' ){
						if( get_theme_mod( 'header_image_slider', '' ) ){ ?>
							<div class="header-image-slider">
							    <?php foreach( $header_image_slider as $slider_item ) : ?>
							      <div class="header-slide-item" style="background-image: url( <?php echo esc_url( wp_get_attachment_url( $slider_item['slider_item'] ) ); ?> )"><div class="slider-inner"></div>
							      </div>
							    <?php endforeach; ?>
							</div>
							<?php if( !get_theme_mod( 'disable_header_slider_arrows', false ) ) { ?>
								<ul class="slick-control">
							        <li class="header-slider-prev">
							        	<span></span>
							        </li>
							        <li class="header-slider-next">
							        	<span></span>
							        </li>
							    </ul>
							<?php }
							}
					} ?>
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-3">
							<?php get_template_part( 'template-parts/site', 'branding' ); ?>
							<div id="slicknav-mobile" class="d-block d-lg-none"></div>
						</div>
						<div class="col-lg-9 d-none d-lg-block">
							<div class="main-navigation-wrap">
								<?php if( has_nav_menu( 'menu-1') ){ ?>
									<nav id="site-navigation" class="main-navigation">
										<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'gutener-medical' ); ?></button>
										<?php
										wp_nav_menu( array(
											'theme_location' => 'menu-1',
											'menu_id'        => 'primary-menu',
										) );
										?>
									</nav><!-- #site-navigation -->
								<?php }
									$button_type = 'button-primary';
									if ( get_theme_mod( 'header_button_type', 'button-primary' ) == 'button-outline' ){
										$button_type = 'button-outline';
									}elseif ( get_theme_mod( 'header_button_type', 'button-primary' ) == 'button-text' ){
										$button_type = 'button-text';
									}

									$link_target = '';
									if( get_theme_mod( 'header_button_target', true ) ){
										$link_target = '_blank';
									}else {
										$link_target = '';
									}
								?>
								<?php
									if( get_theme_mod( 'header_button_text', '' ) ){ ?>
										<div class="header-btn">
											<a href="<?php echo esc_url(get_theme_mod( 'header_button_link', '' )); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="<?php echo esc_attr( $button_type ); ?>">
												<?php echo esc_html(get_theme_mod( 'header_button_text', '' )); ?>
											</a>
										</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="overlay"></div>
			</div>
		</header>
	<?php  }?>

	<?php if( get_theme_mod( 'header_layout', 'header_two' ) == 'header_three' ) { ?>
		<header id="masthead" class="site-header header-three">
			<div class="overlay-header">
				<?php
					$social_icons = get_theme_mod( 'social_media_links' );
					if( ( !get_theme_mod( 'disable_header_social_links', false ) && !empty( $social_icons ) ) || ( !get_theme_mod( 'disable_contact_detail', false ) && ( !empty(get_theme_mod( 'contact_phone', '' ) ) || !empty(get_theme_mod( 'contact_email', '' ) ) || !empty(get_theme_mod( 'contact_address', '' ) ) ) ) || !get_theme_mod( 'disable_search_icon', false ) || !get_theme_mod( 'disable_hamburger_menu_icon', false ) ){ ?>
						<div class="top-header">
							<div class="container">
								<div class="row align-items-center">
									<div class="col-lg-8">
										<?php get_template_part( 'template-parts/header', 'contact' ); ?>
									</div>
									<div class="col-lg-4">
										<div class="header-icons">
											<div class="social-profile">
												<?php        
											        if( !get_theme_mod( 'disable_header_social_links', false ) && !empty( $social_icons ) && is_array( $social_icons ) ){

											            echo '<ul class="social-group">';
											            $count = 0.2;
											            foreach( $social_icons as $value ){
											                echo '<li><a href="' . esc_url( $value['link'] ) . '"><i class=" ' . esc_attr( $value['icon'] ) . '"></i></a></li>';
											                $count = $count + 0.2;
											            }
											            echo '</ul>';
							        				}
						        				?>
											</div>
											<!-- Search form structure -->
											<?php if( !get_theme_mod( 'disable_search_icon', false ) ): ?>
												<div id="search-form" class="header-search-wrap ">
													<button class="search-icon">
														<span class="fas fa-search"></span>
													</button>
												</div>
											<?php endif; ?>
											<?php if( !get_theme_mod( 'disable_hamburger_menu_icon', false ) && is_active_sidebar( 'menu-sidebar' ) ){ ?>
												<div class="alt-menu-icon d-none d-lg-inline-block">
													<a class="offcanvas-menu-toggler" href="#">
														<span class="icon-bar"></span>
													</a>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<!-- header search form -->
							<div class="header-search">
								<div class="container">
									<?php get_search_form(); ?>
									<button class="close-button">
										<span class="fas fa-times"></span>
									</button>
								</div>
							</div>
							<!-- header search form end-->
						</div>
				<?php } ?>
				<?php get_template_part( 'template-parts/offcanvas', 'menu' ); ?>
				<div class="bottom-header header-image-wrap fixed-header">
					<?php 
						if( get_theme_mod( 'header_media_options', 'slider' ) == 'slider' ){
							if( get_theme_mod( 'header_image_slider', '' ) ){ ?>
								<div class="header-image-slider">
								    <?php foreach( $header_image_slider as $slider_item ) : ?>
								      <div class="header-slide-item" style="background-image: url( <?php echo esc_url( wp_get_attachment_url( $slider_item['slider_item'] ) ); ?> )"><div class="slider-inner"></div>
								      </div>
								    <?php endforeach; ?>
								</div>
								<?php if( !get_theme_mod( 'disable_header_slider_arrows', false ) ) { ?>
									<ul class="slick-control">
								        <li class="header-slider-prev">
								        	<span></span>
								        </li>
								        <li class="header-slider-next">
								        	<span></span>
								        </li>
								    </ul>
								<?php }
								}
						} ?>
					<div class="container">
						<div class="row align-items-center">
							<div class="col-lg-3">
								<?php get_template_part( 'template-parts/site', 'branding' ); ?>
								<div id="slicknav-mobile" class="d-block d-lg-none"></div>
							</div>
							<div class="col-lg-9 d-none d-lg-block">
								<div class="main-navigation-wrap">
									<?php if( has_nav_menu( 'menu-1') ){ ?>
										<nav id="site-navigation" class="main-navigation">
											<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'gutener-medical' ); ?></button>
											<?php
											wp_nav_menu( array(
												'theme_location' => 'menu-1',
												'menu_id'        => 'primary-menu',
											) );
											?>
										</nav><!-- #site-navigation -->
									<?php }
										$button_type = 'button-primary';
										if ( get_theme_mod( 'header_button_type', 'button-primary' ) == 'button-outline' ){
											$button_type = 'button-outline';
										}elseif ( get_theme_mod( 'header_button_type', 'button-primary' ) == 'button-text' ){
											$button_type = 'button-text';
										}

										$link_target = '';
										if( get_theme_mod( 'header_button_target', true ) ){
											$link_target = '_blank';
										}else {
											$link_target = '';
										}
									?>
									<?php
										if( get_theme_mod( 'header_button_text', '' ) ){ ?>
											<div class="header-btn">
												<a href="<?php echo esc_url( get_theme_mod( 'header_button_link', '' )); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="<?php echo esc_attr( $button_type ); ?>">
													<?php echo esc_html( get_theme_mod( 'header_button_text', '' ));?>
												</a>
											</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="overlay"></div>
				</div>
			</div>
		</header><!-- #masthead -->
	<?php } ?>