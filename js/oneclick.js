// OneClick

// OneClick model object
function OneClick(element) {
	this.premiumId = 26;
	this.recurringAmount = 0.0;
	this.adventure = false;
	this.queryString = "";
	this.e = element;

	// Handle "Choose your own amount"
	if (this.e.type == "submit") {
		var amount = parseFloat($(':input[name=amount]').val());
		this.e = new Object();

		// No donations below $5.00
		if (amount < 5.0 || isNaN(amount)) throw "Donation amount must be over $5";

		this.e.href = $('#customForm').attr('action') + "amount=" + amount;
		this.e.queryString = jQuery.queryString(this.e.href);
		this.adventure = true;

		// Check if we're splitting, recurring forever, and the donation was >=75
		// split: recur=1
		// perm_recur: recur=2
		if (($(':input[name=recur]').attr('checked') || $(':input[name=perm_recur]').attr('checked')) && this.e.queryString.amount >= 75) {
			if ($(':input[name=recur]').attr('checked')) {
				this.e.queryString.recur = 1;
			} 
			if ($(':input[name=perm_recur]').attr('checked')) { 
				this.e.queryString.recur = 2;
			}
		}
	} else {
		this.e.queryString = jQuery.queryString(this.e.href);
	}
	
	// Get the donation level, so we can show/hide things based on it
	this.donation = this.e.queryString.amount;
	
	// Multiply up the donation amount if it's a preset recurring amount
	if (this.e.queryString.recur && !this.adventure) { 
		this.donation *= 12; 
		this.donation = this.donation.toFixed();
	}
}

OneClick.prototype = {
	hidePremiums: function() {
		$('#tshirtSize').toggle();
	},
	
	display: function() {
		(this.donation < 50) ? $('#noPremiums').show() : $('#noPremiums').hide();

		(this.donation >= 50) ? $('#premiums').show() : $('#premiums').hide();
		(this.donation >= 50) ? $("#giftCheck").val(["yes"]) : $("#giftCheck").val(["no"]);
		(this.donation >= 50) ? $('#tshirtSize').show() : $('#tshirtSize').hide();

		if (this.e.queryString.recur == 1) {
			$("#recur_annual").attr("checked", "checked"); 
		} else if (this.e.queryString.recur == 2) {
			$("#recur_annual").attr("checked", ""); 
			$("#recur_infinite").attr("checked", "checked");
		} else {
			$("#recur_annual").attr("checked", ""); 
			$("#recur_infinite").attr("checked", "");
			$("#recur_none").attr("checked", "checked");
		}

		if (this.donation >= 150) {
			if (this.e.queryString.recur && !this.adventure) {
				recurringAmount = this.e.queryString.amount;
			} else {
				recurringAmount = parseFloat(this.donation / 12).toFixed(2);
			}

			// Fill in the popup's spans with the monthly amount
			$(".recurringAmount").html(recurringAmount);
			$(".amount").html(this.donation);

			$("#recurring").show();
		} else {
			$("#recurring").hide();
		}

		$("#shirtError").html("");

		$("#optout").attr("checked", "");
		
		// Google Analytics
    // Log when the oneclick dialog gets opened, hopefully doesn't confuse GA 
		if (typeof(_gat) == "object") {
			var pageTracker = _gat._getTracker("UA-2010376-4");
			pageTracker._trackPageview("/donate/oneclick/" + this.donation);
		}
		
		var oneclick = this;
		$("#giftCheck").change(function() { oneclick.hidePremiums(); });
		
		$('#moreOptions').dialog('open');
	},
	
	// Process the selections made in the OneClick popup before sending the query string
	// to OneClickDonate.php and on to either Paypal or Google
	process: function() {
		var queryString = this.e.queryString;

		// Recurring donation options
		var recurring = $(':input[name=recur]:checked').val();
		if (recurring) {
			queryString.recur = recurring;
			queryString.amount = recurringAmount;
			queryString.final_receipt = 76;
		} else {
			// final_receipt might get set if user selects a recurring option but changes
			// their mind in the oneclick popup.
			queryString.final_receipt = "";
		}

		// reset the premium data if it was set before
		if (queryString.premium) queryString.premium = "";
		if (queryString.size) queryString.size = "";

		if ($("#giftCheck:checked").val() == "yes") {
			// premiumId is defined in a <script> block at the top of the donate page
			queryString.premium = premiumId;

			// Validation
			// Can't continue if no shirt size is selected
			var shirtSize = $(":input[name=size]").val();
			if (shirtSize.length === 0) {
				$("#shirtError").html("Please select a size!");
				return null;
			}
			queryString.size = shirtSize;
		}

		// Select all the checked checkboxes with the name 'lists', add their value to an array.
		var groups = new Array();
		$(":checkbox[name=groups]:checked").each(function() { groups.push(this.value); });
		if (groups.length) queryString.groups = groups.join(":");

		// Check if user is opting out of appearing on any lists
		if ($(":checkbox[name=optout]:checked").length) {
			queryString.sloptout = "IChooseToSloptOut"; 
		}

		this.e.queryString = queryString;
		return true;
	}
};

// OneClick controller
// Instantiate a OneClick model object, configure the dialog view, and display
function OneClickController(element) {
	try {
		var oneclick = new OneClick(element);		
	} catch(error) {
		alert(error);
		return false;
	}
	
	$('#moreOptions').dialog({
		title: 'Your Donation', 
		position:'center', 
		resizable: false,
		autoOpen: false,
		modal: true,
		width: 660,
		buttons: {"<span>Donate with Paypal</span>": { click: function() {
				//
				// PAYPAL
				//
			
				if (oneclick.process() == null) { return; }
				var e = oneclick.e;

				var queryString = e.queryString;
			
				queryString.pp = "paypal";


				e.href = jQuery.queryString(e.href, queryString);
				//console.log(e.href);
				//return;
			
				// Google Analytics
				// Since we head directly to PayPal from here, we need to give GA a fake pageview
				// else we get a page "exit" -- hard to determine if the user left or went to PayPal.
				if (typeof(_gat) == "object") {
					var pageTracker = _gat._getTracker("UA-2010376-4");
					pageTracker._trackPageview("/donate/paypal");
				}

				$(this).dialog("close"); 
				location.href = e.href;
				
			}, buttonClass: "paypal"}, 
			"<span>Donate with Google Checkout</span>": { click: function() {
				//
				// Google Checkout
				//
				
				if (oneclick.process() == null) { return; }
				var e = oneclick.e;
				var queryString = e.queryString;
			
				queryString.pp = "gc";


				e.href = jQuery.queryString(e.href, queryString);
				//console.log(e.href);

				// Google Analytics
				// Since we head directly to PayPal from here, we need to give GA a fake pageview
				// else we get a page "exit" -- hard to determine if the user left or went to Google Checkout.
				if (typeof(_gat) == "object") {
					var pageTracker = _gat._getTracker("UA-2010376-4");
					pageTracker._trackPageview("/donate/gc");
				}

				$(this).dialog("close"); 
				location.href = e.href;				
				
			}, buttonClass: "gc"},
			"I've changed my mind": { click: function() { $(this).dialog("close"); }, buttonClass: "cancel" } }
		});	
		
		oneclick.display();
}

// Hook up the donate page links to fire off a controller instance
$(function() {
	$(".donationInfo a, #joinButton").click(function(e) { 
		new OneClickController(this); 
		e.preventDefault(); 
	});	
});

