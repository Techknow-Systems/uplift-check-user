jQuery(function($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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

	var mediaUploader;
	var clicked_button

	function get_media_url () {

    	// If the uploader object has already been created, reopen the dialog
      	if (mediaUploader) {
      		mediaUploader.open();
      		return;
    	}

    	// Extend the wp.media object
    	mediaUploader = wp.media.frames.file_frame = wp.media({
      		title: 'Choose Image',
      		button: {
      			text: 'Choose Image'
    		}, multiple: false });

    	// When a file is selected, grab the URL and set it as the text field's value
    	mediaUploader.on('select', function() {
      		var attachment = mediaUploader.state().get('selection').first().toJSON();
      		$('#' + clicked_button.data('url-field-id')).val(attachment.url);
    	});

    	// Open the uploader dialog
    	mediaUploader.open();

	}

	// Open the Media Uploader
  	$("[id^=upload-button-]").on('click', function(e) {

    	e.preventDefault();
    	clicked_button = $(this);
    	get_media_url ();
    	
  });


});
