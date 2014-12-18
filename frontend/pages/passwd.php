<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");

require_once(FRAMEWORK_PATH."system/addresses.php");
require_once(FRAMEWORK_PATH."system/ReservedRequestData.php");

class forgotPasswd extends Page
{
    protected 	$template = 'Pages/passwd.tpl';
    //protected 	$requireAuthorization = true;
    protected 	$user;
    protected 	$address;

    public function load()
    {
		return $this->templateData;
    }

    protected function init()
	{
        $cache = new CacheFace();
        if($this->pageData = $cache->get('passwdPage_'.$this->getPageId())){
            $this->templateData = unserialize($this->pageData);
        }
        else
        {
            $this->pageData = new PageData($this->getPageId());
            if(!$this->pageData->load())
                throw new CMSException('Error initializing passwd.php page');

            if($this->pageData->getValue('title')){
                $this->templateData['title'] = $this->pageData->getValue('title');
            }

            if($this->pageData->getValue('introHtml')){
                $this->templateData['introHtml'] = appUrl::CMSConstantsToValues($this->pageData->getValue('introHtml'));
            }

            if($this->pageData->getValue('html')){
                $this->templateData['html'] = appUrl::CMSConstantsToValues($this->pageData->getValue('html'));
            }

            if($this->pageData->getValue('text1')){
                $this->templateData['text1'] = appUrl::CMSConstantsToValues($this->pageData->getValue('text1'));
            }

            $cache->save(serialize($this->templateData));
        }





        //confirm change password
        if( !is_null(Request::getInt("ch","GET")) && !is_null(Request::getString("confrmcode","GET")))
        {
            $user = CMSUser::getInstance();
            if(!$user->isLogged && $user->confirmUserPassword(Request::getInt("ch","GET"), Request::getString("confrmcode","GET"), Request::getString("hp","GET")))
            {
                $this->templateData['confirmationSuccessMessage']= addslashes(WebText::getText("reminder_password_popup_changed", "Вы успешно восстановили пароль."));
                return true;
            }
        }
    }
}

$newPage = new forgotPasswd();
$newPage->run();

?>