<?php
session_start();
$_SESSION['contest_entered'] = false;
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
		$strQuery = "SELECT email FROM contest_entries WHERE email = $email";
		$database->setQuery($strQuery);
		$database->query();
		$result = $database->getObjectList();
		if(count($result) > 0) {
			$contest_entry_error = 'You have already signed up for this contest';
		} else {
			$contest_entry_error = '';
			$strQuery = "INSERT INTO contest_entries (first_name,last_name,email,company,phone,country,state) VALUES ('$first_name','$last_name','$email','$company','$phone','$country','$state');";
			$database->setQuery($strQuery);
			$database->query();
		}
		$_SESSION['contest_entered'] = true;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Take our 3 min. cyber threat readiness quiz today, and find out if you can defend against, detect and respond to advanced cyber threats" />
<meta name="keywords" content="Advanced threats, network protection, IT security, file integrity monitoring, log data analysis, SIEM, log management, continuous monitoring, how to prevent cyber threats, hacking, online security. Log data protection, compliance" />

<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />

<!-- set the viewport for mobile devices -->
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0' name='viewport' />

<link rel="stylesheet" type="text/css" media="all" href="resources/css/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="resources/css/forms.css" />
<link rel="stylesheet" type="text/css" media="all" href="resources/css/reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="resources/js/jqtransform.css" />
<link rel="stylesheet" type="text/css" media="all" href="resources/css/colorbox.css" />

<script type="text/javascript" src="resources/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="resources/js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="resources/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="resources/js/jquery.cycle.js"></script>
<script type="text/javascript" src="resources/js/jquery.jqtransform.js"></script>
<script type="text/javascript" src="resources/js/site.js"></script>

<title>Cyber Readiness Quiz</title>
</head>
<body>
	<!-- header -->
	<div id="header" class="center-text">
		<div id="logo" class="center-text">
			<a href="http://www.logrhythm.com/" target="_blank"><img src="resources/img/logo-new.png" border="0" /></a>
		</div>
	</div>
	<!-- header end -->
	<h1 class="site-heading">The 2nd Annual<br>Cyber Threat Readiness Quiz</h1>
	<div class="heading-rule"></div>
	
	<!-- content -->
	<div id="content-wrapper"><div id="content-words">
		<div id="content-form" class="center-text">
		<form action="results.php" class="form-h2" name="quiz" method="post">
			<!-- A -->
			
			<div class="question-wrapper">
				<p style="font-size:12px;width:620px;margin:auto;margin-bottom:16px;text-align:left;">NOTE: candid answers will yield more accurate results. If the word &quot;you&quot; does not seem applicable to you, please answer the questions as they would apply to a member of your staff, and/or, pass this link along to someone in your organization better able to answer them.</p>
				<div id="formMain" class="A center-text center-marg form-question">
				<div id="progressBar">
					<img src="resources/img/progress_1.png" />
				</div>
				<div id="formfields" class="A spacer-top-15">
					<fieldset>
						<label for="organization-size" style="float:left;">Organization Size:&nbsp;&nbsp;</label>
						<select name="organization-size" id="organization-size">
							<option  value="">Number of Employees</option>
							<option  value="500orless">&lt; 500</option>
							<option value="501to1000">501 - 1000</option>
							<option value="1001to5000">1001 - 5000</option>
							<option value="5001to10000">5001 - 10,000</option>
							<option value="10001to50000">10,001 - 50,000</option>
							<option value="50000plus">50,000+</option>
						</select>
					</fieldset>
					<fieldset style="margin-top:11px">
						<label for="role" style="float:left">Role:&nbsp;&nbsp;</label>
						<select name="role" id="role">
							<option>Select a Role</option>
							<option>CIO/CTO</option>
							<option>CISO/Information Security Officer</option>
							<option>IT/Systems Administrator</option>
							<option>IT/Security Auditor</option>
							<option>Director/Manager of Security</option>
							<option>Director/Manager of IT/Systems</option>
							<option>Other IT Staff</option>
							<option>Other</option>
						</select>
					</fieldset>
					<fieldset style="margin-top:11px">
						<label for="industry" style="float:left">Industry:&nbsp;&nbsp;</label>
						<select name="industry" id="industry">
							<option value="">Select an Industry</option>
							<option>Government -- state and local</option>
							<option>Government -- federal</option>
							<option>Public Sector</option>
							<option>Financial services</option>
							<option>Retail</option>
							<option>Healthcare</option>
							<option>Education</option>
							<option>Manufacturing</option>
							<option>Technology</option>
							<option>Communications</option>
							<option>Transportation</option>
							<option>Energy</option>
							<option>Utilities</option>
							<option>Other</option>
						</select>
					</fieldset>
				</div> <!-- end of form fields -->
				<div class="rule"></div>
				<p class="spacer-top-20" style="font-size:15px;">Which of the following best describes THE PRIMARY DRIVER behind your information security investments? <small>(While we understand that there may be multiple drivers, please select the SINGLE MOST important driver for your organization from this list):</small></p>
				<div id="formfields" class="A-b spacer-top-30">
					<fieldset>
						<dl>
							<dt><label for="comply-with-regulations">Comply with Regulations</label></dt>
							<dd>
								<input name="primary-driver" value="comply-with-regulations" type="radio" id="comply-with-regulations-yes" />
								<label for="comply-with-regulations-yes"></label>
							</dd>
						</dl>
						
						<dl>
							<dt><label for="executivelevel-initiative">Executive-Level Initiative</label></dt>
							<dd>
								<input name="primary-driver" value="executivelevel-initiative" type="radio" id="executivelevel-initiative-yes" />
								<label for="executivelevel-initiative-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="protect-customer-data">Protect Customer Data</label></dt>
							<dd>
								<input name="primary-driver" value="protect-customer-data" type="radio" id="protect-customer-data-yes" />
								<label for="protect-customer-data-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="protect-your-network">Protect your Network</label></dt>
							<dd>
								<input name="primary-driver" value="protect-your-network" type="radio" id="protect-your-network-yes" />
								<label for="protect-your-network-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="protect-sensitive-internal-data">Protect Sensitive Internal Data</label></dt>
							<dd>
								<input name="primary-driver" value="protect-sensitive-internal-data" type="radio" id="protect-sensitive-internal-data-yes" />
								<label for="protect-sensitive-internal-data-yes"></label>
							</dd>
						</dl>						
					</fieldset>
				</div> <!-- end of form fields -->
				<div class="nextPane clear">
					<a href="#"><img src="resources/img/next.jpg" /></a>
				</div>
			</div></div>
			
			
			<!-- B -->
			<div class="question-wrapper"><div id="formMain" class="B center-text center-marg form-question">
				<div id="progressBar">
					<img src="resources/img/progress_2.png" />
				</div>
				<h4 class="spacer-top-10">TOOLS INVENTORY</h4>	
				<div class="rule"></div>
				<p class="spacer-top-20" style="font-size:15px;margin-left:45px;margin-right:45px;">Please indicate which of the following tools/technologies are currently in use as part of your overall security infrastructure: <small>(please check all that apply)</small></p>	
				<div id="formfields" class="B spacer-top-15">
					<fieldset>
						<dl>
							<dt><label for="antimalwareantivirus">Anti-Malware/Anti-Virus</label></dt>
							<dd>
								<input name="antimalwareantivirus" type="checkbox" value="30" id="antimalwareantivirus-yes" />
								<label for="antimalwareantivirus-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="data-loss-prevention-dlp">Data Loss Prevention (DLP)</label></dt>
							<dd>
								<input name="data-loss-prevention-dlp" type="checkbox" value="10" id="data-loss-prevention-dlp-yes" />
								<label for="data-loss-prevention-dlp-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="databaseapplication-monitoring">Database/Application Monitoring</label></dt>
							<dd>
								<input name="databaseapplication-monitoring" type="checkbox" value="20" id="databaseapplication-monitoring-yes" />
								<label for="databaseapplication-monitoring-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="file-integrity-monitoring">File Integrity Monitoring</label></dt>
							<dd>
								<input name="file-integrity-monitoring" type="checkbox" value="30" id="file-integrity-monitoring-yes" />
								<label for="file-integrity-monitoring-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="firewall">Firewall</label></dt>
							<dd>
								<input name="firewall" type="checkbox" value="20" id="firewall-yes" />
								<label for="firewall-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="network-flow-analysis">Network Flow Analysis</label></dt>
							<dd>
								<input name="network-flow-analysis" type="checkbox" value="20" id="network-flow-analysis-yes" />
								<label for="network-flow-analysis-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="identity-and-access-management-iam">Identity &amp; Access Management (IAM)</label></dt>
							<dd>
								<input name="identity-and-access-management-iam" type="checkbox" value="20" id="identity-and-access-management-iam-yes" />
								<label for="identity-and-access-management-iam-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="intrusion-detectionprevention-systems-idsips">Intrusion Detection/Prevention Systems (IDS/IPS)</label></dt>
							<dd>
								<input name="intrusion-detectionprevention-systems-idsips" value="30" type="checkbox" id="intrusion-detectionprevention-systems-idsips-yes" />
								<label for="intrusion-detectionprevention-systems-idsips-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="log-management">Log Management</label></dt>
							<dd>
								<input name="log-management" type="checkbox" value="30" id="log-management-yes" />
								<label for="log-management-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="network-access-control-nac">Network Access Control (NAC)</label></dt>
							<dd>
								<input name="network-access-control-nac" type="checkbox" value="10" id="network-access-control-nac-yes" />
								<label for="network-access-control-nac-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="networkbased-anomaly-detection-nbad">Network-Based Anomaly Detection (NBAD)</label></dt>
							<dd>
								<input name="networkbased-anomaly-detection-nbad" type="checkbox" value="20" id="networkbased-anomaly-detection-nbad-yes" />
								<label for="networkbased-anomaly-detection-nbad-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="nextgeneration-firewall">Next-Generation Firewall</label></dt>
							<dd>
								<input name="nextgeneration-firewall" type="checkbox" value="30" id="nextgeneration-firewall-yes" />
								<label for="nextgeneration-firewall-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="security-information-and-event-management-siem">Security Information &amp; Event Management (SIEM)</label></dt>
							<dd>
								<input name="security-information-and-event-management-siem" value="30" type="checkbox" id="security-information-and-event-management-siem-yes" />
								<label for="security-information-and-event-management-siem-yes"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="vulnerability-management">Vulnerability Management</label></dt>
							<dd>
								<input name="vulnerability-management" type="checkbox" value="30" id="vulnerability-management-yes" />
								<label for="vulnerability-management-yes"></label>
							</dd>
						</dl>						
					</fieldset>
				</div> <!-- end of form fields -->
				<div class="nextPane clear">
					<a href="#"><img src="resources/img/next.jpg" /></a>
				</div>
				<div class="prevPane clear">
					<a href="#"><img src="resources/img/back.jpg" /></a>
				</div>
			</div></div>
			
			
			
			
			<!-- C -->
			<div class="question-wrapper"><div id="formMain" class="C center-text center-marg form-question">
				<div id="progressBar">
					<img src="resources/img/progress_3.png" />
				</div>
				<h4 class="spacer-top-10">PREVENTION &amp; RESPONSE STRATEGIES</h4>	
				<div class="rule"></div>
				
				<div id="formfields" class="C spacer-top-30">
					<fieldset>
					<table width="790" cellspacing="1" cellpadding="2">
					<tr>
						<th class="label-column">Rate Your Organization's…</th>
						<th align="center">Strong</th>
						<th align="center">Needs Improvement</th>
						<th align="center">Weak</th>
					</tr>
					<tr>
						<td valign="middle" width="390" align="left" class="label-column"><label for="continuous-monitoring-of-the-most-likely-targets-of-an-attack-in">Continuous monitoring of the most<br>likely targets of an attack in your network</label></td>
						<td valign="middle" width="110" align="center"><input value="30" name="continuous-monitoring-of-the-most-likely-targets-of-an-attack-in" type="radio" id="continuous-monitoring-of-the-most-likely-targets-of-an-attack-in-your" /></td>
						<td valign="middle" align="center"><input value="15" class="midC med" name="continuous-monitoring-of-the-most-likely-targets-of-an-attack-in" type="radio" id="continuous-monitoring-of-the-most-likely-targets-of-an-attack-in" /></td>
						<td valign="middle" width="110" align="center"><input value="0" class="low" name="continuous-monitoring-of-the-most-likely-targets-of-an-attack-in" type="radio" id="continuous-monitoring-of-the-most-likely-targets-of-an-attack-in" /></td>
					</tr>
					<tr>
						<td valign="middle" align="left" class="label-column"><label for="incident-response-management">Incident response management</label></td>
						<td valign="middle" align="center"><input value="30" class="high" name="incident-response-management" type="radio" id="incident-response-management-sufficient" /></td>
						<td valign="middle" align="center"><input value="15" class="midC med" name="incident-response-management" type="radio" id="incident-response-management-needs-improvement" /></td>
						<td valign="middle" align="center"><input value="0" class="low" name="incident-response-management" type="radio" id="incident-response-management-insufficient" /></td>
					</tr>
					<tr>
						<td valign="middle" align="left" class="label-column"><label for="behavioral-modeling-of-your-most-critical-assets">Ability to baseline host, network &amp; user behavior</label></td>
						<td valign="middle" align="center"><input value="30" class="high" name="behavioral-modeling-of-your-most-critical-assets" type="radio" id="behavioral-modeling-of-your-most-critical-assets-sufficient" /></td>
						<td valign="middle" align="center"><input value="15" class="midC med" name="behavioral-modeling-of-your-most-critical-assets" type="radio" id="behavioral-modeling-of-your-most-critical-assets-needs-improvement" /></td>
						<td valign="middle" align="center"><input value="0" class="low" name="behavioral-modeling-of-your-most-critical-assets" type="radio" id="behavioral-modeling-of-your-most-critical-assets-insufficient" /></td>
					</tr>
					<tr>
						<td valign="middle" align="left" class="label-column"><label for="independent-monitoring-of-critical-data-files-and-file-systems">Independent monitoring of critical data, files &amp; file systems</label></td>
						<td valign="middle" align="center"><input value="30" class="high" name="independent-monitoring-of-critical-data-files-and-file-systems" type="radio" id="independent-monitoring-of-critical-data-files-and-file-systems-sufficient" /></td>
						<td valign="middle" align="center"><input value="15" class="midC med" name="independent-monitoring-of-critical-data-files-and-file-systems" type="radio" id="independent-monitoring-of-critical-data-files-and-file-systems-needs-improvement" /></td>
						<td valign="middle" align="center"><input value="0" class="low" name="independent-monitoring-of-critical-data-files-and-file-systems" type="radio" id="independent-monitoring-of-critical-data-files-and-file-systems-insufficient" /></td>
					</tr>
					<tr>
						<td valign="middle" align="left" class="label-column"><label for="collecting-centralizing-and-analyzing-log-data">Defined process to implement security system updates (anti-virus/IDS/NGFW signature updates, etc.)</label></td>
						<td valign="middle" align="center"><input value="30" name="collecting-centralizing-and-analyzing-log-data" type="radio" id="collecting-centralizing-and-analyzing-log-data-sufficient" /></td>
						<td valign="middle" align="center"><input value="15" class="midC" name="collecting-centralizing-and-analyzing-log-data" type="radio" id="collecting-centralizing-and-analyzing-log-data-needs-improvement" /></td>
						<td valign="middle" align="center"><input value="0" name="collecting-centralizing-and-analyzing-log-data" type="radio" id="collecting-centralizing-and-analyzing-log-data-insufficient" /></td>
					</tr>
					<tr>
						<td valign="middle" align="left" class="label-column"><label for="ongoing-patch-management-and-updating">Patch management</label></td>
						<td valign="middle" align="center"><input value="30" name="ongoing-patch-management-and-updating" type="radio" id="ongoing-patch-management-and-updating-sufficient" /></td>
						<td valign="middle" align="center"><input value="15" class="midC" name="ongoing-patch-management-and-updating" type="radio" id="ongoing-patch-management-and-updating-needs-improvement" /></td>
						<td valign="middle" align="center"><input value="0" name="ongoing-patch-management-and-updating" type="radio" id="ongoing-patch-management-and-updating-insufficient" /></td>
					</tr>
					<tr>
						<td valign="middle" align="left" class="label-column"><label for="password-management-and-enforcement-across-all-systems">Use of Identity &amp; Access Management (IAM)</label></td>
						<td valign="middle" align="center"><input value="30" name="password-management-and-enforcement-across-all-systems" type="radio" id="password-management-and-enforcement-across-all-systems-sufficient" /></td>
						<td valign="middle" align="center"><input value="15" class="midC" name="password-management-and-enforcement-across-all-systems" type="radio" id="password-management-and-enforcement-across-all-systems-needs-improvement" /></td>
						<td valign="middle" align="center"><input value="0" name="password-management-and-enforcement-across-all-systems" type="radio" id="password-management-and-enforcement-across-all-systems-insufficient" /></td>
					</tr>
					<tr>
						<td valign="middle" align="left" class="label-column"><label for="use-of-ipdomain-reputation-lists">Use of external context/information (threat intelligence data, IP reputation, geolocation, etc.)</label></td>
						<td valign="middle" align="center"><input value="30" name="use-of-ipdomain-reputation-lists" type="radio" id="use-of-ipdomain-reputation-lists-sufficient" /></td>
						<td valign="middle" align="center"><input value="15" class="midC" name="use-of-ipdomain-reputation-lists" type="radio" id="use-of-ipdomain-reputation-lists-needs-improvement" /></td>
						<td valign="middle" align="center"><input value="0" name="use-of-ipdomain-reputation-lists" type="radio" id="use-of-ipdomain-reputation-lists-insufficient" /></td>
					</tr>
				</table>
					</fieldset>
				</div> <!-- end of form fields -->
				<div class="nextPane clear">
					<a href="#"><img src="resources/img/next.jpg" /></a>
				</div>
				<div class="prevPane clear">
					<a href="#"><img src="resources/img/back.jpg" /></a>
				</div>
			</div></div>
			
			
			
			
			<!-- D -->
			<div class="question-wrapper"><div id="formMain" class="D center-text center-marg form-question">
				<div id="progressBar">
					<img src="resources/img/progress_4.png" />
				</div>
				<h4 class="spacer-top-10">VISIBILITY &amp; DETECTION</h4>	
				<div class="rule"></div>
				<div id="formfields" class="D spacer-top-30">
					<fieldset>
					<table width="922" cellspacing="1" cellpadding="2">
					<tr>
						<th class="label-column">Rate Your Organization's…</th>
						<th align="center">Confident</th>
						<th align="center">Somewhat Confident</th>
						<th align="center">Not Very Confident</th>
						<th align="center">Not At All Confident</th>
					</tr>
					<tr>
						<td valign="middle" width="291" align="left" class="label-column"><label for="ability-to-know-immediately-when-hosts-are-compromised">Ability to know in near real-time when hosts are compromised</label></td>
						<td valign="middle" width="94" align="center"><input value="30" class="d1c" name="ability-to-know-immediately-when-hosts-are-compromised" type="radio" id="ability-to-know-immediately-when-hosts-are-compromised-confident" /></td>
						<td valign="middle" align="center"><input class="d2c" value="15" name="ability-to-know-immediately-when-hosts-are-compromised" type="radio" id="ability-to-know-immediately-when-hosts-are-compromised-somewhat-confident" /></td>
						<td valign="middle" align="center"><input value="7.5" class="d3c" name="ability-to-know-immediately-when-hosts-are-compromised" type="radio" id="ability-to-know-immediately-when-hosts-are-compromised-not-very-confident" /></td>
						<td valign="middle" align="center"><input value="0" class="d4c" name="ability-to-know-immediately-when-hosts-are-compromised" type="radio" id="ability-to-know-immediately-when-hosts-are-compromised-not-at-all-confident" /></td>
					</tr>
					<tr>
						<td valign="middle" width="291" align="left" class="label-column"><label for="ability-to-know-immediately-when-user-credentials-are-compromise">Ability to know in near real-time when user credentials are compromised</label></td>
						<td valign="middle" width="94" align="center"><input value="30" class="d1c" name="ability-to-know-immediately-when-user-credentials-are-compromise" type="radio" id="ability-to-know-immediately-when-user-credentials-are-compromise-confident" /></td>
						<td valign="middle" align="center"><input value="15" class="d2c" name="ability-to-know-immediately-when-user-credentials-are-compromise" type="radio" id="ability-to-know-immediately-when-user-credentials-are-compromise-somewhat-confident" /></td>
						<td valign="middle" align="center"><input value="7.5" class="d3c" name="ability-to-know-immediately-when-user-credentials-are-compromise" type="radio" id="ability-to-know-immediately-when-user-credentials-are-compromise-not-very-confident" /></td>
						<td valign="middle" align="center"><input value="0" class="d4c" name="ability-to-know-immediately-when-user-credentials-are-compromise" type="radio" id="ability-to-know-immediately-when-user-credentials-are-compromise-not-at-all-confident" /></td>
					</tr>
					<tr>
						<td valign="middle" width="291" align="left" class="label-column"><label for="ability-to-understand-what-constitutes-normal-behavior-on-your-network">Ability to understand what constitutes normal behavior on your network</label></td>
						<td valign="middle" width="94" align="center"><input value="30" class="d1c" name="ability-to-understand-what-constitutes-normal-behavior-on-your-network" type="radio" id="ability-to-understand-what-constitutes-normal-behavior-on-your-network-1" /></td>
						<td valign="middle" align="center"><input value="15" class="d2c" name="ability-to-understand-what-constitutes-normal-behavior-on-your-network" type="radio" id="ability-to-understand-what-constitutes-normal-behavior-on-your-network-2" /></td>
						<td valign="middle" align="center"><input value="7.5" class="d3c" name="ability-to-understand-what-constitutes-normal-behavior-on-your-network" type="radio" id="ability-to-understand-what-constitutes-normal-behavior-on-your-network-3" /></td>
						<td valign="middle" align="center"><input value="0" class="d4c" name="ability-to-understand-what-constitutes-normal-behavior-on-your-network" type="radio" id="ability-to-understand-what-constitutes-normal-behavior-on-your-network-4" /></td>
					</tr>
					<tr>
						<td valign="middle" width="291" align="left" class="label-column"><label for="ability-to-be-alerted-on-anomalous-activity-on-your-internal-net">Ability to be alerted on anomalous network behavior</label></td>
						<td valign="middle" width="94" align="center"><input value="30" class="d1c" name="ability-to-be-alerted-on-anomalous-activity-on-your-internal-net" type="radio" id="ability-to-be-alerted-on-anomalous-activity-on-your-internal-net-confident" /></td>
						<td valign="middle" align="center"><input value="15" class="d2c" name="ability-to-be-alerted-on-anomalous-activity-on-your-internal-net" type="radio" id="ability-to-be-alerted-on-anomalous-activity-on-your-internal-net-somewhat-confident" /></td>
						<td valign="middle" align="center"><input value="7.5" class="d3c" name="ability-to-be-alerted-on-anomalous-activity-on-your-internal-net" type="radio" id="ability-to-be-alerted-on-anomalous-activity-on-your-internal-net-not-very-confident" /></td>
						<td valign="middle" align="center"><input value="0" class="d4c" name="ability-to-be-alerted-on-anomalous-activity-on-your-internal-net" type="radio" id="ability-to-be-alerted-on-anomalous-activity-on-your-internal-net-not-at-all-confident" /></td>
					</tr>
					<tr>
						<td valign="middle" width="291" align="left" class="label-column"><label for="continuous-monitoring-of-privileged-user-activity">Ability to monitor privileged users on a continuous basis</label></td>
						<td valign="middle" width="94" align="center"><input value="30" class="d1c" name="continuous-monitoring-of-privileged-user-activity" type="radio" id="continuous-monitoring-of-privileged-user-activity-confident" /></td>
						<td valign="middle" align="center"><input value="15" class="d2c" name="continuous-monitoring-of-privileged-user-activity" type="radio" id="continuous-monitoring-of-privileged-user-activity-somewhat-confident" /></td>
						<td valign="middle" align="center"><input value="7.5" class="d3c" name="continuous-monitoring-of-privileged-user-activity" type="radio" id="continuous-monitoring-of-privileged-user-activity-not-very-confident" /></td>
						<td valign="middle" align="center"><input value="0" class="d4c" name="continuous-monitoring-of-privileged-user-activity" type="radio" id="continuous-monitoring-of-privileged-user-activity-not-at-all-confident" /></td>
					</tr>
					<tr>
						<td valign="middle" width="291" align="left" class="label-column"><label for="ability-to-be-alerted-when-an-unauthorized-process-starts-on-a-p">Ability to be alerted when an unauthorized process or service starts on a production server</label></td>
						<td valign="middle" width="94" align="center"><input value="30" class="d1c" name="ability-to-be-alerted-when-an-unauthorized-process-starts-on-a-p" type="radio" id="ability-to-be-alerted-when-an-unauthorized-process-starts-on-a-p-confident" /></td>
						<td valign="middle" align="center"><input value="15" class="d2c" name="ability-to-be-alerted-when-an-unauthorized-process-starts-on-a-p" type="radio" id="ability-to-be-alerted-when-an-unauthorized-process-starts-on-a-p-somewhat-confident" /></td>
						<td valign="middle" align="center"><input value="7.5" class="d3c" name="ability-to-be-alerted-when-an-unauthorized-process-starts-on-a-p" type="radio" id="ability-to-be-alerted-when-an-unauthorized-process-starts-on-a-p-not-very-confident" /></td>
						<td valign="middle" align="center"><input value="0" class="d4c" name="ability-to-be-alerted-when-an-unauthorized-process-starts-on-a-p" type="radio" id="ability-to-be-alerted-when-an-unauthorized-process-starts-on-a-p-not-at-all-confident" /></td>
					</tr>
					<tr>
						<td valign="middle" width="291" align="left" class="label-column"><label for="ability-to-recognize-that-the-same-user-logged-in-from-two-diffe">Ability to identify suspicious user behavior patterns</label></td>
						<td valign="middle" width="94" align="center"><input value="30" class="d1c" name="ability-to-recognize-that-the-same-user-logged-in-from-two-diffe" type="radio" id="ability-to-recognize-that-the-same-user-logged-in-from-two-diffe-confident" /></td>
						<td valign="middle" align="center"><input value="15" class="d2c" name="ability-to-recognize-that-the-same-user-logged-in-from-two-diffe" type="radio" id="ability-to-recognize-that-the-same-user-logged-in-from-two-diffe-somewhat-confident" /></td>
						<td valign="middle" align="center"><input value="7.5" class="d3c" name="ability-to-recognize-that-the-same-user-logged-in-from-two-diffe" type="radio" id="ability-to-recognize-that-the-same-user-logged-in-from-two-diffe-not-very-confident" /></td>
						<td valign="middle" align="center"><input value="0" class="d4c" name="ability-to-recognize-that-the-same-user-logged-in-from-two-diffe" type="radio" id="ability-to-recognize-that-the-same-user-logged-in-from-two-diffe-not-at-all-confident" /></td>
					</tr>
					<tr>
						<td valign="middle" width="291" align="left" class="label-column"><label for="ability-to-detect-reconnaissance-activity-followed-by-the-scanne">Ability to identify an unauthorized or suspicious network connection</label></td>
						<td valign="middle" width="94" align="center"><input value="30" class="d1c" name="ability-to-detect-reconnaissance-activity-followed-by-the-scanne" type="radio" id="ability-to-detect-reconnaissance-activity-followed-by-the-scanne-confident" /></td>
						<td valign="middle" align="center"><input value="15" class="d2c" name="ability-to-detect-reconnaissance-activity-followed-by-the-scanne" type="radio" id="ability-to-detect-reconnaissance-activity-followed-by-the-scanne-somewhat-confident" /></td>
						<td valign="middle" align="center"><input value="7.5" class="d3c" name="ability-to-detect-reconnaissance-activity-followed-by-the-scanne" type="radio" id="ability-to-detect-reconnaissance-activity-followed-by-the-scanne-not-very-confident" /></td>
						<td valign="middle" align="center"><input value="0" class="d4c" name="ability-to-detect-reconnaissance-activity-followed-by-the-scanne" type="radio" id="ability-to-detect-reconnaissance-activity-followed-by-the-scanne-not-at-all-confident" /></td>
					</tr>
<!-- 					<tr>
						<td valign="middle" width="291" align="left" class="label-column"><label for="ability-to-know-when-activity-on-a-critical-host-departs-from-an">Ability to know when activity on a critical host departs from an established behavioral norm</label></td>
						<td valign="middle" width="94" align="center"><input value="30" class="d1c" name="ability-to-know-when-activity-on-a-critical-host-departs-from-an" type="radio" id="ability-to-know-when-activity-on-a-critical-host-departs-from-an-confident" /></td>
						<td valign="middle" align="center"><input value="15" class="d2c" name="ability-to-know-when-activity-on-a-critical-host-departs-from-an" type="radio" id="ability-to-know-when-activity-on-a-critical-host-departs-from-an-somewhat-confident" /></td>
						<td valign="middle" align="center"><input value="7.5" class="d3c" name="ability-to-know-when-activity-on-a-critical-host-departs-from-an" type="radio" id="ability-to-know-when-activity-on-a-critical-host-departs-from-an-not-very-confident" /></td>
						<td valign="middle" align="center"><input value="0" class="d4c" name="ability-to-know-when-activity-on-a-critical-host-departs-from-an" type="radio" id="ability-to-know-when-activity-on-a-critical-host-departs-from-an-not-at-all-confident" /></td>
					</tr> -->
				</table>
					</fieldset>
				</div> <!-- end of form fields -->
				<div class="nextPane">
					<a href="#"><img src="resources/img/next.jpg" /></a>
				</div>
				<div class="prevPane clear">
					<a href="#"><img src="resources/img/back.jpg" /></a>
				</div>
			</div></div>

			<!-- F -->
			<div class="question-wrapper"><div id="formMain" class="F center-text center-marg form-question">
				<div id="progressBar">
					<img src="resources/img/progress_5.png" />
				</div>
				<h4 class="spacer-top-10">VISIBILITY &amp; DETECTION</h4>	
				<div class="rule"></div>
				<p class="spacer-top-20" style="font-size:15px;margin-left:45px;margin-right:45px;">Please describe the probability that your organization is currently breached:</p>
				<div id="formfields" class="F spacer-top-30">
					<fieldset>
						<dl>
							<dt><label for="definitely">Definitely</label></dt>
							<dd>
								<input name="probability_breached" value="definitely" type="radio" id="organization-breached-definitely" />
								<label for="organization-breached-definitely"></label>
							</dd>
						</dl>
						
						<dl>
							<dt><label for="likely">Likely</label></dt>
							<dd>
								<input name="probability_breached" value="likely" type="radio" id="organization-breached-likely" />
								<label for="organization-breached-likely"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="unlikely">Unlikely</label></dt>
							<dd>
								<input name="probability_breached" value="unlikely" type="radio" id="organization-breached-unlikely" />
								<label for="organization-breached-unlikely"></label>
							</dd>
						</dl>
						<dl>
							<dt><label for="definitely-not">Definitely Not</label></dt>
							<dd>
								<input name="probability_breached" value="definitely-not" type="radio" id="organization-breached-definitely-not" />
								<label for="organization-breached-definitely-not"></label>
							</dd>
						</dl>
					</fieldset>
				</div> <!-- end of form fields -->
				<div class="submit-button">
					<a href="#"><img src="resources/img/next.jpg" /></a>
				</div>
				<div class="prevPane clear">
					<a href="#"><img src="resources/img/back.jpg" /></a>
				</div>
			</div></div>

			<input type="hidden" id="rating_information_security_tools" name="rating_information_security_tools" value=""/>
			<input type="hidden" id="rating_prevention_response" name="rating_prevention_response" value=""/>
			<input type="hidden" id="rating_detection" name="rating_detection" value=""/>
		</form>
	</div></div></div>
	<!-- content end -->
	
	<!-- footer -->
	<?php include('footer.php') ?>
	<!-- footer end -->
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  //_gaq.push(['_setAccount', 'UA-19528744-2']);
	  _gaq.push(['_setAccount', 'UA-3420049-4']);
	  _gaq.push(['_trackPageview']);
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
	<script type="text/javascript">var switchTo5x=false;</script><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'4842429e-42ab-4ecc-8d58-0e6110641702'});</script>
</body>
</html>



