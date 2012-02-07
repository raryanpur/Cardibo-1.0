<?php

$Username = "";
$Password = "";
$Database = "";
$Host = "localhost";
$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
mysql_select_db($Database) 
			or die("Unable to select database");

$query = "UPDATE `gymidsupport` SET `record1` = 0 WHERE gym_id = 1 ";
mysql_query($query);
$query = "UPDATE `gymidsupport` SET `record2` = 0 WHERE gym_id = 1 ";
mysql_query($query);
$query = "UPDATE `gymidsupport` SET `record3` = 0 WHERE gym_id = 1 ";
mysql_query($query);
$query = "UPDATE `gymidsupport` SET `record1string` = 'Claim me!' WHERE gym_id = 1 ";
mysql_query($query);
$query = "UPDATE `gymidsupport` SET `record2string` = 'Claim me!' WHERE gym_id = 1 ";
mysql_query($query);
$query = "UPDATE `gymidsupport` SET `record3string` = 'Claim me!' WHERE gym_id = 1 ";
mysql_query($query);



?>