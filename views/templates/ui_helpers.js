$(document).ready(function(){

	$('#footer a').hover(function(){
		
		$(this).animate({
			opacity: ".7"
		},
		500);
	}, function(){
		
		$(this).animate({
			opacity: ".25"
		},
		500);
	});
	
	$('#navigation-inner ul li').hover(function(){
		
		$(this).animate({
			opacity: ".8"
		},
		500);
	}, function(){
		
		$(this).animate({
			opacity: "1"
		},
		500);
	});
	
	$('button').mouseover(function(){
		$(this).animate({opacity: .8}, 200);
	});

	$('button').mouseout(function(){
		$(this).animate({opacity: 1}, 200);
	});
	
	$('button').mousedown(function(){
		$(this).css('border', '1px solid rgba(50,50,50,.25)');
	});
	
	$('button').mouseup(function(){
		$(this).css('border', '1px solid #ddd');
	});
	
	$('#navigation-inner ul li').mousedown(function(){
		$(this).css('border', '1px solid rgba(50,50,50,.25)');
	});
	
	$('#navigation-inner ul li').mouseup(function(){
		$(this).css('border', '1px solid rgba(240,240,240,.25)');
	});
	
	$('.submit').mouseover(function(){
		$(this).animate({opacity: .8}, 200);
	});

	$('.submit').mouseout(function(){
		$(this).animate({opacity: 1}, 200);
	});
	
	$('.submit').mousedown(function(){
		$(this).css('border', '1px solid rgba(50,50,50,.25)');
	})
	
	$('.submit').mouseup(function(){
		$(this).css('border', '1px solid #ddd');
	})
	
});

function sendEmailAddress(){
	
	console.log('in function');
	
	if($('#mailing_email').val() && isValidEmailAddress($('#mailing_email').val())){
		
		var url = '../models/mailing_list/sendEmail.php?emailAddress=' + $('#mailing_email').val();
		
		$.getJSON(
			url,
			function(data){
				
				if(data){
					
					$('#join_mailing_list').empty();
					$('#join_mailing_list').append('Thanks for joining!');
					$('#join_mailing_list').css('padding-top', '8px');
					
				}else{
					return;
				}
			}
		);
		
	}else{
		return;
	}
	
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};