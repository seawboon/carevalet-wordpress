<?php
/**
 * @author Webkul
 *
 * @version 1.0.0
 * This file handles all front end actions.
 */

namespace WpPrescription\Includes\Front;

use WC_Order;

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('PrescriptionFrontHookHandler')) {
    class PrescriptionFrontHookHandler
    {
        public $prescription_needed = 'no';
        public $lastid = '';

        public function __construct()
        {
            add_action('wp_enqueue_scripts', array($this, 'wkwp_add_scripts_frontend'));
            add_action('woocommerce_thankyou', array($this, 'wkwp_show_prescriptions'), 10, 1);
            add_action('woocommerce_after_cart_table', array($this, 'wkwp_add_prescription_in_cart'));
            add_action('woocommerce_before_cart', array($this, 'wkwp_find_prescription_product_in_cart'));
            add_action('woocommerce_checkout_update_order_meta', array($this, 'wkwp_add_data_to_order'), 10);
            add_action('woocommerce_view_order', array($this, 'wkwp_show_prescriptions_view_order_page'), 10);
            add_filter('woocommerce_order_button_html', array($this, 'wkwp_pres_validate_order_button'), 10, 2);
            add_action('woocommerce_after_order_notes', array($this, 'wkwp_add_prescription_checkout_page'), 10);
            add_action('woocommerce_before_cart_table', array($this, 'wkwp_display_valid_prescription_details'));
            add_action('woocommerce_after_calculate_totals', array($this, 'wkwp_woocommerce_after_calculate_totals'));
            add_filter('woocommerce_get_cart_item_from_session', array($this, 'wkwp_add_prescription_values'), 1, 3);
            add_action('woocommerce_checkout_update_order_meta', array($this, 'wkwp_prescription_save_custom_field_usermeta'), 99);
            add_filter('woocommerce_update_cart_action_cart_updated', array($this, 'wkwp_clear_notices_prescription'), 10, 1);
            add_action('woocommerce_product_meta_start', array($this, 'wkwp_prescription_enable_status'), 10);
        }

        public function wkwp_prescription_enable_status()
        {
            global $product;
            if (get_post_meta($product->get_id(), 'meta-prescription-post', true) == 'yes') {
                echo '<p class="show-prescription-required">'.esc_html__('Requires Prescription', 'wk_wcps').'</p>';
            }
        }

        public function wkwp_clear_notices_prescription()
        {
            wc_clear_notices();
        }

        public function wkwp_woocommerce_after_calculate_totals()
        {
            $count = 0;
            $notice_type = 'error';
            $cart_contents = WC()->cart->cart_contents;

            $prescription = WC()->session->get('prescription');
            $time = WC()->session->get('time');

            $message = esc_html__('The cart contains prescription product(s), but there is no prescription attached yet.', 'wk_wcps');

            $bool = wc_has_notice($message, $notice_type);
            foreach ($cart_contents as $key => $value) {
                $prescription_product = get_post_meta($value['product_id'], 'meta-prescription-post', true);
                if ($prescription_product == 'yes') {
                    ++$count;
                }
            }
            if ($count > 0 && $prescription == null && $bool == false && $time == 'now') {
                wc_print_notice($message, $notice_type);
            }
            if (get_current_user_id() == 0 && $time != 'now' && (is_page('cart') || is_page('checkout'))) {
                wc_print_notice(esc_html__('Guest customer need to attach the prescription at order time.', 'wk_wcps'), $notice_type);
            }
        }

        public function wkwp_show_prescriptions_view_order_page($order_id)
        {
            $order_prescriptions = sanitize_text_field(get_post_meta($order_id, 'order_prescriptions', true));
            if (isset($order_prescriptions) && !empty($order_prescriptions)) {
                $order_prescriptions = json_decode($order_prescriptions);
                get_post_meta($order_id, 'is_gift', true);
                echo '<h2>'.esc_html__('Prescription(s)', 'wk_wcps').'</h2>'; ?>
            <table class="woocommerce-table shop_table gift_info">
                <tbody>
                    <tr>
                        <th><?php echo esc_html__('Prescription Approval Status', 'wk_wcps'); ?></th>
                        <td><?php echo get_post_meta($order_id, 'approval_status', true) == '' ? esc_html__('Waiting For Approval', 'wk_wcps') : get_post_meta($order_id, 'approval_status', true); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php
            echo "<div class='upload-prescription uploaded_prescription checkout later-upload'>";

                echo "<div class='new-upload'>";
                echo "<form id='prescription-form' method='post' name='prescription-form' enctype='multipart/form-data'>";
                echo "<i class='fa fa-arrow-alt-circle-up fa-3x'></i><br>";
                echo "<label class='input_file_style'>Attach Prescription</label>";
                echo "<input type='hidden' name='order_id' id='order_id' value=' $order_id' class='input-control'>";
                echo "<input type='file' name='attach-prescription-input-later' id='attach-prescription-input-later' class='input-control'>";
                echo "<span class='error-control'></span>";
                echo '</form>';
                echo '</div>';
                if (isset($order_prescriptions) && !empty($order_prescriptions)) {
                    foreach ($order_prescriptions as $key => $value) {
                        echo '<div class="new-upload " > <img   src="'.esc_url($value).'" style="height:100%"></><div id="myModal" class="modal"><span class="close">&times;</span><img class="modal-content"id="img01"><div id="caption"></div></div></div>';
                    }
                }
                echo '</div>';
            }
        }

        public function wkwp_add_data_to_order($order_id)
        {
            $cart_data = WC()->session->get('prescription');
            $cart_data = json_encode($cart_data);
            $time = WC()->session->get('time');
            if ($time == 'now') {
                update_post_meta($order_id, 'order_prescriptions', $cart_data);
                update_post_meta($order_id, 'approval_status', 'Waiting For Approve');
            } else {
                update_post_meta($order_id, 'order_prescriptions', json_encode(array()));
                update_post_meta($order_id, 'approval_status', 'Waiting for prescription to upload');
            }
        }

        public function wkwp_show_prescriptions()
        {
            $cart_data = WC()->session->get('prescription');
            if (isset($cart_data) && !empty($cart_data)) {
                echo '</div><div class="uploaded_prescription checkout">';
                echo '<h3>'.esc_html__('Uploaded Prescriptions', 'wk_wcps').'</h3>';
                foreach ($cart_data as $key => $value) {
                    echo '<div class="new-upload " > <img  src="'.esc_url($value).'" style="height:100%"></><div id="myModal" class="modal"><span class="close">&times;</span><img class="modal-content"id="img01"><div id="caption"></div></div></div>';
                }
                echo '</div>';
            }
        }

        public function wkwp_add_prescription_checkout_page()
        {
            $cart_data = WC()->session->get('prescription');
            if (isset($cart_data) && !empty($cart_data)) {
                echo '<div class="uploaded_prescription checkout">';
                echo '<h3> '.esc_html__('Uploaded Prescriptions', 'wk_wcps').' </h3>';
                foreach ($cart_data as $key => $value) {
                    echo '<div class="new-upload " > <img   src="'.esc_url($value).'" style="height:100%"></><div id="myModal" class="modal"><span class="close">&times;</span><img class="modal-content"id="img01"><div id="caption"></div></div></div>';
                }
                echo '</div>';
            }
        }

        public function wkwp_prescription_save_custom_field_usermeta($order_id)
        {
            $order = new WC_Order($order_id);
            $user_id = $order->customer_user;
            $cart_data = WC()->session->get('prescription');
            $cart_data = json_encode($cart_data);
            if (!empty($cart_data)) {
                update_user_meta($user_id, 'prescription', $cart_data);
            }
        }

        public function wkwp_add_scripts_frontend()
        {
            wp_enqueue_style('frontend_style', WC_PRESCRIPTION_PLUGIN.'assets/css/frontend.css', array(), '1.0.0');
            wp_enqueue_script('jQuery');
            wp_enqueue_script('frontend_script', WC_PRESCRIPTION_PLUGIN.'assets/js/frontend.js', array(), '1.0.1');
            $translated_strings = array(
                'error' => esc_html__('Error in upload', 'wk_wcps'),
                'invalid_image' => esc_html__('Please select valid image', 'wk_wcps'),
                'remove' => esc_html__('Remove', 'wk_wcps'),
                'prescription_uploaded' => esc_html__('Prescription Uploaded by you', 'wk_wcps'),
                'browse_image' => esc_html__('Browse Image', 'wk_wcps'),
            );
            wp_localize_script('frontend_script', 'adminajax', array('url' => admin_url('admin-ajax.php'), 'strings' => $translated_strings));
        }

        public function wkwp_add_prescription_in_cart()
        {
            if ($this->prescription_needed == 'yes') {
                if (isset($_FILES['attach-prescription-input']) && !empty($_FILES['attach-prescription-input'])) {
                    $_FILES['attach-prescription-input']['name'] = str_replace('_', '--', $_FILES['attach-prescription-input']['name']);
                    $logo_application = sanitize_mime_type($_FILES['attach-prescription-input']);
                    if (!empty($logo_application)) {
                        $logo_application_type = explode('/', $logo_application['type']);
                        $logo_application_type = $logo_application_type[1];
                        if ($logo_application_type == 'png' || $logo_application_type == 'jpg' || $logo_application_type == 'jpeg') {
                            $_FILES['attach-prescription-input']['name'] = str_replace('--', '_', $_FILES['attach-prescription-input']['name']);
                            $logo_application['name'] = str_replace('--', '_', $logo_application['name']);
                            $logo_application = $logo_application['name'];
                        } else {
                            $logo_application = '';
                        }
                    } else {
                        $logo_application = '';
                    }
                } else {
                    $logo_application = '';
                }
                echo '<h3 class=heading-attachment>'.esc_html__('Attach Prescription', 'wk_wcps').'</h3>'; ?>
            <div class="prescription-upload">
                <label><input type="radio" name="prescription_upload" class="prescription_upload" value="later" <?php echo WC()->session->get('time') != 'now' ? 'checked' : ''; ?>><?php echo esc_html__('Attach later', 'wk_wcps'); ?></label>
                <label><input type="radio" name="prescription_upload" class="prescription_upload" value="now" <?php echo WC()->session->get('time') == 'now' ? 'checked' : ''; ?>><?php echo esc_html('Attach Now', 'wk_wcp'); ?></label>
            </div>
            <div class="attach-prescription" style="display: <?php echo WC()->session->get('time') == 'now' ? 'block' : 'none'; ?>;">
                <ul class="tab-container">
                    <li class="tabheading active"><i class="fa fa-image"></i><?php echo esc_html__('Browse Image', 'wk_wcps'); ?></li>
                    <li class="tabheading"><i class="fa fa-list-alt"></i> <?php echo esc_html__('Prescription Uploaded by you', 'wk_wcps'); ?></li>
                </ul>
                <div class="tab-content">
                    <div class="upload-prescription">
                        <div class="new-upload">
                            <form id="prescription-form" method="post" name="prescription-form" enctype="multipart/form-data">
                                <i class="fa fa-arrow-alt-circle-up fa-3x"></i><br>
                                <label class="input_file_style"><?php echo esc_html__('Attach Prescription', 'wk_wcps'); ?></label>
                                <input type="file" name="attach-prescription-input" id="attach-prescription-input" class="input-control">
                                <span class="error-control"></span>
                            </form>
                        </div>
                        <?php
                        $cart_data = WC()->session->get('prescription');
                if (isset($cart_data) && is_array($cart_data)) {
                    foreach ($cart_data as $key => $value) {
                        echo '<div class="new-upload " > <img src ="'.$value.'" style="height:100%"></><div id="myModal" class="modal"><span class="close">&times;</span><img class="modal-content"id="img01"><div id="caption"></div>upload-prescription</div><button class="remove-prescription"><span class="remove-txt">'.esc_html__('Remove', 'wk_wcps').'</span><span class="cross-sign">X</span></button></div>';
                    }
                } ?>
                    </div>
                    <div class="uploaded-prescription">
                        <?php
                        $user = get_current_user_id();
                $prescriptions = sanitize_text_field(get_user_meta($user, 'prescription', true));
                $prescriptions = json_decode($prescriptions);
                if (isset($prescriptions) && !empty($prescriptions)) {
                    foreach ($prescriptions as $key => $value) {
                        echo '<div class="new-upload " > <img src="'.$value.'" style="height:100%"></><div id="myModal" class="modal"><span class="close">&times;</span><img class="modal-content"id="img01"><div id="caption"></div></div></div>';
                    }
                } else {
                    echo '<h3>'.esc_html__('Sorry no prescriptions uploaded by you!', 'wk_wcps').'</h3>';
                } ?>
                    </div>
                </div>
            </div>
        <?php
            }
        }

        public function wkwp_find_prescription_product_in_cart()
        {
            $cnt_pre_product = 0;
            foreach (WC()->cart->get_cart() as $cart_item) {
                $product_id = sanitize_text_field($cart_item['product_id']);
                $this->lastid = $product_id;
                $product_prescription = get_post_meta($product_id, 'meta-prescription-post', true);
                $product_prescription = sanitize_text_field($product_prescription);
                if ((isset($product_prescription) || !empty($product_prescription)) && $product_prescription == 'yes') {
                    ++$cnt_pre_product;
                }
                if ($cnt_pre_product > 0) {
                    $this->prescription_needed = 'yes';
                } else {
                    $this->prescription_needed = 'no';
                }
            }
        }

        public function wkwp_display_valid_prescription_details()
        {
            if ($this->prescription_needed == 'yes') {
                $heading = sanitize_text_field(get_option('prescription_heading'));
                $content = sanitize_text_field(get_option('prescription_content'));
                if (isset($heading) && !empty($heading) && isset($content) && !empty($content)) {
                    echo "<div class='valid-prescription'><h3>".esc_html($heading).'</h3></div>';
                    echo '<div id=myPrescritionModal class=modal><span class="myPrescritionclose">&times;</span><p class="modal-content detail-content" id=myPrescritionModalimg01>'.esc_html($content).'</p></div>';
                }
            }
        }

        public function wkwp_add_prescription_values($item, $values, $key)
        {
            //Check if the key exist and add it to item variable.
            if (array_key_exists('prescription_custom_data', $values)) {
                $item['prescription_custom_data'] = $this->prescription_needed;
            }

            return $item;
        }

        public function wkwp_pres_validate_order_button($order_button)
        {
            $cart_data = WC()->session->get('prescription');

            $time = WC()->session->get('time');

            if ((get_current_user_id() != 0 && ((!empty($cart_data) && $time == 'now') || $time != 'now')) || (get_current_user_id() == 0 && $time == 'now' && !empty($cart_data))) {
                return $order_button;
            } else {
                return '';
            }
        }
    }
}
