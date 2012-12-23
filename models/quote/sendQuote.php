<?php

	include_once('../utilities/db_conn.php');
	$path = get_include_path() . PATH_SEPARATOR . '/home/statusbrocom/pear/share/pear/';
	set_include_path($path);
	include('Mail.php');
	include('Mail/mime.php');
	
	$hasAddons = 'N';
	if($_GET['numAddons'] && $_GET['numAddons'] > 0){
		$hasAddons = 'Y';
	}
	
	$totalCost = (float) $_GET['totalPrice'];
	$unitCost = (float) $_GET['unitPrice'];
	
	$sql = sprintf("INSERT INTO F_QUOTES 
						(QUOTE_ID, NAME, EMAIL, 
						NUM_SHIRTS, NUM_FRONT_COLORS, NUM_BACK_COLORS, NUM_SLEEVE_COLORS, 
						SHIRT_TYPE_ID, COLOR_ID,
						PRINTER_ID, TOTAL_COST, UNIT_COST, HAS_ADDONS) 
					VALUES (NULL, '%s', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%f', '%f', '%s')",
			 	mysql_real_escape_string($_GET['name']),
				mysql_real_escape_string($_GET['email']),
				$_GET['quantity'],
				$_GET['frontColors'],
				$_GET['backColors'],
				$_GET['sleeveColors'],
				$_GET['shirtModel'],
				$_GET['shirtColor'],
				$_GET['printer'],
				$totalCost,
				$unitCost,
				$hasAddons);
	
	//insert main quote		
	if(mysql_query($sql)){
	
		$quoteId = mysql_insert_id();
	
		if($hasAddons == 'Y'){
			
			for($i=0; $i<$_GET['numAddons']; $i++){
				
				$sql = sprintf("INSERT INTO F_QUOTE_ADDONS (QUOTE_ID, ADDON_ID)
								VALUES (%d, %d)",
							$quoteId,
							$_GET['addon_' . $i]);
				//insert quote addons
				if(!mysql_query($sql)){
					die('Invalid query: ' . mysql.error());
				}
			}	
		}
		
		////////////////////////////////
		//NOTIFY SALES TEAM OF NEW QUOTE
		$sql = "SELECT F_QUOTES.QUOTE_ID, F_QUOTES.NAME, F_QUOTES.EMAIL,
					F_QUOTES.TOTAL_COST, F_QUOTES.UNIT_COST, F_QUOTES.NUM_SHIRTS,
					F_QUOTES.NUM_FRONT_COLORS, F_QUOTES.NUM_BACK_COLORS, F_QUOTES.NUM_SLEEVE_COLORS,
					D_PRINTER.PRINTER_NM, D_SHIRT_TYPE.SHIRT_TYPE_DESC, D_COLOR.COLOR_NM
				FROM F_QUOTES
					JOIN D_PRINTER ON F_QUOTES.PRINTER_ID = D_PRINTER.PRINTER_ID
					JOIN D_SHIRT_TYPE ON F_QUOTES.SHIRT_TYPE_ID = D_SHIRT_TYPE.SHIRT_TYPE_ID
					JOIN D_COLOR ON F_QUOTES.COLOR_ID = D_COLOR.COLOR_ID
				WHERE F_QUOTES.QUOTE_ID = " . $quoteId;
				
		$result = mysql_query($sql);
		if(!$result){
			die('Invalid query: ' . mysql.error());
		}

		$rows = array();
		while($r = mysql_fetch_assoc($result)){
			$rows[] = $r;
		}
	
		$salesMessageHTML = $rows[0]['NAME'] . ' has requested that you contact him/her regarding quote #' . $quoteId . '<br /><br />'
			. 'The details of the quote are as follows:<br />'
			. 'Name: ' . $rows[0]['NAME'] . '<br />'
			. 'Email: ' . $rows[0]['EMAIL'] . '<br />' 
			. 'Price Quoted: $' . $rows[0]['TOTAL_COST'] . ' ($' . $rows[0]['UNIT_COST'] . '/shirt using the ' . $rows[0]['PRINTER_NM'] . ' printer)' . '<br />'
			. '# of Shirts: ' . $rows[0]['NUM_SHIRTS'] . '<br />'
			. 'Shirt Type: ' . $rows[0]['SHIRT_TYPE_DESC'] . '<br />'
			. 'Shirt Color: ' . $rows[0]['COLOR_NM'] . '<br />'
			. 'Front Print Colors: ' . $rows[0]['NUM_FRONT_COLORS'] . '<br />'
			. 'Back Print Colors: ' . $rows[0]['NUM_BACK_COLORS'] . '<br />'
			. 'Sleeve Print Colors: ' . $rows[0]['NUM_SLEEVE_COLORS'] . '<br />';
			
		if($hasAddons == 'Y'){
			
			$salesMessageHTML .= 'Addons: ';
			
			$sql = "SELECT ADDON_DESC FROM F_ADDON JOIN F_QUOTE_ADDON ON F_ADDON.ADDON_ID = F_QUOTE_ADDON.ADDON_ID WHERE QUOTE_ID = " . $quoteId;
			$result = mysql_query($sql);
			if(!result){
				die('Invalid query: ' . mysql.error());
			}
			
			$addons = array();
			while($s = mysql_fetch_assoc($result)){
				$addons[] = $s;
			}
			foreach($addons as $a){
				$salesMessageHTML .= $a['ADDON_DESC'] . '<br />';
			}
		}
		
		// Constructing the email
		$sender = "SB Press <mail@sbpress.statusbro.com>";                  // Your name and email address
		$recipient = "d.p.hostetler@gmail.com"; 		                    // The Recipients name and email address
        $subject = "New Quote Request From " . $rows[0]['NAME'];            // Subject for the email
        $text = str_replace('<br />', '/n', $salesMessageHTML);             // Text version of the email
        $html = '<html><body>' . $salesMessageHTML . '</body></html>'; 		// HTML version of the email
        $crlf = "\n";
        $headers = array(
	    	'From'          => $sender,
            'Return-Path'   => $sender,
            'Subject'       => $subject
		);

		// Creating the Mime message
		$mime = new Mail_mime($crlf);

		// Setting the body of the email
        $mime->setTXTBody($text);
        $mime->setHTMLBody($html);

        $body = $mime->get();
        $headers = $mime->headers($headers);

        // Sending the email
        $mail =& Mail::factory('mail');
        $mail->send($recipient, $headers, $body);


		////////////////////////
		//SEND EMAIL TO CUSTOMER
		
	}else{
		die('Invalid query: ' . mysql.error());
	}