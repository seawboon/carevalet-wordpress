<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gutener
 */

?>
		<?php if( !get_theme_mod( 'disable_instagram', true ) ){
			if( get_theme_mod( 'enable_instagram_homepage', false ) && !is_home() ){
				// this condition will disable instagram section from home page only
				echo '';
			}else {
				?>
				<section class="section-instagram-wrapper">
					<div class="container">
						<?php 
							/**
							* Prints Instagram
							* 
							* @since Gutener 1.0.0
							*/
							if( !get_theme_mod( 'disable_instagram', false ) ){
								echo do_shortcode( get_theme_mod( 'insta_shortcode' ) );
							}
						?>
					</div>
				</section>	
			<?php
			}
		} ?>
		</div><!-- #container -->
	</div><!-- #content -->
	<?php
		$footer_layout = '';
		if( get_theme_mod( 'footer_layout', 'footer_one' ) == 'footer_one'){
			$footer_layout = 'site-footer-primary';
		}elseif( get_theme_mod( 'footer_layout', 'footer_one' ) == 'footer_two'){
			$footer_layout = 'site-footer-two';
		}elseif( get_theme_mod( 'footer_layout', 'footer_one' ) == 'footer_three'){
			$footer_layout = 'site-footer-three';
		}
		
		$has_footer_bg = '';
		$footer_image = get_theme_mod( 'footer_image', '' );
		$footer_bottom_bg_color = get_theme_mod( 'bottom_footer_background_color', '' );
		$footer_top_bg_color = get_theme_mod( 'top_footer_background_color', '' );
		if ( $footer_image || $footer_bottom_bg_color || $footer_top_bg_color ){
			$has_footer_bg = 'has-footer-bg';
		}

		$footer_widget_columns_class = 'col-lg-3';
		if( get_theme_mod( 'top_footer_widget_columns' , 'four_columns' ) == 'three_columns' ){
			$footer_widget_columns_class = 'col-lg-4';
		}elseif( get_theme_mod( 'top_footer_widget_columns' , 'four_columns' ) == 'two_columns' ){
			$footer_widget_columns_class = 'col-lg-6';
		}elseif( get_theme_mod( 'top_footer_widget_columns' , 'four_columns' ) == 'one_column' ){
			$footer_widget_columns_class = 'col-lg-12';
		}
	?>

	<footer id="colophon" class="site-footer <?php echo esc_attr( $footer_layout . ' ' . $has_footer_bg ) ?>" style="background-image: url(<?php echo esc_url( $footer_image ) ?>">
		<?php if( !get_theme_mod( 'disable_footer_widget', false ) ):
		 if( gutener_is_active_footer_sidebar() ): ?>
			<div class="top-footer">
				<div class="wrap-footer-sidebar">
					<div class="container">
						<div class="footer-widget-wrap">
							<div class="row">
							<?php
								$count = 0;
								for( $i = 1; $i <= 4; $i++ ){
									?>
										<?php if ( is_active_sidebar( 'footer-sidebar-'.$i ) ) : ?>
											<div class="col-sm-6 col-12 footer-widget-item <?php echo esc_attr( $footer_widget_columns_class ); ?>">
											<?php dynamic_sidebar( 'footer-sidebar-'.$i ); ?>
											</div>
										<?php endif; ?>
									<?php
								}
								if( $count > 0 ){
									$return = true;
								}else{
									$return = false;
								}
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
			endif;
		endif;
		?>
		<?php if( !get_theme_mod( 'disable_bottom_footer', false ) ) { ?>
			<?php 
			$defaults = '';
			$social_icons = get_theme_mod( 'social_media_links', $defaults );
			$has_social_icon = false;
			if ( is_array( $social_icons ) ){
				foreach( $social_icons as $value ){
					if( !empty( $value['icon'] ) ){
						$has_social_icon = true;
						break;
					}
				}
			}
			if( get_theme_mod( 'footer_layout', 'footer_one' ) == '' || get_theme_mod( 'footer_layout', 'footer_one' ) == 'footer_one' ){ ?>
				<div class="bottom-footer">
					<div class="container">
						 <!-- social links area -->
							<?php 
							    if( !get_theme_mod( 'disable_footer_social_links', false ) && $has_social_icon ){ ?>
							    	<div class="social-profile">
								        <?php echo '<ul class="social-group">';
								        $count = 0.2;
								        foreach( $social_icons as $value ){
								            if ( $value['new_tab'] ){
								        		$new_tab = '_blank';
								        	}else{
								        		$new_tab = '';
								        	}
								            echo '<li><a href="' . esc_url( $value['link'] ) . '" target="' .esc_html( $new_tab ). '"><i class=" ' . esc_attr( $value['icon'] ) . '"></i></a></li>';
								            $count = $count + 0.2;
								        }
								        echo '</ul>'; ?>
							        </div>
							<?php } ?> <!-- social links area -->
							<?php get_template_part( 'template-parts/site', 'info' ); ?>
							<?php if ( has_nav_menu( 'menu-2' ) && !get_theme_mod( 'disable_footer_menu', false )){ ?>
								<div class="footer-menu"><!-- Footer Menu-->
									<?php
									wp_nav_menu( array(
										'theme_location' => 'menu-2',
										'menu_id'        => 'footer-menu',
										'depth'          => 1,
									) );
									?>
								</div><!-- footer Menu-->
							<?php } ?>
					</div> 
				</div>
			<?php } ?>

			<?php if( get_theme_mod( 'footer_layout', 'footer_one' ) == 'footer_two' ){ ?>
				<div class="bottom-footer">
					<div class="container">
						<!-- social links area -->
						<?php 
						    if( !get_theme_mod( 'disable_footer_social_links', false ) && $has_social_icon ){ ?>
						    	<div class="social-profile">
							        <?php echo '<ul class="social-group">';
							        $count = 0.2;
							        foreach( $social_icons as $value ){
							            if ( $value['new_tab'] ){
							        		$new_tab = '_blank';
							        	}else{
							        		$new_tab = '';
							        	}
							            echo '<li><a href="' . esc_url( $value['link'] ) . '" target="' .esc_html( $new_tab ). '"><i class=" ' . esc_attr( $value['icon'] ) . '"></i></a></li>';
							            $count = $count + 0.2;
							        }
							        echo '</ul>'; ?>
						        </div>
						<?php } ?> <!-- social links area -->
						<?php if ( has_nav_menu( 'menu-2' ) && !get_theme_mod( 'disable_footer_menu', false )){ ?>
							<div class="footer-menu"><!-- Footer Menu-->
								<?php
								wp_nav_menu( array(
									'theme_location' => 'menu-2',
									'menu_id'        => 'footer-menu',
									'depth'          => 1,
								) );
								?>
							</div><!-- footer Menu-->
						<?php } ?>
						<?php get_template_part( 'template-parts/site', 'info' ); ?>
					</div>
				</div>
			<?php } ?>

			<?php if( get_theme_mod( 'footer_layout', 'footer_one' ) == 'footer_three' ){ ?>
				<div class="bottom-footer">
					<div class="container">
						<div class="row align-items-center">
							<?php 
								$socialEmptyClass = '';
								$social_icons = get_theme_mod( 'social_media_links' );
								if ( !get_theme_mod( 'disable_footer_social_links', false ) && $has_social_icon ){
									$socialEmptyClass = 'col-lg-8';
								}else{
									$socialEmptyClass = 'col-lg-12 text-center';
								}
							?>
							<?php 
							    if( !get_theme_mod( 'disable_footer_social_links', false ) && $has_social_icon ){ ?>
							    	<div class="col-lg-4">
								    	<div class="social-profile"> <!-- social links area -->
									        <?php echo '<ul class="social-group">';
									        $count = 0.2;
									        foreach( $social_icons as $value ){
									            if ( $value['new_tab'] ){
									        		$new_tab = '_blank';
									        	}else{
									        		$new_tab = '';
									        	}
									            echo '<li><a href="' . esc_url( $value['link'] ) . '" target="' .esc_html( $new_tab ). '"><i class=" ' . esc_attr( $value['icon'] ) . '"></i></a></li>';
									            $count = $count + 0.2;
									        }
									        echo '</ul>'; ?>
								        </div> <!-- social links area -->
							    	</div>
							<?php } ?> 
							<div class="<?php echo esc_attr( $socialEmptyClass ) ?>">
								<div class="footer-desc-wrap">
									<?php get_template_part( 'template-parts/site', 'info' ); ?>
									<?php if ( has_nav_menu( 'menu-2' ) && !get_theme_mod( 'disable_footer_menu', false )){ ?>
										<div class="footer-menu"><!-- Footer Menu-->
											<?php
											wp_nav_menu( array(
												'theme_location' => 'menu-2',
												'menu_id'        => 'footer-menu',
												'depth'          => 1,
											) );
											?>
										</div><!-- footer Menu-->
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } 
			}
		?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<div id="back-to-top">
    <a href="javascript:void(0)"><i class="fa fa-angle-up"></i></a>
</div>
<!-- #back-to-top -->

</body>
</html>
