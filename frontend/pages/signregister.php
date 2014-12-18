<?php
session_start();
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
require_once(FRAMEWORK_PATH."system/helper/LinkManager.php");
require_once(FRONTEND_PATH."objects/SignInObject.php");

class RegistrationPage extends Page
{
    protected 	$template = 'Pages/signinregister.tpl';
    protected   $profilePageViewId = 33;
    protected 	$confirmationSuccess = false;
    protected 	$isConfirm = false;

    protected 	$CSS = array("/frontend/webcontent/js/jquery-ui/css/jquery-ui.css");

    protected 	$JS = array("/frontend/webcontent/js/jquery-ui/js/jquery-ui.min.js",
                            "/frontend/webcontent/js/jquery-ui/js/jquery-ui-i18n.js",
                            "/frontend/webcontent/js/jquery.form.js");

    public function load()
    {

        $this->templateData['title'] = $this->pageData->getValue('title');

        $this->templateData['successRegistrationTxt'] = appUrl::CMSConstantsToValues($this->pageData->getValue('shortDescription'));

        //$this->templateData['confirmPage'] = LinkManager::GetSystemPageUrl(37);

        //$this->templateData['remindPassword'] = LinkManager::GetSystemPageUrl(77);

        if(isset($_SESSION['ipr_referer']))
        {
            $this->templateData['refererUrl'] = appUrl::checkUrl($_SESSION['ipr_referer']);
            unset($_SESSION['ipr_referer']);
        }
        else
            $this->templateData['refererUrl'] = LinkManager::GetSystemPageUrl($this->profilePageViewId);


/*        $this->templateData['confirmTxt'] = ($this->isConfirm)
                                            ? ($this->confirmationSuccess ? appUrl::CMSConstantsToValues($this->pageData->getValue('text3')) : appUrl::CMSConstantsToValues($this->pageData->getValue('text4')))
                                            : '';*/

        return $this->templateData;
    }

    protected function init()
    {
//        $user = CMSUser::getInstance();
//
//        if($user->isLogged){
//            if($homePageUrl = LinkManager::GetSystemPageUrl(21))
//                header("Location: ".$homePageUrl);
//        }
//
//        $userId = isset($_GET['ch']) ? Request::getInt('ch','GET') : false;
//        $confirmCode = isset($_GET['confirmcode']) ? Request::getString('confirmcode','GET') : false;
//        if($userId && $confirmCode)
//        {
//            if ($user->getUserKey($userId) == $confirmCode)
//            {
//                $user->confirmUserRegistration($userId);
//                $this->confirmationSuccess = true;
//                $this->isConfirm = true;
//            }
//        }
        $this->pageData = new PageData($this->getPageId());

        if(!$this->pageData->load())
        {
            throw new CMSException('Error initializing register.php page');
        }
    }

}

$newPage = new RegistrationPage();
$newPage->run();

?>