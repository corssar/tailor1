<?php
require_once(FRAMEWORK_PATH."system/tpl_engine/SmartyView.php");

class PoolAjaxController
{
    public function voting($itemId,$poolId)
	{
	    $db = DB::getInstance();
	    session_start();
	   	
    	if (isset($poolId) && $poolId>0 && !$_SESSION['voted'.$poolId] && $_COOKIE['voted'.$poolId]!='true')
    	{
    		$query = "UPDATE fe_PagesRelatedItems SET number1 = number1+1 WHERE id = $itemId AND viewId = 23";
			if($db->query($query))
			{
				$_SESSION['voted'.$poolId] = true;
				setcookie('voted'.$poolId, "true", time()+time(), "/");
			}
    	}
    	
		$view = new SmartyView();
		$templateData = array();
		
		$query = "	SELECT 
						`fe_PagesRelatedItems`.`title` as answer,
						`fe_PagesRelatedItems`.`number1` as pools
					FROM 
						`fe_PagesRelatedItems`
					INNER JOIN
						`be_PageContent` 
						ON
						`be_PageContent`.`pageId` = $poolId
					WHERE 
						`fe_PagesRelatedItems`.`id` = `be_PageContent`.`contentId`";
		if($db->query($query))
    	{
    		$total = 0;
    		foreach ($db->result as $item)
    		{
    			$total+=$item['pools'];
    		}
    		if ($total==0) $total=1;
    		
    		foreach ($db->result as $item)
    		{
    			$aPoolList[] = array(	'answer' 		=> $item['answer'], 
    									'pools'			=> $item['pools'], 
    									'percent' 		=> round($item['pools']*100/$total,0), 
    									'roundpercent' 	=> round($item['pools']*240/$total)
    								);
    		}
    		$aTemplateData['aPoolList'] = $aPoolList;
    		$aTemplateData['pooltotal'] = $total;
    		$aTemplateData['poolId'] = $poolId;
		}
		$response = array();
		$response['html'] = $view->fetch(FRONTEND_TEMPL_PATH.'AjaxControllers/PoolResults.tpl', $aTemplateData);
		$response['poolId'] = $poolId;
		return json_encode($response);
	}
}

$poolAjaxController	=	new PoolAjaxController();

switch ($_REQUEST['action'])
{
	case 'voting' 	: echo $poolAjaxController->voting(Request::getInt('voteitem',"POST"),Request::getInt('poolId',"POST")); break;
}
?>