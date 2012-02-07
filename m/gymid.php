<?php 

	
	$gym_name = $_GET['gym_name'];
	setcookie("gym_name", $gym_name, time()+604800); /* expire in 1 hour */

	$Username = "";
	$Password = "";
	$Database = "";
	$Host = "";
	$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
	mysql_select_db($Database) 
			or die("Unable to select database");

	$query = "SELECT * FROM `gymidsupport` WHERE `gym_name`= '$gym_name'";
	$result = mysql_query($query)
		or die ("There was an error loading gymviewer");
		
		while($data = mysql_fetch_array($result)){
		
			$gym_id = $data["gym_id"];
		
		}
	
	setcookie("gym_id", $gym_id, time()+604800) /* expire in 1 hour */
	
	
	

?>