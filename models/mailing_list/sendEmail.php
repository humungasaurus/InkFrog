<?php

	include_once('../utilities/db_conn.php');
	
	$sql = sprintf("INSERT INTO `sbpress`.`D_MAILING_LIST` (`ID`, `EMAIL_ADDRESS`) VALUES (NULL, '%s')",
		$_GET['emailAddress']);
		
		if(mysql_query($sql)){
			print('true');
		}else{
			print('false');
		}