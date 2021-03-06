<div class="email-form-wrapper" style="display:none;">
	<img alt="LogRhythm logo" src="resources/img/logo-new.png" />
	<h2>Enter Your Information Below</h2>
	<p>* = Required Field</p>

	<form id="email-form" class="lpeRegForm formNotEmpty" method="post" action="process_email.php">
		<label>First Name:</label>
		<input class='mktFormText mktFormString mktFReq required' name="first-name" id="FirstName" type='text' value=""  maxlength='255' tabIndex='1' />

		<label>Last Name:</label>
		<input class='mktFormText mktFormString mktFReq required' name="last-name" id="LastName" type='text' value=""  maxlength='255' tabIndex='2' />

		<label>Email Address:</label>
		<input class='mktFormText mktFormEmail mktFReq required' name="email" id="Email" type='text' value=""  maxlength='255' tabIndex='3' />

		<label>Company Name:</label>
		<input class='mktFormText mktFormString mktFReq required' name="company" id="Company" type='text' value=""  maxlength='255' tabIndex='4' />

		<label>Country:</label>
		<select class='mktFormSelect mktFReq required' name="country" id="Country" size='1'  tabIndex='5'>
			<option value='Select Country:' selected='selected'>Select Country:</option><option value='US'>United States</option><option value='CA'>Canada</option><option value='AF'>Afghanistan</option><option value='AL'>Albania</option><option value='DZ'>Algeria</option><option value='AS'>American Samoa</option><option value='AD'>Andorra</option><option value='AO'>Angola</option><option value='AI'>Anguilla</option><option value='AQ'>Antarctica</option><option value='AG'>Antigua and Barbuda</option><option value='AR'>Argentina</option><option value='AM'>Armenia</option><option value='AW'>Aruba</option><option value='AU'>AustraliaAT</option><option value='AZ'>Azerbaidjan</option><option value='BS'>Bahamas</option><option value='BH'>Bahrain</option><option value='BD'>Bangladesh</option><option value='BB'>BarbadosBY</option><option value='BE'>Belgium</option><option value='BZ'>Belize</option><option value='BJ'>Benin</option><option value='BM'>Bermuda</option><option value='BT'>BhutanBO</option><option value='BA'>Bosnia-Herzegovina</option><option value='BW'>Botswana</option><option value='BV'>Bouvet Island</option><option value='BR'>Brazil</option><option value='IO'>British Indian Ocean TerritoryBN</option><option value='BG'>Bulgaria</option><option value='BF'>Burkina Faso</option><option value='BI'>Burundi</option><option value='KH'>Cambodia</option><option value='CM'>CameroonCV</option><option value='KY'>Cayman Islands</option><option value='CF'>Central African Republic</option><option value='TD'>Chad</option><option value='CL'>Chile</option><option value='CN'>ChinaCX</option><option value='CC'>Cocos (Keeling) Islands</option><option value='CO'>Colombia</option><option value='KM'>Comoros</option><option value='CG'>Congo</option><option value='CK'>Cook IslandsCR</option><option value='HR'>Croatia</option><option value='CU'>Cuba</option><option value='CY'>Cyprus</option><option value='CZ'>Czech Republic</option><option value='DK'>DenmarkDJ</option><option value='DM'>Dominica</option><option value='DO'>Dominican Republic</option><option value='TP'>East Timor</option><option value='EC'>Ecuador</option><option value='EG'>EgyptSV</option><option value='GQ'>Equatorial Guinea</option><option value='ER'>Eritrea</option><option value='EE'>Estonia</option><option value='ET'>Ethiopia</option><option value='FK'>Falkland IslandsFO</option><option value='FJ'>Fiji</option><option value='FI'>Finland</option><option value='CS'>Former Czechoslovakia</option><option value='SU'>Former USSR</option><option value='FR'>FranceFX</option><option value='GF'>French Guyana</option><option value='TF'>French Southern Territories</option><option value='GA'>Gabon</option><option value='GM'>Gambia</option><option value='GE'>GeorgiaDE</option><option value='GH'>Ghana</option><option value='GI'>Gibraltar</option><option value='GB'>Great Britain</option><option value='GR'>Greece</option><option value='GL'>GreenlandGD</option><option value='GP'>Guadeloupe (French)</option><option value='GU'>Guam (USA)</option><option value='GT'>Guatemala</option><option value='GN'>Guinea</option><option value='GW'>Guinea BissauGY</option><option value='HT'>Haiti</option><option value='HM'>Heard and McDonald Islands</option><option value='HN'>Honduras</option><option value='HK'>Hong Kong</option><option value='HU'>HungaryIS</option><option value='IN'>India</option><option value='ID'>Indonesia</option><option value='INT'>International</option><option value='IR'>Iran</option><option value='IQ'>IraqIE</option><option value='IL'>Israel</option><option value='IT'>Italy</option><option value='CI'>Ivory Coast (Cote D&amp;amp;#39;Ivoire)</option><option value='JM'>Jamaica</option><option value='JP'>JapanJO</option><option value='KZ'>Kazakhstan</option><option value='KE'>Kenya</option><option value='KI'>Kiribati</option><option value='KW'>Kuwait</option><option value='KG'>KyrgyzstanLA</option><option value='LV'>Latvia</option><option value='LB'>Lebanon</option><option value='LS'>Lesotho</option><option value='LR'>Liberia</option><option value='LY'>LibyaLI</option><option value='LT'>Lithuania</option><option value='LU'>Luxembourg</option><option value='MO'>Macau</option><option value='MK'>Macedonia</option><option value='MG'>MadagascarMW</option><option value='MY'>Malaysia</option><option value='MV'>Maldives</option><option value='ML'>Mali</option><option value='MT'>Malta</option><option value='MH'>Marshall IslandsMQ</option><option value='MR'>Mauritania</option><option value='MU'>Mauritius</option><option value='YT'>Mayotte</option><option value='MX'>Mexico</option><option value='FM'>MicronesiaMD</option><option value='MC'>Monaco</option><option value='MN'>Mongolia</option><option value='MS'>Montserrat</option><option value='MA'>Morocco</option><option value='MZ'>MozambiqueMM</option><option value='NA'>Namibia</option><option value='NR'>Nauru</option><option value='NP'>Nepal</option><option value='NL'>Netherlands</option><option value='AN'>Netherlands AntillesNT</option><option value='NC'>New Caledonia (French)</option><option value='NZ'>New Zealand</option><option value='NI'>Nicaragua</option><option value='NE'>Niger</option><option value='NG'>NigeriaNU</option><option value='NF'>Norfolk Island</option><option value='KP'>North Korea</option><option value='MP'>Northern Mariana Islands</option><option value='NO'>Norway</option><option value='OM'>OmanPK</option><option value='PW'>Palau</option><option value='PA'>Panama</option><option value='PG'>Papua New Guinea</option><option value='PY'>Paraguay</option><option value='PE'>PeruPH</option><option value='PN'>Pitcairn Island</option><option value='PL'>Poland</option><option value='PF'>Polynesia (French)</option><option value='PT'>Portugal</option><option value='PR'>Puerto RicoQA</option><option value='RE'>Reunion (French)</option><option value='RO'>Romania</option><option value='RU'>Russian Federation</option><option value='RW'>Rwanda</option><option value='GS'>S. Georgia &amp;amp; S. Sandwich Isls.SH</option><option value='KN'>Saint Kitts &amp;amp; Nevis Anguilla</option><option value='LC'>Saint Lucia</option><option value='PM'>Saint Pierre and Miquelon</option><option value='ST'>Saint Tome (Sao Tome) and Principe</option><option value='VC'>Saint Vincent &amp;amp; GrenadinesWS</option><option value='SM'>San Marino</option><option value='SA'>Saudi Arabia</option><option value='SN'>Senegal</option><option value='SC'>Seychelles</option><option value='SL'>Sierra LeoneSG</option><option value='SG'>Singapore</option><option value='SK'>Slovak Republic</option><option value='SI'>Slovenia</option><option value='SB'>Solomon Islands</option><option value='SO'>Somalia</option><option value='ZA'>South AfricaKR</option><option value='ES'>Spain</option><option value='LK'>Sri Lanka</option><option value='SD'>Sudan</option><option value='SR'>Suriname</option><option value='SJ'>Svalbard and Jan Mayen IslandsSZ</option><option value='SE'>Sweden</option><option value='CH'>Switzerland</option><option value='SY'>Syria</option><option value='TJ'>Tadjikistan</option><option value='TW'>TaiwanTZ</option><option value='TH'>Thailand</option><option value='TG'>Togo</option><option value='TK'>Tokelau</option><option value='TO'>Tonga</option><option value='TT'>Trinidad and TobagoTN</option><option value='TR'>Turkey</option><option value='TM'>Turkmenistan</option><option value='TC'>Turks and Caicos Islands</option><option value='TV'>Tuvalu</option><option value='UG'>UgandaUA</option><option value='AE'>United Arab Emirates</option><option value='GB'>United Kingdom</option><option value='UY'>Uruguay</option><option value='MIL'>USA Military</option><option value='UM'>USA Minor Outlying IslandsUZ</option><option value='VU'>Vanuatu</option><option value='VA'>Vatican City State</option><option value='VE'>Venezuela</option><option value='VN'>Vietnam</option><option value='VG'>Virgin Islands (British)VI</option><option value='WF'>Wallis and Futuna Islands</option><option value='EH'>Western Sahara</option><option value='YE'>Yemen</option><option value='YU'>Yugoslavia</option><option value='ZR'>ZaireZM</option><option value='ZW'>Zimbabwe</option><option value=''></option>
		</select>

		<label>Phone Number:</label>
		<input class='mktFormText mktFormPhone' name="phone" id="Phone" type='text' value=""  maxlength='255' tabIndex='7' />
		<textarea name="form_results" class="form-results"></textarea>
		<a id="email-form-submit" class="email-form-submit form-button" href="#" style="margin: 0 0 0 137px;">Submit</a>
	</form>
	<p class="error-message" id="error-message">Please fill in all required fields.</p>
</div>
<div class="email-results-wrapper">

</div>
<script type="text/javascript">
	$(".form-results").html($(".extended-results").html());
	var hasError = false;
	$('#email-form-submit').click(function(evt) {
		evt.preventDefault();
		var required = $(".required");
		var errorMessage = $("#error-message");
		required.each(function(index, element) {
			element = $(element);
			console.log(element);
			console.log($(element).val());
			if($(element).val() == null || $(element).val() == "") {
				element.addClass('error');
				hasError = true;
			}
		});
		if(hasError) {
			$("#error-message").show();
		} else {
			$(".email-form").get(0).submit();
		}
	});

	function submitForm() {
		$.ajax({  
      type: "POST"
      data: $(".email-form").serialize()
      url: $(".email-form").attr("action")
      success: onSubmitSuccess
      error: onSubmitError
    })
	}

	function onSubmitSuccess(data) {
		console.log(data);
		$.colorbox.close();
	}

	function onSubmitError() {
		debug("submit error");
		$.colorbox.close();
	}
</script>