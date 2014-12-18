<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");
require_once(FRAMEWORK_PATH."data_objects/base/PageObjectData.php");


class PoolObject extends PageObject 
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
			    $this->pageObjectData['title_image'] = $poData->getValue('text1');
			}
			if($poData->getValue('text2'))
			{
			    $this->pageObjectData['question'] = $poData->getValue('text2');
			}
			$this->pageObjectData['poolId'] = $poData->getValue('id');
			
			$this->pageObjectData['ajaxHandler'] = AJAX_HANDLER;
			$this->getRelatedPoolItems($poData->getValue('id'));
			
			$this->setTemplate('templates/PageObjects/PoolObject.tpl');
			
			return true;
		}
		else 
		{
			return false;
		}
    }
    
    private function getRelatedPoolItems($poolId)
    {
    	$db = DB::getInstance();
        $query="SELECT 
    				`fe_PagesRelatedItems`.`title` as answer,
    				`fe_PagesRelatedItems`.`id` as answerId,
    				`fe_PagesRelatedItems`.`number1` as pools
				FROM 
					fe_PagesRelatedItems
			    INNER JOIN be_PageContent 
			    	ON be_PageContent.contentId = fe_PagesRelatedItems.id
				WHERE be_PageContent.pageId = {$poolId}";        
            	
    	if($db->query($query))
    	{
    		$total = 0;
    		foreach ($db->result as $item)
    		{
    			$total+=$item['pools'];
    		}
    		if ($total==0) $total=1;
    		
    		$this->pageObjectData['pooltotal'] = $total;
    		
    		session_start();
    		if ($_SESSION['voted'.$poolId] || $_COOKIE['voted'.$poolId]=='true') 
    		{
    			$this->pageObjectData['voted'] = true;
    		}
    		else 
    		{
    			$this->pageObjectData['voted'] = false;
    		}
    		 
    		foreach ($db->result as $item)
    		{
    			$this->pageObjectData['poolItems'][] = array(	'answer' 	=> $item['answer'], 
    															'answerId' 	=> $item['answerId'], 
    															'pools'		=> $item['pools'], 
    															'percent' 	=> round($item['pools']*100/$total,0), 
    															'roundpercent' => round($item['pools']*240/$total)
    														);
    		}
    	}
    	else 
    		throw new  Exception(__CLASS__.'.'.__FUNCTION__.'No related items');
    }
}
?>