function layout(gymid){
	
	/*$.modal("<div id = 'disclaimer'><p><b>Welcome!</b> <br /><br />Thanks for using Cardibo.  For a mobile-optimized experience, visit www.cardibo.com from your phone's web browser.<br /><br />All machines are now wired up and available for viewing on the site! <br /><br />You can hover over any machine to get more detailed information about it. <br /><br />One last thing--any depictions of gender are completely coincidental!  We don\'t (and won\'t ever) have the ability to tell gender, so don\'t freak out.  Thanks again for visiting and enjoy.</p></div>",{position: ["10%","20%"]}); // HTML*/

	
	$("#gymview").html("<p>Loading, sorry :-/ ...Nice pants, you thinking about hitting the gym in those?</p>");
	granola = new Image();
	granola.src = '../images/icons/granola.png';
	granola.onload = function(){

	$.ajax({
	
		
		url: "realtime/gymlayout.php?gym_id=" + gymid,
		beforeSend: function(){
		
			$("#gymview").html("<p>Loading, sorry :-/ ...Nice pants, you thinking about hitting the gym in those?</p>");
		
		},
		success: function(data){
		
			
			$("#gymview").html(data);
			qtips();
			
		
		}
	
		
	});
	
	};
	
	

}
