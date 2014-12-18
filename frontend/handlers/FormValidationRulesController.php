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
										"alertText":"* '.WebText::getText('RequiredFieldIsEmpty','Поле является обязательным', true).'",
										"alertTextCheckboxMultiple":"* '.WebText::getText('RequiredCheckboxMultipleSelect','Ви повинні вибрати варіант', true).'",
										"alertTextCheckboxe":"* '.WebText::getText('RequiredCheckboxSelect','Необхідно відмітити', true).'"
									},';
        $html.='					"equals":{
										"regex":"none",
										"alertText":"* '.WebText::getText('EqualsAlertText','Неверное подтверждение пароля', true).'"
									},';
    	$html.='					"length":{
										"regex":"none",
										"alertText":"* '.WebText::getText('RequiredBetween','Повинно бути від', true).' ",
										"alertText2":"* '.WebText::getText('RequiredTo','до', true).' ",
										"alertText3":"* '.WebText::getText('RequiredSymbols','символів', true).' "
									},';
    	$html.='					"maxCheckbox":{
										"regex":"none",
										"alertText":"* '.WebText::getText('RequiredChecksAllowedExceeded','Неможливо вибрати стільки варіантів', true).' "
									},';
    	$html.='					"minCheckbox":{
										"regex":"none",
										"alertText":"* '.WebText::getText('RequiredPleaseSelect','Будь ласка, виберіть', true).' ",
										"alertText2":"* '.WebText::getText('RequiredOptions','опції', true).' "
									},';
    	$html.='					"confirm":{
										"regex":"none",
										"alertText":"* '.WebText::getText('RequiredFieldsIsNotMatching','Значення не співпадають', true).' "
									},';
    	$html.='					"date":{
										"regex":"/^[0-9]{4}\-\[0-9]{1,2}\-\[0-9]{1,2}$/",
										"alertText":"* '.WebText::getText('RequiredInvalidDateFormat','Неправильна дата, повинна бути у ГГГГ-MM-ДД форматі', true).' "
									},';
    	$html.='					"onlyNumber":{
										"regex":"/^[0-9\ ]+$/",
										"alertText":"* '.WebText::getText('RequiredNumbersOnly','Тільки числа', true).' "
									},';
    	$html.='					"noSpecialCaracters":{
										"regex":"/^[0-9a-zA-Z]+$/",
										"alertText":"* '.WebText::getText('RequiredNoSpecialCaracters','Заборонені спеціальні символи', true).' "
									},';
    	$html.='					"ajaxUser":{
										"url":"validateUser.php",
										"extraData":"name=eric",
										"alertTextOk":"* '.WebText::getText('RequiredUserIsAvailable','Даний користувач доступний', true).' ",
										"alertTextLoad":"* '.WebText::getText('RequiredLoading','Завантаження, чекайте', true).' ",
										"alertText":"* '.WebText::getText('RequiredUserIsAlreadyTaken','Даний користувач вже зайнятий', true).' "
    								},';
    	$html.='					"ajaxName":{
										"url":"'.SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().'/frontend/handlers/ajaxValidateRegistrationFields.php",
										"extraData":"validateLogin",
										"alertText":"* '.WebText::getText('RequiredNameIsAlreadyTaken','Це ім`я вже зайняте', true).' ",
										"alertTextOk":"* '.WebText::getText('RequiredNameIsAvailable','Це ім`я вільне', true).' ",
										"alertTextLoad":"* '.WebText::getText('RequiredLoading','Завантаження, чекайте', true).' "
    								},';
        $html.='					"ajaxEmail":{
										"url":"'.SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().'/frontend/handlers/ajaxValidateRegistrationFields.php",
										"extraData":"validateEmail",
										"alertText":"* '.WebText::getText('RequiredEmailIsAlreadyTaken','Даний email вже зайнятий', true).' ",
										"alertTextOk":"* '.WebText::getText('RequiredEmailIsAvailable','Даний email вільний', true).' ",
										"alertTextLoad":"* '.WebText::getText('RequiredLoading','Завантаження, чекайте', true).' "
    								},';
    	$html.='					"onlyLetter":{
										"regex":"/^[a-zA-Z\ \']+$/",
										"alertText":"* '.WebText::getText('RequiredLettersOnly','Тільки літери', true).' "
									},';
    	$html.='					"validate2fields":{
				    					"nname":"validate2fields",
				    					"alertText":"* '.WebText::getText('RequiredFirstnameLastname','Ви повинні заповнити поля з іменем та прізвищем', true).' "
    								},';
    	$html.='					"phoneNumberFormat":{
										"regex":'.ReservedRequestData::fieldsRulesRegExContent('phoneNumberFormat').',
										"alertText":"* '.WebText::getText('ValidationContactFormPhoneNumberFormat','Невірний формат телефону', true).' "
									},';
    	$html.='					"emailFormat":{
										"regex":'.ReservedRequestData::fieldsRulesRegExContent('emailFormat').',
										"alertText":"* '.WebText::getText('ValidationContactFormEmailFormat','Неверный формат email', true).' "
									},';
        $html.='					"urlFormat":{
										"regex":'.ReservedRequestData::fieldsRulesRegExContent('urlFormat').',
										"alertText":"* '.WebText::getText('ValidationContactFormURLFormat','Невірний формат URL', true).' "
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