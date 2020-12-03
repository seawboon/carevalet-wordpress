<?php
/**
 * @author Webkul
 *
 * @version 1.0.0
 * This file handles all admin end actions.
 */

namespace WpPrescription\Includes\Admin;

use WpPrescription\Templates\Admin;

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('PrescriptionAdminHookHandler')) {
    class PrescriptionAdminHookHandler
    {
        public function __construct()
        {
            add_action('admin_menu', array($this, 'wkwp_add_menu_section'));
            add_action('add_meta_boxes', array($this, 'wkwp_prescription_custom_meta'));
            add_action('save_post', array($this, 'wkwp_prescription_meta_save'));
            add_action('admin_init', array($this, 'wkwp_prescription_registration'));
            add_action('admin_enqueue_scripts', array($this, 'wkwp_add_scripts_backend'));
            add_action('woocommerce_admin_order_data_after_order_details', array($this, 'wkwp_prescrption_after_order_itemmeta'));
        }

        public function wkwp_prescrption_after_order_itemmeta($order)
        {
            $order_prescriptions = get_post_meta($order->get_id(), 'order_prescriptions', true);
            if (isset($order_prescriptions) && !empty($order_prescriptions)) {
                $order_prescriptions = json_decode($order_prescriptions);
                if (isset($order_prescriptions) && !empty($order_prescriptions)) {
                    echo '<div class="uploaded-prescription">';
                    echo '<h3>'.esc_html__('Prescription(s)', 'wk_wcps').'</h3>';
                    echo "<div class='ordered_prescription'>";
                    foreach ($order_prescriptions as $key => $value) {
                        echo '<div class="new-upload"><img src="'.$value.'" style="height:100%"></><div id="myModal" class="modal"><span class="close">&times;</span><img class="modal-content" id="img01"><div id="caption"></div></div></div>';
                    }
                    $approval = get_post_meta($order->get_id(), 'approval_status', true) == 'approved' ? 'selected' : '';
                    $reject = get_post_meta($order->get_id(), 'approval_status', true) == 'reject' ? 'selected' : '';
                    echo '<select class="prescription-status" name="prescription-status" style="width:100%"><option value="-1">'.esc_html__('Select Priscription Status', 'wk_wcps').'</option><option value="approved"'.$approval.'>'.esc_html__('Approved', 'wk_wcps').'</option><option value="reject"'.$reject.'>'.esc_html__('Reject', 'wk_wcps').'</option></select>';
                    echo '</div></div>';
                }
            }
        }

        public function wkwp_add_scripts_backend()
        {
            wp_register_style('backend_style', WC_PRESCRIPTION_PLUGIN.'assets/css/backend.css', array(), '1.0.0');
            wp_enqueue_style('backend_style');
            wp_enqueue_style('woocommerce_admin_styles');
            wp_register_script('backend_script', WC_PRESCRIPTION_PLUGIN.'assets/js/backend.js', array(), '1.0.0');
            wp_enqueue_script('backend_script');
            wp_localize_script('backend_script', 'adminajax', array('url' => admin_url('admin-ajax.php')));
        }

        public function wkwp_add_menu_section()
        {
            add_menu_page(esc_html__('WooCommerce Prescription', 'wk_wcps'), esc_html__('WooCommerce Prescription', 'wk_wcps'), 'manage_options', 'woo_prescription', array($this, 'wkwp_woo_products_list'), 'dashicons-index-card', 20);
            add_submenu_page('woo_prescription', esc_html__('Orders', 'wk_wcps'), esc_html('Orders', 'wk_wcps'), 'manage_options', 'orders', array($this, 'wkwp_woo_order_list'));
            add_submenu_page('woo_prescription', esc_html__('Settings', 'wk_wcps'), esc_html__('Settings', 'wk_wcps'), 'manage_options', 'settings', array($this, 'wkwp_woo_settings'));
        }

        public function wkwp_woo_products_list()
        {
            $productListTable = new Admin\PrescriptionProductList();
            $productListTable->prepare_items();
            echo '<div class=wrap>';
            echo '<h1 class="wp-heading-inline">'.esc_html__('Products', 'wk_wcps').'</h1>';
            echo '<form method="POST">'; ?>
        <input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']); ?>" />
        <?php
        $productListTable->search_box('Search', 'search-id');
            $productListTable->display();
            echo '</form>';
            echo '</div>';
        }

        public function wkwp_woo_order_list()
        {
            $orderListTable = new Admin\PrescriptionOrderList();
            $orderListTable->prepare_items();
            echo '<div class=wrap>';
            echo '<h1 class="wp-heading-inline">Orders</h1>';
            echo '<form method="POST">'; ?>
        <input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']); ?>" />
        <?php
        $orderListTable->search_box('Search', 'search-id');
            $orderListTable->display();
            echo '</form>';
            echo '</div>';
        }

        public function wkwp_woo_settings()
        {
            new Admin\PrescriptionSettings();
        }

        public function wkwp_prescription_custom_meta()
        {
            global $post;
            $product = wc_get_product($post->ID);
            if ($product && isset($product) && ($product->is_type('simple') || $product->is_type('variable'))) {
                add_meta_box('prescription_meta', __('prescription Posts', 'wk_wcps'), array($this, 'wkwp_prescription_meta_callback'), 'product', 'side', 'default');
            }
        }

        public function wkwp_prescription_meta_callback($post)
        {
            $featured = get_post_meta($post->ID, 'meta-prescription-post', true); ?>
            
        <p>
            <div class="prescription-row-content">
                <label for="meta-checkbox">
                    <input type="checkbox" name="meta-prescription-post" id="meta-checkbox" <?php if (isset($featured) && $featured == 'yes') {
                echo esc_html('checked');
            } ?> />
                    <?php esc_html_e('Prescribed this post', 'wk_wcps'); ?>
                    <?php wp_nonce_field('meta_box_nonce', 'prescription_nonce'); ?>
                </label>
            </div>
        </p>
    <?php
        }

        /**
         * Saves the custom meta input.
         */
        public function wkwp_prescription_meta_save($post_id)
        {
            global $wpdb;
            // Checks save status
            $is_valid_nonce = (isset($_POST['prescription_nonce']) && wp_verify_nonce($_POST['prescription_nonce'], 'meta_box_nonce')) ? 'true' : 'false';
            // Exits script depending on save status
            if (!$is_valid_nonce) {
                return;
            }
            // Checks for input and saves

            $order = wc_get_order($post_id);

            if ($order && $_POST['action'] == 'editpost' && $_POST['save'] == 'Update') {
                if (isset($_POST['prescription-status']) && !empty($_POST['prescription-status']) && $_POST['prescription-status'] != '-1') {
                    update_post_meta($post_id, 'approval_status', $_POST['prescription-status']);
                    $data['message'] = $_POST['prescription-status'] == 'reject' ? 'Rejected' : 'Approved';
                    $data['id'] = $post_id;
                    $order = wc_get_order($post_id);
                    $data['name'] = $order->get_billing_first_name();
                    $data['email'] = $order->get_billing_email();
                    do_action('wcp_send_prescription_status', $data);
                }
            }

            if (isset($_POST['meta-prescription-post']) && !empty($_POST['meta-prescription-post'])) {
                update_post_meta($post_id, 'meta-prescription-post', 'yes');
            } else {
                update_post_meta($post_id, 'meta-prescription-post', 'no');
            }
        }

        public function wkwp_prescription_registration()
        {
            register_setting('prescription-settings-group', 'prescription_heading');
            register_setting('prescription-settings-group', 'prescription_content');
        }
    }
}
