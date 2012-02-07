<?php

$email = strip_tags($_POST['email']);
$category = "Category: ".strip_tags($_POST['category']);
$message = strip_tags($_POST['message']);
if(empty($message)){

echo "Sending a blank message isn't very helpful!";
exit(0);

}

if(empty($email)){

echo "Hey, where's your email at?";
exit(0);

}

$message = $category."<br /><br />".strip_tags($_POST['message']);

$to = 'feedback@cardibo.com';
$subject = "New feedback from $email";
$headers= "Content-Type: text/html\r\n";

if(mail($to, $subject, $message, $headers)){

	echo "Thanks for your feedback! Your message was sent successfully.";

}


else{


	echo "There was a problem delivering your message, could you try again?";

}

//uncomment if you want to take the system offline echo "Feedback system temporarily unavailable";

?>