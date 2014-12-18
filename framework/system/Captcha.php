<?php

class Captcha
{
    static function GetCaptchaHtml()
    {
        $captchaUrl = SITE_PROTOCOL . Context::SiteSettings()->getSiteUrl() .'/framework/system/captcha/captcha.php?' . date("h:i:s");
        return "<img src='$captchaUrl' id='captcha' />";
    }

    static function IsValid($captchaText)
    {
        return !empty($captchaText)
            ? !empty($_SESSION['captcha']) && $captchaText == $_SESSION['captcha']
            : false;
    }
}