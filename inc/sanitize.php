<?php
/**
 * Sanitizer for news24 theme.
 *
 * @package     News24
 * @author      Mehraz Morshed
 * @copyright   Copyright (c) 2020, Mehraz Morshed
 * @link        https://mehrazmorshed.com
 * @since       news24 1.0
 */

function news24_sanitize_text( $input ) {
    return sanitize_text_field( $input );
}

function news24_sanitize_checkbox( $input ) {
    return ( isset( $input ) && true == $input ) ? true : false;
}

function news24_sanitize_select( $input, $setting ) {
    $input = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
?>