<?php
/**
 * Index
 *
 * @package Derma Care WordPress theme
 */
 
get_header(); 

	//Defaults
	$dermacare_breadcrumb = get_theme_mod('medihealth_breadcrumb_setting', '1');
?>
<!-- Breadcrumbs -->
	<?php 
		if($dermacare_breadcrumb == "1") { 
			get_template_part('breadcrumb'); 
		} 
	?>
<!-- Breadcrumbs -->

<!-- Blog -->
<section id="main-content" class="shop-section">
	<div class="container">
		<div class="row">
			<!-- Left Sidebar -->
			<?php
			// Page Layout Settings
			$page_layout = get_theme_mod('medihealth_page_layout','fullwidth');
			// Initialize Variable
			$default_class = "col-md-12 col-sm-12 col-xs-12";
			$blog_class = "col-md-4 col-sm-6 col-xs-12";
			
			// Check Sidebar Column Condition
			if( $page_layout == "rightsidebar" || $page_layout == "leftsidebar" && is_active_sidebar( 'sidebar-widget' )  ) {
				$default_class = "col-md-8 col-sm-6 col-xs-12";
				$blog_class = "col-md-6 col-sm-6 col-xs-12";
			}
			?>
			<?php if($page_layout == "leftsidebar") { ?>
				<?php if ( is_active_sidebar( 'sidebar-widget' ) ) { ?>
					<!--Sidebar Widget-->
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="sidebar">
							<?php dynamic_sidebar('sidebar-widget') ?>
						</div>
					</div>
					<?php 
				} 
			} ?>
			<!-- Left Sidebar -->
			
			<!-- Masonry Blog Layout -->
			<div class="<?php echo esc_html($default_class);?>">
				<div class="row">
					<?php
					// Fetch All Post 
					if( have_posts()) :
						while ( have_posts()) : the_post();
					?>
						<div class="<?php echo esc_html($blog_class);?> derma-blog-box">
							<div class="derma_blog_slide blog_grid_layout">
								<div class="blog_slide_inner">
									<div class="blog_slide_img">
										<?php if ( has_post_thumbnail() ) { the_post_thumbnail('medihealth_blog_300'); } else { ?><img src="<?php echo trailingslashit( get_stylesheet_directory_uri() ) ?>/images/blog-default.png" alt=""><?php } ?>
									</div>
									<div class="blog_slide_date">
										<p class="blog_date"><?php echo get_the_date( 'j' ); ?>
											<br> <?php echo get_the_date( 'M' ); ?>
										</p>
									</div>
									<div class="blog_inner_txt">
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h3>
										<?php the_excerpt(); ?>
										<div class="blog_read_more ">
											<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','derma-care'); ?></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
						endwhile; 
					endif;
					// Reset Post Data
					wp_reset_postdata();
					?>
				</div>
				<?php if(function_exists('the_posts_pagination')) : ?>
				<!-- Pagination -->
				<div class="col-md-12 col-sm-12 col-xs-12 ">
					<div class="page_order">
						<?php
							// Custom query loop pagination	
							the_posts_pagination( array(
							'screen_reader_text' => ' ', 
							'prev_text'          => '<i class="fas fa-arrow-left"></i>',
							'next_text'          => '<i class="fas fa-arrow-right"></i>'
							) );
						?>
					</div>
				</div>
				<!-- Pagination -->
				<?php endif; ?>
			</div>
			<!-- Masonry Blog Layout -->

			<!-- Right Sidebar -->
			<?php if($page_layout == "rightsidebar") { ?>
				<?php if ( is_active_sidebar( 'sidebar-widget' ) ) { ?>
					<!--Sidebar Widget-->
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="sidebar">
							<?php dynamic_sidebar('sidebar-widget') ?>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
			<!-- Right Sidebar -->
		</div>
	</div>
</section>
<!-- Blog -->

<?php get_footer(); ?>