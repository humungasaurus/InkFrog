<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	
	<!--stylesheets-->
	<link href="../views/css/reset.css" rel="stylesheet" type="text/css">
	<link href="../views/css/screen.css" rel="stylesheet" type="text/css">
	
	<!--[if !IE 7]>
		<style type="text/css">
			#wrap {display:table;height:100%}
		</style>
	<![endif]-->
	
	<!--import font face-->
	<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,600' rel='stylesheet' type='text/css'>
	
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
	
	<div id="wrap">
	
		<div id="main">
				
			<div id="header_wrapper"><div id="header_inner" class="">
			
				<div id="logo">
					<h2>InkFrog</h2>
				</div>
				
				<div id="navigation" ><div id="navigation-inner" class="rounded-corners shadow">
					<ul>
						<li class="first"><a href="#">Get a Quote</a></li>
						<li><a href="#">What We Do</a></li>
						<li class="last"><a href="#">Examples of Past Work</a></li>
					</ul>
				</div></div>
			
			</div></div>
			<div id="content">

