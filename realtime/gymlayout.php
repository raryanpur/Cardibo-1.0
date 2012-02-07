<?php

$gym_id = $_COOKIE["gym_id"];

$Username = "";
$Password = "";
$Database = "";
$Host = "";
$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
mysql_select_db($Database) 
			or die("Unable to select database");

$query = "SELECT * FROM `layout` WHERE `gym_id` = '$gym_id'";
$result = mysql_query($query)
	or die ("There was an error loading gymlayout");

while($data = mysql_fetch_array($result)){

	
	echo $data['treadmills'];
	echo $data['ellipticals'];
	echo $data['bikes'];


}

?>