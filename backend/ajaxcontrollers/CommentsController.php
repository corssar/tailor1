<?

class CommentsController
{
	var $response = array('HTML'=>'', 'JS' => '');
	
	public function getCommentsList($parameters,$formData = array())
	{
		global $lang;
				
		$this->response['HTML'] = $this->selectComments($parameters,$formData);
		$this->response['JS'] = 'Menu.leftenable();';
		return $this->response;
	}
	
	private function selectComments($parameters,$formData)
	{
		$db = DB::getInstance();
		global $lang;
		$formData = $formData=="undefined"?array():$formData;
		
		if($parameters['search']>0)
		{
			$date = explode('-',$formData['searchDateFrom']);
			$hour = $bePostData["searchDateFromh"]!==''?$formData["searchDateFromh"]:null;
			$min  = $bePostData["searchDateFromm"]!==''?$formData["searchDateFromm"]:null;
			$dateFrom = mktime($hour,$min,null,$date[1],$date[0],$date[2]);
			
			$date = explode('-',$formData['searchDateTo']);
			$hour = $bePostData["searchDateToh"]!==''?$formData["searchDateToh"]:null;
			$min  = $bePostData["searchDateTom"]!==''?$formData["searchDateTom"]:null;
			$dateTo = mktime($hour,$min,null,$date[1],$date[0],$date[2]);
		}
		else 
		{
			$dateFrom = time()-24*60*60;
			$dateTo   = time()+60;
		}
		
		$html ='<form name="commentSearch" id="commentSearch" class="searchFormContainer">
					<div>
						'.$this->buildDateField($dateFrom,"searchDateFrom").'
						News ID: <input type="text" name="newsId" value="'.$formData['newsId'].'" size="5">
						<input type="button" class="button" value="'.$lang['SEARCH'].'" onclick="navigation.sendRequest(\'CommentsController\',\'getCommentsList\',{search:1},\'main_content_container\',\'main_content_container\',xajax.getFormValues(commentSearch));">
					</div>
					<div>
						'.$this->buildDateField($dateTo,"searchDateTo").'
						Game ID: <input type="text" name="gameId" value="'.$formData['gameId'].'" size="5">
					</div>
				</form><br style="clear:both"/>';
		
		$news = $formData['newsId']?"AND contentId=".$formData['newsId']:"";
		$game = $formData['gameId']?"AND gameId=".$formData['gameId']:"";
		
		$query = "	SELECT 	fe_Comments.id as commentId,
							fe_Comments.contentId,
							fe_Comments.text as commentText,
							fe_Comments.gameId,
							fe_Comments.approved,
							fe_Comments.subject,
							UNIX_TIMESTAMP(fe_Comments.date) as date,
							fe_Pages.id as pageId,
							be_View.className,
							fe_Users.name,
							fe_Users.surname
					FROM fe_Comments 
					INNER JOIN fe_Users 
						ON fe_Users.id = fe_Comments.userId
					LEFT JOIN fe_Pages 
						ON fe_Pages.id = fe_Comments.contentId
					LEFT JOIN be_View
						ON be_View.viewId = fe_Pages.viewId
					WHERE 
						date>=FROM_UNIXTIME($dateFrom) AND date<=FROM_UNIXTIME($dateTo)
						$news
						$game
					ORDER BY approved ASC,date DESC";

		if($db->query($query))
		{
			foreach ($db->result as $item)
			{
				$approveButton 	= $item['approved']==0?'<input type="button" class="button" value="'.$lang['APPROVE'].'" onclick="navigation.sendRequest(\'CommentsController\',\'approveComment\',{commentId:'.$item['commentId'].',search:1},\'main_content_container\',\'main_content_container\',xajax.getFormValues(commentSearch));"><br/><br/>':'';
				$urlToContent 	= $item['contentId']?'pages/'.$item['className'].'?id='.$item['pageId']:'pages/games.php?id='.$item['gameId'];
				$urlToContentError = (intval($item['pageId'])<=0 && intval($item['gameId'])<=0)?$lang['PAGENOTEXISTS'].'<br /><br />':'<input type="button" class="button" value="'.$lang['GOTOPAGE'].'" onclick=window.open("'.SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().'/frontend/'.$urlToContent.'");><br/><br/>';
				$html .= '	<div class="comments_item">
								<div class="text">
									<b>'.$item['name'].' '.$item['surname'].':</b><br />
									'.$lang['THEME'].': <i>'.$item['subject'].'</i><br />
									'.$lang['ADDED'].': <i>'.date("H:i:s, d-m-Y", $item['date']).'</i><br />
									<textarea id="textarea'.$item['id'].'" cols=75 rows=5>'.$item['commentText'].'</textarea>
								</div>
								<div class="actions">
									<input type="button" class="button" value="'.$lang['DELETE'].'" onclick="navigation.sendRequest(\'CommentsController\',\'deleteComment\',{commentId:'.$item['commentId'].',search:1},\'main_content_container\',\'main_content_container\',xajax.getFormValues(commentSearch));"><br/><br/>
									'.$approveButton.$urlToContentError.'
									<input type="button" class="button" value="'.$lang['UPDATE'].'" onclick="navigation.sendRequest(\'CommentsController\',\'updateComment\',{commentId:'.$item['commentId'].',text:document.getElementById(\'textarea'.$item['id'].'\').value,search:1},\'main_content_container\',\'main_content_container\',xajax.getFormValues(commentSearch));"><br/>
								</div>
							</div>';
			}
		}
		
		return $html;
	}
	
	public function deleteComment($parameters,$formData = array())
	{
		global $lang;
	    $db = DB::getInstance();
    	$query = "DELETE FROM fe_Comments WHERE id={$parameters['commentId']}";

		$db->query($query);
	
		$this->response['HTML'] = $this->selectComments($parameters,$formData);
		$this->response['JS'] 	= "";
		return $this->response;
	}
	
	public function updateComment($parameters,$formData = array())
	{
		global $lang;
	    $db = DB::getInstance();
    	$query = "UPDATE fe_Comments set text='{$parameters['text']}' WHERE id={$parameters['commentId']}";

		$db->query($query);
	
		$this->response['HTML'] = $this->selectComments($parameters,$formData);
		$this->response['JS'] 	= "";
		return $this->response;
	}
	
	public function approveComment($parameters,$formData = array())
	{
		global $lang;
	    $db = DB::getInstance();
    	$query = "UPDATE fe_Comments set approved=1 WHERE id={$parameters['commentId']}";

		$db->query($query);
	
		$this->response['HTML'] = $this->selectComments($parameters,$formData);
		$this->response['JS'] 	= "";
		return $this->response;
	}
	
	private function buildDateField($value = null, $fieldId, $hm = true)
	{
		$date = trim($value)!=''?date("d-m-Y",$value):date("d-m-Y",time());
		$hour = trim($value)!=''?date("H",$value):date("H",time());
		$min  = trim($value)!=''?date("i",$value):date("i",time());
		$html = '<input type="text" name="'.$fieldId.'" id="'.$fieldId.'" value="'.$date.'" readonly />
					  <img src="webcontent/img/calendar.gif" onclick="displayCalendar(document.getElementById(\''.$fieldId.'\'),\'dd-mm-yyyy\',this);" />&nbsp;&nbsp;';
		if($hm)
		{
			$html.= '<select name="'.$fieldId.'h" id="'.$fieldId.'h"/>';
			for($i=0;$i<24;$i++)
			{
				$pr = $i<10?$pr='0':'';
				if($i==$hour) 
					$html.= '<option value="'.$i.'" selected>'.$pr.$i.'</option>';
				else 
					$html.= '<option value="'.$i.'">'.$pr.$i.'</option>';
			}
			$html.='</select>';
			
			$html.= '<select name="'.$fieldId.'m" id="'.$fieldId.'m"/>';
			for($i=0;$i<60;$i++)
			{
				$pr = $i<10?$pr='0':'';
				if($i==$min) 
					$html.= '<option value="'.$i.'" selected>'.$pr.$i.'</option>';
				else 
					$html.= '<option value="'.$i.'">'.$pr.$i.'</option>';
			}
			$html.='</select>';
		}
		return $html;
	}
}


?>