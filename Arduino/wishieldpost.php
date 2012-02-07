<?php

$gym_id = strip_tags($_GET['gym_id']);

$Username = "";
$Password = "";
$Database = "";
$Host = "";
$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
mysql_select_db($Database) 
			or die("Unable to select database");
			
$t = strip_tags($_GET['t']);
$status = preg_split("//", $t, -1, PREG_SPLIT_NO_EMPTY);
$n = 0;
$i = 0;

$time = time();
$day = date('l', $time);
$hour = date('H', $time);
$min = date('i', $time);
$sec = date('s',$time);
$counter = 1;
$g=1;
$gotcha = 0;

//check to make sure the system is "Live", aka there's no maintenance message on the home page

$query = "UPDATE `gymidsupport` SET `Live`= 1  WHERE `gym_id`=$gym_id ";
		$yay = mysql_query($query)
			or die ("There was an error loading gymviewer");

/*	
if($sec<30){

	$sec = "00";

}

else{

	$sec = "30";

}
*/

$getter = $hour.$min;

//updates the most recent update time
$query = "UPDATE `cardib5_gymviewer`.`gymidsupport` SET `LUpdate` = NOW() WHERE  `gym_id` = $gym_id";


$result = mysql_query($query)
	or die("No dice on the time update");
	
	
			


if($hour >=07 && $hour <= 22){
	
	
	$query = "SELECT `$getter` FROM `$day` WHERE `eid` = 0";
	$result = mysql_query($query)
		or die ("Couldn't get data");
	
	while($data = mysql_fetch_array($result)){

		$counter = $data["$getter"] + 1;
		$query = "UPDATE `$day` SET `$getter` = $counter WHERE `eid` = 0";
		mysql_query($query)
			or die ("Couldn't update counter");
		
	}
	
		
$getquery = "SELECT * FROM `tuftscousens`";
$returned = mysql_query($getquery)
	or die ("Couldn't get last data set");
	
while($data = mysql_fetch_array($returned)){

	$past[$i] = $data["activity"];
	$machineelapsed[$i] = time() - strtotime($data["tstart"]);
	$cyclestart[$i] = $data["tstart"];
	//echo $past[$i];
	$i++;	

}

			
for($n=0; $n<count($status); $n++){

	if($status[$n] == 0 && $past[$n] == 1){
		
		//updates the daily records
	
					
				$query = "SELECT `record1`, `record2`, `record3` FROM ``.`` WHERE `gym_id` = $gym_id";
				
				$result = mysql_query($query)
					or die("Couldn't get records data");

				while($data = mysql_fetch_row($result)){

					foreach($data as $record){
						
						$elapsed = $record."<br />";
					
						if($status[$n] == 0 && $past[$n] == 1 && $machineelapsed[$n] > $record  && $gotcha!=1){
						
							$gotcha = 1;
							$selection = "record".$g;
							$nextnum = $g + 1;
							
							if($nextnum<3){
							
							$selectionnext = "record".$nextnum;
							$selectionthisstring = "record".$g."string";
							$selectionnextstring = "record".$nextnum."string";
							
							$query = "SELECT `$selectionthisstring` FROM `gymidsupport` WHERE `gym_id` = $gym_id";
							$lastdata = mysql_query($query)
							 or die ("Cant do it!");
							
							
								while($nicelastdata = mysql_fetch_row($lastdata)){
								
									foreach($nicelastdata as $entry){
									
										$prevstring = $entry;
									
									}
								
								
								}
							
							
							$query =  "UPDATE `cardib5_gymviewer`.`gymidsupport` SET `$selectionnext` = $record WHERE `gym_id` = $gym_id";
							mysql_query($query)
							 or die ("Issues!");
							$query = "UPDATE `cardib5_gymviewer`.`gymidsupport` SET `$selectionnextstring` = '$prevstring' WHERE `gym_id` = $gym_id";
							mysql_query($query)
							 or die ("Problem!");
							}
							
							$query = "UPDATE `cardib5_gymviewer`.`gymidsupport` SET `$selection` = $machineelapsed[$n] WHERE `gym_id` = $gym_id";
							mysql_query($query)
								or die("Couldn't execute record update");
							
								if($machineelapsed[$n] > 3600){	
								
									$check = date('i', $machineelapsed[$n]);
									if($check<10){
										$nice = substr($check, 1, 1);
										$theactualhour = floor($machineelapsed[$n]/3600);
										$nice = $theactualhour."hr ".$nice."min";
									}
									else{
										$nice = date('i', $machineelapsed[$n]);
										$theactualhour = floor($machineelapsed[$n]/3600);
										$nice = $theactualhour."hr ".$nice."min";
									}
									
								}
								else{
								
									$check = date('i', $machineelapsed[$n]);
									if($check<10){
										$nice = substr($check, 1, 1);
										$nice = $nice."min";
									}
									else{
										$nice = date('i\m\i\n', $machineelapsed[$n]);
									}
									
								}
							
							$timestampy = date('g:i A',strtotime($cyclestart[$n]));
							$stringaling = $nice." @".$timestampy;
							
							$selection = "record".$g."string";
						
							
							$query = "UPDATE `cardib5_gymviewer`.`gymidsupport` SET `$selection` = '$stringaling' WHERE `gym_id` = $gym_id";
							echo $query;
							mysql_query($query)
								or die("couldn't update records printable string");
						
						}
	
					$g++;
	
					} //ends foreach
				
				$g = 1;

				} //ends while
		
		
	} //ends if status_n == 1 if statement
	
	$gotcha = 0;
	$m = $n + 1;
	
	$getquery = "SELECT `$getter` FROM `$day` WHERE `eid` = $m"; 
	
	//echo $getquery;
	$result = mysql_query($getquery)	
		or die ("Couldn't select past data");
	
	while($data = mysql_fetch_array($result)){
		$newcounter = $data["$getter"] + $status[$n];
	}
	
	echo "<br />".$newcounter."<br />";
		
	$query = "UPDATE `$day` SET `$getter` = $newcounter WHERE `eid` = $m";
	mysql_query($query)
		or die("Problemz....");
	
	if($status[$n] != $past[$n]){

		$imgid = rand(1,4);

		$query = "UPDATE `cardib5_gymviewer`.`tuftscousens` SET  `activity` =  '$status[$n]', `tstart` = NOW(), `updated` = '$imgid'  WHERE `eid` = $m";

		mysql_query($query)
			or die("Couldn't execute the query");

	
			
	}
	

}

} //closes big if





?>