<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."system/Context.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
class ValidateRegistrationFields
{
    function validateLogin()
    {
        $response = array();
        $validateValue=$_GET['fieldValue'];
        $validateId=$_GET['fieldId'];
        $response[0] = $validateId;
        $user = new CMSUser();
        $response[1] = $user->isLoginUnique($validateValue);
        return $response;
    }

    function validateEmail()
    {
        $response = array();
        $validateValue=$_GET['fieldValue'];
        $validateId=$_GET['fieldId'];
        $response[0] = $validateId;
        $user = new CMSUser();
        $response[1] = $user->isEmailNotUsed($validateValue);
        return $response;
    }

}
$validateRegistrationFields = new ValidateRegistrationFields();

switch ($_REQUEST['extraData'])
{
    case 'validateLogin' 		: echo json_encode($validateRegistrationFields->validateLogin()); break;
    case 'validateEmail' 		: echo json_encode($validateRegistrationFields->validateEmail()); break;
}
?>