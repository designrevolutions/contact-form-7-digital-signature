<?php

add_action( 'admin_init', 'DR_DSCF7_load_plugin', 11 );
function DR_DSCF7_load_plugin() {
    if ( ! is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
        set_transient( get_current_user_id() . 'dr_dscf7_error', 'message' );
    }
}

add_action( 'admin_notices', 'DR_DSCF7_install_error' );
function DR_DSCF7_install_error() {
    if ( get_transient( get_current_user_id() . 'dr_dscf7_error' ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        delete_transient( get_current_user_id() . 'dr_dscf7_error' );
        echo '<div class="error"><p>DR Digital Signature has been deactivated because it requires the <a href="plugin-install.php?tab=search&s=contact+form+7">Contact Form 7</a> plugin to be installed and activated.</p></div>';
    }
}
