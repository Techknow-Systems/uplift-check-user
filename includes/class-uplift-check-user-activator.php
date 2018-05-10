<?php

/**
 * Fired during plugin activation
 *
 * @link       https://au.linkedin.com/in/shaarobtaylor
 * @since      0.1.0
 *
 * @package    Uplift_Check_User
 * @subpackage Uplift_Check_User/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.1.0
 * @package    Uplift_Check_User
 * @subpackage Uplift_Check_User/includes
 * @author     Shaa Taylor <shaa@uplift.global>
 */
class Uplift_Check_User_Activator {

	/**
	 * Adds plugin options
	 *
	 * This adds the plugin options for the banner and the cookie
	 *
	 * @since    0.1.0
	 */
	public static function activate() {

		// Set up option structure
		$default_plugin_options = array(
			'banner_desktop'		=> '',
			'banner_tablet'			=> '',
			'banner_mobile'			=> '',
			'latest_film_url'		=> '',
			'cookie_name'			=> '',
			'delete_on_uninstall'	=> 0
		);

		if (get_option ('uplift-check-user') === false) {
			add_option ('uplift-check-user', $default_plugin_options);
		}

	}

}
