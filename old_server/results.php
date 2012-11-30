<?php
require_once('classes/database.php');
require_once('../db_conn.php');
$database = new database(CONST_HOST,CONST_USER,CONST_DB_PASSWORD,CONST_DB_NAME);
$score = "";
$rating_information_security_tools = $_POST['rating_information_security_tools'];
$rating_information_security_tools_percent = round(($rating_information_security_tools/330)*100);
$rating_prevention_response = $_POST['rating_prevention_response'];
$rating_prevention_response_percent =  round(($rating_prevention_response/220)*100);
$rating_detection = $_POST['rating_detection'];
$rating_detection_percent =  round(($rating_detection/200)*100);
$total_percent = round(($rating_information_security_tools_percent+$rating_prevention_response_percent+$rating_detection_percent)/3);
if($rating_information_security_tools_percent>69) {
	$score = $score."high-";	
} else {
	$score = $score."low-";
}
if($rating_prevention_response_percent>69) {
	$score = $score."high-";	
} else {
	$score = $score."low-";
}
if($rating_detection_percent>69) {
	$score = $score."high";	
} else {
	$score = $score."low";
}

$strQuery = "INSERT INTO results(";
$values = array();
$keys = array();
array_push($keys,'ip_address');
array_push($values,$_SERVER['REMOTE_ADDR']);if(count($_POST)>0) {
	foreach ($_POST as $key => $value) {
	    array_push($keys,$key);
	    array_push($values,$value);
	}
	array_push($keys,'rating_information_security_tools_percent');
	array_push($keys,'rating_prevention_response_percent');
	array_push($keys,'rating_detection_percent');
	array_push($values,$rating_information_security_tools_percent);
	array_push($values,$rating_prevention_response_percent);
	array_push($values,$rating_detection_percent);
	array_push($keys,'total_percent');
	array_push($values,$total_percent);
	$strQuery = $strQuery."`".implode("`,`",$keys)."`";
	$strQuery = $strQuery.") VALUES (";
	$strQuery = $strQuery."'".implode("','",$values)."'";
	$strQuery = $strQuery.")";
	
	$database->setQuery($strQuery);
	$database->query();
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
<link rel="stylesheet" type="text/css" media="print" href="resources/css/print.css" />
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
			<a href="http://www.logrhythm.com/" target="_blank"><img src="resources/img/logo.jpg" border="0" /></a>
		</div>
	</div>
	<!-- header end -->
	<h1 class="site-heading">Cyber Threat Readiness Quiz</h1>
	<div class="heading-rule"></div>
	
	<!-- content -->
	<div id="content-wrapper"><div id="content-words"><div id="content-results" class="center-text ">
			<!-- E -->
			<div class="question-wrapper"><!-- E -->
			<div id="formMain" class="E center-text center-marg ">
				
				<h4 class="spacer-top-10">YOUR SCORE</h4>	
				<hr />
				<div id="formfields" class="E">
					<div id="results">
						<div id="resultsLeft">
							<div id="result">
								<div id="result-title">TOOLS INVENTORY</div>
								<div id="result-result" style="padding-top:3px;"><?php echo $rating_information_security_tools_percent ?>%</div>
							</div>
							<div id="result">
								<div id="result-title" style="height:35px;padding-top:3px">PREVENTION &amp; RESPONSE STRATEGIES</div>
								<div id="result-result" style="padding-top:6px;"><?php echo $rating_prevention_response_percent ?>%</div>
							</div>
							<div id="result">
								<div id="result-title">VISIBILITY &amp; DETECTION</div>
								<div id="result-result" style="padding-top:3px;"><?php echo $rating_detection_percent ?>%</div>
							</div>
						</div>
						<div id="totalScoreholder">
							<div id="totalScore" >
								<div id="totalScore-title">Total Score</div>
								<div id="totalScore-result"><?php echo $total_percent ?>%</div>
							</div>
						</div>
						
						<div id="print">
							<a href="#" onclick="printResults(); return false;"><img src="resources/img/print.png"/></a>
						</div>
					</div>
				</div> 
				<div class="clear"></div>
				<div id="formfields" class="E" style="padding-bottom: 0;">
					<div class="spacer-top-30"></div>
					<div id="results-copy">
					<!--<p>Is time to start planning and executing on a comprehensive security strategy. Although you may have avoided a major incident so far, part of your confidence may be misplaced – without the tools in place to watch and protect your network, you may be unaware of a breach that has already taken place. With the lack of visibility your network may be compromised but you have no ability to detect the issue. And without proper planning, even if you do detect anomalous... READ MORE</p>-->
					<!-- Results copy -->
					<?php if($score=="low-low-low"): ?>
					<p>Based on your answers you may be at a high level of risk from an attack.  Without a comprehensive suite of tools providing controls to prevent and detect malicious activity, a solid risk management and incident response strategy, and comprehensive visibility across the board,  attackers are likely to have free reign in your environment.<span class="read-more-link">.. <a href="#">READ MORE</a></span></p>
					<div class="extended-results">
						<p>You may need to increase your investment in security tools.  Solutions such as anti-malware/antivirus, firewalls, IDS/IPS, and vulnerability management are required to combat known security threats and should be considered a critical component of any effective security strategy.  Many security analysts believe that traditional security products are no longer sufficient by themselves to protect core assets from insider or advanced persistent threats.  Advanced solutions will increase protection while reducing many of the manual processes required to actively defend against security threats and should now be considered a key component to an effective, layered security strategy.  These include next generation firewalls, network-based anomaly detection and Security Information and Event Management (SIEM) platforms. Additional solutions designed to protect critical data from insider threats, compromised credentials and fraud should also be considered, such as Identity and Access Management, Data Loss Prevention and File Integrity Monitoring.  
						
						<p>It’s time to start planning and executing on a comprehensive security strategy.  Although you may have avoided a major incident so far, it’s highly likely that it’s only a matter of time before your organization is breached.  In fact, given lack of a strong security strategy, shortage of key security technologies and the resulting security blind spots which your quiz answers imply, your organization may already be breached without you knowing it or having the tools to understand the extent of damage should you discover the breach.  
						
						<p>Not only do you need to implement specific products and solutions to defend your network, you need to execute on a plan to tie it all together.  A complete set of security tools, a solid strategy utilizing log management and SIEM technologies, and clearly defined processes for effective use and maintenance will provide comprehensive threat defense, detection and response.  Having the means to correlate event data across multiple security tools provides a greater level of protection from advanced security threats that are specifically designed to escape notice.
						
					</div>
					<?php endif ?>
					<?php if($score=="low-hight-low"): ?>
					<p>Based on your answers you are confident that you have a clearly articulated strategy for security, but have material gaps in the security tools required achieve the objectives of your strategy and to gain enterprise-wide visibility into your security state.<span class="read-more-link">.. <a href="#">READ MORE</a></span></p>
					<div class="extended-results">
						<p>Solutions such as anti-malware/antivirus, firewalls, IDS/IPS, and vulnerability management are required to combat known security threats and should be considered a critical component of any effective security strategy.  Many security analysts believe that traditional security products are no longer sufficient in use by themselves to protect core assets from insider or advanced persistent threats.  Advanced solutions will increase protection while reducing many of the manual processes required to actively defend against security threats and should now be considered a key component to an effective, layered security strategy.  These include next generation firewalls, network-based anomaly detection and Security Information and Event Management (SIEM) platforms. Additional solutions designed to protect critical data from insider threats, compromised credentials and fraud should also be considered, such as Identity and Access Management, Data Loss Prevention and File Integrity Monitoring.  
						<p>Not only do you need to implement specific products and solutions to defend your network, you need to execute on your plan to tie it all together.  A complete set of security tools, a solid log management and SIEM strategy, and clearly defined processes for effective use and maintenance will provide comprehensive visibility and threat protection.  Having the means to correlate event data across multiple security tools provides a greater level of protection from advanced security threats that are specifically designed to escape notice.  
					</div>
					<?php endif ?>
					<?php if($score=="low-low-high"): ?>
					<p>Based on your answers it’s time to start planning and executing on a comprehensive security strategy.  Although you may have avoided a major incident so far, without the tools in place to watch and protect your network, you may be unaware of a breach that has already taken place.  Without proper planning you may not have an incident response management strategy to respond quickly, even if you do detect anomalous behavior or a potential breach.<span class="read-more-link">.. <a href="#">READ MORE</a></span></p>
					<div class="extended-results">
						<p>You may need to increase your investment in security tools.  Solutions such as anti-malware/antivirus, firewalls, IDS/IPS, and vulnerability management are required to combat known security threats and should be considered a critical component of any effective security strategy. Many security analysts believe that traditional security products are no longer sufficient in use by themselves to protect core assets from insider or advance, persistent threats.   Advanced solutions that can increase protection while reducing many of the manual processes required to actively defend against security threats are also a key component to an effective security strategy.  These include next generation firewalls, network-based anomaly detection and Security Information and Event Management (SIEM) platforms. Additional solutions designed to protect critical data from insider threats, compromised credentials and fraud should also be considered, such as Identity and Access Management, Data Loss Prevention and File Integrity Monitoring.  
						<p>You appear confident in your ability to detect a broad range of cyber threats.  Make sure that your confidence is not misplaced by ensuring that your strategy is aligned with the appropriate security tools necessary to actively defend your network from attacks and respond swiftly when your defenses fail.   Consolidating and integrating your security solutions and employing automation whenever feasible can lower your costs, improve your incident response management capabilities, and improve your security posture.
					</div>
					<?php endif ?>
					<?php if($score=="low-high-low"): ?>
					<p>Based on your answers you are confident that you have a clearly articulated strategy for security, but have material gaps in the security tools required achieve the objectives of your strategy and to gain enterprise-wide visibility into your security state.<span class="read-more-link">.. <a href="#">READ MORE</a></span></p>
					<div class="extended-results">
						<p>Solutions such as anti-malware/antivirus, firewalls, IDS/IPS, and vulnerability management are required to combat known security threats and should be considered a critical component of any effective security strategy.  Many security analysts believe that traditional security products are no longer sufficient in use by themselves to protect core assets from insider or advanced persistent threats.  Advanced solutions will increase protection while reducing many of the manual processes required to actively defend against security threats and should now be considered a key component to an effective, layered security strategy.  These include next generation firewalls, network-based anomaly detection and Security Information and Event Management (SIEM) platforms. Additional solutions designed to protect critical data from insider threats, compromised credentials and fraud should also be considered, such as Identity and Access Management, Data Loss Prevention and File Integrity Monitoring.    
						<p>Not only do you need to implement specific products and solutions to defend your network, you need to execute on your plan to tie it all together.  A complete set of security tools, a solid log management and SIEM strategy, and clearly defined processes for effective use and maintenance will provide comprehensive visibility and threat protection.  Having the means to correlate event data across multiple security tools provides a greater level of protection from advanced security threats that are specifically designed to escape notice.
					</div>
					<?php endif ?>
					<?php if($score=="low-high-high"): ?>
					<p>According to your answers, you’ve got a sound information security strategy and you’ve achieved a commendable level of visibility to potential threats and breaches, but you’re ill equipped to sustain this posture for long.  Your answers to the tools questions show a significant gap in core information security technologies required to provide a solid platform for security intelligence and response.  If you don’t start filling the gaps in your arsenal of security tools, it may just be a matter of time before your organization becomes the victim of an attack.<span class="read-more-link">.. <a href="#">READ MORE</a></span></p>
					<div class="extended-results">
						<p>You may need to increase your investment in security tools.  Solutions such as anti-malware/antivirus, firewalls, IDS/IPS, and vulnerability management are required to combat known security threats and should be considered a critical component of any effective security strategy.  Many security analysts believe that traditional security products are no longer sufficient in use by themselves to protect core assets from insider or advance, persistent threats.  Advanced solutions that can increase protection while reducing many of the manual processes required to actively defend against security threats are also a key component to an effective security strategy.  These include next generation firewalls, network-based anomaly detection and Security Information and Event Management (SIEM) platforms. Additional solutions designed to protect critical data from insider threats, compromised credentials and fraud should also be considered, such as Identity and Access Management, Data Loss Prevention and File Integrity Monitoring.  
						<p>You appear to have a clear understanding of the cyber threat landscape and a solid plan for protecting your organization.  Over time, however, you may develop gaps in your security capabilities as the threat landscape changes.  An annual review of your security operations is a best practice that ensures that you are protected against specific threats and prepared to detect and defend against new attacks.  
						<p>You appear confident in your ability to detect a broad range of cyber threats.  Make sure that your confidence is not misplaced by ensuring that your strategy is aligned with the appropriate security tools necessary to actively defend your network from attacks.   Consolidating and integrating your security solutions and employing automation whenever feasible can lower your costs, improve your incident response management capabilities, and improve your security posture.
					</div>
					<?php endif ?>
					<?php if($score=="high-low-low"): ?>
					<p>Based on your response you appear to have a solid set of security tools to assist in preventing and detecting malicious activity.  However, your organization appears to be lacking a comprehensive security strategy as well as an efficient way of providing real-time visibility and integration across your tool suite.  Define a layered, security strategy that includes centralized visibility and automated correlation across disparate datasets to better help you integrate your tool suite into a continuous monitoring solution, providing visibility across the entire depth and breadth of your infrastructure.<span class="read-more-link">.. <a href="#">READ MORE</a></span></p>
					<div class="extended-results">
						<p>It appears that you have made good investments in security tools.  To ensure that you are getting the most out of that investment, it’s imperative that you have a consistent process for keeping them up-to-date.   It is also critical to make sure that you build an incident response management process that fully leverages their capabilities. And while the tools you have may be providing good information about specific security threats, you may lack the correlation capabilities to tie it together.  A strong log management and SIEM strategy that incorporates automated, advanced correlation, can help to fill in the visibility gaps to detect more complex attacks and insider threats.
						
						<p>It’s time to start planning and executing on a comprehensive security strategy.  Although you may have avoided a major incident so far, it’s highly likely that it’s only a matter of time before your organization is breached.  In fact, given lack of a strong security strategy and the security blind spots which your quiz answers imply, your organization may already be breached without you knowing it or having the ability to understand the extent of damage should you discover the breach.   
						
						<p>While you appear to have a solid security tool set to defend your network, you need to execute on a plan to tie them all together.  A complete set of security tools, a solid strategy utilizing log management and SIEM technologies, and clearly defined processes for effective use and maintenance will provide comprehensive threat defense, detection and response.  Having the means to correlate event data across multiple security tools provides a greater level of protection from advanced security threats that are specifically designed to escape notice.
					</div>
					<?php endif ?>
					<?php if($score=="high-high-low"): ?>
					<p>Based on your responses, it appears that while you have made good investments in security tools and have a solid security strategy, you are still exposed in areas that could lead to a breach.   The tools you have may be providing good information but still lack the correlation capabilities to tie it together.  An advanced strategy leveraging automated correlation can help to fill in the visibility gaps to detect more complex attacks and insider threats.<span class="read-more-link">.. <a href="#">READ MORE</a></span></p>
					<div class="extended-results">
						<p>To ensure that your investment in security tools is delivering the best return, it’s imperative that you have a consistent process for keeping them up-to-date.   It is also imperative to build an incident response management process that fully leverages their capabilities. And while the tools you have may be providing good information about specific security threats, you may lack the correlation capabilities to see the big picture.  A strong log management and SIEM strategy that incorporates automated, advanced correlation can help to fill in the visibility gaps to detect more complex attacks and insider threats.</p>
					</div>
					<?php endif ?>
					<?php if($score=="high-low-high"): ?>
					<p>Based on your responses, it appears that you have made good investments in your security tools and have better than average visibility to security threats.  Developing a focused security strategy will help you detect and defend your organization against tomorrow’s threats.  A layered security strategy that includes automating the correlation of security events combined with a solid incident response management strategy will improve your visibility into the cyber threat landscape and will allow you to respond more quickly and effectively to an actual attack.<span class="read-more-link">.. <a href="#">READ MORE</a></span></p>
					<div class="extended-results">
						<p>You appear confident in your ability to detect a broad range of cyber threats.  Make sure that your confidence is not misplaced by ensuring that your strategy is aligned with the appropriate security tools necessary to actively defend your network from attacks.   Consolidating and integrating your security solutions and employing automation whenever feasible can lower your costs, improve your incident response management capabilities, and improve your security posture.</p>
					</div>
					<?php endif ?>
					<?php if($score=="high-high-high"): ?>
					<p>Based upon your answers, you appear to have a strong arsenal of information security technologies in place, a sound strategy for applying those technologies effectively and the tactical execution to defend against, detect and respond to the ever-evolving cyber threat landscape.  You also understand that sound information security is based upon a layered approach to defense, detection and response.  To sustain your strong cyber threat readiness state you’ll need to continue operating with an integrated security intelligence platform that ensures comprehensive visibility across all layers of your enterprise, continuous monitoring of your critical assets, real-time analysis and alerting, and intelligent response capabilities.</p>
					<?php endif ?>
					</div>
					<div class="spacer-top-10"></div>
					<h2>Thank you for participating in our<br />Cyber Threat Readiness Quiz</h2>
					<div class="spacer-top-10"></div>
					<p>We hope you find this Cyber Threat Readiness Score insightful. The quiz will be available online for the next several weeks enabling your information security peers to assess their own cyber threat readiness. Once completed, the information collected will be aggregated and correlated, then published in a report that will enable you to see how your scores compare to those of your peers. </p>
					</div>
				<a href="contact_form.html" class="colorbox"><img src="resources/img/button_readiness_report.png" /></a>
				<div class="spacer-top-10"></div>
				<p style="text-align:center">If you’d like to find out how LogRhythm’s SIEM 2.0<br />platform can help you improve your current security readiness:</p>
				<div class="spacer-top-10"></div>

				<div id="quotes">
					<img src="resources/img/scLogo.png" />
					<p>“SIEMs are, in our view, the single most<br />important security tool in the security<br />practitioner’s arsenal.”<br />Peter Stephenson<br />Technology Editor, SC Magazine (May 2011)</p>
				</div>
				<div id="links"><a href="http://www.logrhythm.com/Resources/RequestOnlineDemonstration.aspx" target="_blank"> Schedule a personalized demo</a> | <a href="http://logrhythm.com/Resources/InDepthProductDemoNoReg.aspx" target="_blank">Watch an in-depth demo</a> | <a href="http://www.logrhythm.com/Resources/RequestMoreInfo.aspx" target="_blank">Request more info</a></div>
			</div></div>
	</div></div></div>
	<!-- content end -->
	
	<!-- footer -->
		<div id="footer" >
			<div id="footer-content" class="center-text spacer-top-10"> 
				<a href="#"> <img src="resources/img/email.jpg" align="top"></a>
				<a href="mailto:?body=I just took this Cyber Threat Readiness Quiz and thought you might be interested in getting your cyber security readiness score too. 
	Go to http://MySecurityScore.com  to take the 3-minute quiz.">Forward this survey to a colleague</a>
				&nbsp;&nbsp;|&nbsp;&nbsp;<a href="privacy.html" class="colorbox">Privacy Policy</a><br/>
				<span class="small"><a href="http://logrhythm.com" target="_blank">Powered by LogRhythm</a>, a <a href="http://www.logrhythm.com/Products/LogandEventManagement/LogManagement.aspx" target="_blank">log management solution</a></span>&nbsp;&nbsp;
				<span  class='st_twitter' ></span><span  class='st_facebook' ></span><span  class='st_linkedin' ></span>
			</div>
		</div>
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



