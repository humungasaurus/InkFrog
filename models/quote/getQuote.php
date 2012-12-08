<?php

include_once('../utilities/db_conn.php');

//variable to hold the quotes
$quotes = array();

//ESTABLISH BASE COUNTS
$sql = "SELECT DISTINCT PRINTER_ID, PRINTER_NM FROM D_PRINTER";
$result = mysql_query($sql);
if(!result){
	die('Invalid query: ' . mysql.error());
}

while($r = mysql_fetch_assoc($result)){
    $tmp = array();

	array_push($tmp, $r['PRINTER_ID']);
	array_push($tmp, $r['PRINTER_NM']);
	
	if(isset($_GET[quantity])){
		array_push($tmp, $_GET['quantity']);
	}else{
		array_push($tmp, 1);
	}
	
	array_push($quotes, $tmp);
}
//BASE COUNTS ESTABLISHED

//ADD PRICING FOR BLANKS
$sql = sprintf("SELECT PRICE_LEVEL FROM D_COLOR WHERE COLOR_ID=%s", 
	mysql_real_escape_string($_GET['shirtColor']));
	
$result = mysql_query($sql);
if(!result){
	die('Invalid query: ' . mysql.error());
}

$colorPriceLevel = 0;
while($r = mysql_fetch_assoc($result)){
	$colorPriceLevel = $r['PRICE_LEVEL'];
}

$sql = sprintf("SELECT UNIT_PRICE FROM F_SHIRT_MODEL_PRICING WHERE MODEL_ID=%s AND PRICE_LEVEL=%s", 
	mysql_real_escape_string($_GET['shirtModel']),
	mysql_real_escape_string($colorPriceLevel));
	
$result = mysql_query($sql);
if(!result){
	die('Invalid query: ' . mysql.error());
}

$blankPrice = 0;
while($r = mysql_fetch_assoc($result)){
	$blankPrice = $r['UNIT_PRICE'];
}

foreach($quotes as &$q){
	$q[2] = $q[2] * $blankPrice;
}
//BLANK PRICE ESTABLISHED

//ADD PRICING FOR BASE PRINT COST
$sql = sprintf("SELECT PRINTER_ID, UNIT_PRICE FROM F_PRINTER_PRICING WHERE MIN_CNT<=%s AND MAX_CNT>=%s",
	mysql_real_escape_string($_GET['quantity']),
	mysql_real_escape_string($_GET['quantity']));

$result = mysql_query($sql);
if(!result){
	die('Invalid query: ' . mysql.error());
}

while($r = mysql_fetch_assoc($result)){
	
	//add the print cost
	foreach($quotes as &$q){
		if($q[0] == $r['PRINTER_ID']){
			
			//check the print locations
			$printLocaitons = 0;
			if($_GET['frontColors']>0) $printLocations+=1;
			if($_GET['backColors']>0) $printLocations+=1;
			if($_GET['sleeveColors']>0) $printLocations+=1;
			
			//add in the price
			$basePrintPrice = $_GET['quantity'] * ($r['UNIT_PRICE'] * $printLocations);
			$q[2] += $basePrintPrice;
			unset($printLocations);
		}
	}
}
//BASE PRINT COST ESTABLISHED

//ADD PRICING FOR EACH COLOR
$sql = sprintf("SELECT PRINTER_ID, UNIT_PRICE FROM F_COLOR_PRICING WHERE MIN_CNT<=%s AND MAX_CNT>=%s",
	mysql_real_escape_string($_GET['quantity']),
	mysql_real_escape_string($_GET['quantity']));
	
$result = mysql_query($sql);
if(!result){
	die('Invalid query: ' . mysql.error());
}

while($r = mysql_fetch_assoc($result)){
	
	//add the color cost
	foreach($quotes as &$q){
		if($q[0] == $r['PRINTER_ID']){
			
			//get the number of colors
			$numColors = $_GET['frontColors'] + $_GET['backColors'] + $_GET['sleeveColors'];
			
			//add in the price 
			$colorPrintPrice = $_GET['quantity'] * ($r['UNIT_PRICE'] * $numColors);
			$q[2] += $colorPrintPrice;
			
		}
	}
	
}


print json_encode($quotes);

?>