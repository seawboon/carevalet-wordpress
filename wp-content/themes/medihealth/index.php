<?php
/**
 * Index
 *
 * @package MediHealth WordPress theme
 */
 
get_header(); 
?>
<!-- Breadcrumbs -->
	<?php
		//Defaults
		$medihealth_blog_date = get_theme_mod('medihealth_blog_date', '1');
		$medihealth_blog_user = get_theme_mod('medihealth_blog_user', '1');
		$medihealth_blog_comments = get_theme_mod('medihealth_blog_comments', '1');
		$medihealth_blog_categories = get_theme_mod('medihealth_blog_categories', '1');
		$medihealth_breadcrumb = get_theme_mod('medihealth_breadcrumb_setting', '1');
		if($medihealth_breadcrumb == '1') { get_template_part('breadcrumb'); }
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
			
			<!-- Blog Start -->
			<div class="<?php echo esc_html($default_class);?>">
				<div class="blog_page">
					<?php
					if ( have_posts() ) :
						// Start the Loop
						while ( have_posts() ) : the_post(); ?>
							<div class="blog-post" <?php post_class(); ?>>
								<div class="blog_head">
									<?php if($medihealth_blog_date == '1' || $medihealth_blog_user == '1' || $medihealth_blog_comments == '1') : ?>
										<h5>
											<?php if($medihealth_blog_date == '1') : ?>
												<i class="far fa-calendar-alt"></i><a href="<?php the_permalink(); ?>"><?php echo get_the_date( 'j M, Y' ); ?></a>
												<span> <?php esc_html_e('|' ,'medihealth'); ?> </span>
											<?php endif; ?>
											<?php if($medihealth_blog_user == '1') : ?>
												<i class="fas fa-user"></i>  <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a> 
												<span> <?php esc_html_e('|' ,'medihealth'); ?> </span>
											<?php endif; ?>
											<?php if($medihealth_blog_comments == '1') : ?>
												<i class="fas fa-comment"></i> <?php comments_number ( __('No Comments', 'medihealth'), __( 'One Comment', 'medihealth'), __('% Comments', 'medihealth') ); ?>
											<?php endif; ?>
										</h5>
									<?php endif; ?>
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<?php if ( has_post_thumbnail() ) { ?>
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
									<?php } ?>
								</div>
								<div class="blog_txt">
								   <?php the_content(); ?>
								</div>
								<?php 
								if ($medihealth_blog_categories == '1') :
									if (has_category()) : 
									?>
									<div class="blog_single text-center">
										<h5 class="blog_cat" >
											<?php the_category(' '); ?>
										</h5>
									</div>
								<?php 
									endif; 
								endif; 
								?>
							</div>
					<?php
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
			<!-- Blog End -->
			
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