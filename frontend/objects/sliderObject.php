<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");

class SliderObject extends PageObject
{
    public 	$CSS = array("/frontend/webcontent/css/responsiveslides.css");
    public  $JS = array("/frontend/webcontent/js/responsiveslides.min.js");

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
            $this->setTemplate('templates/PageObjects/SliderObject.tpl');
        }
        else
        {//no data for PO
            return false;
        }
        return true;
    }
}