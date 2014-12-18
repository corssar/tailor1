<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");
//require_once(FRAMEWORK_PATH."data_objects/PageObjectData.php");

class SearchObject extends PageObject 
{
	protected $fullyCached=true;
	
    public function loadPageObject()
    {
        $poData = new PageObjectData($this->poId);
		if($poData->load())
		{
			if($sfKeyWord = request::getString("sfKeyWord","POST",true))
			{
				$this->pageObjectData['sfKeyWord'] = $sfKeyWord;
			}
			
			if($poData->getValue('text3'))
			{
			    $this->pageObjectData['submit'] = $poData->getValue('text3');
			}
			if($poData->getValue('text2'))
			{
			    $this->pageObjectData['action'] = appUrl::checkUrl($poData->getValue('text2'));
			}
			$this->setTemplate('templates/PageObjects/SearchObject.tpl');
		}
		else 
		{//no data for PO
			return false;
		}
		return true;
    }
}
?>