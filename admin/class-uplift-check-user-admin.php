<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://au.linkedin.com/in/shaarobtaylor
 * @since      0.1.0
 *
 * @package    Uplift_Check_User
 * @subpackage Uplift_Check_User/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Uplift_Check_User
 * @subpackage Uplift_Check_User/admin
 * @author     Shaa Taylor <shaa@uplift.global>
 */
class Uplift_Check_User_Admin {

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
	 * The version of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $options   Hold the settings for the Admin page.
	 */
	private $options;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $option_name 	Option name of this plugin.
	 */
	private $options_prefix = 'ucu_option_';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options = get_option($this->plugin_name);

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/uplift-check-user-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		// Enqueue WP core media sceipts so we can use the image uploader.
		wp_enqueue_media();

		// Enqueue the Admin JS files
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/uplift-check-user-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Adds a 'Settings' link to the plugin on the 'Installed Plugins' page.
	 *
	 * @since    1.0.0
	 */
	public function add_settings_link($links) {

		$links[] = sprintf ('<a href="%s">%s</a>', esc_url (admin_url ('options-general.php?page=' . $this->plugin_name)), esc_html__( 'Settings', $this->plugin_name));
		return $links;

	}

	/**
	 * Adds a settings page under the 'Settings' menu
	 *
	 * @since    1.0.0
	 */
	public function add_options_page() {

		$hookSuffix = add_options_page (
			__('User Management Settings', $this->plugin_name), 
			__('User Management', $this->plugin_name), 
			'manage_options',
			$this->plugin_name,
			array ($this, 'display_settings_page')
		);

	}  // add_options_page

	/**
	 * Adds a settings page under the 'Settings' menu
	 *
	 * @since    1.0.0
	 */
	public function add_settings() {

		// Register the option 'ucu_option_banner_desktop'
//		register_setting ($this->plugin_name, $this->plugin_name, array ($this, 'ucu_option_sanitize_banner_desktop'));
		register_setting (
			$this->plugin_name,  // Option Grouo
			$this->plugin_name,  // Option Name
			array (
				'type'				=> 'string',
				'description'		=> 'All settings for the uplift_check_user plugin.',
				'sanitize_callback'	=> array($this, $this->options_prefix . 'validate'),
				'default'			=> 'default.jpg'
			) // Arguements including callback
		);

		// This is the banner settings section for the admin page - 'ucu_option_banner_signed_in'
		add_settings_section (
			$this->options_prefix . 'banner_signed_in',  // ID
			__('Home Page Banner for Registered (Logged In) Users', $this->plugin_name),  // Title
			array ($this, $this->options_prefix . 'banner_signed_in_section_text'),  // Callback
			$this->plugin_name // Page
		);

		// Add the settings field 'uplift-check-user_banner_desktop'
		add_settings_field (
			$this->plugin_name . '_banner_desktop_signed_in',  // ID
			__('Desktop Banner Image (URL)', $this->plugin_name),  // Label
			array ($this, $this->options_prefix . 'banner_desktop_signed_in_input'),  // Callback
			$this->plugin_name,  // Page
			$this->options_prefix . 'banner_signed_in',  // Section
			array ('label for' => $this->options_prefix . 'banner_desktop_signed_in')  // Arguements for callback
		);

		// Add the settings field 'uplift-check-user_banner_tablet'
		add_settings_field (
			$this->plugin_name . '_banner_tablet_signed_in',  // ID
			__('Tablet Banner Image (URL)', $this->plugin_name),  // Label
			array ($this, $this->options_prefix . 'banner_tablet_signed_in_input'),  // Callback
			$this->plugin_name,  // Page
			$this->options_prefix . 'banner_signed_in',  // Section
			array ('label for' => $this->options_prefix . 'banner_tablet_signed_in')  // Arguements for callback
		);

		// Add the settings field 'uplift-check-user_banner_mobile'
		add_settings_field (
			$this->plugin_name . '_banner_mobile_signed_in',  // ID
			__('Mobile Banner Image (URL)', $this->plugin_name),  // Label
			array ($this, $this->options_prefix . 'banner_mobile_signed_in_input'),  // Callback
			$this->plugin_name,  // Page
			$this->options_prefix . 'banner_signed_in',  // Section
			array ('label for' => $this->options_prefix . 'banner_mobile_signed_in')  // Arguements for callback
		);

		// Add the settings field 'uplift-check-user_latest_film_url'
		add_settings_field (
			$this->plugin_name . '_latest_film_url',  // ID
			__('Latest Film (URL)', $this->plugin_name),  // Label
			array ($this, $this->options_prefix . 'latest_film_input'),  // Callback
			$this->plugin_name,  // Page
			$this->options_prefix . 'banner_signed_in',  // Section
			array ('label for' => $this->options_prefix . 'latest_film_url')  // Arguements for callback
		);

		add_settings_section (
			$this->options_prefix . 'banner_signed_out',  // ID
			__('Home Page Banner for Guest (Logged Out) Users', $this->plugin_name),  // Title
			array ($this, $this->options_prefix . 'banner_signed_out_section_text'),  // Callback
			$this->plugin_name // Page
		);

		// Add the settings field 'uplift-check-user_banner_desktop'
		add_settings_field (
			$this->plugin_name . '_banner_desktop_signed_out',  // ID
			__('Desktop Banner Image (URL)', $this->plugin_name),  // Label
			array ($this, $this->options_prefix . 'banner_desktop_signed_out_input'),  // Callback
			$this->plugin_name,  // Page
			$this->options_prefix . 'banner_signed_out',  // Section
			array ('label for' => $this->options_prefix . 'banner_desktop_signed_out')  // Arguements for callback
		);

		// Add the settings field 'uplift-check-user_banner_tablet'
		add_settings_field (
			$this->plugin_name . '_banner_tablet_signed_out',  // ID
			__('Tablet Banner Image (URL)', $this->plugin_name),  // Label
			array ($this, $this->options_prefix . 'banner_tablet_signed_out_input'),  // Callback
			$this->plugin_name,  // Page
			$this->options_prefix . 'banner_signed_out',  // Section
			array ('label for' => $this->options_prefix . 'banner_tablet_signed_out')  // Arguements for callback
		);

		// Add the settings field 'uplift-check-user_banner_mobile'
		add_settings_field (
			$this->plugin_name . '_banner_mobile_signed_out',  // ID
			__('Mobile Banner Image (URL)', $this->plugin_name),  // Label
			array ($this, $this->options_prefix . 'banner_mobile_signed_out_input'),  // Callback
			$this->plugin_name,  // Page
			$this->options_prefix . 'banner_signed_out',  // Section
			array ('label for' => $this->options_prefix . 'banner_mobile_signed_out')  // Arguements for callback
		);

		// 
		add_settings_section (
			$this->options_prefix . 'general',  // ID
			__('Plugin Options', $this->plugin_name),  // Title
			array ($this, $this->options_prefix . 'plugin_options_section_text'),  // Callback
			$this->plugin_name // Page
		);		

		// Add the settings field 'uplift-check-user_cookie_name'
		add_settings_field (
			$this->plugin_name . '_cookie_name',  // ID
			__('Name of Cookie to Use', $this->plugin_name),  // Label
			array ($this, $this->options_prefix . 'cookie_name_input'),  // Callback
			$this->plugin_name,  // Page
			$this->options_prefix . 'general',  // Section
			array ('label for' => $this->options_prefix . 'cookie_name')  // Arguements for callback
		);

		// Add the settings field 'uplift-check-user_delete_on_uninstall'
		add_settings_field (
			$this->plugin_name . '_delete_on_uninstall',  // ID
			__('Delete Settings When this Plugin is Uninstalled', $this->plugin_name),  // Label
			array ($this, $this->options_prefix . 'delete_on_uninstall_input'),  // Callback
			$this->plugin_name,  // Page
			$this->options_prefix . 'general',  // Section
			array ('label for' => $this->options_prefix . 'delete_on_unistall')  // Arguements for callback
		);

	}

	/**
	 * Renders the text for the Home Page Banner section
	 *
	 * @since    0.1.0
	 */
	public function ucu_option_banner_signed_in_section_text() {

		//echo '<p>' . __('Select the banners from the media library for display on the home page when the user is logged in.', $this->plugin_name) . '</p>';

	}

	/**
	 * Renders the text for the Plugin Options section
	 *
	 * @since    0.1.0
	 */
	public function ucu_option_plugin_options_section_text() {

		// Do Nothing

	}

	/**
	 * Renders the Desktop Banner field for the Home Banner section
	 *
	 * @since    0.1.0
	 */
	public function ucu_option_banner_desktop_signed_in_input () {

     	echo '<input type="text" id="' . $this->plugin_name .'_banner_desktop_signed_in" name="' . $this->plugin_name . '[banner_desktop_signed_in]" value="' . $this->options["banner_desktop_signed_in"] . '" style="width: 50%;" />&nbsp;<input id="upload-button-desktop-signed-in" type="button" class="button" value="Upload Image" data-url-field-id="' . $this->plugin_name .'_banner_desktop_signed_in" />';
     	$this->options['banner_desktop_signed_in'] = esc_attr ($this->options['banner_desktop_signed_in']);

	}

	/**
	 * Renders the Tablet Banner field for the Home Banner section
	 *
	 * @since    0.1.0
	 */
	public function ucu_option_banner_tablet_signed_in_input () {

     	echo '<input type="text" id="' . $this->plugin_name .'_banner_tablet_signed_in" name="' . $this->plugin_name . '[banner_tablet_signed_in]" value="' . $this->options["banner_tablet_signed_in"] . '" style="width: 50%;" />&nbsp;<input id="upload-button-tablet-signed-in" type="button" class="button" value="Upload Image" data-url-field-id="' . $this->plugin_name .'_banner_tablet_signed_in" />';
     	$this->options['banner_tablet_signed_in'] = esc_attr ($this->options['banner_tablet_signed_in']);

	}

	/**
	 * Renders the Mobile Banner field for the Home Banner section
	 *
	 * @since    0.1.0
	 */
	public function ucu_option_banner_mobile_signed_in_input () {

     	echo '<input type="text" id="' . $this->plugin_name .'_banner_mobile_signed_in" name="' . $this->plugin_name . '[banner_mobile_signed_in]" value="' . $this->options["banner_mobile_signed_in"] . '" style="width: 50%;" />&nbsp;<input id="upload-button-mobile-signed-in" type="button" class="button" value="Upload Image" data-url-field-id="' . $this->plugin_name .'_banner_mobile_signed_in" />';
     	$this->options['banner_mobile_signed_in'] = esc_attr ($this->options['banner_mobile_signed_in']);

	}

	/**
	 * Renders the Desktop Banner field for the Home Banner section
	 *
	 * @since    0.1.0
	 */
	public function ucu_option_banner_desktop_signed_out_input () {

     	echo '<input type="text" id="' . $this->plugin_name .'_banner_desktop_signed_out" name="' . $this->plugin_name . '[banner_desktop_signed_out]" value="' . $this->options["banner_desktop_signed_out"] . '" style="width: 50%;" />&nbsp;<input id="upload-button-desktop-signed-out" type="button" class="button" value="Upload Image" data-url-field-id="' . $this->plugin_name .'_banner_desktop_signed_out" />';
     	$this->options['banner_desktop_signed_out'] = esc_attr ($this->options['banner_desktop_signed_out']);

	}

	/**
	 * Renders the Tablet Banner field for the Home Banner section
	 *
	 * @since    0.1.0
	 */
	public function ucu_option_banner_tablet_signed_out_input () {

     	echo '<input type="text" id="' . $this->plugin_name .'_banner_tablet_signed_out" name="' . $this->plugin_name . '[banner_tablet_signed_out]" value="' . $this->options["banner_tablet_signed_out"] . '" style="width: 50%;" />&nbsp;<input id="upload-button-tablet-signed-out" type="button" class="button" value="Upload Image" data-url-field-id="' . $this->plugin_name .'_banner_tablet_signed_out" />';
     	$this->options['banner_tablet_signed_out'] = esc_attr ($this->options['banner_tablet_signed_out']);

	}

	/**
	 * Renders the Mobile Banner field for the Home Banner section
	 *
	 * @since    0.1.0
	 */
	public function ucu_option_banner_mobile_signed_out_input () {

     	echo '<input type="text" id="' . $this->plugin_name .'_banner_mobile_signed_out" name="' . $this->plugin_name . '[banner_mobile_signed_out]" value="' . $this->options["banner_mobile_signed_out"] . '" style="width: 50%;" />&nbsp;<input id="upload-button-mobile-signed-out" type="button" class="button" value="Upload Image" data-url-field-id="' . $this->plugin_name .'_banner_mobile_signed_out" />';
     	$this->options['banner_mobile_signed_out'] = esc_attr ($this->options['banner_mobile_signed_out']);

	}

	/**
	 * Renders the Latest Film URL field for the Home Banner section
	 *
	 * @since    0.1.0
	 */
	public function ucu_option_latest_film_input () {

		// Set a default value if one doesn't exist
		if (!isset ($this->options["latest_film_url"]) || $this->options["latest_film_url"] === '') {

			$args = array (
				'post_type'	=> 'post',
				'tax_query'	=> array (
									array (
										'taxonomy'	=> 'article_class',
										'field'		=> 'slug',
										'terms'		=> array ('film'),
									),
							   ),
			);

			$films = new WP_Query ($args);

			if ($films->have_posts()) {
				$films->the_post();
				$post_url = post_permalink ($films->post->ID);
			} else {
				$post_url = '';
			}

			wp_reset_postdata();

	     	echo '<input type="text" id="' . $this->plugin_name .'_latest_film_url" name="' . $this->plugin_name . '[latest_film_url]" value="' . $post_url . '" style="width: 50%;" />';
	     	echo '<p class="' . $this->options_prefix . 'subtext">When a user clicks on the banners above, they will be redirected to this URL.</p>';
	     	$this->options['latest_film_url'] = esc_attr ($post_url);

		} else {

	     	echo '<input type="text" id="' . $this->plugin_name .'_latest_film_url" name="' . $this->plugin_name . '[latest_film_url]" value="' . $this->options["latest_film_url"] . '" style="width: 50%;" />';
	     	echo '<p class="' . $this->options_prefix . 'subtext">When a user clicks on the banners above, they will be redirected to this URL.</p>';
     	$this->options['latest_film_url'] = esc_attr ($this->options['latest_film_url']);

	    }

	}

	/**
	 * Renders the Cookie Name field for the General section
	 *
	 * @since    0.1.0
	 */
	public function ucu_option_cookie_name_input () {

     	echo '<input type="text" id="' . $this->plugin_name .'_cookie_name" name="' . $this->plugin_name . '[cookie_name]" value="' . $this->options["cookie_name"] . '" />';
     	$this->options['cookie_name'] = esc_attr ($this->options['cookie_name']);

	}

	/**
	 * Renders the Delete on Unistall Checkbox for the General section
	 *
	 * @since    0.1.0
	 */
	public function ucu_option_delete_on_uninstall_input () {

		// To remove the checked='checked' label from the checkbox, us HTML with embedded PHP instead of the other way around! 
		?>

	     	<input type="checkbox" id="<?php echo $this->plugin_name; ?>_delete_on_uninstall" name="<?php echo $this->plugin_name; ?>[delete_on_uninstall]" value="1" <?php checked ($this->options["delete_on_uninstall"], 1) ?> />

     	<?php
     	$this->options['delete_on_uninstall'] = esc_attr ($this->options['delete_on_uninstall']);

	}

	/**
	 * Sanitises the input for the Desktop Banner field in the Home Banner Section
	 *
	 * @since    0.1.0
	 */
	public function ucu_option_validate ($input) {

		$valid = array();
		//$valid['desktop_banner'] = preg_replace ('/[^a-zA-Z]/', '', $input['desktop_banner']);

		return $input;

	}


	/**
	 * The content for the settings page
	 *
	 * The HTML + PHP is stored in a separate file to segment and easy editing
	 *
	 * @since    1.0.0
	 */
	public function display_settings_page () {

		include_once 'partials/uplift-check-user-admin-display.php';

	} // create_settings_page

}