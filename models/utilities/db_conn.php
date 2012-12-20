<?php 

//connect to db
$con = mysql_connect('localhost', 'root', 'root');
if (!$con) {
	die('Could not connect: ' . mysql_error());
}

//select db
$db_selected = mysql_select_db('InkFrog', $con);
if (!$db_selected) {
    die ('Can\'t use InkFrog : ' . mysql_error());
}

?>