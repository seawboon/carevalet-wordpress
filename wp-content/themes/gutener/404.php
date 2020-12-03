<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Gutener
 */

get_header();
?>
	<?php
		$error404_image = get_theme_mod( 'error404_image' );
		if( !$error404_image ){
			$error404_image = get_theme_file_uri( '/assets/images/gutener-360-200.jpg' );
		}
	?>
	<div id="content" class="site-content">
		<div class="container">
			<section class="error-404 not-found">
				<div class="inner-content">
					<header class="page-header">
						<h1 class="title-404" style="background-image: url( <?php echo esc_url( $error404_image ); ?> );"><?php echo esc_html( '404', 'gutener' ); ?></h1>
						<h2 class="page-title"><?php echo esc_html( 'Oops! that page can&rsquo;t be found.', 'gutener' ); ?></h2>
						<p><?php echo esc_html( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'gutener' ); ?></p>
					</header><!-- .page-header -->
					<div class="error-404-form">
						<?php get_search_form(); ?>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
<?php
get_footer();
