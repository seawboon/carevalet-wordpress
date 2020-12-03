<?php
/**
 * Template part for displaying slider content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Gutener 1.0.0
 */
?>

<?php
$alignmentClass = 'text-center';
if ( get_theme_mod( 'main_slider_content_alignment' , 'center' ) == 'left' ){
	$alignmentClass = 'text-left';
}elseif ( get_theme_mod( 'main_slider_content_alignment' , 'center' ) == 'right' ){
	$alignmentClass = 'text-right';
}
?>

<div class="slide-inner">
	<div class="banner-content <?php echo esc_attr( $alignmentClass ); ?>">
	    <div class="entry-content">
	    	<header class="entry-header">
				<?php
				if( !get_theme_mod( 'hide_slider_category', false ) ){
					gutener_entry_header();
				}
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					if ( !get_theme_mod( 'hide_slider_title', false ) ){
						the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					}
				endif; 
				
				?>
			</header><!-- .entry-header -->
			<div class="entry-meta">
				<?php
					if( !get_theme_mod( 'hide_slider_date', false ) ): ?>
						<span class="posted-on">
							<a href="<?php echo esc_url( gutener_get_day_link() ); ?>" >
								<?php echo esc_html(get_the_date('M j, Y')); ?>
							</a>
						</span>
					<?php endif; 
					if( !get_theme_mod( 'hide_slider_author', false ) ): ?>
						<span class="byline">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
								<?php echo get_the_author(); ?>
							</a>
						</span>
					<?php endif; 
					if( !get_theme_mod( 'hide_slider_comment', false ) ):
						echo '<span class="comments-link">';
						comments_popup_link(
							sprintf(
								wp_kses(
									/* translators: %s: post title */
									__( 'Comment<span class="screen-reader-text"> on %s</span>', 'gutener' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							)
						);
						echo '</span>';
					endif;
				?>
	        </div><!-- .entry-meta -->
			
	        <div class="entry-text">
				<?php if ( !get_theme_mod( 'hide_slider_excerpt', false ) ){
					$excerpt_length = get_theme_mod( 'slider_excerpt_length', 25 );
					gutener_excerpt( $excerpt_length , true );
				}

				$button_type = 'button-outline';
				if ( get_theme_mod( 'slider_button_type', 'button-outline' ) == 'button-primary' ){
					$button_type = 'button-primary';
				}elseif ( get_theme_mod( 'slider_button_type', 'button-outline' ) == 'button-text' ){
					$button_type = 'button-text';
				}

				if ( !get_theme_mod( 'hide_slider_button', true ) && get_theme_mod( 'slider_button_text', '' ) ){ ?>
					<div class="button-container">
						<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $button_type ); ?>">
							<?php
								$slider_button_text = get_theme_mod( 'slider_button_text', '' );
								echo esc_html( $slider_button_text ? $slider_button_text : "" );
							?>
						</a>
					</div>
				<?php } ?>
			</div>
		</div><!-- .entry-content -->
	</div>
</div>
