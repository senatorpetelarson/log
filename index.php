<?php
function print_gzipped_page() {
    global $HTTP_ACCEPT_ENCODING;
    if( headers_sent() ){ $encoding = false; 
	}elseif( strpos($HTTP_ACCEPT_ENCODING, 'x-gzip') !== false ){ $encoding = 'x-gzip';
    }elseif( strpos($HTTP_ACCEPT_ENCODING,'gzip') !== false ){ $encoding = 'gzip';
    }else{ $encoding = false; }
    if( $encoding ){
        $contents = ob_get_contents();
        ob_end_clean();
        header('Content-Encoding: '.$encoding);
        print("\x1f\x8b\x08\x00\x00\x00\x00\x00");
        $size = strlen($contents);
        $contents = gzcompress($contents, 9);
        $contents = substr($contents, 0, $size);
        print($contents);
        exit();
    }else{
        ob_end_flush();
        exit();
    }
}
ob_start();
ob_implicit_flush(0);
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
<link rel="stylesheet" type="text/css" media="all" href="resources/css/colorbox.css" />
<script type="text/javascript" src="resources/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="resources/js/jquery.colorbox-min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".colorbox").colorbox();
});
</script>

<title>Cyber Threat Readiness Quiz</title>
</head>
<body>
	<!-- header -->
	<div id="header" class="center-text">
		<div id="logo" class="center-text">
			<a href="http://www.logrhythm.com/" target="_blank"><img src="resources/img/logo.jpg" border="0" /></a>
		</div>
	</div>
	<h1 class="site-heading">Cyber Threat Readiness Quiz</h1>
	<div class="heading-rule"></div>
	<div id="big-red-check"><img src="resources/img/opening_check.png" /></div>
	<!-- header end -->
	
	<!-- content -->

	<div id="content-wrapper"><div id="content-words"><div id="content-home">
		<h2 class="center-text" style="padding-top: 14px;" >TAKE THIS 3-MINUTE QUIZ AND IMMEDIATELY<br/>RECEIVE YOUR CYBER THREAT READINESS SCORE!</h2>
		<p class="spacer-top-20" style="margin-top:20px;">The following questions are designed to assess your organization’s general readiness to defend against, detect and respond to advanced cyber threats. Questions focus on three categories important for everyone's cyber threat preparedness:</p>
		<div class="list spacer-top-20" style="margin-top:20px;">
			<div class="list-item spacer-top-20">
				<img src="resources/img/check.png" />
				<h2>TOOLS INVENTORY</h2>
			</div>
			<div class="list-item spacer-top-20">
				<img src="resources/img/check.png" />
				<h2>PREVENTION &amp; RESPONSE STRATEGIES</h2>
			</div>
			<div class="list-item spacer-top-20">
				<img src="resources/img/check.png" />
				<h2>VISIBILITY &amp; DETECTION</h2>
			</div>
		</div>
		
		<p class="spacer-top-20" style="margin-top:20px;font-size:12px;">NOTE: candid answers will yield more accurate results. If the word &quot;you&quot; does not seem applicable to you, please answer the questions as they would apply to a member of your staff, and/or, pass this link along to someone in your organization better able to answer them.</p>
		<div class="center-text spacer-top-20" style="margin-top:20px;margin-bottom:20px;"> 
			<a href="form.php"><img src="resources/img/getStarted.jpg" /></a>
		</div>

		<div class="promotion">
			<p>You could win a FULL CONFERENCE PASS to RSA 2013! <br />a &#36;1,595 value*</p>
		</div>
		<div class="terms">
			<p><a href="terms.html" target="_blank">*view contest terms and conditions</a></p>
		</div>
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



