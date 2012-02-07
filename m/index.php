<!DOCTYPE html>

<html>

<head>
	<link rel="apple-touch-icon" href="images/favicon.png"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<meta name="apple-mobile-web-app-capable" content="yes"> 
	<meta name="apple-mobile-web-app-status-bar-style" content="black"> 

	<title>Cardibo</title>
	
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
	<link rel = "stylesheet" type = "text/css" href = "css/m.css" />
	<script src = "js/ajaxrequests.js"></script>
	<script src= "js/jquery.js"></script>
	<script src = "js/json2.js"></script>
	<script type="application/javascript" src="cubiq/src/iscroll.js"></script> 

	<link rel = "stylesheet" href = "js/add2home.css" />
	
	<script type="text/javascript">
var addToHomeConfig = {
	animationIn: 'fade',
	animationOut: 'fade',
	startDelay: 1000,
	lifespan:30000,
	expire:0,
	touchIcon:false,
	message:'Yo!  Download the Cardibo webapp by clicking %icon, Then Add to Home Screen!'
};

var loadingbar = new Image();
loadingbar.src = "../images/ajax-loader.gif";


</script>
	
	<script src = "js/add2home.js"></script>
	


</head>

<body>

	
	
	<div id = "banner"><a href = "index.php"><img src = "../images/mobilebanner.png" alt = "banner" /></a></div>
	<div id = "bar"></div>
	<div id = "content">
	<!--<div id = "splashbar"></div>-->
	<div id = "splash">

	<p>Welcome to Cardibo Mobile. <br /><br />Cardibo lets you check the availability of machines on the go--no more waiting for machines or wasting time in line.<br /><br />We've launched at Tufts University and will be expanding to other universities soon.  If you'd like Cardibo at your university, email contact@cardibo.com.<br /><br />Please Gymview responsibly.<br /><br /></p>
	
	<select id = "gyms" onchange = "gymselect(this.selectedIndex)">
	
	<option selected>Select Gym</option>
	<option id = 'tuftscousens'>Tufts Cousens</option>
	
	
	</select>
	
	</div>
	
	</div>


	<script>

	function gymselect(index){
	
		var gym = document.getElementById("gyms").options[index].id;
		cookieset(gym);
		load();
	
	}	

	</script>
	
	<?php

		if(isset($_COOKIE['gym_id'])){

		echo "<script>load()</script>";

		}


	?>
	
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26098132-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>	

</body>

<script>

setTimeout(function () {
  window.scrollTo(0, 1);
}, 1000);


</script>



</html>