<script>

var zone = "";
var day = "";

$("td").mouseover(function(){

	$(this).animate({opacity: 0.5},{queue:false, duration:200});

});

$("td").mouseout(function(){

	$(this).animate({opacity: 1.0},{queue:false, duration:200});

});

$("#complex table tr td").click(function(){

 	$("td").css({backgroundColor:'#EEE9E9'});
 	$("#hoursresult").fadeOut('slow');
	$(this).css({backgroundColor:'white'});
	zone = $(this).attr('name');
	$("#day").fadeIn('slow');
	
});

$("#day table tr td").mouseover(function(){

	$("#day table tr td").css({backgroundColor:'#EEE9E9'});
	day = $(this).attr('name');
	$(this).css({backgroundColor:'white'});
	$("#hoursresult").fadeIn('slow');
	
	var dataz = {zone: zone, day: day};
	
	$.ajax({
	
		url:'schedule.php',
		type:'POST',
		data:dataz,
		beforeSend:function(){$("#hoursresult").html('Loading...')},
		success:function(data){
		
			$("#hoursresult").html(data);
		
		}
	
	
	});
	
});




</script>
<div id = "hourswrap">
<div id = "complex">
<table>
	<tr>
	
		<td name = 'cousens'>Cousens Gym</td>
		
	</tr>
	<tr>
	
		<td name = 'indoortennis'>Indoor Tennis Courts</td>
		
	</tr>
	<tr>
	
		<td name = 'squash'>Squash Courts</td>
		
	</tr>
	<tr>
	
		<td name = 'pool'>Hamilton Pool</td>
	
	</tr>
	<tr>
	
		<td name = 'southtennis'>South Tennis Courts</td>
	
	</tr>
	<tr>
	
		<td name = 'fletchertennis'>Voute Tennis Courts</td>
	
	</tr>
	<tr>
	
		<td class = "filler">X</td>
	
	</tr>

</table>

</div>
<div id = "day">

<table>

	<tr>
	
		<td name = '1'>Monday</td>
		
	</tr>
	<tr>
	
		<td name = '2'>Tuesday</td>
		
	</tr>
	<tr>
	
		<td name = '3'>Wednesday</td>
		
	</tr>
	<tr>
	
		<td name = '4'>Thursday</td>
		
	</tr>
	<tr>
	
		<td name = '5'>Friday</td>
		
	</tr>
	<tr>
	
		<td name = '6'>Saturday</td>
		
	</tr>
	<tr>
	
		<td name = '7'>Sunday</td>
		
	</tr>


</table>

</div>
<div id = "hoursresult">

	<p>7am to 10pm</p>

</div>
</div>