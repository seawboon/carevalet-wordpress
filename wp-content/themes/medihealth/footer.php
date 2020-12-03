<?php
		//Footer Settings
		$footer_copyright_text = get_theme_mod('medihealth_footer_copyright_text', '');
		$icon_url_1 = get_theme_mod('medihealth_contact_social_icon_url_1', '');
		$icon_url_2 = get_theme_mod('medihealth_contact_social_icon_url_2', '');
		$icon_url_3 = get_theme_mod('medihealth_contact_social_icon_url_3', '');
		$icon_url_4 = get_theme_mod('medihealth_contact_social_icon_url_4', '');
		$icon_url_5 = get_theme_mod('medihealth_contact_social_icon_url_5', '');
		?>
		<!-- Footer Section -->
		<section class="footer-section">
			<div class="container">
				<div class="row">
						<?php 
						// Fetch MediHealth Theme Footer Widget
						get_template_part('sidebar','footer');
						?>
				</div>
			</div>
			<div class="footer_copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-9 copyright">
							<p>
							<?php if($footer_copyright_text != "") { echo esc_html($footer_copyright_text); } else { ?>
								<?php echo date( 'Y' ); ?> <?php esc_html_e( '&copy;', 'medihealth'); ?> <?php bloginfo( 'name'); ?> 
							<?php } ?>
							<?php esc_html_e('- Theme MediHealth by' ,'medihealth'); ?> <?php esc_html_e('A WP Life', 'medihealth'); ?>
							</p>
						</div>
						<div class="col-md-3">
							<div class="footer_follow">
								<?php if($icon_url_1 != "" ) { ?>
									<a href="<?php echo esc_url($icon_url_1); ?>" class="social_icon_in icon_1">
										<i class="fab fa-facebook"></i>
									</a>
								<?php } ?>
								<?php if($icon_url_2 != "" ) { ?>
									<a href="<?php echo esc_url($icon_url_2); ?>" class="social_icon_in icon_2">
										<i class="fab fa-instagram"></i>
									</a>
								<?php } ?>
								<?php if($icon_url_3 != "" ) { ?>
									<a href="<?php echo esc_url($icon_url_3); ?>" class="social_icon_in icon_3">
										<i class="fab fa-youtube"></i>
									</a>
								<?php } ?>
								<?php if($icon_url_4 != "" ) { ?>
									<a href="<?php echo esc_url($icon_url_4); ?>" class="social_icon_in icon_4">
										<i class="fab fa-twitter"></i>
									</a>
								<?php } ?>
								<?php if($icon_url_5 != "" ) { ?>
									<a href="<?php echo esc_url($icon_url_5); ?>" class="social_icon_in icon_5">
										<i class="fab fa-linkedin"></i>
									</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Footer Section -->
		<?php wp_footer(); ?> 
	</body>
</html>