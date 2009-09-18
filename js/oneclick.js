
function oneClick(e) {
  // Get the donation level, so we can show/hide things based on it
  var donation = e.href.split("?")[1].split("=")[1].split("&")[0];

  (donation > 25) ? $('#premiums').show() : $('#premiums').hide();
  (donation > 25) ? $("#giftCheck").val(["yes"]) : $("#giftCheck").val(["no"]);
  (donation > 25) ? $('#tshirtSize').show() : $('#tshirtSize').hide();

  if ($(e).hasClass("split")) {
    $("#recur_annual").attr("checked", "checked"); 
  } else {
    $("#recur_annual").attr("checked", ""); 
    $("#recur_infinite").attr("checked", ""); 
  }
  
  if (donation >= 100) {
    var recurringAmount = donation / 12;
    
    // Fill in the popup's spans with the monthly amount
    $(".recurringAmount").html(recurringAmount);
    
    $("#recurring").show();
  } else {
    $("#recurring").hide();
  }
  
  $("#shirtError").html("");
  
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
      
      // Reset the link href if it's been changed already, so we don't get a crazy 
      // stacked and repeating query string
      if (!e.originalHref) e.originalHref = e.href;
      e.href = e.originalHref;
     
      // Recurring donation options
      var recurring = $(':input[name=recur]:checked').val();
      if (recurring) {
        e.href += "&recur=" + recurring;
      }
 
      if ($("#reftCheck:checked").val() == "yes") {
        e.href += "&premium=1";
        
        // Validation
        // Can't continue if no shirt size is selected
        var shirtSize = $(":input[name=size]").val();
        if (shirtSize == "") {
          $("#shirtError").html("Please select a size!");
          return;
        }
        e.href += "&size=" + shirtSize;
      }
      
      // Select all the checked checkboxes with the name 'lists', add their value to an array.
      var groups = new Array();
      $(":checkbox[name=groups]:checked").each(function() { groups.push(this.value); });
      
      if (groups.length) {
        e.href += "&groups=" + groups.join(":");
      }
                
      //console.log(e.href);
      //$("#response").html(e.href);
      
      $(this).dialog("close"); 
      location.href = e.href;
    }, "I've changed my mind": function() { $(this).dialog("close"); }}
  });
});
