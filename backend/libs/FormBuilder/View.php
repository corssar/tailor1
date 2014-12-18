<?php
//Created By Maxim Melnichuk
//This Class is prototype for gettind View Data from dataBase
class VIEW
{
	var $db;
	var $viewId;
	var $isDataLoad = false;
	var $checkSearchView = true;
	var $searchViewId=4;

	// Массив всех свойств данного представления (view)
	var $property;
	var $groups;
	var $fields;
	//var $relatedRowIds;
	//List of values for simle fields
	var $fieldsValues=array();
	//used like buffer for coplex fields action
	var $complexFieldsActions;

	var $createViewDataError = '';
	
	var $simpleCopy = false;

	function VIEW(&$db, $viewId, $checkSearchView=true)
	{
		$this->db 		= &$db;
		$this->viewId	= (int)$viewId;
		$this->checkSearchView = $checkSearchView;
		$this->getViewInfo();
	}

	/**
	 * Извлекаем из БД все поля (fields) и закладки (groups)
	 */
	function getViewInfo()
	{
		if($this->db->query('SELECT * FROM `be_View` WHERE `viewId`='.$this->viewId.' LIMIT 1')){
			$this->property = $this->db->result[0];
		/*Initialization of Fields class*/
			if($this->property['viewType']!=$this->searchViewId and $this->checkSearchView)
				$this->fields = new FIELDS($this->db, $this->viewId);
			else
				$this->fields = new FIELDS($this->db, $this->viewId, $this->checkSearchView);
		/*Getting IsDataLoad property from Fields class*/
			$this->isDataLoad = $this->fields->isDataLoad;
		/* getting ViewGroup data */
			if($this->db->query('SELECT groupId, groupName FROM be_Group WHERE viewId='.$this->viewId))
				$this->groups = $this->db->result;
		}
	}

	function getViewGroup()
	{
		if(count($this->groups) > 0)
			return $this->groups;
		else
			return false;
	}

	/**
	 *
	* @param link
	* @param int
	* @return bool
	*/
	function setFieldsValue($rowIdValue, $rowIdName='id')
	{
		//this Query shoul be checked
		//if ($this->db->query('SELECT veiw.fieldName, source.[veiw.fieldName] FROM `be_View` view LEFT JOIN `'.$this->be_View['tblName'].'` source
		//on source.`viewId` = view.`viewId` WHERE  source.`'.$rowIdName.'` = '.$rowId.' and source.`viewId`='.$this->be_View['viewId'].''))
		if (!$this->db->query('SELECT * FROM `'.$this->property['tblName'].'` WHERE '.$rowIdName.' = '.$rowIdValue.' LIMIT 1'))
			return false;

		$this->fields->setFieldsDbValue($this->db->result[0], 
										$rowIdValue, 
										Context::SiteSettings()->multiLanguage() && !$this->simpleCopy ? $this->GetRelatedRowIds($rowIdValue, $rowIdName) : array() 
										);
			
		if(!$this->fields->isDataLoad)
			return false;

		return true;
	}
	
	private function GetRelatedRowIds($rowIdValue, $rowIdName='id')
	{
		//if field relationId not exist in table, skip the function
		if($this->db->query('SELECT * FROM '.$this->property['tblName'].' LIMIT 1') && !array_key_exists('relationId',$this->db->result[0]))
			return false;
		
		$where = array_key_exists('websiteId',$this->db->result[0]) ? ' and relations.websiteId = '.Context::SiteSettings()->getSiteIdFromSession() : '';

		if($this->db->query('
					SELECT 	
						relations.id, 
						relations.relationId,
						relations.langId, 
						relations.title,
						be_Languages.name langName,
						be_Languages.code langCode					
					FROM '.$this->property['tblName'].' page
					LEFT JOIN '.$this->property['tblName'].' relations 
						ON relations.relationId = page.relationId  
					INNER JOIN be_Languages 
						ON relations.langId = be_Languages.id
					WHERE page.'.$rowIdName.'='.$rowIdValue.$where)) //AND relations.'.$rowIdName.' != page.'.$rowIdName.'
		{
			if( count($this->db->result)>0 )
			{
				return $this->db->result;
			}
		}
		return false;
	}
	
	//getting data of one table row
	function getFieldData($fieldId, $rowIdValue, $rowIdName='id')
	{
		if ($this->db->query('SELECT * FROM `'.$this->property['tblName'].'` WHERE '.$rowIdName.' = '.$rowIdValue.' LIMIT 1'))
		{
			$field = $this->fields->getFieldDbValue($fieldId, $this->db->result[0], $rowIdValue);
			if($this->fields->isDataLoad)
				return $field;
			else
				return false;
		}
		else
			return false;
	}

	//this function used for assign new value to the simple field by his name, changes will implemented after functions create() or update(...)
	function setFieldByName($fieldName,$fieldValue)
	{
		if(!key_exists($fieldName, $this->fieldsValues))
		{
			$this->fieldsValues[$fieldName]=$fieldValue;
		}
	}
	
	//this function used for assign new value to the simple field by his Id
	function setFieldById($fieldId,$fieldValue)
	{
		if($this->isDataLoad)
		{
			$this->fields->changeFieldValueById($fieldId,$fieldValue);
		}
	}

	/**
	* this function used for assign new value to the Complex field, changes will implemented after functions create() or update(...)
	*
	*
	* @param $values is array (relatedId1, relatedId2 ....)
	*/
	function setComplexField($fieldId,$values, $valueRelatedToList = '')
	{
		if($this->isDataLoad)
		{
			foreach ($this->fields->getFieldList() as $field)
			{
				if($field['fieldId']==$fieldId)
				{
					if($field['fieldType']==32 || ($field['fieldType']==31 && $field['displayType']!=3))
					{
						$relationsTbl=$field['rTableName'];
						$foreignKeySourceTbl=$field['rSourcePointerField'];
						$foreignKeyCurrentTbl=$field['rFieldName'];

						$delSql="delete from $relationsTbl where $foreignKeyCurrentTbl='{#value#}'";
						$whereFieldList='';
						$whereValueList='';
						$whereParam=$this->fields->getWhereParam($field);
						if($whereParam!='')
						{
							$delSql.=' and '.$whereParam;
							$whereFieldList = ', '.$whereParam=$this->fields->getWhereParam($field, 2);
							$whereValueList = ', '.$whereParam=$this->fields->getWhereParam($field, 3);
						}
						$sql='';
						if(is_array($values))
						{
							$sql="insert into $relationsTbl ($foreignKeyCurrentTbl, $foreignKeySourceTbl$whereFieldList)";
							$valuesStr='';
							foreach($values as $value)
							{
								if($valuesStr=='')
								{
									$valuesStr="('{#value#}', '$value'".$whereValueList.")";
								}
								else
								{
									$valuesStr.=", ('{#value#}', '$value'".$whereValueList.")";
								}
							}
							$sql.=" values " .$valuesStr;
						}
						$this->complexFieldsActions[][0]=$delSql;
						$this->complexFieldsActions[][1]=$sql;
						return true;
					}
					elseif ($field['fieldType']==33)
					{
						$relationsTbl=$field['rTableName'];
						$linkTableForeignKey=$field['rFieldName'];//foreignKey in related table
						$linkTablePrimaryKey=$field['rSourcePointerField'];
						$orderField=$field['rSourceLinkField'];
						
						
						//$this->db->query(str_replace('{#value#}', $id, $sql_item));
						
						if(is_array($values) && count($values)>0)
						{
							$currentIDs = implode(',',$values);
							$deleteStatement = "and $linkTablePrimaryKey not in ($currentIDs)";
						}
						else 
						{
							$currentIDs = '';
							$deleteStatement = '';
						}
						
						$delSql="delete from $relationsTbl where $linkTableForeignKey='".($valueRelatedToList?$valueRelatedToList:'{#value#}')."' $deleteStatement";

						$whereFieldList='';
						$whereValueList='';
						$whereParam=$this->fields->getWhereParam($field);
						if($whereParam!='')
						{
							$delSql.=' and '.$whereParam;
							$whereFieldList = ', '.$whereParam=$this->fields->getWhereParam($field, 2);
							$whereValueList = ', '.$whereParam=$this->fields->getWhereParam($field, 3);
						}

						$this->complexFieldsActions[][0]=$delSql;
						//check if this field required storing ordering
						if(strlen($orderField)>0 && is_array($values) && count($values)>0)
						{//order will stored in field $field['rSourceLinkField']
							$i=1;
							foreach($values as $value)
							{
								$sql="	update $relationsTbl 
										set $linkTableForeignKey = '".($valueRelatedToList?$valueRelatedToList:'{#value#}')."',$orderField='$i'  
										where $linkTablePrimaryKey = $value$whereParam";
								$this->complexFieldsActions[][$i]=$sql;
								$i++;
							}
						}
						elseif($currentIDs!='')
						{
							$sql="	update $relationsTbl 
									set $linkTableForeignKey = '".($valueRelatedToList?$valueRelatedToList:'{#value#}')."' 
									where $linkTablePrimaryKey in ($currentIDs)$whereParam";
							$this->complexFieldsActions[][1]=$sql;
						}

						/*$valuesStr='';
						foreach($values as $value)
						{
							if($valuesStr=='')
							{
								$valuesStr="('{#value#}', '$value'".$whereValueList.")";
							}
							else
							{
								$valuesStr.=", ('{#value#}', '$value'".$whereValueList.")";
							}
						}
						$sql.=" values " .$valuesStr;*/
						return true;
					}
				}
			}
		}
		return false;
	}

	function create()
	{
		if(is_array($this->fieldsValues))
		{
			$fields='';
			$values='';
			foreach ($this->fieldsValues as $key => $value)
			{
				if($key == 'id') continue;
				if($fields!='')
				{
                    $values .= ", '$value'";
                    $fields.=', '.$key;
				}
				else
				{
                    $fields=$key;
                    $values .=  "'$value'";
				}
			}
            global $dbConnect;
            $query = "SELECT * FROM information_schema.COLUMNS
                      WHERE TABLE_SCHEMA = '{$dbConnect['default']['DB_NAME']}' AND TABLE_NAME = '".$this->property['tblName']."' AND COLUMN_NAME = 'websiteId'";
            if($this->db->query($query))
			{
				$fields.=', websiteId';
                $values.=", '" . Context::SiteSettings()->getSiteIdFromSession() . "'";
			}

			$sql='insert into '.$this->property['tblName']. '('.$fields.') values('.$values.')';
			if($this->db->query($sql))
			{
				if($this->db->LIID)
				{
					$id=$this->db->LIID;
					if(is_array($this->complexFieldsActions))
					foreach ($this->complexFieldsActions as $sql_action)
					{
						foreach ($sql_action as $sql_item)
						{
							if(strlen($sql_item)>0)
								$this->db->query(str_replace('{#value#}', $id, $sql_item));
						}
						/*$this->db->query(str_replace('{#value#}', $id, $sql_action[0]));
						if(strlen($sql_action[1])>0)
							$this->db->query(str_replace('{#value#}', $id, $sql_action[1]));*/

					}
					return $id;
				}
			}
			else
			{
				$this->createViewDataError = $this->db->error_str;
			}
		}
		return false;

	}
	
	function update($rowIdValue, $rowIdName='id')
	{
		if(is_array($this->fieldsValues))
		{
			$setStatement='';
			foreach ($this->fieldsValues as $key => $value)
			{
				if($setStatement!='')
				{
					$setStatement.=', '.$key."='$value'";
				}
				else
				{
					$setStatement.=' '.$key."='$value'";
				}
			}

            global $dbConnect;
            $query = "SELECT * FROM information_schema.COLUMNS
                      WHERE TABLE_SCHEMA = '{$dbConnect['default']['DB_NAME']}' AND TABLE_NAME = '".$this->property['tblName']."' AND COLUMN_NAME = 'websiteId'";
            $where = $this->db->query($query)?' and websiteId = '. Context::SiteSettings()->getSiteIdFromSession():'';

			$sql='UPDATE '.$this->property['tblName']. ' set '.$setStatement.' where '.$rowIdName.'='.$rowIdValue . $where ; //TODO: WebsiteId
			if($this->db->query($sql))
			{
				if(is_array($this->complexFieldsActions))
					foreach ($this->complexFieldsActions as $sql_action)
					{
						foreach ($sql_action as $sql_item)
						{
							if(strlen($sql_item)>0)
							{
								$this->db->query(str_replace('{#value#}', $rowIdValue, $sql_item));
							}
						}
						/*$this->db->query(str_replace('{#value#}', $rowIdValue, $sql_action[0]));
						if(strlen($sql_action[1])>0)
							$this->db->query(str_replace('{#value#}', $rowIdValue, $sql_action[1]));*/
					}
				return true;
			}
			else
			{
				$this->createViewDataError = $this->db->error_str;
			}
		}
		return false;
	}

	function copyContent($rowIdValue, $rowIdName='id',  $nextLangId = null)  // Если langId не null значит идет каскадное поэтапное копирование языков
	{
		/*if ($this->isDataLoad)
			$this->fields->prepareFieldsForCopy($rowIdName);
		else*/if ($this->setFieldsValue($rowIdValue, $rowIdName))
			$this->fields->prepareFieldsForCopy($rowIdName,$nextLangId,$this->simpleCopy);
	}

	function deleteContent($rowIdValue, $rowIdName='id')
	{
		if ($this->db->query('SELECT * FROM `'.$this->property['tblName'].'` WHERE '.$rowIdName.' = '.$rowIdValue.' LIMIT 1'))
		{
			$this->fields->deleteRelatedValues($this->db->result[0], $rowIdValue);
			if($this->db->query('DELETE FROM `'.$this->property['tblName'].'` WHERE '.$rowIdName.' = '.$rowIdValue))
			return true;
		}
		return false;
	}

	/**
	 * Возвращает массив представлений с указанным типом
	 *
	 * @param unknown_type $typeId
	 * @param unknown_type $db
	 * @return unknown
	 */
	function getViewsByType($typeId, &$db)
	{
		$typeId = (int)$typeId;
		//Getting list of view
		if($db->query('SELECT * FROM `be_View` WHERE `active`=1 AND `viewType`='.$typeId))
		{
			$listView = $db->result;
		}
		else
		{
			$listView=false;
		}
		return $listView;
	}

	/*
		function Use for export in SQL query by ViewId
		Возвращает sql-код, выполнив который можно склонировать view с ID = $viewID
	*/
	static function exportView($viewId)
	{
        $sqlExport ="SET FOREIGN_KEY_CHECKS=0;<br>";
        $sqlExport.="set @viewId=$viewId;<br>DELETE FROM be_View WHERE viewId=@viewId;<br>";
		if(Context::DB()->query("SELECT * FROM be_View WHERE viewId=$viewId"))
		{
			$viewInfo = Context::DB()->result[0];
			$whereFieldList='';
			$whereValueList='';
			foreach ($viewInfo as $key => $value)
			{
				if ($key=='viewId')
					$value='@viewId';
				else
                {
					$value="'".mysqli_real_escape_string(Context::DB()->pointer, $value)."'";
                }

				if($whereFieldList=='')
				{
					$whereFieldList= "$key";
					$whereValueList= "$value";
				}
				else
				{
					$whereFieldList.= ", $key";
					$whereValueList.= ", $value";
				}
			}
			$sqlExport.="INSERT INTO be_View ($whereFieldList)<br>VALUES($whereValueList);<br>";
			//export be_Fields
			$sqlExport.="DELETE FROM be_Fields WHERE viewId=@viewId;<br>DELETE FROM be_WhereParam WHERE viewId=@viewId;<br>";
			if(Context::DB()->query("SELECT * FROM be_Fields WHERE viewId=$viewId"))
			{
				$fields = Context::DB()->result;
				foreach ($fields as $field)
				{
					$whereFieldList='';
					$whereValueList='';
                    $viewIdFieldIteration = false;
					foreach ($field as $key => $value)
					{
						if($key!='fieldId')
						{
                            if ($key == 'fieldName' && $value == 'viewId')
                                $viewIdFieldIteration = true;

							if ($key=='viewId' || ($key == 'defaultValue' && $viewIdFieldIteration) )
								$value='@viewId';
							elseif($value == null)
								$value='null';
							else
								$value="'".mysqli_real_escape_string(Context::DB()->pointer, $value)."'";

							if($whereFieldList=='')
							{
								$whereFieldList= "$key";
								$whereValueList= "$value";
							}
							else
							{
								$whereFieldList.= ", $key";
								$whereValueList.= ", $value";
							}
						}
					}
					$sqlExport.="INSERT INTO be_Fields ($whereFieldList)<br>VALUES($whereValueList);<br>";
					//export be_WhereParam for current field
					if(Context::DB()->query("SELECT * FROM be_WhereParam WHERE fieldId={$field['fieldId']}"))
					{
						$sqlExport.='set @fieldId=LAST_INSERT_ID();<br>';
						$parameters = Context::DB()->result;
						foreach ($parameters as $parameter)

						{
							$whereFieldList='';
							$whereValueList='';
							foreach ($parameter as $key => $value)
							{
								if($key!='id')
								{
									if ($key=='viewId')
										$value='@viewId';
									elseif ($key=='fieldId')
										$value='@fieldId';
									else
										$value="'".mysqli_real_escape_string(Context::DB()->pointer, $value)."'";

									if($whereFieldList=='')
									{
										$whereFieldList= "$key";
										$whereValueList= "$value";
									}
									else
									{
										$whereFieldList.= ", $key";
										$whereValueList.= ", $value";
									}
								}
							}
							$sqlExport.="INSERT INTO be_WhereParam ($whereFieldList)<br>VALUES($whereValueList);<br>";
						}
					}
				}
				//export be_Group
				$sqlExport.="DELETE FROM be_Group WHERE viewId=@viewId;<br>";
				if(Context::DB()->query("SELECT * FROM be_Group WHERE viewId=$viewId"))
				{
					$groups = Context::DB()->result;
					foreach ($groups as $group)
					{
						$whereFieldList='';
						$whereValueList='';
						foreach ($group as $key => $value)
						{
							if ($key=='viewId')
								$value='@viewId';
							else
								$value="'$value'";

							if($whereFieldList=='')
							{
								$whereFieldList= "$key";
								$whereValueList= "$value";
							}
							else
							{
								$whereFieldList.= ", $key";
								$whereValueList.= ", $value";
							}
						}
						$sqlExport.="INSERT INTO be_Group ($whereFieldList)<br>VALUES($whereValueList);<br>";
					}
					//export be_WhereParam
					//$sqlExport.="DELETE FROM be_WhereParam WHERE viewId=$viewId;<br>";
				}
			}
		}
        $sqlExport.="SET FOREIGN_KEY_CHECKS=1;";
		echo $sqlExport;
	}
}