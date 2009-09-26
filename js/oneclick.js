var recurringAmount = 0.0;

function oneClick(e) {
  e.queryString = jQuery.queryString (e.href);

  // Get the donation level, so we can show/hide things based on it
  var donation = e.queryString.amount;

	// Multiply up the donation amount if it's a preset recurring amount
  if (e.queryString.recur) { donation = donation * 12; }

  (donation > 25) ? $('#premiums').show() : $('#premiums').hide();
  (donation > 25) ? $("#giftCheck").val(["yes"]) : $("#giftCheck").val(["no"]);
  (donation > 25) ? $('#tshirtSize').show() : $('#tshirtSize').hide();

  if (e.queryString.recur == 1) {
    $("#recur_annual").attr("checked", "checked"); 
  } else if (e.queryString.recur == 2) {
    $("#recur_annual").attr("checked", ""); 
    $("#recur_infinite").attr("checked", "checked");
  } else {
    $("#recur_annual").attr("checked", ""); 
    $("#recur_infinite").attr("checked", ""); 
  }
  
  if (donation >= 100) {
    if (e.queryString.recur) {
      recurringAmount = e.queryString.amount;
    } else {
      recurringAmount = parseFloat(donation / 12).toFixed(2);
    }

    // Fill in the popup's spans with the monthly amount
    $(".recurringAmount").html(recurringAmount);
    
    $("#recurring").show();
  } else {
    $("#recurring").hide();
  }
  
  $("#shirtError").html("");
 
  // Handle displaying PCP related things
  if (e.queryString.pcpid) {
	$("#pcpHonorRoll").show();
  	$("#pcp").show();
  } else {
	$("#pcpHonorRoll").hide();
    $("#pcp").hide();
  }
  $(":checkbox[name=optout]").each(function() { this.checked = true; });

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
        queryString.premium = 1;
        
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

      // Select all the checked checkboxes with the name 'optout', add their value to an array.
      var optout = new Array();
      $(":checkbox[name=optout]").each(function() { 
        // We only want to know if the checkbox has been unchecked, thus conciously opting out.
        if (!this.checked) {
          optout.push(this.value); 
        }
      });

      if (optout.length) queryString.optout = optout.join(":");
              
      e.href = jQuery.queryString(e.href, queryString);
      //console.log(e.href);

      $(this).dialog("close"); 
      location.href = e.href;
    }, "I've changed my mind": function() { $(this).dialog("close"); }}
  });
});
