<?php
	//sending mail about order
	require_once("config.php");
	require_once(FRAMEWORK_PATH."system/MailFace.php");
	require_once(FRAMEWORK_PATH."system/MailBus.php");
	require_once(FRAMEWORK_PATH."system/WebText.php");
	require_once(FRAMEWORK_PATH."system/CMSException.php");
	require_once(FRAMEWORK_PATH."system/Db.php");
	//require_once(FRAMEWORK_PATH."system/webshop/order.php");
	require_once(FRAMEWORK_PATH."system/tpl_engine/SmartyView.php");
	
	$subject = WebText::getText('Mail_OrderConfirmationSubject', "Подтверждение Регистрации",false);//WebText::getText('Mail_Test1Subject', "Подтверждение міла Ё!Ё");
	echo $subject."-<br>";
	$body = 'Test message\n hell
	oh...
	hfhfhfh hfhfhfhfh 
	hfhfhfhfh hfhfhffh -'.$subject.'- hfhfhfhfh hfhfhfhfhh 
	h hfhfhfh\nhhhhh';
	
	//if(MailFace::SendTextMail($subject, 'My U-N site <info@u-n.com.ua>', 'MaxIsFighter@gmail.com, max_melissen@meta.ua, max_melissen@mail.ru,uadev_max@yahoo.com', $body))
	if(MailFace::SendHTMLMail($subject, "Ukrainian Basket Pederation <".Context::SiteSettings()->getDefaultSiteEmail().">", 'maxisfighter@gmail.com', $body, ''))
	{
		echo 'Mail SMTP is sent!!!';
		exit;
	}
	else 
	{
		echo 'Error send!';
		exit;
	}
	//var_dump($arrayData);
	/*$view = new SmartyView();
	$HTML = $view->fetch(FRONTEND_TEMPL_PATH.'Mails/newOrderConfirm.tpl', $arrayData);				
	echo $HTML;
	if(MailFace::sendHTMLMail($subject.' mail', 'support@umniy.com', $to, $HTML, 'Sorry this mail has HTML body...'))
	{
		echo 'mail send!!!<br/>';
	}
	else 
	{
		echo 'error send';
	}
	//if(MailFace::sendHTMLMail($subject, 'support@igotofest.org', $to, $HTML, 'Sorry this mail has HTML body...'))
	if(MailFace::sendHTMLMailSMTP($subject.' SMTP mail', 'support@umniy.com', $to, $HTML, 'Sorry this mail has HTML body...'))
	{
		echo 'SMTP mail send!!!';
	}
	else 
	{
		echo 'error send';
	}*/
?>