<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");
require_once(FRAMEWORK_PATH."system/webshop/basket.php");
require_once(FRAMEWORK_PATH."system/breadcrumbs/config.php");

class breadCrumb extends PageObject
{
    public function loadPageObject()
    {
        $poData = new PageObjectData($this->poId);
        if(!$poData->load())
            return false;

        $currClassName = Context::getCurrentPageClassName();

        $args = array('pageClass' => $currClassName,
                      'controllersDir' => ucfirst($currClassName),
                      'controller' => ucfirst($currClassName) . MODULE_SUFiX);

        require_once(DIRECTORY_CLASS_PATH . $args['controllersDir'] . '/' . $args['controller'] . '.php');

        $breadCrumb = new $args['controller']($args['pageClass'] . '.php');

        $this->pageObjectData['nodes'] = $breadCrumb->getNodes();

        $this->setTemplate('templates/PageObjects/breadCrumb.tpl');







        /*if($poData->getValue('title'))
        {
            $this->pageObjectData['cartTitle'] = $poData->getValue('title');
        }*/

        return true;
    }
}
