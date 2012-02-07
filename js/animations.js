$(document).ready(function(){  


	var hover = new Array(".splash p a", ".navitem li a");
	hoveranimations(hover);
  
	function hoveranimations(args){

	for(i=0; i<=args.length;i++){

		$(args[i]).mouseover(function(){  
     		   $(this).animate({opacity: 0.3},{queue:false, duration:200})  
		});  
		$(args[i]).mouseout(function(){  
     		   $(this).animate({opacity: 1.0},{queue:false, duration:200})  
		});
	}  //closes for loop
	
	}  //closes function

	
	var splash = new Array(".splash p a");
	
	splashanimation(splash);
	
	function splashanimation(args){
	
		$(splash[0]).click(function(){
		
			$(".splash").animate({opacity: 0.3},{queue:false, duration:200});
			gym = $(this).attr('id');
			initialize(gym);
		
		}); //closes click function
	
	} //closes splashanimation function
	
	function initialize(gym){
		
		
		$.ajax({
     	
     		url: "gymid.php?gym_name=" + gym,
     		success: function(data){
     		
     			gstatus = checkclose();
     		
     		
     		}
     		
     	
     	 }); //closes ajax

	
	}
	
	
	function realtime(){
	
		$.ajax({
     	  
     	 	 url: "realtime.php",
     	 	 success: function(data){
     	 	 
     	 	 $(".splash").slideUp('slow',function(){
     	 	
     	 	 		
     	 	 		$("#nav").slideDown('slow', function(){
     	 	 			
     
     	 	 			$("#quickview").fadeIn('slow',function(){	
     	 					
     	 					$("#content").html(data);
     	 					$("#content").slideDown('slow');
     	 	 			});
     	 	 		
     	 	 		});
     	 	 
     	 	 
     	 	 });
     	 	 
     	 
     	
     	 	var quickview = document.createElement('script');
     	 	quickview.src = "js/quickviewevent.js";	
     	 	document.body.appendChild(quickview);
     	 	
     	 	quickviewupdate(gym);
     	 	
     	 	var handle = ".navitem li a";
     	 	instantiatemenu(gym, handle);
     	 		
			
			} //closes success function
			
			
			
			
			});  //closes ajax
	
	
	
	} //closes realtime function
	
		function instantiatemenu(gym, handle){
		
		morequickview();
	
		$(".navitem li a#realtime").attr('selectz',"true");
	
		$(handle).click(function(){
		
		
		action = $(this).attr('id');
		selector = handle + "#" + action;
		
			if($(this).attr("selectz")=="true"){
		
					
			}
			
			else{
			
			action = $(this).attr('id');
			url = $(this).attr('id') + ".php";
			
				$.ajax({
			
     	 		 url: url,
     	 		 success: function(data, url){
     	 		 
     	 		 if(action == "index"){
     	 		 
     	 		 	
     	 		 	$("#content").slideUp('slow',function(){
     	 		 	
     	 		 	
     	 		 	$("#nav").slideUp('slow',function(){
     	 		 	
     	 		 		$("#gymname").fadeOut();
     	 		 	
     	 		 		$("#quickview").fadeOut(function(){
     	 		 		
     	 		 		$(".splash").animate({opacity: 1.0},{queue:false, duration:200});
     	 		 	
     	 		 		$(".splash").slideDown('slow');
     	 		 		
     	 		 		});
     	 		 	
     	 		 	});
     	 		 	
     	 		 	
     	 		 	
     	 		 	});
     	 		 	
     	 		 
     	 		 }
     	 		 
     	 		 else{
     	 		 
     	 			$("#content").slideUp('slow', function(){
     	 			
     	 				
     	 				$("#content").html(data);
     	 			
     	 					$("#content").slideDown('slow');
     	 					
     	 			
     	 			});
    
    	 	 		$("[selectz=true]").attr("selectz","false");
     	 			$(selector).attr('selectz',"true");
   
     	 
     	 		}
			
				} //closes success function
			
			
			
			
			});  //closes ajax
			
			
			
			} //closes else
			
			
			
		
		});  //closes click action function
		
	
	
	}  //closes instantiate menu
	
	function checkclose(){
	
	$.ajax({
	
		url:'datetest.php',
		success: function(data){
		
			 if(data==1){
			 
			 realtime(gym);
			 
			 }
			 
			 else{
			 
			  $(".splash").slideUp('slow',function(){
			  
			  		$(this).html(data);
			  		$(this).slideDown('slow');
			  		$(this).animate({opacity: 1.0},{queue:false, duration:200});
			  
			  });
			 
			 }
		}

	
	});

	
	
	}
	
	
	function morequickview(){
	
	

	

	
	}
	
	
});  //closes document.ready function
	


