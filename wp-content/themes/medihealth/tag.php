<?php
/**
 * Tag Archive
 *
 * @package MediHealth WordPress theme
 */
?>
<?php get_header();	?>
	<!-- Breadcrumb -->
		<section class="inner_slider_part">
			<div class="container">
				<div class="inner_slider_content">
					<h1><b><?php esc_html_e('Tag Archive', 'medihealth') ?> : <?php single_tag_title(); ?></b></h1>
				</div>
			</div>
		</section>
	<!-- Breadcrumb -->
	<!-- Blog -->
	<section class="shop-section">
		<div class="container">
			<div class="row">
				<!-- Left Sidebar -->
				<?php
				// Page Layout Settings
				$page_layout = get_theme_mod('medihealth_archive_page_layout','rightsidebar');
				// Initialize Variable
				$default_class = "col-md-12 col-sm-12 col-xs-12";
				
				// Check Sidebar Column Condition
				if( $page_layout == "rightsidebar" || $page_layout == "leftsidebar" && is_active_sidebar( 'sidebar-widget' )  ) {
					$default_class = "col-md-8 col-sm-6 col-xs-12";
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
					<div class="<?php echo esc_html($default_class);?>">
						<div class="blog_page">
							<?php
							if ( have_posts() ) :
								// Start the Loop.
								while ( have_posts() ) : the_post();
									// Include the post format template for the content.
									get_template_part( 'content', get_post_format() );
								endwhile;
							
							endif;
							?>
						</div>
						<!-- Pagination -->
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="page_order">
								<?php
									// Custom query loop pagination	
									the_posts_pagination( array(
									'screen_reader_text' => ' ', 
									'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
									'next_text'          => '<i class="fa fa-angle-double-right"></i>'
								) );
								?>
							</div>
						</div>
						<!-- Pagination -->
					</div>
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