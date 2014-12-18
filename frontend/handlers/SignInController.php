<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."system/Request.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
require_once(FRAMEWORK_PATH."system/ReservedRequestData.php");
require_once(FRAMEWORK_PATH."system/appUrl.php");
require_once(FRAMEWORK_PATH."system/webshop/basket.php");
require_once(FRAMEWORK_PATH."system/addresses.php");


class SignInController
{
	var $pageObjectData = array();

    public $validationErrors = array();
	
//	protected function getData()
//	{
//		$aTemplateData = array();
//
//		$query = "SELECT * FROM `fe_Pages` WHERE viewId=34 AND langId = ".Context::LanguageId()." AND websiteId = ".Context::SiteSettings()->getSiteId()." LIMIT 0,1";
//		if (Context::DB()->query($query))
//		{
//			$aTemplateData['title'] = Context::DB()->result[0]['title'];
//			$aTemplateData['linktitle'] = Context::DB()->result[0]['text1'];
//			$aTemplateData['registerPage'] = appUrl::checkUrl(Context::DB()->result[0]['text2']);
//			$aTemplateData['logintitle'] = Context::DB()->result[0]['text3'];
//			$aTemplateData['passwordtitle'] = Context::DB()->result[0]['text4'];
//			$aTemplateData['submittitle'] = Context::DB()->result[0]['text5'];
//			$aTemplateData['passwordsize'] = Context::DB()->result[0]['number1'];
//			$aTemplateData['loginsize'] = Context::DB()->result[0]['number2'];
//			$aTemplateData['shortDescription'] = addslashes(Context::DB()->result[0]['shortDescription']);
//		}
//		$aTemplateData['ajaxHandler'] = AJAX_HANDLER;
//		$aTemplateData['response'] = true;
//		return $aTemplateData;
//	}


    public function SignIn()
    {
        if(!is_null(Request::getString('login','POST')))
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
                    $errors[0]['value'] = WebText::getText("user_login_data_not_valid_not_email","Даний емейл не зареєстрований. Будь-ласка зареєструйтеся.");
                    $errors[0]['field'] = 'email';
                }
                elseif($user->isEmailNoConfirm($userData['email']['value']))
                {
                    $errors[0]['value'] = WebText::getText("user_login_data_user_not_active","Даний акаунт не активовано. Будь-ласка, перейдіть за посилання у листі підтвердження реєстрації для активації Вашого акаунта.");
                    $errors[0]['field'] = 'email';
                }
                else
                {
                    $errors[0]['value'] = WebText::getText("user_login_data_not_valid_pass","Ви ввели невірний пароль");
                    $errors[0]['field'] = 'email';
                    $remindPasswd = true;
                }

                $this->pageObjectData['loginEmail'] = $userData['email']['value'];
                $this->pageObjectData['validationErrors'] = json_encode($errors);
                $this->pageObjectData['remindPasswd'] = $remindPasswd;
                return false;
            }
        }
    }

    public function createUser()
    {
        $response['success'] = true;
        $response['validationErrors'] = array();
        $user = CMSUser::getInstance();

        if(!$user->createUser(ReservedRequestData::userRegistration()))
        {
            for($i=0; $i<=count($user->validationErrors)-1;$i++)
            {
                $response['validationErrors'][$i]['value'] = $user->validationErrors[$i]['value'];
                $response['validationErrors'][$i]['field'] = $user->validationErrors[$i]['field'];
            }
            $response['success'] = false;
        }
        $userData = ReservedRequestData::userRegistration();
        $user->login($userData['email']['value'],$userData['password']['value']);
        return $response;
    }

    public function changeProfileUser()
    {
        $response['success'] = true;
        $response['validationErrors'] = array();
        $user = CMSUser::getInstance();
        if(!$user->changeUser(ReservedRequestData::user()))
        {
            for($i=0; $i<=count($user->validationErrors)-1;$i++)
            {
                $response['validationErrors'][$i]['value'] = $user->validationErrors[$i]['value'];
                $response['validationErrors'][$i]['field'] = $user->validationErrors[$i]['field'];
            }
            $response['success'] = false;
        }
        return $response;
    }

    public function remindPassword()
    {
        $email = request::getString("email","POST",true);

        //check if user exist
        if(CMSUser::isEmailNotUsed($email)){
            $this->templateData['errorMessage'] = $this->templateData['text1'];
            return;
        }

        //generate and save new password
        $newPsw = CMSUser::generateNewPsw($email);
        require_once(FRAMEWORK_PATH."system/MailBus.php");


        //retrieve user info & send email
        $user = CMSUser::getInstance();
        $userInfo = $user->getUserInfo(0, $email);

        $confirmLink = CMSUser::getConfirmationLink($userInfo['guid'], $userInfo['id'], md5($newPsw));

        EventManager::Execute(new UserNewPasswordEvent($userInfo['id']),
            array("{USER_NEW_PASSWORD}" => $newPsw,
                  "{USER_CONFIRMATION_LINK}" => $confirmLink));

        return array('success' => true);
    }
}
