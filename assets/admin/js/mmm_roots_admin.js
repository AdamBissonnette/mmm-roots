var activeUpload = null;

function SaveOptions(form)
{
	var formdata = jQuery(form).serializeArray()
	jQuery.post ('admin-ajax.php',
		 { 'action':'do_ajax', 'fn':'settings', 'count':10, settings:formdata },
		  function(data){FinalizeOptions(data)},
		   "json");
}

function FinalizeOptions(data)
{
	if (data == 0)
	{
		ShowModal('Settings Saved!', '<p>The settings have been saved!</p>');
	}
	else
	{
		ShowModal('Oops!', '<p>Something unexpected happened... settings might have been saved... open this page in a second window and see?</p>');
	}
}

function SetupUploadControls()
{
	// jQuery('.image_upload_control').bind("click", function(this) {
	// 	var text = jQuery(this)
	// })

	jQuery('.image_uploader a').click(function(event) {
		activeUpload = jQuery(event.target).prev();

		//console.log("set active upload to " + event.target + " " + activeUpload.attr('id'));

		//formfield = jQuery('#upload_image').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
		 
	window.send_to_editor = function(html) {
	 imgurl = jQuery('img',html).attr('src');
	 jQuery(activeUpload).val(imgurl);
	 tb_remove();
	}
}

jQuery(document).ready(function($) {
	$('#btnOptionsSave').click(function(e) {
		e.preventDefault();
		if (ValidateForm("form#theme_settings"))
		{
			SaveOptions(jQuery("form#theme_settings"));
		}
	});

	SetupUploadControls();
});