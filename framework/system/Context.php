<?php
	require_once(FRAMEWORK_PATH."system/Languages.php");
	require_once(FRAMEWORK_PATH."system/Request.php");
	class Context
	{
		private static $langId = null;
		private static $langCode = null;
		private static $langMetaTag = null;
		private static $appMasterPage = null;
		private static $db = null;
		private static $log = null;
		private static $pageId = null;
		private static $pageCode = null;
		private static $pageClass = null;
        private static $siteSettings = null;

		public static function DB()
		{
			if(self::$db === null)
			{
                include_once(FRAMEWORK_PATH."system/MySqlIDb.php");
				self::$db = new MySqlIDb();
			}
			return self::$db;
		}

		public static function Log($type = false, $fileName = "sitelog")
		{
            $key = $type . "_" . $fileName;
            if(!isset(self::$log[$key]))
            {	//Code for logging
                include_once(SITE_PATH.'vendors/Pear/Log.php');
                if($type)
                {
                    self::$log[$key] = &Log::singleton('file', SITE_PATH.'logs/'. $fileName .'.log');
                }
                else
                {
                    self::$log[$key] = &Log::singleton('cmssql', 'be_Log');
                }
            }
            return self::$log[$key];
		}
		/* Languaguage section*/
		public static function LanguageId()
		{
			if(self::$langId === null){
				$Languages = Languages::getInstance();
				self::$langId = $Languages->GetLangIdByCode(self::LanguageCode());
			}
			return self::$langId;
		}
		static function LanguageCode()
		{
			if(self::$langCode === null){
				self::SpecifyLang();
			}
			return self::$langCode;
		}
		public static function SpecifyLang($param=null)
		{
			$Languages = Languages::getInstance();
			if($param !== null)
			{
				self::$langCode = $param;
			}
			elseif(Request::getString("lang", "GET")!==null)
			{
				if(!$Languages->CheckIfLangCodeAvailable(Request::getString("lang", "GET"))){
					self::SpecifyLang($Languages->DefaultLanguageCode());
					throw new PageNotFoundException("Page Not Found. Requested Lang code not found in Available. Requested code: ".Request::getString("lang", "GET"));
				}

				self::$langCode=Request::getString("lang", "GET");
			}
			else
			{
				self::$langCode = $Languages->DefaultLanguageCode();
			}
		}
        static function LanguageMetaTag()
        {
            if(self::$langMetaTag === null){
                $Languages = &Languages::getInstance();
                self::$langMetaTag = $Languages->GetMetaTagByCode(self::LanguageCode());
            }
            return self::$langMetaTag;
        }

        public static function SiteSettings()
        {
            if(self::$siteSettings === null)
            {
                include_once(FRAMEWORK_PATH."system/SiteSettings.php");
                self::$siteSettings = SiteSettings::getInstance();
            }
            return self::$siteSettings;
        }

		static function AppMasterPageId()
		{//function check and return AppMasterPageId for current request
			if(self::$appMasterPage === null)
			{
				if(!Context::SiteSettings()->multiLanguage()){
					self::$appMasterPage = APPLICATION_MASTER_PAGE_ID;
				}
				else{
					$Languages = &Languages::getInstance();
					self::$appMasterPage = $Languages->GetMPidByCode(self::LanguageCode());
				}
			}
			return (int)self::$appMasterPage;
		}
		static function PageId($pageId=null)
		{
			if($pageId !== null){
				self::$pageId= $pageId;
			}
			else{
				return self::$pageId;
			}
		}
		static function PageCode($pageCode=null)
		{
			if($pageCode !== null){
				self::$pageCode = $pageCode;
			}
			else{
				return self::$pageCode;
			}
		}
		static function PageClass($pageClass=null)
		{
			if($pageClass !== null){
				self::$pageClass = $pageClass;
			}
			else{
				return self::$pageClass;
			}
		}
        static function getCurrentPageClassName(){
            return basename($_SERVER['SCRIPT_NAME'], '.php');
        }
	}