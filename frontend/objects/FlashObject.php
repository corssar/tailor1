<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");
require_once(FRAMEWORK_PATH."data_objects/base/PageObjectData.php");
require_once(FRAMEWORK_PATH."system/appUrl.php");

class FlashObject extends PageObject 
{
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
			    $this->pageObjectData['swffile'] = appUrl::CMSConstantsToValues($poData->getValue('text1'));
			}
			if($poData->getValue('text2'))
			{
			    $this->pageObjectData['xmlfile'] = appUrl::CMSConstantsToValues($poData->getValue('text2'));
			}
			$this->pageObjectData['objectid'] 	= appUrl::CMSConstantsToValues($poData->getValue('id'));
			$this->pageObjectData['filetitle'] 	= appUrl::CMSConstantsToValues($poData->getValue('text4'));
			$this->pageObjectData['width'] 		= appUrl::CMSConstantsToValues($poData->getValue('number1'));
			$this->pageObjectData['height'] 	= appUrl::CMSConstantsToValues($poData->getValue('number2'));
			$this->pageObjectData['version'] 	= appUrl::CMSConstantsToValues($poData->getValue('number3'));
			$this->pageObjectData['bgcolor'] 	= appUrl::CMSConstantsToValues($poData->getValue('text3'));
			$this->setTemplate('templates/PageObjects/FlashObject.tpl');	
		}
		else 
		{//no data for PO
			return false;
		}
		return true;
    }
}
?>