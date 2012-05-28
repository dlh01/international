<?php
/*
Plugin name: .Roots Cleanup Search
Description: Redirects search results from /?s=query to /search/query/, converts %20 to +; Fix for get_search_query() returning +'s between search terms; Fix for empty search queries redirecting to home page
Author: Ben Word / Roots Theme
Plugin URI: https://github.com/retlehs/roots/blob/master/inc/cleanup.php
*/


/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 */
function roots_nice_search_redirect() {
  if (is_search() && strpos($_SERVER['REQUEST_URI'], '/wp-admin/') === false && strpos($_SERVER['REQUEST_URI'], '/search/') === false) {
    wp_redirect(home_url('/search/' . str_replace(array(' ', '%20'), array('+', '+'), urlencode(get_query_var('s')))), 301);
    exit();
  }
}

add_action('template_redirect', 'roots_nice_search_redirect');

/**
 * Fix for get_search_query() returning +'s between search terms
 */
function roots_search_query($escaped = true) {
  $query = apply_filters('roots_search_query', get_query_var('s'));

  if ($escaped) {
    $query = esc_attr($query);
  }

  return urldecode($query);
}

add_filter('get_search_query', 'roots_search_query');

/**
 * Fix for empty search queries redirecting to home page
 *
 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * @link http://core.trac.wordpress.org/ticket/11330
 */
function roots_request_filter($query_vars) {
  if (isset($_GET['s']) && empty($_GET['s'])) {
    $query_vars['s'] = ' ';
  }

  return $query_vars;
}

add_filter('request', 'roots_request_filter');
?>
