<?php

add_action( 'plugins_loaded', 'DR_DSCF7_load_textdomain' );
function DR_DSCF7_load_textdomain() {
    load_plugin_textdomain( 'dr-digital-signature-cf7', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

function DR_DSCF7_load_my_own_textdomain( $mofile, $domain ) {
    if ( 'dr-digital-signature-cf7' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
        $mofile = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}
add_filter( 'load_textdomain_mofile', 'DR_DSCF7_load_my_own_textdomain', 10, 2 );
