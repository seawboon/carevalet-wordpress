<?php
/**
 * @author Webkul
 *
 * @version 1.0.0
 * This template shows product list.
 */

namespace WpPrescription\Templates\Admin;

use WP_List_Table;
use WP_Query;

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('PrescriptionProductList')) {
    class PrescriptionProductList extends WP_List_Table
    {
        public $product_link = array();
        public $post_ids = array();
        public $search_key = '';

        public function __construct()
        {
            global $status, $page;
            parent::__construct(array(
                'singular' => 'ProductList',     //singular name of the listed records
                'plural' => 'ProductLists',   //plural name of the listed records
                'ajax' => false,        //does this table support ajax?=
            ));
            ob_start();
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
        case 'product_name':
        case 'product_image':
        case 'sku':
        case 'product_stock':
        case 'product_price':
        case 'product_category':
        case 'product_tag':
        case 'product_date':
        case 'product_prescription':
            return $item[$column_name];
        default:
            return print_r($item, true); //Show the whole array for troubleshooting purposes
    }
        }

        public function get_sortable_columns()
        {
            $sortable_columns = array(
        'product_name' => array('product_name', false),
        'product_stock' => array('product_stock', false),
        'product_price' => array('product_price', false),
        'product_category' => array('product_category', false),
        'product_date' => array('product_date', false),
        'product_prescription' => array('product_prescription', false),
    );

            return $sortable_columns;
        }

        public function get_columns()
        {
            $columns = array(
        'cb' => "<input type='hidden'/>",
        'product_name' => esc_html__('Product Name', 'wk_wcps'),
        'product_image' => esc_html__('Product Image', 'wk_wcps'),
        'sku' => esc_html__('SKU', 'wk_wcps'),
        'product_stock' => esc_html__('Product Stock', 'wk_wcps'),
        'product_price' => esc_html__('Product Price', 'wk_wcps'),
        'product_category' => esc_html__('Product Category', 'wk_wcps'),
        'product_tag' => esc_html__('Product Tag', 'wk_wcps'),
        'product_date' => esc_html__('Product Date', 'wk_wcps'),
        'product_prescription' => esc_html__('Product Prescription', 'wk_wcps'),
    );

            return $columns;
        }

        public function usort_reorder_data($a, $b)
        {
            // If no sort, default to title
            $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'product_name';
            // If no order, default to desc
            $order = (!empty($_GET['order'])) ? $_GET['order'] : 'desc';
            // Determine sort order
            $result = strcmp($a[$orderby], $b[$orderby]);
            // Send final sort direction to usort
            return ($order === 'asc') ? $result : -$result;
        }

        public function column_product_name($item)
        {
            $link = get_edit_post_link($item['id']);

            $actions = array(
        'edit' => sprintf('<a href='.esc_url($link).'>'.esc_html__('Edit', 'wk_wcps').'</a>'),
    );

            return sprintf('%1$s %2$s', $item['product_name'], $this->row_actions($actions));
        }

        // edit.php?post_type=product
        public function get_bulk_actions()
        {
            $actions = array(
        'enable' => esc_html__('Enable Prescription', 'wk_wcps'),
        'disable' => esc_html__('Disable Prescription', 'wk_wcps'),
    );

            return $actions;
        }

        public function process_bulk_action()
        {
            if ($this->current_action() == 'disable') {
                $this->fetch_product_details();
                if (isset($_POST['product_id']) && is_array($_POST['product_id'])) {
                    foreach ($_POST['product_id'] as $value) {
                        update_post_meta($value, 'meta-prescription-post', 'no');
                    }
                    wp_redirect($_SERVER['HTTP_REFERER']); ?>
                <div id="message" class="updated notice is-dismissible">
                    <p><?php echo count($_POST['product_id']);
                    echo esc_html__('Disabled Prescription.', 'wk_wcps'); ?>
                </div>
            <?php
                }
            } elseif ($this->current_action() == 'enable') {
                $this->fetch_product_details();
                if (isset($_POST['product_id']) && is_array($_POST['product_id'])) {
                    foreach ($_POST['product_id'] as $value) {
                        update_post_meta($value, 'meta-prescription-post', 'yes');
                    }
                    wp_redirect($_SERVER['HTTP_REFERER']); ?>
                <div id="message" class="updated notice is-dismissible">
                    <p><?php echo count($_POST['product_id']);
                    echo esc_html__('Enabled Prescription.', 'wk_wcps'); ?> 
                </div>
            <?php
                }
            }
        }

        public function get_hidden_columns()
        {
            return array();
        }

        public function column_cb($item)
        {
            return sprintf(
        '<input type="checkbox" name="product_id[]" value="%s" />',
        $item['id']
    );
        }

        public function column_client_platform($item)
        {
            return sprintf(
        '<span style="display:block; text-transform: uppercase;">'.$item['product_image'].'</span><img style="height:30px; width: 30px;" src="'.esc_url(WC_PRESCRIPTION_DIR_FILE.'assets/images/'.$item['product_image'].'.png').'>'
    );
        }

        public $review_data = array();

        private function fetch_product_details()
        {
            global $wpdb;
            $product_order = array();
            if (isset($this->search_key) && !empty($this->search_key)) {
                $keys = $this->search_key;
                $args = array(
            'post_type' => array('product'),
            'post_status' => 'publish',
            'posts_per_page' => -1,
            's' => $keys,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => '_virtual',
                    'value' => 'no',
                    'compare' => 'LIKE',
                ),
                array(
                    'key' => '_downloadable',
                    'value' => 'no',
                    'compare' => 'LIKE',
                ),
            ),
        );
            } else {
                $args = array(
            'post_type' => array('product'),
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => '_virtual',
                    'value' => 'no',
                    'compare' => 'LIKE',
                ),
                array(
                    'key' => '_downloadable',
                    'value' => 'no',
                    'compare' => 'LIKE',
                ),
            ),
        );
            }

            $query = new WP_Query($args);
            $product_set = $query->posts;

            foreach ($product_set as $key => $value) {
                $value = json_decode(json_encode($value), true);
                $products[] = $value;
            }
            if (!empty($products)) {
                foreach ($products as $key => $value) {
                    $_product = wc_get_product($value['ID']);

                    if ($_product->get_type() == 'simple' || $_product->get_type() == 'variable') {
                        $product_name = $_product->get_name();
                        $product_sku = $_product->get_sku();
                        if ($_product->is_on_backorder()) {
                            $stock_html = '<mark class="onbackorder">'.__('On backorder', 'wk_wcps').'</mark>';
                        } elseif ($_product->is_in_stock()) {
                            $stock_html = '<mark class="instock">'.__('In stock', 'wk_wcps').'</mark>';
                        } else {
                            $stock_html = '<mark class="outofstock">'.__('Out of stock', 'wk_wcps').'</mark>';
                        }

                        if ($_product->managing_stock()) {
                            $stock_html .= ' ('.wc_stock_amount($_product->get_stock_quantity()).')';
                        }

                        $product_stock = wp_kses_post(apply_filters('woocommerce_admin_stock_html', $stock_html, $_product));
                        $woo_cat = '';
                        $terms = get_the_terms($value['ID'], 'product_cat');
                        $pro_link_cat = '';
                        foreach ($terms as $key_t => $value_t) {
                            $value_t = json_decode(json_encode($value_t), true);
                            $woo_cat_name = $value_t['name'];
                            if ($key_t <= 0) {
                                $pro_link_cat = '<a href="'.esc_url(admin_url('edit.php?product_cat='.$value_t['slug'].'&post_type=product')).' ">'.esc_html($woo_cat_name).'</a>';
                            } else {
                                $pro_link_cat = $pro_link_cat.', '.'<a href="'.esc_url(admin_url('edit.php?product_cat='.$value_t['slug'].'&post_type=product')).' ">'.esc_html($woo_cat_name).'</a>';
                            }
                        }

                        $product_tags = '';
                        $terms = get_the_terms($value['ID'], 'product_tag');
                        if (!$terms) {
                            // echo '<span class="na">&ndash;</span>';
                        } else {
                            foreach ($terms as $key_term => $term) {
                                if ($key_term <= 0) {
                                    $product_tags = '<a href="'.esc_url(admin_url('edit.php?product_tag='.$term->slug.'&post_type=product')).' ">'.esc_html($term->name).'</a>';
                                } else {
                                    $product_tags = $product_tags.', '.'<a href="'.esc_url(admin_url('edit.php?product_tag='.$term->slug.'&post_type=product')).' ">'.esc_html($term->name).'</a>';
                                }
                            }
                        }

                        $product_prescription = get_post_meta($value['ID'], 'meta-prescription-post', true);

                        $product_prescription = sanitize_text_field($product_prescription);
                        if (!isset($product_prescription) || empty($product_prescription)) {
                            $product_prescription = 'no';
                        }
                        if (isset($product_prescription) && !empty($product_prescription) && ($product_prescription == 'yes')) {
                            $display_prescribed = esc_html__('Enabled', 'wk_wcps');
                        } else {
                            $display_prescribed = esc_html__('Disabled', 'wk_wcps');
                        }

                        $product_date = $_product->get_date_created();
                        $product_date = explode('T', $product_date);
                        $product_date = $product_date[0];
                        $this->product_link[] = get_edit_post_link($value['ID']);
                        $this->post_ids[] = intval($value['ID']);
                        $product_price = wp_kses_post($_product->get_price_html());
                        $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($value['ID']), 'single-post-thumbnail');
                        $up = wp_upload_dir();
                        $product_image = $product_image[0];
                        if (empty($product_image) && !is_array($product_image)) {
                            $product_image = WC_PRESCRIPTION_PLUGIN.'assets/images/placeholder.png';
                        }
                        $this->review_data[] = array(
                                                'id' => $value['ID'],
                                                'product_name' => esc_html($product_name),
                                                'product_image' => '<img style="width:80px; height:80px;" src='.$product_image.'>',
                                                'product_price' => $product_price,
                                                'sku' => esc_html($product_sku),
                                                'product_stock' => $product_stock,
                                                'product_category' => $pro_link_cat,
                                                'product_tag' => $product_tags,
                                                'product_prescription' => $display_prescribed,
                                                'product_date' => $product_date,
                                            );
                    }
                }

                return $this->review_data;
            }
        }

        public function prepare_items()
        {
            $columns = $this->get_columns();
            $hidden = $this->get_hidden_columns();
            $sortable = $this->get_sortable_columns();
            $this->process_bulk_action();
            $this->_column_headers = array($columns);
            $temp_prepare_data = $this->fetch_product_details();
            if (!is_null($temp_prepare_data)) {
                usort($temp_prepare_data, array($this, 'usort_reorder_data'));
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
