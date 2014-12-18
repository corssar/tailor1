<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");
require_once(FRAMEWORK_PATH."data_objects/base/PageObjectData.php");

class imageLinkObject extends PageObject 
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
			$this->pageObjectData['id'] = $this->poId;
			if($poData->getValue('title'))
			{
			    $this->pageObjectData['title'] = $poData->getValue('title');
			}	
			if($poData->getValue('text1'))
			{
			    $this->pageObjectData['image'] = appUrl::CMSConstantsToValues($poData->getValue('text1'));
			}
			if($poData->getValue('text2'))
			{
			    $this->pageObjectData['alt'] = $poData->getValue('text2');
			}
			if($poData->getValue('text3'));
			{
			    $this->pageObjectData['url'] = appUrl::checkUrl($poData->getValue('text3'));
			}
			
		    $this->pageObjectData['newWindow'] = $poData->getValue('number1')?true:false;

			$this->setTemplate('templates/PageObjects/imageLinkObject.tpl');	
		}
		else 
		{//no data for PO
			return false;
		}
		return true;
    }
}
?>