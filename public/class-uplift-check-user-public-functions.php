<?php

/**
 * The public static functions exposed directly to the user
 *
 * The functions hete are simply wrappers for the functions defined in the plugin. The user can call them
 * and we can still keep the OOP design. Nice.
 *
 * @link       https://au.linkedin.com/in/shaarobtaylor
 * @since      0.1.0
 *
 * @package    Uplift_Check_User
 * @subpackage Uplift_Check_User/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Uplift_Check_User
 * @subpackage Uplift_Check_User/public
 * @author     Shaa Taylor <shaa@uplift.global>
 */

/**
 * Checks the cookie to see if the user is indeed logged in
 *
 * @since 		0.1.0
 * @return 		bool
 */
function ucu_is_user_logged_in ($cookie_name) {

	$user = new Uplift_Check_User_Public ('public', '1.0.0', $cookie_name);

	return $user->is_user_logged_in();

}

/**
 * Enables writing to the site error log outside of the plugin - for testing purposes.
 *
 * @since 		0.1.0
 * @return 		none
 */
function ucu_write_debug_log ($message, $type = 'M', $location = '') {

	ucu_debug_log ($message, $type, $location);

}