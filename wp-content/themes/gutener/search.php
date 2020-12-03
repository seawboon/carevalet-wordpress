<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Gutener
 */

get_header();
?>
<div id="content" class="site-content">
	<div class="container">
		<div class="wrap-detail-page">
			<?php
				echo gutener_blog_page_title();
			if ( get_theme_mod( 'breadcrumbs_controls', 'disable_in_all_pages' ) == 'disable_in_all_pages' ||get_theme_mod( 'breadcrumbs_controls', 'disable_in_all_pages' ) == 'show_in_all_page_post' ){gutener_breadcrumb_wrap();
			}
			?>
			<div class="search-post-wrap">
				<?php if ( have_posts() ) : ?>
				<div class="row masonry-wrapper">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					endwhile; ?>
					</div>
						<?php
							if( !get_theme_mod( 'disable_pagination', false ) ):
								the_posts_pagination( array(
									'next_text' => '<span>'.esc_html__( 'Next', 'gutener' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Next page', 'gutener' ) . '</span>',
									'prev_text' => '<span>'.esc_html__( 'Prev', 'gutener' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Previous page', 'gutener' ) . '</span>',
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'gutener' ) . ' </span>',
								) );
							endif;
						?>
					<?php
				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div>
		</div>
<?php
get_footer();
