<?php
/**
 * Index Blog Section
 *
 * @package MediHealth WordPress theme
 */
	//blog option settings
	$medihealth_blog_title = get_theme_mod('medihealth_blog_section_title', 'Latest Blogs');
	$medihealth_blog_description = get_theme_mod('medihealth_blog_section_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');

?>
<!-- Blog Section -->
<section class="blog-section">
	<div class="container">
		<div class="row ">
			<div class="col-md-12">
				<div class="blog_inner">
					<div class="med_head text-center">
						<?php if(! empty($medihealth_blog_title) ) : ?>
							<h2 class="blog_head1"><?php echo esc_html($medihealth_blog_title);?></h2>
							<div class="head_line"></div>
						<?php endif; ?>
						<?php if(! empty($medihealth_blog_description) ) : ?>
							<p class="blog_txt"><?php echo esc_html($medihealth_blog_description);?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="blog_slider">
					<div class="blog-container blog_slider_inner">
						<div class="blog-wrapper row">
						<?php
						// Get current page and append to custom query parameters array
						$medihealth_blog_query_args = array(
							'posts_per_page' 	=> 3,
							'post_type' 		=> 'post',
							'post_status' 		=> 'publish',
							'paged' 			=> 1,
							);

						// Instantiate custom query 
						$medihealth_blog_query = new WP_Query( $medihealth_blog_query_args );
						
						// Fetch All Post 
						if( $medihealth_blog_query->have_posts()) :
							while ( $medihealth_blog_query->have_posts()) : $medihealth_blog_query->the_post();
						?>
							<div class="blog_slide col-md-4 col-sm-6 col-xs-12">
								<div class="blog_slide_inner">
									<div class="blog_slide_img">
										<?php if ( has_post_thumbnail() ) { the_post_thumbnail('medihealth_blog_300'); } else { ?><img src="<?php echo esc_url( get_template_directory_uri() ) ?><?php echo esc_url('/images/blog-default.png'); ?>" ><?php } ?>
									</div>
									<div class="blog_slide_date">
										<p class="blog_date"><?php echo get_the_date( 'jS' ); ?>
											<br> <?php echo get_the_date( 'M' ); ?>
										</p>
									</div>
									<div class="blog_inner_txt">
										<?php if( ! empty( $post->post_title )) : ?>
											<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<?php endif; ?>
										<?php 
											if( ! empty( $post->post_content )) :
												the_excerpt(); 
											endif;
										?>
										<div class="blog_read_more">
											<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'medihealth');?></a>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Blog Section -->