<?php
/**
 * Page
 *
 * @package MediHealth WordPress theme
 */
 
get_header();
?>
<!-- Breadcrumbs -->
<?php 
$medihealth_breadcrumb = get_theme_mod('medihealth_breadcrumb_setting', '1');
if($medihealth_breadcrumb == '1') { get_template_part('breadcrumb'); }
?>
<!-- Breadcrumbs -->

<!-- Blog -->
<section id="main-content" class="shop-section">
	<div class="container">
		<div class="row">
			<!--Blog Section-->
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
			<div class="<?php echo esc_html($default_class);?>">
				<div class="blog_page page-style">
					<?php
						if(have_posts()) :
							while (have_posts()) : the_post();
								the_content();
							endwhile;
						endif; 
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
<!-- Blog -->

<!-- Comment Section -->
<?php if( $post->comment_status == 'open' ) { ?>
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
<?php } ?>
<!-- Comment Section -->
<?php get_footer(); ?>
