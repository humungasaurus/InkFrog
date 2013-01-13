$(document).ready(function(){

	loadImages();

});

function loadImages(){
	
	var url = '../models/portfolio/getImages.php';
	var img_url = '../views/assets/content_images/portfolio/';
	var img_small_url = '../views/assets/content_images/portfolio/portfolio_small/';
	
	$.getJSON(
		url,
		function(data){
			
			$(".fade-in").bind("load", function () { $(this).fadeIn(); });
			
			for(var i=0; i<data.length; i++){
				
				if(i<6){
					$('#portfolio_images').append('<a href="' + img_url + data[i] + '" class="lightbox fade-in"><img src="' + img_small_url + data[i] + '" width="320px" height="320px"></a>' );
				}else{
					$('#portfolio_images').append('<a href="' + img_url + data[i] + '" class="lightbox"><img src="../views/assets/images/helper.png" data-original="' + img_small_url + data[i] + '" class="lazy" width="320px" height="320px"></a>' );
				}
			}
		
			$("img.lazy").lazyload({
				effect : "fadeIn"
			});
			$('a.lightbox').lightBox();
		}
	);
}