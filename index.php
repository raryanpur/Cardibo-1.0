<?php

$ua = $_SERVER['HTTP_USER_AGENT'];
$checker = array(
  'iphone'=>preg_match('/iPhone|iPod|iPad/', $ua),
  'blackberry'=>preg_match('/BlackBerry/', $ua),
  'android'=>preg_match('/Android/', $ua),
);

if ($checker['blackberry']){

header("Location: http://m.cardibo.com/blackberry");


}

else{

$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
header('Location: http://www.m.cardibo.com');

}


?>
<!DOCTYPE html>
<html>
<!--metadata-->
<meta http-equiv="refresh" content="600;url=http://www.cardibo.com" />
<!--end metadata-->
<head>
	
	<meta name="description" content="Realtime Gym Data, Tufts University" />
	<title>Cardibo: Avoid the Stampede</title>
	<?php 
		
		$min = date('i');
		$min = $min/60;
		$time = date('G')+"$min";
		$sunrise = date_sunrise(time(), SUNFUNCS_RET_DOUBLE, 42.37, -71.03);
		$sunset = date_sunset(time(), SUNFUNCS_RET_DOUBLE, 42.37, -71.03);
		
		if($time>$sunset || $time<$sunrise){
			//echo "<link rel=\"stylesheet\" href=\"css/night.css\" type=\"text/css\" media=\"screen\" />";
			echo "<link rel=\"stylesheet\" href=\"css/web.css\" type=\"text/css\" media=\"screen\" />";
		}
		else{
			echo "<link rel=\"stylesheet\" href=\"css/web.css\" type=\"text/css\" media=\"screen\" />";
		}
	?>
	
	<link type="text/css" rel="stylesheet" href="js/qtip2/jquery.qtip.css" />
	<link type="text/css" rel="stylesheet" href="js/simplemodal/modalcss.css" />
	<link rel="stylesheet" href = "js/jquery_ui/css/ui-lightness/jquery-ui-1.8.16.custom.css" />
	<link rel="stylesheet" href = "trends/trends.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery_ui/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="js/json2.js"></script>
	<script type="text/javascript" src="js/animations.js"></script>
	<script type="text/javascript" src="js/quickviewevent.js"></script>
	<script type="text/javascript" src="js/machineevent.js"></script>
	<script type="text/javascript" src="js/gymlayout.js"></script>
	<script type="text/javascript" src="js/qtip2/jquery.qtip.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/footeranimation.js"></script>
	<script type="text/javascript" src="js/simplemodal/simplemodal.js"></script>
	
</head>

<body>


<div id = "bar"></div>

<div id = "wrap">

	<div id = "googledesc">Cardibo let's you track the realtime status of machines at the gym.  Figuring out when to avoid the crowds shouldn't be guess work, now it isn't.  You can also peep daily facts on the gym in general, gaining insight into the longest workouts completed today.</div>

	<div id = "stuffcontainer">


	<div id = "header">
	
	<ul>
	
	
	<a href = "index.php" id = "index"><li id = "banner"><img src = "images/banner.png" alt = "Banner"/></li></a>
	<li id = "quickview"></li>
	
	
	</ul>

	
	
	</div> <!-- ends header -->

	
	<div id = "main">

		<div class = "splash">
			
			<p class = "desc">Don't Wait for Machines.</p>
			
			<?php
			
			$Username = "";
			$Password = "";
			$Database = "";
				$Host = "";
				$dbh = mysql_connect($Host, $Username, $Password)
					or die ('Error: ' . mysql_error());
				mysql_select_db($Database) 
					or die("Unable to select database");

			$query = "SELECT * FROM `gymidsupport` WHERE `gym_id`= 1 ";
			$result = mysql_query($query)
					or die ("There was an error loading live");
	
			while($data = mysql_fetch_array($result)){
			
				if($data["Live"] == 1){
				
				echo "<p>Click your gym below to get started</p>
					<p><a href = \"#\" id = \"tuftscousens\">Tufts University Cousens Gym (Medford, MA)</a></p>
			<!--<p><a href = \"#\" id = \"tuftscousens\">Doin' some maintenance, we'll be back by the morning</a>-->";
				
				}
				
				else{
				
				echo "<p>Very sorry for the inconvenience, but we've got something we're fixing.  We'll be back shortly.</p>";
				
				}
			
			}

			
			?>
		
		</div>
		
			
	
			
		<div id = "nav">
		
		<ul>
		
			<span class = "nav">
				<span class = "navitem">
				
				<li><a href = "#" id = "realtime">Live</a></li>
				<li><a href = "#" id = "trends">Trends</a></li>
				<li><a href = "#" id = "hours" selected = "false">Hours</a></li>
				<!--<li><a href = "#" id = "index">Find Your Gym</a></li>-->
				<li><a href = "#" id = "about">About</a></li>
				<!--<li><a href = "#" id = "beta">Invites</a></li>-->
				<li><a href = "#" id = "feedback">Feedback</a></li><br />
				
				<div class = "records"></div>
				
				</span>
			</span>
			
		</ul>
		
		
		</div>	
		
	    <div id = "content">
	    
	    
	    
	    </div>
	    
	    
		
		<div id = "footer">
		
			<ul class = "footeritems">
		
				<li class = "copy">All Content 2011 by Cardibo, Inc. </li>
				<li class = "footeritem" id = "privacypolicy">Privacy Policy</li>
				<li class = "footeritem"><a href = "mailto:contact@cardibo.com">Contact</li>
				
			</ul>
				
		</div>
	

	
	</div> <!-- ends main container -->
	
	
		
	
	</div>

	

</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try{
var pageTracker = _gat._getTracker("UA-25662370-1");
pageTracker._trackPageview();
} catch(err) {}
</script>

<noscript>You must have javascript enabled to use this site!</noscript>


</body>



</html>	