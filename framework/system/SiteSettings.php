<?php
require_once(FRAMEWORK_PATH."system/helper/LinkManager.php");

class SiteSettings
{
    static private $instance = NULL;
    static private $siteSettings = array();

    private static $siteUrl;

    static function getInstance()
    {
        if (self::$instance == NULL)
        {
            self::$instance = new SiteSettings();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $res = null;
        if(isset($_SESSION["BACKEND_SITE_ID"]) && strpos($_SERVER['REQUEST_URI'], 'backend')!==false)
        {
            $q = "SELECT url FROM be_WebSites WHERE id = '" . $_SESSION["BACKEND_SITE_ID"] . "' LIMIT 1";
            Context::DB()->query($q);
            $res = Context::DB()->result[0];
        }
        //self::$siteUrl = $res == null ? DEFAULT_SITE_URL : $res['url'];
        self::$siteUrl = $res == null ? ( defined("DEFAULT_SITE_URL_FROM_DB") ? DEFAULT_SITE_URL_FROM_DB : SITE_URL ) : $res['url'];
        require_once(FRAMEWORK_PATH."system/cache/CacheFace.php");
        $cache = new CacheFace(true);
        if($cacheData = $cache->get('siteSettings_' . str_replace("/", "", self::$siteUrl)))
        {
            self::$siteSettings = unserialize($cacheData);
        }
        else
        {
            try{
                self::$siteSettings = self::getSettingsFromDB();
            }
            catch(CMSException $e){
                $e->terminateApplication();
            }
            $cache->save(serialize(self::$siteSettings));
        }
    }

    private function __clone(){}

    public static function getSettingsFromDB()
    {
        $query = "SELECT * FROM be_WebSites WHERE URL = '" . self::$siteUrl . "' LIMIT 1";
        if(!Context::DB()->query($query)){
            include_once(FRAMEWORK_PATH."system/CMSException.php");
            throw new CMSException("There are no settings for this site. Site should be configured first.");
        }
        return Context::DB()->result[0];
    }

    public static function getSiteName()
    {
        return (defined("SITE_NAME")) ? SITE_NAME : self::$siteSettings['name'];
    }

    public static function getSiteUrl()
    {
        return (defined("SITE_URL")) ? SITE_URL : self::$siteSettings['URL'];
    }

    public static function getSiteId()
    {
        return (defined("SITE_ID")) ? SITE_ID : self::$siteSettings['id'];
    }

    public static function getSiteIdByCountryId($countryId)
    {
        $query = "SELECT id FROM be_WebSites WHERE countryId = " . $countryId . " LIMIT 1";
        if(!Context::DB()->query($query)){
            return 0;
        }
        return Context::DB()->result[0]['id'];
    }

    public static function getDefaultPageParams()
    {
        $languageObj = Languages::getInstance();
        $language = $languageObj->GetLanguageByCode($languageObj->DefaultLanguageCode());
        $params = LinkManager::GetUrlParameters($language['url'], true);

        return $params;
    }

    public static function getDefaultSiteEmail()
    {
        return (defined("DEFAULT_SITE_MAIL")) ? DEFAULT_SITE_MAIL : self::$siteSettings['email'];
    }

/*    public static function getSiteEmailTo()
    {
        return (defined("SITE_MAIL_TO")) ? SITE_MAIL_TO : self::$siteSettings['emailTo'];
    }
*/
    public static function multiLanguage()
    {
        return (defined("MULTI_LANGUAGE")) ? MULTI_LANGUAGE : self::$siteSettings['multiLanguage'];
    }

    public static function useCache()
    {
        return (defined("USE_CACHE")) ? USE_CACHE : self::$siteSettings['useCache'];
    }

    public static function useSMTP()
    {
        return (defined("USE_SMTP")) ? USE_SMTP : self::$siteSettings['useSMTP'];
    }

    public static function getSMTPSettings()
    {
        $SMTPSettings['SMTPServer'] = (defined("SMTP_SERVER")) ? SMTP_SERVER : self::$siteSettings['SMTPServer'];
        $SMTPSettings['SMTPUser'] = (defined("SMTP_USER")) ? SMTP_USER : self::$siteSettings['SMTPUser'];
        $SMTPSettings['SMTPPassword'] = (defined("SMTP_PASSWORD")) ? SMTP_PASSWORD : self::$siteSettings['SMTPPassword'];

        $SMTPSettings['SMTP_PORT'] = SMTP_PORT;
        $SMTPSettings['SMTP_AUTH'] = SMTP_AUTH;

        return $SMTPSettings;
    }

    public static function getDefaultAvatarImage()
    {
        return (defined("DEFAULT_AVATAR_IMAGE")) ? DEFAULT_AVATAR_IMAGE : appUrl::CMSConstantsToValues(self::$siteSettings['defaultAvatarImage']);
    }

    public static function getSiteIdFromSession()
    {
        return isset($_SESSION["BACKEND_SITE_ID"]) ? $_SESSION["BACKEND_SITE_ID"] : self::getSiteId();
    }

    public static function setSiteIdFromSession($websiteId)
    {
        return $_SESSION["BACKEND_SITE_ID"] = $websiteId;
    }

    public static function getUsersAgreementPageUrl()
    {
        return (defined("USER_AGREEMENT_PAGE_URL")) ? USER_AGREEMENT_PAGE_URL : appUrl::checkUrl(self::$siteSettings['usersAgreementPageUrl']);
    }

    public static function getSiteRulesPageUrl()
    {
        return (defined("SITE_RULES_PAGE_URL")) ? SITE_RULES_PAGE_URL : appUrl::checkUrl(self::$siteSettings['siteRulesPageUrl']);
    }

    public static function getDateFormat()
    {
        return (defined("DATE_FORMAT")) ? DATE_FORMAT : self::$siteSettings['dateFormat'];
    }

    public static function getUseTwelveHour()
    {
        return (defined("USE_TWELVE_HOUR")) ? USE_TWELVE_HOUR : self::$siteSettings['useTwelveHour'];
    }

    public static function useImageProcessing()
    {
        return (defined("USE_IMAGE_PROCESSING")) ? USE_IMAGE_PROCESSING : self::$siteSettings['useImageProcessing'];
    }

    public static function useWaterMarks()
    {
        return (defined("USE_WATER_MARKS")) ? USE_WATER_MARKS : self::$siteSettings['useWaterMarks'];
    }

    public static function isGag()
    {
        return (defined("IS_GAG")) ? IS_GAG : self::$siteSettings['isGag'];
    }

    public static function getGagHtml()
    {
        return (defined("GAG_HTML")) ? GAG_HTML : self::$siteSettings['gagHtml'];
    }

    public static function getGagTitle()
    {
        return (defined("GAG_TITLE")) ? GAG_TITLE : self::$siteSettings['gagTitle'];
    }

    public static function getGagIPs()
    {
        return (defined("GAG_IPS")) ? GAG_IPS : self::$siteSettings['gagIPs'];
    }
}