<?php
/**
 * Dynamically loads classes.
 */
if (!defined('ABSPATH')) {
    exit;
}

spl_autoload_register('wkwp_namespace_class_autoload');

/**
 * @param string $class_name the name of the class to load
 */
function wkwp_namespace_class_autoload($class_name)
{
    if (false === strpos($class_name, 'WpPrescription')) {
        return;
    }

    $file_parts = explode('\\', $class_name);

    $namespace = '';

    for ($i = count($file_parts) - 1; $i > 0; --$i) {
        $current = '';
        $pieces = str_split($file_parts[$i]);
        foreach ($pieces as $key => $value) {
            if ($i == count($file_parts) - 1) {
                if ($key != 0) {
                    if (ctype_upper($value)) {
                        $value = '-'.strtolower($value);
                    }
                } else {
                    $value = strtolower($value);
                }
            } else {
                if (ctype_upper($value)) {
                    $value = strtolower($value);
                }
            }
            $current .= $value;
        }
        if (strtolower($file_parts[$i]) == $current) {
        }
        if (count($file_parts) - 1 == $i) {
            $file_name = "class-$current.php";
        } else {
            $namespace = $current.'/'.$namespace;
        }

        $filepath = WC_PRESCRIPTION_DIR_FILE.$namespace;
        $filepath .= $file_name;
    }

    // If the file exists in the specified path, then include it.
    if (file_exists($filepath)) {
        include_once $filepath;
    } else {
        wp_die(
            esc_html('The file attempting to be loaded at', 'wk_wcps').esc_html($filepath).esc_html__('does not exist.', 'wk_wcps')
        );
    }
}
