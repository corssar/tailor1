<?php
//Created By Maxim Melnichuk
//This is prototype of Class for gettind Fields Data for selected View from dataBase

class FIELDS
{
	var $db;
	var $isDataLoad = false;
	var $viewId;

	// массив. все свойства всех полей дл€ указанного viewID
	var $fieldList;

	var $trace;
	var $values;

	var $filedTypes;

    function FIELDS(&$db, &$viewId, $isSearchView=false)
    {
        $this->db 		= &$db;
        $this->viewId	= &$viewId;

        //combine query for both type of view(standart and search)
        if($isSearchView)
        {
            $query = 'SELECT * FROM be_Fields WHERE viewId='.$viewId.' and participantSearch=1 ORDER BY groupId, orderNumber';
        }
        else
        {
            $query = 'SELECT * FROM be_Fields WHERE viewId='.$viewId.' ORDER BY groupId, orderNumber';
        }
        if($this->db->query($query))
        {
            $this->fieldList  = $this->db->result;

            for($i=0;$i<count($this->fieldList);$i++)
            {
                $this->fieldList[$i]['be_Field_defaultValue'] = $this->fieldList[$i]['defaultValue'];
                if ($this->isFieldDropDownListBox($i))
                {
                    //Combine Sql Query for getting data in relation "one to many"
                    if (strlen($this->fieldList[$i]['rDisplayFields']) > 0)
                    {	// —писок полей, которые отображаютс€ пользователю
                        $displayFields = ', '.$this->fieldList[$i]['rDisplayFields'];
                    }
                    else
                        $displayFields='';

                    if(Context::SiteSettings()->multiLanguage())
                        if($this->db->query('SELECT * FROM '.$this->fieldList[$i]['rTableName'].' LIMIT 1'))
                            if(array_key_exists('langId',$this->db->result[0]) && array_key_exists('relationId',$this->db->result[0]))
                                $displayFields.= ', langId, relationId';

                    $sql = 'select '.$this->fieldList[$i]['rFieldName'] .' relatedField'.$displayFields.' from '. $this->fieldList[$i]['rTableName'] ;

                    $whereParam = $this->getWhereParam($this->fieldList[$i]);
                    if($whereParam!='')
                        $sql.=' where '.$whereParam;

                    if( $this->db->query('SELECT * FROM '.$this->fieldList[$i]['rTableName'].' LIMIT 1') &&
                        array_key_exists('websiteId',$this->db->result[0]) )
                    {
                        $sql.=$whereParam == ''?' where ':' and ';
                        $sql.=$this->fieldList[$i]['rTableName'].'.websiteId = '.Context::SiteSettings()->getSiteIdFromSession();
                    }

                    if( $this->fieldList[$i]['displayType'] == 3 )
                    {
                        $sql.=" LIMIT 0,0";
                    }

                    //Getting array with possible values
                    // «апрос возвращает выборку, содержащую значени€ пол€, по которому св€зываетс€ главна€ и подчиненна€ таблицы и значени€ полей, которые будут отображатьс€ пользователю
                    if($this->db->query($sql))
                    {
                        $tempValues = $this->db->result;
                        $values = array();

                        // ќбходим все пол€ подчиненной таблицы
                        //For value which are choosed, add ['selected'] = 1
                        for($j=0;$j<count($tempValues);$j++)
                        {
                            $values[$j]=array('relatedField'=>'', 'values'=>'', 'selected'=>0);
                            //generation array Values for display fields

                            foreach ($tempValues[$j] as $key=>$value)
                            {
                                if($key=='relatedField')
                                {
                                    $values[$j]['relatedField']=$value;
                                    //check if element is selected
                                    if($this->fieldList[$i]['defaultValue']==$value)
                                        $values[$j]['selected']=1;
                                }
                                elseif($key == 'langId')
                                {
                                    $values[$j]['langId']=$value;
                                }
                                elseif($key == 'relationId')
                                {
                                    $values[$j]['relationId']=$value;
                                }
                                else
                                {
                                    $values[$j]['values'][$key]=$value;
                                }
                            }
                            /*if($this->fieldList[$i]['defaultValue'] == $tempValues[$j]['relatedField'])
                                $tempValues[$j]['selected'] = 1;
                            else
                                $tempValues[$j]['selected'] = 0;*/
                        }
                        if($this->fieldList[$i]['visible']!=0)
                            $this->fieldList[$i]['defaultValue'] = $values;
                    }
                    else
                        $this->isDataLoad = false;
                }
                elseif($this->fieldList[$i]['fieldType']==32 and is_numeric($this->fieldList[$i]['rSearchViewId']))
                {
                    //Combine Sql Query for getting data in relation "many to many"
                    $sourceTbl=$this->fieldList[$i]['rSourceTableName'];

                    /** getting fields list from related view, generating list of fields for next query **/
                    if($this->db->query('select * from be_Fields where viewId='.$this->fieldList[$i]['rSearchViewId']))
                    {
                        $tempValues = $this->db->result;
                        $allowFields = array();
                        $fieldList='';
                        foreach($tempValues as $field)
                        {
                            //generating field list for next SQL query
                            if($field['fieldType']<30 and $field['fieldName']!='id' and $field['fieldName']!='viewId' and strpos($field['fieldName'], "html")===false )
                            {
                                $allowFields[]=array('fieldId'=>$field['fieldId'], 'displayName'=>$field['displayName'], 'fieldName'=>$field['fieldName']);
                                $fieldList.=', '.$sourceTbl.'.'.$field['fieldName'];
                            }
                        }
                        $this->fieldList[$i]['availableValues']=$allowFields;
                    }
                }
                elseif($this->fieldList[$i]['fieldType']==33 and is_numeric($this->fieldList[$i]['rSearchViewId']))
                {
                    /** getting fields list from related view, generating list of fields for next query **/
                    if($this->db->query('select * from be_Fields where viewId='.$this->fieldList[$i]['rSearchViewId'].' and visible=1'))
                    {
                        $tempValues = $this->db->result;
                        $allowFields = array();
                        $fieldList='';
                        foreach($tempValues as $field)
                        {
                            if($field['fieldType']<30 and $field['fieldName']!='id' and $field['fieldName']!='viewId' and strpos($field['fieldName'], "html")===false )
                            {
                                $allowFields[] = array('fieldId' => $field['fieldId'],
                                    'displayName' => $field['displayName'],
                                    'fieldName' => $field['fieldName']);

                                $fieldList.=', '.$this->fieldList[$i]['rTableName'].'.'.$field['fieldName'];
                            }
                            elseif ($field['fieldType'] == 30)
                            {
                                $allowFields[] = array('fieldId' => $field['fieldId'],
                                    'displayName' => $field['displayName'],
                                    'fieldName' => $field['fieldName']);

                                $fieldList.= ', '.$field['rDisplayFields'];
                            }
                        }
                        $this->fieldList[$i]['availableValues']=$allowFields;
                    }
                }
                elseif(strlen($this->fieldList[$i]['rTableName']) > 0 and strlen($this->fieldList[$i]['rSourceTableName']) > 0)
                {
                    $this->fieldList[$i]['defaultValue'] = '';
                }
            }
            $this->isDataLoad = true;
        }
    }

	// check if field is ListBox (many-to-one) by FieldID
	function isFieldDropDownListBox($fieldID) {
		return (strlen($this->fieldList[$fieldID]['rTableName']) > 0 and strlen($this->fieldList[$fieldID]['rSourceTableName']) == 0 and $this->fieldList[$fieldID]['rSearchViewId'] == 0);

	}

	function getFieldList()
	{
		if($this->isDataLoad)
			return $this->fieldList;
	}

	/* new value will set to the fields object, value will not used for saving data
		$fieldType=0 - simple field
	*/
	function changeFieldValue($name, $value, $fieldType=0)
	{
		for($i=0;$i<count($this->fieldList);$i++)
		{
			if($this->fieldList[$i]['fieldName']==$name)
			{
				$this->fieldList[$i]['defaultValue'] = $value;
			}
		}
	}

    function changeFieldValueById($name, $value)
    {
        for($i=0;$i<count($this->fieldList);$i++)
        {
            if($this->fieldList[$i]['fieldId']==$name)
            {
                if($this->fieldList[$i]['fieldType']==30)
                {
                    if($this->fieldList[$i]['displayType'] == 3 && ctype_digit($value)) // added by Andrew 22.10.2013 for dynamic dropdown list in the search form
                    {
                        $dynamicListValue = $value;
                        if (strlen($this->fieldList[$i]['rDisplayFields']) > 0)
                            $displayFields = ', '.$this->fieldList[$i]['rDisplayFields'];
                        else
                            $displayFields='';

                        $sql = 'select '.$this->fieldList[$i]['rFieldName'] .' relatedField'.$displayFields.' from '. $this->fieldList[$i]['rTableName'] ;

                        $whereParam = $this->getWhereParam($this->fieldList[$i]);
                        if($whereParam!='')
                            $sql.=' where '.$whereParam;

                        if( $this->db->query('SELECT * FROM '.$this->fieldList[$i]['rTableName'].' LIMIT 1') &&
                            array_key_exists('websiteId',$this->db->result[0]) )
                        {
                            $sql.=$whereParam == ''?' where ':' and ';
                            $sql.=$this->fieldList[$i]['rTableName'].'.websiteId = '.Context::SiteSettings()->getSiteIdFromSession();
                        }

                        $sql.= strpos($sql,'where')===false?' where ':' and ';
                        $sql.= $this->fieldList[$i]['rTableName'].".".$this->fieldList[$i]['rFieldName']." = ".$dynamicListValue;
                        $sql.= " LIMIT 0,1";

                        if($this->db->query($sql))
                        {
                            $tempValues = $this->db->result;
                            $values = array();
                            for($j=0;$j<count($tempValues);$j++)
                            {
                                $values[$j]=array('relatedField'=>'', 'values'=>'', 'selected'=>0);

                                foreach ($tempValues[$j] as $key=>$value)
                                {
                                    if($key=='relatedField')
                                    {
                                        $values[$j]['relatedField']=$value;
                                        if($dynamicListValue==$value)
                                            $values[$j]['selected']=1;
                                    }
                                    else
                                    {
                                        $values[$j]['values'][$key]=$value;
                                    }
                                }
                            }
                            if($this->fieldList[$i]['visible']!=0)
                                $this->fieldList[$i]['defaultValue'] = $values;
                        }
                    }
                    elseif(ctype_digit($value))
                    {
                        $valuesArr=$this->fieldList[$i]['defaultValue'];
                        for($j=0;$j<count($valuesArr);$j++)
                        {
                            if($valuesArr[$j]['relatedField']==$value)
                                $valuesArr[$j]['selected']=1;
                            else
                                $valuesArr[$j]['selected']=0;
                        }
                        $this->fieldList[$i]['defaultValue'] = $valuesArr;
                    }
                    elseif(empty($value) && $this->fieldList[$i]['required'] == 0)
                    {
                        /** unselect default item */
                        $valuesArr = $this->fieldList[$i]['defaultValue'];
                        for($j=0;$j<count($valuesArr);$j++)
                        {
                            $valuesArr[$j]['selected'] = 0;
                        }
                        $this->fieldList[$i]['defaultValue'] = $valuesArr;
                    }
                }
                else
                    $this->fieldList[$i]['defaultValue'] = $value;
                break;
            }
        }
    }

    function setFieldsDbValue($arrayValues, $contentId, $relations = array())
    {
        for($i=0;$i<count($this->fieldList);$i++)
        {
            $name = $this->fieldList[$i]['fieldName'];

            if($this->fieldList[$i]['fieldType'] == 13) //language field
            {
                if(Context::SiteSettings()->multiLanguage())
                {
                    $this->fieldList[$i]['defaultValue'] = array();
                    $this->fieldList[$i]['defaultValue']['value'] = $arrayValues[$name];
                    $this->fieldList[$i]['defaultValue']['relations'] = $relations;
                }
                else
                {
                    $this->fieldList[$i]['defaultValue'] = $arrayValues[$name];
                }
            }
            elseif($this->fieldList[$i]['fieldType'] < 30)
            {//simlpe fields (without relations)
                if(isset($arrayValues[$name]))
                    $this->fieldList[$i]['defaultValue'] = $arrayValues[$name];
            }
            //filds with relations
            //if ListBox (One-To-Many)
            elseif($this->isFieldDropDownListBox($i))
            {
                //Combine Sql Query for getting data in relation "one to many"
                if (strlen($this->fieldList[$i]['rDisplayFields']) > 0)
                {
                    $displayFields = ', '.$this->fieldList[$i]['rDisplayFields'];
                }
                else
                    $displayFields='';

                if(Context::SiteSettings()->multiLanguage())
                    if($this->db->query('SELECT * FROM '.$this->fieldList[$i]['rTableName'].' LIMIT 1'))
                        if(array_key_exists('langId',$this->db->result[0]) && array_key_exists('relationId',$this->db->result[0]))
                            $displayFields.= ', langId, relationId';

                $sql = 'select '.$this->fieldList[$i]['rFieldName'] .' relatedField'.$displayFields.' from '. $this->fieldList[$i]['rTableName'];

                $whereParam = $this->getWhereParam($this->fieldList[$i]);
                if($whereParam != '')
                    $sql.=' where '.$whereParam;

                if( $this->db->query('SELECT * FROM '.$this->fieldList[$i]['rTableName'].' LIMIT 1') &&
                    array_key_exists('websiteId',$this->db->result[0]) )
                {
                    $sql.=$whereParam == ''?' where ':' and ';
                    $sql.=$this->fieldList[$i]['rTableName'].'.websiteId = '.Context::SiteSettings()->getSiteIdFromSession();
                }

                if( $this->fieldList[$i]['displayType'] == 3 &&
                    isset($arrayValues[$this->fieldList[$i]['fieldName']]) &&
                    $arrayValues[$this->fieldList[$i]['fieldName']]
                )
                {
                    $sql.= strpos($sql,'where')===false?' where ':' and ';
                    $sql.=$this->fieldList[$i]['rTableName'].".".$this->fieldList[$i]['rFieldName']." = ".$arrayValues[$this->fieldList[$i]['fieldName']];
                }

                if($this->db->query($sql))
                {
                    unset($tempValues);
                    unset($values);
                    $tempValues = $this->db->result;
                    //For value which are choosed, add ['selected'] = 1
                    for($j=0;$j<count($tempValues);$j++)
                    {
                        $values[$j]=array('relatedField'=>'', 'values'=>'', 'selected'=>0);
                        //generation array Values for display fields
                        foreach ($tempValues[$j] as $key=>$value)
                        {
                            if($key == 'relatedField')
                            {
                                $values[$j]['relatedField']=$value;
                                //check if element is saved in object
                                if($arrayValues[$name]==$value)
                                    $values[$j]['selected']=1;
                            }
                            elseif($key == 'langId')
                            {
                                $values[$j]['langId']=$value;
                            }
                            elseif($key == 'relationId')
                            {
                                $values[$j]['relationId']=$value;
                            }
                            else
                            {
                                $values[$j]['values'][$key]=$value;
                            }

                        }
                    }
                    $this->fieldList[$i]['defaultValue'] = $values;//$tempValues;
                }
                elseif($this->db->error)
                {
                    $this->values = 'DropDown error for field:'.$this->fieldList[$i]['fieldId'];
                    $this->isDataLoad = false;

                    //logging error
                    include_once(SITE_PATH.'vendors/Pear/Log.php');
                    $logger = &Log::singleton('file', SITE_PATH.'logs/viewBuilder.log');
                    $logger->log("Error getting values for Dropdown, errorr: {$this->values}. More info: viewId {$this->viewId}, \t SQL\t$sql");
                }
            }
            elseif($this->fieldList[$i]['fieldType']==32 and is_numeric($this->fieldList[$i]['rSearchViewId']))
            {
                //Combine Sql Query for getting data in relation "many to many"
                $sourceTbl=$this->fieldList[$i]['rSourceTableName'];
                $relationsTbl=$this->fieldList[$i]['rTableName'];
                $primaryKeySourceTbl=$this->fieldList[$i]['rSourceLinkField'];
                $foreignKeySourceTbl=$this->fieldList[$i]['rSourcePointerField'];
                $foreignKeyCurrentTbl=$this->fieldList[$i]['rFieldName'];

                /** getting fields list from related view, generating list of fields for next query **/
                if($this->db->query('select * from be_Fields where viewId='.$this->fieldList[$i]['rSearchViewId']))
                {
                    $tempValues = $this->db->result;
                    $allowFields = array();
                    $fieldList='';
                    $innerJoinTableCond = '';

                    foreach($tempValues as $field)
                    {
                        if($field['fieldType'] == 13)
                        {
                            $allowFields[] = array('fieldId' => $field['fieldId'],
                                'displayName' => $field['displayName'],
                                'fieldName' => $field['fieldName']);

                            $fieldList.= ', be_Languages.code langcode';
                            $innerJoinTableCond.= 'left join be_Languages
													ON be_Languages.id = '.$this->fieldList[$i]['rTableName'].'.'.$field['fieldName'].' ';
                        }
                        elseif($field['fieldType']<30 and $field['fieldName']!='id' and $field['fieldName']!='viewId' and strpos($field['fieldName'], "html")===false )
                        {
                            $allowFields[]=array('fieldId'=>$field['fieldId'], 'displayName'=>$field['displayName'], 'fieldName'=>$field['fieldName']);
                            $fieldList.=', '.$sourceTbl.'.'.$field['fieldName'];
                        }
                        elseif ($field['fieldType'] == 30)
                        {
                            $allowFields[] = array('fieldId' => $field['fieldId'],
                                'displayName' => $field['displayName'],
                                'fieldName' => $field['fieldName']);

                            $fieldList.= ', '.$field['rDisplayFields'];
                            $innerJoinTableCond.= 'left join '.$field['rTableName'].'
													ON '.$field['rTableName'].'.'.$field['rFieldName'].' = '.$this->fieldList[$i]['rSourceTableName'].'.'.$field['fieldName'].' ';

                        }
                    }

                    /** Getting data from source **/
                    $sql = 'select
								'.$sourceTbl.'.'.$primaryKeySourceTbl.'
								relatedField'.$fieldList.'
							from
								'.$sourceTbl.'
							inner join '.$relationsTbl. '
								on '.$sourceTbl.'.'.$primaryKeySourceTbl.'='.$relationsTbl.'.'.$foreignKeySourceTbl.'
							'.$innerJoinTableCond.'
							where
								'.$relationsTbl.'.'.$foreignKeyCurrentTbl."='"."$contentId'";
                    $whereParam=$this->getWhereParam($this->fieldList[$i]);

                    if($whereParam!='')
                        $sql.=' and '.$whereParam;

                    if(	$this->db->query('SELECT * FROM '.$this->fieldList[$i]['rTableName'].' LIMIT 1') &&
                        array_key_exists('websiteId',$this->db->result[0]) )
                    {
                        $sql.=' and '.$this->fieldList[$i]['rTableName'].'.websiteId = '.Context::SiteSettings()->getSiteIdFromSession();
                    }

                    $sql.= isset($groupBy)&&$groupBy!=''?"".$groupBy:'';
                    $sql.= " Order By $relationsTbl.id ";
                    //Getting array with selected values
                    if($this->db->query($sql))
                    {
                        $tempValues = $this->db->result;
                        $values=array();
                        for($j=0;$j<count($tempValues);$j++)
                        {
                            $values[$j]=array('relatedField'=>'', 'values'=>'');
                            //generation array Values for display fields
                            foreach ($tempValues[$j] as $key=>$value)
                            {
                                if($key=='relatedField')
                                {
                                    $values[$j]['relatedField']=$value;
                                }
                                else
                                {
                                    $values[$j]['values'][$key]=$value;
                                }
                            }
                        }
                        $this->fieldList[$i]['defaultValue']=$values;
                        $this->fieldList[$i]['availableValues']=$allowFields;
                    }
                    elseif(!$this->db->error)
                        $this->fieldList[$i]['defaultValue'] ='';
                    else
                    {
                        $this->errorStr='multiply error';
                        $this->isDataLoad = false;

                        //logging error
                        include_once(SITE_PATH.'vendors/Pear/Log.php');
                        $logger = &Log::singleton('file', SITE_PATH.'logs/viewBuilder.log');
                        $logger->log("viewId {$this->viewId}\t error get data for many-to-many field with type 32\t$sql");
                    }
                }
            }
            elseif($this->fieldList[$i]['fieldType']==33 and is_numeric($this->fieldList[$i]['rSearchViewId']))
            {
                //Combine Sql Query for getting data in relation "many to one"
                /** getting fields list from related view, generating list of fields for next query **/
                if($this->db->query('select * from be_Fields where viewId='.$this->fieldList[$i]['rSearchViewId'].' and visible=1 ORDER BY groupId, orderNumber ASC'))
                {

                    $tempValues = $this->db->result;
                    $allowFields = array();
                    $fieldList='';
                    $innerJoinTableCond = '';

                    foreach($tempValues as $field)
                    {
                        //generating field list for next SQL query
                        if($field['fieldType'] == 13)
                        {
                            $allowFields[] = array('fieldId' => $field['fieldId'],
                                'displayName' => $field['displayName'],
                                'fieldName' => $field['fieldName']);

                            $fieldList.= ', be_Languages.code langcode';
                            $innerJoinTableCond.= 'left join be_Languages
													ON be_Languages.id = '.$this->fieldList[$i]['rTableName'].'.'.$field['fieldName'].' ';
                        }
                        elseif($field['fieldType']<30 and $field['fieldName']!='id' and $field['fieldName']!='viewId' and strpos($field['fieldName'], "html")===false )
                        {
                            $allowFields[]=array('fieldId'=>$field['fieldId'], 'displayName'=>$field['displayName'], 'fieldName'=>$field['fieldName']);
                            $fieldList.=', '.$this->fieldList[$i]['rTableName'].'.'.$field['fieldName'];
                        }
                        elseif ($field['fieldType'] == 30)
                        {
                            $allowFields[] = array('fieldId' => $field['fieldId'],
                                'displayName' => $field['displayName'],
                                'fieldName' => $field['fieldName']);

                            $fieldList.= ', '.$field['rDisplayFields'];
                            if($pos = strpos($field['rTableName']," "))
                            {
                                $pos = $pos+1;
                                $alias = substr($field['rTableName'],$pos,(strlen($field['rTableName'])-$pos));
                                $innerJoinTableCond.= 'left join '.$field['rTableName'].'
													ON '.$alias.'.'.$field['rFieldName'].' = '.$this->fieldList[$i]['rTableName'].'.'.$field['fieldName'].' ';
                            }
                            else
                                $innerJoinTableCond.= 'left join '.$field['rTableName'].'
													ON '.$field['rTableName'].'.'.$field['rFieldName'].' = '.$this->fieldList[$i]['rTableName'].'.'.$field['fieldName'].' ';
                        }
                    }

                    //$this->fieldList[$i]['rSourcePointerField'] - primary key of linked table
                    $sql = 'select
								'. $this->fieldList[$i]['rTableName'].'.'.$this->fieldList[$i]['rSourcePointerField'] .' relatedField
								'.$fieldList.'
							from
								'. $this->fieldList[$i]['rTableName'].'
							'.$innerJoinTableCond.'
							where
								'.$this->fieldList[$i]['rTableName'].'.'.$this->fieldList[$i]['rFieldName']." = '{$arrayValues[$this->fieldList[$i]['fieldName']]}'";
//								'.$this->fieldList[$i]['rTableName'].'.'.$this->fieldList[$i]['rFieldName']." = '"."$contentId'";

                    $whereParam=$this->getWhereParam($this->fieldList[$i]);

                    if($whereParam!='')
                        $sql.=' and '.$whereParam;

                    if(	$this->db->query('SELECT * FROM '.$this->fieldList[$i]['rTableName'].' LIMIT 1') &&
                        array_key_exists('websiteId',$this->db->result[0]) )
                    {
                        $sql.=' and '.$this->fieldList[$i]['rTableName'].'.websiteId = '.Context::SiteSettings()->getSiteIdFromSession();
                    }

                    if(strlen($this->fieldList[$i]['rSourceLinkField'])>0)
                        $sql.=" ORDER BY {$this->fieldList[$i]['rTableName']}.{$this->fieldList[$i]['rSourceLinkField']}";

                    //Getting array with selected values
                    if($this->db->query($sql))
                    {
                        $tempValues = $this->db->result;
                        $values=array();
                        for($j=0;$j<count($tempValues);$j++)
                        {
                            $values[$j]=array('relatedField'=>'', 'values'=>'');
                            //generation array Values for display fields
                            foreach ($tempValues[$j] as $key=>$value)
                            {
                                if($key=='relatedField')
                                {
                                    $values[$j]['relatedField']=$value;
                                }
                                else
                                {
                                    $values[$j]['values'][$key]=$value;
                                }
                            }
                        }
                        $this->fieldList[$i]['defaultValue']=$values;
                        $this->fieldList[$i]['availableValues']=$allowFields;
                        $this->fieldList[$i]['valueRelatedToList']=$arrayValues[$this->fieldList[$i]['fieldName']];
                    }
                    elseif(!$this->db->error)
                    {
                        $this->fieldList[$i]['defaultValue'] ='';
                        $this->fieldList[$i]['valueRelatedToList']=$arrayValues[$this->fieldList[$i]['fieldName']];
                    }
                    else
                    {
                        $this->errorStr='multiply error';
                        $this->isDataLoad = false;

                        //logging error
                        include_once(SITE_PATH.'vendors/Pear/Log.php');
                        $logger = &Log::singleton('file', SITE_PATH.'logs/viewBuilder.log');
                        $logger->log("viewId {$this->viewId}\t error get data for many-to-many field with type 33\t$sql");
                    }
                }
            }
            else
            {
                //Combine Sql Query for getting data in relation "many to many"
                if (strlen($this->fieldList[$i]['rDisplayFields']) > 0)
                {
                    $displayFields = ', '.$this->fieldList[$i]['rDisplayFields'];
                }
                else
                    $displayFields='';

                $sourceTbl=$this->fieldList[$i]['rSourceTableName'];
                $relationsTbl=$this->fieldList[$i]['rTableName'];
                $primaryKeySourceTbl=$this->fieldList[$i]['rSourceLinkField'];
                $foreignKeySourceTbl=$this->fieldList[$i]['rSourcePointerField'];
                $foreignKeyCurrentTbl=$this->fieldList[$i]['rFieldName'];

                $sql = 'select '.$sourceTbl.'.'.$primaryKeySourceTbl.' relatedField'.$displayFields.' from '.$sourceTbl;
                $sql.= ' inner join '.$relationsTbl. ' on '.$sourceTbl.'.'.$primaryKeySourceTbl.'='.$relationsTbl.'.'.$foreignKeySourceTbl;
                $sql.= ' where '.$relationsTbl.'.'.$foreignKeyCurrentTbl."='"."$contentId'";
                $whereParam=$this->getWhereParam($this->fieldList[$i]);
                if($whereParam!='')
                    $sql.=' and '.$whereParam;
                $sql.= " Order By $relationsTbl.id ";

                //Getting array with selected values
                if($this->db->query($sql))
                {
                    //$this->fieldList[$i]['defaultValue'] = $this->db->result;
                    $tempValues = $this->db->result;
                    $values=array();
                    for($j=0;$j<count($tempValues);$j++)
                    {
                        $values[$j]=array('relatedField'=>'', 'values'=>'');
                        //generation array Values for display fields
                        foreach ($tempValues[$j] as $key=>$value)
                        {
                            if($key=='relatedField')
                            {
                                $values[$j]['relatedField']=$value;
                            }
                            else
                            {
                                $values[$j]['values'][$key]=$value;
                            }

                        }
                    }
                    $this->fieldList[$i]['defaultValue']=$values;
                }
                elseif(!$this->db->error)
                    $this->fieldList[$i]['defaultValue'] ='';
                else
                {
                    $this->errorStr='multiply error';
                    $this->isDataLoad = false;

                    //logging error
                    include_once(SITE_PATH.'vendors/Pear/Log.php');
                    $logger = &Log::singleton('file', SITE_PATH.'logs/viewBuilder.log');
                    $logger->log("viewId {$this->viewId}\t error get data for many-to-many field with type any type \t$sql");
                }
            }
        }
    }

	// ќчищает все сложные пол€. »спольз. дл€ копировани€ представлений.
	function prepareFieldsForCopy($IdName='id', $langId, $simpleCopy)
	{
		for($i=0;$i<count($this->fieldList);$i++)
		{
			$fieldType = $this->fieldList[$i]['fieldType'];
			$fieldName = $this->fieldList[$i]['fieldName'];
			if($fieldName==$IdName and $fieldType<30)
			{
				$this->fieldList[$i]['defaultValue']='';
			}
            elseif($fieldType == 29 or $fieldType == 32 or $fieldType == 33)//tree and dinam. Content
			{
				$this->fieldList[$i]['defaultValue']='';
			}
			elseif($fieldName == 'langId' && Context::SiteSettings()->multiLanguage()) // ≈сли langId не null значит идет каскадное поэтапное копирование €зыков | if Context::SiteSettings()->multiLanguage()
			{
				//$this->fieldList[$i]['defaultValue'] = array(); если мы переопределим, то затрем все нужные значени€ $relations
				if($langId)
				{
					$this->fieldList[$i]['defaultValue']['value'] = $langId;
					$this->fieldList[$i]['defaultValue']['copyContentLang'] = true;
				}
				elseif(!$simpleCopy) 
				{
					$this->fieldList[$i]['defaultValue']['value'] = null;
					$this->fieldList[$i]['defaultValue']['copyContent'] = true;
				}
			}
			elseif($fieldName == 'masterPageId' && Context::SiteSettings()->multiLanguage() && $langId)  // ≈сли langId не null значит идет каскадное поэтапное копирование €зыков
			{
				//необходимо установить соответствующй изыку шаблон, не тот который есть у копируемой записи
				for ($j=0; $j<count($this->fieldList[$i]['defaultValue']); $j++)
				{
					if($this->fieldList[$i]['defaultValue'][$j]['selected'] == 1)
					{
						$masterPageId = $this->getRelatedMasterPageId($this->fieldList[$i]['defaultValue'][$j]['relatedField'],$langId);
						$this->fieldList[$i]['defaultValue'][$j]['selected'] = 0;
					}
				}
				
				for ($j=0; $j<count($this->fieldList[$i]['defaultValue']); $j++)
				{
					if($this->fieldList[$i]['defaultValue'][$j]['relatedField'] == $masterPageId)
					{
						$this->fieldList[$i]['defaultValue'][$j]['selected'] = 1;
					}
				}
			}
		}
	}
	
	private function getRelatedMasterPageId($masterPageId, $langId)
	{
		if($this->db->query('
					SELECT 	
						related.id
					FROM fe_MasterPages masterPage
					INNER JOIN fe_MasterPages related 
						ON related.relationId = masterPage.relationId
					WHERE 
						masterPage.id ='.$masterPageId.' AND
						related.langId ='.$langId.'
					'))
		{
			if( count($this->db->result)>0 )
			{
				return $this->db->result[0]['id'];
			}
			//exeption
		}
		return false;
	}

	// удал€ет св€зи с зависимым контентом и (в случае dynamic content) сам зависимый контент
    function deleteRelatedValues($arrayValues, $contentId)
    {
        for($i=0;$i<count($this->fieldList);$i++)
        {
            $fieldType = $this->fieldList[$i]['fieldType'];

            if($fieldType == 29)//tree
            {
                $tree = new TREE($this->db, $arrayValues[$this->fieldList[$i]['fieldName']]);
                $tree->deleteTree();
            }
            elseif ($fieldType == 31)//related Content
            {
                //Combine Sql Query for getting data in relation "many to many"
                $sourceTbl=$this->fieldList[$i]['rSourceTableName'];
                $relationsTbl=$this->fieldList[$i]['rTableName'];
                $primaryKeySourceTbl=$this->fieldList[$i]['rSourceLinkField'];
                $foreignKeySourceTbl=$this->fieldList[$i]['rSourcePointerField'];
                $foreignKeyCurrentTbl=$this->fieldList[$i]['rFieldName'];
                $sql= "delete from $relationsTbl where $foreignKeyCurrentTbl='$contentId'";
                if(isset($whereParam) && $whereParam!='')
                    $sql.=' and '.$whereParam;

                if(!$this->db->query($sql))
                    $this->errorStr = "ERROR delete data from related table for fieldType = 31";
            }
            elseif ($fieldType == 32)//dynamic Content
            {
                //Combine Sql Query for getting data in relation "many to many"
                $sourceTbl=$this->fieldList[$i]['rSourceTableName'];
                $relationsTbl=$this->fieldList[$i]['rTableName'];
                $primaryKeySourceTbl=$this->fieldList[$i]['rSourceLinkField'];
                $foreignKeySourceTbl=$this->fieldList[$i]['rSourcePointerField'];
                $foreignKeyCurrentTbl=$this->fieldList[$i]['rFieldName'];

                /** Getting data from source **/
                $sql= "select $foreignKeySourceTbl from $relationsTbl where $relationsTbl.$foreignKeyCurrentTbl='$contentId'";
                if(isset($whereParam) && $whereParam!='')
                    $sql.=' and '.$whereParam;
                $sql = "delete from $sourceTbl where $primaryKeySourceTbl in ($sql)";

                //delete source data
                if($this->db->query($sql))
                {
                    $sql= "delete from $relationsTbl where $foreignKeyCurrentTbl='$contentId'";
                    if($whereParam!='')
                        $sql.=' and '.$whereParam;

                    if(!$this->db->query($sql))
                        $this->errorStr = "ERROR delete data from related table for fieldType = 32";
                }
                else
                    $this->errorStr = "ERROR delete source data for fieldType = 32";
            }
            elseif ($fieldType == 33)//dynamic Content Many to one
            {
                //Combine Sql Query for getting data in relation "many to one"
                $relationsTbl=$this->fieldList[$i]['rTableName'];
                $foreignKeyCurrentTbl=$this->fieldList[$i]['rFieldName'];

                $whereParam=$this->getWhereParam($this->fieldList[$i]);

                $sql = "delete from $relationsTbl where $foreignKeyCurrentTbl = $contentId";
                if($whereParam!='')
                    $sql.=' and '.$whereParam;

                //delete source data
                if(!$this->db->query($sql))
                    $this->errorStr = "ERROR delete source data for fieldType = 33";
            }
        }
    }

	/*function get where parameters for complex fields
	param:
		1 - return "fildName=fildValue[and ...]"
		2 - return "fildName, fildName[, ...]"
		3 - return "'fildValue', 'fildValue'[, ...]"	*/
	function getWhereParam(&$field, $param=1)
	{
		$whereStr='';

		//var_dump($field);
		switch ($param)
		{
			case 1:
				$sql="select whereName, whereValue
				from be_WhereParam
				where fieldId='".$field['fieldId']."'";
				if($this->db->query($sql))
				{
					foreach ($this->db->result as $whereParam)
					{
						if($whereStr=='')
							$whereStr=$whereParam['whereName'].' in ('.$whereParam['whereValue'].')';
						else
							$whereStr.=' and '.$whereParam['whereName'].' in ('.$whereParam['whereValue'].')';
					}
				}
				break;
			case 2:
				$sql="select whereName
				from be_WhereParam
				where fieldId='".$field['fieldId']."'";
				if($this->db->query($sql))
				{
					foreach ($this->db->result as $whereParam)
					{
						if($whereStr=='')
							$whereStr=$whereParam['whereName'];
						else
							$whereStr.=', '.$whereParam['whereName'];
					}
				}
				break;
			case 3:
				$sql="select whereValue
				from be_WhereParam
				where fieldId='".$field['fieldId']."'";
				if($this->db->query($sql))
				{
					foreach ($this->db->result as $whereParam)
					{
						if($whereStr=='')
							$whereStr=$whereParam['whereValue'];
						else
							$whereStr.=" ,whereParam['whereValue']";
					}
				}
				break;
		}
		return $whereStr;
	}


		/*function getFieldDbValue($fieldId, $arrayValues, $contentId)
	{
		if($this->db->query('SELECT * FROM be_Fields WHERE fieldId='.$fieldId))
		{
			$field  = $this->db->result[0];
			$name = $field['fieldName'];

			if($field['fieldType'] < 30)
			{//simlpe fields (without relations)
				$field['defaultValue'] = $arrayValues[$name];
				return $field;
			}
			//filds with relations
			elseif(strlen($field['rTableName']) > 0 and strlen($field['rSourceTableName']) == 0)
			{
				//Combine Sql Query for getting data in relation "one to many"
				if (strlen($field['rDisplayFields']) > 0)
				{
					$displayFields = ', '.$field['rDisplayFields'];

				}
				else
					$displayFields='';

				$sql = 'select '.$field['rFieldName'] .' relatedField'.$displayFields.' from '. $field['rTableName'];
				$whereParam=$this->getWhereParam($field);
				if($whereParam != '')
					$sql.=' where '.$whereParam;
				//Getting array with possible values
				if($this->db->query($sql))
				{
					$tempValues = $this->db->result;
					//For value which are choosed, add ['selected'] = 1
					for($j=0;$j<count($tempValues);$j++)
					{
						$values[$j]=array('relatedField'=>'', 'values'=>'', 'selected'=>0);
						//generation array Values for display fields
						foreach ($tempValues[$j] as $key=>$value)
						{
							if($key=='relatedField')
							{
								$values[$j]['relatedField']=$value;
								//check if element is saved in object
								if($arrayValues[$name]==$value)
									$values[$j]['selected']=1;
							}
							else
							{
								$values[$j]['values'][$key]=$value;
							}

						}
					}
					$field['defaultValue'] = $values;//$tempValues;
					return $field;
				}
				else
				{
					echo 'DropDown error';
					$this->isDataLoad = false;
				}
			}
			else
			{
				//Combine Sql Query for getting data in relation "many to many"
				if (strlen($field['rDisplayFields']) > 0)
				{
					$displayFields = ', '.$field['rDisplayFields'];
				}
				else
					$displayFields='';

				$sourceTbl=$field['rSourceTableName'];
				$relationsTbl=$field['rTableName'];
				$primaryKeySourceTbl=$field['rSourceLinkField'];
				$foreignKeySourceTbl=$field['rSourcePointerField'];
				$foreignKeyCurrentTbl=$field['rFieldName'];

				$sql = 'select '.$sourceTbl.'.'.$primaryKeySourceTbl.' relatedField'.$displayFields.' from '.$sourceTbl;
				$sql.= ' inner join '.$relationsTbl. ' on '.$sourceTbl.'.'.$primaryKeySourceTbl.'='.$relationsTbl.'.'.$foreignKeySourceTbl;
				$sql.= ' where '.$relationsTbl.'.'.$foreignKeyCurrentTbl."='"."$contentId'";
				$whereParam=$this->getWhereParam($field);
				if($whereParam!='')
					$sql.=' and '.$whereParam;
				echo '<br>'.$sql;
				//Getting array with selected values
				if($this->db->query($sql))
				{
					//$this->fieldList[$i]['defaultValue'] = $this->db->result;
					$tempValues = $this->db->result;
					$values=array();
					for($j=0;$j<count($tempValues);$j++)
					{
						$values[$j]=array('relatedField'=>'', 'values'=>'');
						//generation array Values for display fields
						foreach ($tempValues[$j] as $key=>$value)
						{
							if($key=='relatedField')
							{
								$values[$j]['relatedField']=$value;
							}
							else
							{
								$values[$j]['values'][$key]=$value;
							}

						}
					}
					$field['defaultValue']=$values;
					return $field;
				}
				elseif(!$this->db->error)
				{
					$field['defaultValue'] ='';
					return $field;
				}
				else
				{
					$this->errorStr='multiply error';
					$this->isDataLoad = false;
				}
			}
		}
		else return false;
	}*/
}
?>