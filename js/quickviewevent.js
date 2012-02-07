function quickviewupdate(gym){

	$.ajax({
	
		url: "quickview.php?gym_id=" + gym,
		success: function(data){
		
			split = data.split("\\");
			
			$("#quickview").html(split[0]);
			$(".records").html(split[1]);
		
		}
	
		
	});

}


