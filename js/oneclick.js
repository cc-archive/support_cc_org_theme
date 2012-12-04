// OneClick

// OneClick model object
function OneClick(element) {
	this.premiumId = 26;
	this.recurringAmount = 0.0;
	this.adventure = false;
	this.queryString = "";
	this.e = element;
	var amount = '';
	
	// Handle "Choose your own amount"
	if (this.e.type == "submit") {
		if (cj(':input[name=donate_amount]:checked').val() == "choose") {
			amount = parseFloat(cj(':input[name=choose_amount]').val());
		} else if (!isNaN(cj(':input[name=donate_amount]:checked').val())) {
			amount = parseFloat(cj(':input[name=donate_amount]:checked').val());
		} else {
			amount = parseFloat(cj(':input[name=amount]').val());
		}

		this.e = new Object();

		// No donations below $5.00
		if (amount < 5.0 || isNaN(amount)) throw "Donation amount must be over $5";

		this.e.href = cj('#customForm, #donate_form').attr('action') + "amount=" + amount;
		this.e.queryString = cj.queryString(this.e.href);
		this.adventure = true;

		// Check if we're splitting, recurring forever, and the donation was >=75
		// split: recur=1
		// perm_recur: recur=2
		if ((cj(':input[name=recur]').attr('checked') || cj(':input[name=perm_recur]').attr('checked')) && this.e.queryString.amount >= 75) {
			if (cj(':input[name=recur]').attr('checked')) {
				this.e.queryString.recur = 1;
			} 
			if (cj(':input[name=perm_recur]').attr('checked')) { 
				this.e.queryString.recur = 2;
			}
		}
	} else {
		this.e.queryString = cj.queryString(this.e.href);
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
		cj('#tshirtSize').toggle();
	},
	
	display: function() {
		(this.donation < 50) ? cj('#noPremiums').show() : cj('#noPremiums').hide();

		(this.donation >= 50) ? cj('#premiums').show() : cj('#premiums').hide();
		(this.donation >= 50) ? cj("#giftCheck").val(["yes"]) : cj("#giftCheck").val(["no"]);
		(this.donation >= 50) ? cj('#tshirtSize').show() : cj('#tshirtSize').hide();

		if (this.e.queryString.recur == 1) {
			cj("#recur_annual").attr("checked", "checked"); 
		} else if (this.e.queryString.recur == 2) {
			cj("#recur_annual").attr("checked", ""); 
			cj("#recur_infinite").attr("checked", "checked");
		} else {
			cj("#recur_annual").attr("checked", ""); 
			cj("#recur_infinite").attr("checked", "");
			cj("#recur_none").attr("checked", "checked");
		}

		if (this.donation >= 100) {
			if (this.e.queryString.recur && !this.adventure) {
				recurringAmount = this.e.queryString.amount;
			} else {
				recurringAmount = parseFloat(this.donation / 12).toFixed(2);
			}

			// Fill in the popup's spans with the monthly amount
			cj(".recurringAmount").html(recurringAmount);
			cj(".amount").html(this.donation);

			cj("#recurring").show();
		} else {
			cj("#recurring").hide();
		}

		cj("#shirtError").html("");

		cj("#optout").attr("checked", "");
		
		// Google Analytics
    // Log when the oneclick dialog gets opened, hopefully doesn't confuse GA 
		if (typeof(_gat) == "object") {
			var pageTracker = _gat._getTracker("UA-2010376-4");
			pageTracker._trackPageview("/donate/oneclick/" + this.donation);
		}
		
		var oneclick = this;
		cj("#giftCheck").change(function() { oneclick.hidePremiums(); });
		
		cj('#moreOptions').dialog('open');
	},
	
	// Process the selections made in the OneClick popup before sending the query string
	// to OneClickDonate.php and on to either Paypal or Google
	process: function() {
		var queryString = this.e.queryString;

		// Recurring donation options
		var recurring = cj(':input[name=recur]:checked').val();
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

		if (cj("#giftCheck:checked").val() == "yes") {
			// premiumId is defined in a <script> block at the top of the donate page
			queryString.premium = premiumId;

			// Validation
			// Can't continue if no shirt size is selected
			var shirtSize = cj(":input[name=size]").val();
			if (shirtSize.length === 0) {
				cj("#shirtError").html("Please select a size!");
				return null;
			}
			queryString.size = shirtSize;
		}

		// Select all the checked checkboxes with the name 'lists', add their value to an array.
		var groups = new Array();
		cj(":checkbox[name=groups]:checked").each(function() { groups.push(this.value); });
		if (groups.length) queryString.groups = groups.join(":");

		// Check if user is opting out of appearing on any lists
		if (cj(":checkbox[name=optout]:checked").length) {
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
		// Define oneclick in the global scope to get around later
		// scoping and closure issues.
		window.oneclick = new OneClick(element);		
	} catch(error) {
		alert(error);
		return false;
	}
	
	cj('#moreOptions').dialog({
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


				e.href = cj.queryString(e.href, queryString);
				//console.log(e.href);
				//return;
			
				// Google Analytics
				// Since we head directly to PayPal from here, we need to give GA a fake pageview
				// else we get a page "exit" -- hard to determine if the user left or went to PayPal.
				if (typeof(_gat) == "object") {
					var pageTracker = _gat._getTracker("UA-2010376-4");
					pageTracker._trackPageview("/donate/paypal");
				}

				cj(this).dialog("close"); 
				location.href = e.href;
				
			}, buttonClass: "paypal"}, 
			"<span>Donate with Google Wallet</span>": { click: function() {
				//
				// Google Checkout
				//
				
				if (oneclick.process() == null) { return; }
				var e = oneclick.e;
				var queryString = e.queryString;
			
				queryString.pp = "gc";


				e.href = cj.queryString(e.href, queryString);
				//console.log(e.href);

				// Google Analytics
				// Since we head directly to PayPal from here, we need to give GA a fake pageview
				// else we get a page "exit" -- hard to determine if the user left or went to Google Checkout.
				if (typeof(_gat) == "object") {
					var pageTracker = _gat._getTracker("UA-2010376-4");
					pageTracker._trackPageview("/donate/gc");
				}

				cj(this).dialog("close"); 
				location.href = e.href;				

			}, buttonClass: "gc"} }

		});	
		
		oneclick.display();
}

// Hook up the donate page links to fire off a controller instance
cj(function() {
	cj(".donationInfo a, #joinButton, #donate_button").click(function(e) { 
		new OneClickController(this); 
		e.preventDefault(); 
	});	
});

