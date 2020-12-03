<?php
/**
 * Breadcrumb
 *
 * @package MediHealth WordPress theme
 */
?>
<!-- Breadcrumb -->
<section class="inner_slider_part">
	<div class="container">
		<div class="inner_slider_content">
			<?php 
				if ( is_home() && ! is_paged() ) {?>
					<h1><?php esc_html_e( 'Blog', 'medihealth' ); ?></h1>
				<?php } else {
			?>
			<h1><b><?php the_title(); ?></b></h1>
			<?php } ?>
		</div>
	</div>
</section>
<!-- Breadcrumb -->
