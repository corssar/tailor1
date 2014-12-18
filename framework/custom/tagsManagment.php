<?

class TagsManagment
{
	protected $lang;
	public $newsCount = 0;
	public $countOnPage=0;
	public $total_pages=1;
	public $current_page=1;
	
	function __construct($lang)
	{
		$this->lang = $lang;
	}
	
	public function getTagsByNew($newId)
	{
		$query	=	"SELECT fe_AddWords.*
					 FROM fe_AddWords
					     INNER JOIN fe_AddWordsRelations ON fe_AddWordsRelations.wordId = fe_AddWords.id
					 WHERE fe_AddWordsRelations.contentId =$newId
					 ORDER by fe_AddWords.text ASC
					";
		if(Context::DB()->query($query))
    	{
    		$result = Context::DB()->result;
    		$tagList = '';
    		$newsListViewId	=	19;//news_list's viewId
    		$query	=	"SELECT fe_Pages.id FROM fe_Pages
    					 WHERE fe_Pages.viewId = $newsListViewId AND fe_Pages.langId = $this->lang
    					 LIMIT 0,1
    					";
    		
    		if(Context::DB()->query($query))
    			$newsListId = Context::DB()->result[0]['id'];
    		else
    			$newsListId	= 0;

    		if ($newsListId)
    			$url	=	appUrl::getUrl($newsListId, "news_list.php");
    		else
    			$url	=	'';
    		$i = 0;
    		foreach ($result as $item)
    		{
    			if(!$i)
    				$tagList.= '<a style="text-decoration:underline;color:#A9A9A9;font-weight:bold;" href="'.$url.'?tagId='.$item['id'].'" style="color:#666666;">'.$item['text'].'</a>';    			
    			else
    				$tagList.= ',&nbsp;&nbsp;<a style="text-decoration:underline;color:#A9A9A9;font-weight:bold;" href="'.$url.'?tagId='.$item['id'].'" style="color:#666666;">'.$item['text'].'</a>';
    			$i++;
    		}
    		return $tagList;
    	}
    	else 
    		return '';
	}
	
	public function getTagsListByNew($newId)
	{
		$query	=	"SELECT fe_AddWords.*
					 FROM fe_AddWords
					     INNER JOIN fe_AddWordsRelations ON fe_AddWordsRelations.wordId = fe_AddWords.id
					 WHERE fe_AddWordsRelations.contentId =$newId
					 ORDER by fe_AddWords.text ASC
					";
		if(Context::DB()->query($query))
    	{
    		$result = Context::DB()->result;
    		$tagList = '';
//    		$newsListViewId	=	19;//news_list's viewId
//    		$query	=	"SELECT fe_Pages.id FROM fe_Pages
//    					 WHERE fe_Pages.viewId = $newsListViewId AND fe_Pages.langId = $this->lang
//    					 LIMIT 0,1
//    					";
//    		
//    		if(Context::DB()->query($query))
//    			$newsListId = Context::DB()->result[0]['id'];
//    		else
//    			$newsListId	= 0;
//
//    		if ($newsListId)
//    			$url	=	appUrl::getUrl($newsListId, "news_list.php");
//    		else
//    			$url	=	'';
    		$i = 0;
    		foreach ($result as $item)
    		{
    			if(!$i)
    				$tagList.= $item['id'];
    			else
    				$tagList.= ", ".$item['id'];
    			$i++;
    		}
    		return $tagList;
    	}
    	else 
    		return '';
	}
	
	public function getTagsListByClub($clubId)
	{
		$query	=	"SELECT fe_AddWords.*
					 FROM fe_AddWords
					     INNER JOIN fe_TeamAddWordsRelations ON fe_TeamAddWordsRelations.wordId = fe_AddWords.id
					 WHERE fe_TeamAddWordsRelations.teamId =$clubId
					 ORDER by fe_AddWords.text ASC
					";
		if(Context::DB()->query($query))
    	{
    		$result = Context::DB()->result;
    		$tagList = '';
//    		$newsListViewId	=	19;//news_list's viewId
//    		$query	=	"SELECT fe_Pages.id FROM fe_Pages
//    					 WHERE fe_Pages.viewId = $newsListViewId AND fe_Pages.langId = $this->lang
//    					 LIMIT 0,1
//    					";
//    		
//    		if(Context::DB()->query($query))
//    			$newsListId = Context::DB()->result[0]['id'];
//    		else
//    			$newsListId	= 0;
//
//    		if ($newsListId)
//    			$url	=	appUrl::getUrl($newsListId, "news_list.php");
//    		else
//    			$url	=	'';
    		$i = 0;
    		foreach ($result as $item)
    		{
    			if(!$i)
    				$tagList.= $item['id'];
    			else
    				$tagList.= ", ".$item['id'];
    			$i++;
    		}
    		return $tagList;
    	}
    	else 
    		return '';
	}
	public function getTagsListByPlayer($playerId)
	{
		$query	=	"SELECT fe_AddWords.*
					 FROM fe_AddWords
					     INNER JOIN fe_PlayerAddWordsRelations ON fe_PlayerAddWordsRelations.wordId = fe_AddWords.id
					 WHERE fe_PlayerAddWordsRelations.playerId =$playerId
					 ORDER by fe_AddWords.text ASC
					";
		if(Context::DB()->query($query))
    	{
    		$result = Context::DB()->result;
    		$tagList = '';
//    		$newsListViewId	=	19;//news_list's viewId
//    		$query	=	"SELECT fe_Pages.id FROM fe_Pages
//    					 WHERE fe_Pages.viewId = $newsListViewId AND fe_Pages.langId = $this->lang
//    					 LIMIT 0,1
//    					";
//    		
//    		if(Context::DB()->query($query))
//    			$newsListId = Context::DB()->result[0]['id'];
//    		else
//    			$newsListId	= 0;
//
//    		if ($newsListId)
//    			$url	=	appUrl::getUrl($newsListId, "news_list.php");
//    		else
//    			$url	=	'';
    		$i = 0;
    		foreach ($result as $item)
    		{
    			if(!$i)
    				$tagList.= $item['id'];
    			else
    				$tagList.= ", ".$item['id'];
    			$i++;
    		}
    		return $tagList;
    	}
    	else 
    		return '';
	}

    public function getNewsListByTag($tagId, $category=0, $countOnPage = 0, $pageNumber = 0)
    {
    	$user = CMSUser::getInstance();
    	if($category)
    	{
    		$whereParam.= " AND fe_Pages.number2 = $category ";
    	}
    	if($category == 0)
    	{
    		$whereParam.= " AND fe_Pages.number4 = 0 ";
    	}
    	if(!$user->isLogged || ($user->isLogged && !$user->isReferee($user->userId)))
    	{
    		$whereParam.= " AND fe_Pages.number5 = 0 ";
    	}
    	
    	$limit 		= $countOnPage>0?"LIMIT ".($pageNumber-1)*$countOnPage.",$countOnPage":"";
    	
    	$query="SELECT 
					count(fe_Pages.id) as newsCount
				FROM fe_Pages
					INNER JOIN fe_AddWordsRelations ON fe_AddWordsRelations.contentId = fe_Pages.id
				WHERE fe_AddWordsRelations.wordId = $tagId AND fe_Pages.viewId = 18 AND fe_Pages.langId = $this->lang
				{$whereParam}
				";
    	if (Context::DB()->query($query))
			$this->newsCount = Context::DB()->result[0]['newsCount'];
    	
    	$query="SELECT 
					fe_Pages.*
				FROM fe_Pages
					INNER JOIN fe_AddWordsRelations ON fe_AddWordsRelations.contentId = fe_Pages.id
				WHERE fe_AddWordsRelations.wordId = $tagId AND fe_Pages.viewId = 18 AND fe_Pages.langId = $this->lang
				{$whereParam}
				ORDER BY 
                	fe_Pages.dateStartVisible
                DESC
				$limit";
    	if (Context::DB()->query($query))
		{
			$properties	=	Context::DB()->result;
			
			unset($newsList);
			for($i=0;$i<count($properties);$i++)
			{
			    $newsList[$i]['title']				= $properties[$i]['title'];
			    $newsList[$i]['shortDescription']	= appUrl::CMSConstantsToValues($properties[$i]['shortDescription']);
			    $newsList[$i]['image']				= appUrl::CMSConstantsToValues($properties[$i]['text1']);
			    $newsList[$i]['imageBig']			= appUrl::CMSConstantsToValues($properties[$i]['text2']);
			    $newsList[$i]['URL']				= appUrl::getUrl($properties[$i]['id'], "news.php");
			    $newsList[$i]['date']				= $properties[$i]['dateStartVisible'];
			    $newsList[$i]['monthTitle']			= NewsListData::getMonthTitle(substr($properties[$i]['dateStartVisible'], 5, 2));
			}
			return $newsList;
		}
		else
		{
			return array();
		}
    }
    
    public function getNewsListByTags($newId, $category = 0, $tagList, $countOnPage = 0)
    {
    	$user = CMSUser::getInstance();
    	if($category)
    	{
    		$whereParam.= " AND fe_Pages.number2 = $category ";
    	}
    	if($category == 0)
    	{
    		$whereParam.= " AND fe_Pages.number4 = 0 ";
    	}
    	if(!$user->isLogged || ($user->isLogged && !$user->isReferee($user->userId)))
    	{
    		$whereParam.= " AND fe_Pages.number5 = 0 ";
    	}
    	
    	$limit 		= $countOnPage>0?"LIMIT 0,$countOnPage":"";
    	
    	$query="SELECT 
					fe_Pages.*
				FROM fe_Pages
					INNER JOIN fe_AddWordsRelations ON fe_AddWordsRelations.contentId = fe_Pages.id
				WHERE fe_Pages.viewId = 18 AND fe_AddWordsRelations.wordId in (".$tagList.")  AND fe_Pages.langId = $this->lang  AND fe_Pages.id != $newId
				{$whereParam}
				GROUP BY fe_Pages.id
				ORDER BY 
                	fe_Pages.dateStartVisible
                DESC
				$limit";

    	if (Context::DB()->query($query))
		{
			$properties	=	Context::DB()->result;
			
			unset($newsList);
			for($i=0;$i<count($properties);$i++)
			{
			    $newsList[$i]['title']				= $properties[$i]['title'];
			    $newsList[$i]['shortDescription']	= appUrl::CMSConstantsToValues($properties[$i]['shortDescription']);
			    $newsList[$i]['image']				= appUrl::CMSConstantsToValues($properties[$i]['text1']);
			    $newsList[$i]['imageBig']			= appUrl::CMSConstantsToValues($properties[$i]['text2']);
			    $newsList[$i]['URL']				= appUrl::getUrl($properties[$i]['id'], "news.php");
			    $newsList[$i]['date']				= $properties[$i]['dateStartVisible'];
			    $newsList[$i]['monthTitle']			= NewsListData::getMonthTitle(substr($properties[$i]['dateStartVisible'], 5, 2));
			}
			return $newsList;
		}
		else
		{
			return array();
		}
    }
    
}
?>