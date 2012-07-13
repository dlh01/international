<?php
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

// Pre-3.4: Test if the current browser runs on a mobile device (smart phone, tablet, etc.) 
if (!function_exists('wp_is_mobile')) :
	function wp_is_mobile() {
		static $is_mobile;
		if (isset($is_mobile)) return $is_mobile;
		if (empty($_SERVER['HTTP_USER_AGENT'])) {
			$is_mobile = false;
		} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false) {
				$is_mobile = true;
		} else {
			$is_mobile = false;
		}
		return $is_mobile;
	}
endif;
