<?php
/**
 * The template for displaying archived woocommerce products
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @package Gutener
 */
get_header(); 
?>
<div id="content" class="site-content">
	<div class="container">
		<section class="wrap-detail-page">
			<div class="row">
				<?php
				$noSidebarClass='col-md-8 col-xl-9';
				$SidebarClass = '';
				if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' ){
					$noSidebarClass = 'col-12';
				}
				if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ){
					$SidebarClass = 'right-sidebar';
				}
				if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ){
					$SidebarClass = 'left-sidebar';
				 ?>
					<div id="secondary" class="sidebar col-md-4 col-xl-3">
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
				<div id="primary" class="content-area <?php echo esc_attr($noSidebarClass), ' ', esc_attr($SidebarClass); ?>">
					<main id="main" class="site-main post-detail-content woocommerce-products" role="main">
						<?php if ( have_posts() ) :
							woocommerce_content();
						endif;
						?>
					</main><!-- #main -->
				</div><!-- #primary -->
				<?php
				if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ){ ?>
					<div id="secondary" class="sidebar col-md-4 col-xl-3">
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		</section>
<?php
get_footer();
