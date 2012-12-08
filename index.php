<?php

//prints variables from url, for debugging
/*if(isset($_GET['controller'])){
	echo $_GET['controller'] . '<br />';
	
	if(isset($_GET['method'])){
		echo $_GET['method'] . '<br />';
		if(isset($_GET['arg'])){
			echo $_GET['arg'] . '<br />';
		}else{
			echo 'no args...<br />';
		}
	}else{
		echo 'no method...<br />';
	}
	
}else{
	echo 'no params...<br />';
}*/

include_once("controllers/Controller.php");

//invoke the controller
$controller = new Controller();
$controller->invoke();

?>