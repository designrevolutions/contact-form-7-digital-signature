<?php
/**
 * Plugin Name: Digital Signature For Contact Form 7
 * Description: Adds a digital signature field to Contact Form 7 forms.
 * Version: 1.0
 * Author: Design Revolutions
 * Author URI: https://www.designrevolutions.com
 * Plugin URI: https://www.designrevolutions.com
 * Copyright: 2024 Design Revolutions
 * Text Domain: dr-digital-signature-cf7
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

define( 'DR_DSCF7_BASE_NAME', plugin_basename( __FILE__ ) );
define( 'DR_DSCF7_PLUGIN_FILE', __FILE__ );
define( 'DR_DSCF7_PLUGIN_DIR', plugins_url( '', __FILE__ ) );

include_once( 'main/backend/digital-signature-backend-cf7.php' );
include_once( 'main/resources/digital-signature-installation-require.php' );
include_once( 'main/resources/digital-signature-language.php' );
include_once( 'main/resources/digital-signature-load-js-css.php' );

function DR_DSCF7_support_and_rating_links( $links_array, $plugin_file_name, $plugin_data, $status ) {
    if ( $plugin_file_name !== plugin_basename( __FILE__ ) ) {
        return $links_array;
    }
    $links_array[] = '<a href="https://www.designrevolutions.com/support/">' . __( 'Support', 'dr-digital-signature-cf7' ) . '</a>';
    return $links_array;
}
add_filter( 'plugin_row_meta', 'DR_DSCF7_support_and_rating_links', 10, 4 );
