<?php
/**
 * Plugin Name: WooCommerce Prescription
 * Plugin URI: https://webkul.com
 * Description: Wordpress WooCommerce Prescription Plugin allow customer to upload prescription to buy medicines.
 * Version: 1.0.0
 * Author: Webkul
 * Author URI: https://webkul.com
 * Text Domain: wk_wcps.
 **/

/*----------*/ /*---------->>> Exit if Accessed Directly <<<----------*/ /*----------*/

namespace WpPrescription;

if (!defined('ABSPATH')) {
    exit;
}

!defined('WC_PRESCRIPTION_PLUGIN') && define('WC_PRESCRIPTION_PLUGIN', plugin_dir_url(__FILE__));
!defined('WC_PRESCRIPTION_DIR_FILE') && define('WC_PRESCRIPTION_DIR_FILE', plugin_dir_path(__FILE__));

if (!class_exists('PrescriptionMainFunction')) {
    class PrescriptionMainFunction
    {
        public function __construct()
        {
            ob_start();
            load_plugin_textdomain('WK_WCP', false, basename(dirname(__FILE__)).'/languages');
            add_action('init', array($this, 'wkwp_prescription_includes'));
            add_action('init', array($this, 'wkwp_check_woocommerce_is_installed'));
            add_action('admin_notices_woocommerce', array($this, 'wkwp_woocommerce_missing_notice'));
            add_action('wp_ajax_nopriv_wkwp_add_session_prescription', array($this, 'wkwp_add_session_prescription'));
            add_action('wp_ajax_wkwp_add_session_prescription', array($this, 'wkwp_add_session_prescription'));
            add_action('wp_ajax_nopriv_wkwp_remove_session_prescription', array($this, 'wkwp_remove_session_prescription'));
            add_action('wp_ajax_wkwp_remove_session_prescription', array($this, 'wkwp_remove_session_prescription'));
            add_action('wp_ajax_nopriv_wkwp_add_session_prescription_from_uploaded', array($this, 'wkwp_add_session_prescription_from_uploaded'));
            add_action('wp_ajax_wkwp_add_session_prescription_from_uploaded', array($this, 'wkwp_add_session_prescription_from_uploaded'));
            add_action('wp_ajax_nopriv_wkwp_add_order_prescription_from_uploaded', array($this, 'wkwp_add_order_prescription_from_uploaded'));
            add_action('wp_ajax_wkwp_add_order_prescription_from_uploaded', array($this, 'wkwp_add_order_prescription_from_uploaded'));
            add_action('wp_ajax_nopriv_wkwp_attachment_save_time', array($this, 'wkwp_attachment_save_time'));
            add_action('wp_ajax_wkwp_attachment_save_time', array($this, 'wkwp_attachment_save_time'));
            add_filter('woocommerce_email_actions', array($this, 'wkwp_prescription_add_woocommerce_email_actions'));
            add_filter('woocommerce_email_classes', array($this, 'wkwp_prescription_add_new_email_notification'), 10, 1);
        }

        public function wkwp_prescription_add_woocommerce_email_actions($actions)
        {
            $actions[] = 'wcp_send_prescription_status';

            return $actions;
        }

        /**
         * Add mail class.
         *
         * @param array $email email
         *
         * @return $email
         */
        public function wkwp_prescription_add_new_email_notification($email)
        {
            $email['WC_EMAIL_Send_Prescription_Status_Mail'] = include plugin_dir_path(__FILE__).'includes/admin/class-wc-email-send-prescription-status-mail.php';

            return $email;
        }

        public function wkwp_attachment_save_time()
        {
            $time = sanitize_text_field($_POST['time']);

            if (isset($time) && !empty($time) && $time == 'now') {
                WC()->session->set('time', $time);
            } else {
                WC()->session->set('time', $time);
                WC()->session->set('prescription', array());
            }

            die;
        }

        public function wkwp_add_session_prescription_from_uploaded()
        {
            $img = sanitize_text_field($_POST['add_prescription']);
            $cart_datas = WC()->session->get('prescription');
            $length_pres = count($cart_datas);
            $count = 0;
            foreach ($cart_datas as $key => $value) {
                if ($value == $img) {
                    ++$count;
                }
            }
            if ($count > 0) {
                echo esc_html__('Prescription Already added', 'wk_wcps');
            } else {
                $cart_datas[$key + 2] = $img;
                WC()->session->set('prescription', $cart_datas);
                echo esc_html__('Prescription Successfully added', 'wk_wcps');
            }
            die;
        }

        public function wkwp_add_order_prescription_from_uploaded()
        {
            if (isset($_POST) && !empty($_POST) && isset($_POST['order_id']) && !empty($_POST['order_id'])) {
                $uploaded = json_decode(get_post_meta($_POST['order_id'], 'order_prescriptions', true));
                $upload_overrides = array('test_form' => false);

                $move_file = wp_handle_upload($_FILES['file'], $upload_overrides);

                if ($move_file && !isset($move_file['error'])) {
                    $uploaded[] = $move_file['url'];
                    update_post_meta($_POST['order_id'], 'order_prescriptions', json_encode($uploaded));
                    update_post_meta($_POST['order_id'], 'approval_status', 'Waiting For Approve');
                    echo $move_file['url'];
                }
            }

            echo false;
            die;
        }

        public function wkwp_remove_session_prescription()
        {
            $cart_data = array();
            $remove_data = sanitize_text_field($_POST['remove_prescription']);
            $cart_data = WC()->session->get('prescription');
            foreach ($cart_data as $key => $value) {
                if ($value == $remove_data) {
                    if (count($cart_data) <= 1) {
                        $cart_data = array();
                    } else {
                        unset($cart_data[$key]);
                    }
                }
            }
            if (isset($cart_data)) {
                WC()->session->set('prescription', $cart_data);
            }
            die;
        }

        public function wkwp_add_session_prescription()
        {
            global $wp_query;
            $cart_data = array();
            $cart_data = WC()->session->get('prescription');

            $upload_overrides = array('test_form' => false);
            $same_image = false;
            foreach ($cart_data as $value) {
                if (strpos($value, str_replace(')', '', str_replace('(', '', str_replace(' ', '-', $_FILES['file']['name']))))) {
                    $same_image = true;
                    break;
                }
            }

            if (!$same_image) {
                $move_file = wp_handle_upload($_FILES['file'], $upload_overrides);

                if ($move_file && !isset($move_file['error'])) {
                    $cart_data[] = $move_file['url'];

                    WC()->session->set('prescription', $cart_data);
                    echo $move_file['url'];
                }
            } else {
                echo false;
            }

            die;
        }

        public function wkwp_check_woocommerce_is_installed()
        {
            ob_start();
            if (!function_exists('WC')) {
                do_action('admin_notices_woocommerce');
            }
        }

        public function wkwp_woocommerce_missing_notice()
        {
            echo '<div class="error"><p>'.sprintf(esc_html__('WooCommerce Prescription depends on the last version of', 'wk_wcps').' %s  '.esc_html__('or later to work!', 'wk_wcps'), '<a href="http://www.woothemes.com/woocommerce/" target="_blank">'.esc_html('WooCommerce').'</a>').'</p></div>';
        }

        public function wkwp_prescription_includes()
        {
            require_once WC_PRESCRIPTION_DIR_FILE.'includes/woocommerce-prescription-file-handler.php';
        }
    }
    new PrescriptionMainFunction();
}
