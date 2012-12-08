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
	});

});

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
		console.log("inputs not valid");
		return;
	}else{
		console.log("inputs valid");
		
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

					$('#quote_value_container').empty();
					$('#quote_value_container').append("<ul>");	
					
					for(var i=0; i<data.length; i++){
						$('#quote_value_container').append("<li><strong>" + data[i][1] + ":</strong> $" + data[i][2] + "</li>");
					}
													
					$('#quote_value_container').append("</ul>");	
			});
	}
	
	
	
}