<div class="email-results-wrapper"<?php echo $email_results_style ?>>
	<img alt="LogRhythm logo" src="resources/img/logo-new.png" id="results-log-logo" />
	
	<br/>
	<h2 style="margin-bottom:12px;">Forward this quiz to a colleague and get a 2nd chance to win!</h2>
	<p style="margin-bottom:12px;">Enter Your Colleague's Information Below</p>
	<p style="width:250px;margin-bottom:12px;">* = Required Field</p>
	<form id="forward-form" class="lpeRegForm formNotEmpty" method="post" action="process_forward.php">
		<label>*First Name:</label>
<input class='mktFormText mktFormString mktFReq required' name="contest-first-name" id="FirstName" type='text' value=""  maxlength='255' tabIndex='1' />

<label>*Last Name:</label>
<input class='mktFormText mktFormString mktFReq required' name="contest-last-name" id="LastName" type='text' value=""  maxlength='255' tabIndex='2' />

<label>*Email Address:</label>
<input class='mktFormText mktFormEmail mktFReq required' name="contest-email" id="Email" type='text' value=""  maxlength='255' tabIndex='3' />
		<p><label>*Colleague's Name:</label><br/>
		<input class='mktFormText mktFormString mktFReq required' name="colleague-name" id="ColleagueName" style="width:250px;margin-bottom:12px;" type='text' value=""  maxlength='255' tabIndex='1' /></p>

		<p><label>*Colleague's Email:</label><br/>
		<input class='mktFormText mktFormEmail mktFReq required' name="colleague-email" id="ColleagueEmail" style="width:250px;margin-bottom:12px;" type='text' value=""  maxlength='255' tabIndex='3' /></p>
		<input type="hidden" id="sender-name" name="sender-name" value="" />
		<input type="hidden" id="sender-email" name="sender-email" value="" />
		<a id="email-forward-submit" class="email-form-submit form-button" href="#" style="margin: 0 0 0 137px;">Submit</a>
	</form>
	<p class="error-message" id="result-error-message">Please fill in all required fields.</p>
</div>