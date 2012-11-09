<?php
/**
 *
 * Register and enqueue stylesheets
 *
 */
add_action( 'wp_enqueue_scripts', 'intl_handle_styles' );
function intl_handle_styles() {

  // Register twentyeleven stylesheet
  wp_register_style(
    'twentyeleven',
    get_template_directory_uri() . '/style.css'
  );

  // Register stylesheet
  wp_register_style(
    'international', // handle
    get_stylesheet_directory_uri() . '/css/international.css', // src
    'twentyeleven', // deps
    '1.7.3' // version
  );

  // Register FontAwesome stylesheet
  wp_register_style(
    'fontawesome',
    get_stylesheet_directory_uri() . '/fontawesome/css/font-awesome.css',
    'international' // deps
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

  wp_enqueue_style( 'twentyeleven' );
  wp_enqueue_style( 'international' );
  wp_enqueue_style( 'fontawesome' );
  wp_enqueue_style( 'jquery-ui' );

}
?>
