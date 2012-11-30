<?php
require_once('classes/email.php');
$name = 'Test Name';
$sender_name = 'Pete Larson';
$email = 'senatorpetelarson@gmail.com';

//Send the email to the friend
	$htmlbody = "<html><body><font face='Arial,Helvetica,Sans-Serif' size='2' style='font-size:14px'>";
	$htmlbody = $htmlbody.$name.',<br><br>Your friend, '.$sender_name.' wanted you to know about mysecurityscore.com where you can take an online quiz and enter a contest to win a full conference pass to RSA 2013. <a href="http://mysecurityscore.com" target="_blank">Click here</a> to take the quiz and enter the contest.';
	$htmlbody = $htmlbody."</font><br><br></body>";
	$textbody = 'Your friend, '.$sender_name.' wanted you to know about mysecurityscore.com where you can take an online quiz and enter a contest to win a full conference pass to RSA 2013.<br><br>Visit http://mysecurityscore.com to take the quiz and enter the contest.';
	$from = "info@mysecurityscore.com";
	$to = $email;
	$subject = $sender_name." invites you to win a full conference pass to RSA 2013";
	// $subject = " invites you to win a full conference pass to RSA 2013";
	$email = new email();
	$success = $email->sendMail($from,$to,$subject,$textbody,$htmlbody);
	echo $success;
?>