<?php

include_once('../utilities/db_conn.php');

//get data
$sql = "SELECT `SHIRT_TYPE_ID`, `SHIRT_TYPE_DESC` FROM D_SHIRT_TYPE";
$result = mysql_query($sql);
if(!result){
	die('Invalid query: ' . mysql.error());
}

$rows = array();
while($r = mysql_fetch_assoc($result)) {
    $rows[] = $r;
}
print json_encode($rows);

?>