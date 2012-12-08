<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	
	<link href="../views/css/reset.css" rel="stylesheet" type="text/css">
	<link href="../views/css/screen.css" rel="stylesheet" type="text/css">
	
	<?php
	
	//include scripts as specified by the current controller
	if($_GET['controller'] = 'quote' && $_GET['method'] = 'create'){
		
		//include the validation script
		?>
		<script src="../views/quote/formHelper.js"></script> 
		<script src="../views/quote/validate.js"></script>
		<?php
	}
	
	?>
	
</head>
<body>
	<h1>InkFrog</h1>
