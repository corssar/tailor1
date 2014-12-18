<?php
/*
require_once(FRAMEWORK_PATH."PageObject.php");
require_once(FRAMEWORK_PATH."data_objects/PageObjectData.php");
require_once(FRAMEWORK_PATH."data_objects/NewsListData.php");
*/
require_once(FRAMEWORK_PATH."custom/tagsManagment.php");
require_once(FRAMEWORK_PATH."core/PageObject.php");
class AttachedNewsObject extends PageObject 
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
			
			
			//$newsCountSkip = $poData->getValue('number1');
			$newsCount = $poData->getValue('number2');
			if(Context::PageId())
			{
				//getting news for preview bloc
				$tags = new TagsManagment($poData->getValue('langId'));
				$choice	=	$poData->getValue('number3');
				//echo Context::PageId();
				switch ($choice)
				{
					case 5:	$this->pageObjectData['news_list']= $tags->getNewsListByTags(Context::PageId(), 0, $tags->getTagsListByNew(Context::PageId()), $newsCount);
							break;
					case 6:	$this->pageObjectData['news_list']= $tags->getNewsListByTags(Context::PageId(), 0, $tags->getTagsListByClub(Context::PageId()), $newsCount);
							break;
					case 7:	$this->pageObjectData['news_list']= $tags->getNewsListByTags(Context::PageId(), 0, $tags->getTagsListByPlayer(Context::PageId()), $newsCount);
							break;
				}
				
				$this->pageObjectData['newsListUrl'] = appUrl::checkUrl($poData->getValue('text3'))."?np=".Context::PageId()."&ch=".$choice;
			}
			$this->setTemplate('templates/PageObjects/attachedNewsObject.tpl');	
			
		}
		else 
		{//no data for PO
			return false;
		}
		return true;
    }
}
?>