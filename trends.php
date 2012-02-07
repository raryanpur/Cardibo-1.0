<br />
<p class = "desc">You've Got a Busy Day, So Plan it Out<br /></p>

<div id = "legend">
	<div class = "legend-green">Empty :-) (Go)</div>
	<div class = "legend-yellow">Busy :-\ (Think)</div>
	<div class = "legend-red">Packed :-( (Wait)</div>
	<div class = "legend-closed">Closed :D (Eat)</div>
</div>
<div id="trendswrap">
<div id="content-scroll">
  <div id = "treadmillslideimage"></div>
  <div class = 'occupancy'>This data is currently for treadmills only&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href = "#" class = "-1" id = "minus">back</a><span class = "dayname"><?php echo(date('l')); ?> <a href = "#" class = "1" id = "plus"></span>next</a></div>
  <div id="content-holder">
    

  </div>
</div>
<div id="content-slider"><div id = "morning">Morning</div><div id = "afternoon">Afternoon</div><div id = "night">Night</div></div>
</div>
<script>

$(document).ready(function(){

//do ajax to get data from the script that hits the db
var day = 0;
var offset = <?php echo(date('w')); ?>;
var daystrings = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
var name;
var q = offset + day;
if(q > 6){
		q = q-7;
}
var dayname;

$("a").click(function(){

	name = parseInt($(this).attr('class'));
	day+=name;
	q = offset + day;
	if(q > 6){
		q = q-7;
	}
	if(day>0){
		$("#minus").fadeIn('fast');
	}
	if(day==0){
		$("#minus").fadeOut('fast');
	}
	if(day==6){
		$("#plus").fadeOut('fast');
	}
	if(day<6){
		$("#plus").fadeIn('fast');
	}
	
	dayname = daystrings[q];
	
	var url = "trends/grabdata.php?q=" + q;
	
	$.ajax({
	
	beforeSend:function(){
		$("#content-holder").fadeOut('fast');
		$(".dayname").fadeOut('fast');
		$(".dayname").html("Loading...");
		$(".dayname").fadeIn();
	},
	url:url,
	success: function(data){
	 $("#content-holder").html(data);
	 $(".dayname").html(dayname);
	 $("#content-holder").fadeIn('fast');
	}
	});
	

});


$.ajax({
  beforeSend: function(){
  	$("#content-holder").html("Loading Data...");
  },
  url: "trends/grabdata.php?q=" + q,
  success: function(data){
    $("#content-holder").html(data);
  }
});


  var tot = 42;
  var maxim = 500;
  var stepsize = maxim/tot;
  $("#content-slider").slider({
    animate: true,
    min: 0,
    max: maxim,
    step:stepsize,
    slide: function(e, ui) {  
    	/*if((ui.value)/(stepsize) >= 950){
    	var scrollval = 6720;
    	}
    	else{*/
  		var scrollval = (ui.value/stepsize)*48;
  		//alert(ui.value/stepsize);
        //}
        $("#content-holder").css("left", "-" + scrollval + "px");  
        var arrayindex = Math.round(ui.value/stepsize);
        //$("a.ui-slider-handle").html(times[arrayindex]);
      }  
  });
});

</script>