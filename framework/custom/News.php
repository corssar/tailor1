<?
/*
class News
{
	public $lang;
	public $anonymComment = true;
	public $approvedComment = false;
	public $anonymName = "Visitor";
	public $newsViewId = 18;
	
	function __construct($lang = null)
	{
		$this->anonymName = WebText::getText("visitor", "Гость");
		$this->lang = $lang?$lang:null;
	}
	
	public function addComment($contentId, $userId, $text, $subject="")
    {
    	$user = new CMSUser();
		$approved = ($this->approvedComment)?0:1;
		$query = "INSERT INTO `fe_Comments` (contentId, userId, subject, text, approved) VALUES({$contentId}, {$userId}, '{$subject}', '{$text}', {$approved})";

    	if (Context::DB()->query($query))
		{
			return true;
		}
		else
		{
			return true;
		}
    }
    
    public function getComments($contentId, $limit = 30)
    {
    	
    	$limit = ($limit>0)?" LIMIT 0,{$limit}":"";
    	
    	$results = array();
    	
    	$query 	 = 	"SELECT 
    						fe_Comments.*, fe_Users.name, fe_Users.surname
    				FROM `fe_Comments` 
					LEFT JOIN 
						fe_Users ON fe_Comments.userId=fe_Users.id
					WHERE contentId={$contentId}";
  		if ($this->approvedComment)
  		{
  			$query .= " AND fe_Comments.approved=1";
  		}
  		if (!$this->anonymComment)
  		{
  			$query .= " AND fe_Users.active=1";
  		}
    	if (Context::DB()->query($query))
		{
			$properties = Context::DB()->result;
			for($i=0;$i<count($properties);$i++)
			{
				if ($properties[$i]['name'] == '' && $properties[$i]['surname'] == '')
				{
					$results[$i]['username'] = $this->anonymName;
				}
				else
				{
					$results[$i]['username'] = $properties[$i]['name']." ".$properties[$i]['surname'];
				}
			    $results[$i]['text'] = addslashes($properties[$i]['text']);
			    $results[$i]['subject'] = addslashes($properties[$i]['subject']);
			    $results[$i]['date'] = $properties[$i]['date'];
			}
			return $results;
		}
    }
    
    public function getMedia($limit = 20)
    {
    	$sqlLimit = ($limit>0)?" LIMIT 0,{$limit}":"";
    	
    	if ($this->lang)
    	{
    		$whereParam .= " AND fe_Pages.langId={$this->lang}";
    	}
    	
    	$whereParam .= " AND fe_Pages.text5<>''";
    	
    	$query="SELECT 
    			fe_Pages.*, be_View.className as classname
            FROM 
            	fe_Pages
            INNER JOIN 
            	be_View ON fe_Pages.Viewid = be_View.viewId
            WHERE 
            	fe_Pages.viewid = {$this->newsViewId}{$whereParam}
            ORDER BY 
            	fe_Pages.dateStartVisible
            DESC ".$sqlLimit;
    	
    	$results = array();
    	
    	if (Context::DB()->query($query))
		{
			$properties = Context::DB()->result;
			$i = 0;
			
			foreach (Context::DB()->result as $item)
			{
				$results[$i]['title'] = $item['title'];
				$results[$i]['link'] = appUrl::getUrl($item['id'], $item['classname']);
				$results[$i]['image'] = appUrl::CMSConstantsToValues($item['text1']);
				
				$i++;
			}
			return $results;
		}
    }
}
*/
?>