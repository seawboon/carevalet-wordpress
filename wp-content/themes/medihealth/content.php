<?php
/**
 * Content 
 *
 * @package MediHealth WordPress theme
 */
	//Defaults
	$medihealth_blog_date = get_theme_mod('medihealth_blog_date', '1');
	$medihealth_blog_user = get_theme_mod('medihealth_blog_user', '1');
	$medihealth_blog_comments = get_theme_mod('medihealth_blog_comments', '1');
	$medihealth_blog_categories = get_theme_mod('medihealth_blog_categories', '1');
?>
<div class="blog-post" <?php post_class(); ?>>
	<div class="blog_head">
		<?php if($medihealth_blog_date == '1' || $medihealth_blog_user == '1' || $medihealth_blog_comments == '1') : ?>
			<h5>
				<?php if($medihealth_blog_date == '1') : ?>
					<i class="far fa-calendar-alt"></i><a href="<?php the_permalink(); ?>"><?php echo get_the_date( 'j M, Y' ); ?></a>
					<span> <?php esc_html_e('|' ,'medihealth'); ?> </span>
				<?php endif; ?>
				<?php if($medihealth_blog_user == '1') : ?>
					<i class="fas fa-user"></i>  <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a> 
					<span> <?php esc_html_e('|' ,'medihealth'); ?> </span>
				<?php endif; ?>
				<?php if($medihealth_blog_comments == '1') : ?>
					<i class="fas fa-comment"></i> <?php comments_number ( __('No Comments', 'medihealth'), __( 'One Comment', 'medihealth'), __('% Comments', 'medihealth') ); ?>
				<?php endif; ?>
			</h5>
		<?php endif; ?>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php if ( has_post_thumbnail() ) { ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
		<?php } ?>
	</div>
	<?php if( is_search() OR is_archive() ){ ?>
		<p>
			<?php the_excerpt(); ?>
			<div class="blog_read_more">
				<a href="<?php esc_url(the_permalink()); ?>"><?php esc_html_e('Read More', 'medihealth'); ?></a>
			</div>
		</p>
	<?php } else {
			if($post->post_excerpt){ ?>
				<p>
					<?php the_excerpt(); ?>
					<div class="blog_read_more">
						<a href="<?php esc_url(the_permalink()); ?>"><?php esc_html_e('Read More', 'medihealth'); ?></a>
					</div>
				</p>
			<?php 
			} else { ?>
				<div class="blog_txt">
					<?php the_content(); ?>
				<div>
			<?php
			}
	} ?>
	<?php 
	if ($medihealth_blog_categories == '1') :
		if (has_category()) : 
		?>
		<div class="blog_single text-center">
			<h5 class="blog_cat" >
				<?php the_category(' '); ?>
			</h5>
		</div>
	<?php 
		endif; 
	endif; 
	?>
</div>