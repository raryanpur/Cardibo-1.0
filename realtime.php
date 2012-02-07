<?php

$gym_id = strip_tags($_COOKIE["gym_id"]);


//open up mySQL database, for each entry create an object that contains image and qtip information. return image and qtip content, echo a js clock to give allusion of second by second realtime action, actually refresh the data every 10 seconds.

?>


<script>
		
			gym = "<?php echo $gym_id; ?>";
			
			var getlayout = document.createElement('script');
			var quickview= document.createElement('script');
			var machineevent= document.createElement('script');
			
			getlayout.src = "js/gymlayout.js"
			quickview.src = "js/quickviewevent.js";
			machineevent.src = "js/machineevent.js";
			
     	 	document.body.appendChild(getlayout);
     	 	document.body.appendChild(quickview);
   		    document.body.appendChild(machineevent);
     	 	

			setTimeout("layout(gym)",100);
			
			var timerz = <?php
			
			$Username = "";
			$Password = "";
			$Database = "";
			$Host = "";
			$dbh = mysql_connect($Host, $Username, $Password)
				or die ('Error: ' . mysql_error());
			mysql_select_db($Database) 
				or die("Unable to select database");

			$query = "SELECT `LUpdate` FROM `gymidsupport` WHERE gym_id = $gym_id";
			$result = mysql_query($query)
				or die('nope!');
			
			while($data = mysql_fetch_array($result)){
			
				$updatetimer = time() - strtotime($data['LUpdate']) - 5;
				echo $updatetimer;
			
			}
			
			?>
			
			timeme(timerz);
			
			function timeme(args){
			
				timerz = args + 1;
				
				if(timerz%60 == 0){
	
					updatemachines(gym);
					quickviewupdate(gym);
				
				}
				
				if(timerz%120 == 0 && timerz!= 0){
				
					clearTimeout(timez);
				
				}
				
				timez = setTimeout("timeme(timerz)",1000);
				
			
			}
     	 	 
     	 	//setTimeout("updatemachines(gym)",1000);
     	 	
     	 	


</script>

<div id = "gymview">



</div>

<div id = "qtips"></div>



