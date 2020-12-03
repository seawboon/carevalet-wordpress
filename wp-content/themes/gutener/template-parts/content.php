<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gutener
 */
?>

<?php
	$stickyClass = '';
	$layout_class = '';
	if( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ) {
		if ( get_theme_mod( 'archive_post_layout', 'grid' ) == 'grid' ){
			$stickyClass = "col-sm-6 grid-post";
		}elseif ( get_theme_mod( 'archive_post_layout', 'grid' ) == 'list' ) {
			$stickyClass = "col-12";
		}elseif( get_theme_mod( 'archive_post_layout', 'grid' ) == 'single' ){
			$stickyClass = "col-12";
		}
	}elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ) {
		if ( get_theme_mod( 'archive_post_layout', 'grid' ) == 'grid' ){
			$stickyClass = "col-sm-6 grid-post";
		}elseif ( get_theme_mod( 'archive_post_layout', 'grid' ) == 'list' ) {
			$stickyClass = "col-12";
		}elseif( get_theme_mod( 'archive_post_layout', 'grid' ) == 'single' ){
			$stickyClass = "col-12";
		}
	}elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' ) {
		if ( get_theme_mod( 'archive_post_layout', 'grid' ) == 'grid' ){
			$stickyClass = "col-sm-6 col-lg-4 grid-post";
		}elseif ( get_theme_mod( 'archive_post_layout', 'grid' ) == 'list' ) {
			$stickyClass = "col-12";
		}elseif( get_theme_mod( 'archive_post_layout', 'grid' ) == 'single' ){
			$stickyClass = "col-12";
		}
	}elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ) {
		if ( get_theme_mod( 'archive_post_layout', 'grid' ) == 'grid' ){
			$stickyClass = "col-sm-6 col-lg-6 grid-post";
		}elseif ( get_theme_mod( 'archive_post_layout', 'grid' ) == 'list' ) {
			$stickyClass = "col-12";
		}elseif( get_theme_mod( 'archive_post_layout', 'grid' ) == 'single' ){
			$stickyClass = "col-12";
		}
	}

	if( !is_sticky() && get_theme_mod( 'archive_post_layout', 'grid' ) == 'list' ){
		$layout_class = 'list-post';
	}elseif( !is_sticky() && get_theme_mod( 'archive_post_layout', 'grid' ) == 'single' ){
		$layout_class = 'single-post';
	}elseif( is_archive() && is_sticky() && get_theme_mod( 'archive_post_layout', 'grid' ) == 'list' ){
		$layout_class = 'list-post';
	}elseif( is_archive() && is_sticky() && get_theme_mod( 'archive_post_layout', 'grid' ) == 'single' ){
		$layout_class = 'single-post';
	}

	$class = '';
	if(!has_post_thumbnail()){
		$class = 'no-thumbnail';
	}
?>
<div class="<?php echo esc_attr( $stickyClass );?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class( $class . ' ' . $layout_class ) ?>>
		<?php 
		
		if ( has_post_thumbnail() ) : ?>
	        <figure class="featured-image">
	            <a href="<?php the_permalink(); ?>">
	                <?php
	                if( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ) {
	                	if ( get_theme_mod( 'archive_post_layout', 'grid' ) == 'grid' || get_theme_mod( 'archive_post_layout', 'grid' ) == 'list' ){
	                		gutener_image_size( 'gutener-420-300' );
	                	}elseif( get_theme_mod( 'archive_post_layout', 'grid' ) == 'single' ){
	                		gutener_image_size( 'gutener-1370-550' );
	                	}
	                }elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ) {
	                	if ( get_theme_mod( 'archive_post_layout', 'grid' ) == 'grid' || get_theme_mod( 'archive_post_layout', 'grid' ) == 'list' ){
	                		gutener_image_size( 'gutener-420-300' );
	                	}elseif( get_theme_mod( 'archive_post_layout', 'grid' ) == 'single' ){
	                		gutener_image_size( 'gutener-1370-550' );
	                	}
	                }elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' ) {
	                	if ( get_theme_mod( 'archive_post_layout', 'grid' ) == 'grid' || get_theme_mod( 'archive_post_layout', 'grid' ) == 'list' ){
	                		gutener_image_size( 'gutener-420-300' );
	                	}elseif( get_theme_mod( 'archive_post_layout', 'grid' ) == 'single' ){
	                		gutener_image_size( 'gutener-1370-550' );
	                	}
	                }elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ) {
	                	if ( get_theme_mod( 'archive_post_layout', 'grid' ) == 'grid' || get_theme_mod( 'archive_post_layout', 'grid' ) == 'list' ){
	                		gutener_image_size( 'gutener-420-300' );
	                	}elseif( get_theme_mod( 'archive_post_layout', 'grid' ) == 'single' ){
	                		gutener_image_size( 'gutener-1370-550' );
	                	}
	                }
	                ?>
	            </a>
	        </figure><!-- .recent-image -->
		<?php
	    endif;
		?>
	    <div class="entry-content">
	    	<header class="entry-header">
				<?php 
				if( !get_theme_mod( 'hide_category', false ) ){
					gutener_entry_header();
				}

				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				endif; 
				
				?>

			</header><!-- .entry-header -->
			<div class="entry-meta">
	           <?php gutener_entry_footer(); ?>
	        </div><!-- .entry-meta -->
			
	        <div class="entry-text">
				<?php
					$excerpt_length = get_theme_mod( 'post_excerpt_length', 15 );
					$sticky_simple_excerpt_length = get_theme_mod( 'sticky_simple_post_excerpt_length', 40 );

					if( is_sticky() ){
						gutener_excerpt( $sticky_simple_excerpt_length , true );
					}else{
						gutener_excerpt( $excerpt_length , true );
					}

					$button_type = 'button-text';
					if ( get_theme_mod( 'post_button_type', 'button-text' ) == 'button-primary' ){
						$button_type = 'button-primary';
					}elseif ( get_theme_mod( 'post_button_type', 'button-text' ) == 'button-outline' ){
						$button_type = 'button-outline';
					}
				?>
				<?php if ( !get_theme_mod( 'hide_post_button', true ) && get_theme_mod( 'post_button_text', '' ) ){ ?>
					<div class="button-container">
						<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $button_type ); ?>">
							<?php 
								$post_button_text = get_theme_mod( 'post_button_text', '' );
								echo esc_html( $post_button_text ? $post_button_text : "" );
							?>
						</a>
					</div>
				<?php } ?>	
			</div>
		</div><!-- .entry-content -->
	</article><!-- #post-->
</div>