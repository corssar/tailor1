<?php

class Langs
{
    function __construct()
    {
        $this->db = Context::DB();
    }

    public function getWebSiteLangs($fieldId, $params = array())
	{
		if (isset($params['processed']) && $params['processed'])
		{
			$result = array();
			
			$result['selectedFields'] = ", be_Languages.code as langCode";
			
			$result['linkedTables'] = " INNER JOIN be_Languages
											ON be_Languages.id = langId";

			if($params['langId'] > 0)
				$result['whereParams'] = '	langId='.$params['langId'];
			
			return $result;
		}
	
        $db = DB::getInstance();//use Languages class
        $query = "  SELECT be_Languages.* FROM be_Languages
                    INNER JOIN be_WebsiteLanguages
                      ON be_WebsiteLanguages.langId = be_Languages.id
                    WHERE be_WebsiteLanguages.websiteId = ".Context::SiteSettings()->getSiteIdFromSession()."
                    ORDER BY be_Languages.priority";
        if(!$db->query($query))
		{
			//log error
			break;
		}
		$languages = $db->result;
	
		$result['html']= '<select name="view['.$fieldId.'][langId]">';
		$result['html'].= '	<option value="0"></option>';
		foreach ($languages as $item)
		{
			$result['html'].= '	<option value="'.$item['id'].'"'.(isset($params['langId']) && $params['langId']==$item['id']?' selected':'').'>'.$item['code'].'</option>';
		}
		$result['html'].= '</select>';

		return $result;
	}
}
?>