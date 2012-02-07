<?php

date_default_timezone_set('America/New_York');

$today = date("N");

if($today == 7){
			$tomorrow = 1;
		}
else{
			$tomorrow = $today + 1;
		}

$time = date("Hi");  
//$time = "1200";
//$schedule = "schedule".$_COOKIE['gym_id'];
$schedule = "schedule1";

$Username = "";
$Password = "";
$Database = "";
$Host = "";
$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
mysql_select_db($Database) 
			or die("Unable to select database");

$query = "SELECT `open`,`close`, `sopen` FROM $schedule WHERE `weekday`= $today";
$result = mysql_query($query)
	or die ("There was an error loading gymviewer");

$data = mysql_fetch_array($result);

$query = "SELECT * FROM $schedule WHERE `weekday`=$tomorrow";
$tomresult = mysql_query($query)
	or die ("There was an error loading tomorrow data");


$tomdata = mysql_fetch_array($tomresult);


$ret = openorclosed($data['open'],$data['close'],$data['sopen'],$tomdata['sopen']);


	
function openorclosed($open, $close, $sopen, $tomdata){

	global $time, $today;

	if ($time<$open && $time<0500){
	
		$ret = "<p>Woah! Why are you up?  Catch some more z's and we'll see you at $sopen</p>";
	
	}
	
	if ($time<$open && $time>=0500){
	
		$ret = "<p>So you're a morning person?  Unfortunately the gym doesn't get up until $sopen today...it said something about beauty sleep.</p>";
	
	}
	
	if ($time>$close){


		$ret = "<p>That soft serve machine has your name all over it... Have a good night and we'll see you tomorrow at $tomdata.</p>";
	
	}
	
	if ($time>=$open && $time<=$close){
	
		$ret = 1;
	
	}

	echo $ret;


}

?>