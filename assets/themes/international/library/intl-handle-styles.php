<?php
/**
 *
 * Register and enqueue stylesheets
 *
 */
add_action( 'wp_enqueue_scripts', 'intl_handle_styles' );
function intl_handle_styles() {

  // Register stylesheet
  wp_register_style(
    'international', // handle
    get_stylesheet_directory_uri() . '/css/international.css', // src
    '', // deps
    '0.1' // version
  );

  // Register jQuery UI stylesheet
  wp_register_style(
    'jquery-ui',
    get_stylesheet_directory_uri() . '/css/jquery-ui/jquery-ui-1.8.17.custom.css',
    'international'
  );

  /**
   * Enqueue needed styles
   */

  wp_enqueue_style( 'international' );
  wp_enqueue_style( 'jquery-ui' );

}
?>
