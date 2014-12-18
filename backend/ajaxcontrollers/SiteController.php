<?php
/**
 * Created by: melissen
 */
class SiteController
{
    public $response = array('HTML'=>'', 'JS' => '');

	public function buildCopySiteForm()
    {
        include_once(FRAMEWORK_PATH."system/tpl_engine/SmartyView.php");
        global $lang;
        
		$isMultiSite = defined("MULTI_SITE") && MULTI_SITE;
        if($isMultiSite){
            include_once(FRAMEWORK_PATH.'system/helper/WebsiteManager.php');
            $websites = WebsiteManager::getWebsitesWithLanguages();
            $arrayData['websites'] = $websites;
        }
        $arrayData['multiSite'] = $isMultiSite;
        $arrayData['curSiteId'] = Context::SiteSettings()->getSiteIdFromSession();
        
        $db = DB::getInstance();
        if($db->query("SELECT id,name FROM be_Languages WHERE 1"))
        	$arrayData['langs'] = $db->result;
        
        $view = new SmartyView();
        $arrayData['title'] = $lang['COPY_SITE_SETTINGS'];
        $this->response['HTML'] = $view->fetch(BACKEND_PATH.'templates/copySiteForm.tpl', $arrayData);
        $this->response['JS'] = "Menu.leftenable();";
        return $this->response;
    }
    
    public function CopySettings($parameters)
	{
        if( isset($parameters['sourceSiteId']) && $parameters['sourceSiteId'] && 
        	isset($parameters['newSiteURL']) && $parameters['newSiteURL']!='' && 
        	isset($parameters['newSiteTitle']) && $parameters['newSiteTitle']!='' )
		{
            $db = DB::getInstance();
            $this->response['HTML'] .= WebText::getText('BE_SiteCopy_CopyErrorResult','Копіювання сайту відбулося з помилкою', true);
            
            //copy website
            $query = "SELECT * FROM be_WebSites WHERE id = ".intval($parameters['sourceSiteId']);
            
            $newWebsiteURL = $parameters['newSiteURL'];
            $newWebsiteTitle = $parameters['newSiteTitle'];
            
            $insert = 'INSERT INTO be_WebSites (';
            $fields = '';
            $values = '';
            
            if($db->query($query))
            {
            	foreach ($db->result[0] as $k=>$v)
            	{
            		if($k == 'id') 
            			continue;
            		
            		$fields.= "`$k`,";
            		if($k == 'name'){
            			$values.= "'$newWebsiteTitle',";
            			continue;
            		}

            		if($k == 'URL'){
            			$values.= "'$newWebsiteURL',";
            			continue;
            		}
            		
            		$values.= "'$v',";
            	}
            }

            $fields = substr($fields,0,-1);
            $values = substr($values,0,-1);
            $insert.= $fields.") VALUES ($values)";
            
            if(!$db->query($insert))
            {
            	$this->response['HTML'] .= WebText::getText('BE_SiteCopy_CopyErrorResult','Копіювання сайту відбулося з помилкою', true);
                $this->response['JS'] = "";
                return $this->response;
            }
            
            $newWebsiteId = $db->LIID;
            
            //copy images sizes            
            $query = "SELECT * FROM be_ImageSizes WHERE websiteId = ".intval($parameters['sourceSiteId']);
            if(!$db->query($query) && $db->error)
	           return $this->response;
            
        	foreach ($db->result as $row)
        	{
	            $insert = 'INSERT INTO be_ImageSizes (';
	            $fields = '';
	            $values = '';
	            
	            	foreach ($row as $k=>$v)
	            	{
	            		if($k == 'id') 
	            			continue;
	            		
	            		$fields.= "`$k`,";
	            		if($k == 'websiteId'){
	            			$values.= "'$newWebsiteId',";
	            			continue;
	            		}
	            		$values.= "'$v',";
	            	}
	
	            $fields = substr($fields,0,-1);
	            $values = substr($values,0,-1);
	            $insert.= $fields.") VALUES ($values)";
	            
	            if(!$db->query($insert))
	                return $this->response;
            }
            
            //add admin to added site
            $session 	= new SESSION();
    		$admin		= new ADMIN($session);
            if(!$db->query("INSERT INTO tbl_Website_Admin (`adminId`,`websiteId`) VALUES ('$admin->id','$newWebsiteId')"))
            {
                return $this->response;
            }
            
            //add languages
            $websiteDefaultLang = in_array(3, $parameters['newSiteLangs']) ? 3 : $parameters['newSiteLangs'][0];
            foreach ($parameters['newSiteLangs'] as $item)
            {
            	if(!$db->query("INSERT INTO be_WebsiteLanguages (`langId`,`websiteId`,`defaultLang`) VALUES ('$item','$newWebsiteId','".($item==$websiteDefaultLang?1:0)."')"))
                    return $this->response;
            }
            
            $this->response['HTML'] = WebText::getText('BE_SiteCopy_CopyResult','Копіювання сайту відбулося успішно', true);
            $this->response['JS'] 	= "copySiteSettingsDone('$newWebsiteId','$newWebsiteTitle');";
           
        }
		else
        	$this->response['HTML'] .= WebText::getText('BE_SiteCopy_ErrorParamCopy','Не передані всі параметри для копіювання сайту', true);

        return $this->response;
    }
}