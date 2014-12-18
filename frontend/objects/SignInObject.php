<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");
require_once(FRAMEWORK_PATH."data_objects/base/PageObjectData.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");

class SignInObject extends PageObject 
{
    public 	$JS = array("/frontend/webcontent/js/page.js",
                            "/frontend/webcontent/js/jquery.form.js");

	protected $user = null;
	protected $registerPageViewId = 37;
	protected $remindPasswordPageViewId = 77;
	protected $privateOfficePageViewId = 33;
    protected $ordersListViewId = 142;
    protected $tmpPoData = array();

    public function loadPageObject()
    {
        $cache = new CacheFace();
        if($poData = $cache->get('sigInForm_'.$this->poId)){
            $this->tmpPoData = unserialize($poData);
        }
        else
        {
            $poData = new PageObjectData($this->poId);
            if($poData->load())
            {
                $this->tmpPoData['title'] = $poData->getValue('title');

                if($registerPageUrl=LinkManager::GetSystemPageUrl($this->registerPageViewId))
                    $this->tmpPoData['registerPage'] = $registerPageUrl;

                if($remindPasswordPageUrl = LinkManager::GetSystemPageUrl($this->remindPasswordPageViewId))
                    $this->tmpPoData['remindPassword'] = $remindPasswordPageUrl;

                if($privateOfficePageUrl = LinkManager::GetSystemPageUrl($this->privateOfficePageViewId))
                    $this->tmpPoData['privateOfficeUrl'] = $privateOfficePageUrl;

                //$this->tmpPoData['ordersListUrl'] = LinkManager::GetSystemPageUrl($this->ordersListViewId);

                if($poData->getValue('text1')){
                    $this->tmpPoData['linktitle'] = $poData->getValue('text1');
                }
                if($poData->getValue('text3')){
                    $this->tmpPoData['logintitle'] = $poData->getValue('text3');
                }
                if($poData->getValue('text4')){
                    $this->tmpPoData['passwordtitle'] = $poData->getValue('text4');
                }
                if($poData->getValue('text5')){
                    $this->tmpPoData['submittitle'] = $poData->getValue('text5');
                }
                if($poData->getValue('text7')){
                    $this->tmpPoData['text7'] = $poData->getValue('text7');
                }
                if($poData->getValue('seo1')){
                    $this->tmpPoData['exittitle'] = $poData->getValue('text8');
                }
                $cache->save(serialize($this->tmpPoData));

            }
            else{
                return false;
            }
        }
        if (isset($this->pageObjectData['no_matches']) && $this->pageObjectData['no_matches']){
            header("Location: ".appUrl::checkUrl($this->pageObjectData['text7'])."?email=".trim($_POST['email']));
        }
        $this->pageObjectData = array_merge($this->pageObjectData, $this->tmpPoData);
        $this->setTemplate('templates/PageObjects/SignInObject.tpl');
        return true;
    }
    
    public function initPageObject()
    {
    	$this->user = CMSUser::getInstance();

        if($this->user->isLogged)
        {
            //logout functionality
            if(isset($_POST['signOut']) && Request::getInt("signOut","POST")==1){
                $this->user->logout();
                if (USE_PHPBB)
                {
                    include_once(FRAMEWORK_PATH."custom/phpbb.php");
                    $phpBb = new phpbb(PHPBB_PATH);
                    $phpBb->user_logout();
                }

                $params = Context::SiteSettings()->getDefaultPageParams();
                $pageId = isset($params['id'])?$params['id']:null;
                $pageCode = isset($params['pagecode'])?$params['pagecode']:null;
                $pageClass = isset($params['pageclass'])?$params['pageclass']:null;

                header('Location: '.appUrl::getUrl($pageId,$pageClass, $pageCode, Context::LanguageCode()));
                /*if($registerPageUrl = LinkManager::GetSystemPageUrl($this->registerPageViewId)){
                    header('Location: '.$registerPageUrl);
                }
                else{
                    if($registerPageUrl = LinkManager::GetSystemPageUrl($this->registerPageViewId, true))
                        header('Location: '.$registerPageUrl);
                }*/
                exit();
                return;
            }

            $this->pageObjectData['logined'] = true;
            $this->pageObjectData['name'] = $this->user->userName;
            $this->pageObjectData['userId'] = $this->user->userId;
            return true;
        }

        //if posted logins
        if(!is_null(Request::getString('email','POST')))
        {
            $user = CMSUser::getInstance();
            $userData = ReservedRequestData::userLogin();
            //validate data
            if(!Validation::validate($userData, $errors))
            {
                $this->pageObjectData['loginEmail'] = $userData['email']['value'];
                $this->pageObjectData['validationErrors'] = json_encode($errors);
                return false;
            }
            //if user not exist or not active
            if(!$user->login($userData['email']['value'], $userData['password']['value']))
            {
                $remindPasswd = false;
                if($user->isEmailNotUsed($userData['email']['value']))
                {
                    $errors[0]['value'] = WebText::getText("user_login_data_not_valid_not_email","Данный email не зарегистрирован. Пожалуйста зарегестрируйтесь.");
                    $errors[0]['field'] = 'email';
                }
                else
                {
                    $errors[0]['value'] = WebText::getText("user_login_data_not_valid_pass","Вы ввели неверный пароль");
                    $errors[0]['field'] = 'email';
                    $remindPasswd = true;
                }

                $this->pageObjectData['loginEmail'] = $userData['email']['value'];
                $this->pageObjectData['validationErrors'] = json_encode($errors);
                $this->pageObjectData['remindPasswd'] = $remindPasswd;
                return false;
            }
            $this->pageObjectData['logined'] = true;
        }

        return;
    }
}
