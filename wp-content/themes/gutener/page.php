<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gutener
 */

get_header();
?>

<?php if( is_front_page() && !get_theme_mod( 'disable_main_slider', false ) ){
	if ( get_theme_mod( 'main_slider_controls', 'slider' ) == 'slider' ){
		if ( get_theme_mod( 'display_slider_on', 'blog-page-below-header' ) == 'front-page-below-header' || get_theme_mod( 'display_slider_on', 'blog-page-below-header' ) == 'front-blog-page-below-header' ) { ?>
			<section class="section-banner">
				<?php 
					get_template_part( 'template-parts/slider/slider', '' ); 
				?>
			</section>
		<?php }
	}elseif( get_theme_mod( 'main_slider_controls', 'slider' ) == 'banner' ){
		if ( get_theme_mod( 'display_banner_on', 'blog-page-below-header' ) == 'front-page-below-header' || get_theme_mod( 'display_banner_on', 'blog-page-below-header' ) == 'front-blog-page-below-header' ) {
				gutener_banner();
		}
	}
} ?>
<div id="content" class="site-content">
	<div class="container">
		<section class="wrap-detail-page">
			<?php 
			if ( get_theme_mod( 'breadcrumbs_controls', 'disable_in_all_pages' ) == 'show_in_all_page_post'  ){gutener_breadcrumb_wrap();
			} ?>
			<div class="row">
				<?php
				$sidebarClass = 'col-lg-8';
				$sidebarColumnClass = 'col-lg-4';
				if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){
					$sidebarClass = 'col-lg-6';
					$sidebarColumnClass = 'col-lg-3';
				}
				if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' || get_theme_mod( 'disable_sidebar_page', true ) ){
					$sidebarClass = 'col-12';
				}
				if( !get_theme_mod( 'disable_sidebar_page', true ) ){
					if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' || get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){ 
					?>
						<div id="secondary" class="sidebar left-sidebar <?php echo esc_attr( $sidebarColumnClass ); ?>">
							<?php dynamic_sidebar( 'left-sidebar' ); ?>
						</div>
					<?php }
				} ?>
				<div id="primary" class="content-area <?php echo esc_attr( $sidebarClass ); ?>">
					<main id="main" class="site-main">
						<?php if( get_theme_mod( 'page_title_position', 'below_feature_image' ) == 'above_feature_image' ){
							gutener_page_title();
						} ?>
						<?php if( has_post_thumbnail() ){
							if( get_theme_mod( 'page_feature_image', 'show_in_all_pages' ) == 'show_in_all_pages' || !is_front_page() && get_theme_mod( 'page_feature_image', 'show_in_all_pages' ) == 'disable_in_frontpage' || get_theme_mod( 'page_feature_image', 'show_in_all_pages' ) == 'show_in_frontpage' && is_front_page() ){ ?>
							    <figure class="feature-image single-feature-image">
							        <?php gutener_image_size( 'gutener-1370-550' ); ?>
							    </figure>
							<?php }else{
								// will disable in all pages
								echo '';
							}
						}
						?>
						<?php if( get_theme_mod( 'page_title_position', 'below_feature_image' ) == 'below_feature_image' ){
							gutener_page_title();
						} ?>
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
					</main><!-- #main -->
				</div><!-- #primary -->
				<?php
					if( !get_theme_mod( 'disable_sidebar_page', true ) ){
						if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' || get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){ ?>
							<div id="secondary" class="sidebar right-sidebar <?php echo esc_attr( $sidebarColumnClass ); ?>">
								<?php dynamic_sidebar( 'right-sidebar' ); ?>
							</div>
						<?php }
					} ?>
			</div>
		</section>
<?php get_footer();
