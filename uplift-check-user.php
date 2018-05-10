<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://au.linkedin.com/in/shaarobtaylor
 * @since             0.1.0
 * @package           Uplift_Check_User
 *
 * @wordpress-plugin
 * Plugin Name:       UPLIFT Check User
 * Plugin URI:        https://uplift.tv/
 * Description:       Checks the UPLIFT cookie and sets the site up for a logged in user. 
 * Version:           0.1.0
 * Author:            Shaa Taylor
 * Author URI:        https://au.linkedin.com/in/shaarobtaylor
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       uplift-check-user
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Used for referring to the plugin file or basename
if ( ! defined( 'UPLIFT_CHECK_USER_FILE' ) ) {
	define( 'UPLIFT_CHECK_USER_FILE', plugin_basename( __FILE__ ) );
}

/**
 * Currently plugin version.
 * Start at version 0.1.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '0.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-uplift-check-user-activator.php
 */
function activate_uplift_check_user() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-uplift-check-user-activator.php';
	Uplift_Check_User_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-uplift-check-user-deactivator.php
 */
function deactivate_uplift_check_user() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-uplift-check-user-deactivator.php';
	Uplift_Check_User_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_uplift_check_user' );
register_deactivation_hook( __FILE__, 'deactivate_uplift_check_user' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-uplift-check-user.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_uplift_check_user() {

	$plugin = new Uplift_Check_User();
	$plugin->run();

}
run_uplift_check_user();
