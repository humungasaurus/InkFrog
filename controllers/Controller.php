<?php

class Controller{
	
	public function __construct(){
		
	}
	
	public function invoke(){
		
		if(!isset($_GET['controller'])){
			
			//no controller selected, just show the homepage
			include('views/templates/header.php');
			include('views/home.view.php');
			include('views/templates/footer.php');
			
		}elseif($_GET['controller'] == 'quote'){
			
			//start generating the quoting tool
			//first, see what operation was requested
			if(!isset($_GET['method']) || $_GET['method'] == 'create'){
				
				//no specific operation was requested, or the quote form was requested
				include('views/templates/header.php');
				include('views/quote/form.view.php');
				include('views/templates/footer.php');
				
			}
			
		}
	}
}

?>