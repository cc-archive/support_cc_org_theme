
cj(document).ready(function(){

// Select the radio button on the donate page if someone click anywhere in the
// div
cj(".amount_box").click(function() {
	cj(this).children("input").attr('checked', 'checked');
	cj(this).children("input").trigger('change');

});

// Enable or disable split/recur payments depending on amount
cj("input:radio[name=donate_amount]").change(function () {
	var recur_min = 100;
	var enable_recur = true;
	if (this.value == "choose") {
		if (!(cj("#choose_amount").val() >= recur_min)) {
			enable_recur = false;
		}
	} else {
		if (!(cj("input:radio[name=donate_amount]:checked").val() >= recur_min)) {
			enable_recur = false;
		}
	}
	if (enable_recur) {
		cj("#recur").attr('disabled', '');
		cj("#recur").parent().fadeTo('fast', 1);
	} else {
		cj("#recur").attr('disabled', 'true');
		cj("#recur").removeAttr('checked');
		cj("#recur").parent().fadeTo('fast', 0.4);
	}
});

// jQuery rewrite of YUI event listener
cj("#choose_amount").keyup(function() {
	var levels = new Array(25, 50, 100, 250, 500);
	var recur_min = 100; /* minimum $ amount for monthly payments */
	var value = this.value;
	var recur = cj("#recur");
	
	if (value >= recur_min) {
		recur.attr('disabled', '');
		recur.parent().fadeTo('fast', 1);
	} else {
		recur.removeAttr('checked');
		recur.attr('disabled', 'true');
		//recur.parent().fadeTo('fast', 0.4);
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

