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

YAHOO.cc.help.selectDonation = function() {
	var query = parseQueryString();
	var donation = query['donation'][0];
	useAmountOther();
	document.getElementById('amount_other').value = donation;

// elements[2] - (elements[n].type == "text")
// i = 2; i++ while elements[i].type != "text" (while type == radio)

	var radios = Array();
	var i = 2;
	var form = document.Main.elements;
	do {
		radios.push(form[i]);
		i++;
	} while(form[i].type == 'radio');

	if (donation == '1000') { useAmountFixed(radios[0].value); }
	if (donation == '500') { useAmountFixed(radios[1].value); }
	if (donation == '250') { useAmountFixed(radios[2].value); }
	if (donation == '100') { useAmountFixed(radios[3].value); }
	if (donation == '50') { useAmountFixed(radios[4].value); }
	if (donation == '25') { useAmountFixed(radios[5].value); }

	if (query["split"]) {
		useAmountOther();
		document.getElementById('amount_other').value = Math.round((donation/12)*100)/100;

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

		document.getElementById('frequency_interval').value = 1;
		document.getElementById('frequency_unit').value = 'month';
		document.getElementById('installments').value = 12;
	}
  
}

if (location.href.substring("contribute/transact")) {
	YAHOO.util.Event.onDOMReady(YAHOO.cc.help.selectOption);
	YAHOO.util.Event.onDOMReady(YAHOO.cc.help.selectDonation);
}
