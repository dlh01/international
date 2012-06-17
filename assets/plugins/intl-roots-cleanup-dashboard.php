<?php
/*
Plugin name: INTL Roots Cleanup Dashboard
Description: Remove unnecessary dashboard widgets
Author: Ben Word / Roots Theme
Plugin URI: https://github.com/retlehs/roots/blob/master/inc/cleanup.php
*/

/**
 * Remove unnecessary dashboard widgets
 *
 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 */
function roots_remove_dashboard_widgets() {
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'normal');
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
}

add_action('admin_init', 'roots_remove_dashboard_widgets');

?>
