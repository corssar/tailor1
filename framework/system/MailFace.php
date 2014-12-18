<?php
include_once(SITE_PATH.'vendors/Pear/Mail.php');
include_once(SITE_PATH.'vendors/Pear/mime.php');

class MailFace
{
	/* text mail*/
	static public function SendTextMail($subject, $from, $to, $body)
	{
		if(Context::SiteSettings()->useSMTP()===true)
			return self::SendTextViaSMTP($subject, $from, $to, $body);
		else 
			return self::SendText($subject, $from, $to, $body);
	}	
	/* html mail*/
	static public function SendHTMLMail($subject, $from, $to, $body, $textBody)
	{
		if(Context::SiteSettings()->useSMTP()===true)
			return self::SendHTMLViaSMTP($subject, $from, $to, $body, $textBody);
		else 
			return self::SendHTML($subject, $from, $to, $body, $textBody);
	}
	
	static private function SendText($subject, $from, $to, $body)
	{
		$headers['From']    = $from;
		$headers['To']      = $to;
		$headers['Subject'] = $subject;		
		//$headers['Content-Type'] = 'text/plain; charset=utf-8';	
		//encodeHeader( 'Subject', $subject, 'utf-8', 'base64' );

		$mime = new Mail_mime("\n");		
		$mime->setTXTBody($body);
        $body = $mime->get(array("text_charset" => "utf-8", "text_encoding" => "base64", "head_charset" => "utf-8", "head_encoding" => "base64"));
        $headers = $mime->headers($headers, true);
        //var_dump($headers);
		
		// Create the mail object using the Mail::factory method
		$mail_object =& Mail::factory('mail');		
		$mailResult = $mail_object->send($to, $headers, $body);
		
		if($mailResult===true){
			return true;
		}
		else{
			throw new CMSException('Error sent Text Mail. ErrCode: '.$mailResult->getCode().' message: '.$mailResult->getMessage());
			return false;			
		}
	}
	static private function SendTextViaSMTP($subject, $from, $to, $body)
	{	
		$headers['From']    = $from;
		$headers['To']      = $to;
		$headers['Subject'] = $subject;	
		
		$mime = new Mail_mime("\n");
		$mime->setTXTBody($body);	
			    
		$mimeparam = array("text_charset" => "utf-8", "text_encoding" => "base64", "head_charset" => "utf-8", "head_encoding" => "base64");

		//do not ever try to call these lines in reverse order
		$body = $mime->get($mimeparam);
		$headers = $mime->headers($headers, true);

        $SMTPSettings = Context::SiteSettings()->getSMTPSettings();
        $smtp_params["host"] = $SMTPSettings['SMTPServer']; // SMTP host
        $smtp_params["port"] = $SMTPSettings['SMTP_PORT'];        // SMTP Port (usually 25)
        $smtp_params["auth"]     = $SMTPSettings['SMTP_AUTH'];
        $smtp_params["username"] = $SMTPSettings['SMTPUser'];
        $smtp_params["password"] = $SMTPSettings['SMTPPassword'];

        /*$smtp_params["localhost"] = "sl.ukrbasket.net";*/
        
        $mail =& Mail::factory("smtp", $smtp_params); 
        
		$mailResult=$mail->send($to, $headers, $body);
		//if (PEAR::isError($mailResult)) {
		if($mailResult===true)
		{
			return true;
		}
		else
		{
			throw new CMSException('Error sent Text Mail. ErrCode: '.$mailResult->getCode().' message: '.$mailResult->getMessage());
			return false;			
		}
	}	

	static private function SendHTML($subject, $from, $to, $body, $textBody)
	{
		$headers = array(
		              'From'    => $from,
		              'To'		=> $to,
		              'Subject' => $subject
		              );
		
		$mime = new Mail_mime("\n");
		
		$mime->setTXTBody($textBody);
		$mime->setHTMLBody($body);

		$mimeparam = array ("text_charset" => "utf-8", "text_encoding" => "base64", "head_charset" => "utf-8", "head_encoding" => "base64",
               				"html_encoding" => "base64", "html_charset" => "utf-8");
		//do not ever try to call these lines in reverse order
		$body = $mime->get($mimeparam);
		$headers = $mime->headers($headers, true);
		$mail =& Mail::factory('mail');
		$mailResult=$mail->send($to, $headers, $body);
		if($mailResult===true){
			return true;
		}
		else{
			throw new CMSException('Error sent HTML Mail. ErrCode: '.$mailResult->getCode().' message: '.$mailResult->getMessage());
			return false;			
		}
	}
	static private function SendHTMLViaSMTP($subject, $from, $to, $HTMLBody, $textBody)
	{
		include_once(SITE_PATH.'vendors/Pear/mime.php');
		
		$headers = array(
		              'From'    => $from,
		              'To' => $to,
		              'Subject' => $subject
		              );
		
		$mime = new Mail_mime("\n");
		$mime->setHTMLBody($HTMLBody);	
			    
		$mimeparam = array ("text_charset" => "utf-8", "text_encoding" => "base64", "head_charset" => "utf-8", "head_encoding" => "base64",
               				"html_encoding" => "base64", "html_charset" => "utf-8");
		//do not ever try to call these lines in reverse order
		$body = $mime->get($mimeparam);
		$headers = $mime->headers($headers);

        $SMTPSettings = Context::SiteSettings()->getSMTPSettings();
        $smtp_params["host"] = $SMTPSettings['SMTPServer']; // SMTP host
        $smtp_params["port"] = $SMTPSettings['SMTP_PORT'];      // SMTP Port (usually 25)
        $smtp_params["auth"]     = $SMTPSettings['SMTP_AUTH'];
        $smtp_params["username"] = $SMTPSettings['SMTPUser'];
        $smtp_params["password"] = $SMTPSettings['SMTPPassword'];
        /*$smtp_params["localhost"] = "sl.ukrbasket.net";*/
        
        $mail =& Mail::factory("smtp", $smtp_params); 
        
		$mailResult=$mail->send($to, $headers, $body);
		if($mailResult===true)
		{
			return true;
		}
		else
		{
			throw new CMSException('Error sent HTML Mail. ErrCode: '.$mailResult->getCode().' message: '.$mailResult->getMessage());
			return false;			
		}
	}
}
?>