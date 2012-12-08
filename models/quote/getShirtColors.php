<?php

include_once('../utilities/db_conn.php');

//get data
$shirtTypeId = $_GET["shirtTypeId"];

$sql = sprintf("SELECT D_COLOR.COLOR_ID, D_COLOR.COLOR_NM FROM D_COLOR JOIN M_MODEL_COLOR ON D_COLOR.COLOR_ID = M_MODEL_COLOR.COLOR_ID WHERE M_MODEL_COLOR.MODEL_ID = '%s'", mysql_real_escape_string($shirtTypeId));
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