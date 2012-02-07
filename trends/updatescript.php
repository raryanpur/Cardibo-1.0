 <?php

$day = date('l');

echo $day;

$Username = "";
$Password = "";
$Database = "";
$Host = "";
$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
mysql_select_db($Database) 
			or die("Unable to select database");
			
$query = "SELECT * FROM `$day` WHERE `eid` = 0";
$result = mysql_query($query)
	or die ("bad query!");
	
$data = mysql_fetch_row($result);
$totalcounter = Array();
$sumcounter = Array();


for($i=0;$i<=8;$i++){

echo "<br /><br />";

$count = 0;
$m=7;
$chunk = 1;
	
$query = "SELECT * FROM `$day` WHERE `eid` = $i";
$result = mysql_query($query)
	or die ("bad query!");
	

$data = mysql_fetch_row($result);
	
	foreach($data as $value){

		
		//if($i == 0){
			
				if($m<15){
					$count+=$value;
				}
				else{
					
					$m = 0;
					//echo $chunk." ";
					//echo ($count)."<br />";
					if($i==0){
					array_push($totalcounter, $count);
					}
					else{
						//if statement gets rid of fact that we're adding column `eid` to the first set of data
						if($chunk == 1){
							$count-=$i;
						}
						if($i==1){
						//portdata($count/($totalcounter[($chunk-1)]));
						array_push($sumcounter,$count/($totalcounter[($chunk-1)]));
						}
						if($i>1 && $i<8){
						$sumcounter[$chunk-1]+=$count/($totalcounter[($chunk-1)]);
						}
						if($i == 8){
						$sumcounter[$chunk-1] = ($sumcounter[$chunk-1] + $count/($totalcounter[($chunk-1)]))/8;
						}
				
					}
					$count = 0;
					$chunk+=1;
					$count+=$value;
					
				
				}
			
				$m+=1;
				
		//}
		
		
		
	//echo (($count/1738)*100)."%<br />";
	
	}

	
	
}

foreach($sumcounter as $arg){
	
	$g+=1;
	
	if($arg>=0 && $arg<0.5){
	
		$val = 1;	
	}
	
	if($arg>=0.5 && $arg<=.65){
	
		$val = 2;
	
	}
	
	
	if($arg>0.65 && $arg<=1){
	
		$val = 3;
	
	}
	
	$query = "UPDATE `cardib5_gymviewer`.`prediction$day` SET `$g` = '$val' WHERE `prediction$day`.`machine` = 'treadmill' ";
	mysql_query($query)
		or die("Couldnt execute the query");
}


?>