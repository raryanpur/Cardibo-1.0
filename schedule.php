<?php

//Select the DB
$Username = "";
$Password = "";
$Database = "";
$Host = "";
$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
mysql_select_db($Database) 
			or die("Unable to select database");
			
$day = strip_tags($_POST['day']);
$zone = strip_tags($_POST['zone']);

$query = "SELECT * FROM `schedule1` WHERE weekday='$day'";
$result = mysql_query($query)
	or die(mysql_error());
	
while($data = mysql_fetch_array($result)){

	echo $data[$zone];

}




?>