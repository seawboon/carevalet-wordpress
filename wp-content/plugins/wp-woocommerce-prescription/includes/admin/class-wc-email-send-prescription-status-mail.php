<?php
/**
 * Prescription Status Class.
 *
 * @version
 */
defined('ABSPATH') || exit;

if (!class_exists('WC_EMAIL_Send_Prescription_Status_Mail')) :
    /**
     * Quotation Notification.
     */
    class WC_EMAIL_Send_Prescription_Status_Mail extends WC_Email
    {
        /**
         * Constructor.
         */
        public function __construct()
        {
            $this->id = 'wcmp_prescription_status_mail';
            $this->customer_email = false;
            $this->title = esc_html__('Prescription Status', 'wk_wcps');
            $this->description = esc_html__('Prescription status emails are sent to customer.', 'wk_wcps');
            $this->heading = esc_html__('WC Prescription Status', 'wk_wcps');
            $this->subject = '['.get_option('blogname').'] '.esc_html__('WC Prescription Status', 'wk_wcps');
            $this->template_html = 'emails/woocommerce-prescription-status.php';
            $this->template_plain = '';
            $this->footer = esc_html__('Thank You.', 'wk_wcps');
            $this->template_base = plugin_dir_path(__FILE__).'woocommerce/templates/';

            add_action('wcp_send_prescription_status_notification', array($this, 'trigger'), 10, 1);

            parent::__construct();
            $this->recipient = 'customer@example.com';
        }

        /**
         * Trigger.
         *
         * @param array $data quotation Data
         */
        public function trigger($data)
        {
            $this->data = $data;
            $this->recipient = $data['email'];

            if (!$this->is_enabled() || !$this->get_recipient()) {
                return;
            }

            $this->send(
                $this->get_recipient(),
                $this->get_subject(),
                $this->get_content(),
                $this->get_headers(),
                $this->get_attachments()
            );
        }

        /**
         * Get content html.
         *
         * @return string
         */
        public function get_content_html()
        {
            return wc_get_template_html(
                $this->template_html,
                array(
                    'data' => $this->data,
                    'email_heading' => $this->get_heading(),
                    'sent_to_admin' => false,
                    'plain_text' => false,
                    'email' => $this,
                ),
                '',
                $this->template_base
            );
        }

        /**
         * Get content plain.
         *
         * @return string
         */
        public function get_content_plain()
        {
            return wc_get_template_html(
                $this->template_plain,
                array(
                    'data' => $this->data,
                    'email_heading' => $this->get_heading(),
                    'sent_to_admin' => false,
                    'plain_text' => true,
                    'email' => $this,
                ),
                '',
                $this->template_base
            );
        }

        /**
         * Email type options.
         *
         * @return array
         */
        public function get_email_type_options()
        {
            $types = [];

            if (class_exists('DOMDocument')) {
                $types['html'] = esc_html__('HTML', 'wk_wcps');
            }

            return $types;
        }
    }

endif;

return new WC_EMAIL_Send_Prescription_Status_Mail();
