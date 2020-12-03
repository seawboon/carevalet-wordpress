<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gutener Medical
 */

get_header();
?>
	<?php
	if( is_home() && !get_theme_mod( 'disable_main_slider', false ) ){
		if ( get_theme_mod( 'main_slider_controls', 'slider' ) == 'slider' ){
			if ( get_theme_mod( 'display_slider_on', 'blog-page-below-header' ) == 'blog-page-below-header' || get_theme_mod( 'display_slider_on', 'blog-page-below-header' ) == 'front-blog-page-below-header' ) { ?>
				<section class="section-banner">
					<?php 
						get_template_part( 'template-parts/slider/slider', '' ); 
					?>
				</section>
			<?php }
		}elseif( get_theme_mod( 'main_slider_controls', 'slider' ) == 'banner' ){
			if ( get_theme_mod( 'display_banner_on', 'blog-page-below-header' ) == 'blog-page-below-header' || get_theme_mod( 'display_banner_on', 'blog-page-below-header' ) == 'front-blog-page-below-header' ) {
					gutener_banner();
			}
		}
	} ?>
	<div id="content" class="site-content">
		<div class="container">
	<?php
	//Highlight Posts Section
	$posts_per_page_count = get_theme_mod( 'highlight_posts_posts_number', 6 );
	$highlight_posts_id = get_theme_mod( 'highlight_posts_category', 'Uncategorized' );

	$query = new WP_Query( apply_filters( 'gutener_blog_args', array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $posts_per_page_count,
		'cat'                 => $highlight_posts_id,
		'offset'              => 0,
		'ignore_sticky_posts' => 1
	)));

	$posts_array = get_posts( $query );
	$show_highlight_posts = count( $posts_array ) > 0 && is_home();

	if( !get_theme_mod( 'disable_highlight_posts_section', false ) && $show_highlight_posts ){
	?>
	<section class="section-highlight-posts-area">
		<?php if( !get_theme_mod( 'disable_highlight_posts_section_title', true ) ){ ?>
			<div class="section-title-wrap">
				<h2 class="section-title"><?php echo esc_html(get_theme_mod( 'highlight_posts_section_title', '' )); ?></h2>
			</div>
		<?php } ?>
		<div class="content-wrap">
			<div class="row">
			<?php

				while ( $query->have_posts() ) : $query->the_post();
				$image = get_the_post_thumbnail_url( get_the_ID(), 'gutener-420-380' );

				$columns_class = '';
				if( get_theme_mod( 'highlight_posts_columns', 'four_columns' ) == 'one_column' ){
					$columns_class = 'col-md-12';
				}elseif( get_theme_mod( 'highlight_posts_columns', 'four_columns' ) == 'two_columns' ){
					$columns_class = 'col-md-6';
				}elseif( get_theme_mod( 'highlight_posts_columns', 'four_columns' ) == 'three_columns' ){
					$columns_class = 'col-md-4';
				}elseif( get_theme_mod( 'highlight_posts_columns', 'four_columns' ) == 'four_columns' ){
					$columns_class = 'col-md-3';
				}
				?>
					<div class="<?php echo esc_attr( $columns_class ); ?>">
						<div class="highlight-posts-content-wrap">
							<a href="<?php the_permalink(); ?>">
								<div class="highlight-posts-image" style="background-image: url( <?php echo esc_url( $image ); ?> );">
									<div class="highlight-posts-content">
										<?php 
											if( !get_theme_mod( 'disable_highlight_posts_title', false ) ){
												?>
												<h3 class="highlight-posts-title">
													<?php the_title(); ?>
												</h3>
												<?php
											}
										?>
									</div>
								</div>
							</a>
						</div>
					</div>
				<?php
				endwhile; 
				wp_reset_postdata();
			?>
			</div>
		</div>
	<?php } ?>
	</section>

	<!-- Latest Posts Section -->
	<?php if( !get_theme_mod( 'disable_latest_posts_section', false ) ){ ?>
	<section class="section-post-area">
		<div class="row">
			<?php
				$sidebarClass = 'col-lg-8';
				$sidebarColumnClass = 'col-lg-4';
				$masonry_class = '';

				if( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid'){
					$masonry_class = 'masonry-wrapper';
				}
				if( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' ){
					$layout_class = 'grid-post-wrap';
				}elseif( get_theme_mod( 'archive_post_layout', 'list' ) == 'single' ){
					$layout_class = 'single-post';
				}
				if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){
					$sidebarClass = 'col-lg-6';
					$sidebarColumnClass = 'col-lg-3';
				}
				if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' || get_theme_mod( 'disable_sidebar_blog_page', false ) ){
					$sidebarClass = 'col-12';
				}
				if( !get_theme_mod( 'disable_sidebar_blog_page', false ) ){
					if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' || get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){ 
					?>
						<div id="secondary" class="sidebar left-sidebar <?php echo esc_attr( $sidebarColumnClass ); ?>">
							<?php dynamic_sidebar( 'left-sidebar' ); ?>
						</div>
					<?php }
				} ?>
			
			<div id="primary" class="content-area <?php echo esc_attr( $sidebarClass ); ?>">
				<?php if( is_home() && !get_theme_mod( 'disable_main_slider', false ) ){
					if ( get_theme_mod( 'main_slider_controls', 'slider' ) == 'slider' ){
						if ( get_theme_mod( 'display_slider_on', 'blog-page-below-header' ) == 'blog-page-above-latest-posts' ) { ?>
							<section class="section-banner">
								<?php 
									get_template_part( 'template-parts/slider/slider', '' ); 
								?>
							</section>
						<?php }
					}elseif( get_theme_mod( 'main_slider_controls', 'slider' ) == 'banner' ){
						if ( get_theme_mod( 'display_banner_on', 'blog-page-below-header' ) == 'blog-page-above-latest-posts' ) { 
								gutener_banner();
						}
					}
				} ?>
				<div class="row <?php echo esc_attr( $masonry_class ); ?>">
				<?php
				if ( have_posts() ) :

					if ( is_home() && !is_front_page() ) :
						?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
						<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

				elseif ( !is_sticky() && ! have_posts() ):
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
				</div><!-- #main -->
				<?php
					if( !get_theme_mod( 'disable_pagination', false ) ):
						the_posts_pagination( array(
							'next_text' => '<span>'.esc_html__( 'Next', 'gutener-medical' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Next page', 'gutener-medical' ) . '</span>',
							'prev_text' => '<span>'.esc_html__( 'Prev', 'gutener-medical' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Previous page', 'gutener-medical' ) . '</span>',
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'gutener-medical' ) . ' </span>',
						));
					endif;
				?>
			</div><!-- #primary -->
			<?php
				if( !get_theme_mod( 'disable_sidebar_blog_page', false ) ){
					if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' || get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){ ?>
						<div id="secondary" class="sidebar right-sidebar <?php echo esc_attr( $sidebarColumnClass ); ?>">
							<?php dynamic_sidebar( 'right-sidebar' ); ?>
						</div>
					<?php }
				} ?>
		</div>
	</section>
	<?php }

	//Feature Posts Section
	$posts_per_page_count = get_theme_mod( 'feature_posts_posts_number', 6 );
	$feature_posts_id = get_theme_mod( 'feature_posts_category', 'Uncategorized' );

	$query = new WP_Query( apply_filters( 'gutener_blog_args', array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $posts_per_page_count,
		'cat'                 => $feature_posts_id,
		'offset'              => 0,
		'ignore_sticky_posts' => 1
	)));

	$posts_array = get_posts( $query );
	$show_feature_posts = count( $posts_array ) > 0 && is_home();

	if( $show_feature_posts && !get_theme_mod( 'disable_feature_posts_section', false ) ){
	?>
	<section class="section-feature-post">
		<div class="section-feature-inner">
			<div class="section-title-wrap">
				<?php if( !get_theme_mod( 'disable_feature_posts_section_title', true ) ){ ?>
					<h2 class="section-title"><?php echo esc_html(get_theme_mod( 'feature_posts_section_title', '' )); ?></h2>
				<?php } ?>
				<?php if( !get_theme_mod( 'disable_feature_posts_arrows', false ) ) { ?>
					<div class="wrap-arrow">
					    <ul class="slick-control">
					        <li class="feature-posts-prev">
					        	<span></span>
					        </li>
					        <li class="feature-posts-next">
					        	<span></span>
					        </li>
					    </ul>
					</div>
				<?php } ?>
			</div>

			<div class="feature-post-slider">
				<?php
					while ( $query->have_posts() ) : $query->the_post();
				?>
					<div class="slide-item">
						<?php get_template_part( 'template-parts/feature-posts/feature-posts', 'content' ); ?>
					</div>
				<?php
					endwhile; 
					wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
	<?php } ?>
	<?php
get_footer();