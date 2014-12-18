<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");

class SubscribeRSSObject extends PageObject
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
            $this->pageObjectData['title'] = $poData->getValue('title');
            $this->pageObjectData['text'] = $poData->getValue('shortDescription');

            $this->setTemplate('templates/PageObjects/subscribeRSSObject.tpl');
        }
        else
        {//no data for PO
            return false;
        }
        return true;
    }
}
?>