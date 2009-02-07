YAHOO.namespace("cc.help");

// convenience function for creating help tool tips
YAHOO.cc.help.init_help_item = function(help_anchor) { 

    var link_id = help_anchor.id;
    var help_id = 'help_' + link_id;

    // make sure we have an array to hold the list of panels
    if (!YAHOO.cc.help.help_panels) {
			YAHOO.cc.help.help_panels = new Array();
    }

    // create the new panel and position it
    var new_panel = new YAHOO.widget.Panel(help_id, 
                            {close: true, 
			   visible: false, 
			   draggable: false, 
			   width: "30em",
				effect: {effect:YAHOO.widget.ContainerEffect.FADE,duration:0.125},
			   context: [help_anchor/*.childNodes[3]*/,'tl','tr']
			    } ); 

    var item_idx = YAHOO.cc.help.help_panels.push(new_panel) - 1;

    YAHOO.cc.help.help_panels[item_idx].render();

	// hideTimeout code adapted from http://jqueryfordesigners.com/coda-popup-bubbles/
	var hideDelay = 250;
	var hideTimeout = null;
	
	
   // connect the event handlers
	function showPanel(e) {
		if (hideTimeout) clearTimeout(hideTimeout);

	   YAHOO.cc.help.help_panels[item_idx].show();
	
		YAHOO.util.Event.preventDefault(e);	   
	}
	
	function hidePanel(e) {
		if (hideTimeout) clearTimeout(hideTimeout);
						
		hideTimeout = setTimeout(function() {
			hideTimeout = null;
							
		 	YAHOO.cc.help.help_panels[item_idx].hide();
		   
			YAHOO.util.Event.preventDefault(e);			
		}, hideDelay);
						
	}
	
   YAHOO.util.Event.addListener(link_id, "mouseover", showPanel);
	YAHOO.util.Event.addListener(link_id, "mouseout", hidePanel);
	
	YAHOO.util.Event.addListener(help_id, "mouseover", showPanel);
	YAHOO.util.Event.addListener(help_id, "mouseout", hidePanel);
		
} // init_help_text

YAHOO.cc.help.init = function() {
    // initialization for help pop-ups

    YAHOO.util.Dom.getElementsByClassName('helpLink', 'td', 'content',
				     YAHOO.cc.help.init_help_item);
   
} // init

YAHOO.util.Event.onDOMReady(YAHOO.cc.help.init);


var levels = new Array(25, 50, 100, 250, 500, 1000);
var custom_payments = 100; /* minimum $ amount for monthly payments */

YAHOO.util.Event.addListener("donation", "keyup",
			function(e) {
				var value = document.getElementById("donation").value;
				var active_gifts = new Array();
				
				var split_custom = document.getElementById("split-custom");
				if (value >= custom_payments) {
					split_custom.disabled = false;
					split_custom.parentNode.style.opacity = 1;
				} else {
					split_custom.disabled = true;
					split_custom.parentNode.style.opacity = 0.5;
				}

				for (var i = 0; i < levels.length; i++) {
					if (value >= levels[i]) {
						document.getElementById(levels[i]).style.opacity = 1;
					} else {
						document.getElementById(levels[i]).style.opacity = 0.25;
					}
				}
			});

 function parseQueryString(_1){var 
_2={};if(_1==undefined){_1=location.search?location.search:"";}if(_1.charAt(0)=="?"){_1=_1.substring(1);}_1=_1.replace("+"," ");var 
_3=_1.split(/[&;]/g);for(var i=0;i<_3.length;i++){var _5=_3[i].split("=");var _6=decodeURIComponent(_5[0]);var 
_7=decodeURIComponent(_5[1]);if(!_2[_6]){_2[_6]=[];}_2[_6].push((_5.length==1)?"":_7);}return _2;}
	 
YAHOO.cc.help.selectOption = function() {
   var query = parseQueryString();
	   
   if (!query['size']) { return; }
   var shirtSize = query['size'][0]
     
   // get the <select> tag containing shirt size options
   var premium = document.getElementById('product-options').getElementsByTagName('select')[0]; 
   var options = premium.options;
  	 
   for (var i = 0; i < options.length; i++) {
  	   if (options[i].value == shirtSize) {
  	     options[i].selected = true;
  	     break;
  	   }
  }

  selectPremium(premium);
}

function useAmountFixed(fixedamount) {
  clearAmountOther();
  for( i=0; i < document.Main.elements.length; i++) {
    element = document.Main.elements[i];
    if (element.type == 'radio' && element.name == 'amount') {
      if (element.value == fixedamount ) {
        element.checked = true;
      } else {
        element.checked = false;
      }
    }
  }
}

/**
 * This will automatically check the appropriate radio button
 * for the right premium when a user is on the contribution
 * page. BE WARNED, that like the function that checks the
 * right donation amount that this relies on database ID that
 * can and will change as the database gets updated or changed.
 */
function setPremium(premiumId) {
    var premiums = document.getElementsByName("selectProduct");
    for( i=0; i < premiums.length; i++) {
        if ( premiums[i].value == premiumId ) { 
            premiums[i].checked = true;
        }
    }
}

YAHOO.cc.help.selectDonation = function() {
	var query = parseQueryString();
	var donation = query['donation'][0];
	
	useAmountOther();
	document.getElementById('amount_other').value = donation;

	if ((query['id'][0] == '15') && (!query['split'])) { return; }

	var radios = Array();
	var i = 2;
	var form = document.Main.elements;
	do {
		radios.push(form[i]);
		i++;
	} while(form[i].type == 'radio');


	if (donation == '1000') {
		if ( ! query['split'] ) {
			useAmountFixed(radios[0].value);
		}
		setPremium(19);
	}
	if (donation == '500') {
		if ( ! query['split'] ) {
			useAmountFixed(radios[1].value);
		}
		setPremium(17);
	}
	if (donation == '250') {
		if ( ! query['split'] ) {
			useAmountFixed(radios[2].value);
		}
		setPremium(18);
	}
	if (donation == '100') {
		if ( ! query['split'] ) {
			useAmountFixed(radios[3].value);
		}
		setPremium(2);
	}
	if (donation == '50') {
		if ( ! query['split'] ) {
			useAmountFixed(radios[4].value);
		}
		setPremium(1);
	}
//	if (donation == '25') { useAmountFixed(radios[5].value); }

	if (query["split"]) {
		useAmountOther();

		split_value = Math.round((donation/12)*100)/100;
		document.getElementById('amount_other').value = split_value.toFixed(2);

		for( i=0; i < document.Main.elements.length; i++) {
			element = document.Main.elements[i];
			if (element.type == 'radio' && element.name == 'is_recur') {
				if (element.value == 1 ) {
					element.checked = true;
				} else {
					element.checked = false;
				}
			}
		}
	}
	document.getElementById('frequency_interval').value = 1;
	document.getElementById('frequency_unit').value = 'month';
	document.getElementById('installments').value = 12;
	
  
}

if (location.href.substring("contribute/transact")) {
	YAHOO.util.Event.onDOMReady(YAHOO.cc.help.selectOption);
	YAHOO.util.Event.onDOMReady(YAHOO.cc.help.selectDonation);
}

function is_recurring() {
    if ( document.getElementById('split-custom').checked == true ) {
        document.getElementById('id').value = '15';
    } else {
        document.getElementById('id').value = '1';
    }
}


/**
 * This will automatically update the the total amount listed for
 * the recurring contribution if the user changes the value in the
 * amount_other text box.
 */
YAHOO.util.Event.addListener("amount_other", "keyup",
        function(e) {
                var value = document.getElementById("amount_other").value;
                var fld_ttl = document.getElementById("cc_total_amt");
                if ( ! value.NaN && value > 0 ) {
                        var new_ttl = value*12;
                        fld_ttl.innerHTML = new_ttl.toFixed(2);
                } else {
                        fld_ttl.innerHTML = "<<span style='color: red'>0</span>>";
                }
        });


/**
 * This gets triggered when a user selects the open-ended recurring
 * contribution option.  It simply adds an onsubmit attribute to the form.  If
 * the user never clicks this button then we don't care about calculating 
 * anything because the defaults will always be okay.
 */
function set_form_onsubmit() {
        document.getElementById("Main").setAttribute('onsubmit', 'set_installments();');
}

/**
 * This function should get run when the contribution form is submitted
 * and if the user had selected an open-ended recurring contriubtion
 * then it will set the installments accordingly, else installments are
 * set to 12.
 */
function set_installments() {
        if ( document.getElementById("open-ended").checked == true ) {
                document.getElementById("installments").value = '';
        } else {
                document.getElementById("installments").value = '12';
        }
}
