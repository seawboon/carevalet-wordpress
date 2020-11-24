<?php
/**
 * Index Slider Section
 *
 * @package MediHealth WordPress theme
 */
	//FS Settings
	$medihealth_slider_content        = get_theme_mod( 'medihealth_slider_content_setting', 'slider_post');
	$medihealth_number_of_slider_items     = get_theme_mod( 'medihealth_slider_items_setting', 2 );

	if( $medihealth_slider_content == 'slider_page' ) :
		for( $i=1; $i<=$medihealth_number_of_slider_items; $i++ ) :
			$medihealth_featured_slider_posts[] = get_theme_mod( 'medihealth_slider_page_'.$i );
		endfor;  
	elseif( $medihealth_slider_content == 'slider_post' ) :
		for( $i=1; $i<=$medihealth_number_of_slider_items; $i++ ) :
			$medihealth_featured_slider_posts[] = get_theme_mod( 'medihealth_slider_post_'.$i );
		endfor;
	endif;
?>
<!-- Slider Section -->
<section class="slider-section">
	<div class="swiper-container main_slider">
	<?php if( $medihealth_slider_content == 'slider_page' ) : ?>
		<div class="swiper-wrapper">
		<?php
			$medihealth_slider_args = array (
				'post_type'     => 'page',
				'post_per_page' => count( $medihealth_featured_slider_posts ),
				'post__in'      => $medihealth_featured_slider_posts,
				'orderby'       =>'post__in',
			); 
			$medihealth_the_query = new WP_Query($medihealth_slider_args);
			if ( $medihealth_the_query->have_posts() ) :
			$i=-1;  
				while ($medihealth_the_query->have_posts()) : $medihealth_the_query->the_post(); $i++;
				?>
				<div style=" background: url('<?php the_post_thumbnail_url( 'full' ); ?>') no-repeat; height: 745px;" id="post-<?php the_ID(); ?>" class="swiper-slide first_slide-<?php echo esc_html($i); ?> ">
					<div class="main_slide ">
						<div class="main_slide_txt">
							<div class="container">
								<div class="slider_txt_pos main_slide_center float-left text-left">
									<?php if( ! empty( $post->post_title ) ) : ?>
										<h1><span><?php the_title();?></span></h1>
									<?php endif; ?>
									<?php if( ! empty( $post->post_content ) ) : ?>
										<p><?php echo medihealth_custom_excerpt(30);?></p>
									<?php endif; ?>
									<a href="<?php the_permalink();?>"><button class="slider_btn"><?php esc_html_e('Know More','medihealth'); ?></button></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
				endwhile; 
			endif;
			wp_reset_postdata(); ?>
		</div>
	<?php else : ?>
		<div class="swiper-wrapper">
		<?php
			$medihealth_slider_args = array (
				'post_type'     => 'post',
				'post_per_page' => count( $medihealth_featured_slider_posts ),
				'post__in'      => $medihealth_featured_slider_posts,
				'orderby'       =>'post__in',
				'ignore_sticky_posts' => true,
			); 
			$medihealth_the_query = new WP_Query($medihealth_slider_args);
			if ( $medihealth_the_query->have_posts() ) :
			$i=-1;  
				while ($medihealth_the_query->have_posts()) : $medihealth_the_query->the_post(); $i++;
				?>
				<div style=" background: url('<?php the_post_thumbnail_url( 'full' ); ?>'); height: 745px;" id="post-<?php the_ID(); ?>" class="swiper-slide first_slide-<?php echo esc_html($i); ?> ">
					<div class="main_slide ">
						<div class="main_slide_txt">
							<div class="container">
								<div class="slider_txt_pos main_slide_center float-left text-left">
									<?php if( ! empty( $post->post_title ) ) : ?>
										<h1><span><?php the_title();?></span></h1>
									<?php endif; ?>
									<?php if( ! empty( $post->post_content ) ) : ?>
										<p><?php echo medihealth_custom_excerpt(30); ?></p>
									<?php endif; ?>
									<a href="<?php the_permalink();?>"><button class="slider_btn"><?php esc_html_e('Know More','medihealth'); ?></button></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile;
			endif;
			wp_reset_postdata(); ?>
		</div>
	<?php endif ?>
		<!-- Pagination -->
		<div class="swiper-pagination main_nav"></div>
	</div>
</section>
<!-- Slider Section -->