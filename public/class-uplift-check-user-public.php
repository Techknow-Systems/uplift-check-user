<?php

/**
 * The public-facing functionality of the plugin.
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
class Uplift_Check_User_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The contents of the cookie used for user access.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $cookie_contents    The decoded contents of the user cookie
	 */
	private $cookie_contents;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $cookie_name ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->cookie_contents = (isset ($_COOKIE[$cookie_name])) ? urldecode (base64_decode ($_COOKIE[$cookie_name])) : '';

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Uplift_Check_User_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Uplift_Check_User_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/uplift-check-user-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Uplift_Check_User_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Uplift_Check_User_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/uplift-check-user-public.js', array( 'jquery' ), $this->version, false );

	}

	public function get_cookie_contents () {

		return $this->cookie_contents;

	}

	/**
	 * Registers all the plugin shortcodes 
	 *
	 * @since 		0.1.0
	 * @return 		none
	 */
	public function register_shortcodes () {

		// Class for all shortcode functions
		$shortcodes = new Uplift_Check_User_Public_Shortcodes ($this->plugin_name, $this->version);

		// Define all the available shortcodes
		add_shortcode ('homebanner', array ($shortcodes, 'show_home_page_banner'));

	}

	/**
	 * Checks to see if the current user has a logged in cookie
	 *
	 * @since 		0.1.0
	 * @return 		bool
	 */
	public function is_user_logged_in () {

		$cookie_info = explode (';', $this->get_cookie_contents());

		if ($cookie_info[0] === "subscribed:true") { 

			return true; 

		} else { 

			return false; 

		}

	}

}
