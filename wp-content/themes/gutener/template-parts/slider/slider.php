<?php
/**
 * Template part for displaying slider section
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Gutener 1.0.0
 */

$width_control = '';
if( get_theme_mod( 'slider_width_controls', 'full' ) == 'boxed' && get_theme_mod( 'display_slider_on', 'blog-page-below-header' ) == 'blog-page-above-latest-posts' ){
	$width_control = 'boxed';
}elseif( get_theme_mod( 'slider_width_controls', 'full' ) == 'boxed' ){
	$width_control = 'container boxed';
}

$posts_per_page_count = get_theme_mod( 'slider_posts_number', 6 );
$slider_id = get_theme_mod( 'slider_category', 'Uncategorized' );

$query = new WP_Query( apply_filters( 'gutener_blog_args', array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => $posts_per_page_count,
	'cat'                 => $slider_id,
	'offset'              => 0,
	'ignore_sticky_posts' => 1
)));

$posts_array = $query->get_posts(); ?>

<div class="main-slider-wrap <?php echo esc_attr( $width_control ); ?>">
	<div class="main-slider">
		<?php
			while ( $query->have_posts() ) : $query->the_post();
			$image = get_the_post_thumbnail_url( get_the_ID(), 'gutener-1370-550' );
		?>
			<div class="slide-item">
				<div class="banner-img" style="background-image: url( <?php echo esc_url( $image ); ?> );">
					<?php get_template_part( 'template-parts/slider/slider', 'content' ); ?>
					<div class="overlay"></div>
				</div>
			</div>
		<?php
		endwhile; 
		wp_reset_postdata();
		?>
	</div>
	<?php if( !get_theme_mod( 'disable_slider_arrows', false ) ) { ?>
		<ul class="slick-control">
	        <li class="prev">
	        	<span></span>
	        </li>
	        <li class="next">
	        	<span></span>
	        </li>
	    </ul>
	<?php } ?>
</div>