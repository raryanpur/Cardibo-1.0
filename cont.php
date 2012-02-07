<?php

date_default_timezone_set('America/New_York');

$eid = $_GET['eid'];
$gym_name = $_COOKIE["gym_name"];

$Username = "";
$Password = "";
$Database = "";
$Host = "";
$dbh = mysql_connect($Host, $Username, $Password)
			or die ('Error: ' . mysql_error());
mysql_select_db($Database) 
			or die("Unable to select database");

$query = "SELECT * FROM $gym_name WHERE `eid`=$eid";
$result = mysql_query($query)
	or die ("There was an error loading gymviewer");
	
mysql_close($dbh);
	
class update

	{
	
		function __construct($activity, $start, $ooo){
		
		
		$start = strtotime($start);
		$tmp = time() - $start;
		$num = rand(1,1000000);
		$time = time();
		
		if($activity == 1  && $ooo != 1){
		
		$this->start = date('g:i:s A', $start);
		$this->elapsed = elapsedformat($start);
		$this->test = "In Use Since: $this->start <br /> Time Elapsed: $this->elapsed <br /> Est. Remaining: Coming Soon";
		$this->stringify = "
			
			<div id = 'turk$num'>Loading...</div>
		
			<script>
			
			p = new Date();
			var offset = Math.floor(p.getTime()/1000) - $time;
			testme();
			
			function testme(count){
			
			
				
				var location = document.getElementById(\"turk$num\");
			
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
				format = \"In Use Since: $this->start<br /> Elapsed Time: \" + hours + \"hrs \" + minutes + seconds;
				}
				else{
				format = \"In Use Since: $this->start<br /> Elapsed Time: \" + minutes + seconds;
				}
				location.innerHTML = format;
			   
				t = setTimeout(\"testme()\", 1000);

			
			}
			
			</script>
			
			
			";
		}
		
		if($activity == 0 && $ooo != 1){
		
		$this->stringify = "This machine is available";
		
		}
		
		if($ooo == 1){
		
		$this->stringify = "<font color = #DF3A3A><b>This machine is out of order</b></font>";
		
		}
		
		
		
		}

	}	
	
	
while($data = mysql_fetch_array($result)){

	$activity = $data["activity"];
	$start = $data["tstart"];
	$ooo = $data["outoforder"];
	$obj = new update($activity, $start, $ooo);

}

echo json_encode($obj);

function elapsedformat($start){

	if(time()-$start < 3600){
	
		$minutes = floor(((time() - $start)%3600)/60)."min";
		$seconds = ((time() - $start)%3600)/60 - $minutes;
		$seconds = floor($seconds*60)."sec";
		
			
			if($seconds<10){
			
				$seconds = "0$seconds";
			
			}
			
		$elapsedtime = "$minutes $seconds";
		//return $elapsedtime;
		$tmp = time() - $start;
		return $tmp;
	}
	
	else{
	
		$hours = floor((time() - $start)/3600)."hr";
		$minutes = floor(((time() - $start)%3600)/60)."min";
		$seconds = ((time() - $start)%3600)/60 - $minutes;
		$seconds = floor($seconds*60)."sec";
		
			
			if($seconds<10){
			
				$seconds = "0$seconds";
			
			}
			
		$elapsedtime = "$hours $minutes $seconds";
		//return $elapsedtime;
		$tmp = time() - $start;
		return $tmp;
	
	}

}

?>