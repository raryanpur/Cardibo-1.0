<?php

	$time = date("Hi");
	$gymname = "tuftscousens";
	
	if($time >= 2230){
	
	
	$Username = "";
	$Password = "";
	$Database = "";
	$Host = "";
	$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
	mysql_select_db($Database) 
			or die("Unable to select database");

	$query = "SELECT * FROM $gymname";
	$result = mysql_query($query)
		or die ("There was an error loading gymviewer");

	while($data = mysql_fetch_array($result)){
	
		$machine = $data['eid'];
		$query = "UPDATE `$gymname` SET `activity` = '0' WHERE eid = $machine ";
		mysql_query($query)
			or die ("There was a problem resetting the machine activity to zero");
	
	}
	
	}


?>