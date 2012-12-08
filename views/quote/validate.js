function validateForm(){
	
	//check to see if each field is populated correctly
	var hasErrors = false;
	
	//check the quantity field
	var data = $('#quantity').val();
	var c;
	for(var i=0; i<data.length; i++){
		c = data.charAt(i).charCodeAt(0);
		if(c<48 || c>57){
			$('#quantity').val("please enter a number");
			$('#quantity').addClass("error");
			hasErrors = true;				
		}else if($('#quantity').val() < 12){
			$('#quantity').val("the minimum quantity is 12");
			$('#quantity').addClass("error");
			hasErrors = true;
		}else{
			if($('#quantity').hasClass('error')){
				$('#quantity').removeClass('error');
			} 
		}
	}
				
	//check color count
	data = $('#front_colors').val();
	for(var i=0; i<data.length; i++){
		c = data.charAt(i).charCodeAt(0);
		if(c<48 || c>57){
			$('#front_colors').val("please enter a number");
			$('#front_colors').addClass("error");
			hasErrors = true;				
		}else{
			if($('#front_colors').hasClass('error')){
				$('#front_colors').removeClass('error');
			} 
		}
	}
	
	data = $('#back_colors').val();
	for(var i=0; i<data.length; i++){
		c = data.charAt(i).charCodeAt(0);
		if(c<48 || c>57){
			$('#back_colors').val("please enter a number");
			$('#back_colors').addClass("error");
			hasErrors = true;				
		}else{
			if($('#back_colors').hasClass('error')){
				$('#back_colors').removeClass('error');
			} 
		}
	}
	
	data = $('#sleeve_colors').val();
	for(var i=0; i<data.length; i++){
		c = data.charAt(i).charCodeAt(0);
		if(c<48 || c>57){
			$('#sleeve_colors').val("please enter a number");
			$('#sleeve_colors').addClass("error");
			hasErrors = true;				
		}else{
			if($('#sleeve_colors').hasClass('error')){
				$('#sleeve_colors').removeClass('error');
			} 
		}
	}
	
	//check the dropdowns
	if($('#shirt_type').val() == "0"){
		hasErrors = true;
		$('#shirt_type').addClass('error');
	}else{
		if($('#shirt_type').hasClass('error')){
			$('#shirt_type').removeClass('error');
		}
	}
	
	if($('#shirt_color').val() == "0"){
		hasErrors = true;
		$('#shirt_color').addClass('error');
	}else{
		if($('#shirt_color').hasClass('error')){
			$('#shirt_color').removeClass('error');
		}
	}
	
	
	return hasErrors;
	
}