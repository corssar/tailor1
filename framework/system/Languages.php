<?php

class Languages
{
	private $langList = null;
	private $defaultCode = null;

	private static $instance = null;	
	static function getInstance()
	{
        include_once(FRAMEWORK_PATH."system/cache/CacheFace.php");
		if (self::$instance === null) {
            $cache = new CacheFace();
            if($cacheData = $cache->get('languageObject_'.Context::SiteSettings()->getSiteId()))
                self::$instance = unserialize($cacheData);
            else{
                self::$instance = new Languages();
                $cache->save(serialize(self::$instance));
            }
		}
		return self::$instance;
	}
    private function __construct()
    {
        $query = "  SELECT be_Languages.*, be_WebsiteLanguages.masterPageId, be_WebsiteLanguages.defaultUrl, be_WebsiteLanguages.defaultLang FROM be_Languages
                    INNER JOIN be_WebsiteLanguages
                      ON be_WebsiteLanguages.langId = be_Languages.id
                    WHERE be_WebsiteLanguages.websiteId = ".Context::SiteSettings()->getSiteId()."
                    ORDER BY be_Languages.id";

        if (!Context::DB()->query($query))
            throw new CMSException("Cannot get list of languages");

        include_once(FRAMEWORK_PATH."system/appUrl.php");
        $listData = Context::DB()->result;
        $this->DefaultLanguageCode($listData);
        for($i=0;$i<count($listData);$i++)
        {
            $this->langList[$listData[$i]['code']]['id'] = $listData[$i]['id'];
            $this->langList[$listData[$i]['code']]['name'] = $listData[$i]['name'];
            $this->langList[$listData[$i]['code']]['code'] = $listData[$i]['code'];
            $this->langList[$listData[$i]['code']]['masterpageid']=$listData[$i]['masterPageId'];
            $this->langList[$listData[$i]['code']]['metatag']=$listData[$i]['metatag'];
            $this->langList[$listData[$i]['code']]['active']	=$listData[$i]['active'];
            $this->langList[$listData[$i]['code']]['langImage']	=$listData[$i]['langImage'];
            //build URL to default page
            $this->langList[$listData[$i]['code']]['url'] = $listData[$i]['defaultUrl'];
            if($this->DefaultLanguageCode() == $listData[$i]['code']){
                $this->langList[$listData[$i]['code']]['default'] = true;
            }
            else{
                $this->langList[$listData[$i]['code']]['default'] = false;
            }
        }
    }

	public function GetAppLanguages(){

		return $this->langList;
	}
	public function GetActiveLanguages()
	{
		return array_filter($this->GetAppLanguages(), "Languages::IsLangActive");
	}
    static function IsLangActive($langElement)
    {
        return $langElement['active'];
    }

    static function GetAllLanguages()
    {
        $query =    "SELECT * FROM be_Languages
                    ORDER BY id";

        Context::DB()->query($query);

        return Context::DB()->result;
    }
	
	public function GetAppLanguage($langCode)
	{
		$languages = $this->GetAppLanguages();
		return $languages[$langCode];
	}
	
	public function DefaultLanguageCode($languages = null)
	{
		if (is_null($languages))
			return $this->defaultCode;

        include_once(FRAMEWORK_PATH."system/helper/ArrayManager.php");
        if(($key = ArrayManager::subarray_search(array("defaultLang"=>'2'), $languages)) === false)
            throw new CMSException("Website do not have default language. Please configure it.");

        $this->defaultCode = $languages[$key]['code'];
        return $this->defaultCode;
	}

	public function GetMPidByCode($langCode)
	{
		if(!(int)$this->langList[$langCode]["masterpageid"])
			Context::Log()->Log("Master page are not specified for defined Language.Return default MP id. LangCode: $langCode;MP: {$this->langList[$langCode]["masterpageid"]}. Class Languages->GetMPidByCode()");
		$languages = $this->GetAppLanguages();	
		return (int)$languages[$langCode]["masterpageid"];
	}
	public function GetLangIdByCode($langCode)
	{
		if(!$this->CheckIfLangCodeAvailable($langCode))
			Context::Log()->Log("Language code do not exist in Languages list for specifing Lang Id. Error LangCode: $langCode. Class Languages->GetLangIdByCode()");
		$languages = $this->GetAppLanguages();
		return (int)$languages[$langCode]["id"];
	}
	public function GetMetaTagByCode($langCode)
	{
		if(!$this->CheckIfLangCodeAvailable($langCode))
			Context::Log()->Log("Language code do not exist in Languages list. Error LangCode: $langCode.");
		$languages = $this->GetAppLanguages();
		return $languages[$langCode]["metatag"];
	}
    public function GetLanguageByCode($langCode)
    {
        if(!$this->CheckIfLangCodeAvailable($langCode))
            Context::Log()->Log("Language code do not exist in Languages list. Error LangCode: $langCode.");
        $languages = $this->GetAppLanguages();
        return $languages[$langCode];
    }

	public function CheckIfLangCodeAvailable($langCode)
	{
        return array_key_exists($langCode, $this->langList);
	}

    public function GetCodeById($langId)
    {

        include_once(FRAMEWORK_PATH."system/helper/ArrayManager.php");

        $langList = $this->GetAllLanguages();
        if(($key = ArrayManager::subarray_search(array("id"=>$langId), $langList)) === false)
            throw new CMSException("Website do not have language with id =$langId");

        return $langList[$key]['code'];
    }
}
?>