<?php
/**
 * @author Webkul
 *
 * @version 1.0.0
 * This file handles all file includes.
 */
 use WpPrescription\Includes\Front;
 use WpPrescription\Includes\Admin;

 if (!defined('ABSPATH')) {
     exit;
 }

require_once WC_PRESCRIPTION_DIR_FILE.'inc/autoload.php';

if (!is_admin()) {
    new Front\PrescriptionFrontHookHandler();
} else {
    new Admin\PrescriptionAdminHookHandler();
}
