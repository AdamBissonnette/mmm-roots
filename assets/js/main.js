jQuery(function($) {
	$('#send').click(function(e) {
		e.preventDefault();
		if (ValidateForm("form#mail"))
		{
			SendMessage(jQuery("form#mail"));
		}
	});

	$('#terms').hide();
	$('#honey').hide();

	// ------------------------------------
	// FitVids
	// ------------------------------------
	$(".fitvids").fitVids();
});