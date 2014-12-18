<?php
session_start();
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
require_once(FRAMEWORK_PATH."system/helper/LanguagesRelationManager.php");
require_once(FRAMEWORK_PATH."system/ReservedRequestData.php");

class RegistrationPage extends Page 
{
    protected 	$template = 'Pages/register.tpl';
    
    public function load()
    {
		return $this->templateData;
    }

    protected function init()
    {
        $cache = new CacheFace();
        if($this->pageData = $cache->get('registerUserPage_'.$this->getPageId())){
            $this->templateData = unserialize($this->pageData);
        }
        else
        {
            $this->pageData = new PageData($this->getPageId());
            if(!$this->pageData->load())
                throw new CMSException('Error initializing register.php page');

            $this->templateData['title'] = $this->pageData->getValue('title');

            if($this->pageData->getValue('introHtml')){
                $this->templateData['introHtml'] = appUrl::CMSConstantsToValues($this->pageData->getValue('introHtml'));
            }
            if($this->pageData->getValue('text1')){
                $this->templateData['passTxt'] = appUrl::CMSConstantsToValues($this->pageData->getValue('text1'));
            }
            if($this->pageData->getValue('text2')){
                $this->templateData['errorTxt'] = appUrl::CMSConstantsToValues($this->pageData->getValue('text2'));
            }
            if($this->pageData->getValue('text3')){
                $this->templateData['confirmEmailLink'] = appUrl::checkUrl($this->pageData->getValue('text3'));
            }
            if($usersAgreementPageUrl = LanguagesRelationManager::GetRelatedUrl(Context::SiteSettings()->getUsersAgreementPageUrl()));
                $this->templateData['userAgreementPageUrl'] = $usersAgreementPageUrl;

            if($siteRulesPageUrl = LanguagesRelationManager::GetRelatedUrl(Context::SiteSettings()->getSiteRulesPageUrl()));
                $this->templateData['siteRulesPageUrl'] = $siteRulesPageUrl;

            $cache->save(serialize($this->templateData));
        }


    	if(request::getInt("registration","POST"))
		{
            $user = new CMSUser();
            if(! $user->createUser(ReservedRequestData::userRegistration()))
            {
                for($i=0; $i<=count($user->validationErrors)-1;$i++)
                {
                    $this->templateData['validationErrors'][$i]['value'] = $user->validationErrors[$i]['value'];
                    $this->templateData['validationErrors'][$i]['field'] = $user->validationErrors[$i]['field'];
                }

                foreach ($_POST['ud'] as $k=>$v)
                {
                    $this->templateData[$k] = $v;
                }
                return;
            }

            require_once(FRAMEWORK_PATH."system/MailBus.php");
            $amp = USE_REWRITE?'?':'&';
            $confEmailLink = $this->templateData['confirmEmailLink'].$amp.'confrmcode='.$user->getUserGuid().'&ch='.$user->userId;
            if(MailBus::sendExtendedRegisterConfimation($confEmailLink,$_POST['ud']['email'], $_POST['ud']['loginName']))
            {
                $_SESSION['registered']	=	true;
                $this->templateData['registerText']	=	$this->templateData['passTxt'];
                $this->templateData['registered']	=	1;
            }
            else
            {
                $this->templateData['registerText']	=	$this->templateData['errorTxt'];
                $this->templateData['registered']	=	-1;
            }
		}
    }
}

$newPage = new RegistrationPage();
$newPage->run();

?>