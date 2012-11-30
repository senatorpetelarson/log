<?php
session_start();
// $isSessionActive = (session_id() != "");
// if(!$isSessionActive) { session_start(); }
require_once('classes/email.php');
require_once('classes/database.php');
require_once('../db_conn.php');

$name = '';
$sender_name = '';
$sender_email = '';
$error_message = '';
$sender_last_name = '';
$results = '';
$count = -1;
if($_POST && count($_POST) > 0) {
	if($_POST['form_results']) {
		$results = $_POST['form_results'];
	}
	if($_POST['sender-last-name']) {
		$sender_last_name = $_POST['sender-first-name'];
	}
	if($_POST['sender-first-name']) {
		$sender_name = $_POST['sender-first-name']." ".$sender_last_name;
	}
	if($_POST['sender-email']) {
		$sender_email = $_POST['sender-email'];
	}
	if($_POST['colleague-name']) {
		$name = $_POST['colleague-name'];
	}
	if($_POST['colleague-email']) {
		$email = $_POST['colleague-email'];
	}

	//add the extra contest entry
	if($_SESSION['contest_entered'] && $_SESSION['contest_entered'] == true) {
		$database = new database(CONST_HOST,CONST_USER,CONST_DB_PASSWORD,CONST_DB_NAME);
		$strQuery = "SELECT email FROM contest_entries WHERE email = '$sender_email'";
		$database->setQuery($strQuery);
		$database->query();
		$result = $database->getObjectList();
		if($result && (count($result) > 2)) {
			//There has already been one forward to a friend
			$error_message = "Sorry, you have already been entered a second time in the contest.";
		}
	}
	//send the results email
	$htmlbody = "<html><body><font face='Arial,Helvetica,Sans-Serif' size='2' style='font-size:14px'>";
	$htmlbody = $htmlbody.$first_name.',<br><br><strong>Following are the results of the quiz you took at <a href="http://mysecurityscore.com" target="_blank">mysecurityscore.com</a>:</strong>';
	$htmlbody = $htmlbody.$results;
	$htmlbody = $htmlbody."</font><br><br></body>";
	$textbody = 'Following are the results of the quiz you took at http://mysecurityscore.com:'."\n\n".str_replace("<p>","",$results,&$count);
	$from = "info@mysecurityscore.com";
	$to = $email;
	$subject = "Your results from mysecurityscore.com";
	$email = new email();
	$success = $email->sendMail($from,$to,$subject,$textbody,$htmlbody);

	//send the forward email
	if($sender_email !='') {
		$htmlbody = "<html><body><font face='Arial,Helvetica,Sans-Serif' size='2' style='font-size:14px'>";
		$htmlbody = $htmlbody.$name.',<br><br>Your friend, '.$sender_name.' wanted you to know about mysecurityscore.com where you can take an online quiz and enter a contest to win a full conference pass to RSA 2013. <a href="http://mysecurityscore.com" target="_blank">Click here</a> to take the quiz and enter the contest.';
		$htmlbody = $htmlbody."</font><br><br></body>";
		$textbody = 'Your friend, '.$sender_name.' wanted you to know about mysecurityscore.com where you can take an online quiz and enter a contest to win a full conference pass to RSA 2013.<br><br>Visit http://mysecurityscore.com to take the quiz and enter the contest.';
		$from = "info@mysecurityscore.com";
		$to = $email;
		$subject = $sender_name." invites you to win a full conference pass to RSA 2013";
		$forward_success = $email->sendMail($from,$to,$subject,$textbody,$htmlbody);
	}
}
echo $success;
?>