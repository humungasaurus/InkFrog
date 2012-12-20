<?php

include_once('../utilities/db_conn.php');

//get data
$shirtTypeId = $_GET["shirtTypeId"];

$sql = sprintf("SELECT F_ADDON.ADDON_ID, F_ADDON.ADDON_DESC, F_ADDON.HAS_CHILD, F_ADDON.PARENT_ID 
				FROM F_ADDON JOIN M_TYPE_ADDON ON F_ADDON.ADDON_ID = M_TYPE_ADDON.ADDON_ID 
				WHERE M_TYPE_ADDON.SHIRT_TYPE_ID = '%s'", 
		mysql_real_escape_string($shirtTypeId));
		
$result = mysql_query($sql);
if(!result){
	die('Invalid query: ' . mysql.error());
}

$rows = array();
while($r = mysql_fetch_assoc($result)) {
    $rows[] = $r;
}

$rows2 = array();
foreach($rows as $w){
	
	if($w['HAS_CHILD']=='Y'){
		
		$sql = sprintf("SELECT * FROM F_ADDON WHERE PARENT_ID = '%s'",
			mysql_real_escape_string($w['ADDON_ID']));
		
		$result = mysql_query($sql);
		if(!result){
			die('Invalid query: ' . mysql.error());
		}

		while($r = mysql_fetch_assoc($result)) {
			$rows2[] = $r;
		}	
	}
}

$result_string = array();
foreach($rows as $w){
	
	if($w['HAS_CHILD']=='Y'){
		
		$tmpChildren = array();
		foreach($rows2 as $x){
			if($x['PARENT_ID'] == $w['ADDON_ID']){
				$tmp = array('ADDON_ID' => $x['ADDON_ID'], 'ADDON_DESC' => $x['ADDON_DESC']);
				array_push($tmpChildren, $tmp);
			}
		}
		
		$tmpParent = array(
			'ADDON_ID' => $w['ADDON_ID'],
			'ADDON_DESC' => $w['ADDON_DESC'],
			'CHILDREN' => $tmpChildren
		);
		array_push($result_string, $tmpParent);
	}else{
		$tmpParent = array(
			'ADDON_ID' => $w['ADDON_ID'],
			'ADDON_DESC' => $w['ADDON_DESC']
		);
		array_push($result_string, $tmpParent);
	}
}

print json_encode($result_string);
?>