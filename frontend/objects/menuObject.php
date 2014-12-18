<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");
require_once(FRAMEWORK_PATH."data_objects/base/PageObjectData.php");
require_once(FRAMEWORK_PATH."system/siteTree.php");

class MenuObject extends PageObject
{
    public $nodes = array();

    public function loadPageObject()
    {
        $returnedData = array();

        $cache = new CacheFace();
        if($data = $cache->get('MenuObject_' . $this->poId))
        {
            $data = unserialize($data);
        }
        else
        {
            $poData = new PageObjectData($this->poId);
            if(!$poData->load())
            return false;

            $data['title'] = $poData->getValue('title');
            $data['treeNavigationPOId'] = (int)$poData->getValue('number1');
            if (!isset($data['treeNavigationPOId'])){
                throw new CMSException(__CLASS__.'.'.__FUNCTION__.'(...). number1 is not defined');
            }

            $data['templateFile'] = (string) appUrl::checkUrl($poData->getValue('text1'));

            $cache->save(serialize($data));
        }
        $siteTree = siteTree::getInstance($data['treeNavigationPOId']);
       /* if(!$siteTree->isMenuLoaded())
            return false;*/

        $returnedData['title'] = $data['title'];
        $returnedData['menuItems'] = $siteTree->menuItems;
        $returnedData['selectedMenuItem'] = $siteTree->selectedMenuItem;

        $this->setTemplate($data['templateFile']);
        $this->setPageObjectData($returnedData);
        return true;
    }
}