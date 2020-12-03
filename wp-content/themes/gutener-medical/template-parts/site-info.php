<?php
/**
 * Template part for displaying site info
 *
 * @package Gutener Medical
 */

?>

<div class="site-info">
	<?php echo wp_kses_post( html_entity_decode( get_theme_mod( 'footer_text', esc_html__( 'Copyright &copy; 2020.', 'gutener-medical' ) ) ) ); ?>
	<?php
	printf( esc_html__( 'Gutener Medical', 'gutener-medical' ) );
	?>
	<?php esc_html_e( 'Theme by', 'gutener-medical' ); ?>
	<a href="<?php echo esc_url( __( 'https://keonthemes.com/', 'gutener-medical' ) ); ?>" target="_blank">
		<?php
		printf( esc_html__( 'Keon Themes', 'gutener-medical' ) );
		?>
	</a>
</div><!-- .site-info -->