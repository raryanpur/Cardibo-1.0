<script type="application/javascript" src="cubiq/src/iscroll.js"></script>

<script type="text/javascript"> 
 
var myScroll;
//required for scroll
function loaded() {}
//also required for scroll 
document.addEventListener('DOMContentLoaded', loaded, false);

//send window to top (so you can see the banner)
window.scrollTo(0, 0);

//action for refreshing new data through ajax
$('#taptorefresh').click(function(){

	$(this).html("<img src = '../images/ajax-loader.gif' height = '15' width = '15'> &nbsp;&nbsp;Loading...");
	quickview();
	counter(0);

});

$(".question").click(function(){

	$(".answer").fadeIn();

}); 
</script>


<div id = "taptorefresh">
		
		Last Updated: 4:52 PM <br />
		Tap to Update
	
</div>
<div id = "refreshbar"></div>

<div id = "menu">
	<div class ="content">
	
	

	<span class = "text">Machines Available</span> 

	
	<ul id = "currentstats">
		<a href="#dialog" name = "modal">
			
			<li id = "treadmill"></li></a>
			
			<div id = "tstatus"></div>
		
			<li id = "elliptical"></li><div id = "estatus">0/0</div>
		
			<li id = "bike"></li><div id = "bstatus">0/0</div>	
			
			
	</ul>
	

	</div>
	
	
	<div class = "content"><span class = "text">The gym closes at 10:30 PM today.</span></div> 
	<div class = "content"><span class = "text">Today's Longest Runs
			<div class = "record">
			
			
			</div>
			
	</div>
	<div class = "content">
		<span class = "text">Daily Trivia by @yuliasashi<br /></span>
		<span class = "question">In what year was Tufts chartered? (Tap for Answer)</span>
		</p>
		<span class = "answer">Tufts was chartered in 1852.</span>
	</div>
	

	<div id = "mask"></div>

 
	<!-- Modal Window -->
 
    <div id="dialog" class="window">
        
        <div id = "wrapper">
        	<div id = "scroller">
        	<ul id = "list">
      			<li class = "treadmill1"></li>
        		<li class = "treadmill2"></li>
        		<li class = "treadmill1"></li>
        		<li class = "treadmill2"></li>
        		<li class = "treadmill1"></li>
        		<li class = "treadmill2"></li>
        	</ul>
 			</div>
 		<ul id="indicator">
			<li class="active">1</li>
			<li>2</li>
			<li>3</li>
			<li>4</li>
			<li>5</li>
			<li>6</li>
			<li>7</li>
			<li>8</li>
		</ul>	
 		</div>
 		<div id = "datascreen">
 		
 			
 			<div id = "since">Since: Loading...</span><br /></div>
 			<div id = "elapsed">Elapsed: Loading...<br /></div>

 		
 			<a href="#" class = "close"><div id = "close"></div></a>	
 		
 		</div>
 
 		
 		
    </div> <!-- ends dialog -->
    <!-- end of popup stuff-->
 
</div>
 






<script>

   //initialize globals
   
   var windowcounter = 0;  
   var elapsedtime = 0; 
   var start;
   var t;
   var s;
   
   //start timer
   
   counter();
     
	//timer function

	function counter(counterreset){
	
		//if data was refreshed, do this:
	
		if(counterreset == 0){
		
			windowcounter = 0;
			clearTimeout(s);
		}
	
		
		//if 60 seconds have gone by, display the refresh message
		
		if(windowcounter >=60){
		
			$('#taptorefresh').html("<div class = 'datarefresh'>Data Update Available...Tap to Refresh</div>");
			$('#taptorefresh').slideDown(1000);
			$('#refreshbar').slideDown(1000);
		
		}
		
		//update counter
		
		windowcounter = windowcounter + 1;
		
		//loop
		
		s = setTimeout("counter()", 1000);
	
	}

    //modal stuff
    
    $('a[name=modal]').click(function(e) {
        //Cancel the link behavior
        e.preventDefault();
        //Get the A tag
        var id = $(this).attr('href');
              
        //transition effect     
        $('#mask').fadeIn(1000);    
        $('#mask').fadeTo("slow",0.8);  
     
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();
               
        //Set the popup window to center
        $(id).css('top',  30);
        $(id).css('left', winW/2-$(id).width()/2 - 8);
     
     	//set the images for the machines in that row
     	var curimages = "";
     	for(i=0;i<=7;i++){
     	
     		var curimages = curimages + (window.therest[i]['code']);
     	}
     	
     	//update the images
     	
     	$('#list').html(curimages);
     	
     	//get variables from returned JSON
     	
     	start = window.therest[0]['start'];
     	elapsedtime = window.therest[0]['elapsed'];
     	curact = window.therest[0]['activity'];
     	
     	//call this when modal loads so first machine has updated information
     	elapsed(curact);
        
        //transition effect
        $(id).toggle(); 
        
        //define myScroll and its parameters
        myScroll = new iScroll('wrapper', {snap: 'li', momentum:false,
        onScrollEnd: function(){
		//update location dot
			document.querySelector('#indicator > li.active').className = '';
			document.querySelector('#indicator > li:nth-child(' + (this.currPageX+1) + ')').className = 'active';
			
		//clear timer for previous machine
			clearTimeout(t);
			
			//get relevant variables from returned JSON
			
			elapsedtime = window.therest[this.currPageX]['elapsed'];
			curact = window.therest[this.currPageX]['activity'];
			start = window.therest[this.currPageX]['start'];
			
			//call to start clock and set data from json
			
	    	elapsed(curact);   	
           
           }
        
        });

    });
     
    //if close button is clicked
    $('.window .close').click(function (e) {
        //Cancel the link behavior
        e.preventDefault();
        $('#mask, .window').hide();
        myScroll.destroy();
		myScroll = null;
    });     
     
    //if mask is clicked
    $('#mask').click(function () {
        $(this).hide();
        $('.window').hide();
        document.querySelector('#indicator > li.active').className = '';
		document.querySelector('#indicator > li:nth-child(1)').className = 'active';
        myScroll.destroy();
		myScroll = null;
    });    
    
    //deal with clock and updating data for each machine
    
    function elapsed(checkers){
    
    	 //what to do if the machine is available
    	 
    	 if(checkers == 0){
    	 
    	 	$("#elapsed").html("");
    	 	$("#since").html(start);	
    	 
    	 }
    	 
    	 //otherwise do this if the machine is occupied
    	 
    	 else{
    	 
    	 //update the timer
    	 
    	 curclock = elapsedtime + windowcounter;
    
    	 //format everything from unix timestamps to something useful
    
     	 var hours = Math.floor((curclock)/3600);
		 var minutes = Math.floor((curclock%3600)/60);
		 var seconds = ((curclock)%3600)/60 - minutes;
		 seconds = Math.round((seconds*60)) + "sec";
		 minutes = minutes + "min ";
			   
		  
	    	if(hours != 0){
			format = "Elapsed Time:<br /> " + hours + "hrs " + minutes + seconds;
			}
			else{
			format = "Elapsed Time:<br /> " + minutes + seconds;
			}

		 //anndddddd...update the DOM
		
    	 $("#elapsed").html(format);
    	 $("#since").html(start);
    	 
    	 //keep updating
    	 
    	 t = setTimeout("elapsed()",1000);
    	 
		 }
    
    } 
    

</script>
