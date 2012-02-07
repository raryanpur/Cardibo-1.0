<?php

$gym_id = 1;  //gym_id = 1 for tufts in the support table
$Username = "";
$Password = "";
$Database = "";
$Host = "";
$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
mysql_select_db($Database) 
			or die("Unable to select database");

$query = "SELECT `LUpdate` FROM `gymidsupport` WHERE `gym_id`=$gym_id ";
$result = mysql_query($query)
	or die ("There was an error loading gymviewer");
	
	while($data = mysql_fetch_array($result)){
	
	
		if(time() - strtotime($data['LUpdate']) > 300){
		
		$email = "";
		$subject = "Potential System Malfunction";
		$message = "No updates have been made for the last 5 minutes! Last update was at ".$data['LUpdate'];
		$headers = "From: p@cardibo.com\r\n";
		$headers.= "Content-Type: text/html\r\n";
		
		if(mail($email, $subject, $message, $headers)){
		
			echo "alert sent successfully";
			
		
		}
		
		$query = "UPDATE `gymidsupport` SET `Live`= 0  WHERE `gym_id`=$gym_id ";
		$yay = mysql_query($query)
			or die ("There was an error loading gymviewer");
		
		}
	
	}


?>