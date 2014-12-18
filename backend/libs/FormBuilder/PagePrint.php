<?php

class PagePrint extends PageBuilder 
{
	public function printPage()
	{
		global $lang;
		$html = $viewTitle;
		$html.= '<table width="100%">';
			foreach ($this->fields as $beField)
			{
				if($beField['visible'] == 1)
				{
					$html .= '
					<tr valign="top" id="'.$beField['fieldId'].'PrintFieldContainer">
						<td class="printFieldNameContainer">
							'.$beField['displayName'].':
						</td>
						<td class="PrintFieldHtmlContainer">
							'.$this->printField($beField).'
						</td>
					</tr>';
				}
			}
			$html.= '</table><a href="#" onclick="printBox.hideDiv();">'.$lang['CLOSE'].'</a>';
		return $html;
	}
	
	private function printField($be_Field)
	{
		global $lang;
		
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
		$oderNumber     = $be_Field['orderNumber'];
		$rTableName		= $be_Field['rTableName'];
		$rDisplayFields = $be_Field['rDisplayFields'];
		$rSearchViewId  = $be_Field['rSearchViewId'];
		$width          = $be_Field['width'];
		$height         = $be_Field['height'];
		
		$readonly       = false;
		$fieldHtml      = '';
		switch ($fieldType)
		{
			case 1: //text
				if($visible) 
					$fieldHtml = htmlspecialchars($value);
				break;
				
			case 2: //textarea
				$fieldHtml = $value;
				break;
				
			case 3: //FCKEditor
				$value = appUrl::CMSConstantsToValues($value);
				$fieldHtml= htmlspecialchars($value);
				break;
				
			case 4: //input type=date
				if($displayType==1)
				{
					$timestamp = $value=='0000-00-00 00:00:00'||!$value?time():strtotime($value);
					$date = date("d-m-Y",$timestamp);
					$fieldHtml = $date;
				}
				if($displayType==2)
				{
					$timestamp = $value=='0000-00-00 00:00:00'||!$value?time():strtotime($value);
					$date = date("d-m-Y",$timestamp);
					$hour = date("H",$timestamp);
					$min  = date("i",$timestamp);
					$fieldHtml = $date." | ".$hour.":".$min;
				}
				elseif($displayType==3)
				{
					$date = $value[0]?date("d-m-Y",strtotime($value[0])):'';
					
					$date_s = $value[1]?date("d-m-Y",strtotime($value[1])):'';
					
					$fieldHtml = $lang['FROM'].':'.$date.' - '.$lang['TO'].':'.$date_s;
				}
				break;
				
			case 5: //radio button
				break;
			case 6: //check box
				$checked = $value==1?' checked ':'';
				$fieldHtml = ' Active ';
				break;
				
			case 7: //file
				$fieldHtml = appUrl::CMSConstantsToValues($value);
				break;
				
			case 8: //Link
				$fieldHtml = appUrl::CMSConstantsToValues($value);
				break;
				
			case 9: //internal page
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
				
				$tree 	 = new TREE(DB::getInstance(), $rootId, $rTableName);
				$items   = $tree->getItems();
				
				
				if($displayType==1 || $displayType==2)
				{
					$fieldHtml = '<div class="dhtmlTreeContainer" id="dhtmlTreeContainer">
									<ul id="dhtmlgoodies_tree2" class="dhtmlgoodies_tree">
										<li id="node'.$tree->rootId.'" noDrag="true" noSiblings="true" noRename="true" noDelete="true" isRoot="true" itemImage="root.gif">';
					$fieldHtml.= 			$tree->buildTreeNodes($items,$tree->rootId,1);
					$fieldHtml.= '		</li>
								   	</ul>
								   	<input type="hidden" name="view['.$fieldId.']" id="'.$fieldId.'" value="'.$tree->rootId.'">
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
				if(is_array($value) && count($value)>0)
				{
					$dlValue = '';
					$dlText  = '';
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
				$fieldHtml.= $dlText;
				break;
				
			case 31: //Multiple select box
				if($displayType == 1)
				{
					$fieldHtml = '<select size="'.$height.'" style="width:'.$width.'px;">';
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
					$fieldHtml.= '</select>';
				}
				elseif($displayType == 2)
				{
					$fieldHtml = '<select multiple size="'.$height.'" style="width:'.$width.'px;">';
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
					$fieldHtml.= '</select>';
				}
				elseif($displayType == 3)
				{
					if(is_array($value) && count($value)>0)
					{
						foreach ($value as $item)
						{
							if(is_array($item['values']))
							{
								foreach ($item['values'] as $k=>$v)
									$fieldvalue.= $v;
							} else {
								$fieldvalue.= $item['value'];
							}
						}
					}
					$fieldHtml.= $fieldvalue;
				}
				break;
			
			case 32: //complexManyToMany
				$fieldsArray   = 'Array(';
				$displayNames  = array();
				if(is_array($availableValues) && count($availableValues)>0)
				{
					foreach ($availableValues as $item)
					{
						$fieldsArray .= $item['fieldId'].',';
						$displayNames[] = $item['displayName'];
					}
					$fieldsArray = substr($fieldsArray, 0, -1).')';
				}
				
				$fieldHtml = '
				<div id="dynamicContentResults'.$fieldId.'" class="dynamicContentResults" style="height:'.$height.';">
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
					  	foreach ($item['values'] as $k=>$v)
						{
					  		$fieldHtml.= '<td>';
					  		if($k == 'dateStartVisible') $v = date("d-m-Y",$v);
					  		if($k == 'visible') $v = $v==1?$lang['ACTIVE']:$lang['NOT_ACTIVE'];
					  		if(!$v) $v = '&nbsp;';
					  		$fieldHtml.=  $v.'</td>';
					  	}
					  	$fieldHtml.= '<input type="hidden" name="view['.$fieldId.'][]" value="'.$item['relatedField'].'">
					  				</tr>';
					  	$i++;
					}
				}
				$fieldHtml.= '</table></div>';
				break;
				
			case 33: //complexManyToOne
				$fieldsArray   = 'Array(';
				$displayNames  = array();
				if(is_array($availableValues) && count($availableValues)>0)
				{
					foreach ($availableValues as $item)
					{
						$fieldsArray .= $item['fieldId'].',';
						$displayNames[] = $item['displayName'];
					}
					$fieldsArray = substr($fieldsArray, 0, -1).')';
				}
				
				$fieldHtml = '
				<div id="dynamicContentResults'.$fieldId.'" class="dynamicContentResults" style="height:'.$height.';">
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
					  	foreach ($item['values'] as $k=>$v)
						{
					  		$fieldHtml.= '<td>';
					  		if($k == 'dateStartVisible') $v = date("d-m-Y",$v);
					  		if($k == 'visible') $v = $v==1?$lang['ACTIVE']:$lang['NOT_ACTIVE'];
					  		if(!$v) $v = '&nbsp;';
					  		$fieldHtml.=  $v.'</td>';
					  	}
					  	$fieldHtml.= '<input type="hidden" name="view['.$fieldId.'][]" value="'.$item['relatedField'].'">
					  				</tr>';
					  	$i++;
					}
				}
											
				$fieldHtml.= '</table></div>';
				break;
		}
		return $fieldHtml;
	}
}
?>