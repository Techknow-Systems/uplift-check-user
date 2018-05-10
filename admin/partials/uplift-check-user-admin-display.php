<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://au.linkedin.com/in/shaarobtaylor
 * @since      0.1.0
 *
 * @package    Uplift_Check_User
 * @subpackage Uplift_Check_User/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

 	<h1>UPLIFT TV <?php echo esc_html( get_admin_page_title() ); ?></h1>
 	<p>Here is where to set the home page banner seen by the user when they are logged in / logged out, and the film URL that the banner will link to. The cookie to manage the login process should also be set here.</p>
 	<form action="options.php" method="post">
	    <?php

	        settings_fields ($this->plugin_name);
	        do_settings_sections ($this->plugin_name);
	        submit_button ('Save all changes', 'primary', 'submit', TRUE);
	    ?>
	</form>

</div>