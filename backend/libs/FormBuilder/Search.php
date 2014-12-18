<?php
//Melnichuk Maxim
//Migrated from last version. Rewrited

class SEARCH
{
	var $objView;
	var $db;	
	
	function SEARCH(&$db, &$viewId)
	{
		$this->db		= &$db;
		$this->objView = new VIEW($this->db, $viewId, false);
	}
	function process($searchArray,$page)
	{
		/*=================================================================/*		
		   $searchArray = array ( fieldId   => "search Value" ,
								  fieldId_2 => "search Value2" , ... )								  										   
		 /*=================================================================*/
		$searchedTable = $this->objView->property['tblName'];
		$selectedFields='';
		$whereParams='';
		$linkedTables='';	
		
		//checking all fields of search views
		foreach ($this->objView->fields->getFieldList() as $fieldItem)
		{	//checking all posted values for search
			foreach ($searchArray as $searchFieldId => $searchFieldValue)
			{
				$used = 0;
				//posted field are founded in view field list
				if($searchFieldId == $fieldItem['fieldId'])
				{
					$used=1;
					//date field
					if($fieldItem['fieldType']==4)
					{
						if($fieldItem['participantSearch']==1 and is_array($searchFieldValue))
						{
							//editing format of date
							if(strlen($searchFieldValue[0])>0)
							{
								if(strtotime($searchFieldValue[0]) === false)
								{
									include_once(SITE_PATH.'vendors/Pear/Log.php');
									$logger = &Log::singleton('file', SITE_PATH.'logs/bo_errors.log');			
									$logger->log('Cannot convert recived From date with strtotime(). Date str: "'.$searchFieldValue[0].'".'.'file '.__FILE__.' line'.__LINE__);
								}
								else 
								{
									$timestamp = strtotime($searchFieldValue[0]);
						    		$searchFieldValue[0] = date("Y-m-d H:i",$timestamp);
						    		/*include_once(SITE_PATH.'vendors/Pear/Log.php');
									$logger = &Log::singleton('file', SITE_PATH.'logs/debug.log');			
									$logger->log('$searchFieldValue[0] = '.$searchFieldValue[0]. 'function return = '.date("d-m-Y H:i",$timestamp));*/
								}
							}
							if(strlen($searchFieldValue[1])>0)
							{
								if(strtotime($searchFieldValue[1]) === false)
								{
									include_once(SITE_PATH.'vendors/Pear/Log.php');
									$logger = &Log::singleton('file', SITE_PATH.'logs/bo_errors.log');			
									$logger->log('Cannot convert recived To date with strtotime(). Date str: "'.$searchFieldValue[1].'".'.'file '.__FILE__.' line'.__LINE__);
								}
								else 
								{
									$timestamp = strtotime($searchFieldValue[1]);
						    		$searchFieldValue[1] = date("Y-m-d H:i",$timestamp);
								}
							}
							
							if(strlen($searchFieldValue[0])>0 and strlen($searchFieldValue[1])>0)
							{
								if(strlen($whereParams)>0)
										$whereParams .= " and ";								
								$whereParams .= "($searchedTable.".$fieldItem['fieldName']. " > '{$searchFieldValue[0]}' and $searchedTable.".$fieldItem['fieldName']. " < '{$searchFieldValue[1]}')";
							}
							else
							{
								//building where statement for From date
								if(strlen($searchFieldValue[0])>0)
								{
									if(strlen($whereParams)>0)
										$whereParams .= " and ";								
									$whereParams .= "$searchedTable.".$fieldItem['fieldName']. " > '{$searchFieldValue[0]}'";
								}	
								//building where statement for To date						
								if(strlen($searchFieldValue[1])>0)
								{
									if(strlen($whereParams)>0)
										$whereParams .= " and ";
									$whereParams .= "$searchedTable.".$fieldItem['fieldName']. " < '{$searchFieldValue[1]}'";
								}
							}
						}
						if($fieldItem['visibleInSearchResult']==1)
						{
							$selectedFields .= ", $searchedTable.".$fieldItem['fieldName'];
						}
					}
					elseif($fieldItem['fieldType']==11)
					{
						require_once(BACKEND_PATH.'libs/Custom/'.$fieldItem['rSourceTableName'].'.php');
						$Controller = new $fieldItem['rSourceTableName']();
						$searchFieldValue['processed'] = 1;
                        if(method_exists($Controller,'assignParameters'))
                            $Controller->assignParameters($searchedTable, $fieldItem);
						$ControllerResult = $Controller->$fieldItem['rSourceLinkField']($fieldItem['fieldId'],$searchFieldValue);

						if($fieldItem['participantSearch']==1)
						{
							if(strlen($whereParams)>0 && strlen($ControllerResult['whereParams'])>0)
								$whereParams .= " and ";
								
							$linkedTables.= $ControllerResult['linkedTables'];
							
							$whereParams .= isset($ControllerResult['whereParams'])?$ControllerResult['whereParams']:'';
							
							if(isset($ControllerResult['group']) && $ControllerResult['group']!='')
								$group = $ControllerResult['group'];
								
							if(isset($ControllerResult['order']) && $ControllerResult['order']!='')
								$order = $ControllerResult['order'];

						}
						if($fieldItem['visibleInSearchResult']==1)
						{
							$selectedFields .= $ControllerResult['selectedFields'];
						}
					}
					elseif($fieldItem['fieldType']<29)
					{//if simple field
						if($fieldItem['participantSearch']==1 and strlen($searchFieldValue)>0)
						{
							if(strlen($whereParams)>0)
								$whereParams .= " and ";
								
							//building where statement
							if(strrpos($searchFieldValue,'*')===false)
								$whereParams .= "$searchedTable.".$fieldItem['fieldName']. " in ('$searchFieldValue')";
							else 
							{//search by mask
								$searchFieldValue = str_replace('*','%', $searchFieldValue);
								$whereParams .= "$searchedTable.".$fieldItem['fieldName']. " like '$searchFieldValue'";
							}
						}
						if($fieldItem['visibleInSearchResult']==1)
						{
							$selectedFields .= ", $searchedTable.".$fieldItem['fieldName'];
						}
					}
					elseif($fieldItem['fieldType']==30 or $fieldItem['fieldType']==29)
					{//listbox					    	
						$relatedTable=$fieldItem['rTableName'];												
						if(strpos($relatedTable," "))
						{							
							$startPosition = strpos($relatedTable," ")+1;
							$charsCount = strlen($relatedTable) - $startPosition;
							$relatedTableAlias = substr($relatedTable,$startPosition,$charsCount);							
						}
						else 
							$relatedTableAlias = $relatedTable;							
					
						if($fieldItem['participantSearch']==1 and strlen($searchFieldValue)>0)
						{							
							if(strlen($whereParams)>0)
								$whereParams .= " and ";
							
							//this flag tels where we should to do search in current table or (if 1) in linked
							if($fieldItem['searchType']==1)
							{
								$searchTable = $relatedTable;								
								$searchField = $fieldItem['rSourcePointerField'];								
							}
							else 
							{
								$searchTable = $searchedTable;
								$searchField = $fieldItem['fieldName'];
							}
							//building where statement
							if(strrpos($searchFieldValue,'*')===false)
							{
								if(strpos($searchFieldValue,','))
								{
									$s = '';
									foreach (explode(",",$searchFieldValue) as $item)
									{
										$s.= "'$item',";
									}
									$searchFieldValue = substr($s,0,-1);
								}
								else
									$searchFieldValue = "'$searchFieldValue'";
								$whereParams .= "$searchTable.".$searchField. " in ($searchFieldValue)";
							}
							else 
							{//search by mask
								$searchFieldValue = str_replace('*','%', $searchFieldValue);
								$whereParams .= "$searchTable.".$searchField. " like '$searchFieldValue'";
							}
							//$whereParams .= "$searchedTable.".$fieldItem['fieldName']. " in ($searchFieldValue)";
						}
						
						if($fieldItem['visibleInSearchResult']==1)
						{
							//if field are required in view inner join will be used, else to this field can be not assigned any values, that's why used outer join
							if($fieldItem['required']==1)
								$linkedTables .= " inner join $relatedTable on $searchedTable.{$fieldItem['fieldName']} = $relatedTableAlias.{$fieldItem['rFieldName']}";
							else
								$linkedTables .= " left outer join $relatedTable on $searchedTable.{$fieldItem['fieldName']} = $relatedTableAlias.{$fieldItem['rFieldName']}";
							
							if(strpos($fieldItem['rDisplayFields'], $relatedTable)>=0)
								$selectedFields .= ", ".$fieldItem['rDisplayFields'];
							else
								$selectedFields .= ", $relatedTable.".$fieldItem['rDisplayFields'];
						}
					}
					break;
				}
			}
			//if field not used for search(as where parameter), but should be shown in search result
			if($used==0)
			{
				if($fieldItem['fieldType']<29)
				{
					if($fieldItem['visibleInSearchResult']==1)
					{
						if($this->db->query('SELECT * FROM '.$searchedTable.' LIMIT 1') && array_key_exists($fieldItem['fieldName'],$this->db->result[0]))
				            $selectedFields .= ", $searchedTable.".$fieldItem['fieldName'];
				        else 
							$selectedFields .= ", ".$fieldItem['fieldName'];
					}
				}
				elseif ($fieldItem['fieldType']==30 or $fieldItem['fieldType']==29)
				{//listbox
					$relatedTable=$fieldItem['rTableName'];						
					if(strpos($relatedTable," "))
					{							
						$startPosition = strpos($relatedTable," ")+1;
						$charsCount = strlen($relatedTable) - $startPosition;
						$relatedTableAlias = substr($relatedTable,$startPosition,$charsCount);
					}
					else 
						$relatedTableAlias = $relatedTable;	
							
					if($fieldItem['visibleInSearchResult']==1)
					{
						//if field are required in view inner join will be used, else to this field can be not assigned any values, that's why used outer join
						if($fieldItem['required']==1)
							$tempLink = " inner join $relatedTable on $searchedTable.{$fieldItem['fieldName']} = $relatedTableAlias.{$fieldItem['rFieldName']}";
						else
							$tempLink = " left outer join $relatedTable on $searchedTable.{$fieldItem['fieldName']} = $relatedTableAlias.{$fieldItem['rFieldName']}";
						
						if(strpos($linkedTables, $tempLink)===false)
						{
							$linkedTables.= $tempLink;
						}
						
						if(strpos($fieldItem['rDisplayFields'], $relatedTableAlias)>=0)
							$selectedFields .= ", ".$fieldItem['rDisplayFields'];
						else
							$selectedFields .= ", $relatedTableAlias.".$fieldItem['rDisplayFields'];
					}
				}
				elseif ($fieldItem['fieldType']==31 && $fieldItem['visibleInSearchResult']==1)
				{
					$currentTable = $this->objView->property['tblName'];
					
					$relatedTable=$fieldItem['rTableName'];
					$foreignKeyCurrentTbl=$fieldItem['rFieldName'];
					$foreignKeySourceTbl=$fieldItem['rSourcePointerField'];
					
					$sourceTbl=$fieldItem['rSourceTableName'];
					$primaryKeySourceTbl=$fieldItem['rSourceLinkField'];				
				
									
					if(strpos($relatedTable," "))
					{							
						$startPosition = strpos($relatedTable," ")+1;
						$charsCount = strlen($relatedTable) - $startPosition;
						$relatedTableAlias = substr($relatedTable,$startPosition,$charsCount);
					}
					else 
						$relatedTableAlias = $relatedTable;	
					
					//if field are required in view inner join will be used, else to this field can be not assigned any values, that's why used outer join
					if($fieldItem['required']==1)
						$tempLink = " inner join `$relatedTable` on $currentTable.id = $relatedTable.$foreignKeyCurrentTbl";
					else
						$tempLink = " left outer join `$relatedTable` on $currentTable.id = $relatedTable.$foreignKeyCurrentTbl";
						
					$tempLink.= " inner join `$sourceTbl` on $relatedTable.$foreignKeySourceTbl = $sourceTbl.$primaryKeySourceTbl";
					
					/*include_once(SITE_PATH.'vendors/Pear/Log.php');
					$logger = &Log::singleton('file', SITE_PATH.'logs/debug.log');			
					$logger->log(print_r($tempLink, 1));*/
					if(strpos($linkedTables, $tempLink)===false)
					{
						$linkedTables.= $tempLink;
					}
					
					if(strpos($fieldItem['rDisplayFields'], $sourceTbl)>=0)
						$selectedFields .= ", ".$fieldItem['rDisplayFields'];
					else
						$selectedFields .= ", $sourceTbl.".$fieldItem['rDisplayFields'];
					
					
				}
			}
		}

		//added by Maxim Melnichuk
		//ignored fieldId for some tables(from config)
		/*$additionParam='';
		if(strpos('fe_MasterPages', $searchedTable) != false)
		{
			$additionParam="$searchedTable.viewId as searchedViewId";
		}*/
			
		//generation search query, with checking of websiteId
        global $dbConnect;
        $query = "SELECT * FROM information_schema.COLUMNS
          WHERE TABLE_SCHEMA = '{$dbConnect['default']['DB_NAME']}' AND TABLE_NAME = '$searchedTable' AND COLUMN_NAME = 'websiteId'";
        $websiteIdClause = $this->db->query($query)?$searchedTable.".websiteId = ".Context::SiteSettings()->getSiteIdFromSession():'';

		//Calculate count of result rows
        if($this->objView->viewId == ORDER_MODERATION_VIEW)
            $searchedItemsOnPage = 10;
        else
            $searchedItemsOnPage = SEARCHED_ITEMS_ON_PAGE;

		$limit_start = ($page-1)*$searchedItemsOnPage;
		$query = "select count($searchedTable.id) as count from $searchedTable$linkedTables";
		if (strlen($whereParams)>0){
            $query .= " where $whereParams ".(strlen($websiteIdClause)>0?"and $websiteIdClause ":"");
        }
		elseif (strlen($websiteIdClause)>0){
            $query .= " where $websiteIdClause ";
        }
		$resultItemCount = 0;
		if($this->db->query($query))
		{
			$resultItemCount = $this->db->result[0]['count'];
		}
		else 
			return false;

        $viewIdClause = ($this->db->query('SELECT * FROM '.$searchedTable.' LIMIT 1') && array_key_exists('viewId',$this->db->result[0])) 
        				? $viewIdClause = ", ".$searchedTable.".viewId as searchedViewId"
        				: '';

		$query = "select $searchedTable.id $viewIdClause $selectedFields from $searchedTable$linkedTables";

		$groupByQuery = isset($group) && $group!=''?$group:"";
		$orderInQuery = isset($order) && $order!=''?$order:"order by id DESC";		
		
		if (strlen($whereParams)>0){
			$query .= " where $whereParams ".(strlen($websiteIdClause)>0?"and $websiteIdClause ":"");
		}
		elseif (strlen($websiteIdClause)>0){
			$query .= " where $websiteIdClause ";
		}

		$query .= $groupByQuery." $orderInQuery limit $limit_start,".$searchedItemsOnPage;
		
		if($this->db->query($query))
			return array("itemsCount" => $resultItemCount, "itemsArray" => $this->db->result);
		else 
			return false;

	}
}
?>