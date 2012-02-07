<?php
$day = $_GET['q'];
$daylist = Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
$daystring = $daylist[$day];
$Username = "";
$Password = "";
$Database = "";
$Host = "";
$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
mysql_select_db($Database) 
			or die("Unable to select database");

$query = "SELECT * FROM `prediction$daystring` WHERE `machine` = 'treadmill'";
$result = mysql_query($query)
	or die ("couldn't execute query!");
	
$data = mysql_fetch_array($result);

$wrappingfront = Array("<div class = \"content-itemgreen\">","<div class = \"content-itemyellow\">","<div class = \"content-itemred\">");
$wrappingback = "</div>";


$times = Array("7:00 AM", "7:15 AM", "7:30 AM", "7:45 AM", "8:00 AM", "8:15 AM", "8:30 AM", "8:45 AM", "9:00 AM", "9:15 AM", "9:30 AM", "9:45 AM", "10:00 AM", "10:15 AM", "10:30 AM", "10:45 AM", "11:00 AM", "11:15 AM", "11:30 AM", "11:45 AM", "Noon", "12:15 PM", "12:30 PM", "12:45 PM", "1:00 PM", "1:15 PM", "1:30 PM", "1:45 PM", "2:00 PM", "2:15 PM", "2:30 PM", "2:45 PM", "3:00 PM", "3:15 PM", "3:30 PM", "3:45 PM", "4:00 PM", "4:15 PM", "4:30 PM", "4:45 PM", "5:00 PM", "5:15 PM", "5:30 PM", "5:45 PM", "6:00 PM", "6:15 PM", "6:30 PM", "6:45 PM", "7:00 PM", "7:15 PM", "7:30 PM", "7:45 PM", "8:00 PM", "8:15 PM", "8:30 PM", "8:45 PM", "9:00 PM", "9:15 PM", "9:30 PM", "9:45 PM", "10:00 PM", "10:15 PM");

$i = 1;
while($i<=62){
	//if it's Saturday
	if($day == 6){
		if($i>=13 && $i<=49){
		echo $wrappingfront[$data[$i]-1];
		echo $times[$i-1];
		echo $wrappingback;
		}
		else{
		echo "<div class = \"content-closed\">X</div>";
		}
	}
	//if it's Sunday
	if($day == 0){
		if($i>=13){
		echo $wrappingfront[$data[$i]-1];
		echo $times[$i-1];
		echo $wrappingback;
		}
		else{
		echo "<div class = \"content-closed\">X</div>";
		}
	}
	//if it's any other day of the week
	if($day!=0 && $day!=6){
		echo $wrappingfront[$data[$i]-1];
		echo $times[$i-1];
		echo $wrappingback;
	}
	$i++;

}






/*foreach ($times as $block){

	echo "<div class = \"content-itemgreen\">$block</div>";


}
*/
?>