var recurringAmount = 0.0;

function oneClickDialogSetup(e) {
  (e.donation > 25) ? $('#premiums').show() : $('#premiums').hide();
  (e.donation > 25) ? $("#giftCheck").val(["yes"]) : $("#giftCheck").val(["no"]);
  (e.donation > 25) ? $('#tshirtSize').show() : $('#tshirtSize').hide();

  if (e.queryString.recur == 1) {
    $("#recur_annual").attr("checked", "checked"); 
  } else if (e.queryString.recur == 2) {
    $("#recur_annual").attr("checked", ""); 
    $("#recur_infinite").attr("checked", "checked");
  } else {
    $("#recur_annual").attr("checked", ""); 
    $("#recur_infinite").attr("checked", ""); 
  }
  
  if (e.donation >= 100) {
    if (e.queryString.recur) {
      recurringAmount = e.queryString.amount;
    } else {
      recurringAmount = parseFloat(e.donation / 12).toFixed(2);
    }

    // Fill in the popup's spans with the monthly amount
    $(".recurringAmount").html(recurringAmount);
    
    $("#recurring").show();
  } else {
    $("#recurring").hide();
  }
  
  $("#shirtError").html("");
 
  $("#optout").attr("checked", "");
	
}

function oneClick(e) {
  // Handle "Choose your own amount"
  if (e.type == "submit") {
		var e = new Object();
    e.href = $(':input[name=base_href]').val() + "?" + "amount=" + $(':input[name=donation]').val();
		e.queryString = jQuery.queryString (e.href);
		
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
			e.queryString.amount = parseFloat(e.queryString.amount / 12).toFixed(2)
		}
  } else {
		e.queryString = jQuery.queryString (e.href);
	}
  
  // Get the donation level, so we can show/hide things based on it
  var donation = e.queryString.amount;

	// Multiply up the donation amount if it's a preset recurring amount
  if (e.queryString.recur) { donation *= 12; }

	// Save the final total donation amount
	e.donation = donation;
	
	oneClickDialogSetup(e);

  $('#moreOptions').dialog('option', 'donateElement', e);
  $('#moreOptions').dialog('open');
  
  return false;
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
    width: 575,
    buttons: {"Continue...": function() { 
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
      
      // Select all the checked checkboxes with the name 'lists', add their value to an array.
      var groups = new Array();
      $(":checkbox[name=groups]:checked").each(function() { groups.push(this.value); });
      if (groups.length) queryString.groups = groups.join(":");

      // Check if user is opting out of appearing on any lists
      if ($(":checkbox[name=optout]:checked").length) {
		queryString.sloptout = "IChooseToSloptOut"; 
      }

      e.href = jQuery.queryString(e.href, queryString);
      //console.log(e.href);

      $(this).dialog("close"); 
      location.href = e.href;
    }, "I've changed my mind": function() { $(this).dialog("close"); }}
  });
});
