<?php
class Validation
{
	static public function validate($data_model, &$errors)
	{
		$result = true;
		foreach ($data_model as $field => $fieldModel)
		{
			if(isset($fieldModel['required']))
			{
				if($fieldModel['required']===true)
				{
					if(!self::checkRequiredField($field, $fieldModel, $errorMsg))
					{//echo $field.'-'.$fieldModel['value'].'<br>';
						if(is_array($errors))
							array_push($errors, array('field'=>$field, 'value'=>$errorMsg));
						$result=false;
					}

					//if($fieldModel['rule']!=null && strlen($fieldModel['rule'])>0)
					if(is_array($fieldModel['rule']) && count($fieldModel['rule'])>0)
					{//check rule for optional fields
                        foreach ($fieldModel['rule'] as $rule)
                        {
                            if(method_exists('Validation',$rule))
                            {
                                if(!self::$rule($field, $fieldModel['value'], $rule, $errorMsg))
                                {
                                    if(is_array($errors))
                                        array_push($errors, array('field'=>$field, 'value'=>$errorMsg));
                                    $result=false;
                                }
                            }
                        }
					}
				}
				elseif($fieldModel['required']===false)
				{
					if(!empty($fieldModel['value']) && is_array($fieldModel['rule']) && count($fieldModel['rule'])>0)
					{//check rule for optional fields
                        foreach ($fieldModel['rule'] as $rule)
                        {
                            if(method_exists('Validation',$rule))
                            {
                                if(!self::$rule($field, $fieldModel['value'], $rule, $errorMsg))
                                {
                                    if(is_array($errors))
                                        array_push($errors, array('field'=>$field, 'value'=>$errorMsg));
                                    $result=false;
                                }
                            }
                        }
					}
				}
			}
		}
		return $result;
	}

	//validation functions
	static private function checkRequiredField($field, $fieldModel, &$errorMsg)
	{
		if(empty($fieldModel['value']))
		{//echo $field.'-'.$fieldModel['value'].'!!!<br>';
			$errorMsg = WebText::getText('RequiredFieldIsEmpty','Поле є обов`язковим для заповнення', true);
			return false;
		}
		return true;
	}
	//validation functions from rule attribute
	static private function userEmailUnique($field, $value, $rule, &$errorMsg)
	{
		$query = "SELECT email FROM `fe_Users` WHERE email='{$value}'";
		if (Context::DB()->query($query) and count(Context::DB()->result)>0)
		{
			$errorMsg = WebText::getText('RequiredEmailIsAlreadyTaken','Данный email уже занят', true);
			return false;
		}
		return true;
	}

    static private function userLoginNameUnique($field, $value, $rule, &$errorMsg)
    {
        $query = "SELECT loginName FROM `fe_Users` WHERE loginName='{$value}'";
        if (Context::DB()->query($query) and count(Context::DB()->result)>0)
        {
            $errorMsg = WebText::getText('RequiredNameIsAlreadyTaken','Це ім`я вже зайняте', true);
            return false;
        }
        return true;
    }

	static private function emailFormat($field, $value, $rule, &$errorMsg)
	{
		$ret=	false;
		$regex	=	ReservedRequestData::fieldsRulesRegExContent($rule);
		if($regex && preg_match($regex, $value))
			$ret	=	true;
		else
			$errorMsg = WebText::getText('ValidationContactFormEmailFormat','Невірний формат email', true);
		return $ret;
	}
    static private function passwordEquals($field, $value, $rule, &$errorMsg)
    {
        $ret    =	false;

        if($value == request::getString('regPassword', 'POST', false) || $value == request::getString('regPasswordConfirm', 'POST', false))
            $ret	=	true;
        else
            $errorMsg = WebText::getText('EqualsAlertText','Не верное подтверждение пароля', true);
        return $ret;
    }

	static private function phoneNumberFormat($field, $value, $rule, &$errorMsg)
	{
		$ret=	false;
		$regex	=	ReservedRequestData::fieldsRulesRegExContent($rule);
		if($regex && preg_match($regex, $value))
			$ret	=	true;
		else
			$errorMsg = WebText::getText('ValidationContactFormPhoneNumberFormat','Невірний формат номеру', true);
		return $ret;
	}
    static private function urlFormat($field, $value, $rule, &$errorMsg)
    {
        $ret=	false;
        $regex	=	ReservedRequestData::fieldsRulesRegExContent($rule);
        if($regex && preg_match($regex, $value))
            $ret	=	true;
        else
            $errorMsg = WebText::getText('ValidationContactFormURLFormat','Невірний формат URL', true);
        return $ret;
    }

	//functions for captcha generation and validation
	static public function generateCaptchaHTML()
    {//auto captcha
		return ' <input type="text" name="autocaptcha" id="autocaptcha" value="" style="display:none;"/>
				 <input type="text" name="robocaptcha" id="robocaptcha" value="" style="display:none;"/>';
    }
    /**
     * implementation of captcha validation
     * @param bool
     * @return bool
     */
    static public function isCaptchaValid($useCaptcha=false)
    {
    	if($useCaptcha){
    		$resp = recaptcha_check_answer (RECAPTCHA_PRIVATE_KEY, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
			return $resp->is_valid;
    	}
    	else{
    		return strlen(Request::getString('autocaptcha'))>0 && strlen(Request::getString('robocaptcha'))==0;
    	}
    }
}
?>