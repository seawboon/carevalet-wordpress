<?php
/**
 * Single Page
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
		$medihealth_blog_tags = get_theme_mod('medihealth_blog_tags', '1');
		$medihealth_breadcrumb = get_theme_mod('medihealth_breadcrumb_setting', '1');
		if($medihealth_breadcrumb == '1') { get_template_part('breadcrumb'); }
	?>
<!-- Breadcrumbs -->

<!-- Blog Section -->
<section id="main-content" class="shop-section">
	<div class="container">
		<div class="row">
			<?php
			// Page Layout Settings
			$page_layout = get_theme_mod('medihealth_single_page_layout','fullwidth');
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
			<div class="<?php echo esc_html($default_class);?>">
				<div class="blog_page">
					<?php
					if(have_posts()) :
						while (have_posts()) : the_post();

						$medihealth_post_slide = get_post_meta( $post->ID, 'medihealth_all_post_slides_settings_'.$post->ID, true);
						//blog option settings
					?>
					<div class="blog-post-single">
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
							
							<h2><?php the_title(); ?></h2>
							<?php 
								if ( has_post_thumbnail() ) { 
									the_post_thumbnail(); 
								} 
							?>
						</div>

						<div class="blog_txt">
							<?php 
								//Fetch content
								the_content(); 
								//page link
								wp_link_pages(); 
							?>
						</div>
						<?php 
						if ($medihealth_blog_categories == '1') :
							if (has_category()) : 
							?>
							<div class="blog_single text-center">
								<h5 class="blog_single_cat" >
									<?php the_category(' '); ?>
								</h5>
							</div>
						<?php 
							endif; 
						endif; 
						?>
						<?php 
						if( $medihealth_blog_tags == '1') : 
							if( get_the_tags() ) : 
							?>
							<div class="blog_tags_part">
								<h2><?php esc_html_e('Related', 'medihealth'); ?><span> <?php esc_html_e('Tags', 'medihealth'); ?></span></h2>
								<ul>
									<?php
										echo '<li>';
											ucwords( the_tags( '','  ','' ) );
										echo '</li>';
									?>
								</ul>
							</div>
						<?php 
							endif;
						endif;
						?>
					</div>
					<?php
						endwhile;
					endif;
					// Reset Post Data
					wp_reset_postdata();
					?>
				</div>
			</div>
			<!-- Right Sidebar Start -->
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
			<!-- Right Sidebar End -->
		</div>
	</div>
</section>
<!-- Blog Section -->
<?php if( $post->comment_status == 'open' ) { ?>
	<!-- Comment Section -->
	<section class="blog-comment-section">
		<div class="container">
            <div class="comment-blog">
				<div class="row">
				<?php
					if(have_posts()) :
						while (have_posts()) : the_post();
					?>
						<div class="col-md-6">
							<div class="contact-fisrt-v">
								<div class="med_head text-center">
									<h4 class="services_head"><?php esc_html_e('Write Reviews', 'medihealth'); ?></h4>
									<h2 class="services_head1"><?php esc_html_e('Leave a Comment', 'medihealth'); ?></h2>
									<div class="head_line"></div>
								</div>
									<?php 
									//get comments
									comments_template();
									?>
							</div>
						</div>
					<div class="col-md-6">
						<div class="client-review">
							<h4 class="review_box_title"><span><?php comments_number ( __('No Comments & Reviews', 'medihealth'), __( 'One Comment & Reviews', 'medihealth'), __('% Comments & Reviews', 'medihealth') ); ?></span></h4>
							<?php if( have_comments() ) { //We have comments ?>
									<!--<h2 class="comment-title">
										<?php
											comments_number ( __('No Comments', 'medihealth'), __( 'One Comment', 'medihealth'), __('% Comments', 'medihealth') );
										?>
									</h2>-->
									
									<ul class="comment-list">
									<?php
									$args = array (
										'walker'				=> null,
										'type'				    => 'all',
										'max_depth'				=> '4',
										'style'					=> '',
										'callback'				=> 'medihealth_custom_comments',
										'end-callback'			=> null,
										'type'					=> 'all',
										'reply_text'			=> esc_html__('Reply', 'medihealth'),
										'page'					=> null,
										'per_page'				=> null,
										'avatar_size'			=> 50,
										'reverse_top_level'		=> null,
										'reverse_children'		=> '',
										'format'				=> 'html5',
										'short_ping'			=> false,
										);
									wp_list_comments( $args );

									?>
									</ul>
									<?php
									paginate_comments_links( array(
										'prev_text' => __('&laquo','medihealth'),
										'next_text' => __('&raquo','medihealth')
									) );
									
									if( !comments_open() && get_comments_number() ) { ?>
										<p class="no-comments"><?php esc_html_e('Comments are closed', 'medihealth'); ?></p>
									<?php } //comments open end
								} //have comments end
							?>
						</div>
					</div> 
					<?php
						endwhile;
					endif;
					// Reset Post Data
					wp_reset_postdata();
					?>
				</div>
            </div>
		</div>
	</section>
	<!-- Comment Section -->
<?php } ?>
<?php get_footer();