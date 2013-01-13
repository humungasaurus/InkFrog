<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<!--jQuery-->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	
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
	
	
	<!--Javascript UI Functions-->
	<script src="../views/templates/ui_helpers.js"></script>
	<?php
	
	//include scripts as specified by the current controller
	if(isset($_GET['controller']) && $_GET['controller'] == 'quote'){
		
		//include the validation script
		?>
		<script src="../views/quote/formHelper.js"></script> 
		<script src="../views/quote/validate.js"></script>
		<?php
	
	}else if(isset($_GET['controller']) && $_GET['controller'] == 'portfolio'){
		?>
		<script src="../views/portfolio/jquery.lazyload.js"></script>
		<script src="../views/portfolio/jquery-lightbox/js/jquery.lightbox-0.5.min.js"></script>
		<script src="../views/portfolio/portfolioHelper.js"></script> 
		<link rel="stylesheet" type="text/css" href="../views/portfolio/jquery-lightbox/css/jquery.lightbox-0.5.css" media="screen" />
		<?php
	}
	
	?>
	
</head>
<body>
	
	<div id="wrap">
	
		<div id="main">
				
			<div id="header_wrapper"><div id="header_inner" class="">
			
				<div id="logo">
					<a href='/'><img src="../views/assets/images/sbpress-logo.png" id="logo_img" alt="sb press"/></a>
				</div>
				
				<div id="navigation" ><div id="navigation-inner" class="rounded-corners shadow">
					<ul>
						<li class="first"><a href="/quote/create">Get a Quote</a></li>
						<li class=""><a href="">What We Do</a></li>
						<li class=""><a href="/portfolio/all">Examples of Past Work</a></li>
						<li class="last"><a href="#">Contact Us</a></li>
					</ul>
				</div></div>
			
			</div></div>
			<div id="content">

