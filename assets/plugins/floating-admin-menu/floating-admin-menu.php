<?php
/*
Plugin Name: Floating Admin Menu
Plugin URI: http://tillkruess.com/project/floating-admin-menu/
Description: Stop scrolling, save time! Have the admin menu stay in place, no matter how long the page may be and you happen to have scrolled.
Version: 1.0.4
Author: Till Krüss
Author URI: http://tillkruess.com/
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Copyright 2012 Till Krüss  (www.tillkruess.com)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Floating Admin Menu
 * @copyright 2012 Till Krüss
 */

add_action('load-profile.php', 'fam_load_plugin_textdomain');
add_action('admin_enqueue_scripts', 'fam_enqueue_scripts');
add_action('personal_options', 'fam_personal_options');
add_action('personal_options_update', 'fam_personal_options_update');
add_action('edit_user_profile_update', 'fam_personal_options_update');

function fam_load_plugin_textdomain() {
	load_plugin_textdomain('floating-admin-menu', false, 'floating-admin-menu/languages');
}

function fam_enqueue_scripts() {

	$plugin = get_plugin_data(__FILE__, false, false);
	$useragent = empty($_SERVER['HTTP_USER_AGENT']) ? '' : $_SERVER['HTTP_USER_AGENT'];

	if (!function_exists('wp_is_mobile'))
		require_once dirname(__FILE__).'/legacy.php';

	// disable floating on mobile devices, except iPads
	if (wp_is_mobile() && strpos($useragent, 'iPad') === false)
		return;

	// float menu, unless explicitly turned off in user profile
	if (get_user_meta(get_current_user_id(), 'float_admin_menu', true) !== '0') {
		wp_register_script('floating-admin-menu', plugin_dir_url(__FILE__).'floating-admin-menu.js', array('jquery'), $plugin['Version']);
		wp_register_style('floating-admin-menu', plugin_dir_url(__FILE__).'floating-admin-menu.css', null, $plugin['Version']);
		wp_enqueue_script('floating-admin-menu');
		wp_enqueue_style('floating-admin-menu');
	}

}

function fam_personal_options_update($user_id) {

	if (!current_user_can('edit_user', $user_id))
		return;

	update_user_meta($user_id, 'float_admin_menu', intval(isset($_POST['float_admin_menu'])));

}

function fam_personal_options($profileuser) {
?>
	<tr class="float-admin-menu">
		<th scope="row"><?php _e('Admin menu', 'floating-admin-menu'); ?></th>
		<td>
			<fieldset>
				<legend class="screen-reader-text"><span><?php _e('Admin menu', 'floating-admin-menu'); ?></span></legend>
				<label for="float_admin_menu">
					<input type="checkbox" name="float_admin_menu" id="float_admin_menu" value="1"<?php checked(get_user_meta($profileuser->ID, 'float_admin_menu', true) !== '0'); ?> />
					<?php _e('Float the admin navigation menu', 'floating-admin-menu'); ?>
				</label><br />
			</fieldset>
		</td>
	</tr>
<?php
}
