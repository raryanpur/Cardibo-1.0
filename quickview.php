<?php

//Get cookies
$gym_name = $_COOKIE['gym_name'];
$gym_id = $_COOKIE['gym_id'];

//Select the DB
$Username = "";
$Password = "";
$Database = "";
$Host = "";
$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
mysql_select_db($Database) 
			or die("Unable to select database");

//Define class definitions

class quickviewdisplay

	{	

		function __construct(){
		
		$this->machines = array("treadmills", "ellipticals", "bikes");
		$this->images = array("images/icons/treadmill_icon.png","images/icons/elliptical_icon.png", "images/icons/bike_icon.png");
		$this->totals = array_fill(0,count($this->machines),0);
		$this->counter = array_fill(0,count($this->machines),0);
		$this->inuse = array_fill(0,count($this->machines),0);
		$this->display = "";
		$this->i = 0;
		
		}

	}	
	
//create new object, quickview display that contains everything we want	
$obj = new quickviewdisplay();


//This query grabs the data for the total number of machines in the gym. It grabs it from the layout table using the gym_id (number) and then puts the numbers in the counter property of the quickviewdisplay object.  Notice that the order *must* be treadmills->bikes->ellipticals.  Haven't figured out a better system yet.

$query = "SELECT * FROM `layout` WHERE `gym_id` = '$gym_id'";
$result = mysql_query($query)
	or die ("Loading...");
	
while ($data = mysql_fetch_array($result)){

	$obj->totals[0] = $data['ttotal'];
	$obj->totals[1] = $data['etotal'];
	$obj->totals[2] = $data['btotal'];

}

//This query takes the current data for each gym and then subtracts it from the total number of machines that are there 

$query = "SELECT * FROM ".$gym_name;
$result = mysql_query($query)
	or die ("Loading...");
	
	
while ($data = mysql_fetch_array($result)){


	if ($data['activity']!=1  && $data['outoforder']!=1){
	
	$index = $data['mtype']-1;
	$obj->counter[$index]++;
			
	}
	
	if($data['outoforder']==1){
	
	$index = $data['mtype']-1;
	$obj->totals[$index] -= 1;
	
	}
	
}

$i = 0;
//$catstring = "<img src = 'images/machinesavailable.png' class = 'machinesavail'/>";
$catstring = "";

foreach ($obj->images as $key){

	$colorize = ($obj->counter[$i])/($obj->totals[$i]);
	
	$colorize = colorme($colorize);
	
	if(preg_match("/treadmill/", $key) || preg_match("/bike/", $key) ){
	$catstring = $catstring."<img src = '$key' class = '".$obj->machines[$i]."_quickview'/>"."<span class = \"quickviewnum\"><font color = \"$colorize\">".$obj->counter[$i]."/".$obj->totals[$i]."</font></span> &nbsp;&nbsp;";
	}
	if(preg_match("/elliptical/", $key)){
	$catstring = $catstring."<img src = '$key' class = '".$obj->machines[$i]."_quickview'/>"."<span class = \"quickviewnum\"><font color = \"$colorize\">".$obj->counter[$i]."/".$obj->totals[$i]."</font></span> &nbsp;&nbsp;";
	}
	
	
	$i++;
	
}


/*get records data*/

$query = "SELECT * FROM `gymidsupport` WHERE `gym_id` = $gym_id";
$result = mysql_query($query)
	or die ("Hmm...Couldn't do what I wanted");

mysql_close($dbh);

	while($data = mysql_fetch_array($result)){
		//ugggghhh this is messy.  oh well its 4:16:44 AM on Wednesdsay Oct. 5th. toooo tired.
		$record1 = $data["record1string"];
		$record2 = $data["record2string"];
		$record3 = $data["record3string"];
		$date = date('n/j/y',time());
		$nice = "Records $date<hr />$record1<br /><br />$record2<br /><br />$record3<br />";
		
	}



echo("<span id = 'slider'>Machines Available</span>".$obj->display.$catstring."\\$nice");

function colorme($colorize){

	$codes = Array("#109638","#FCD116", "#F01111");
	
	if($colorize<=0.25){
	
		$key = 2;
	
	}
	
	
	if($colorize>0.25 && $colorize<0.5){
	
		$key = 1;
	
	}
	
	
	if($colorize>=0.5 && $colorize<=0.75){
	
		$key = 0;
	
	}
	
	
	if($colorize>0.75 && $colorize<=1.0){
	
		$key = 0;
	
	}
	
	return $codes[$key];

}


?>