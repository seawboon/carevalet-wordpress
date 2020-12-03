<?php
/**
 * Index Portfolio Section
 *
 * @package MediHealth WordPress theme
 */
 
	//Portfolio Meta
	$medihealth_section_title = get_theme_mod( 'medihealth_portfolio_section_title', 'Hospital Works');
	$medihealth_section_description = get_theme_mod( 'medihealth_portfolio_section_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
	$medihealth_portfolio = get_theme_mod( 'medihealth_portfolio_setting', '');
	$medihealth_portfolio_content = get_theme_mod( 'medihealth_portfolio_content_setting', 'portfolio_post');
	$medihealth_number_of_portfolio_items = get_theme_mod( 'medihealth_portfolio_items_setting', 3 );

	if( $medihealth_portfolio_content == 'portfolio_page' ) :
		for( $i=1; $i<=$medihealth_number_of_portfolio_items; $i++ ) :
			$medihealth_portfolio_posts[] = get_theme_mod( 'medihealth_portfolio_page_'.$i );
		endfor;  
	elseif( $medihealth_portfolio_content == 'portfolio_post' ) :
		for( $i=1; $i<=$medihealth_number_of_portfolio_items; $i++ ) :
			$medihealth_portfolio_posts[] = get_theme_mod( 'medihealth_portfolio_post_'.$i );
		endfor;
	endif;
	
?>
<!-- Portfolio Section -->
<section class="portfolio-section">
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
		<?php if($medihealth_portfolio_content == 'portfolio_page' ) : ?>
			<div class="row portfolio_inner portfolioContainer" >
			<?php
				$medihealth_portfolio_args = array (
					'post_type'     => 'page',
					'post_per_page' => count( $medihealth_portfolio_posts ),
					'post__in'      => $medihealth_portfolio_posts,
					'orderby'       =>'post__in',
				); 
				$medihealth_the_query = new WP_Query($medihealth_portfolio_args);
				if ( $medihealth_the_query->have_posts() ) :
				$i=-1;  
					while ($medihealth_the_query->have_posts()) : $medihealth_the_query->the_post(); $i++;
					?>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<a href="<?php the_permalink(); ?>">
							<div style="background: url(<?php the_post_thumbnail_url(); ?>) no-repeat;" class="img1 img-grid d-flex align-items-end p-3">
								<div class="img_text">
									<?php if( ! empty( $post->post_title ) ) : ?>
										<h4><?php the_title(); ?></h4>
										<span> </span>
									<?php endif; ?>
								</div>
							</div>
						</a>
					</div>
					<?php 
					endwhile;
				endif;
				wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<div class="row portfolio_inner portfolioContainer" >
			<?php
				$medihealth_portfolio_args = array (
					'post_type'     => 'post',
					'post_per_page' => count( $medihealth_portfolio_posts ),
					'post__in'      => $medihealth_portfolio_posts,
					'orderby'       =>'post__in',
				); 
				$medihealth_the_query = new WP_Query($medihealth_portfolio_args);
				if ( $medihealth_the_query->have_posts() ) :
				$i=-1;  
					while ($medihealth_the_query->have_posts()) : $medihealth_the_query->the_post(); $i++;
					?>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<a href="<?php the_permalink(); ?>" >
							<div style="background: url(<?php the_post_thumbnail_url(); ?>) no-repeat;" class="img1 img-grid d-flex align-items-end p-3">
								<div class="img_text">
									<?php if( ! empty( $post->post_title ) ) : ?>
										<h4><?php the_title(); ?></h4>
										<span> </span>
									<?php endif; ?>
								</div>
							</div>
						</a>
					</div>
					<?php 
					endwhile;
				endif;
				wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
<!-- Portfolio Section -->
