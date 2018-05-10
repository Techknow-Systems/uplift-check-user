(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

    // Check to see if the browser supports btoa() & atob() - Thanks IE for your lack of support
    if (!window.btoa) window.btoa = base64.encode;
    if (!window.atob) window.atob = base64.decode;

	/**
	 * Check to see if the user is logge in
	 *
	 * At this time, we simply check the cookie exists and has any other value but "subscribed=false"
	 *
	 * @since    0.1.0
	 * @access   private
	 */
    function ucu_is_user_logged_in() {

        try {

            if (Cookies.get('upl-signedin') == undefined || decodeURIComponent(window.atob(Cookies.get('upl-signedin'))) == 'subscribed:false;') {
                return false
            } else {
                return true;
            }

        } catch(e) {

            // The base64 encoding is invalid delete the cookie
            Cookies.remove('upl-signedin');
            return false;

        }    

    }
    window.ucu_is_user_logged_in = ucu_is_user_logged_in;


})( jQuery );
