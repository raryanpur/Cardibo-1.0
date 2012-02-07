<?php



	$generate = "<script>
		
		var qtipme = Array(\".treadmill\", \".bike\", \".elliptical\");
		
		createqtips(qtipme);
		
		function createqtips(args){
	
		for(i=0;i<=args.length;i++){
				
		$(args[i]).each(function(){
			$(this).qtip({
	
		content:{
			
			text: \"Loading...\",
			ajax: {
			   url: 'cont.php',
			   type: 'GET',
			   data:{ eid: $(this).attr('id') },
			   datType: 'json',
			   once:false,
			   success: function(data, status){
			   
			   
			   var content = JSON.parse(data);
			   this.set('content.text',content.stringify);
			   
			   }
			
			
			}
		
		},
		
		onHide: function(){
                $(this).qtip('destroy');
        },
		
		style: {
      	
      		classes: 'ui-tooltip-dark ui-tooltip-shadow'
   			
   		},
   		
   		position: {
   		
   			my: 'bottom Left',
   			at: 'top Center'
   		
   		}
   		
   		});
	
	});
	
	}
	
	}
	
	function timer(content){
	
	
	 		   var hours = Math.floor((content.elapsed)/3600) + \"hrs \";
			   var minutes = Math.floor((content.elapsed%3600)/60);
			   var seconds = ((content.elapsed)%3600)/60 - minutes;
			   seconds = Math.floor((seconds*60)) + \"sec \";
			   minutes = minutes + \"min \";
			   var since = content.start;
			   format = \"In Use Since: \" + since + \"<br /> Elapsed Time: \" + hours + minutes + seconds;
	
			  return format;
	
	
	}

</script>";
	
	echo $generate;



?>