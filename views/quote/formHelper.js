//globals
var shirtTypes = [];
var numFrontColors, numBackColors, numSleeveColors;
var selectedShirtType, selectedShirtColor;
var hasAddonChild = false;

$(document).ready(function(){

	//load the Shirt Type options
	loadShirtTypes();
	
	//update the Shirt Color dropdown based on Shirt Type selection
	$('#shirt_type').change(function() {
		loadShirtColors($('#shirt_type').val());
		loadShirtAddons($('#shirt_type').val());
	});
	
	//formatting help for select lists
	$('.select').focus(function() {
	  $(this).parent().css('background-color', 'rgba(245, 245, 245, 1.00)');
	});
	$('.select').focusout(function() {
	  $(this).parent().css('background-color', 'rgba(245,245,245,.75)');
	});

});

function sendQuote(){
	
	getQuote();
	
	if(validateContactFields() || validateQuoteFields()){
		return;
	}else{
		
		url = '../models/quote/sendQuote.php?' 
			+ 'shirtModel=' + $('#shirt_type').val()
			+ '&shirtColor=' + $('#shirt_color').val()
			+ '&frontColors=' + $('#front_colors').val()
			+ '&backColors=' + $('#back_colors').val()
			+ '&sleeveColors=' + $('#sleeve_colors').val()
			+ '&quantity=' + $('#quantity').val()
			+ '&name=' + $('#name').val()
			+ '&email=' + $('#email').val()
			+ '&totalPrice=' + $('#total_price').html()
			+ '&unitPrice=' + $('#unit_price').html()
			+ '&printer=' + $('#lowest_printer_id').html();
			
		var childURL = '';
		var numAddons = 0;
		$('#shirt_addon_container select').each(function(index) {
			
			if($(this).val() != 0){
				childURL += '&addon_' + numAddons + '=' + $(this).val();
				numAddons ++;
			}
		});
		
		url += childURL;
		url += '&numAddons=' + numAddons;
		
		$.getJSON(
			url,
			function(data){
			}
		);
	}
}

function loadShirtAddons(shirtTypeId){
	
	var url = '../models/quote/getShirtAddons.php?shirtTypeId=' + shirtTypeId;
	$.getJSON(
		url,
		function(data){
			
			$('#shirt_addon_container').empty();
			
			if(JSON.stringify(data) != "[]"){
				
				for(var i=0; i<data.length; i++){
		
					$('#shirt_addon_container').append('<div id="shirt_addon_' + data[i].ADDON_ID + '_container" class="form-field-container">' 
						+ '<label for="shirt_addon_' + data[i].ADDON_ID + '" id="shirt_addon_' + data[i].ADDON_ID + '_label">' 
						+ data[i].ADDON_DESC
						+ '</label>'
						+ '<div class="styled-select">'
						+ '<select id="' + data[i].ADDON_ID + '_addon" name="' + data[i].ADDON_ID + '_addon" class="select"></select>'
						+ '</div></div>');
					
					if(data[i].HAS_CHILD == 'Y'){
						
						hasAddonChild = true;
						
						$('#' + data[i].ADDON_ID + '_addon').append(
							'<option value="0">No</option>'
						);
						
						for(var j=0; j<data[i].CHILDREN.length; j++){
							$('#' + data[i].ADDON_ID + '_addon').append(
								'<option value="' + data[i].CHILDREN[j].ADDON_ID + '">' + data[i].CHILDREN[j].ADDON_DESC + '</option>'
							);
						}
						
					}else{
						
						hasAddonChild= false;
						
						$('#' + data[i].ADDON_ID + '_addon').append(
							'<option value="0">No</option>'
							+ '<option value="' + data[i].ADDON_ID + '">Yes</option>'
						);
					}
				}
				$('#shirt_addon_container').css('display', 'block');
			}else{
				$('#shirt_addon_container').css('display', 'none');
			}
	});
}

function loadShirtTypes() {
	$.getJSON(
		'../models/quote/getShirtTypes.php',
		function(data){

			//push data to array
			for(var i=0; i<data.length; i++){
				var tmp = [];
				tmp.push(data[i].SHIRT_TYPE_ID);
				tmp.push(data[i].SHIRT_TYPE_DESC);
				shirtTypes.push(tmp);	
			}

			//build the dropdown menu
			$('#shirt_type').append('<option value="0">- please select -</option>');
			for(var i=0; i<data.length; i++){
				$('#shirt_type').append('<option value="' + data[i].SHIRT_TYPE_ID + '">' + data[i].SHIRT_TYPE_DESC + '</option>');

			}
			
			//display the drop down
			$('#shirt_type_container').css('display', 'block');
		});
}

function loadShirtColors(shirtTypeId){
	
	//empty the current list
	$('#shirt_color').empty();
	
	var url = '../models/quote/getShirtColors.php?shirtTypeId=' + shirtTypeId;
	$.getJSON(
		url,
		function(data){

			//build the dropdown menu
			$('#shirt_color').append('<option value="0">- please select -</option');
			for(var i=0; i<data.length; i++){
				$('#shirt_color').append('<option value="' + data[i].COLOR_ID + '">' + data[i].COLOR_NM + '</option>');
			}
			
			//display the dropdown menu
			$('#shirt_color_container').css('display', 'block');									
		
	});
}

function getQuote(){
	
	//first check that all inputs are entered
	if(validateQuoteFields()){
		return;
	}else{
		
		//now we actually get to quote
		url = '../models/quote/getQuote.php?' 
			+ 'shirtModel=' + $('#shirt_type').val()
			+ '&shirtColor=' + $('#shirt_color').val()
			+ '&frontColors=' + $('#front_colors').val()
			+ '&backColors=' + $('#back_colors').val()
			+ '&sleeveColors=' + $('#sleeve_colors').val()
			+ '&quantity=' + $('#quantity').val();
			
		var childURL = '';
		var numAddons = 0;
		$('#shirt_addon_container select').each(function(index) {
			
			if($(this).val() != 0){
				childURL += '&addon_' + numAddons + '=' + $(this).val();
				numAddons ++;
			}
		});
		
		url += childURL;
		url += '&numAddons=' + numAddons;
		
		$.getJSON(
			url,
			function(data){

				$('#quote_value_container ul').empty();
					
				//figure out the lowest quote
				var lowestQuote = data[0][2];
				var lowestPrinterId = data[0][0]; 
				for(var i=1; i<data.length; i++){
					if(data[i][2] < lowestQuote){
						lowestQuote = data[i][2];
						lowestPrinterId = data[i][0];
					}
				}
				
				var unitPrice = parseFloat(lowestQuote/$('#quantity').val());
				lowestQuote = lowestQuote.toFixed(2);
				unitPrice = unitPrice.toFixed(2);
				
				$('#quote_value_container ul').append("<li><strong>Total Cost: $</strong><span id='total_price'>" + lowestQuote + "</span> ($<span id='unit_price'>" + unitPrice + "</span> per shirt)</li>");
				$('#quote_value_container').append('<div id="lowest_printer_id" style="display:none;">' + lowestPrinterId + '</div>');
				/*for(var i=0; i<data.length; i++){
					$('#quote_value_container ul').append("<li><strong>" + data[i][1] + ":</strong> $" + data[i][2] + "</li>");
				}*/
			});
	}
	
	//ask if we should send this quote in an email
	$('#quote_mailer_container').css('display', 'block');
	
	return false;	
}
function resetForm()
{
	document.getElementById("quote_form").reset();
}