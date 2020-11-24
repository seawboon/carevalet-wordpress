<?php
/**
 * Index Testimonial Section
 *
 * @package MediHealth WordPress theme
 */

	/* Testimonial settings */
	$medihealth_section_title 					= get_theme_mod('medihealth_testimonial_title', 'TESTIMONIALS');
	$medihealth_testimonial_content				= get_theme_mod( 'medihealth_testimonial_content_setting', 'testimonial_post');
	$medihealth_number_of_testimonial_items		= get_theme_mod( 'medihealth_testimonial_items_setting', 2 );

	if( $medihealth_testimonial_content == 'testimonial_page' ) :
		for( $i=1; $i<=$medihealth_number_of_testimonial_items; $i++ ) :
			$medihealth_testimonial_posts[] = get_theme_mod( 'medihealth_testimonial_page_'.$i );
		endfor;  
	elseif( $medihealth_testimonial_content == 'testimonial_post' ) :
		for( $i=1; $i<=$medihealth_number_of_testimonial_items; $i++ ) :
			$medihealth_testimonial_posts[] = get_theme_mod( 'medihealth_testimonial_post_'.$i );
		endfor;
	endif;
?>
<!-- Testimonial Section -->
<section class="patient-section">
	<div class="container">
		<div class="med_head text-center">
		<?php if(! empty($medihealth_section_title) ) : ?>
			<h2 class="services_sector_head1"><?php echo esc_html($medihealth_section_title);?></h2>
			<div class="head_line med_sector"></div>
		<?php endif; ?>
		</div>
		<div class="paitent_slider">
			<div class="swiper-container patient_slider_inner">
				<?php if($medihealth_testimonial_content == 'testimonial_page' ) : ?>
					<div class="swiper-wrapper">
						<?php
							$medihealth_testimonial_args = array (
								'post_type'     => 'page',
								'post_per_page' => count( $medihealth_testimonial_posts ),
								'post__in'      => $medihealth_testimonial_posts,
								'orderby'       =>'post__in',
							); 
							$medihealth_the_query = new WP_Query($medihealth_testimonial_args);
							if ( $medihealth_the_query->have_posts() ) :
							$i=-1;  
								while ($medihealth_the_query->have_posts()) : $medihealth_the_query->the_post(); $i++;
									$medihealth_designation = get_post_meta( $post->ID, 'medihealth_testimonail_designation', true);
								?>
								<div class="swiper-slide" data-swiper-autoplay="3000">
									<div class="paitent_slide_img text-center">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="patient_slide_txt text-center">
										<?php 
											if( ! empty( $post->post_content ) ) : 
												the_content();
											endif; 
										?>
										<?php if( ! empty( $post->post_title ) ) : ?>
											<h3><?php the_title(); ?></h3>
										<?php endif; ?>
										<?php if( ! empty($medihealth_designation) ) : ?>
											<h6><?php echo esc_html($medihealth_designation);?></h6>
										<?php endif; ?>
									</div>
								</div>
								<?php 
								endwhile; 
							endif; 
							wp_reset_postdata();
						?>
					</div>
				<?php else : ?>
					<div class="swiper-wrapper">
						<?php
							$medihealth_testimonial_args = array (
								'post_type'     => 'post',
								'post_per_page' => count( $medihealth_testimonial_posts ),
								'post__in'      => $medihealth_testimonial_posts,
								'orderby'       =>'post__in',
							); 
							$medihealth_the_query = new WP_Query($medihealth_testimonial_args);
							if ( $medihealth_the_query->have_posts() ) :
							$i=-1;  
								while ($medihealth_the_query->have_posts()) : $medihealth_the_query->the_post(); $i++;
									$medihealth_designation = get_post_meta( $post->ID, 'medihealth_testimonail_designation', true);								?>
								<div class="swiper-slide" data-swiper-autoplay="3000">
									<div class="paitent_slide_img text-center">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="patient_slide_txt text-center">
										<?php 
											if( ! empty( $post->post_content ) ) : 
												the_content();
											endif; 
										?>
										<?php if( ! empty( $post->post_title ) ) : ?>
											<h3><?php the_title(); ?></h3>
										<?php endif; ?>
										<?php if( ! empty($medihealth_designation) ) : ?>
											<h6><?php echo esc_html($medihealth_designation);?></h6>
										<?php endif; ?>
									</div>
								</div>
								<?php 
								endwhile;
							endif;
							wp_reset_postdata(); ?>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>
<!-- Testimonial Section -->
