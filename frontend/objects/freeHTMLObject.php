<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");

class FreeHTMLObject extends PageObject 
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
			if($poData->getValue('html'))
			{
			    $this->pageObjectData['html'] = appUrl::CMSConstantsToValues($poData->getValue('html'));
			}
			$this->setTemplate('templates/PageObjects/freeHTMLObject.tpl');	
		}
		else 
		{//no data for PO
			return false;
		}
		return true;
    }
}
?>