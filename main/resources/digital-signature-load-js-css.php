<?php

add_action( 'wp_enqueue_scripts', 'DR_DSCF7_load_script_style' );
function DR_DSCF7_load_script_style() {
    wp_enqueue_script( 'DR-DSCF7-sign-pad', DR_DSCF7_PLUGIN_DIR . '/assets/js/digital_signature_pad.js', array(), '1.0.0', true );
    wp_enqueue_script( 'DR-DSCF7-front-js', DR_DSCF7_PLUGIN_DIR . '/assets/js/front.js', array( 'jquery', 'DR-DSCF7-sign-pad' ), '1.0.0', true );
    wp_enqueue_style( 'DR-DSCF7-front-css', DR_DSCF7_PLUGIN_DIR . '/assets/css/front.css', array(), '1.0.0' );
}

add_action( 'admin_enqueue_scripts', 'DR_DSCF7_load_script_style_admin' );
function DR_DSCF7_load_script_style_admin() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker-alpha', DR_DSCF7_PLUGIN_DIR . '/assets/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '1.0.0', true );
}
