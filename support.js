
$(document).ready(function(){

// jQuery rewrite of YUI event listener
$("#donation").keyup(function() {
	var levels = new Array(25, 50, 150, 300, 1000);
	var custom_payments = 150; /* minimum $ amount for monthly payments */
	var value = this.value;
	var split_custom = $("#split-custom");
	
	if (value >= custom_payments) {
		split_custom.attr('disabled', '');
		split_custom.parent().fadeTo('fast', 1);
	} else {
		split_custom.attr('disabled', 'true');
		split_custom.parent().fadeTo('fast', 0.5);
	}

	for (var i = 0; i < levels.length; i++) {
		if (value >= levels[i]) {
			$("#" + levels[i]).fadeTo('fast', 1);
		} else {
			$("#" + levels[i]).fadeTo('fast', 0.25);
		}
	}
});

// Handle validating custom amount
// Show an error message and disable Donate button if the value is too low
function check_minimum(e) {
    if (e.value < 5.0) {
        $('#customError').html("Donations must be at least <strong>$5</strong>.").show();
		//$('#joinButton').attr('disabled', true).addClass('disabled');
    } else {
        $('#customError').hide();
		//$('#joinButton').attr('disabled', false).removeClass('disabled');
    }
}

var hideDelay = 250;
var hideTimeout = null;
function showDialog(dialog) {
	if (hideTimeout) clearTimeout(hideTimeout);

	$(".help_dialog").each(function () { 
		if ($(this) != $(dialog)) {			
			$(this).dialog('close'); 
		}
	});
	$(dialog).dialog('open');
}

function hideDialog(dialog) {
	if (hideTimeout) clearTimeout(hideTimeout);

	hideTimeout = setTimeout(function() {
		hideTimeout = null;	
		$(dialog).dialog('close');
	}, hideDelay);
}

// Gift hover popups
$(".help_dialog").each(function() { 
	var header = $(this).find(".hd");

	$(this).dialog({
		title: header.text(),
		position: 'center',
		resizable: false,
		autoOpen: false,
	/*	show: 'fade',
		hide: 'fade',	*/
		width: 300
	});			
	
	// Hide the header text div
	header.hide();

	$(this).dialog().mouseover(function() { showDialog("#" + this.id) });
	$(this).dialog().mouseout(function() { hideDialog("#" + this.id) });
});

$(".helpLink").each(function() {
	$(this).mouseover(function() { showDialog("#" + this.id + "_help") });
	$(this).mouseout(function () { hideDialog("#" + this.id + "_help") });
});

// end of jQuery
});

