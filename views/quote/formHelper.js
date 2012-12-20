//globals
var shirtTypes = [];
var numFrontColors, numBackColors, numSleeveColors;
var selectedShirtType, selectedShirtColor;

$(document).ready(function(){

	//load the Shirt Type options
	loadShirtTypes();
	
	//update the Shirt Color dropdown based on Shirt Type selection
	$('#shirt_type').change(function() {
		loadShirtColors($('#shirt_type').val());
		loadShirtAddons($('#shirt_type').val());
	});

});

function loadShirtAddons(shirtTypeId){
	
	var url = '../models/quote/getShirtAddons.php?shirtTypeId=' + shirtTypeId;
	$.getJSON(
		url,
		function(data){
			
			$('#shirt_addon_container').empty();
			
			if(JSON.stringify(data) != "[]"){
				
				for(var i=0; i<data.length; i++){
		
					$('#shirt_addon_container').append('<div id="shirt_addon_' + data[i].ADDON_DESC + '_container" class="form-field-container">' 
						+ '<label for="shirt_addon_' + data[i].ADDON_DESC + '" id="shirt_addon_' + data[i].ADDON_DESC + '_label">' 
						+ data[i].ADDON_DESC 
						+ '</label>'
						+ '<div class="styled_select"'
						+ '<select id="' + data[i].ADDON_DESC + '_addon" name="' + data[i].ADDON_DESC + '_addon"></select>'
						+ '</div></div>');
					
					if(data[i].HAS_CHILD == 'Y'){
						
					}else{
						
						$('#' + data[i].ADDON_DESC + '_addon').append(
							'<option value="0">no</option>'
							+ '<option value="1">yes</option>'
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
	if(validateForm()){
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
			
			$.getJSON(
				url,
				function(data){

					$('#quote_value_container ul').empty();
					
					//figure out the lowest quote
					var lowestQuote = data[0][2]; 
					for(var i=1; i<data.length; i++){
						if(data[i][2] < lowestQuote){
							lowestQuote = data[i][2];
						}
					}
					
					var unitPrice = parseFloat(lowestQuote/$('#quantity').val());
					unitPrice = unitPrice.toFixed(2);
					
					$('#quote_value_container ul').append("<li><strong>Total Cost: $</strong>" + lowestQuote + " ($" + unitPrice + " per shirt)</li>");
					
					/*for(var i=0; i<data.length; i++){
						$('#quote_value_container ul').append("<li><strong>" + data[i][1] + ":</strong> $" + data[i][2] + "</li>");
					}*/
														
			});
	}
	
	return false;	
}
function resetForm()
{
	document.getElementById("quote_form").reset();
}