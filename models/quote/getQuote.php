<?php

include_once('../utilities/db_conn.php');

//variable to hold the quotes
$quotes = array();

//ESTABLISH BASE COUNTS
$sql = "SELECT DISTINCT PRINTER_ID, PRINTER_NM FROM D_PRINTER";
$result = mysql_query($sql);
if(!$result){
	die('Invalid query: ' . mysql.error());
}

while($r = mysql_fetch_assoc($result)){
    $tmp = array();

	array_push($tmp, $r['PRINTER_ID']);
	array_push($tmp, $r['PRINTER_NM']);
	
	if(isset($_GET['quantity'])){
		array_push($tmp, $_GET['quantity']);
	}else{
		array_push($tmp, 1);
	}
	
	array_push($quotes, $tmp);
	
}

//print quantities for debugging
/*foreach($quotes as $q){
	echo 'Printer: ' . $q[1] . ', Quantity: ' . $q[2] . '<br />';
}
echo '<br />';*/
//BASE COUNTS ESTABLISHED

//ADD PRICING FOR BLANKS
$sql = sprintf("SELECT PRICE_LEVEL FROM D_COLOR WHERE COLOR_ID=%s", 
	mysql_real_escape_string($_GET['shirtColor']));
	
$result = mysql_query($sql);
if(!$result){
	die('Invalid query: ' . mysql.error());
}

$colorPriceLevel = 0;
while($r = mysql_fetch_assoc($result)){
	$colorPriceLevel = $r['PRICE_LEVEL'];
}

//debugging
//echo 'Color Price Level: ' . $colorPriceLevel . '<br /><br />';

$sql = sprintf("SELECT MAX(MODEL_ID) AS MODEL_ID FROM M_TYPE_MODEL WHERE SHIRT_TYPE_ID = %s",
	mysql_real_escape_string($_GET['shirtModel']));
	
$result = mysql_query($sql);
if(!$result){
	die('Invalid query: ' . mysql.error());
}
while($r = mysql_fetch_assoc($result)){
	$shirtType = $r['MODEL_ID'];
}

$sql = sprintf("SELECT UNIT_PRICE FROM F_SHIRT_MODEL_PRICING WHERE MODEL_ID=%s AND PRICE_LEVEL=%s", 
	mysql_real_escape_string($shirtType),
	mysql_real_escape_string($colorPriceLevel));
	
$result = mysql_query($sql);
if(!$result){
	die('Invalid query: ' . mysql.error());
}

$blankPrice = 0;
while($r = mysql_fetch_assoc($result)){
	$blankPrice = $r['UNIT_PRICE'];
}

//debugging
//echo 'Blank Cost: ' . $blankPrice . '<br /><br />';

//this actually adds the blank price; result should be total cost of blanks
foreach($quotes as &$q){
	$q[2] = $q[2] * $blankPrice;
}

//print the blank costs for debugging
/*foreach($quotes as $q){
	echo 'Printer: ' . $q[1] . ', Blank Cost: ' . $q[2] . '<br />';
}
echo '<br />';*/

//BLANK PRICE ESTABLISHED

//ADD PRICING FOR BASE PRINT COST
$sql = sprintf("SELECT PRINTER_ID, UNIT_PRICE FROM F_PRINTER_PRICING WHERE MIN_CNT<=%s AND MAX_CNT>=%s",
	mysql_real_escape_string($_GET['quantity']),
	mysql_real_escape_string($_GET['quantity']));

$result = mysql_query($sql);
if(!$result){
	die('Invalid query: ' . mysql.error());
}

while($r = mysql_fetch_assoc($result)){
	
	//add the print cost
	foreach($quotes as &$q){
		if($q[0] == $r['PRINTER_ID']){
			
			//check the print locations
			$printLocations = 0;
			if($_GET['frontColors']>0) $printLocations+=1;
			if($_GET['backColors']>0) $printLocations+=1;
			if($_GET['sleeveColors']>0) $printLocations+=1;
			
			//debugging
			//echo 'Printer: ' . $q[1];
			//echo ', Print Locations: ' . $printLocations;
			//echo ', Unit Print Cost: ' . $r['UNIT_PRICE'];
			
			//add in the price
			$basePrintPrice = $_GET['quantity'] * ($r['UNIT_PRICE'] * $printLocations);
			
			//debugging
			//echo ', Print Cost: ' . $basePrintPrice . '<br />';
			
			$q[2] += $basePrintPrice;
			unset($printLocations);
		}
	}
}

//print the new costs with print pricing for debugging
/*echo '<br />';
foreach($quotes as $q){
	echo 'Printer: ' . $q[1] . ', Blanks + Print: ' . $q[2] . '<br />';
}
echo '<br />';*/

//BASE PRINT COST ESTABLISHED

//ADD PRICING FOR EACH COLOR
$sql = sprintf("SELECT PRINTER_ID, UNIT_PRICE FROM F_COLOR_PRICING WHERE MIN_CNT<=%s AND MAX_CNT>=%s",
	mysql_real_escape_string($_GET['quantity']),
	mysql_real_escape_string($_GET['quantity']));
	
$result = mysql_query($sql);
if(!$result){
	die('Invalid query: ' . mysql.error());
}

while($r = mysql_fetch_assoc($result)){
	
	//add the color cost
	foreach($quotes as &$q){
		if($q[0] == $r['PRINTER_ID']){
			
			//get the number of additional colors
			$numColors = 0;
			if($_GET['frontColors'] > 1)
				$numColors += $_GET['frontColors'] - 1;
			if($_GET['backColors'] > 1)
				$numColors += $_GET['backColors'] - 1;
			if($_GET['sleeveColors'] > 1)
				$numColors += $_GET['backColors'] - 1;
			
			//add in the price 
			$colorPrintPrice = $_GET['quantity'] * ($r['UNIT_PRICE'] * $numColors);
			$q[2] += $colorPrintPrice;
			
			//debugging
			//echo 'Printer: ' . $q[1] . ', Additional Color Price: ' . $colorPrintPrice . '<br />';
			
			unset($numColors);
			unset($colorPrintPrice);
			
		}
	}
	
}

//ADD IN ADDONS
if($_GET['numAddons'] > 0){
	
	for($i=0; $i<$_GET['numAddons']; $i++){
		
		if($_GET['addon_' . $i]){
			$sql = sprintf("SELECT UNIT_PRICE, PARENT_ID FROM F_ADDON WHERE ADDON_ID='%s'",
				mysql_real_escape_string($_GET['addon_' . $i]));

			$result = mysql_query($sql);
			if(!$result){
				die('Invalid query: ' . mysql.error());
			}

			while($r = mysql_fetch_assoc($result)){

				if($r['PARENT_ID']){

					$sql2 = sprintf("SELECT UNIT_PRICE FROM F_ADDON WHERE ADDON_ID='%s'",
						mysql_real_escape_string($r['PARENT_ID']));

					$result2 = mysql_query($sql2);
					if(!$result2){
						die('Invalid query: ' . mysql.error());
					}

					while($s = mysql_fetch_assoc($result2)){
						$parentPrice = $s['UNIT_PRICE'];
					}


					foreach($quotes as &$q){
						$q[2] += $parentPrice * $_GET['quantity'];
					}

				}else{
				}

				foreach($quotes as &$q){
					$q[2] += $r['UNIT_PRICE'] * $_GET['quantity'];
				}
			}
		}
	}
}

print json_encode($quotes);

?>