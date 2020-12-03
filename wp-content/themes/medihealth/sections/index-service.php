<?php
/**
 * Index Service Section
 *
 * @package MediHealth WordPress theme
 */

	//Service Settings
	$medihealth_section_title = get_theme_mod('medihealth_service_section_title', 'We Provide');
	$medihealth_section_description = get_theme_mod('medihealth_service_section_description', "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
	$medihealth_service_content = get_theme_mod( 'medihealth_service_content_setting', 'service_post');
	$medihealth_number_of_service_items = get_theme_mod( 'medihealth_service_items_setting', 3 );

	if( $medihealth_service_content == 'service_page' ) :
		for( $i=1; $i<=$medihealth_number_of_service_items; $i++ ) :
			$medihealth_service_pages[] = get_theme_mod( 'medihealth_service_page_'.$i );
		endfor;  
	elseif( $medihealth_service_content == 'service_post' ) :
		for( $i=1; $i<=$medihealth_number_of_service_items; $i++ ) :
			$medihealth_service_posts[] = get_theme_mod( 'medihealth_service_post_'.$i );
		endfor;
	endif;
?>
<!-- Service Section -->
<section class="services-section">
	<div class="container">
		<div class="med_head text-center">
			<?php if(! empty($medihealth_section_title) ) : ?>
				<h2 class="services_head1"><?php echo esc_html($medihealth_section_title);?></h2>
				<div class="head_line"></div>
			<?php endif; ?>
			<?php if(! empty($medihealth_section_description) ) : ?>
				<p class="med_head_content"><?php echo esc_html($medihealth_section_description);?></p>
			<?php endif; ?>
		</div>
		<?php if($medihealth_service_content == 'service_page' ) : ?>
			<div class="row services_inner">
				<?php
					$medihealth_service_args = array (
						'post_type'     => 'page',
						'post_per_page' => count( $medihealth_service_pages ),
						'post__in'      => $medihealth_service_pages,
						'orderby'       =>'post__in',
					); 
					$medihealth_the_query = new WP_Query($medihealth_service_args);
					if ( $medihealth_the_query->have_posts() ) :
					$i=-1;  
						while ($medihealth_the_query->have_posts()) : $medihealth_the_query->the_post(); $i++;
							$medihealth_icon = get_post_meta( $post->ID, 'medihealth_service_icon', true);
						?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="services_col">
								<div class="services_icon text-center">
									<span class="ser_icon"><i class="<?php echo esc_html($medihealth_icon);?>"></i></span>
								</div>
								<div class="services_text text-center">
									<?php if( ! empty( $post->post_title ) ) : ?>
										<h3><?php the_title(); ?></h3>
									<?php endif; ?>
									<?php if( ! empty( $post->post_content ) ) : ?>
										<p><?php echo medihealth_custom_excerpt(30); ?></p>
									<?php endif; ?>
									<a href="<?php the_permalink(); ?>" target="_new"><?php esc_html_e('Read More','medihealth'); ?></a>
								</div>
							</div>
						</div>
						<?php 
						endwhile; 
					endif; 
					wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
		<div class="row services_inner">
				<?php
					$medihealth_service_args = array (
						'post_type'     => 'post',
						'post_per_page' => count( $medihealth_service_posts ),
						'post__in'      => $medihealth_service_posts,
						'orderby'       =>'post__in',
					); 
					$medihealth_the_query = new WP_Query($medihealth_service_args);
					if ( $medihealth_the_query->have_posts() ) :
					$i=-1;  
						while ($medihealth_the_query->have_posts()) : $medihealth_the_query->the_post(); $i++;
							$medihealth_icon = get_post_meta( $post->ID, 'medihealth_service_icon', true);
						?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="services_col">
								<div class="services_icon text-center">
									<span class="ser_icon"><i class="fas <?php echo esc_html($medihealth_icon);?>"></i></span>
								</div>
								<div class="services_text text-center">
									<?php if( ! empty( $post->post_title ) ) : ?>
										<h3><?php the_title(); ?></h3>
									<?php endif; ?>
									<?php if( ! empty( $post->post_content ) ) : ?>
										<p><?php echo medihealth_custom_excerpt(30); ?></p>
									<?php endif; ?>
									<a href="<?php the_permalink(); ?>" target="_new"><?php esc_html_e('Read More','medihealth'); ?></a>
								</div>
							</div>
						</div>
						<?php 
						endwhile;
					endif;
					wp_reset_postdata(); ?>
			</div>
		<?php endif ?>
	</div>
</section>
<!-- Services section -->