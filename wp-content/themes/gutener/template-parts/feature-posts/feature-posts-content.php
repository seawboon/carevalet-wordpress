<?php
/**
 * Template part for displaying slider content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Gutener 1.0.0
 */

$noThumbnail='';
if( get_theme_mod( 'hide_feature_posts_image', false ) || !has_post_thumbnail() ){
	$noThumbnail = 'has-no-thumbnail';
}
?>

<div class="slide-inner">
	<article id="post-<?php the_ID(); ?>" <?php post_class( $noThumbnail ) ?>>
		<div class="post-inner">
			<?php
			if ( get_theme_mod( 'feature_posts_slides_show', 3 ) == 2 ){
        		$image_size = 'gutener-590-310';
        	}else {
        		$image_size = 'gutener-420-300';
			}
			$image    = get_the_post_thumbnail_url( get_the_ID(), $image_size );
			$image_id = get_post_thumbnail_id();
			$alt      = get_post_meta( $image_id, '_wp_attachment_image_alt', true);

			if ( !get_theme_mod( 'hide_feature_posts_image', false ) && has_post_thumbnail()){ ?>
				<figure class="featured-image">
					<a href="<?php the_permalink(); ?>">
						<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo $alt; ?>">
					</a>
				</figure>
			<?php } ?>
			<div class="entry-meta">
				<?php if( 'post' == get_post_type() ): 
					$categories_list = get_the_category_list( ' ' );
					if( $categories_list && !get_theme_mod( 'hide_feature_posts_category', false ) ):
				
					printf( '<span class="cat-links">' . '%1$s' . '</span>', $categories_list );
						
				endif; endif; ?>
			</div>
		</div>
		<div class="post-content-wrap">
			<div class="entry-content">
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
				</h3>
			</div>
			<div class="entry-meta">
				<?php
					if( !get_theme_mod( 'hide_feature_posts_date', false ) ): ?>
						<span class="posted-on">
							<a href="<?php echo esc_url( gutener_get_day_link() ); ?>" >
								<?php echo esc_html(get_the_date('M j, Y')); ?>
							</a>
						</span>
					<?php endif; 
					if( !get_theme_mod( 'hide_feature_posts_author', false ) ): ?>
						<span class="byline">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
								<?php echo get_the_author(); ?>
							</a>
						</span>
					<?php endif; 
					if( !get_theme_mod( 'hide_feature_posts_comment', false ) ): ?>
						<span class="comments-link">
							<a href="<?php comments_link(); ?>">
								<?php echo absint( wp_count_comments( get_the_ID() )->approved ); ?>
							</a>
						</span>
					<?php endif; ?>
				</div>
			</div>
	</article>
</div>

