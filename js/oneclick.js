var recurringAmount = 0.0;

// set a default premium id
var premiumId = 26;

function isAnchorOnPcpPage(e) {
	return (!e.donation && e.queryString.pcpid);
}

function oneClickDialogSetup(e) {
	if (isAnchorOnPcpPage(e)) {
		// Assuming this is a oneclick request from a PCP page
		$("#pcpOptions").show();
		$("#customAmountSelection option").each(function() { this.selected = false; });
		$("#customAmount").hide();
		$("#customAmountEntry").val("");
		$("#customAmountEntry").keyup(function(event) {
			if (this.value > 1) {
				updateOneClickWithAmount(this.value);
			}
		});
	} else {
		$("#pcpOptions").hide();
	}
	
	(e.donation < 75) ? $('#noPremiums').show() : $('#noPremiums').hide();

	(e.donation >= 75) ? $('#premiums').show() : $('#premiums').hide();
  (e.donation >= 75) ? $("#giftCheck").val(["yes"]) : $("#giftCheck").val(["no"]);
  (e.donation >= 75) ? $('#tshirtSize').show() : $('#tshirtSize').hide();

  if (e.queryString.recur == 1) {
    $("#recur_annual").attr("checked", "checked"); 
  } else if (e.queryString.recur == 2) {
    $("#recur_annual").attr("checked", ""); 
    $("#recur_infinite").attr("checked", "checked");
  } else {
    $("#recur_annual").attr("checked", ""); 
    $("#recur_infinite").attr("checked", "");
		$("#recur_none").attr("checked", "checked");
  }
  
  if (e.donation >= 100) {
    if (e.queryString.recur && !e.adventure) {
      recurringAmount = e.queryString.amount;
    } else {
      recurringAmount = parseFloat(e.donation / 12).toFixed(2);
    }

    // Fill in the popup's spans with the monthly amount
    $(".recurringAmount").html(recurringAmount);
		$(".amount").html(e.donation);
    
    $("#recurring").show();
  } else {
    $("#recurring").hide();
  }
  
  $("#shirtError").html("");
	$("#pcpError").html("");

  $("#optout").attr("checked", "");
	
}

function oneClick(e) {
  // Handle "Choose your own amount"
  if (e.type == "submit") {
		var e = new Object();
    	e.href = $(':input[name=base_href]').val() + "amount=" + $(':input[name=donation]').val();
		e.queryString = jQuery.queryString (e.href);
    	e.adventure = true;

		// Check if we're splitting, recurring forever, and the donation was >=75
		// split: recur=1
		// perm_recur: recur=2
		if (($(':input[name=split]').attr('checked') || $(':input[name=perm_recur]').attr('checked')) && e.queryString.amount >= 75) {
			if ($(':input[name=split]').attr('checked')) {
				e.queryString.recur = 1;
			} 
			if ($(':input[name=perm_recur]').attr('checked')) { 
				e.queryString.recur = 2;
			}
		}
  } else {
		e.queryString = jQuery.queryString (e.href);
	}
  
  // Get the donation level, so we can show/hide things based on it
  var donation = e.queryString.amount;

	// Multiply up the donation amount if it's a preset recurring amount
  if (e.queryString.recur && !e.adventure) { 
    donation *= 12; 
    donation = donation.toFixed();
  }

	// Save the final total donation amount
	e.donation = donation;
	
	oneClickDialogSetup(e);

  $('#moreOptions').dialog('option', 'donateElement', e);
  $('#moreOptions').dialog('open');
  
  return false;
}

// Modify the dialog options based on given amount
// For PCP donations
function updateOneClickWithAmount(amount) {
	$("#pcpError").html("");
	
	(amount >= 75) ? $('#premiums').show() : $('#premiums').hide();
  (amount >= 75) ? $("#giftCheck").val(["yes"]) : $("#giftCheck").val(["no"]);
  (amount >= 75) ? $('#tshirtSize').show() : $('#tshirtSize').hide();
	
	if (amount >= 100) {
    recurringAmount = parseFloat(amount / 12).toFixed(2);

    // Fill in the popup's spans with the monthly amount
    $(".recurringAmount").html(recurringAmount);
    $(".amount").html(amount);

    $("#recurring").show();
  } else {
    $("#recurring").hide();
  }

	// Get the active oneclick link and update its amount value
	var e = $("#moreOptions").dialog('option', 'donateElement');
	e.queryString.amount = amount;
}

// Handle the dropdown selection for PCP donations
function donationSelection(e) {
	var selection = $("#customAmountSelection").val();

	if (selection == "other") {
		$("#customAmount").show();
		updateOneClickWithAmount($("#customAmount").val());
		return;
	} else {
		$("#customAmount").hide();
	}
	
	if (selection == "") return;
	
	updateOneClickWithAmount(selection);
}

function hidePremiums(e) {
  $('#tshirtSize').toggle();
}

$(document).ready(function (){
  $('#moreOptions').dialog({
    title: 'Your Donation', 
    position:'center', 
    resizable: false,
    autoOpen: false,
    width: 600,
    buttons: {"Donate": function() { 
      var e = $(this).dialog('option', 'donateElement');
      var queryString = e.queryString;
      
      // Recurring donation options
      var recurring = $(':input[name=recur]:checked').val();
      if (recurring) {
        queryString.recur = recurring;
        queryString.amount = recurringAmount;
      }
      
      if ($("#giftCheck:checked").val() == "yes") {
				// premiumId is defined in a <script> block at the top of the donate page
		    queryString.premium = premiumId;
        
        // Validation
        // Can't continue if no shirt size is selected
        var shirtSize = $(":input[name=size]").val();
        if (shirtSize == "") {
          $("#shirtError").html("Please select a size!");
          return;
        }
        queryString.size = shirtSize;
      }

      // Can't continue if no custom amount is selected/entered
	  // For PCP donations
	  if (isAnchorOnPcpPage(e)) {
	  	if (!$("#customAmountSelection").val() || ($("#customAmountSelection").val() == "other" && !$("#customAmountEntry").val())) {
					if ($("#customAmountSelection").val() == "other") {
						$("#pcpError").html("Please enter a donation amount!");
					} else {
						$("#pcpError").html("Please select a donation amount!");
					}
					
          return;
	   	}
	  }

      // Select all the checked checkboxes with the name 'lists', add their value to an array.
      var groups = new Array();
      $(":checkbox[name=groups]:checked").each(function() { groups.push(this.value); });
      if (groups.length) queryString.groups = groups.join(":");

      // Check if user is opting out of appearing on any lists
      if ($(":checkbox[name=optout]:checked").length) {
				queryString.sloptout = "IChooseToSloptOut"; 
      }
	  
	  if (isAnchorOnPcpPage(e)) {
		 e.href = e.href.replace('donate', 'sites/default/modules/civicrm/bin/OneClickDonate.php');
	  }

      e.href = jQuery.queryString(e.href, queryString);
      //console.log(e.href);

	  // Google Analytics
	  // Since we head directly to PayPal from here, we need to give GA a fake pageview
	  // else we get a page "exit" -- hard to determine if the user left or went to PayPal.
	  if (typeof(_gat) == "object") {
	    var pageTracker = _gat._getTracker("UA-2010376-4");
		pageTracker._trackPageview("/donate/paypal");
	  }

      $(this).dialog("close"); 
      location.href = e.href;
    }, "I've changed my mind": function() { $(this).dialog("close"); }}
  });
});
