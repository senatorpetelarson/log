<?php
class email {

	function email() {
		//initialize function
	}
	
	function get_include_contents($filename) {
	   if (is_file($filename)) {
		   ob_start();
		   include $filename;
		   $contents = ob_get_contents();
		   ob_end_clean();
		return $contents;
	   }
	   return false;
	}
	
	function sendMail($from,$to,$subject,$textbody,$htmlbody) {
		$semi_rand = md5(time());
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
		
		$textbody = "--".$mime_boundary."\n"
		."Content-Type: text/plain; charset=\"iso-8859-1\"\n"
		."Content-Transfer-Encoding: 7bit\n\n"
		.$textbody."\n\n";
		
		$htmlbody = "--".$mime_boundary."\n"
		."Content-Type: text/html; charset=\"iso-8859-1\"\n"
		."Content-Transfer-Encoding: 7bit\n\n"
		.$htmlbody."\n\n--".$mime_boundary."--";
		
		$body = $textbody.$htmlbody;
		$addHeader = "From: $from\n"
					."X-Mailer: PHP 4.x\n"
					."MIME-Version: 1.0\n"
					."Content-Type: multipart/alternative;\n"
					." boundary=\""
					.$mime_boundary."\"";
		$result = @mail($to,$subject,$body,$addHeader);
		return $result;
	}
}
?>