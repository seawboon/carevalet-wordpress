<?php
/**
 * @author Webkul
 *
 * @version 1.0.0
 * This template shows product list.
 */

namespace WpPrescription\Templates\Admin;

use WP_List_Table;

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('PrescriptionOrderList')) {
    class PrescriptionOrderList extends WP_List_Table
    {
        public $order_link = array();
        public $post_ids = array();
        public $search_key = '';
        public $filter = '';

        public function __construct()
        {
            global $status, $page;
            parent::__construct(array(
                'singular' => 'OrderList',     //singular name of the listed records
                'plural' => 'OrderList',   //plural name of the listed records
                'ajax' => false,        //does this table support ajax?=
            ));

            if (isset($_POST['s']) && !empty($_POST['s'])) {
                $this->search_key = sanitize_text_field($_POST['s']);
            }
        }

        public function no_items()
        {
            _e('No Products order found, sorry!', 'wk_wcps');
        }

        public function column_default($item, $column_name)
        {
            switch ($column_name) {
        case 'order_name':
        case 'order_date':
        case 'order_status':
        case 'order_total':
            return $item[$column_name];
        default:
            return print_r($item, true); //Show the whole array for troubleshooting purposes
    }
        }

        public function get_sortable_columns()
        {
            $sortable_columns = array(
        'order_name' => array('order_name', false),
        'order_date' => array('order_date', false),
        'order_status' => array('order_status', false),
        'order_total' => array('order_total', false),
    );

            return $sortable_columns;
        }

        public function get_columns()
        {
            $columns = array(
        'order_name' => esc_html__('Order', 'wk_wcps'),
        'order_date' => esc_html__('Date', 'wk_wcps'),
        'order_status' => esc_html__('Status', 'wk_wcps'),
        'order_total' => esc_html__('Total', 'wk_wcps'),
    );

            return $columns;
        }

        public function usort_reorder_data($a, $b)
        {
            // If no sort, default to title
            $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'order_name';
            // If no order, default to desc
            $order = (!empty($_GET['order'])) ? $_GET['order'] : 'desc';
            // Determine sort order
            $result = strcmp($a[$orderby], $b[$orderby]);
            // Send final sort direction to usort
            return ($order === 'asc') ? $result : -$result;
        }

        public function column_order_name($item)
        {
            $link = $item['id'];
            $actions = array(
        'edit' => sprintf('<a href='.esc_url(admin_url('post.php?post='.$link.'&action=edit')).'>'.esc_html__('Edit', 'wk_wcps').'</a>'),
    );

            return sprintf('%1$s %2$s', $item['order_name'], $this->row_actions($actions));
        }

        public function get_bulk_actions()
        {
        }

        public function process_bulk_action()
        {
        }

        public function get_hidden_columns()
        {
            return array();
        }

        public function column_cb($item)
        {
            // return sprintf(
    //     '<input type="checkbox" name="order_id[]" value="%s" />',
    //     $item['id']
    // );
        }

        private function fetch_order_details()
        {
            global $wpdb;
            $data = array();
            if (isset($this->search_key) && !empty($this->search_key)) {
                $orders = $wpdb->get_results("SELECT DISTINCT post.ID as order_id
                FROM wp_posts as post
                -- JOIN wp_postmeta as postmeta ON post.ID = postmeta.post_id
                JOIN wp_woocommerce_order_items AS orderitem ON post.ID = orderitem.order_id
                JOIN wp_woocommerce_order_itemmeta AS ordermeta ON orderitem.order_item_id = ordermeta.order_item_id
                JOIN wp_postmeta AS postmeta ON postmeta.post_id = ordermeta.meta_value
                WHERE post.post_type='shop_order'
                AND postmeta.meta_key = 'meta-prescription-post'
                AND postmeta.meta_value LIKE '%yes%'
                AND ordermeta.meta_key = '_product_id'
                AND post.ID = $this->search_key ");
            } else {
                $orders = $wpdb->get_results("SELECT DISTINCT post.ID as order_id
                FROM wp_posts as post
                -- JOIN wp_postmeta as postmeta ON post.ID = postmeta.post_id
                JOIN wp_woocommerce_order_items AS orderitem ON post.ID = orderitem.order_id
                JOIN wp_woocommerce_order_itemmeta AS ordermeta ON orderitem.order_item_id = ordermeta.order_item_id
                JOIN wp_postmeta AS postmeta ON postmeta.post_id = ordermeta.meta_value
                WHERE post.post_type='shop_order'
                AND postmeta.meta_key = 'meta-prescription-post'
                AND postmeta.meta_value LIKE '%yes%'
                AND ordermeta.meta_key = '_product_id'
                ORDER BY order_id desc");
            }

            $i = 0;
            if (!empty($orders)) {
                foreach ($orders as $key => $value) {
                    $order = wc_get_order($value->order_id);
                    $data[$i]['id'] = $value->order_id;
                    $this->order_link[$i] = $value->order_id;
                    $data[$i]['order_name'] = '<a href="'.esc_url(admin_url('post.php?post='.$value->order_id.'&action=edit')).'"><strong>#'.esc_html($value->order_id).' '.esc_html($order->get_billing_first_name()).' '.esc_html($order->get_billing_last_name()).'</strong></a>';
                    $data[$i]['order_status'] = '<mark class="order-status '.esc_attr(sanitize_html_class('status-'.$order->get_status())).'"><span>'.esc_html(wc_get_order_status_name($order->get_status())).'</span></mark>';
                    $data[$i]['order_total'] = $order->get_formatted_order_total();
                    $data[$i]['order_date'] = $order->get_date_created()->date_i18n(apply_filters('woocommerce_admin_order_date_format', __('M j, Y', 'wk_wcps')));
                    ++$i;
                }
            }

            return $data;
        }

        public function prepare_items()
        {
            $columns = $this->get_columns();
            $hidden = $this->get_hidden_columns();
            $sortable = $this->get_sortable_columns();
            $this->process_bulk_action();
            $this->_column_headers = array($columns);
            $temp_prepare_data = $this->fetch_order_details();
            if (!is_null($temp_prepare_data)) {
                // usort($temp_prepare_data, array($this, 'usort_reorder_data'));
                $per_page = $this->get_items_per_page('product_per_page', 10);
                $current_page = $this->get_pagenum();
                $total_items = count($temp_prepare_data);
                // only ncessary because we have sample temp_prepare_data
                $found_data = array_slice($temp_prepare_data, (($current_page - 1) * $per_page), $per_page);
                $this->set_pagination_args(array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page' => $per_page,                     //WE have to determine how many items to show on a page
        ));
                $this->items = $found_data;
            }
        }
    }
}
