<?php
/**
 * @author Webkul
 *
 * @version 1.0.0
 * This template shows product list.
 */

namespace WpPrescription\Templates\Admin;

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('PrescriptionSettings')) {
    class PrescriptionSettings
    {
        public function __construct()
        {
            $this->init();
        }

        public function init()
        {
            ?>
                <h3><?php esc_html_e('WooCommerce Prescription Settings', 'wk_wcps'); ?></h3>
                <?php settings_errors(); ?>
                <form method="post" action="options.php" id="prescription_settings_form">
                <?php settings_fields('prescription-settings-group'); ?>
                <?php do_settings_sections('prescription-settings-group'); ?>
                <table width="1000" class="prescription-setting" cellspacing="20">

                    <tr>
                      <th width="250" scope="row"><?php esc_html_e('Heading', 'wk_wcps'); ?></th>
                       <td width="500">
                        <input name="prescription_heading" type="text" id="prescription_heading" value="<?php echo esc_attr(get_option('prescription_heading')); ?>" required /><span class="error-prescription" id="heading-error"></span>
                       </td>
                     </tr>
                     <tr>
                      <th width="250" scope="row"><?php esc_html_e('Prescription Content', 'wk_wcps'); ?></th>
                       <td width="500">
                         <textarea required name="prescription_content" rows="4" cols="80"  id="prescription_content"><?php echo esc_attr(get_option('prescription_content')); ?></textarea><span class="error-prescription" id="content-error"></span>
                       </td>
                     </tr>
                     <tr>

                   </table>
                   <p>
                    <?php  submit_button(); ?>
                   </p>
                 </form>
            <?php
        }
    }
}
