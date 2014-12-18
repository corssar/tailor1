<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."system/Context.php");
require_once(FRAMEWORK_PATH."system/WebText.php");
require_once(FRAMEWORK_PATH."system/ReservedRequestData.php");
class FormValidationRulesController
{
    public function setFormRules()
    {
        if(Context::SiteSettings()->multiLanguage() && isset($_SERVER['HTTP_REFERER']))
        {
            $urlPos = strpos($_SERVER['HTTP_REFERER'], Context::SiteSettings()->getSiteUrl());
            $url = substr($_SERVER['HTTP_REFERER'], $urlPos + strlen(Context::SiteSettings()->getSiteUrl()));
            $matches	=	explode("/",$url);
            if(isset($matches[1]) && strlen($matches[1])>0 && strlen($matches[1])<4)
                Context::SpecifyLang($matches[1]);
        }

    	$html = '';
    	$html.=	'	(function($) {
						$.fn.validationEngineLanguage = function() {};
						$.validationEngineLanguage = {
							newLang: function() {
								$.validationEngineLanguage.allRules = 	{';
    	
		$html.='					"required":{
										"regex":"none",
										"alertText":"* '.WebText::getText('RequiredFieldIsEmpty','���� �������� ������������', true).'",
										"alertTextCheckboxMultiple":"* '.WebText::getText('RequiredCheckboxMultipleSelect','�� ������ ������� ������', true).'",
										"alertTextCheckboxe":"* '.WebText::getText('RequiredCheckboxSelect','��������� �������', true).'"
									},';
        $html.='					"equals":{
										"regex":"none",
										"alertText":"* '.WebText::getText('EqualsAlertText','�������� ������������� ������', true).'"
									},';
    	$html.='					"length":{
										"regex":"none",
										"alertText":"* '.WebText::getText('RequiredBetween','������� ���� ��', true).' ",
										"alertText2":"* '.WebText::getText('RequiredTo','��', true).' ",
										"alertText3":"* '.WebText::getText('RequiredSymbols','�������', true).' "
									},';
    	$html.='					"maxCheckbox":{
										"regex":"none",
										"alertText":"* '.WebText::getText('RequiredChecksAllowedExceeded','��������� ������� ������ �������', true).' "
									},';
    	$html.='					"minCheckbox":{
										"regex":"none",
										"alertText":"* '.WebText::getText('RequiredPleaseSelect','���� �����, �������', true).' ",
										"alertText2":"* '.WebText::getText('RequiredOptions','�����', true).' "
									},';
    	$html.='					"confirm":{
										"regex":"none",
										"alertText":"* '.WebText::getText('RequiredFieldsIsNotMatching','�������� �� ����������', true).' "
									},';
    	$html.='					"date":{
										"regex":"/^[0-9]{4}\-\[0-9]{1,2}\-\[0-9]{1,2}$/",
										"alertText":"* '.WebText::getText('RequiredInvalidDateFormat','����������� ����, ������� ���� � ����-MM-�� ������', true).' "
									},';
    	$html.='					"onlyNumber":{
										"regex":"/^[0-9\ ]+$/",
										"alertText":"* '.WebText::getText('RequiredNumbersOnly','ҳ���� �����', true).' "
									},';
    	$html.='					"noSpecialCaracters":{
										"regex":"/^[0-9a-zA-Z]+$/",
										"alertText":"* '.WebText::getText('RequiredNoSpecialCaracters','��������� ��������� �������', true).' "
									},';
    	$html.='					"ajaxUser":{
										"url":"validateUser.php",
										"extraData":"name=eric",
										"alertTextOk":"* '.WebText::getText('RequiredUserIsAvailable','����� ���������� ���������', true).' ",
										"alertTextLoad":"* '.WebText::getText('RequiredLoading','������������, �������', true).' ",
										"alertText":"* '.WebText::getText('RequiredUserIsAlreadyTaken','����� ���������� ��� ��������', true).' "
    								},';
    	$html.='					"ajaxName":{
										"url":"'.SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().'/frontend/handlers/ajaxValidateRegistrationFields.php",
										"extraData":"validateLogin",
										"alertText":"* '.WebText::getText('RequiredNameIsAlreadyTaken','�� ��`� ��� �������', true).' ",
										"alertTextOk":"* '.WebText::getText('RequiredNameIsAvailable','�� ��`� �����', true).' ",
										"alertTextLoad":"* '.WebText::getText('RequiredLoading','������������, �������', true).' "
    								},';
        $html.='					"ajaxEmail":{
										"url":"'.SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().'/frontend/handlers/ajaxValidateRegistrationFields.php",
										"extraData":"validateEmail",
										"alertText":"* '.WebText::getText('RequiredEmailIsAlreadyTaken','����� email ��� ��������', true).' ",
										"alertTextOk":"* '.WebText::getText('RequiredEmailIsAvailable','����� email ������', true).' ",
										"alertTextLoad":"* '.WebText::getText('RequiredLoading','������������, �������', true).' "
    								},';
    	$html.='					"onlyLetter":{
										"regex":"/^[a-zA-Z\ \']+$/",
										"alertText":"* '.WebText::getText('RequiredLettersOnly','ҳ���� �����', true).' "
									},';
    	$html.='					"validate2fields":{
				    					"nname":"validate2fields",
				    					"alertText":"* '.WebText::getText('RequiredFirstnameLastname','�� ������ ��������� ���� � ������ �� ��������', true).' "
    								},';
    	$html.='					"phoneNumberFormat":{
										"regex":'.ReservedRequestData::fieldsRulesRegExContent('phoneNumberFormat').',
										"alertText":"* '.WebText::getText('ValidationContactFormPhoneNumberFormat','������� ������ ��������', true).' "
									},';
    	$html.='					"emailFormat":{
										"regex":'.ReservedRequestData::fieldsRulesRegExContent('emailFormat').',
										"alertText":"* '.WebText::getText('ValidationContactFormEmailFormat','�������� ������ email', true).' "
									},';
        $html.='					"urlFormat":{
										"regex":'.ReservedRequestData::fieldsRulesRegExContent('urlFormat').',
										"alertText":"* '.WebText::getText('ValidationContactFormURLFormat','������� ������ URL', true).' "
									}';

    	$html.=	'				}
							}
						}
					})(jQuery);';

    	$html.=	'	$(document).ready(function() {	
						$.validationEngineLanguage.newLang()
					});';
    	return $html;
    }

}

$FormValidationRulesController	=	new FormValidationRulesController();

	echo $FormValidationRulesController->setFormRules();
?>