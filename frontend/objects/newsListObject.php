<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");
class NewsListObject extends PageObject 
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
			
			$newsCount = $poData->getValue('number2');
			
			//getting news for preview bloc
			$news = new NewsListData($poData->getValue('langId'));		    
			$this->pageObjectData['news_list'] = $news->getNewsContent(false, 0, $newsCount);
			$this->pageObjectData['newsListUrl'] = appUrl::checkUrl($poData->getValue('text3'));
			
			$this->setTemplate('templates/PageObjects/newsListObject.tpl');	
			
		}
		else 
		{//no data for PO
			return false;
		}
		return true;
    }
}
?>