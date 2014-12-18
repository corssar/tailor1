<?php
require_once(FRAMEWORK_PATH."system/Languages.php");
require_once(FRAMEWORK_PATH."system/helper/LanguagesRelationManager.php");
class languageSelector extends PageObject
{
    protected function setFullCache(){
        $this->fullyCached = true;
        $this->cacheKey = 'language_selector_' . $this->poId . '_' . Context::PageId() . '_' . Context::LanguageId();
    }

    public function loadPageObject()
    {
        $poData = new PageObjectData($this->poId);
        if(!$poData->load())
            return false;

        $this->pageObjectData['title'] = $poData->getValue('title');
        $this->pageObjectData['showCurrentLang'] = $poData->getValue('number1');
        //prepare language array
        $Languages = Languages::getInstance();
        $langs = $Languages->GetActiveLanguages();
        foreach($langs as $item){
            $langs[$item['code']]['langImage'] = appUrl::CMSConstantsToValues($item['langImage']);
        }
        $this->pageObjectData['languages'] = $langs;
        $langsRelManager = new LanguagesRelationManager();
        $this->pageObjectData['relatedPageUrls'] = $langsRelManager->GetRelatedPages(Context::PageId(), Context::PageClass());
        $this->pageObjectData['currentLangCode'] = Context::LanguageCode();


        $this->setTemplate('templates/PageObjects/languageSelector.tpl');
        return true;
    }
}
?>