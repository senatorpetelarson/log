<?php
require_once('classes/database.php');
require_once('../db_conn.php');
	if($_POST && count($_POST) > 0) {
		$database = new database(CONST_HOST,CONST_USER,CONST_DB_PASSWORD,CONST_DB_NAME);
		if($_POST['contest-first-name']) {
			$first_name = $_POST['contest-first-name'];
		}
		if($_POST['contest-last-name']) {
			$last_name = $_POST['contest-last-name'];
		}
		if($_POST['contest-email']) {
			$email = $_POST['contest-email'];
		}
		if($_POST['contest-company']) {
			$company = $_POST['contest-company'];
		}
		if($_POST['contest-phone']) {
			$phone = $_POST['contest-phone'];
		}
		if($_POST['contest-country']) {
			$country = $_POST['contest-country'];
		}
		if($_POST['contest-state']) {
			if($country == "United States of America") {
				$state = $_POST['contest-state'];
			} else {
				$state = "";
			}
		}
		
		$strQuery = "INSERT INTO contest_entries (first_name,last_name,email,company,phone,country,state) VALUES ('$first_name','$last_name','$email','$company','$phone','$country','$state');";
		$database->setQuery($strQuery);
		$database->query();
	}
?>