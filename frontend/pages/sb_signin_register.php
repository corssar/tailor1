<?php
if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once FRAMEWORK_PATH.'system/webshop/basket.php';
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
require_once(FRAMEWORK_PATH."system/helper/LinkManager.php");


class SbSigninRegister extends Page
{
    protected $template = 'Pages/sb_signin_register.tpl';

    protected 	$CSS = array("/frontend/webcontent/js/jquery-ui/css/jquery-ui.css",
        "/frontend/webcontent/css/validationEngine.jquery.css");

    protected 	$JS = array("/frontend/webcontent/js/jquery-ui/js/jquery-ui.min.js",
        "/frontend/webcontent/js/jquery-ui/js/jquery-ui-i18n.js",
        "/frontend/webcontent/js/jquery.showPassword.js"
    );

    public function load()
    {
        $this->templateData['ajaxHandler'] = AJAX_HANDLER;
        $this->templateData['nextStep'] = LinkManager::GetSystemPageUrl(136);

        $this->templateData['title'] = $this->pageData->getValue('title');
        $this->templateData['registerUrl'] = LinkManager::GetSystemPageUrl(37);

        return $this->templateData;
    }

    protected function init()
    {
        $user = CMSUser::getInstance();
        /** if user logged in then redirect him to next step (shipping/billing address) */
        if($user->isLogged)
        {
            if($url = LinkManager::GetSystemPageUrl(136))
                header("Location: ".$url);
        }

        $this->pageData = new PageData($this->getPageId());

        if(!$this->pageData->load())
        {
            throw new CMSException('Error initializing sb_signin_register.php page');
        }
    }
}
$newPage = new SbSigninRegister();
$newPage->run();