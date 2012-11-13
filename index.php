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
		$('#contest-form-submit').click(function(evt) {
			evt.preventDefault();
			var required = $(".required");

			var errorMessage = $("#error-message");
			required.each(function(index, element) {
				element = $(element);
				if(element.value == null || element.value == "") {
					element.addClass('error');
					errorMessage.show();
				}
			});
		});
	});
</script>

<title>Cyber Threat Readiness Quiz</title>
</head>
<body>
	<!-- header -->
	<div id="header" class="center-text">
		<div id="logo" class="center-text">
			<a href="http://www.logrhythm.com/" target="_blank"><img src="resources/img/logo-new.png" border="0" /></a>
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
		<div id="contest-form" class="contest-form spacer-top-20" style="margin-top:20px;margin-bottom:20px;"> 
			<h2>Enter to Win</h2>
			<p>To enter, fill in the required fields below and click &quot;Enter Contest&quot;. View the <a href="terms.html">terms and conditions.</a></p>
			<p>* = Required Field</p>
			<p class="error-message" id="error-message">Please fill in all required fields.</p>
			<div class="input-left">
				<label for="contest-first-name">First Name*</label>
				<input class="required" type="text" value="" name="contest-first-name" />
				<label for="contest-last-name">Last Name*</label>
				<input class="required" type="text" value="" name="contest-last-name" />
				<label for="contest-email">Email Address*</label>
				<input class="required" type="text" value="" name="contest-email" />
			</div>
			<div>
				<label for="contest-company">Company Name*</label>
				<input class="required" type="text" value="" name="contest-company" />
				<label for="contest-phone">Phone Number</label>
				<input type="text" value="" name="contest-phone" />
				<label for="contest-country">Country*</label>
				<select class="required" name="contest-country">
					<option value="">Country...</option>
					<option value="Afganistan">Afghanistan</option>
					<option value="Albania">Albania</option>
					<option value="Algeria">Algeria</option>
					<option value="American Samoa">American Samoa</option>
					<option value="Andorra">Andorra</option>
					<option value="Angola">Angola</option>
					<option value="Anguilla">Anguilla</option>
					<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
					<option value="Argentina">Argentina</option>
					<option value="Armenia">Armenia</option>
					<option value="Aruba">Aruba</option>
					<option value="Australia">Australia</option>
					<option value="Austria">Austria</option>
					<option value="Azerbaijan">Azerbaijan</option>
					<option value="Bahamas">Bahamas</option>
					<option value="Bahrain">Bahrain</option>
					<option value="Bangladesh">Bangladesh</option>
					<option value="Barbados">Barbados</option>
					<option value="Belarus">Belarus</option>
					<option value="Belgium">Belgium</option>
					<option value="Belize">Belize</option>
					<option value="Benin">Benin</option>
					<option value="Bermuda">Bermuda</option>
					<option value="Bhutan">Bhutan</option>
					<option value="Bolivia">Bolivia</option>
					<option value="Bonaire">Bonaire</option>
					<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
					<option value="Botswana">Botswana</option>
					<option value="Brazil">Brazil</option>
					<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
					<option value="Brunei">Brunei</option>
					<option value="Bulgaria">Bulgaria</option>
					<option value="Burkina Faso">Burkina Faso</option>
					<option value="Burundi">Burundi</option>
					<option value="Cambodia">Cambodia</option>
					<option value="Cameroon">Cameroon</option>
					<option value="Canada">Canada</option>
					<option value="Canary Islands">Canary Islands</option>
					<option value="Cape Verde">Cape Verde</option>
					<option value="Cayman Islands">Cayman Islands</option>
					<option value="Central African Republic">Central African Republic</option>
					<option value="Chad">Chad</option>
					<option value="Channel Islands">Channel Islands</option>
					<option value="Chile">Chile</option>
					<option value="China">China</option>
					<option value="Christmas Island">Christmas Island</option>
					<option value="Cocos Island">Cocos Island</option>
					<option value="Colombia">Colombia</option>
					<option value="Comoros">Comoros</option>
					<option value="Congo">Congo</option>
					<option value="Cook Islands">Cook Islands</option>
					<option value="Costa Rica">Costa Rica</option>
					<option value="Cote DIvoire">Cote D'Ivoire</option>
					<option value="Croatia">Croatia</option>
					<option value="Cuba">Cuba</option>
					<option value="Curaco">Curacao</option>
					<option value="Cyprus">Cyprus</option>
					<option value="Czech Republic">Czech Republic</option>
					<option value="Denmark">Denmark</option>
					<option value="Djibouti">Djibouti</option>
					<option value="Dominica">Dominica</option>
					<option value="Dominican Republic">Dominican Republic</option>
					<option value="East Timor">East Timor</option>
					<option value="Ecuador">Ecuador</option>
					<option value="Egypt">Egypt</option>
					<option value="El Salvador">El Salvador</option>
					<option value="Equatorial Guinea">Equatorial Guinea</option>
					<option value="Eritrea">Eritrea</option>
					<option value="Estonia">Estonia</option>
					<option value="Ethiopia">Ethiopia</option>
					<option value="Falkland Islands">Falkland Islands</option>
					<option value="Faroe Islands">Faroe Islands</option>
					<option value="Fiji">Fiji</option>
					<option value="Finland">Finland</option>
					<option value="France">France</option>
					<option value="French Guiana">French Guiana</option>
					<option value="French Polynesia">French Polynesia</option>
					<option value="French Southern Ter">French Southern Ter</option>
					<option value="Gabon">Gabon</option>
					<option value="Gambia">Gambia</option>
					<option value="Georgia">Georgia</option>
					<option value="Germany">Germany</option>
					<option value="Ghana">Ghana</option>
					<option value="Gibraltar">Gibraltar</option>
					<option value="Great Britain">Great Britain</option>
					<option value="Greece">Greece</option>
					<option value="Greenland">Greenland</option>
					<option value="Grenada">Grenada</option>
					<option value="Guadeloupe">Guadeloupe</option>
					<option value="Guam">Guam</option>
					<option value="Guatemala">Guatemala</option>
					<option value="Guinea">Guinea</option>
					<option value="Guyana">Guyana</option>
					<option value="Haiti">Haiti</option>
					<option value="Hawaii">Hawaii</option>
					<option value="Honduras">Honduras</option>
					<option value="Hong Kong">Hong Kong</option>
					<option value="Hungary">Hungary</option>
					<option value="Iceland">Iceland</option>
					<option value="India">India</option>
					<option value="Indonesia">Indonesia</option>
					<option value="Iran">Iran</option>
					<option value="Iraq">Iraq</option>
					<option value="Ireland">Ireland</option>
					<option value="Isle of Man">Isle of Man</option>
					<option value="Israel">Israel</option>
					<option value="Italy">Italy</option>
					<option value="Jamaica">Jamaica</option>
					<option value="Japan">Japan</option>
					<option value="Jordan">Jordan</option>
					<option value="Kazakhstan">Kazakhstan</option>
					<option value="Kenya">Kenya</option>
					<option value="Kiribati">Kiribati</option>
					<option value="Korea North">Korea North</option>
					<option value="Korea Sout">Korea South</option>
					<option value="Kuwait">Kuwait</option>
					<option value="Kyrgyzstan">Kyrgyzstan</option>
					<option value="Laos">Laos</option>
					<option value="Latvia">Latvia</option>
					<option value="Lebanon">Lebanon</option>
					<option value="Lesotho">Lesotho</option>
					<option value="Liberia">Liberia</option>
					<option value="Libya">Libya</option>
					<option value="Liechtenstein">Liechtenstein</option>
					<option value="Lithuania">Lithuania</option>
					<option value="Luxembourg">Luxembourg</option>
					<option value="Macau">Macau</option>
					<option value="Macedonia">Macedonia</option>
					<option value="Madagascar">Madagascar</option>
					<option value="Malaysia">Malaysia</option>
					<option value="Malawi">Malawi</option>
					<option value="Maldives">Maldives</option>
					<option value="Mali">Mali</option>
					<option value="Malta">Malta</option>
					<option value="Marshall Islands">Marshall Islands</option>
					<option value="Martinique">Martinique</option>
					<option value="Mauritania">Mauritania</option>
					<option value="Mauritius">Mauritius</option>
					<option value="Mayotte">Mayotte</option>
					<option value="Mexico">Mexico</option>
					<option value="Midway Islands">Midway Islands</option>
					<option value="Moldova">Moldova</option>
					<option value="Monaco">Monaco</option>
					<option value="Mongolia">Mongolia</option>
					<option value="Montserrat">Montserrat</option>
					<option value="Morocco">Morocco</option>
					<option value="Mozambique">Mozambique</option>
					<option value="Myanmar">Myanmar</option>
					<option value="Nambia">Nambia</option>
					<option value="Nauru">Nauru</option>
					<option value="Nepal">Nepal</option>
					<option value="Netherland Antilles">Netherland Antilles</option>
					<option value="Netherlands">Netherlands (Holland, Europe)</option>
					<option value="Nevis">Nevis</option>
					<option value="New Caledonia">New Caledonia</option>
					<option value="New Zealand">New Zealand</option>
					<option value="Nicaragua">Nicaragua</option>
					<option value="Niger">Niger</option>
					<option value="Nigeria">Nigeria</option>
					<option value="Niue">Niue</option>
					<option value="Norfolk Island">Norfolk Island</option>
					<option value="Norway">Norway</option>
					<option value="Oman">Oman</option>
					<option value="Pakistan">Pakistan</option>
					<option value="Palau Island">Palau Island</option>
					<option value="Palestine">Palestine</option>
					<option value="Panama">Panama</option>
					<option value="Papua New Guinea">Papua New Guinea</option>
					<option value="Paraguay">Paraguay</option>
					<option value="Peru">Peru</option>
					<option value="Phillipines">Philippines</option>
					<option value="Pitcairn Island">Pitcairn Island</option>
					<option value="Poland">Poland</option>
					<option value="Portugal">Portugal</option>
					<option value="Puerto Rico">Puerto Rico</option>
					<option value="Qatar">Qatar</option>
					<option value="Republic of Montenegro">Republic of Montenegro</option>
					<option value="Republic of Serbia">Republic of Serbia</option>
					<option value="Reunion">Reunion</option>
					<option value="Romania">Romania</option>
					<option value="Russia">Russia</option>
					<option value="Rwanda">Rwanda</option>
					<option value="St Barthelemy">St Barthelemy</option>
					<option value="St Eustatius">St Eustatius</option>
					<option value="St Helena">St Helena</option>
					<option value="St Kitts-Nevis">St Kitts-Nevis</option>
					<option value="St Lucia">St Lucia</option>
					<option value="St Maarten">St Maarten</option>
					<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
					<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
					<option value="Saipan">Saipan</option>
					<option value="Samoa">Samoa</option>
					<option value="Samoa American">Samoa American</option>
					<option value="San Marino">San Marino</option>
					<option value="Sao Tome & Principe">Sao Tome &amp; Principe</option>
					<option value="Saudi Arabia">Saudi Arabia</option>
					<option value="Senegal">Senegal</option>
					<option value="Seychelles">Seychelles</option>
					<option value="Sierra Leone">Sierra Leone</option>
					<option value="Singapore">Singapore</option>
					<option value="Slovakia">Slovakia</option>
					<option value="Slovenia">Slovenia</option>
					<option value="Solomon Islands">Solomon Islands</option>
					<option value="Somalia">Somalia</option>
					<option value="South Africa">South Africa</option>
					<option value="Spain">Spain</option>
					<option value="Sri Lanka">Sri Lanka</option>
					<option value="Sudan">Sudan</option>
					<option value="Suriname">Suriname</option>
					<option value="Swaziland">Swaziland</option>
					<option value="Sweden">Sweden</option>
					<option value="Switzerland">Switzerland</option>
					<option value="Syria">Syria</option>
					<option value="Tahiti">Tahiti</option>
					<option value="Taiwan">Taiwan</option>
					<option value="Tajikistan">Tajikistan</option>
					<option value="Tanzania">Tanzania</option>
					<option value="Thailand">Thailand</option>
					<option value="Togo">Togo</option>
					<option value="Tokelau">Tokelau</option>
					<option value="Tonga">Tonga</option>
					<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
					<option value="Tunisia">Tunisia</option>
					<option value="Turkey">Turkey</option>
					<option value="Turkmenistan">Turkmenistan</option>
					<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
					<option value="Tuvalu">Tuvalu</option>
					<option value="Uganda">Uganda</option>
					<option value="Ukraine">Ukraine</option>
					<option value="United Arab Erimates">United Arab Emirates</option>
					<option value="United Kingdom">United Kingdom</option>
					<option value="United States of America">United States of America</option>
					<option value="Uraguay">Uruguay</option>
					<option value="Uzbekistan">Uzbekistan</option>
					<option value="Vanuatu">Vanuatu</option>
					<option value="Vatican City State">Vatican City State</option>
					<option value="Venezuela">Venezuela</option>
					<option value="Vietnam">Vietnam</option>
					<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
					<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
					<option value="Wake Island">Wake Island</option>
					<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
					<option value="Yemen">Yemen</option>
					<option value="Zaire">Zaire</option>
					<option value="Zambia">Zambia</option>
					<option value="Zimbabwe">Zimbabwe</option>
				</select>
			</div>
			<a id="contest-form-submit" class="contest-form-submit form-button" href="#">Enter Contest</a>
			<a class="contest-form-skip form-button" href="form.php">Skip to Quiz &rarr;</a>
		</div>

		<div class="promotion">
			<p>You could win a FULL CONFERENCE PASS to RSA 2013! <br />a &#36;1,595 value</p>
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



