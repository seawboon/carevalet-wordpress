<?php
/**
 * Template part for displaying site info
 *
 * @package Gutener
 */

?>

<div class="site-info">
	<?php echo wp_kses_post( html_entity_decode( get_theme_mod( 'footer_text', esc_html__( 'Copyright &copy; 2020.', 'gutener' ) ) ) ); ?>
	<?php
	printf( esc_html__( 'Gutener', 'gutener' ) );
	?>
	<?php esc_html_e( 'Theme by', 'gutener' ); ?>
	<a href="<?php echo esc_url( __( 'https://keonthemes.com/', 'gutener' ) ); ?>" target="_blank">
		<?php
		printf( esc_html__( 'Keon Themes', 'gutener' ) );
		?>
	</a>
</div><!-- .site-info -->