function validateContactFields(){
	var hasErrors = false;
	var nameErrors = false;
	var emailErrors = false;
	
	//check the name field
	var data = $('#name').val();
	var c;
	
	if((!$('#name').val()) || ($('#name').val() == "please enter your name")){
		$('#name').val("please enter your name");
		$('#name').addClass("error");
		hasErrors = true;
		nameErrors = true;
	}
	
	for(var i=0; i<data.length; i++){
		c = data.charAt(i).charCodeAt(0);
		if(!((c==32) || (c>=65 && c<=90) || (c>=97 && c<=122))){
					$('#name').val("please enter your name");
					$('#name').addClass("error");
					hasErrors = true;
					nameErrors = true;
		}
			
	}
	if(!nameErrors){
		if($('#name').hasClass('error')){
			$('#name').removeClass('error');
		}
	}
	
	//check email address
	if(!$('#email').val()){
		$('#email').val("please enter your email address");
		$('#email').addClass("error");
		hasErrors = true;
		emailErrors = true;
	}
	
	if(!isValidEmailAddress($('#email').val())){
		$('#email').val("please enter your email address");
		$('#email').addClass("error");
		hasErrors = true;
		emailErrors = true;
	}
	if(!emailErrors){
		if($('#email').hasClass('error')){
			$('#email').removeClass('error');
		}
	}
	return hasErrors;
}

function validateQuoteFields(){
	
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
		}
	}
	
	if(!hasErrors){
		if($('#name').hasClass('error')){
			$('#name').removeClass('error');
		}
	}
	
	//make sure at least one print color is selected
	if(($('#front_colors').val() + $('#back_colors').val() + $('#sleeve_colors').val()) < 1){
		$('#front_colors').addClass("error");
		$('#back_colors').addClass("error");
		$('#sleeve_colors').addClass("error");
		hasErrors = true;
	}else{
		if($('#front_colors').hasClass("error"))
			$('#front_colors').removeClass("error");
		if($('#back_colors').hasClass("error"))
			$('#back_colors').removeClass("error");
		if($('#sleeve_colors').hasClass("error"))
			$('#sleeve_colors').removeClass("error");
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

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};