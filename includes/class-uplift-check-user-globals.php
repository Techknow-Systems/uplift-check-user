<?php

/**
 * Globally accessible functions
 *
 * @link		http://www.techknowsystems.com.au
 * @since		0.1.0
 *
 * @package		Uplift_Check_User
 * @subpackage	Uplift_Check_User/includes
 */

/**
 * Writes a nicely formatted error_log message
 *
 * Simply calls the Global class write_debug_log function
 *
 * @since	0.1.0
 * @var		string		$message		The message to output to the error file
 */
function ucu_debug_log ($message, $message_type = 'M', $location = '') {

	Uplift_Check_User_Globals::write_debug_log ($message, $message_type, $location);
	
}

/**
 * The class that houses the globally accessible functions.
 *
 * @since      0.1.0
 * @package    Uplift_Article_Meta
 * @subpackage Uplift_Article_Meta/includes
 * @author     Shaa Taylor <shaa@uplift.global>
 */
class Uplift_Check_User_Globals {

	/**
	 * Writes a nicely formatted debug to a chosen location.
	 *
	 * NGINX is painful when it comes to debug logging as it sticks everything in the system log for the server.
	 * This function allows nicely formatted debug logging
	 *
	 * @since    0.1.0
	 * @access   public
	 */
	public static function write_debug_log ($message, $message_type, $location) {

		$dt = date("D M j Y G:i:s", time()+36000);
		$prefix = " [UPLIFT User Management:] ";
		$fileLocation = "/usr/local/var/log/apache2/uplifttv-error_log";
//		$fileLocation = "/var/log/nginx/wp-error.log";
		$type = '';
		$location = ' ' . $location . ': ';		

		switch ($message_type) {

			case 'M' :

				$type = ' MESSAGE ';
				break;

			case 'W' :

				$type = ' WARNING ';
				break;

			case 'E' :

				$type = ' ERROR ';
				break;

			case 'F' :

				$type = ' FATAL ';
				break;

			default :

				$type = ' MESSAGE ';

		}

		if (is_array($message) || is_object($message)) {

			error_log($dt . $prefix . $type  . $location, 3, $fileLocation);
			error_log(print_r ($message) . "\n", 3, $fileLocation);
	
		} else {

			error_log($dt . $prefix . $type . $location . $message . "\n", 3, $fileLocation);

		}

	}	

}
