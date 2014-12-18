<?php
class appUrl
{
    public static function getUrl($pageId, $className, $pagecode=null, $langCode=null)
    {
    	$additionalParam='';
    	if(Context::SiteSettings()->multiLanguage())
    	{
    		$additionalParam = '&lang='.($langCode!=null?$langCode:Context::LanguageCode());
    	}
    	if($pagecode!=null){
        	$url=SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().PAGES_PATH.$className.'?pagecode='.$pagecode.$additionalParam;
        	return appUrl::getUrlByCode($pagecode, $className, $langCode);
    	}    	
        $url=SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().PAGES_PATH.$className.'?id='.$pageId.$additionalParam;
        return appUrl::rewriteUrl($url);
    }
    public static function getUrlByCode($pagecode, $className, $langCode=null)
    {
    	$additionalParam='';
    	if(Context::SiteSettings()->multiLanguage())
    	{     	
    		$additionalParam = '&lang='.($langCode!=null?$langCode:Context::LanguageCode());
    	}
    	$url=SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().PAGES_PATH.$className.'?pagecode='.$pagecode.$additionalParam;
    	return appUrl::rewriteUrl($url);
    }
    public static function checkUrl($url)
    {
        $url=appUrl::CMSConstantsToValues($url);
        return appUrl::rewriteUrl($url);
    }

    public static function rewriteUrl($url)
    {
        if(USE_REWRITE)
        {
        	if(strpos($url, Context::SiteSettings()->getSiteUrl().PAGES_PATH)!=false)
        	{
        		if(Context::SiteSettings()->multiLanguage())
        		{
					$defaultCode = Context::LanguageCode();
					
					$patterns[0] = "/\/frontend\/pages\/(.+)\.php\?pagecode=([a-z_\-\d]+)&lang=(.+)/";
					$patterns[1] = "/\/frontend\/pages\/(.+)\.php\?pagecode=([a-z_\-\d]+)/";
	        		$patterns[2] = "/\/frontend\/pages\/(.+)\.php\?id=(\d+)&lang=(.+)/";
					$patterns[3] = "/\/frontend\/pages\/(.+)\.php\?id=(\d+)/";
					$patterns[4] = "/htm&/";//html will be arter firsts replacements
					
					$replacements[0] = "/\\3/\\1/\\2.htm";
					$replacements[1] = "/$defaultCode/\\1/\\2.htm";
					$replacements[2] = "/\\3/\\1/\\2.htm";
					$replacements[3] = "/$defaultCode/\\1/\\2.htm";
					$replacements[4] = "htm?";
        		}
        		else
        		{
        			$patterns[0] = "/&lang=(.+)/";
					$patterns[1] = "/\/frontend\/pages\/(.+)\.php\?pagecode=([a-z_\-\d]+)/";
					$patterns[2] = "/\/frontend\/pages\/(.+)\.php\?id=(\d+)/";
					$patterns[3] = "/htm&/";//html will be after firsts replacements
					
					$replacements[0] = "";
					$replacements[1] = "/\\1/\\2.htm";
					$replacements[2] = "/\\1/\\2.htm";
					$replacements[3] = "htm?";
        		}
				
				$url = preg_replace($patterns, $replacements, $url);
        	}
        }
        return $url;
    }

    public static function unRewriteUrl($url, $returnUrlWithConstant=true)
    {
    	if(USE_REWRITE)
        {
			$patterns[0] = '/'.str_replace("/", "\/", Context::SiteSettings()->getSiteUrl())."\/(.[^\/]+)[\/](.[^\/]+)[\/](\d+).htm/i";//for multilanguage url
			$replacements[0] = Context::SiteSettings()->getSiteUrl().PAGES_PATH."\\2.php?id=\\3&lang=\\1";
        	$patterns[1] = '/'.str_replace("/", "\/", Context::SiteSettings()->getSiteUrl())."\/(.[^\/]+)[\/](.[^\/]+)[\/]([a-z_\-\d]+).htm/i";//for multilanguage url
			$replacements[1] = Context::SiteSettings()->getSiteUrl().PAGES_PATH."\\2.php?pagecode=\\3&lang=\\1";
			$patterns[2] = '/'.str_replace("/", "\/", Context::SiteSettings()->getSiteUrl())."\/(.[^\/]+)[\/](\d+).htm/i";
			$replacements[2] = Context::SiteSettings()->getSiteUrl().PAGES_PATH."\\1.php?id=\\2";
			$patterns[3] = '/'.str_replace("/", "\/", Context::SiteSettings()->getSiteUrl())."\/(.[^\/]+)[\/]([a-z_\-\d]+).htm/i";
			$replacements[3] = Context::SiteSettings()->getSiteUrl().PAGES_PATH."\\1.php?pagecode=\\2";

			$url = preg_replace($patterns, $replacements, $url);
        }

        /**
         * If url have query params (?bar=foo) before unrewrite
         * replace last '?' -> '&' after unrewrite
         */
        if (substr_count($url, '?') > 1)
        {
            $startPosition = strrpos ($url, '?');
            $url = substr_replace($url, '&', $startPosition, 1);
        }
        
        if ($returnUrlWithConstant){
        	$url=appUrl::ValuesToCMSConstants($url);
        }
        return $url;
    }
   
    public static function replaceRewritedUrls($HTML)
    {
        if(USE_REWRITE)
        {
    		if(Context::SiteSettings()->multiLanguage())
    		{
				$defaultCode = Context::LanguageCode();
				
				$patterns[0] = "/\{SITE_URL_PAGES\}([a-z_]+)\.php&#63;pagecode=([a-z_\-\d]+)\&amp;lang=([a-z_]+)/i";
        		$patterns[1] = "/\{SITE_URL_PAGES\}([a-z_]+)\.php&#63;pagecode=([a-z_\-\d]+)\&amp;/i";//"/\/frontend\/pages\/(.+)\.php/";
        		$patterns[2] = "/\{SITE_URL_PAGES\}([a-z_]+)\.php&#63;pagecode=([a-z_\-\d]+)/i";//"/\/frontend\/pages\/(.+)\.php/";
        		$patterns[3] = "/\{SITE_URL_PAGES\}([a-z_]+)\.php&#63;id=(\d+)\&amp;lang=([a-z_]+)/i";
        		$patterns[4] = "/\{SITE_URL_PAGES\}([a-z_]+)\.php&#63;id=(\d+)\&amp;/i";//"/\/frontend\/pages\/(.+)\.php/";
        		$patterns[5] = "/\{SITE_URL_PAGES\}([a-z_]+)\.php&#63;id=(\d+)/i";//"/\/frontend\/pages\/(.+)\.php/";
        		
        		$replacements[0] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/\\3/\\1/\\2.htm";
        		$replacements[1] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/$defaultCode/\\1/\\2.htm?";
        		$replacements[2] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/$defaultCode/\\1/\\2.htm";
        		$replacements[3] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/\\3/\\1/\\2.htm";
        		$replacements[4] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/$defaultCode/\\1/\\2.htm?";
        		$replacements[5] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/$defaultCode/\\1/\\2.htm";
    		}
    		else
    		{
        		$patterns[0] = "/\{SITE_URL_PAGES\}([a-z_]+)\.php&#63;pagecode=([a-z_\-\d]+)\&amp;/i";
        		$patterns[1] = "/\{SITE_URL_PAGES\}([a-z_]+)\.php&#63;pagecode=([a-z_\-\d]+)/i";
        		$patterns[2] = "/\{SITE_URL_PAGES\}([a-z_]+)\.php&#63;id=(\d+)\&amp;/i";//"/\/frontend\/pages\/(.+)\.php/";
        		$patterns[3] = "/\{SITE_URL_PAGES\}([a-z_]+)\.php&#63;id=(\d+)/i";//"/\/frontend\/pages\/(.+)\.php/";
        		
        		$replacements[0] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().'/\\1/\\2.htm?';
        		$replacements[1] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().'/\\1/\\2.htm';
        		$replacements[2] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().'/\\1/\\2.htm?';
        		$replacements[3] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().'/\\1/\\2.htm';
    		}
			$HTML = preg_replace($patterns, $replacements, $HTML);
        } 
        return $HTML;
    }

    static public function CMSConstantsToValues($HTML)
    {
    	$HTML = appUrl::replaceRewritedUrls($HTML);
        $HTML = str_replace('{SITE_URL}', SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl(), $HTML);
        $HTML = str_replace('{SITE_URL_PAGES}', SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().PAGES_PATH, $HTML);
        //$HTML = str_replace('{SITE_PATH_PAGES}', SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().PAGES_PATH, $HTML);
        return $HTML;    	
    }
    
    static public function ValuesToCMSConstants($HTML)
    {
        $HTML = str_replace(SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().PAGES_PATH, '{SITE_URL_PAGES}', $HTML);
        $HTML = str_replace(SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl(), '{SITE_URL}', $HTML);
        return $HTML;
    }

    public function SitePathConstantToValue($HTML)
    {
        $HTML = str_replace('{SITE_PATH}', SITE_PATH, $HTML);
        return $HTML;
    }

    public function ValueToSitePathConstant($HTML)
    {
        $HTML = str_replace(SITE_PATH, '{SITE_PATH}', $HTML);
        return $HTML;
    }

    public function getYoutubeVideoCode($url)
    {
        $parsed_url = parse_url($url);
        if(isset($parsed_url['query']))
        {
            parse_str($parsed_url['query'], $parsed_query);
            if(isset($parsed_query['v'])) return $parsed_query['v'];
        }
        $urlArr = split('/', $url);
        return $urlArr[count($urlArr) - 1];
    }
}