<?php
require_once(FRAMEWORK_PATH."system/WebText.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
require_once(FRAMEWORK_PATH."system/addresses.php");
require_once(FRAMEWORK_PATH."data_objects/NewsListData.php");

class NewsController
{
	var $aTemplateData = array();
    
	public function addComment()
	{   
	   	$comment = trim(str_replace("\n","  ",Request::getString('commentText',"POST")));
	   	$subject = Request::getString('commentSubject',"POST");
	   	$newsId = Request::getInt('newsId',"POST");
	   	$user = new CMSUser();
	   	$news = new NewsListData(0);
		$userId = intval($user->userId);
		
		$resultText = "";
	    if ($comment=='')
	    {
	    	$resultText .= WebText::getText("putcomment", " Введіть будь-ласка коментар.");
	    }
	    if ($newsId<=0 || $userId<=0)
	    {
	    	$resultText .= WebText::getText("fatalerroruser", " Неможливо ідентифікувати користувача чи новину.");
	    }
	    $this->aTemplateData['viewCommentType'] = 0;
    	if ($resultText=='')
    	{
    		if($news->addComment($newsId, $userId, $comment, $subject))
			{
				if (!$user->userTrust)
				{	
					$resultText = WebText::getText("approvedcommenttext", "Дякуємо, за те що залишили коментар. Він поставлений до черги і чекає підтвердження модераторів");
					$this->aTemplateData['viewCommentType'] = 1;
				}
				else
				{
					$resultText = WebText::getText("succescommenttext", "Дякуємо, за те що залишили коментар.");
					$this->aTemplateData['viewCommentType'] = 2;
					$this->aTemplateData['comment'] = stripslashes($comment);
    				$this->aTemplateData['subject'] = stripslashes($subject);
    				$this->aTemplateData['date'] = date("d-m-Y, H:i");
    				$this->aTemplateData['userName'] = $user->userName." ".$user->userSurname;
    				
    				$addresses = new Addresses();
    				if ($addresses->getAddress($userId, 1))
    				{
    					$this->aTemplateData['city'] = $addresses->addressData['city'];
    				}
    				$this->aTemplateData['city'] = ($this->aTemplateData['city']=='')?"":$this->aTemplateData['city'];
				}
			}
			else
			{
				$resultText = WebText::getText("notaddcomment", " Коментар неможливо додати.");
			}
    	}
    	
    	$this->aTemplateData['resultText'] = $resultText;
    	
		return json_encode($this->aTemplateData);
	}
	
	public function addRate()
	{   
	   	$news = new NewsListData(0);

	   	$newsId = Request::getInt('newsId',"POST");
	   	if ($newsId<=0 || isset($_COOKIE['newsRate'.$newsId]) || $_COOKIE['newsRate'.$newsId] == 1)
	   	{
	   		$this->aTemplateData['success'] = false;
	   	}
	   	else
	   	{
	   		if ($news->addRate($newsId))
	   		{
	   			$this->aTemplateData['success'] = true;
	   		}
	   		else
	   		{
	   			$this->aTemplateData['success'] = false;
	   		}
	   		
	   	}
		return json_encode($this->aTemplateData);
	}
}

$newsController = new NewsController();

switch ($_REQUEST['action'])
{
	case 'addComment' 		: echo $newsController->addComment(); break;
	case 'addRate' 			: echo $newsController->addRate(); break;
}
?>