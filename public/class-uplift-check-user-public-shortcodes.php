<?php

/**
 * The shortcode definitions for UPLIFT Check User.
 *
 * @link 		http://www.techknowsystems.com.au
 * @since 		0.1.0
 *
 * @package 	Uplift_Check User
 * @subpackage 	Uplift_Check_User/public
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
class Uplift_Check_User_Public_Shortcodes {

	/**
	 * The ID of this plugin.
	 *
	 * @since 		0.1.0
	 * @access 		private
	 * @var 		string 			$plugin_name 		The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 		0.1.0
	 * @access 		private
	 * @var 		string 			$version 			The current version of this plugin.
	 */
	private $version;

	/**
	 * The settings for the plugin set by the admin page.
	 *
	 * @since 		0.1.0
	 * @access 		private
	 * @var 		string 			$options 			Contains all plugin settings
	 */
	private $options;

	/**
	 * The current POST ID that we are viewing.
	 *
	 * @since 		0.1.0
	 * @access 		private
	 * @var 		string 			$postID 			The ID of the current post.
	 */
	private $postID;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		0.1.0
	 * @param 		string 			$plugin_name 		The name of this plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	    $currentURL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	    $this->postID = url_to_postid ($currentURL);
	    $this->options = get_option ($this->plugin_name);

	}

	// Below are all the shortcode functions

	/**
	 * Displays the banner on the home page. 
	 *
	 * The banners are defined on the admin page and are cookie dependent.
	 *
	 * @since 		0.1.0
	 * @return 		none
	 */
	public function show_home_page_banner () {

		echo '<a href="' . $this->options["latest_film_url"] . '"><div class="upl-films-home-banner">';
    		echo '<img class="upl-banner-desktop" src="' . $this->options["banner_desktop_signed_in"] . '"/>';
    		echo '<img class="upl-banner-mobile" src="' . $this->options["banner_mobile_signed_in"] . '" />';
    		echo '<img class="upl-banner-tablet" src="' . $this->options["banner_tablet_signed_in"] . '" />';
    		echo '<img class="upl-banner-desktop-default" src="' . $this->options["banner_desktop_signed_out"] . '"/>';
    		echo '<img class="upl-banner-mobile-default" src="' . $this->options["banner_mobile_signed_out"] . '" />';
    		echo '<img class="upl-banner-tablet-default" src="' . $this->options["banner_tablet_signed_out"] . '" />';
		echo '</div></a>';

	}

}
