<?php
/**
 * Prescription Status email.
 *
 * @since 1.0.0
 */
defined('ABSPATH') || exit;

$id = $data['id'];
$supplier_name = $data['name'];
$comment = $data['message'];

$text_align = is_rtl() ? 'right' : 'left';

do_action('woocommerce_email_header', $email_heading, $email);

$result = '<h3 style="text-align:'.esc_attr($text_align).'">'.esc_html__('Hello', 'wk_wcps').' '.esc_attr($supplier_name).',</h3>';
$result .= '<p style="text-align:'.esc_attr($text_align).'">'.esc_html__('The prescription uploaded by you for order ID', 'wk_wcps').' '.' #'.esc_attr($id).' is <b>'.esc_html($comment).'</b></p>';

echo $result;

echo '<p>'.esc_html__('Looking forward to proceed order. For any query feel free to contact.', 'wk_wcps').'</p>';

do_action('woocommerce_email_footer', $email);
