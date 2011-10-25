
cj(document).ready(function(){

// jQuery rewrite of YUI event listener
cj("#donation").keyup(function() {
	var levels = new Array(25, 50, 150, 300, 1000);
	var custom_payments = 150; /* minimum $ amount for monthly payments */
	var value = this.value;
	var split_custom = cj("#split-custom");
	
	if (value >= custom_payments) {
		split_custom.attr('disabled', '');
		split_custom.parent().fadeTo('fast', 1);
	} else {
		split_custom.attr('disabled', 'true');
		split_custom.parent().fadeTo('fast', 0.5);
	}

	for (var i = 0; i < levels.length; i++) {
		if (value >= levels[i]) {
			cj("#" + levels[i]).fadeTo('fast', 1);
		} else {
			cj("#" + levels[i]).fadeTo('fast', 0.25);
		}
	}
});

// Handle validating custom amount
// Show an error message and disable Donate button if the value is too low
function check_minimum(e) {
    if (e.value < 5.0) {
        cj('#customError').html("Donations must be at least <strong>$5</strong>.").show();
		//cj('#joinButton').attr('disabled', true).addClass('disabled');
    } else {
        cj('#customError').hide();
		//cj('#joinButton').attr('disabled', false).removeClass('disabled');
    }
}

var hideDelay = 250;
var hideTimeout = null;
function showDialog(dialog) {
	if (hideTimeout) clearTimeout(hideTimeout);

	cj(".help_dialog").each(function () { 
		if (cj(this) != cj(dialog)) {			
			cj(this).dialog('close'); 
		}
	});
	cj(dialog).dialog('open');
}

function hideDialog(dialog) {
	if (hideTimeout) clearTimeout(hideTimeout);

	hideTimeout = setTimeout(function() {
		hideTimeout = null;	
		cj(dialog).dialog('close');
	}, hideDelay);
}

// Gift hover popups
cj(".help_dialog").each(function() { 
	var header = cj(this).find(".hd");

	cj(this).dialog({
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

	cj(this).dialog().mouseover(function() { showDialog("#" + this.id) });
	cj(this).dialog().mouseout(function() { hideDialog("#" + this.id) });
});

cj(".helpLink").each(function() {
	cj(this).mouseover(function() { showDialog("#" + this.id + "_help") });
	cj(this).mouseout(function () { hideDialog("#" + this.id + "_help") });
});

// end of jQuery
});

