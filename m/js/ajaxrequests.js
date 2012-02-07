function cookieset(gym){

 	var getstring = "gym_name=" + gym;

	$.ajax({
		
		url:"../gymid.php",
		data: getstring,
		success: function(data){
		
				
		}
	
	
	});
	
}


function load(){

	$.ajax({
		
		beforeSend: function() {$("#splash").html("<p><img src = '" +loadingbar.src+ "' height = '15' width = '15'/> Loading...</p>");},
		url:"home.php",
		data: {},
		success: function(data){
		
			$("#content").fadeOut('slow', function(){
			
				$("#content").html(data);
				
				$("#content").fadeIn('slow');
				quickview();	
			
			}); //end fadeout
				
		}
	
	
	});


}

function quickview(){

	var args = new Array("#tstatus","#estatus","#bstatus");
	var nummachines = 3;
		
	$.ajax({
		
		url:"quickview.php",
		data: {},
		success: function(data){
		
			var thejson = JSON.parse(data);
			
			for(i=0;i<nummachines;i++){
			
				var handle = args[i];
				$(handle).html(thejson[i]);
				
			}
			
			$(".record").html(thejson[3]);
			window.therest = thejson[4];
			
			$("#taptorefresh").html("Content Loaded");
			$("#taptorefresh").slideUp();
			$("#refreshbar").slideUp();
				
				
		}
	
	
	});



}




