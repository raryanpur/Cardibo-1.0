<?php

$machineacronyms = array("run","gallop","spin");
$machinetypes = array("treadmill", "elliptical", "bike");
$output = array();

$gym_name = $_COOKIE["gym_name"];

$Username = "";
$Password = "";
$Database = "";
$Host = "";
$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
mysql_select_db($Database) 
			or die("Unable to select database");

$query = "SELECT * FROM ".$gym_name;
$result = mysql_query($query)
	or die ("There was an error loading gymviewer");

class machine

	{
	
		function __construct($id, $acronym, $type, $qtip, $loc){
		
		
				
		$this->id = $id;
		$this->acronym = $acronym;
		$this->type = $type;
		$this->image = "";
		$this->start = "";
		$this->elapsed = "";
		$this->qtipcontent = $qtip;
		$this->location = $loc;
		$this->code = "";
		$this->i = 0;
		
		}

	}	
	

while ($data = mysql_fetch_array($result)){

	$k = $data["mtype"];
	$k-=1;
	$v = $machineacronyms[$k];
	$type = $machinetypes[$k];
	$eid = $data["eid"];
	$loc = $data["location"];
	$machine = new machine($eid, $v, $type, $qtip, $loc);
	
	if($data['activity'] == 0  && $data['outoforder'] != 1){
	
		//$machine->image = "available".$machine->type.".png";
		$machine->image = "available";
		$wrap = imagewrap($machine);
		$machine->code = $machine->code.$wrap;
	
	}

	if ($data['activity'] == 1 && $data['outoforder'] != 1){
	
		$imgid = $data['updated'];
		$img = $machine->acronym.$machine->location.$imgid;
		$machine->image = $img;
		$wrap = imagewrap($machine);
		$machine->code = $machine->code.$wrap;
		
			
	}
	
	if ($data['outoforder'] == 1){
	
		$machine->image = "outoforder";
		$wrap = imagewrap($machine);
		$machine->code = $machine->code.$wrap;
	
	
	}
	
	
	
	array_push($output, $machine);
		
	
}

//construct the output

echo json_encode($output);



function imagewrap($machine){

	$image = $machine->image;
	$id = $machine->id;
	$wrap = "<div class = '$image' id = '$id'></div>";
	return $wrap;

}




?>