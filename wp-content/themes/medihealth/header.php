<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="<?php bloginfo('charset'); ?>"> 
	<?php wp_head(); ?>
	<?php
	//Contact Info
	$medihealth_topbar 	= get_theme_mod('medihealth_topbar_setting', '');
	$medihealth_timing_details 	= get_theme_mod('medihealth_contact_info_timings_details', 'Open 24 Hours');
	$medihealth_phone_details 		= get_theme_mod('medihealth_contact_info_phone_details', '+1 203 356 3596');
	$medihealth_email_details 		= get_theme_mod('medihealth_contact_info_email_details', '');

	$medihealth_appointment_button_text = get_theme_mod('medihealth_contact_info_appointment_text', 'Book Appointment');
	$medihealth_appointment_button_link = get_theme_mod('medihealth_contact_info_appointment_link', '#');
	$medihealth_appointment_button_target = get_theme_mod('medihealth_contact_info_appointment_target', '');
	if($medihealth_appointment_button_target == '1') { $medihealth_button_target = '_new';  } else { $medihealth_button_target = ''; }
?>
</head>

<body <?php body_class(); ?> >
	<?php wp_body_open(); ?>
	<?php if ( get_header_image() != '') { ?>
		<header class="custom-header">
			<div class="wp-custom-header">
				<img src="<?php header_image(); ?>">
			</div>
		</header>
	<?php } ?>
	<!-- Header Section -->
	<header class="header-section">
		<?php if($medihealth_topbar == '1') { ?>
			<div class="header-top">
				<div class="container">
					<div class="row header_top_inner d-flex">
						<div class="col-md-9 d-flex text-left contact-info">
							<?php if($medihealth_timing_details != '') { ?>
								<div class="d-flex header_icon">
									<div class="icon mr-2 d-flex timings"><span class="icon_img"><i class="icon-topbar fas fa-clock"></i></span></div>
									<span class="text"><?php echo esc_html($medihealth_timing_details);?></span>
								</div>
							<?php } ?>
							<?php if($medihealth_phone_details != '') { ?>
								<div class=" d-flex header_icon">
									<div class="icon mr-2 d-flex phone"><span class="icon_img"><i class="icon-topbar fas fa-mobile-alt"></i></span></div>
									<span class="text"><?php echo esc_html($medihealth_phone_details);?></span>
								</div>
							<?php } ?>
							<?php if($medihealth_email_details != '') { ?>
								<div class="d-flex header_icon">
									<div class="icon mr-2 d-flex email"><span class="icon_img"><i class="icon-topbar fas fa-envelope-open-text"></i></span></div>
									<a href="mailto:<?php echo esc_url($medihealth_email_details);?>" target="blank" class="text"><?php echo esc_html($medihealth_email_details);?></a>
								</div>
							<?php } ?>
						</div>
						<div class="col-md-3 text-right appoint-btn">
							<?php if($medihealth_appointment_button_text != '') { ?>
								<div class=" mr-2 d-flex"></div>
								<a class="button" href="<?php echo esc_url($medihealth_appointment_button_link);?>" target="<?php echo esc_attr($medihealth_button_target);?>" ><button class="apointmnet_btn"><?php echo esc_html($medihealth_appointment_button_text);?></button></a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<div id="header">
			<div class="site-menu-content container">
				<div class="site-menu-content__wrap wrapper">
					<div class="site-branding">
						<?php
						if ( has_custom_logo() ) {
							the_custom_logo();
						}
						?>
						<div class="site-branding__title-wrap">
							<?php
							if (display_header_text() == true ) {
								?>
								<h1 class="site-title"><a class="site-link" href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
							}
							?>
							<p class="site-description"><?php bloginfo( 'description' ); ?></p>
						</div>
					</div>
					<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
						<!-- Nav Menu -->
						<nav id="site-navigation" class="main-navigation">
							
							<button type="button" id="hamburger-menu" class="open-nav-btn" aria-label="open navigation" aria-controls="primary-menu" aria-expanded="false"><i class="fas fa-bars"></i></button>
							 <div id="slide-nav" class="slide-content">
								<button type="button" id="close" class="close-btn" aria-label="close navigation"><i class="fas fa-times"></i></button>
									<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'medihealth' ); ?></span>
									<span class="main-navigation__icon">
										<span class="main-navigation__icon__middle"></span>
									</span>
								<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'primary-menu',
										'depth'           => 4,
										'menu_id'         => 'primary-menu',
										'container_class' => 'primary-menu-container',
										'walker'          => new Medihealth_Bootstrap_Navwalker(),
									)
								);
								?>
							</div>
						</nav>
						<!-- Nav Menu -->
					<?php } ?>
				</div>
			</div>
		</div>
	</header>
	<!-- Header Section -->