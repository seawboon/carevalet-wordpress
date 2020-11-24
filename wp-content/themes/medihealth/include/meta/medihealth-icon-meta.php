<?php
/**
 * Icon Meta
 *
 * @package MediHealth WordPress theme
 */
 
	//Load Settings
	$medihealth_icon = get_post_meta( $post->ID, 'medihealth_service_icon', true);
?>
<div class="input-text-wrap" id="title-wrap">
	<input style="width:100%;" type="text" id="medihealth_service_icon" name="medihealth_service_icon" placeholder="<?php esc_attr_e('Icon Class Here','medihealth'); ?>" value="<?php echo esc_attr($medihealth_icon);?>">
	<a href="<?php echo esc_url('https://fontawesome.com/v4.7.0/cheatsheet/');?> " class="lib-link" target="_new"><?php esc_html_e('Icon Library','medihealth'); ?></a>
</div>
<?php wp_nonce_field( 'medihealth_save_icon_settings', 'medihealth_icons_settings_nonce' ); ?>