<?php
/**
 * Template part for displaying site branding.
 *
 * @since Gutener
 */

?>

<div class="site-branding">
	<?php
		if( is_front_page() && get_theme_mod( 'header_layout', 'header_one' ) == 'header_three' && get_theme_mod( 'header_separate_logo', '' ) ){ ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php echo esc_url( get_theme_mod( 'header_separate_logo', '' ) ); ?>">
			</a>
		<?php
		} else{
			the_custom_logo();
		}
		if( !get_theme_mod( 'disable_site_title', false ) ){
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
		}
		$gutener_description = get_bloginfo( 'description', 'display' );
		if( !get_theme_mod( 'disable_site_tagline', false ) ){
			if ( $gutener_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $gutener_description; /* WPCS: xss ok. */ ?></p>
			<?php endif;
		}
	?>
</div><!-- .site-branding -->