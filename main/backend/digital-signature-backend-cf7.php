<?php

/**
 * Base module for [digital_signature] form tags.
 * Developed by Design Revolutions — https://www.designrevolutions.com
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'wpcf7_init', 'DR_DSCF7_add_form_tag_signature', 10, 0 );
function DR_DSCF7_add_form_tag_signature() {
    wpcf7_add_form_tag( array( 'signature', 'signature*' ), 'DR_DSCF7_signature_form_tag_handler', array( 'name-attr' => true ) );
}


add_action( 'wpcf7_admin_init', 'DR_DSCF7_add_tag_generator_signature', 18, 0 );
function DR_DSCF7_add_tag_generator_signature() {
    $tag_generator = WPCF7_TagGenerator::get_instance();
    $tag_generator->add( 'signature', __( 'digital_signature', 'dr-digital-signature-cf7' ), 'DR_DSCF7_tag_generator_signature', array( 'version' => 2 ) );
}


function DR_DSCF7_signature_form_tag_handler( $tag ) {
    if ( empty( $tag->name ) ) {
        return '';
    }

    $validation_error = wpcf7_get_validation_error( $tag->name );

    $class  = wpcf7_form_controls_class( $tag->type );
    $class .= ' wpcf7-validates-as-signature ';

    $atts          = array();
    $atts['class'] = $tag->get_class_option( $class );
    $atts['id']    = $tag->get_id_option();

    $value = (string) reset( $tag->values );

    if ( $tag->has_option( 'placeholder' ) || $tag->has_option( 'watermark' ) ) {
        $atts['placeholder'] = $value;
        $value = '';
    }

    $value = $tag->get_default_option( $value );
    $value = wpcf7_get_hangover( $tag->name, $value );

    $atts['class'] .= ' dscf7-signature ';
    $atts['value']  = $value;
    $atts['type']   = 'hidden';
    $atts['name']   = $tag->name;
    $atts           = wpcf7_format_atts( $atts );

    $attsa['color']    = ! empty( $tag->get_option( 'color' )[0] )     ? $tag->get_option( 'color' )[0]     : '#000000';
    $attsa['backcolor'] = ! empty( $tag->get_option( 'backcolor' )[0] ) ? $tag->get_option( 'backcolor' )[0] : '#dddddd';
    $attsa['width']    = ! empty( $tag->get_option( 'width' )[0] )     ? intval( $tag->get_option( 'width' )[0] )  : 300;
    $attsa['height']   = ! empty( $tag->get_option( 'height' )[0] )    ? intval( $tag->get_option( 'height' )[0] ) : 200;
    $attsa             = wpcf7_format_atts( $attsa );

    $atts_attach          = array();
    $atts_attach['value'] = $tag->has_option( 'attachment' );
    $atts_attach['type']  = 'hidden';
    $atts_attach['name']  = $tag->name . '-attachment';
    $atts_attach          = wpcf7_format_atts( $atts_attach );

    $atts_inline          = array();
    $atts_inline['value'] = $tag->has_option( 'inline' );
    $atts_inline['type']  = 'hidden';
    $atts_inline['name']  = $tag->name . '-inline';
    $atts_inline          = wpcf7_format_atts( $atts_inline );

    $html = sprintf(
        '<div class="dscf7_signature">
            <div class="dscf7_signature_inner">
                <canvas id="digital_signature-pad_%1$s" name="%1$s" class="digital_signature-pad" %4$s></canvas>
                <input class="clearButton" type="button" value="+">
            </div>
            <span class="wpcf7-form-control-wrap %1$s" data-name="' . $tag->name . '">
                <input %2$s/>
                <input %5$s class="wpcf7_input_%1$s_attachment"/>
                <input %6$s class="wpcf7_input_%1$s_inline"/>%3$s
            </span>
        </div>',
        sanitize_html_class( $tag->name ),
        $atts,
        $validation_error,
        $attsa,
        $atts_attach,
        $atts_inline
    );

    return $html;
}


function DR_DSCF7_tag_generator_signature( $contact_form, $args = '' ) {
    $args        = wp_parse_args( $args, array() );
    $description = __( 'Generate a form-tag for a signature field.', 'dr-digital-signature-cf7' );
    ?>
    <header class="description-box">
        <h3><?php esc_html_e( 'Signature form tag generator', 'dr-digital-signature-cf7' ); ?></h3>
        <p><?php echo esc_html( $description ); ?></p>
    </header>
    <div class="control-box">
        <fieldset>
            <legend><?php esc_html_e( 'Field type', 'dr-digital-signature-cf7' ); ?></legend>
            <input type="hidden" data-tag-part="basetype" value="signature">
            <label>
                <input type="checkbox" data-tag-part="type-suffix" value="*">
                <?php esc_html_e( 'This is a required field.', 'dr-digital-signature-cf7' ); ?>
            </label>
        </fieldset>

        <fieldset>
            <legend><?php esc_html_e( 'Name', 'dr-digital-signature-cf7' ); ?></legend>
            <input type="text" data-tag-part="name" pattern="[A-Za-z][A-Za-z0-9_\-]*">
        </fieldset>

        <fieldset>
            <legend><?php esc_html_e( 'Pen Color', 'dr-digital-signature-cf7' ); ?></legend>
            <input type="color" data-tag-part="option" data-tag-option="color:" value="#000000">
        </fieldset>

        <fieldset>
            <legend><?php esc_html_e( 'Background Color', 'dr-digital-signature-cf7' ); ?></legend>
            <input type="color" data-tag-part="option" data-tag-option="backcolor:" value="#dddddd">
        </fieldset>

        <fieldset>
            <legend><?php esc_html_e( 'Width (px)', 'dr-digital-signature-cf7' ); ?></legend>
            <input type="number" data-tag-part="option" data-tag-option="width:" value="300" min="100" max="1200">
        </fieldset>

        <fieldset>
            <legend><?php esc_html_e( 'Height (px)', 'dr-digital-signature-cf7' ); ?></legend>
            <input type="number" data-tag-part="option" data-tag-option="height:" value="200" min="50" max="800">
        </fieldset>

        <fieldset>
            <legend><?php esc_html_e( 'Id', 'dr-digital-signature-cf7' ); ?></legend>
            <input type="text" data-tag-part="option" data-tag-option="id:" value="">
        </fieldset>

        <fieldset>
            <legend><?php esc_html_e( 'Class', 'dr-digital-signature-cf7' ); ?></legend>
            <input type="text" data-tag-part="option" data-tag-option="class:" value="" pattern="[A-Za-z0-9_\-\s]*">
        </fieldset>
    </div>
    <div class="insert-box">
        <div class="flex-container">
            <input type="text" class="code" readonly="readonly" onfocus="this.select();" data-tag-part="tag">
            <div class="submitbox">
                <input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'dr-digital-signature-cf7' ) ); ?>">
            </div>
        </div>
        <p class="mail-tag-tip">
            <label for="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>">
                <?php echo sprintf(
                    esc_html( __( 'To use the value input through this field in a mail field, you need to insert the corresponding mail-tag (%s) into the field on the Mail tab.', 'dr-digital-signature-cf7' ) ),
                    '<strong><span class="mail-tag"></span></strong>'
                ); ?>
            </label>
        </p>
    </div>
    <?php
}


add_filter( 'wpcf7_posted_data', 'DR_DSCF7_manage_signature_data' );
function DR_DSCF7_manage_signature_data( $posted_data ) {
    foreach ( $posted_data as $key => $data ) {
        if ( is_string( $data ) && strrpos( $data, 'data:image/png;base64', -strlen( $data ) ) !== false ) {
            $data_pieces    = explode( ',', $data );
            $decoded_image  = base64_decode( $data_pieces[1] );
            $filename       = sanitize_file_name( wpcf7_canonicalize( $key . '-' . time() . '.png' ) );
            $signature_dir  = trailingslashit( DR_DSCF7_signature_dir() );

            if ( empty( $posted_data[ $key . '-attachment' ] ) ) {
                wpcf7_init_uploads();
                $uploads_dir = wpcf7_upload_tmp_dir();
                $uploads_dir = wpcf7_maybe_add_random_dir( $uploads_dir );
                $filename    = wp_unique_filename( $uploads_dir, $filename );
                $filepath    = trailingslashit( $uploads_dir ) . $filename;

                if ( $handle = @fopen( $filepath, 'w' ) ) {
                    fwrite( $handle, $decoded_image );
                    fclose( $handle );
                    @chmod( $filepath, 0400 );
                }

                if ( file_exists( $filepath ) ) {
                    $posted_data[ $key . '-attachment' ] = $filepath;
                } else {
                    error_log( 'DR Digital Signature: cannot create attachment — ' . $filepath );
                }

                if ( ! file_exists( $signature_dir ) && wp_mkdir_p( $signature_dir ) ) {
                    $htaccess = $signature_dir . '.htaccess';
                    if ( ! file_exists( $htaccess ) && $handle = @fopen( $htaccess, 'w' ) ) {
                        fwrite( $handle, 'Order deny,allow' . "\n" );
                        fwrite( $handle, 'Deny from all' . "\n" );
                        fwrite( $handle, '<Files ~ "^[0-9A-Za-z_-]+\\.(png)$">' . "\n" );
                        fwrite( $handle, '    Allow from all' . "\n" );
                        fwrite( $handle, '</Files>' . "\n" );
                        fclose( $handle );
                    }
                }

                $filepath = wp_normalize_path( $signature_dir . $filename );

                if ( $handle = @fopen( $filepath, 'w' ) ) {
                    fwrite( $handle, $decoded_image );
                    fclose( $handle );
                    @chmod( $filepath, 0644 );
                }

                if ( file_exists( $filepath ) ) {
                    $posted_data[ $key ] = DR_DSCF7_signature_url( $filename );
                } else {
                    error_log( 'DR Digital Signature: cannot save signature file — ' . $filepath );
                }
            }
        }
    }
    return $posted_data;
}


add_filter( 'wpcf7_validate_signature',  'DR_DSCF7_signature_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_signature*', 'DR_DSCF7_signature_validation_filter', 10, 2 );
function DR_DSCF7_signature_validation_filter( $result, $tag ) {
    $raw   = isset( $_POST[ $tag->name ] ) ? sanitize_text_field( $_POST[ $tag->name ] ) : '';
    $value = trim( strtr( (string) $raw, "\n", ' ' ) );

    if ( 'signature' === $tag->basetype && $tag->is_required() && '' === $value ) {
        $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
    }

    return $result;
}


function DR_DSCF7_signature_dir() {
    return wpcf7_upload_dir( 'dir' ) . '/dscf7_signatures';
}

function DR_DSCF7_signature_url( $filename ) {
    return wpcf7_upload_dir( 'url' ) . '/dscf7_signatures/' . $filename;
}
