<?php
/**
 * Designation Meta
 *
 * @package MediHealth WordPress theme
 */
	
	//Load Settings
	$medihealth_designation = get_post_meta( $post->ID, 'medihealth_testimonail_designation', true);
?>
<div class="input-text-wrap" id="title-wrap">
	<input style="width:100%;" type="text" id="medihealth_testimonail_designation" name="medihealth_testimonail_designation" placeholder="<?php esc_attr_e('Designation Here','medihealth'); ?>" value="<?php echo esc_attr($medihealth_designation);?>">
</div>
<?php wp_nonce_field( 'medihealth_save_designation_settings', 'medihealth_designations_settings_nonce' ); ?>