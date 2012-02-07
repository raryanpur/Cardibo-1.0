<script>

function send(){

	var feedbackemail = $("[name=email]").val();
	var feedbackcategory = $("#category option:selected").text();
	var feedbackmessage = $("textarea").val();
	var datapost = {email: feedbackemail, category: feedbackcategory, message: feedbackmessage};
	
	$.ajax({
	
		url:'feedbackprocessor.php',
		type: 'POST',
		beforeSend: function(){
		
			$("#returnmessage").html("Sending message...");	
		
		},
		data: datapost,
		success: function(data){
		
			$("#returnmessage").html(data);
		
		
		}
	
	
	});	

}

</script>

<div id = "betastuff">
<p class = "betainfo">

Nobody's perfect, and we're looking for your suggestions on how we can make things better.  Go ahead and fill out the form below and hit submit to get our attention, or email us directly at contact@cardibo.com.



</p>
<p class = "betainfo"><input type = "email" name = "email" size="40" /> Your Email Address<br /><br />

<select id = "category">

	<option>Select a Category</option>
	<option>Slow Site</option>
	<option>Inaccurate Information</option>
	<option>Website Layout Issues</option>
	<option>I Drank Too Much Last Night, Now I'm Paying the Price in the Gym</option>
	<option>I Hate Working Out</option>
	<option>Other</option>
	
</select>&nbsp; What's up?<br /><br />



<textarea rows = "15" cols = "60"></textarea><br />
<input type = "submit" value = "Send" onclick="send()" /><br /><br />
<div id = "returnmessage"></div>
</p>
</div>