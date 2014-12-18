<?php
include_once(FRAMEWORK_PATH."system/cache/CacheFace.php");
include_once(FRAMEWORK_PATH."system/Context.php");
class WebText
{
	protected $templateName;
	protected $templateText;
	public $isKeyFound=false;
	public $webTexts=array();
	
    function __construct($templateName) 
    {
    	$fileSource=file_get_contents($templateName);
    	if ($fileSource!=false)	
    	{
    		$this->templateName = $templateName;
    		$this->templateText = $fileSource;    		
    	}
    	else {
    		throw new CMSException("Cannot read template: $templateName.");
    	}    	
    	//getting variaaables from tpl
    	$this->parseTemplate();
    	//getting description from DB or putting it there
    	$this->checkTexts();
    }
    
    protected function parseTemplate()
    {
    	preg_match_all('|\{\$webtext_(.*)}{\*(.*)\*}|U', $this->templateText, $out, PREG_SET_ORDER);

    	if(count($out)>0)
    	{
    		$this->isKeyFound = true;
    		foreach ($out as $value)
	    	{
    			$encoded_value= mb_convert_encoding($value[2], "UTF-8", "Windows-1251");
    			//puting all webtext from template to array and encode values to UTF8
    			$new_value = array('key'=>$value[1], 'value'=>$encoded_value);
    			array_push($this->webTexts, $new_value);
	    	}
    	}
    }
    
    protected function checkTexts()
    {
    	if(count($this->webTexts))
    	{	
    		$cache = new CacheFace();		
        	if($data = $cache->get('webtexts_'.Context::SiteSettings()->getSiteId().'_'.Context::LanguageCode().'_'.md5($this->templateName)))
        	{
        		$this->webTexts = unserialize($data);
        	}
        	else 
        	{   
        		$langId=Context::LanguageId();
	    		for($i=0; $i<count($this->webTexts);$i++)
	    		{
					$query="SELECT description
			                FROM fe_WebText
			                WHERE keyword = '{$this->webTexts[$i]['key']}' and langId='".Context::LanguageId()."' and websiteId='".Context::SiteSettings()->getSiteId()."'";

					if (Context::DB()->query($query))
					{
						//var_dump(Context::DB()->result);
						$this->webTexts[$i]['value']=Context::DB()->result[0]['description'];
					}
					else //insert new webtext to the DB 
					{
						$query="insert into fe_WebText(keyword, description, langId, websiteId)
								values('{$this->webTexts[$i]['key']}','".mysqli_real_escape_string(Context::DB()->pointer, $this->webTexts[$i]['value'])."', $langId, ".Context::SiteSettings()->getSiteId().")";
						Context::DB()->query($query);
					}
	    		}
	    		$cache->save(serialize($this->webTexts));
        	}
    	}
    }
    public static function getText($keyword, $defaultValue, $useCache=true, $remark='', $availableForExport=1)
    {
    	$cache = new CacheFace();
    	if(($data = $cache->get('webtext_'.Context::SiteSettings()->getSiteId().'_'.Context::LanguageCode().'_'.$keyword))!==false)
    	{
    		$newValue = $data;
    	}
    	else
    	{
			$query="SELECT description
	                FROM fe_WebText
	                WHERE keyword = '$keyword' and langId='".Context::LanguageId()."' and websiteId='".Context::SiteSettings()->getSiteId()."'";
			if (Context::DB()->query($query))
			{
				$newValue=Context::DB()->result[0]['description'];
			}
			else//insert new webtext to the DB
			{
                $langId=Context::LanguageId();
                if (!mb_detect_encoding($defaultValue, "UTF-8", true))
                    $newValue= mb_convert_encoding($defaultValue, "UTF-8", "Windows-1251");
                else
                    $newValue = $defaultValue;

                if (!mb_detect_encoding($remark, "UTF-8", true))
                    $remark= mb_convert_encoding($remark, "UTF-8", "Windows-1251");

				$query="insert into fe_WebText(keyword, description, langId, websiteId, remark, exported)
						values('$keyword','".mysqli_real_escape_string(Context::DB()->pointer, $newValue)."', '$langId', '".Context::SiteSettings()->getSiteId()."', '$remark', $availableForExport)";
				Context::DB()->query($query);
			}

			if($useCache)
			{
				$cache->save($newValue);
			}
    	}
		return $newValue;
    }
}