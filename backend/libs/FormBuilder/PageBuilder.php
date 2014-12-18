<?php

class PageBuilder
{
	var $groups		= array();
	var $fields		= array();
	var $tabsCount	= 0;
	var $viewId		= '';
	var $fieldJs	= '';
	var $itemId		= null;
	var $viewType	= 'general';
	
	var $addItemViewId = null;

	var $deleteAllow = 0;
	var $copyAllow = 0;

	var $jsFieldTypesArray     = '';
	var $searchResultTableHead = array();
	
	var $parentContent_rFieldName = null;
	var $parentItemId = null;

	function __construct($parameters, &$groups, &$fields)
	{
		$this->viewId   = $parameters['viewId'];
		$this->viewType = $parameters['viewType'];
		$this->deleteAllow = $parameters['deleteAllow'];
		$this->copyAllow = $parameters['copyAllow'];
		$this->editAllow = $parameters['editAllow'];
        $this->canApply = $parameters['canApply'];
		$this->addItemViewId = $parameters['addItemViewId'];
		$this->itemId	= isset($parameters['itemId']) && $parameters['itemId']?$parameters['itemId']:null;
		$this->groups   = &$groups;
 		$this->fields   = &$fields;
 		
		if( isset($parameters['parentItemId']) && $parameters['parentItemId'] && 
			isset($parameters['rFieldName']) && $parameters['rFieldName'] )
		{
			$this->parentItemId = $parameters['parentItemId'];
			$this->parentContent_rFieldName = $parameters['rFieldName'];
		}
	}

	protected function buildForm()
	{
		global $lang;
		$tabHead= '';
		$html	= '<FORM name="'.$this->viewId.'viewForm" id="'.$this->viewId.'viewForm">';

		$tabContainer = '<div><input type="hidden" name="view[viewId]" value="'.$this->viewId.'">';

		if ( is_array($this->groups) && count($this->groups) > 0)
		{
			$tabHead = '<div>';
			foreach ($this->groups as $group)
			{
				$tabActive = $this->tabsCount==0?' class="tabHeadActive" ':' class="tabHeadInactive" ';
				$cntActive = $this->tabsCount==0?' class="tabContainerActive" ':' class="tabContainerInactive" ';
				$tabHead .= '
					<div id="tabHead'.$this->viewId.'_'.$this->tabsCount.'" onclick="tabsNavigation'.$this->viewId.'.switchTab('.$this->tabsCount.');" '.$tabActive.'>
						<span style="margin-bottom:4px;">'.$group['groupName'].'</span>
					</div>';
				$tabContainer .= '
					<div id="tabContainer'.$this->viewId.'_'.$this->tabsCount.'" '.$cntActive.'>
						<table width="100%">';
						foreach ($this->fields as $beField)
						{
							if($beField['groupId'] != $group['groupId']) continue;

							if($beField['visible'] == 1)
							{
                                // display real sizes from settings
                                if($beField['fieldType'] == 7 && $beField['displayType'] == 2)
                                {
                                    $query = "SELECT * FROM be_ImageSizes WHERE imageSizeCode = '".$beField['rFieldName']."' AND websiteId = ".Context::SiteSettings()->getSiteIdFromSession()." LIMIT 1";
                                    $sizesStr = '';
                                    if(Context::DB()->query($query))
                                        $sizesStr = ' ('.Context::DB()->result[0]['width'].' x '.Context::DB()->result[0]['height'].')';
                                    $beField['displayName'].= $sizesStr;
                                }

								$tabContainer .= '
								<tr valign="top" id="'.$beField['fieldId'].'FieldContainer">
									<td class="fieldNameContainer">
										'.$beField['displayName'];
								$tabContainer .= $beField['required']?'<div class="fieldNameContext">('.$lang['REQUIRED'].')</div>':'';
								$tabContainer .= !$beField['displayType']?'<div class="fieldNameContext">('.$lang['SET_BY_PROGRAMM'].')</div>':'';
								$tabContainer .= '</td>
									<td class="fieldHtmlContainer">
										'.$this->createField($beField).'
									</td>
								</tr>';
							} else {
								$tabContainer .= $this->createField($beField);
							}
						}
						$this->tabsCount++;
					$tabContainer .= '</table>
					</div>';
			}
			$tabHead .= '</div>';
		} else {
			$tabContainer .= '<div class="tabContainerActive"><table width="100%">';
			foreach ($this->fields as $beField)
			{
				if($beField['visible'] == 1)
				{
                    // display real sizes from settings
                    if($beField['fieldType'] == 7 && $beField['displayType'] == 2)
                    {
                        $query = "SELECT * FROM be_ImageSizes WHERE imageSizeCode = '".$beField['rFieldName']."' AND websiteId = ".Context::SiteSettings()->getSiteIdFromSession()." LIMIT 1";
                        $sizesStr = '';
                        if(Context::DB()->query($query))
                            $sizesStr = ' ('.Context::DB()->result[0]['width'].' x '.Context::DB()->result[0]['height'].')';
                        $beField['displayName'].= $sizesStr;
                    }

					$tabContainer .= '
					<tr valign="top" id="'.$beField['fieldId'].'FieldContainer">
						<td class="fieldNameContainer">
							'.$beField['displayName'];
					$tabContainer .= $beField['required']?'<div class="fieldNameContext">('.$lang['REQUIRED'].')</div>':'';
					$tabContainer .= !$beField['displayType']?'<div class="fieldNameContext">('.$lang['SET_BY_PROGRAMM'].')</div>':'';
					$tabContainer .= '</td>
						<td class="fieldHtmlContainer">
							'.$this->createField($beField).'
						</td>
					</tr>';
				} else {
					$tabContainer .= $this->createField($beField);
				}
			}
			$tabContainer .= '</table></div>';
		}

		$tabContainer     .= '</div>';
		$html .= $tabHead.'<br style="clear:both;">'.$tabContainer.'</FORM>';

		return $html;
	}

	public function buildPage($viewTitle)
	{
		global $lang;
		
		$html ='<div class="viewTitle">'.$viewTitle.'</div>
				<div id="preliminarySaveResult" style="display:none;" >'.$viewTitle.'</div>
				<div class="viewHeadButtons">';

        if(MULTI_SITE)
		    $html.='    <a href="javascript:void(0);" id="itemCopyButton" class="itemCopyButton" onclick="copyContentPopUpObj.open();;">'.$lang['COPY_ITEM'].'</a>&nbsp;&nbsp;&nbsp;';
        $html.='    <a href="javascript:void(0);" id="itemRelationsLink" class="buttonRelations" onclick="relatedContentPopUpObj.open();">'.$lang['RELATIONS'].'</a>&nbsp;&nbsp;&nbsp;';

        if ($this->canApply)
        {
            $html .= '<a href="#" id="viewButton'.$this->viewId.'" class="buttonAccept" onclick="SaveData('.$this->viewId.', 1);return false;" >'.$lang['ACCEPT'].'</a>&nbsp;&nbsp;&nbsp;';
        }
        if ($this->editAllow)
        {
		    $html .= '<a href="javascript:void(0);" id="viewButton'.$this->viewId.'" class="buttonSave" onclick="SaveData('.$this->viewId.');return false;" >'.$lang['SAVE'].'</a>&nbsp;&nbsp;&nbsp;';
        }

        $html .= '<a href="javascript:void(0);" id="viewCancelButton'.$this->viewId.'" class="buttonCancel" onclick="Cancel('.$this->viewId.',\''.$this->itemId.'\');return false;">'.$lang['CANCEL'].'</a>';
        $html .= '</div><br style="clear:both;">';
        
		$html .= $this->buildForm();
		return $html;
	}

	protected function buildSearchForm()
	{
		$html = '<FORM name="'.$this->viewId.'searchForm" class="searchForm" id="'.$this->viewId.'searchForm">';
			$html .= '<div class="searchFormBlock">';
				foreach ( $this->fields as $beField )
				{
					if( $beField['visible'] == 1 )
					{
						$html .= '
							<div class="searchFormItem">
								<div>'.$beField['displayName'].'</div>
								<div>'.$this->createField($beField).'</div>
							</div>';
					} else {
						$html .= $this->createField($beField);
					}
				}
			$html .= '</div>';
		$html .= '	</FORM>';

		return $html;
	}

	public function buildSearchPage($viewTitle,$parameters,$searchDataArray,$searchResultsHead)
	{
		global $lang;
		$searchData = isset($searchDataArray['itemsArray'])?$searchDataArray['itemsArray']:null;
		$searchType = $parameters['searchType'];

        if ($this->viewId == ORDER_MODERATION_VIEW)
            $searchedItemsOnPage = 10;
        else
            $searchedItemsOnPage = SEARCHED_ITEMS_ON_PAGE;

		$pages      = isset($searchDataArray['itemsCount'])?ceil($searchDataArray['itemsCount']/$searchedItemsOnPage):0;
		$addContent = '';
		$resultFieldId	= isset($parameters['fieldId']) && $parameters['fieldId']?$parameters['fieldId']:"''";

		foreach ( $searchResultsHead as $headItem )
		{
			if( $headItem['visibleInSearchResult'] == 1 && $headItem['visible'] == 1)
			{
				$this->searchResultTableHead[$headItem['fieldName']] = $headItem['displayName'];
			}
		}

		switch ($searchType)
		{
			case 'general'		: 	$container = 'main_content_container';
//									$actionsButtons = $this->viewId != ORDER_MODERATION_VIEW?'<img onclick="viewDataObject{searchedViewId} = new ViewDataObject({searchedViewId},\'general\'); navigation.sendRequest(\'ViewController\',\'viewBuild\',{viewId:{searchedViewId},itemId:{id}});" title="'.$lang['EDIT'].'" src="webcontent/img/reply.gif" class="cursor" border="0" />'
//                                                                                            :'<img title="'.$lang['EDIT'].'" src="webcontent/img/reply.gif" class="cursor" border="0" />';
                                    $actionsButtons = '<img onclick="viewDataObject{searchedViewId} = new ViewDataObject({searchedViewId},\'general\'); navigation.sendRequest(\'ViewController\',\'viewBuild\',{viewId:{searchedViewId},itemId:{id}});" title="'.$lang['EDIT'].'" src="webcontent/img/reply.gif" class="cursor" border="0" />';
									$actionsButtons.= $this->copyAllow?'&nbsp;<img onclick="viewDataObject{searchedViewId} = new ViewDataObject({searchedViewId},\'general\'); navigation.sendRequest(\'ViewController\',\'viewBuild\',{viewId:{searchedViewId},itemId:{id},copyContent:1});" title="'.$lang['COPY'].'" src="webcontent/img/copy.gif" class="cursor" border="0" />':'';
									$actionsButtons.= $this->deleteAllow?'&nbsp;<img onclick="javascript: if(confirm(DELETE_CONFIRM)){ navigation.sendRequest(\'ViewController\',\'DeleteContentItem\',{viewId:{searchedViewId},itemId:{id}}); }" title="'.$lang['DELETE'].'" src="webcontent/img/item_delete.gif" class="cursor"  border="0" />':'';

									$this->fieldJs = 'viewStack[0] = '.$this->viewId.';';

									break;

			case 'internalLinks': 	$container = 'main_content_container';
									$actionsButtons = '<img onclick="parent.document.getElementById(\'txtUrl\').value = \'{pageUrl}\'; parent.parent.SetSelectedTab(\'Info\');parent.document.getElementById(\'cmbLinkProtocol\').selectedIndex=4;" src="webcontent/img/action_add.gif" class="cursor" border="0" />';
									break;

			case 'multipleField': 	$container      = 'searchPage';
									$actionsButtons = '<img onclick="MpAgent.foundToSelect({id},\'{title}\');" src="webcontent/img/action_add.gif" class="cursor" border="0" />';
									if(isset($parameters['open']) && $parameters['open'] == 1)
									{
										$headContent = '<div id="searchPage">';
										$footContent = '</div><br style="clear:both;">
														<div id="SearchMpAgentContainer">
															<div id="SearchMpAgentDiv">
																<select id="SearchMpAgent" multiple></select>
															</div>
															<div id="SearchMpAgentButtons">
																<img onclick="MpAgent.upOption();"		src="webcontent/img/item_up.gif" 	 class="cursor"	border="0" />
																<img onclick="MpAgent.downOption();" 	src="webcontent/img/item_down.gif"   class="cursor"	border="0" />
																<img onclick="MpAgent.removeItem();" 	src="webcontent/img/item_delete.gif" class="cursor" border="0" />
															</div>
															<div id="SearchMpAgentSaveCancel">
																<input type="button" class="button" value="'.$lang['SAVE'].'" 	onclick="MpAgent.copyListItems(\'SearchMpAgent\','.$resultFieldId.');searchBox.hideDiv();">&nbsp;&nbsp;&nbsp;
																<input type="button" class="button" value="'.$lang['CANCEL'].'" onclick="searchBox.hideDiv();">
															</div>
														</div>';
									}
									$this->fieldJs = 'MpAgent = new MpFieldManager(null,\'SearchMpAgent\',mpField'.$resultFieldId.'.maxItemsCount); MpAgent.copyListItems('.$resultFieldId.',\'SearchMpAgent\');';
									break;

			case 'linkField'	: 	$container = 'searchPage';
									$actionsButtons = '<img onclick="document.getElementById(\'inputTextSearch\').value = \'{pageUrl}\';" src="webcontent/img/action_add.gif" class="cursor" border="0" />';
									if(isset($parameters['open']) && $parameters['open'] == 1)
									{
										$headContent = '<div id="searchPage">';
										$footContent = '</div><br style="clear:both;">
														<div style="background-color:#ccc;border: solid 1px #000; height:25px; padding:10px;">
															<input type="text" id="inputTextSearch" size="50" value="">
										 					<input type="button" class="button" value="'.$lang['SAVE'].'" onclick="copySearchResult(\'inputTextSearch\','.$parameters['fieldId'].');searchBox.hideDiv();">&nbsp;&nbsp;&nbsp;
										 					<input type="button" class="button" value="'.$lang['CANCEL'].'" onclick="searchBox.hideDiv();">
														</div>';
									}
									break;
									
			case 'relatedItems': 	$container = 'searchPage';
									$actionsButtons = '<img onclick="relatedItemsObj.addNewRelation({id},{searchedViewId}); return false;" src="webcontent/img/action_add.gif" class="cursor" border="0" />';
									if(isset($parameters['open']) && $parameters['open'] == 1)
									{
										$headContent = '<div id="searchPage">';
										$footContent = '</div><br style="clear:both;">
														<div style="background-color:#ccc;border: solid 1px #000; height:25px; padding:10px;">
										 					<input type="button" class="button" value="'.$lang['CANCEL'].'" onclick="searchBox.hideDiv();">
														</div>';
									}
									break;

//			case 'internalPage'	:	$container = 'searchPage';
//									$urlLanguageParam = Context::SiteSettings()->multiLanguage()?'&lang={langcode}':'';
//									$actionsButtons = '<img onclick="document.getElementById(\'inputTextSearch\').value = \'{id}'.$urlLanguageParam.'\';" src="webcontent/img/action_add.gif" class="cursor" border="0" />';
//									if(isset($parameters['open']) && $parameters['open'] == 1)
//									{
//										$headContent = '<div id="searchPage">';
//										$footContent = '</div><br style="clear:both;">
//														<div style="background-color:#ccc;border: solid 1px #000; height:25px; padding:10px;">
//															<input type="text" id="inputTextSearch" size="50" value="">
//										 					<input type="button" class="button" value="'.$lang['SAVE'].'" onclick="copySearchResult(\'inputTextSearch\','.$parameters['fieldId'].');searchBox.hideDiv();">&nbsp;&nbsp;&nbsp;
//										 					<input type="button" class="button" value="'.$lang['CANCEL'].'" onclick="searchBox.hideDiv();">
//														</div>';
//									}
//									break;

		}
		$html =	isset($headContent)?$headContent:'';
		$html.=	'<div class="searchFormContainer"><div class="searchViewTitle">'.$viewTitle.'</div>
				 <div class="viewHeadButtons">
					<input type="button" id="viewButton'.$this->viewId.'" class="button" value="'.$lang['SEARCH'].'" onclick="SearchData('.$this->viewId.',\''.$searchType.'\',\''.$container.'\',1,'.$resultFieldId.');">';

        if($this->addItemViewId)
        {
        	 $html.= '&nbsp;&nbsp;<input type="button" value="'.$lang['ADD'].'" onclick="viewDataObject'.$this->addItemViewId.' = new ViewDataObject('.$this->addItemViewId.',\'general\'); navigation.sendRequest(\'ViewController\',\'viewBuild\',{viewId:'.$this->addItemViewId.',itemId:0});" class="button">';
        }

		$html.=	'</div>';
		$html.= $this->buildSearchForm()."</div>";

        if ($this->viewId == ORDER_MODERATION_VIEW) {
            require_once(FRAMEWORK_PATH."system/webshop/order.php");
            $moderationData['statuses'] = Order::getOrderStatuses();
            $view = new SmartyView();
            $html .= $view->fetch(BACKEND_PATH . 'templates/orderModeration.tpl', $moderationData);
        }

		if(is_array($searchData))
		{
			$html.='<br style="clear:both;">
					<div class="searchResultTable">
					<table>';
			$html.='<tr><th>'.$lang['ACTIONS'].'</th>';
			$tdCounts = 1;
			foreach ($this->searchResultTableHead as $key=>$value)
			{
				if($key == 'id' or $key == 'searchedViewId' or $key == 'classPage') continue;
				$html .= '<th>'.$value.'</th>';
				$tdCounts++;
			}
			$html .= '</tr>';

			if(is_array($searchData) && count($searchData)>0)
			{
				foreach ($searchData as $row)
				{
					if(isset($row['classPage']))
					{
						$pageUrl = 	SITE_PROTOCOL.
                                            Context::SiteSettings()->getSiteUrl().
											PAGES_PATH.
											$row['classPage'].'?'.
											(isset($row['codeName'])&&$row['codeName']?'pagecode='.$row['codeName']:'id='.$row['id']).
											(Context::SiteSettings()->multiLanguage()?'&lang='.$row['langCode']:'');
					}

                    if ($this->viewId == ORDER_MODERATION_VIEW) {
                        $orderOverviewUrl = appUrl::getUrl($row['id'], "orderModerationPreview.php");
                        $html .= '<tr id="orderId' . $row['id'] . '" onclick="moderateOrder(' . $row['id'] . ', ' . $row['orderStatusId'] . ',  \'' . $orderOverviewUrl . '\', $(\'#orderId'.$row['id'].'\'));" class="moderateOrder">';
                    } else
                        $html .= '<tr>';

					$html .= '<td width="56px" align="center">';

                    if(!isset($row['title']) && isset($row['name']) && $searchType == 'multipleField'){
                        $row['title'] = $row['name'];
                        unset($row['name']);
                    }
								
					$html .= 	str_replace('{searchedViewId}',$row['searchedViewId'],
								str_replace('{id}',$row['id'],
								str_replace('{title}',isset($row['title'])?str_replace("'","",$row['title']):'',
								str_replace('{pageUrl}',isset($pageUrl)?$pageUrl:'',$actionsButtons))));
					$html .= '</td>';

					foreach ($row as $key=>$value)
					{
						if(($key == 'id') or $key == 'searchedViewId' or $key == 'classPage' or $key == 'codeName'
                            or $key=='orderStatusId') continue;
						//if($key == 'dateStartVisible') $value = date("d-m-Y",$value);
						if(!$value) $value = '&nbsp;';
						$html .= '<td>'.$value.'</td>';
					}
					$html .= '</tr>';
				}
			} else	{
				$html .= '<tr><td align="center" colspan="'.$tdCounts.'">'.$lang['NO_RESULTS'].'</td></tr>';
			}
			$html .= '</table>';
			$html .= '</div>';
			$html .= $this->buildPaganation($pages,$parameters['page'],$searchType,$container,$resultFieldId);
			$html .= '</div>';
		}
		$html .= isset($footContent)?$footContent:'';
		return $html;
	}

	protected function buildPaganation($pages,$page,$searchType,$container,$resultFieldId)
	{
		global $lang;
		$html = '<div class="paginationContainer">';
		if($pages>1)
		{
			$pn = isset($page)?$page:1;
			if($pn>1)
			{
				$html .= '<span onclick="SearchData('.$this->viewId.',\''.$searchType.'\',\''.$container.'\','.($pn-1).','.$resultFieldId.');" class="pagination_cursor pagination_cursor_prev_page" >'.$lang['PREVIOUS_PAGE'].'</span>';
			}
			$ranges['begin'] = array(1,2,3);
			$ranges['end']	 = array($pages-2,$pages-1,$pages);
			$merged_all		 = false;

			foreach ($ranges['begin'] as $v)
			{
				if (in_array($v, $ranges['end'])) $merged_all = true;
			}

			for ($i=1;$i<=$pages;$i++)
			{
				//$active           = $i==$page?'color:#FF0000;':'';
				$active           = $i==$page?' pagination_cursor_active':'';
				$merged_left	  = false;
				$merged_right	  = false;
				$ranges['middle'] = array($pn-1,$pn,$pn+1);

				foreach ($ranges['middle'] as $v)
				{
					if (in_array($v, $ranges['begin']) )   $merged_left  = true;
					if (in_array($v, $ranges['end'])   )   $merged_right = true;
				}

				switch (true)
				{
					case in_array($i,$ranges['begin']):
						$html .= '<span onclick="SearchData('.$this->viewId.',\''.$searchType.'\',\''.$container.'\','.$i.','.$resultFieldId.');"class="pagination_cursor'.$active.'">'.$i.'</span>';
						if (!in_array(($i+1),$ranges['begin']) && !$merged_left && !$merged_all && $pn!=4)     $html .= "...";
						break;
					case in_array($i,$ranges['middle']):
						$html .= '<span onclick="SearchData('.$this->viewId.',\''.$searchType.'\',\''.$container.'\','.$i.','.$resultFieldId.');" class="pagination_cursor'.$active.'">'.$i.'</span>';
						break;
					case in_array($i, $ranges['end']):
					    if (!in_array(($i-1),$ranges['end']) && !$merged_right && !$merged_all && $pn!=($pages-4)) $html .="...";
						$html .= '<span onclick="SearchData('.$this->viewId.',\''.$searchType.'\',\''.$container.'\','.$i.'),'.$resultFieldId.';" class="pagination_cursor'.$active.'">'.$i.'</span>';
						break;
				}
			}
			if($pn!=$pages) $html .= '&nbsp;<span onclick="SearchData('.$this->viewId.',\''.$searchType.'\',\''.$container.'\','.($pn+1).','.$resultFieldId.');" class="pagination_cursor pagination_cursor_next_page">'.$lang['NEXT_PAGE'].'</span>';
		}
		$html .'</div>';
		return $html;
	}

	public function getFieldsJS($type = '')
	{
		if ($type == 'buildform')
		{
			$js = '';
			if($this->tabsCount > 0)
				$js ='tabsNavigation'.$this->viewId.' = new TabsNavigation();tabsNavigation'.$this->viewId.'.initTabs('.$this->viewId.','.$this->tabsCount.'); ';

			if(Context::SiteSettings()->multiLanguage() && $this->viewType!=4)
			{
				$js .= "viewDropDownSelectBoxesData = {};";
				$js .= "viewDropDownSelectBoxesData['$this->viewId'] = {};";
			}

			$js .= 'beFields_'.$this->viewId.' = ['.str_replace('][','],[',$this->jsFieldTypesArray).']; '.$this->fieldJs.'viewStack[0] = 0;';

			if(Context::SiteSettings()->multiLanguage() && $this->viewType!=4)
				$js .= "buildDropDownSelectBox($this->viewId,false);";

			return $js;
		} else {
			return $this->fieldJs;
		}
	}

	protected function createField($be_Field)
	{
		global $lang;
        $be_Field_defaultValue = $be_Field['be_Field_defaultValue'];
		$name           = $be_Field['fieldName'];
		$fieldId        = $be_Field['fieldId'];
		$displayName    = $be_Field['displayName'];
		$fieldType      = $be_Field['fieldType'];
		$displayType    = $be_Field['displayType'];
		$required	    = $be_Field['required'];
		$validation     = $be_Field['validation'];
		$value          = $be_Field['defaultValue'];
		$availableValues= $be_Field['availableValues'];
		$groupId        = $be_Field['groupId'];
		$visible        = $be_Field['visible'];
		$tabindex      = $be_Field['orderNumber'];
		$rTableName		= $be_Field['rTableName'];
		$rFieldName		= $be_Field['rFieldName'];
		$rSourceTableName = $be_Field['rSourceTableName'];
		$className = $be_Field['className'];
		$phpCode = $be_Field['phpCode'];
		$rSourceLinkField = $be_Field['rSourceLinkField'];
		$rDisplayFields = $be_Field['rDisplayFields'];
		$rSearchViewId  = $be_Field['rSearchViewId'];
		$width          = $be_Field['width'];
		$height         = $be_Field['height'];
		
		$readonly       = false;
		$fieldHtml      = '';

        $fieldAttributeUnique = 'fieldAttributeUnique="' . $this->viewId . '_' . $name . '_' . $displayName . '"';
		
		if($name == $this->parentContent_rFieldName)
			$value = $this->parentItemId;
		
		switch ($fieldType)
		{
			case 1: //text
				$readonly = !$displayType?' readonly ':'';
                $attr = ($name == 'id' && $displayName=='' && $fieldType==1 && $displayType==0)
                    ? 'primaryIdfield'.$this->viewId.'="true" parentId'.$this->viewId
                    : '';
				if($visible)
                {
                    if($displayType==2){//readonly if value
                        $readonly = (strlen($value)>0)?' readonly ':'';
                    }
                    $fieldHtml = '<input type="text" name="view['.$fieldId.']" id="'.$fieldId.'" value="'.htmlspecialchars($value).'" '.$attr.' size="'.$width.'" '.$readonly.' '.($name=='title'?'class="pageTitleField"':'').' '.$fieldAttributeUnique.'  />';
                }
				else
				{
					$fieldHtml = '<input type="hidden" class="' . $className . '" name="view['.$fieldId.']" id="'.$fieldId.'" value="'.$value.'" '.$attr.'  '.$fieldAttributeUnique.' />';
				}
				break;

			case 2: //textarea
				$fieldHtml = '<textarea name="view['.$fieldId.']" id="'.$fieldId.'" cols="'.$width.'" rows="'.$height.'"  '.$fieldAttributeUnique.'>'.$value.'</textarea>';
				break;

			case 3: //FCKEditor
				$value = appUrl::CMSConstantsToValues($value);

				$fieldHtml='<textarea id="'.$fieldId.'" class="' . $className . '" name="view['.$fieldId.']" cols="73" rows="13" '.$fieldAttributeUnique.'>'.htmlspecialchars($value).'</textarea>
							<input type="button" value="'.$lang['EDIT'].'" onclick="fckPopUp.open('.$fieldId.','.$width.','.$height.');"  class="button" style="float:right;margin-top:5px;">
							<a href="#" onclick="$(\'#'.$fieldId.'\').insertAtCaret(\'<br/>\');return false;">br</a>&nbsp;&nbsp;
							<a href="#" onclick="$(\'#'.$fieldId.'\').insertAtCaret(\'<p></p>\');return false;">p</a>&nbsp;&nbsp;
							<a href="#" onclick="$(\'#'.$fieldId.'\').insertAtCaret(\'<img src=&#34;http://www.&#34; />\');return false;">img</a>&nbsp;&nbsp;
							<a href="#" onclick="$(\'#'.$fieldId.'\').insertAtCaret(\'<a href=&#34;http://www.&#34; target=&#34;_blank&#34;>link</a>\');return false;">link</a>&nbsp;&nbsp;
							<a href="#" onclick="$(\'#'.$fieldId.'\').insertAtCaret(\'<span style=&#34;color: rgb(0, 0, 0);&#34;>text</span>\');return false;">text</a>
							';
				
				break;

			case 4: //input type=date
				if($displayType==1)
				{
					if($required && (!$value || $value=='0000-00-00 00:00:00'))
					{
						$timestamp = time();
						$date = date("d-m-Y",$timestamp);
					}
					elseif($value && $value!='0000-00-00 00:00:00')
					{
						$timestamp = strtotime($value);
						$date = date("d-m-Y",$timestamp);
					}
					else 
						$date = '';
					

					$fieldHtml = '<input type="text" name="view['.$fieldId.']" id="'.$fieldId.'" value="'.$date.'" size="'.$width.'" maxlength="'.$width.'" readonly '.$fieldAttributeUnique.' /><img src="webcontent/img/calendar.gif"  onclick="displayCalendar(document.getElementById(\''.$fieldId.'\'),\'dd-mm-yyyy\',this);" style="margin-bottom:-6px;" />&nbsp;&nbsp;';
				}
				if($displayType==2)
				{
                    if($required && (!$value || $value=='0000-00-00 00:00:00'))
                    {
                        $timestamp = time();
                        $date = date("d-m-Y",$timestamp);
                        $hour = date("H",$timestamp);
                        $min  = date("i",$timestamp);
                    }
                    elseif($value && $value!='0000-00-00 00:00:00')
                    {
                        $timestamp = strtotime($value);
                        $date = date("d-m-Y",$timestamp);
                        $hour = date("H",$timestamp);
                        $min  = date("i",$timestamp);
                    }
                    else{
                        $min  = $hour = $date = '';
                    }

					$fieldHtml = '<input type="text" name="view['.$fieldId.']" id="'.$fieldId.'" value="'.$date.'" size="'.$width.'" maxlength="'.$width.'" readonly '.$fieldAttributeUnique.' /><img src="webcontent/img/calendar.gif"  onclick="displayCalendar(document.getElementById(\''.$fieldId.'\'),\'dd-mm-yyyy\',this);" style="margin-bottom:-6px;" />&nbsp;&nbsp;';

					$fieldHtml.= '<select name="view['.$fieldId.'h]" id="'.$fieldId.'h"/>';
                    $fieldHtml.= '<option value=""> </option>';
					for($i=0;$i<24;$i++)
					{
						$pr = $i<10?$pr='0':'';
						if($i==$hour and $hour!='')
							$fieldHtml.= '<option value="'.$i.'" selected>'.$pr.$i.'</option>';
						else
							$fieldHtml.= '<option value="'.$i.'">'.$pr.$i.'</option>';
					}
					$fieldHtml.='</select>';

					$fieldHtml.= '<select name="view['.$fieldId.'m]" id="'.$fieldId.'m"/>';
                    $fieldHtml.= '<option value=""> </option>';
					for($i=0;$i<60;$i++)
					{
						$pr = $i<10?$pr='0':'';
						if($i==$min && $min!='')
							$fieldHtml.= '<option value="'.$i.'" selected>'.$pr.$i.'</option>';
						else
							$fieldHtml.= '<option value="'.$i.'">'.$pr.$i.'</option>';
					}
					$fieldHtml.='</select>';
				}
				elseif($displayType==3)
				{
					$date = $value[0]?date("d-m-Y",strtotime($value[0])):'';

					$date_s = $value[1]?date("d-m-Y",strtotime($value[1])):'';

					$fieldHtml = $lang['FROM'].':<input type="text" name="view['.$fieldId.'][]" id="'.$fieldId.'" value="'.$date.'" size="'.$width.'" maxlength="'.$width.'" /><img src="webcontent/img/calendar.gif" onclick="displayCalendar(document.getElementById(\''.$fieldId.'\'),\'dd-mm-yyyy\',this);" style="margin-bottom:-6px;" />&nbsp;&nbsp;';
					$fieldHtml.= $lang['TO'].':<input type="text" name="view['.$fieldId.'][]" id="'.$fieldId.'_s" value="'.$date_s.'" size="'.$width.'" maxlength="'.$width.'"  /><img src="webcontent/img/calendar2.gif"  onclick="displayCalendar(document.getElementById(\''.$fieldId.'_s\'),\'dd-mm-yyyy\',this);" style="margin-bottom:-6px;" />&nbsp;&nbsp;';
				}
				break;

			case 5: //radio button
				break;
			case 6: //check box
				$checked = $value==1?' checked ':'';
				$fieldHtml = '<input type="checkbox" name="view['.$fieldId.']" id="'.$fieldId.'" '.$checked.' />';
				break;

			case 7: //file
                $type = (isset($be_Field_defaultValue) && $displayType == 1)?$be_Field_defaultValue:"";
                $value = (isset($be_Field_defaultValue) && $displayType == 1 && $be_Field_defaultValue == $value)?"":$value;
                $imagesize = $displayType == 2?'imgsize="'.$be_Field['rFieldName'].'"':'';
                $closeEditor = $displayType == 2?'true':'false';
                $fieldHtml = '<div><input type="text" name="view['.$fieldId.']" id="'.$fieldId.'" class="'.$imagesize.'" value="'.appUrl::CMSConstantsToValues($value).'" readonly fieldcode="'.$this->viewId.'_'.$name.'" '.$imagesize.' size="'.$width.'" '.$fieldAttributeUnique.'>&nbsp;&nbsp;';
                $viewfile  = !$value?'style="visibility:hidden;"':'';
                $fieldHtml.= '</div><div class="fileFieldContainer">';
                $fieldHtml.= '<input type="button" id="'.$fieldId.'_viewAttached" value="'.$lang['VIEW'].'" onclick="window.open(document.getElementById('.$fieldId.').value,\'_blank\');" class="button" '.$viewfile.' fieldcode="'.$this->viewId.'_'.$name.'_viewAttached">&nbsp;&nbsp;';
                $fieldHtml.= '<input type="button" id="'.$fieldId.'_deleteAttached" value="'.$lang['CLEAR'].'" onclick="document.getElementById('.$fieldId.').value=\'\';document.getElementById(\''.$fieldId.'_viewAttached\').style.visibility=\'hidden\';"  class="button" fieldcode="'.$this->viewId.'_'.$name.'_deleteAttached">&nbsp;&nbsp;';
                $fieldHtml.= '<input type="button" id="'.$fieldId.'_addAttached" value="'.$lang['BROWSE'].'..." onclick="fileManager.imageProcessingOpen('.$fieldId.', '.$closeEditor.', \''.$type.'\');"  class="button" fieldcode="'.$this->viewId.'_'.$name.'_addAttached">
                              </div>';
                break;

			case 8: //Link
				$fieldHtml = '<input type="text" name="view['.$fieldId.']" id="'.$fieldId.'" value="'.appUrl::CMSConstantsToValues($value).'" size="'.$width.'" '.$fieldAttributeUnique.'>&nbsp;&nbsp;
							  <div class="linkFieldContainer">';
				$fieldHtml.= '<input type="button" id="'.$fieldId.'_deleteAttached" value="'.$lang['CLEAR'].'" onclick="document.getElementById('.$fieldId.').value=\'\'"  class="button">&nbsp;&nbsp;';
				$fieldHtml.= '<input type="button" id="'.$fieldId.'_addAttached" value="'.$lang['BROWSE'].'..." onclick="searchBox.open(\'ViewController\', \'viewBuild\', {viewId:'.$rSearchViewId.',fieldId:'.$fieldId.',searchType:\'linkField\',open:1});"  class="button">
							  </div>';
				break;

			case 9: //internal page
				$fieldHtml = '<input type="text" name="view['.$fieldId.']" id="'.$fieldId.'" value="'.$value.'" size="'.$width.'">&nbsp;&nbsp;';
				$fieldHtml.= '<input type="button" id="'.$fieldId.'_deleteAttached" value="'.$lang['CLEAR'].'" onclick="document.getElementById('.$fieldId.').value=\'\'"  class="button">&nbsp;&nbsp;';
				$fieldHtml.= '<input type="button" id="'.$fieldId.'_addAttached" value="'.$lang['BROWSE'].'..." onclick="searchBox.open(\'ViewController\', \'viewBuild\', {viewId:'.$rSearchViewId.',fieldId:'.$fieldId.',searchType:\'internalPage\',open:1});"  class="button">';

				break;

			case 10: //customize field
				require_once(BACKEND_PATH.'libs/Custom/'.$rSourceTableName.'.php');
				$Controller =new $rSourceTableName();

                if (property_exists($rSourceTableName, 'fieldId'))
                    $Controller->fieldId = $fieldId;
                if (property_exists($rSourceTableName, 'viewId'))
                    $Controller->viewId = $this->viewId;

                $additionalParams = explode("[&]", $rDisplayFields);
                $result = $Controller->$rSourceLinkField($value, $additionalParams);
                if(is_array($result))
				{
					$fieldHtml = $result['html'];
					$this->fieldJs.= $result['js'];
				}
				else
				{
					$fieldHtml = $result;
				}

				//$this->fieldJs = '';
				break;

			case 11: //customize field for search
				require_once(BACKEND_PATH.'libs/Custom/'.$rSourceTableName.'.php');
				$Controller =new $rSourceTableName();
				$result = $Controller->$rSourceLinkField($fieldId,$value);
				if(is_array($result))
				{
					$fieldHtml = $result['html'];
                    if(isset($result['js']))
					    $this->fieldJs.= $result['js'];
				}
				else 
				{
					$fieldHtml = $result;
				}
				break;
			
			case 12:
				$fieldHtml = '<input type="text" name="view['.$fieldId.']" id="'.$fieldId.'" value="'.htmlspecialchars($value).'" size="'.($value?$width:'90').'" '.($value?' readonly ':'').' onkeyup="translitPageName2PageCode(this.value, this.id);" '.$fieldAttributeUnique.' />';
				$fieldHtml .= $value?'<a href="javascript:void(0);" class="locked" id="eyePageCode" onclick="pageCodeFieldAccess(this, '.$fieldId.')"></a>':'';
				$this->fieldJs .= $value?'':'setTransilt2PageTitleField('.$fieldId.');';

				break;
				
			case 13:
                if (!Context::SiteSettings()->multiLanguage())
                {
					$fieldHtml = '<input type="hidden" name="view['.$fieldId.']" id="'.$fieldId.'" value="'.$value.'" '.$fieldAttributeUnique.' />';
					break;
                }
			
                $db = DB::getInstance();//use Languages class

                $query = "  SELECT be_Languages.* FROM be_Languages
                            INNER JOIN be_WebsiteLanguages
                              ON be_WebsiteLanguages.langId = be_Languages.id
                            WHERE be_WebsiteLanguages.websiteId = ".Context::SiteSettings()->getSiteIdFromSession()."
                            ORDER BY be_Languages.priority";
                if(!$db->query($query))
				{
					//log error
					break;
				}
				$languages = $db->result;

				if($this->viewType!=5)
                {
                    $relationId = '';
                    $addRelatedContentByCopy = false;
                    $addRelatedContentBySearch = false;

                    $relationsLangsIDs = array();
                    if( is_array($value['relations']) && count($value['relations'])>0)
                    {
                        $relationId = $value['relations'][0]['relationId'];
                        foreach ($value['relations'] as $item)
                            $relationsLangsIDs[] = $item['langId'];
                    }
                }
                else
                {
                    $fieldHtml = '<select name="view['.$fieldId.'][value]" id="'.$fieldId.'" class="currentlanguage" onchange="buildDropDownSelectBox('.$this->viewId.',true);" style="width:'.$width.';">';
                    foreach ($languages as $item)
                        $fieldHtml.= '<option value="'.$item['id'].'" '.($item['id']==$value['value']?' selected ':'').'>'.$item['code'].'</option>';
                    $fieldHtml.= '</select>';
                    break;
                }
        		
				if(is_array($value) && isset($value['copyContent']) && $value['copyContent'] )
            	{
            		$fieldHtml = '<select name="view['.$fieldId.'][value]" id="'.$fieldId.'" class="currentlanguage" onchange="buildDropDownSelectBox('.$this->viewId.',true);" style="width:'.$width.';">';
            		
            		if(count($relationsLangsIDs) > 0)
            		{
                		$langSelected = false;
                		foreach ($languages as $item)
                		{
                			$optionStatus = '';
                			if(in_array($item['id'],$relationsLangsIDs))
                			{
                				$optionStatus = ' disabled ';
                			}
                			elseif(!$langSelected)
                			{
                				$langSelected = true;
                				$optionStatus = ' selected ';
                			}
                			
                        	$fieldHtml.= '<option value="'.$item['id'].'" '.$optionStatus.'>'.$item['code'].'</option>';
                		}
            		}
            		else
            			foreach ($languages as $item)
	                   		$fieldHtml.= '<option value="'.$item['id'].'">'.$item['code'].'</option>';

            	}
				elseif(is_array($value) && isset($value['copyContentLang']) && $value['copyContentLang'] )
            	{
            		$fieldHtml = '<select disabled style="width:'.$width.';">';
            		foreach ($languages as $item)
                    	$fieldHtml.= '<option value="'.$item['id'].'" '.($item['id']==$value['value']?' selected ':'').'>'.$item['code'].'</option>';
                    $fieldHtml.= '<input type="hidden" name="view['.$fieldId.'][value]" id="'.$fieldId.'" value="'.$value['value'].'" class="currentlanguage" />';
            	}
            	elseif(!$this->itemId)
				{
					$fieldHtml = '<select name="view['.$fieldId.'][value]" id="'.$fieldId.'" class="currentlanguage" onchange="relatedItemsObj.languagesVariations(this.value); buildDropDownSelectBox('.$this->viewId.',true);"  style="width:'.$width.';float:left;">';
            		foreach ($languages as $item)
                    	$fieldHtml.= '<option value="'.$item['id'].'">'.$item['code'].'</option>';
                    	
                    $languagesToCopy = '<div class="languagesToCopyList">
                    						<fieldset>
   												<legend>'.$lang['COPY_CONTENT_TO_NEXT_LANGS'].'</legend>';
                    $i=0;
                    foreach ($languages as $item)
                    {
                    	$languagesToCopy.= '<div id="item_'.$fieldId.'_'.$item['id'].'" class="item '.($i==0?'hidden':'visible').'"><input type="checkbox" name="view['.$fieldId.'][languages][]" id="'.$fieldId.'_'.$item['id'].'" value="'.$item['id'].'" class="languageCheckBox" '.($i==0?'':'checked').' >'.$item['code'].'</div>';
                    	$i++;
                    }
                    
                    $languagesToCopy.= '</fieldset></div>';

                    include_once(FRAMEWORK_PATH."system/helper/Guid.php");
                    $relationId = Guid::Generate();
                    $addRelatedContentBySearch = true;
				}
            	else
            	{
            		$fieldHtml = '<select name="view['.$fieldId.'][value]" id="'.$fieldId.'" class="currentlanguage" onchange="buildDropDownSelectBox('.$this->viewId.',true);" style="width:'.$width.';">';

            		foreach ($languages as $item)
                    	$fieldHtml.= '<option value="'.$item['id'].'" '.($item['id']==$value['value']?' selected ':'').' '.( $this->itemId && in_array($item['id'],$relationsLangsIDs) && $item['id']!=$value['value']?' disabled ':'').'>'.$item['code'].'</option>';

                    $addRelatedContentByCopy = true;
					$addRelatedContentBySearch = true;
            	}
            	
            	if(!$relationId){
                    include_once(FRAMEWORK_PATH."system/helper/Guid.php");
            		$relationId = Guid::Generate();
                }
            	
            	$fieldHtml.= '</select>';
                if(isset($languagesToCopy))
                    $fieldHtml.=$languagesToCopy;
        		$fieldHtml.='<input type="hidden" name="view['.$fieldId.'][relationId]" id="relationIdHiddenField" value="'.$relationId.'" />';
        		$dialogHtml='
        					<div class="relatedContentItems">
								<table id="relatedContentList" class="listDcTable">
									<tbody>
    								<tr>
    									<th width="46">'.$lang['ACTIONS'].'</th><th width="54">'.$lang['LANG'].'</th><th>'.$lang['NAME'].'</th>
    								</tr>';
       			if(is_array($value['relations']) && count($value['relations'])>0)
       			{
       				$i = 1;
					foreach ($value['relations'] as $page)
					{
						if($page['id']!=$this->itemId)
						{
							$dialogHtml.= '	<tr>
			        							<td>
			        								<img onclick="relatedItemsObj.relatedContentItemEdit('.$page['id'].','.$this->viewId.');" title="'.$lang['EDIT'].'" src="webcontent/img/reply.gif" class="cursor" border="0" />
			        								<img onclick="relatedItemsObj.deletePageRelation('.$page['id'].','.$this->viewId.',this.parentNode.parentNode.rowIndex);" title="'.$lang['DELETE'].'" src="webcontent/img/item_delete.gif" class="cursor" border="0" />
			        							</td>
			        							<td>'.$page['langName'].'</td>
			        							<td>'.$page['title'].'</td>
		        							</tr>';
							$i++;
						}
					}
       			}
       			$this->fieldJs .= 'document.getElementById("itemRelationsLink").style.visibility = "visible";';
                if(MULTI_SITE)
                    $this->fieldJs .= 'document.getElementById("itemCopyButton").style.visibility = "visible";';
        		$dialogHtml.= '	</tbody>
        						</table>
                			</div>';

        		$dialogHtml.= '<div style="text-align:center;padding-top:6px;">';
                if($addRelatedContentByCopy)
        			$dialogHtml.= '<input onclick="viewDataObject'.$this->viewId.' = new ViewDataObject('.$this->viewId.',\'general\'); 
        												navigation.sendRequest(\'ViewController\',\'viewBuild\',{viewId:'.$this->viewId.',itemId:'.$this->itemId.',copyRelatedContent:1});" value="'.$lang['ADD_RELATED_CONTENT'].'" type="button" class="button"/>&nbsp;&nbsp;&nbsp;';
                
				if($addRelatedContentBySearch)
	        		$dialogHtml.= '<input onclick="relatedItemsObj.openSearchForm('.$rSearchViewId.');" value="'.$lang['SEARCH_RELATED_CONTENT'].'" type="button" class="button"/>';

	        	$dialogHtml.= '</div>
							</div>';
				
				$dialogHtml = addslashes(str_replace(array("\r\n", "\n", "\r"), "", $dialogHtml));

                $copyHtml = '<div class="copyContent"><input type="radio" checked="checked" name="siteMode" value="0" /><label>' . $lang['COPY_ON_ALL_SITES'] . '</label><input type="radio" name="siteMode" value="1" /><label>' . $lang['COPY_ON_SELECTED_SITES'] . '</label>';

                $query = "SELECT id, name
                          FROM be_WebSites
                          WHERE id != '" . Context::SiteSettings()->getSiteIdFromSession() . "'
                          ORDER BY name";
                Context::DB()->query($query);

                $copyHtml .= '<div class="siteContainer">';
                foreach(Context::DB()->result as $website)
                {
                    $copyHtml .= '<div><input type="checkbox" siteId="' . $website['id'] . '"/><label>' . $website['name'] . '</label></div>';
                }
                $copyHtml .= "</div>";
                $copyHtml .= '<button id="copySingleButton" onclick="copySingle(' . $this->viewId . ', ' . $this->itemId . ');" class="button copyButton">' . $lang['COPY_ITEM'] . '</button></div><div id="resultCopy"></div>';

                if(MULTI_SITE)
                    $this->fieldJs .= 'document.getElementById(\'copyContentPopUpObj\').innerHTML = \''.$copyHtml.'\'; changeCopyOption();';

				$this->fieldJs .= 'document.getElementById(\'relatedContentPopUp\').innerHTML = \''.$dialogHtml.'\';';
				$this->fieldJs .= 'relatedItemsObj = new relatedItems('.($this->itemId?$this->itemId:0).','.$fieldId.',\''.$relationId.'\');';
				
                break;

			case 29://tree
				$parents = array(0);
				$listId  = 1;

				switch ($displayType)
				{
					case 1 : $treeType = 'menu';$rootId  = $value; 	break;
					case 2 : $treeType = 'catalog';$rootId  = $value; break;
					case 3 : $treeType = 'listBox';$rootId = $availableValues;break;
				}

				if(trim($rSourceTableName) != '')
				{
					//customized Tree
					require_once(BACKEND_PATH.'libs/Custom/'.$rSourceTableName.'.php');
					$treeType = 'tree';
					$rootId = 0;
					$tree = new $rSourceTableName(DB::getInstance(), $rootId, $rTableName);
					$items	= $tree->getItems();
					$className = $rSourceTableName;
				}
				else
				{
					$tree 	 = new TREE(DB::getInstance(), $rootId, $rTableName);
					$items   = $tree->getItems();
					$className = 'TREE';
				}

				if($displayType==1 || $displayType==2)
				{
					$fieldHtml = '<div class="dhtmlTreeContainer" id="dhtmlTreeContainer">
									<ul id="dhtmlgoodies_tree2" class="dhtmlgoodies_tree">
										<li id="node'.$tree->rootId.'" noDrag="true" noSiblings="true" noRename="true" noDelete="true" isRoot="true" itemImage="root.gif">';
					$fieldHtml.= 			$tree->buildTreeNodes($items,$tree->rootId,1);
					$fieldHtml.= '		</li>
								   	</ul>
								   	<input type="hidden" name="view['.$fieldId.']" id="'.$fieldId.'" value="'.$tree->rootId.'" treeField'.$this->viewId.'>
								   	<input type="hidden" value="'.$rTableName.'" treeTableField'.$this->viewId.'>
								   	<input type="hidden" value="'.$className.'" treeClassField'.$this->viewId.'>
								   	<input type="hidden" name="view['.$fieldId.'nodeOrders]" id="'.$fieldId.'nodeOrders" value="">
								   </div>';
					$this->fieldJs='treeObj = new JSDragDropTree();
									treeObj.setTreeId("dhtmlgoodies_tree2");
									treeObj.setMaximumDepth(7);
									treeObj.setMessageMaximumDepthReached("Maximum depth reached");
									treeObj.itemViewId = '.$rSearchViewId.';
									treeObj.moduleViewId = '.$availableValues.';
									treeObj.fieldId = '.$fieldId.';
									treeObj.menuId = '.$tree->rootId.';
									treeObj.treeType = \''.$treeType.'\';
									treeObj.initTree();
									treeObj.expandAll();
									document.getElementById(\''.$fieldId.'nodeOrders\').value=treeObj.getNodeOrders();';
				}
				elseif($displayType ==  3)
				{
					$tree->selectedItem = isset($value) && !is_array($value)?$value:0;

					$fieldHtml = '<select name="view['.$fieldId.']" id="'.$fieldId.'">';
					$fieldHtml.= $required?'':'<option value=""></option>';
					$fieldHtml.= $tree->buildDdNodes($items,$tree->rootId);
					$fieldHtml.= '</select>';
				}
				
				break;

			case 30: //Drop down select box, ajax dynamic-list
				switch ($displayType)
				{
					case 1:
						
						$fieldHtml = '<select name="view['.$fieldId.']" id="'.$fieldId.'"  '.(Context::SiteSettings()->multiLanguage()?'class="multiLangSelect"':'').' style="width:'.$width.'" '.$fieldAttributeUnique.' >';
						$fieldHtml.= !$required?'<option value=""></option>':'';
						$SelectBoxsData = '';

						if(is_array($value) && count($value)>0)
						{
							foreach ($value as $item)
							{
								if( Context::SiteSettings()->multiLanguage() &&	isset($item['langId']) && isset($item['relationId']) )
								{
									$text = '';
									if(is_array($item['values']))
									{
										foreach ($item['values'] as $k=>$v)
											$text.= $v.' ';
									} else {
										$text = $item['value'];
									}
									
									$SelectBoxsData.= "[{$item['relatedField']},'{$text}',{$item['selected']},{$item['langId']},'{$item['relationId']}'],";
								}
								else 
								{
									$fieldHtml.= '<option value="'.$item['relatedField'].'" '.($item['selected']==1?' selected ':'').'>';
									if(is_array($item['values']))
									{
										foreach ($item['values'] as $k=>$v)
											$fieldHtml.= $v.' ';
									} else {
										$fieldHtml.= $item['value'];
									}
									$fieldHtml.= '</option>';
								}
							}
						}
						$fieldHtml.= '</select>';
						if(Context::SiteSettings()->multiLanguage() && $SelectBoxsData!='' && $this->viewType!=4)
						{
							$SelectBoxsData = substr($SelectBoxsData, 0, -1);
							$this->fieldJs .= " viewDropDownSelectBoxesData['$this->viewId']['$fieldId'] = [$SelectBoxsData];";
						}
						
						break;
					case 2:
						$fieldHtml = '<input type="hidden" id="'.$fieldId.'" name="view['.$fieldId.']" value="'.$value.'" '.$fieldAttributeUnique.'>';
						break;
					case 3:
                        $dlValue = '';
                        $dlText  = '';
						if(is_array($value) && count($value)>0)
						{
							foreach ($value as $item)
							{
								if($item['selected']==1)
								{
									$dlValue = $item['relatedField'];
									if(is_array($item['values']))
									{
										foreach ($item['values'] as $k=>$v)
											$dlText.= $v;
									} else {
										$dlText = $item['value'];
									}
									break;
								}
							}
						}
						$fieldHtml = '<input type="hidden" class="' . $className . '" name="view['.$fieldId.']" id="'.$fieldId.'" value="'.$dlValue.'" '.$fieldAttributeUnique.'>';
						$fieldHtml.= '<input type="text" id="text'.$fieldId.'" value="'.$dlText.'" style="position:relative; float:left; width:'.$width.'" onkeyup="dlField'.$fieldId.'.loadList(this.value,event);" onblur="dlField'.$fieldId.'.cancelInput();">
						<div id="inputHintBlock'.$fieldId.'" class="inputHintBlock" style="display:none">
						<div class="inputHintContainer">
						<div class="inputHintTop">&nbsp</div>
						<div id="inputHintCenter'.$fieldId.'" class="inputHintCenter">&nbsp</div>
						<div class="inputHintBottom">&nbsp</div>
						</div>
						</div>
						<div id="listContainer'.$fieldId.'" style="border:solid 1px #000; display:none;position:absolute;z-index:10;width:'.$width.'"></div>
						<div id="loaderAddWords" style="display:none;"></div>';

						$this->fieldJs .= 'dlField'.$fieldId.' = new DynamicList('.$fieldId.','.$fieldType.'); dlField'.$fieldId.'.required = '.$required.'; dlField'.$fieldId.'.handler = \''.$rSourceLinkField.'\';';
						break;
					case 4:
						if(is_array($value) && count($value)>0)
						{
							$fieldValue = '';
							$fieldText  = '';
							foreach ($value as $item)
							{
								if($item['selected']==1)
								{
									$fieldValue = $item['relatedField'];
									if(is_array($item['values']))
									{
										foreach ($item['values'] as $k=>$v)
											$fieldText.= $v;
									} else {
										$fieldText = $item['value'];
									}
									break;
								}
							}
						}
						$fieldHtml = '<input id="'.$fieldId.'" name="view['.$fieldId.']" value="'.$fieldValue.'" type="hidden" '.$fieldAttributeUnique.'><input id="text'.$fieldId.'" value="'.$fieldText.'" size="'.$width.'" readonly type="text">';
						break;
				}
				break;

			case 31: //Multiple select box
				if($displayType == 1)
				{
					$fieldHtml = '<select name="view['.$fieldId.'][]" id="'.$fieldId.'" multiple size="'.$height.'" style="width:'.$width.'px;" '.$fieldAttributeUnique.'>';
					if(is_array($value) && count($value)>0)
					{
						foreach ($value as $item)
						{
							$fieldHtml.= '<option value="'.$item['relatedField'].'">';
							if(is_array($item['values']))
							{
								foreach ($item['values'] as $k=>$v)
									$fieldHtml.= $v.' ';
							} else {
								$fieldHtml.= $item['value'];
							}
							$fieldHtml.= '</option>';
						}
					}
					$fieldHtml.= '</select>
									<div>
										<img src="webcontent/img/item_add.gif" 		onclick="mpField'.$fieldId.'.addItem();"	class="cursor" border="0" />
										<img src="webcontent/img/item_up.gif" 		onclick="mpField'.$fieldId.'.upOption();"	class="cursor" border="0" />
										<img src="webcontent/img/item_down.gif" 	onclick="mpField'.$fieldId.'.downOption();"	class="cursor" border="0" />
										<img src="webcontent/img/item_delete.gif" 	onclick="mpField'.$fieldId.'.removeItem();"	class="cursor" border="0" />
									</div>';
					$this->fieldJs .= 'mpField'.$fieldId.' = new MpFieldManager('.$rSearchViewId.','.$fieldId.','.$availableValues.');';
				}
				elseif($displayType == 2)
				{
					$fieldHtml = '<select name="view['.$fieldId.'][]" id="'.$fieldId.'" multiple size="'.$height.'" style="width:'.$width.'px;" tabindex="'.$tabindex.'" '.$fieldAttributeUnique.' >';
					if(is_array($value) && count($value)>0)
					{
						foreach ($value as $item)
						{
							$fieldHtml.= '<option value="'.$item['relatedField'].'">';
							if(is_array($item['values']))
							{
								foreach ($item['values'] as $k=>$v)
									$fieldHtml.= $v.' ';
							} else {
								$fieldHtml.= $item['value'];
							}
							$fieldHtml.= '</option>';
						}
					}
					$fieldHtml.= '</select>
									<div>
										<img src="webcontent/img/item_up.gif" 		onclick="mpField'.$fieldId.'.upOption();"	class="cursor" border="0" />
										<img src="webcontent/img/item_down.gif" 	onclick="mpField'.$fieldId.'.downOption();"	class="cursor" border="0" />
										<img src="webcontent/img/item_delete.gif" 	onclick="mpField'.$fieldId.'.removeItem();"	class="cursor" border="0" />
									</div>';

					$this->fieldJs .= 'mpField'.$fieldId.' = new MpFieldManager('.$rSearchViewId.','.$fieldId.','.$availableValues.');';
					$fieldHtml.= '<input type="text" id="text'.$fieldId.'" value="'.$dlText.'" style="position:relative; width:'.$width.'" onkeyup="dlField'.$fieldId.'.loadList(this.value,event);" tabindex="'.($tabindex+1).'">
									<div id="inputHintBlock'.$fieldId.'" class="inputHintBlock" style="display:none">
									<div class="inputHintContainer">
									<div class="inputHintTop">&nbsp</div>
									<div id="inputHintCenter'.$fieldId.'" class="inputHintCenter">&nbsp</div>
									<div class="inputHintBottom">&nbsp</div>
									</div>
									</div>
									<div id="listContainer'.$fieldId.'" style="border:solid 1px #000; display:none;position:absolute;z-index:10;width:'.$width.'"></div>
									<div id="loaderAddWords" style="display:none;"></div>';

					$this->fieldJs .= 'dlField'.$fieldId.' = new DynamicList('.$fieldId.','.$fieldType.');
															dlField'.$fieldId.'.relatedMpField = mpField'.$fieldId.';
															dlField'.$fieldId.'.required = '.$required.';
															dlField'.$fieldId.'.handler = \''.$rSourceTableName.'\';
															dlField'.$fieldId.'.yesTabindex = '.($tabindex+2).';';
				}
				elseif($displayType == 3)
				{
					if(is_array($value) && count($value)>0)
					{
						foreach ($value as $item)
						{
							$fieldValue = $item['relatedField'];
							if(is_array($item['values']))
							{
								foreach ($item['values'] as $k=>$v)
									$fieldText.= $v;
							} else {
								$fieldText.= $item['value'];
							}
						}
					}
					$fieldHtml.= '<input type="hidden" name="view['.$fieldId.'][]" value="'.$fieldValue.'"><input type="text" value="'.$fieldText.'" size="'.$width.'" readonly>';
				}
				break;

			case 32: //complexManyToMany
				$fieldsArray   = 'Array(';
				$displayNames  = array();
				if(is_array($availableValues) && count($availableValues)>0)
				{
					foreach ($availableValues as $item)
					{
						$fieldsArray .= "'{$item['fieldId']}',";
						$displayNames[] = $item['displayName'];
					}
					$fieldsArray = substr($fieldsArray, 0, -1).')';
				}

				$fieldHtml = '
				<div id="dynamicContentResults'.$fieldId.'" class="dynamicContentResults" style="width:'.$width.'px; height:'.$height.'px;">
					<div id="DcResultsLoading'.$fieldId.'"></div>
						<table id="listDcTable'.$fieldId.'" class="listDcTable" onselect="return;"><tr>';
				if(is_array($displayNames) && count($displayNames)>0)
				{
					foreach ($displayNames as $dName)
					{
						$fieldHtml.= '<th>'.$dName.'</th>';
					}
				}

				if(is_array($value) && count($value)>0)
				{
					$i = 1;
					foreach ($value as $item)
					{
						$fieldHtml.= '<tr id="dcRow'.$i.'" onclick="dcField'.$fieldId.'.selectItem(this,'.$item['relatedField'].');" class="cursor">';

                        if ($item['values'] == '') die('Field type 32: In relative view: '.$rSearchViewId.', at least one field mast be set column "visibleInSearchResult" = 1');

                        foreach ($item['values'] as $k=>$v)
						{
					  		$fieldHtml.= '<td>';
					  		if($k == 'dateStartVisible') $v = date("d-m-Y",$v);
					  		if($k == 'visible') $v = $v==1?$lang['ACTIVE']:$lang['NOT_ACTIVE'];
					  		if(!$v) $v = '&nbsp;';
					  		$fieldHtml.=  appUrl::CMSConstantsToValues($v).'</td>';
					  	}
					  	$fieldHtml.= '<td><input type="hidden" name="view['.$fieldId.'][]" value="'.$item['relatedField'].'"></td>
					  				</tr>';
					  	$i++;
					}
					/* else {<img src="webcontent/img/item_up.gif" onclick="dcField'.$fieldId.'.moveItemUp(document.getElementById(\''.$i.'dcrow\'),document.getElementById(\''.$i.'dcrow\').rowIndex);" border=0/>
					$dContentTable .= '<tr><td colspan='.(count($displayNames)+1).'>No results found</td></tr>';
					}*/
				}

				$fieldHtml.= '</table></div>';
				$fieldHtml.='<div style="width:120px;float:left;">';
                $fieldHtml.=$displayType==3?'<img src="webcontent/img/Folder.gif" onclick="fileManager.Type = \'Image\';fileManager.open('.$fieldId.');fileManager.showLoadGalleryMenuItem = true;" title="'.$lang['LOAD_PHOTOGALLERY'].'" class="cursor" border="0" />':'';
                $fieldHtml.='	<img src="webcontent/img/reply.gif"       onclick="dcField'.$fieldId.'.openEditItem();"	title="'.$lang['EDIT'].'" 	class="cursor" border="0" />
                               	<img src="webcontent/img/item_up.gif"     onclick="dcField'.$fieldId.'.moveItem(-1);" 	title="'.$lang['UP'].'" 	class="cursor" border="0" />
                            	<img src="webcontent/img/item_down.gif"   onclick="dcField'.$fieldId.'.moveItem(1);"  	title="'.$lang['DOWN'].'" 	class="cursor" border="0" />'.
							($displayType!=4?'<img src="webcontent/img/item_delete.gif" onclick="dcField'.$fieldId.'.deleteItem();" 	title="'.$lang['DELETE'].'" class="cursor" border="0" />':'');
                $fieldHtml.='</div>';
				$fieldHtml.= '<input type="button" id="addDcItemButton'.$fieldId.'" value="'.$lang['ADD'].'" onclick="modalBox.open(\'ViewController\', \'viewBuild\', {viewId:'.$rSearchViewId.'});"  class="button" style="float:right;margin-top:5px;">';
				$this->fieldJs .= 'viewDataObject'.$rSearchViewId.' = new ViewDataObject('.$rSearchViewId.',\'dcItem\','.$fieldId.'); dcField'.$fieldId.' = new DcFieldManager('.$rSearchViewId.','.$fieldId.','.$fieldsArray.','.$displayType.');';
				break;

			case 33: //complexManyToOne
				$fieldsArray   = 'Array(';
				$displayNames  = array();
				
				$valueRelatedToList = isset($be_Field['valueRelatedToList']) ? $be_Field['valueRelatedToList'] : ''; //the value of fieldName field.
															 //Usually we use id for fieldName but when we need value of another field we use this value.
															 //For example imageId and it's translations in igotoworld

				if(is_array($availableValues) && count($availableValues)>0)
				{
					foreach ($availableValues as $item)
					{

						$fieldsArray .= "'{$item['fieldId']}',";
						$displayNames[] = $item['displayName'];
					}
					$fieldsArray = substr($fieldsArray, 0, -1).')';
				}

				$fieldHtml = '
				<div id="dynamicContentResults'.$fieldId.'" class="dynamicContentResults" style="height:'.$height.';">
					<div id="DcResultsLoading'.$fieldId.'"></div>
						<input type="hidden" id="'.$fieldId.'_valueRelatedToList" name="view['.$fieldId.'_valueRelatedToList]" value="'.$valueRelatedToList.'">
						<input type="hidden" id="'.$fieldId.'" '.$fieldAttributeUnique.'>
						<table id="listDcTable'.$fieldId.'" class="listDcTable" onselect="return;"><tr>';
				if(is_array($displayNames) && count($displayNames)>0)
				{
					foreach ($displayNames as $dName)
					{
						$fieldHtml.= '<th>'.$dName.'</th>';
					}
				}

				if(is_array($value) && count($value)>0)
				{
					$i = 1;
					foreach ($value as $item)
					{
						$fieldHtml.= '<tr id="dcRow'.$i.'" onclick="dcField'.$fieldId.'.selectItem(this,'.$item['relatedField'].');" class="cursor">';

                        if ($item['values'] == '') die('Field type 33: In relative view: '.$rSearchViewId.', at least one field mast be set column "visibleInSearchResult" = 1');

                        foreach ($item['values'] as $k=>$v)
						{

					  		$fieldHtml.= '<td>';
					  		if($k == 'dateStartVisible') $v = date("d-m-Y",$v);
					  		if($k == 'visible') $v = $v==1?$lang['ACTIVE']:$lang['NOT_ACTIVE'];
					  		if(	$k == 'defaultLang' || 
					  			$k == 'useWatermark' || 
					  			$k == 'isProportion' || 
					  			$k == 'showOnMap' || 
					  			$k == 'isMain' || 
					  			$k == 'showAddress') $v = $v==1?$lang['YES']:$lang['NO'];
					  		if(!$v) $v = '&nbsp;';
					  		$fieldHtml.=  appUrl::CMSConstantsToValues($v).'</td>';
					  	}
					  	$fieldHtml.= '<td><input type="hidden" name="view['.$fieldId.'][]" value="'.$item['relatedField'].'"></td>
					  				</tr>';
					  	$i++;
					}
				}

				$fieldHtml.= '</table></div>';
				$fieldHtml.='<div style="width:100px;float:left;">
					  			<img src="webcontent/img/reply.gif"       onclick="dcField'.$fieldId.'.openEditItem();"	title="'.$lang['EDIT'].'" 	class="cursor" border="0" />';
				
				if($rSourceLinkField!='')
				{
					$fieldHtml.='	<img src="webcontent/img/item_up.gif"     onclick="dcField'.$fieldId.'.moveItem(-1);" 	title="'.$lang['UP'].'" 	class="cursor" border="0" />
                            		<img src="webcontent/img/item_down.gif"   onclick="dcField'.$fieldId.'.moveItem(1);"  	title="'.$lang['DOWN'].'" 	class="cursor" border="0" />';
				}
				
				$fieldHtml.=($displayType!=4 && $displayType!=5)?'<img src="webcontent/img/item_delete.gif" onclick="dcField'.$fieldId.'.deleteItem();" 	title="'.$lang['DELETE'].'" class="cursor" border="0" />':'';
				$fieldHtml.='</div>';
				$fieldHtml.= ($displayType!=5?'<input type="button" value="'.$lang['ADD'].'" onclick="dcField'.$fieldId.'.openAddItem();"  class="button" style="float:right;margin-top:5px;">':'');
				$this->fieldJs .= 'viewDataObject'.$rSearchViewId.' = new ViewDataObject('.$rSearchViewId.',\'dcItem\','.$fieldId.'); dcField'.$fieldId.' = new DcFieldManager('.$rSearchViewId.','.$fieldId.','.$fieldsArray.','.$displayType.'); dcField'.$fieldId.'.rFieldName = \''.$rFieldName.'\'; dcField'.$fieldId.'.parentViewId = \''.$this->viewId.'\'; ';
				break;

		}
		$this->jsFieldTypesArray .= "['{$fieldId}',{$fieldType},{$validation},{$required}]";
		return $fieldHtml;
	}
}
?>