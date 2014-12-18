<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");

class RegistrationConfirm extends Page 
{
    private $confirmationSuccess = false;
    private $curUserId;

    protected 	$template = 'Pages/regconfirm.tpl';

    public function load() 
    {
        $this->pageData = new PageData($this->getPageId());
		if($this->pageData->load())
		{
		    $this->templateData['title'] = $this->pageData->getValue('title');
			if($this->pageData->getValue('introHtml') && $this->confirmationSuccess)
			{
			    $this->templateData['confirmationMessage'] = appUrl::CMSConstantsToValues($this->pageData->getValue('introHtml'));
			    if($this->isRequestForReferee($this->curUserId))
			    {
				    require_once(FRAMEWORK_PATH."system/MailBus.php");
				    MailBus::sendRefereeQuery($this->pageData->getValue('text1'), $_POST['ud']['name'], $_POST['ud']['patronymic']);
			    }
			}
			elseif($this->pageData->getValue('outroHtml'))
			{
			    $this->templateData['confirmationMessage'] = appUrl::CMSConstantsToValues($this->pageData->getValue('outroHtml'));
			}
		}
        return $this->templateData;
    }
    
    protected function init()
    {
    	session_start();
    	require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
    	$user = new CMSUser();
    	$userId = Request::getInt("ch","GET");
    	
    	if ($user->getUserKey($userId) == Request::getString("confrmcode","GET"))
    	{
    		$user->confirmUserRegistration($userId);
    		//$this->templateData['user_privatepage_url'] = appUrl::getUrl($userId,'user.php');
    		$this->templateData['user_privatepage_url'] = '';
    		$this->confirmationSuccess = true;
    		$this->curUserId	=	$userId;
    	}
    }
    
    public function isRequestForReferee($userId)
	{
		$userId = intval($userId);
		$query = "SELECT count(fe_Users.id) as count FROM fe_Users WHERE fe_Users.id=$userId AND fe_Users.referee = 1";
		if (Context::DB()->query($query)) 
		{
			if(Context::DB()->result[0]['count']>0)
				return true;
		}
		else return false;
	}
}

$newPage = new RegistrationConfirm();
$newPage->run();
?>