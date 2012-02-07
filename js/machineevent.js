function updatemachines(gym){

	

	$.ajax({
	
		url: "realtime/refresh.php?gym_id=" + gym,
		success: function(data){
		
			var thejson = JSON.parse(data);
			
			for(i=0;i<thejson.length;i++){
			//alert(thejson[i].code);
			//var selector = ".treadmill #" + thejson[i].id;
			if(i<8){
			var selector = "#gymview #treadmills #" + thejson[i].id ;
			}
			if(i>=8 && i<18){
			var selector = "#gymview #bikes #" + thejson[i].id ;
			}
			if(i>=18){
			var selector = "#gymview #ellipticals #" + thejson[i].id ; 
			}
			var divclass = thejson[i].code;
			$(selector).html(divclass);
			
			}
			
			
			
		}
	
		
	});

}


function qtips(){

	$.ajax({
	
		url: "realtime/qtips.php?gym_id=" + gym,
		success: function(data){
		
			
			$("#qtips").html(data);
			updatemachines(gym);
			
		
		}
	
		
	});
	
	

}




