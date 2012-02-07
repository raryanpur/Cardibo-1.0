<link rel="stylesheet" href = "trends.css" />
<link rel="stylesheet" href = "../js/jquery_ui/css/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery_ui/js/jquery-ui-1.8.16.custom.min.js"></script>
 <style type="text/css">
  .ui-slider-horizontal .ui-state-default {background:url('trendsslider.png') no-repeat scroll 50% 50%;}
  </style>
<div id="trendswrap">
<div id="content-scroll">
  <div id="content-holder">
     
    	<div class = "content-itemgreen">1</div>
    	<div class = "content-itemred">2</div>
    	<div class = "content-itemyellow">3</div>
    	<div class = "content-itemgreen">4</div>
    	<div class = "content-itemyellow">5</div>
    	<div class = "content-itemyellow">6</div>
    	<div class = "content-itemred">7</div>
    	<div class = "content-item">8</div>
    	<div class = "content-item">9</div>
    	<div class = "content-item">10</div>
    	<div class = "content-item">11</div>
    	<div class = "content-item">12</div>
    	<div class = "content-item">13</div>
    	<div class = "content-item">14</div>
    	<div class = "content-item">15</div>
    	<div class = "content-item">16</div>
    	<div class = "content-item">17</div>
    	<div class = "content-item">18</div>
    	<div class = "content-item">19</div>
    	<div class = "content-item">20</div>
    	<div class = "content-item">21</div>
    	<div class = "content-item">22</div>
    	<div class = "content-item">23</div>
    	<div class = "content-item">24</div>
    	<div class = "content-item">25</div>
    	<div class = "content-item">26</div>
    	<div class = "content-item">27</div>
    	<div class = "content-item">28</div>
    	<div class = "content-item">29</div>
    	<div class = "content-item">30</div>
    	<div class = "content-item">31</div>
    	<div class = "content-item">32</div>


  </div>
</div>
<div id="content-slider"></div>
</div>


<script>

$(document).ready(function(){

  var tot = 32;
  $("#content-slider").slider({
    animate: true,
    min: 0,
    max: 960,
    step:32,
    slide: function(e, ui) {  
  
        $("#content-holder").css("left", "-" + ui.value + 368 +  "px");  
      }  
  });
});

</script>