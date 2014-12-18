<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");
require_once(FRAMEWORK_PATH."data_objects/base/PageObjectData.php");
require_once(FRAMEWORK_PATH."system/appUrl.php");

class FlashPlayerObject extends PageObject 
{
	protected function setFullCache(){
		$this->fullyCached = true;
    	//if time per cache should be not general, please set time as next code: $this->pageCacheTime = SomeTime;    	
    }
    public function loadPageObject()
    {
        $poData = new PageObjectData($this->poId);
		if($poData->load())
		{
			if($poData->getValue('title'))
			{
			    $this->pageObjectData['title'] = $poData->getValue('title');
			}
			if($poData->getValue('text1'))
			{
			    $this->pageObjectData['titleimage'] = appUrl::CMSConstantsToValues($poData->getValue('text1'));
			}
			if($poData->getValue('text2'))
			{
			    $this->pageObjectData['playercod'] = appUrl::checkUrl(appUrl::CMSConstantsToValues($poData->getValue('text2')), "");
			}
			if($poData->getValue('number1'))
			{
			    $this->pageObjectData['playerwidth'] = appUrl::CMSConstantsToValues($poData->getValue('number1'));
			}
			if($poData->getValue('number2'))
			{
			    $this->pageObjectData['playerheight'] = appUrl::CMSConstantsToValues($poData->getValue('number2'));
			}
			$this->pageObjectData['videoId'] = $poData->getValue('id');
			$this->getRelatedVideoItems($poData->getValue('id'));
			$this->setTemplate('templates/PageObjects/FlashPlayerObject.tpl');
		}
		else 
		{//no data for PO
			return false;
		}
		return true;
    }
    
    private function getRelatedVideoItems($videolId)
    {
    	$db = DB::getInstance();
    	
    	$query = "SELECT 
    				`fe_PagesRelatedItems`.`title`,
    				`fe_PagesRelatedItems`.`shortDescription`,
    				`fe_PagesRelatedItems`.`text1` as altText, 
    				`fe_PagesRelatedItems`.`text2` as littleimage,
    			  	`fe_PagesRelatedItems`.`text3` as bigimage, 
    			  	`fe_PagesRelatedItems`.`text4` as author, 
    			  	`fe_PagesRelatedItems`.`text5` as file, 
    			  	`be_PageContent`.pageId
    					FROM `be_PageContent` 
    					INNER JOIN `fe_PagesRelatedItems` ON `fe_PagesRelatedItems`.`id`=`be_PageContent`.`contentId`
    				WHERE `be_PageContent`.`pageId`=$videolId ORDER BY `be_PageContent`.`id` ASC";
    	if(Context::DB()->query($query))
    	{
    		$i = 0;
    		$dbres = array();
    		$properties = Context::DB()->result;
    		for ($i=0; $i < count($properties); $i++)
  			{
				if (strstr(strtolower($properties[$i]['file']),".flv"))
				{
					if ($i==0)
					{
						$this->pageObjectData['firstVideo'] = appUrl::checkUrl($properties[$i]['file']);
						$this->pageObjectData['firstImage'] = appUrl::checkUrl($properties[$i]['bigimage']);
					}
					$dbres[$i]['file'] = appUrl::checkUrl($properties[$i]['file']);
					$dbres[$i]['altText'] = $properties[$i]['altText'];
					$dbres[$i]['title'] = $properties[$i]['title'];
					$dbres[$i]['shortDescription'] = $properties[$i]['shortDescription'];
					$dbres[$i]['littleimage'] = appUrl::checkUrl($properties[$i]['littleimage']);
					$dbres[$i]['bigimage'] = appUrl::checkUrl($properties[$i]['bigimage']);
					$dbres[$i]['author'] = $properties[$i]['author'];					
				}
  			}
  			$this->pageObjectData['videoItems'] = $dbres;
    	}
    	else 
    		throw new  Exception(__CLASS__.'.'.__FUNCTION__.'No related items');
    }
}
?>