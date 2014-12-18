<?php
	include_once(FRAMEWORK_PATH."system/MailFace.php");
	include_once(FRONTEND_PATH."config.php");
	include_once(FRAMEWORK_PATH."system/tpl_engine/SmartyView.php");
	
	class MailBus
	{		
		static public function sendOrderConfimation($orderObj)
		{
			if($orderObj->userId)
			{				
				//sending mail about order
				require_once(FRAMEWORK_PATH."system/WebText.php");
				$subject = WebText::getText('Mail_OrderConfirmationSubject', "Подтверждение заказа");

				$user = new user($orderObj->userId);//user::getInstance();
				
				$to = $user->userEmail;
				if(trim(PAYMENT_COPY_EMAIL)!='') $to .= ', '.PAYMENT_COPY_EMAIL;				
				
				if($user->getUserInfo())
				{
					$arrayData['customer'] = $user->getUserInfo();
				}				
				$arrayData['orderId'] =$orderObj->getOrderId();
				$arrayData['totalPrice'] =$orderObj->totalPrice;
				$arrayData['orderStatusId'] =$orderObj->orderStatusId;				
				$arrayData['orderItems'] =$orderObj->getOrderItems();				
				
				$view = new SmartyView();
				$HTML = $view->fetch(FRONTEND_TEMPL_PATH.'Mails/newOrderConfirm.tpl', $arrayData);

				if(MailFace::sendHTMLMail($subject, Context::SiteSettings()->getDefaultSiteEmail(), $to, $HTML, 'Sorry this mail has HTML body...'))
				{
					return true;
				}
				else 
				{
					include_once(SITE_PATH.'vendors/Pear/Log.php');
					$logger = &Log::singleton('file', SITE_PATH.'logs/errors.log');
					$logger->log("MailBus. Error sending confirmation Mail.OrderId:".$orderObj->getOrderId());
					return false;
				}
			}
			else 
			{
				include_once(SITE_PATH.'vendors/Pear/Log.php');
				$logger = &Log::singleton('file', SITE_PATH.'logs/errors.log');			
				$logger->log("MailBus->sendOrderConfimation($orderObj). Order do not have User. OrderId:{$_GET["orderid"]}");
				return false;
			}
		}
		
		static public function sendRegisterConfirmation($confEmailLink,$recipientEmail)
		{
			require_once(FRAMEWORK_PATH."system/WebText.php");
			
			$result = false;
			$view = new SmartyView();
			
			$subject = WebText::getText('Mail_OrderConfirmationSubject', "Подтверждение Регистрации",true);
			$arrayData['confEmailLink'] = $confEmailLink;

			$HTML = $view->fetch(FRONTEND_TEMPL_PATH.'Mails/registrationConfirm.tpl', $arrayData);

			MailFace::SendHTMLMail($subject, Context::SiteSettings()->getDefaultSiteEmail(), $recipientEmail, $HTML, 'Sorry this mail has HTML body...');
			return true;
		}
		
		static public function sendNewUserPassword($recipientEmail,$passwd, $loginName)
        {
            require_once(FRAMEWORK_PATH."system/MailFace.php");
            require_once(FRAMEWORK_PATH."system/WebText.php");

            $view = new SmartyView();

            $title = WebText::getText('Mail_WelcomeToTheSite', "Ласкаво просимо до сайту IGoTo.ua",false);
            $subject = WebText::getText('Mail_RemindPassword', "Нагадування паролю",false);
            $subscribe = WebText::getText('Mail_WithRespect', "З повагою, ",false);
            $arrayData['passwd'] = $passwd;
            $arrayData['name'] = $loginName;
            $arrayMasterData['logoImg'] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/frontend/webcontent/system_images/mail/logo.jpg";
            $arrayMasterData['footerImg'] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/frontend/webcontent/system_images/mail/footer.jpg";
            $arrayMasterData['title'] = $title;
            $arrayMasterData['subject'] = $subject;
            $arrayMasterData['subscribe'] = $subscribe;
            $arrayMasterData['body'] = $view->fetch(FRONTEND_TEMPL_PATH.'Mails/newPaswd.tpl', $arrayData);
            $HTML = $view->fetch(FRONTEND_TEMPL_PATH.'Mails/masterEmail.tpl', $arrayMasterData);

            $result = MailFace::sendHTMLMail($subject, Context::SiteSettings()->getDefaultSiteEmail(), $recipientEmail, $HTML, 'Sorry this mail has HTML body...');

            if($result)
            {
                return true;
            }
            else
            {
                include_once(SITE_PATH.'vendors/Pear/Log.php');
                $logger = &Log::singleton('file', SITE_PATH.'logs/errors.log');
                $logger->log("MailBus. Error sending new password Mail.");
                return false;
            }
        }
		
		static public function sendExtendedRegisterConfimation($confEmailLink,$recipientEmail, $loginName)
		{
			require_once(FRAMEWORK_PATH."system/MailFace.php");
			require_once(FRAMEWORK_PATH."system/WebText.php");
			
			$view = new SmartyView();
			
			$title = WebText::getText('Mail_WelcomeToTheSite', "Ласкаво просимо до сайту IGoTo.ua",false);
			$subscribe = WebText::getText('Mail_RegisterSubscribe', "Дякуємо за реєстрацію. Ваш ",false);
            $subject = WebText::getText('Mail_RegisterConfimation', "Підтвердження реєстрації",false);
			$arrayData['confEmailLink'] = $confEmailLink;
			$arrayData['name'] = $loginName;
			$arrayMasterData['logoImg'] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/frontend/webcontent/system_images/mail/logo.jpg";
			$arrayMasterData['footerImg'] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/frontend/webcontent/system_images/mail/footer.jpg";
			$arrayMasterData['title'] = $title;
			$arrayMasterData['subscribe'] = $subscribe;
			$arrayMasterData['subject'] = $subject;
			$arrayMasterData['body'] = $view->fetch(FRONTEND_TEMPL_PATH.'Mails/registrationConfirm.tpl', $arrayData);
			$HTML = $view->fetch(FRONTEND_TEMPL_PATH.'Mails/masterEmail.tpl', $arrayMasterData);

			MailFace::SendHTMLMail($subject, Context::SiteSettings()->getDefaultSiteEmail(), $recipientEmail, $HTML, 'Sorry this mail has HTML body...');
			return true;
		}

        static public function sendUserActivationConfimation($recipientEmail, $loginName)
		{
			require_once(FRAMEWORK_PATH."system/MailFace.php");
			require_once(FRAMEWORK_PATH."system/WebText.php");

			$view = new SmartyView();

			$title = WebText::getText('Mail_WelcomeToTheSite', "Ласкаво просимо до сайту IGoTo.ua",false);
			$subscribe = WebText::getText('Mail_RegisterSubscribe', "Дякуємо за реєстрацію. Ваш ",false);
            $subject = WebText::getText('Mail_RegisterConfimation', "Підтвердження реєстрації",false);
			$arrayData['nickName'] = $loginName;
			$arrayData['email'] = $recipientEmail;
			$arrayMasterData['logoImg'] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/frontend/webcontent/system_images/mail/logo.jpg";
			$arrayMasterData['footerImg'] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/frontend/webcontent/system_images/mail/footer.jpg";
			$arrayMasterData['title'] = $title;
			$arrayMasterData['subscribe'] = $subscribe;
			$arrayMasterData['subject'] = $subject;
			$arrayMasterData['body'] = $view->fetch(FRONTEND_TEMPL_PATH.'Mails/activationConfirm.tpl', $arrayData);
			$HTML = $view->fetch(FRONTEND_TEMPL_PATH.'Mails/masterEmail.tpl', $arrayMasterData);

			MailFace::SendHTMLMail($subject, Context::SiteSettings()->getDefaultSiteEmail(), $recipientEmail, $HTML, 'Sorry this mail has HTML body...');
			return true;
		}

		static public function changedUserStatusNotification($recipientEmail,$emailText)
		{
			require_once(FRAMEWORK_PATH."system/WebText.php");
			
			$result = false;
			$view = new SmartyView();
			
			$subject = WebText::getText('siteGuestStatusChanged', "Регистрация");
			$arrayData['emailText'] = stripcslashes($emailText);
			$HTML = $view->fetch(FRONTEND_TEMPL_PATH.'Mails/changedUserStatusNotification.tpl', $arrayData);

			MailFace::SendHTMLMail($subject, Context::SiteSettings()->getDefaultSiteEmail(), $recipientEmail, $HTML, 'Sorry this mail has HTML body...');
			
			if($result)
			{
				return true;
			}
			else 
			{
				include_once(SITE_PATH.'vendors/Pear/Log.php');
				$logger = &Log::singleton('file', SITE_PATH.'logs/errors.log');
				$logger->log("MailBus. Error sending new password Mail.");
				return false;
			}
		}
		
		static public function sendContactMessage($subject, $targetEmail, $data)
		{
			require_once(FRAMEWORK_PATH."system/WebText.php");
			
			$result = false;
			$view = new SmartyView();
			
			$arrayData['fields'] = $data;
			$arrayData['title'] = $subject;
			$arrayData['logoImg'] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/frontend/webcontent/system_images/mail/logo.jpg";
			$arrayData['footerImg'] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/frontend/webcontent/system_images/mail/footer.jpg";

			$HTML = $view->fetch(FRONTEND_TEMPL_PATH.'Mails/contactMessage.tpl', $arrayData);
			return MailFace::SendHTMLMail($subject, Context::SiteSettings()->getDefaultSiteEmail(), $targetEmail, $HTML, 'Sorry this mail has HTML body...');
		}

        static public function sendMessageToServiceRequestUser($subject, $targetEmail, $data)
        {
            require_once(FRAMEWORK_PATH."system/WebText.php");

            $result = false;
            $view = new SmartyView();

            $arrayData['fields'] = $data;
            $arrayData['title'] = $subject;
            $arrayData['logoImg'] = SITE_PROTOCOL.SITE_URL."/frontend/webcontent/system_images/mail/logo.jpg";
            $arrayData['footerImg'] = SITE_PROTOCOL.SITE_URL."/frontend/webcontent/system_images/mail/footer.jpg";

            $HTML = $view->fetch(FRONTEND_TEMPL_PATH.'Mails/serviceRequestMessage.tpl', $arrayData);
            return MailFace::SendHTMLMail($subject, Context::SiteSettings()->getDefaultSiteEmail(), $targetEmail, $HTML, 'Sorry this mail has HTML body...');
        }
	}
?>