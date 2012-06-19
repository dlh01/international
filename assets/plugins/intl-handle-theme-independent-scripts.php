<?php
/*
Plugin name: INTL Handle Theme-Independent Scripts
Description: Register and enqueue theme-independent scripts
*/

add_action( 'wp_enqueue_scripts', 'intl_handle_independent_scripts' );
function intl_handle_independent_scripts () {

  /* Google Translate */
  wp_register_script(
    'google-translate', // handle
    'http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', // source
    '', // deps
    '', // version
    'true' // in footer
  );

  wp_enqueue_script( 'google-translate' );
}
