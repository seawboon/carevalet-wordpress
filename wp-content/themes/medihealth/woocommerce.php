<?php
/**
 * Woocommerce
 *
 * @package MediHealth WordPress theme
 */

get_header();
global $woocommerce; ?>
<!-- Breadcrumb -->
	<?php get_template_part('breadcrumb'); ?>
<!-- Breadcrumb -->

<!-- Woocommerce -->
<section class="site-content woocommerce woocommerce-title">
	<div class="container">
		<div class="row">
			<div class="col-md-<?php echo ( !is_active_sidebar( 'woocommerce' ) ? '12' :'8' ); ?> col-xs-12 section-spacing">
				<?php woocommerce_content(); ?>
			</div>
			<!--/woocommerce Section-->
			<?php  if ( is_active_sidebar( 'woocommerce' )  ) { ?>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="sidebar">
						<?php get_sidebar('woocommerce'); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<!-- Woocommerce  -->
<?php get_footer();