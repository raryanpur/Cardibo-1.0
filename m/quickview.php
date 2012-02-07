<?php



//Get cookies
$gym_name = $_COOKIE['gym_name'];
$gym_id = $_COOKIE['gym_id'];

//Define  globals

$ret = Array();
$machineacronyms = array("run","gallop","spin");
$machinetypes = array("treadmill", "elliptical", "bike");
$subret = array();


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
		$this->totals = array_fill(0,count($this->machines),0);
		$this->counter = array_fill(0,count($this->machines),0);
		$this->available = array_fill(0,count($this->machines),0);
		$this->i = 0;
		
		}

	}

class machine

	{
	
		function __construct($id, $acronym, $type, $loc){
		
		
		$this->activity = 0;
		$this->id = $id;
		$this->acronym = $acronym;
		$this->type = $type;
		$this->image = "";
		$this->start = "";
		$this->elapsed = "";
		$this->location = $loc;
		$this->code = "";
		$this->i = 0;
		
		}

	}	
	
	
//create new object, quickview display that contains everything we want	
$obj = new quickviewdisplay();

//This query grabs the data for the total number of machines in the gym. It grabs it from the layout table using the gym_id (number) and then puts the numbers in the counter property of the quickviewdisplay object.  Notice that the order *must* be treadmills->ellipticals->bikes.  Haven't figured out a better system yet.

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

	$k = $data["mtype"];
	$k-=1;
	$v = $machineacronyms[$k];
	$type = $machinetypes[$k];
	$eid = $data["eid"];
	$loc = $data["location"];
	$start = strtotime($data["tstart"]);
	$time = time();
	
	
	$machine = new machine($eid, $v, $type, $loc);

	
	if($data['activity'] == 0){
	
		$machine->image = "availabletreadmill";
		$wrap = imagewrap($machine);
		$machine->start = "Machine is available";
		$machine->elapsed = $time-$start;	
		$machine->activity = 0;
		$machine->code = $machine->code.$wrap;
		$index = $data['mtype']-1;
		$obj->counter[$index]++;
	
	}

	if ($data['activity'] == 1){
	
		$machine->start = "In Use Since: <br/>".date('g:i:s A', strtotime($data["tstart"]));
		$machine->elapsed = $time-$start;	
		$machine->activity = 1;		
		$imgid = $data['updated'];
		$img = $machine->acronym.$machine->location.$imgid;
		$machine->image = $img;
		$wrap = imagewrap($machine);
		$machine->code = $machine->code.$wrap;

			
	}
	
	array_push($subret, $machine);
	
}

$i = 0;
$catstring = "";

/*populate quickview */
foreach ($obj->machines as $key){

	$colorize = ($obj->counter[$i])/($obj->totals[$i]);
	
	$colorize = colorme($colorize);
	
	if(preg_match("/treadmill/", $key)){
	$obj->available = "<font color = \"$colorize\">".$obj->counter[$i]."/".$obj->totals[$i]."</font>";
	}
	else{
	$obj->available = "<font color = \"#A8A8A8\">0/0</font>";
	}
	
	$i++;
	
	array_push($ret,$obj->available);
	
}

/*get records data*/

$query = "SELECT * FROM `gymidsupport` WHERE `gym_id` = $gym_id";
$result = mysql_query($query)
	or die ("Hmm...Couldn't do what I wanted");
	
	while($data = mysql_fetch_array($result)){
		//ugggghhh this is messy.  oh well its 4:16:44 AM on Wednesdsay Oct. 5th. toooo tired.
		$record1 = $data["record1string"];
		$record2 = $data["record2string"];
		$record3 = $data["record3string"];
		$nice = "<font color = \"#FBB829\">1st: $record1</font><br /><font color = \"#E2E6DF\">2nd: $record2</font><br /><font color = \"965A38\">3rd: $record3</font><br />";
		
	}

array_push($ret, $nice);

/*Output data*/

/*Push machine specific data into json object and export it*/
array_push($ret, $subret);


echo json_encode($ret);




/*Functions*/

function imagewrap($machine){

	$image = $machine->image;
	$id = $machine->id;
	$wrap = "<li class = '$image' id = '$id'>";
	return $wrap;

}



function colorme($colorize){

	$codes = Array("#0BE413","#FCD116", "#F01111");
	
	if($colorize<=0.25){
	
		$key = 2;
	
	}
	
	
	if($colorize>0.25 && $colorize<=0.5){
	
		$key = 1;
	
	}
	
	
	if($colorize>0.5 && $colorize<=0.75){
	
		$key = 0;
	
	}
	
	
	if($colorize>0.75 && $colorize<=1.0){
	
		$key = 0;
	
	}
	
	return $codes[$key];

}


function elapsedformat($time, $start){

$output = "<script>
			
			p = new Date();
			var offset = Math.floor(p.getTime()/1000) - $time;
			testme();
			
			function testme(count){
			
			
				var location = document.getElementById('elapsed');
			
				g = new Date();
				now = g.getTime()/1000 - offset;
				since = $start;
				tmp = now - since;
						
				var hours = Math.floor((tmp)/3600);
				var minutes = Math.floor((tmp%3600)/60);
				var seconds = ((tmp)%3600)/60 - minutes;
				seconds = Math.floor((seconds*60)) + \"sec \";
				minutes = minutes + \"min \";
			   
			   
			   	if(hours != 0){
				format = \"Elapsed Time:<br /> \" + hours + \"hrs \" + minutes + seconds;
				}
				else{
				format = \"Elapsed Time:<br /> \" + minutes + seconds;
				}
				location.innerHTML = tmp;
			   
				t = setTimeout(\"testme()\", 1000);

			
			}
			
			</script>

		
		
		";

return $output;

}



?>