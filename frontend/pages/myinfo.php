<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
require_once(FRAMEWORK_PATH."system/addresses.php");
require_once(FRAMEWORK_PATH."system/helper/LanguagesRelationManager.php");
require_once(FRAMEWORK_PATH."system/helper/LinkManager.php");
require_once(FRAMEWORK_PATH."system/helper/DateManager.php");
require_once(FRAMEWORK_PATH."system/ReservedRequestData.php");


class userInfo extends Page
{
    protected 	$CSS = array("/frontend/webcontent/js/jquery-ui/css/jquery-ui.css");

    protected 	$JS = array("/frontend/webcontent/js/jquery-ui/js/jquery-ui.min.js",
        "/frontend/webcontent/js/jquery-ui/js/jquery-ui-i18n.js",
        //"/frontend/webcontent/js/jquery.showPassword.js",
        "/frontend/webcontent/js/jquery.form.js");

    protected 	$template = 'Pages/myinfo.tpl';
    protected 	$requireAuthorization = false;
    protected 	$user;
    protected 	$allowUnAuthorized = false;
    protected 	$address;

    public function load()
    {
        if(!$this->allowUnAuthorized){
            $this->requireAuthorization = true;
            $this->isRequireAuth();
        }

        $this->templateData['allowUnAuthorized'] = $this->allowUnAuthorized;

		if($userInfo = $this->user->getUserInfo($this->user->userId))
		{
			$this->templateData['password'] = $userInfo['password'];
			$this->templateData['name'] = $userInfo['name'];
			$this->templateData['surname'] = $userInfo['surname'];
            $this->templateData['phoneNumber'] = $userInfo['phoneNumber'];
            $this->templateData['email'] = $userInfo['email'];
            $this->templateData['regDeliveryCity'] = $userInfo['text1'];
            $this->templateData['street'] = $userInfo['text2'];
            /*$this->templateData['defaultAddressId'] = $userInfo['defaultAddressId'];
            $address = new Addresses();
            $address = $address->get($userInfo['defaultAddressId']);
            $this->templateData['countryName'] = $address['countryName'];
            $this->templateData['gender'] = $userInfo['gender'];
            $this->templateData['cityName'] = $address['cityName'];
            //$this->templateData['street'] = $address['street'];
            $this->templateData['houseNumber'] = $address['houseNumber'];
            $this->templateData['zipCode'] = $address['zipCode'];
            if(strlen($userInfo['birthDate'])>0)
            $this->templateData['birthDate'] = date(DateManager::convert2phpDateFormat(Context::SiteSettings()->getDateFormat()), strtotime($userInfo['birthDate']));
            */
		}
		return $this->templateData;
    }

    protected function init()
	{
        if(isset($_GET['ch']) && isset($_GET['confrmcode']))
        {
            $userId	=	Request::getInt("ch","GET");
            $this->user = new CMSUser($userId);
            if (CMSUser::isUserNonActive($userId) && CMSUser::getUserKey($userId) == Request::getString("confrmcode","GET")){
                if($this->user->confirmUserRegistration($userId))
                {
                    require_once(FRAMEWORK_PATH."system/MailBus.php");
                    if(MailBus::sendUserActivationConfimation($this->user->userEmail, $this->user->loginName)){
                        $this->allowUnAuthorized = true;
                    }
                }
            }
            elseif( !CMSUser::isUserNonActive($userId) && CMSUser::getUserKey($userId) == Request::getString("confrmcode","GET")
                    && isset($_POST['form_submitted']) && request::getInt("form_submitted","POST") ){
                $this->allowUnAuthorized = true;
            }
        }
        else{
            $this->user = CMSUser::getInstance();
        }

		$this->address = new Addresses();

        $cache = new CacheFace();
        if($this->pageData = $cache->get('editUserProfilePage_'.$this->getPageId())){
            $this->templateData = unserialize($this->pageData);
        }
        else
        {
            $this->pageData = new PageData($this->getPageId());
            if(!$this->pageData->load())
                throw new CMSException('Error initializing myinfo.php page');

            if($this->pageData->getValue('title')){
                $this->templateData['title'] = $this->pageData->getValue('title');
            }

            if($this->pageData->getValue('introHtml')){
                $this->templateData['introHtml'] = appUrl::CMSConstantsToValues($this->pageData->getValue('introHtml'));
            }

            if($this->pageData->getValue('text1')){
                $this->templateData['errorTxt'] = appUrl::CMSConstantsToValues($this->pageData->getValue('text1'));
            }
            if($this->pageData->getValue('text2')){
                $this->templateData['passTxt'] = appUrl::CMSConstantsToValues($this->pageData->getValue('text2'));
            }

            if($this->pageData->getValue('text3')){
                $this->templateData['cancelButtonLink'] = appUrl::checkUrl($this->pageData->getValue('text3'));
            }
            $this->templateData['calendarImg'] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().'/frontend/webcontent/system_images/calendar.png';
            $this->templateData['dateFormat']   =   Context::SiteSettings()->getDateFormat();
            $this->templateData['langMetaTag']  =   Context::LanguageMetaTag();

            $cache->save(serialize($this->templateData));
        }
/*

    	if(request::getInt("form_submitted","POST"))
		{
			if($this->user->changeUser(ReservedRequestData::user()))
            {
				$this->templateData['dataProcessingMessageSuccess'] = $this->templateData['passTxt'];
			}
			else {
				$this->templateData['dataProcessingMessageError'] = $this->templateData['errorTxt'];
			}
            for($i=0; $i<=count($this->user->validationErrors)-1;$i++)
            {
                $this->templateData['validationErrors'][$i]['value'] = $this->user->validationErrors[$i]['value'];
                $this->templateData['validationErrors'][$i]['field'] = $this->user->validationErrors[$i]['field'];
            }
            foreach ($_POST as $k=>$v)
            {
                $this->templateData[$k] = $v;
            }
		}
        if(request::getInt("form_submitted_change_pass","POST"))
        {
            if($this->user->changePasswordUser(ReservedRequestData::changePass()))
            {
                $this->templateData['dataProcessingMessageSuccess'] = $this->templateData['passTxt'];
            }
            else {
                $this->templateData['dataProcessingMessageError'] = $this->templateData['errorTxt'];
            }
            for($i=0; $i<=count($this->user->validationErrors)-1;$i++)
            {
                $this->templateData['validationErrors'][$i]['value'] = $this->user->validationErrors[$i]['value'];
                $this->templateData['validationErrors'][$i]['field'] = $this->user->validationErrors[$i]['field'];
            }
            foreach ($_POST as $k=>$v)
            {
                $this->templateData[$k] = $v;
            }
        }
*/
    }
}

$newPage = new userInfo();
$newPage->run();