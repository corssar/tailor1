<?
include_once(FRAMEWORK_PATH."system/helper/Guid.php");
include_once(FRAMEWORK_PATH."system/Languages.php");

class ViewController {

	var $response = array('HTML'=>'', 'JS' => '');

	public function viewBrowse($parameters)
	{
		global $lang;
		$viewTypes = $parameters['viewType'];
		$db = DB::getInstance();

		foreach ($viewTypes as $viewType)
		{
			$views    = VIEW::getViewsByType($viewType, $db);
			foreach ($views as $v)
			{
				$this->response['HTML'] .= '<div class="div_td">
												<div class="text">'.$v['name'].'</div>
												<input type="button" value="'.$lang['ADD_TEXT'].'" class="button" onclick="viewDataObject'.$v['viewId'].' = new ViewDataObject('.$v['viewId'].',\'general\'); navigation.sendRequest(\'ViewController\',\'viewBuild\',{viewId:'.$v['viewId'].',itemId:0});">
											</div>';
				$this->response['JS'] = 'Menu.leftenable();';
			}
		}

		return $this->response;
	}

	public function viewBuild($parameters,$formDataArray)
	{
		global $lang;

		$db = DB::getInstance();

		$objView = new VIEW($db, $parameters['viewId']);
		$parameters['viewType'] = $objView->property['viewType'];
		$parameters['deleteAllow'] = $objView->property['deleteAllow'];
		$parameters['copyAllow'] = $objView->property['copyAllow'];
		$parameters['editAllow'] = $objView->property['editAllow'];		
		$parameters['addItemViewId'] = $objView->property['addItemViewId'];
        $parameters['canApply'] = $objView->property['canApply'];
        $parameters['autoSearch'] = $objView->property['autoSearch'];
		
		if ($objView->property['viewType'] != SEARCH_VIEW_TYPE ) //if !searchForm
		{
			if( (isset($parameters['itemId']) && $parameters['itemId']) && 
				(isset($parameters['copyContent']) || isset($parameters['copyRelatedContent']))
				)
			{
				if(isset($parameters['copyContent']) && $parameters['copyContent'])
				{
					$objView->simpleCopy = true;
					$objView->copyContent($parameters['itemId']);
				}
				elseif(isset($parameters['copyRelatedContent']))
				{
					$objView->copyContent($parameters['itemId'], 'id', isset($parameters['nextLangId']) ? $parameters['nextLangId'] : null );
				}
					
				$parameters['itemId'] = null;
			}
			elseif(isset($parameters['itemId']) && $parameters['itemId'])
			{
				$objView->setFieldsValue($parameters['itemId']);
			}

			$objFormBuilder = new PageBuilder($parameters, $objView->getViewGroup(), $objView->fields->getFieldList());
			$this->response['HTML'] = $objFormBuilder->buildPage($objView->property['name']);

			$this->response['JS'] = $objFormBuilder->getFieldsJS('buildform');
			$this->response['JS'].= "document.getElementById('multiSiteSelect').disabled = true;Menu.leftenable();";
		}
		else
		{
			$searchData = array();
			$objView 			 = new VIEW($db, $parameters['viewId']);
			$objViewSearchResult = new VIEW($db, $parameters['viewId'],false);
            if($parameters['autoSearch'])
                $JS = '$("#viewButton'.$parameters['viewId'].'").click();';
			if(is_array($formDataArray) && count($formDataArray) > 0)
			{
                $JS = '';
				$objSearch = new SEARCH($db, $parameters['viewId']);
				$searchData = $objSearch->process($formDataArray['view'],$parameters['page']);
				foreach ($formDataArray['view'] as $key=>$value)
				{
					$objView->setFieldById($key,$value);
				}
                if ($parameters['viewId'] == ORDER_MODERATION_VIEW && $searchData)
                {
                    $JS.= 'initModerationIframe();';
                    $JS.= '$("div.searchResultTable").css("min-height", "10px");';
                }
			}
			$objFormBuilder = new PageBuilder($parameters, $objView->getViewGroup(), $objView->fields->getFieldList());
			$this->response['HTML'] = $objFormBuilder->buildSearchPage($objView->property['name'],$parameters,$searchData,$objViewSearchResult->fields->getFieldList());
			$this->response['JS']   = $objFormBuilder->getFieldsJS().'Menu.leftenable();'.$JS;
		}

		return $this->response;
	}

	public function saveViewData($parameters,$addArray)
	{
		$bePostData = $addArray['view'];

		$db 		= DB::getInstance();
		$objView 	= new VIEW($db, $bePostData['viewId']);
		$validation = new Validation($db);

		$beFieldList = $objView->fields->getFieldList();

		$visible = 1;
		$text    = '';
		$istree  = false;

		global $productsViewWithPrefix;

		global $lang;

		$customFields = array();
		$languagesArray = array();
		
		foreach ($beFieldList as $be_Field)
		{
			$fieldId      = $be_Field['fieldId'];
			$fieldName    = $be_Field['fieldName'];
			$fieldType    = $be_Field['fieldType'];
			$displayType  = $be_Field['displayType'];
			$validation   = $be_Field['validation'];
			$groupId      = $be_Field['groupId'];
			$orderNumber  = $be_Field['orderNumber'];

			$rTableName        = $be_Field['rTableName'];
			$rSourceTableName  = $be_Field['rSourceTableName'];
			$rSourceLinkField  = $be_Field['rSourceLinkField'];
			$rSourcePointerField  = $be_Field['rSourcePointerField'];

			unset($beFieldValue);
			$customField = false;

			if(!$rSourcePointerField)
			{
				if($fieldType==4)
				{
					if($displayType == 1)
					{
						$beFieldValue = date("Y-m-d",strtotime($bePostData[$fieldId]));
					}
					elseif($displayType == 2)
					{
						$beFieldValue = date("Y-m-d H:i:s",strtotime($bePostData[$fieldId]." ".$bePostData[$fieldId."h"].":".$bePostData[$fieldId."m"]));
					}
				}
				elseif($fieldType==6)
				{
					$beFieldValue = isset($bePostData[$fieldId]) && $bePostData[$fieldId] =='on'?1:0;
					if($fieldName == 'visible' || $fieldName == 'active') $visible = $beFieldValue;
				}
				elseif($fieldType==3 || $fieldType==7 || $fieldType==8)
				{
					$beFieldValue = appUrl::ValuesToCMSConstants($bePostData[$fieldId]);
				}
				elseif($fieldType==10)
				{
					if($displayType == 2)
					{
						$customFields[] = array('class' => $rSourceTableName,
												'method' => $rSourceLinkField);
					}
					$customField = true;
				}
				elseif($fieldType==13)
				{
					
					//если прервали сохранение на одной из итераций каскадного поэтапного копировани€ контента, то масив languages не очищаетс€
					//и при новом добавлении контента идет копирование на €зыке, на котором было прервано сохранение (нажатие "—касувати" или переход куда-нибудь)
					
                	if(Context::SiteSettings()->multiLanguage() && is_array($bePostData[$fieldId]))
                	{
                		if( isset($bePostData[$fieldId]['languages']) && count($bePostData[$fieldId]['languages']) > 0 )
                		{
                			$languagesArray = $bePostData[$fieldId]['languages'];
                		}
                		
                		if( isset($bePostData[$fieldId]['value']) )
                		{
                			$beFieldValue = $bePostData[$fieldId]['value'];
                		}
                		
                		if (isset($bePostData[$fieldId]['relationId']))
                			$objView->setFieldByName("relationId", $bePostData[$fieldId]['relationId']);
                			
                	}
                	else
                		$beFieldValue = $bePostData[$fieldId];


                }
				elseif($fieldType==29)
				{
					if($displayType == 3)
					{
						$beFieldValue = $bePostData[$fieldId];
					}
					elseif(trim($rSourceTableName) != '')
					{
						//customized Tree
						require_once(BACKEND_PATH.'libs/Custom/'.$rSourceTableName.'.php');
						$objTree = new $rSourceTableName($db, 0, $rTableName);
						$objTree->saveTree($bePostData[$fieldId.'nodeOrders']);
                        $beFieldValue = $bePostData[$fieldId];
					}
					else
					{
						$objTree = new TREE($db,$bePostData[$fieldId], $rTableName);
						$objTree->saveTree($bePostData[$fieldId.'nodeOrders']);
						$beFieldValue = $bePostData[$fieldId];
					}
				}
				else
				{
					$beFieldValue = $bePostData[$fieldId];
				}

				if(!$customField)
				{
					if(!get_magic_quotes_gpc())
						$beFieldValue = addslashes($beFieldValue);

					$objView->setFieldByName($fieldName, $beFieldValue);
				}
			}
			else
			{
				if(isset($bePostData[$fieldId]) || $fieldType == 31 || $fieldType == 32 || $fieldType == 33)
					$objView->setComplexField(  $fieldId,
                                                isset($bePostData[$fieldId])?$bePostData[$fieldId]:'',
                                                isset($bePostData[$fieldId.'_valueRelatedToList'])?$bePostData[$fieldId.'_valueRelatedToList']:'' );
			}

			if($fieldName == 'id' && (isset($beFieldValue) && $beFieldValue))
			{
				$id = $beFieldValue;
			}
			if( ($fieldName == 'treeItemName') && $beFieldValue)
			{
				$text = $beFieldValue;
				$istree = true;
			}
		}

		$paramForTree = $istree?',\''.$text.'\','.$visible:'';

		$queryError = false;

		if(isset($id) && $id)
		{
			if($objView->update($id))
			{
                if (isset($parameters['accept']) && $parameters['accept'] == '1') {
                    $this->response['JS'] .= 'dialogMessageBox.hideDiv();';
                } else {
                    //дл€ перехода между св€занным контентом. »дет сохранение редактируемого контента сначала, потом переключение на редактирование св€занного.
                    if(	isset($parameters['viewId']) && $parameters['viewId'] &&
                        isset($parameters['itemId']) && $parameters['itemId']
                        )
                    {
                        $this->response['JS'].= 'navigation.sendRequest(\'ViewController\',\'viewBuild\',{viewId: '.$parameters['viewId'].', itemId: '.$parameters['itemId'].'});';
                    }
                    else
                    {
                        $this->response['JS'] = "viewDataObject{$bePostData['viewId']}.objUpdateDestroy($id$paramForTree);";
                    }
                }
			}
			else
				$queryError = true;
		}
		else
		{
			if($id = $objView->create())
			{
				$this->response['JS'] = '';
				if(count($languagesArray)>0 && !$queryError)
				{
					$this->response['JS'].= 'languagesObj.itemLanguages = new Array();';
					foreach ($languagesArray as $item)
					{
						$this->response['JS'].= 'languagesObj.addLanguageToList('.$bePostData['viewId'].','.$id.','.$item.');';
					}
				}
                if (isset($parameters['accept']) && $parameters['accept'] == '1') {
                    $this->response['JS'] .= 'dialogMessageBox.hideDiv();';
                } else {
                    if(	isset($parameters['viewId']) && $parameters['viewId'] &&
                        isset($parameters['itemId']) && $parameters['itemId']
                        )
                    {
                        $this->response['JS'].= 'navigation.sendRequest(\'ViewController\',\'viewBuild\',{viewId: '.$parameters['viewId'].', itemId: '.$parameters['itemId'].'});';
                    }
                    else
                    {
                        $this->response['JS'].= 'viewDataObject'.$bePostData['viewId'].'.objAddDestroy('.$id.$paramForTree.');';
                    }
                }
			}
			else
				$queryError = true;
		}
		if($queryError)
		{
			$this->response['JS'] = "alert('".addslashes($objView->createViewDataError)."');dialogMessageBox.hideDiv();";
		}
		if(count($customFields)>0 && !$queryError)
		{
			foreach ($customFields as $value)
			{
				require_once(BACKEND_PATH.'libs/Custom/'.$value['class'].'.php');
				$Controller = new $value['class']();
				$Controller->$value['method']($id,is_array($addArray['customField'])?$addArray['customField']:array());
			}
		}
		
		if($objView->property['viewType'] != 5)
		{
			$this->response['JS'].= "document.getElementById('multiSiteSelect').disabled = false;";
		}
		
		return $this->response;
	}
	
	public function preliminarySaveViewData($parameters,$addArray)
	{
		$bePostData = $addArray['view'];

		$db 		= DB::getInstance();
		$objView 	= new VIEW($db, $bePostData['viewId']);

		$beFieldList = $objView->fields->getFieldList();
		
		$primaryKeyFieldId = 0;
		$relatedFieldId = $parameters['relatedFieldId'];
		$addDcItem = isset($parameters['addDcItem']) && $parameters['addDcItem'] ? true : false;
		$addProductVariations = isset($parameters['addProductVariations']) && $parameters['addProductVariations'] ? true : false;

		foreach ($beFieldList as $be_Field)
		{
			$fieldId      = $be_Field['fieldId'];
			$fieldName    = $be_Field['fieldName'];
			$fieldType    = $be_Field['fieldType'];
			$displayType  = $be_Field['displayType'];
			$displayName  = $be_Field['displayName'];

			unset($beFieldValue);

			if($fieldName == 'id' && $displayName=='' && $fieldType==1 && $displayType==0)
				$primaryKeyFieldId = $fieldId;
			
			if($fieldType==4)
			{
				if($displayType == 1)
				{
					$beFieldValue = date("Y-m-d",strtotime($bePostData[$fieldId]));
				}
				elseif($displayType == 2)
				{
					$beFieldValue = date("Y-m-d H:i:s",strtotime($bePostData[$fieldId]." ".$bePostData[$fieldId."h"].":".$bePostData[$fieldId."m"]));
				}
			}
			elseif($fieldType==6)
			{
				$beFieldValue = isset($bePostData[$fieldId]) && $bePostData[$fieldId] =='on'?1:0;
				if($fieldName == 'visible' || $fieldName == 'active') $visible = $beFieldValue;
			}
			elseif($fieldType==3 || $fieldType==7 || $fieldType==8)
			{
				$beFieldValue = appUrl::ValuesToCMSConstants($bePostData[$fieldId]);
			}
			elseif($fieldType==13)
			{
            	if(Context::SiteSettings()->multiLanguage() && is_array($bePostData[$fieldId]))
            	{
            		if( isset($bePostData[$fieldId]['value']) )
            		{
            			$beFieldValue = $bePostData[$fieldId]['value'];
            		}
            		
            		if (isset($bePostData[$fieldId]['relationId']))
            			$objView->setFieldByName("relationId", $bePostData[$fieldId]['relationId']);
            	}
            	else
            		$beFieldValue = $bePostData[$fieldId];

            }
            elseif($fieldType==33)
            {
            	$beFieldValue = isset($bePostData[$fieldId.'_valueRelatedToList'])?$bePostData[$fieldId.'_valueRelatedToList']:'';
            }
			else
			{
				$beFieldValue = $bePostData[$fieldId];
			}

			if(!get_magic_quotes_gpc())
				$beFieldValue = addslashes($beFieldValue);

			$objView->setFieldByName($fieldName, $beFieldValue);
		}
		
		if($id = $objView->create())
		{
			$this->response['JS'] = "document.getElementById('$primaryKeyFieldId').value = '$id';";
            if($addDcItem)
			    $this->response['JS'].= "dcField$relatedFieldId.openAddItem();";
            if($addProductVariations)
            {
                $parameters['productId'] = $id;
                $this->generateProductVariations($parameters);
            }
		}
		else
			$this->response['JS'] = "alert('".addslashes($objView->createViewDataError)."');";
		
		return $this->response;
	}
	
	public function deletePreliminarySavedData($parameters)
	{
		$db = DB::getInstance();

		$objView = new VIEW($db, $parameters['viewId']);
		$objView->deleteContent($parameters['itemId']);
		return $this->response;
	}

    public function generateProductVariations($parameters)
    {
        $attributes = json_decode($parameters['attributes'],true);
        $productId = $parameters['productId'];

        //getting storage field name for attributes()
        $query = "Select * from fe_ProductAttributes";
        if(!Context::DB()->query($query))
            exit("There is no configured attributes in DB(table name - fe_ProductAttributes)");
        foreach (Context::DB()->result as $attribute)
            $attributesSettings[$attribute['id']] = array('storageFieldName'=>$attribute['storageFieldName'], 'title'=>$attribute['title']);

        $attributesList = array_keys($attributes);
        if(count($attributesList)==0)
            exit("There is attributes to create variations");

        //generate variations from attribute values
        $variations = $this->addAttributeForVariation(array(), $attributes, $attributesList, 0, array());

        //generate sqlQuery for variation creation
        $variationQuery = "INSERT INTO fe_ProductVariations (productId, stock";
        for($j=0; $j<count($attributesList); $j++)
            $variationQuery.= ", ".$attributesSettings[$attributesList[$j]]['storageFieldName'];

        $variationQuery.=') VALUES
                         ';
        for($i=0; $i<count($variations); $i++)
        {
            if($i>0)
                $variationQuery.=',';

            $variationQuery.="($productId, 10";
            for($j=0; $j<count($variations[$i]); $j++)
                $variationQuery.=", {$variations[$i][$j]}";

            $variationQuery.=")";
        }
        Context::DB()->query($variationQuery);

        //select inserted variations
        $querySelect = " SELECT
                            fe_ProductVariations.id as variationId,
                            fe_ProductVariations.stock";
        $queryJoin = "FROM
                            fe_ProductVariations";
        for($j=0; $j<count($attributesList); $j++)
        {
            $querySelect.=",a$j.title attribute$j";
            $queryJoin.= " LEFT JOIN
                            fe_ProductAttributeItems a$j
                            ON
                                a$j.id = fe_ProductVariations.{$attributesSettings[$attributesList[$j]]['storageFieldName']}
                            ";

        }

        $query = "  $querySelect
                    $queryJoin
                    WHERE
                        fe_ProductVariations.productId = $productId
                        ";
        //Should be revrited, by Andrew !!!
        if(Context::DB()->query($query))
        {
            $dcItemsArray="";
            foreach (Context::DB()->result as $item)
            {
                $dcItemsArray.= "	{insertedId:".$item['variationId'].",
                                            3260:'".$item['stock']."',
                                            3314:'".$item['attribute0']."',
                                            3313:'".$item['attribute1']."'
                                            },";
            }
            $this->response['JS'].= "dcField{$parameters['relatedFieldId']}.addItemsList([".substr($dcItemsArray,0,-1)."]);";
        }
        return $this->response;
    }

    function addAttributeForVariation($variationArray, $attributes, $attributesList, $attributeNr,  $result)
    {
        for($i=0; $i<count($attributes[ $attributesList[$attributeNr] ]); $i++)
        {
            $currentVariation = $variationArray;
            array_push($currentVariation, $attributes[ $attributesList[$attributeNr] ][$i]);
            //if last attribute, add combined variation to result
            if($attributeNr == (count($attributesList)-1 ))
            {
                $result[]=$currentVariation;
            }
            else
            {
                //current is not full, to these variation will be added by next attribute(s)
                $result = $this->addAttributeForVariation($currentVariation, $attributes, $attributesList, $attributeNr+1,  $result );
            }

        }
        return $result;
    }

	public function deleteTempTreeNodes($parameters)
	{
		$db = DB::getInstance();
		if($parameters['treeClass'] != 'TREE')
			require_once(BACKEND_PATH.'libs/Custom/'.$parameters['treeClass'].'.php');

		$objTree = new $parameters['treeClass']($db,$parameters['treeId'],$parameters['treeTable']);
		$objTree->cancelTreeChanges();
		return $this->response;
	}

	public function deleteContentItem($parameters)
	{
		global $lang;
		$db = DB::getInstance();

		$objView = new VIEW($db, $parameters['viewId']);
		$objView->deleteContent($parameters['itemId']);
		$this->response['JS'] = 'xajax_goBack();alert(\''.$lang['DELETED_SUCCESSFULLY'].'\');';
		return $this->response;
	}

	public function fe_AddWords($parameters)
	{
		$db = DB::getInstance();

		if(isset($parameters['letters']) && isset($parameters['insert']))
		{
			$letters = $parameters['letters'];

			$db->query("insert into fe_AddWords (text) values ('".$letters."')");
			if($db->query("select id,text from fe_AddWords where text = '".$letters."'"))
			{
				$html = $db->result[0]['id'].",'".$db->result[0]['text']."'";
			}
			$this->response['JS'] 	= "dlField{$parameters['fieldId']}.setNewItem($html);";
		}
		elseif(isset($parameters['letters']))
		{
			$letters = $parameters['letters'];
			$html = '[';

			if($db->query("select id,text from fe_AddWords where text like '%".$letters."%'"))
			{
				foreach ($db->result as $item)
				{
					$html.= "{id:".$item["id"].",value:'".$item["text"]."'},";
				}
				$html = substr($html,0,-1);
			}
			$html.= ']';
			$this->response['JS'] 	= "dlField{$parameters['fieldId']}.showLoadedList($html);";
		}
		return $this->response;
	}
	
	public function getUsers($parameters)
	{
		$html = '[';
		$db = DB::getInstance();
		if(isset($parameters['letters']))
		{
			$letters = $parameters['letters'];
			if(strpos($letters," "))
			{
				$userData = explode(" ",trim($letters));
				$emailCondition = '';
				$name_surname = array();
				$i=0;
				foreach ($userData as $item)
				{
					if(strpos($item,"@"))
						$emailCondition = "AND email like '%".$item."%'";
					else 
						$name_surname[$i] = $item;	
				}
				$query = "	SELECT 
								id, name, surname, email 
							FROM fe_Users 
							WHERE 
								(
									(name like '%".$name_surname[0]."%' AND surname like '%".$name_surname[1]."%') OR
									(name like '%".$name_surname[1]."%' AND surname like '%".$name_surname[0]."%')
								) 
								".$emailCondition."
							";			
			}
			else 
			{
				$query = "	SELECT 
								id, name, surname, email 
							FROM fe_Users 
							WHERE 
								(
									name like '%".$letters."%' OR 
									surname like '%".$letters."%' OR 
									email like '%".$letters."%'
								)
							";
			}
			//$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
			if($db->query($query))
			{
				foreach ($db->result as $item)
				{
					$html.= "{id:".$item["id"].",value:'".$item["name"]." ".$item["surname"]." ".$item["email"]."'},";
				}
				$html = substr($html,0,-1);
			}
		}
		$html.= ']';
		$this->response['JS'] 	= "dlField{$parameters['fieldId']}.showLoadedList($html);";
		return $this->response;
	}

	public function addPhotoFolder($resourceInfo)
	{
		global $filemanagertypes;
		global $lang;
		$objPath=$resourceInfo['objPath'];
		$objType=$resourceInfo['objType'];
		$type = strtolower($resourceInfo['type']);
		if ($objType=="folder")
		{
			$fileManagerPath = $filemanagertypes[$type].$objPath;
			$dirname = SITE_PATH.DIR_FOR_FILEMANAGER_PATH.$fileManagerPath;

			$imageFiles = false;
	        if (is_dir($dirname) && $dir_handle = opendir($dirname))
	        {
	        	require_once(SITE_PATH."vendors/Pear/JpegXmpReader.php");

                $dcItemsArray = '';
	        	$db = DB::getInstance();
				$query = "	SELECT
								dcItemFields.fieldId,
								dcItemFields.fieldName,
								dcItemFields.fieldType,
								dcItemFields.viewId
							FROM
								be_Fields
							INNER JOIN
								be_Fields as dcItemFields
								ON
									dcItemFields.viewId = be_Fields.rSearchViewId
							WHERE
								be_Fields.fieldId = ".$resourceInfo['dcFieldId'];
				if($db->query($query))
				{
					$dcFieldsIDs = array();
					$dcItemViewId = $db->result[0]['viewId'];
					foreach ($db->result as $field)
					{
						if($field['fieldName'] == 'text3')
							$dcFieldsIDs['image'] = $field['fieldId'];
//						if($field['fieldName'] == 'text2')
//							$dcFieldsIDs['imageSmall'] = $field['fieldId'];
						if($field['fieldName'] == 'text4')
							$dcFieldsIDs['author'] = $field['fieldId'];
						if($field['fieldName'] == 'shortDescription')
							$dcFieldsIDs['description'] = $field['fieldId'];
					}
				}
		        while($file = readdir($dir_handle))
		        {
	                if  ($file  !=  "."  &&  $file  !=  "..")
	                {
	                    if  (!is_dir($dirname."/".$file))
	                    {
							$typename = array_pop(explode('.',$file));
							//if ($typename=='gif' || $typename=='bmp' || $typename=='png' || $typename=='jpg' || $typename=='jpeg')
							if ($typename=='jpg' || $typename=='jpeg' || $typename=='JPG' || $typename=='JPEG')
							{
								$imageMeta 	= new Image_JpegXmpReader($dirname."/".$file);
								$author 	= $imageMeta->getCreator();
								$description = $imageMeta->getDescription();

								$imageUrl = "{SITE_URL}/".DIR_FOR_FILEMANAGER_PATH.$fileManagerPath.$file;
								$dcImageUrl = str_replace("frontend/webcontent",'',DIR_FOR_FILEMANAGER_PATH.$fileManagerPath.$file);

								if(file_exists($dirname.'small/'.$file))
								{
									$imageSmallUrl = "{SITE_URL}/".DIR_FOR_FILEMANAGER_PATH.$fileManagerPath."small/".$file;
									$dcImageSmallUrl = str_replace("frontend/webcontent",'',DIR_FOR_FILEMANAGER_PATH.$fileManagerPath."small/".$file);
								}
//								$db->query("INSERT INTO fe_PagesRelatedItems
//												(`viewId`,`text3`,`text2`,`shortDescription`)
//											VALUES
//												($dcItemViewId,'$imageUrl','$imageSmallUrl','$description')
//											");
								$db->query("INSERT INTO fe_PagesRelatedItems
												(`viewId`,`text3`,`text4`,`shortDescription`,`number1`)
											VALUES
												($dcItemViewId,'$imageUrl','$author','$description',0)
											");

								//$dcItemsArray.= "{insertedId:{$db->LIID},{$dcFieldsIDs['image']}:'$dcImageUrl',{$dcFieldsIDs['imageSmall']}:'$dcImageSmallUrl',{$dcFieldsIDs['description']}:'$description'},";
								$dcItemsArray.= "{insertedId:{$db->LIID},{$dcFieldsIDs['image']}:'$imageUrl'},";
								$imageFiles = true;
							}
	                    }
	                }
		        }
		        $dcItemsArray = substr($dcItemsArray,0,-1);
		        closedir($dir_handle);
	        }

			if ($imageFiles)
			{
				$this->response['JS'] = "dcField{$resourceInfo['dcFieldId']}.addItemsList([$dcItemsArray]);fileManager.hideDiv();";
			}
			else
			{
				$this->response['JS'].="alert('{$lang['NO_IMAGE_FILES']} No jpg files');";
			}
			return $this->response;
		}
		$this->response['JS'] ="alert('You selected not folder')";
		return $this->response;
	}
	
	public function addNewRelation($parameters)
	{	
		$language = new LanguageContentManager();
		$language->specifyTableName($parameters['foundPageViewId']);
		
		if(!$parameters['pageId'])
		{
			if($language->isCreatedPageMergebleByLang($parameters['langId'],$parameters['foundPageId']))
			{
				$this->response['JS'] = "relatedItemsObj.updateFoundPageRelation('{$parameters['foundPageId']},{$parameters['foundPageViewId']}');";
				return $this->response;
			}
			$relationId = Guid::Generate();
		}
		elseif($parameters['pageId'] && $parameters['foundPageId'])
		{
			if($language->isPageRelated($parameters['pageId'],$parameters['foundPageId']))
			{
				$this->response['JS'] = "relatedItemsObj.updateFoundPageRelation('{$parameters['foundPageId']}',{$parameters['foundPageViewId']});";
				return $this->response;
			}
			elseif($language->isPageRelated($parameters['foundPageId'],$parameters['pageId']))
			{
				$this->response['JS'] = "relatedItemsObj.foundPageCantBeRelated();";
				return $this->response;
			}
		}

		$language->updateItemRelationId($parameters['foundPageId'],$parameters['relationId']);
		
		$this->response['JS'].= "relatedItemsObj.addRowToRelationList({$language->GetRelatedItems($parameters['pageId'], $parameters['relationId'])});";
		return $this->response;
	}
	
	public function updateFoundPageRelation($parameters)
	{
		$language = new LanguageContentManager();
		$language->specifyTableName($parameters['pageViewId']);
		
		if(isset($parameters['relationId']) && $parameters['relationId']!='' && $parameters['relationId']!='undefined')
			$relationId = $parameters['relationId'];
		else 
			;//log new exeption

		$language->updateItemRelationId($parameters['foundPageId'],$relationId);

		$this->response['JS'] = "relatedItemsObj.addRowToRelationList({$language->GetRelatedItems($parameters['pageId'], $parameters['relationId'])});";
		return $this->response;
	}
	
	public function deletePageRelation($parameters)
	{
		$language = new LanguageContentManager();
		$language->specifyTableName($parameters['pageViewId']);
		$language->deletePageRelation($parameters['pageId']);
		$this->response['JS'] = "relatedItemsObj.deletePageRelationRow({$parameters['rowIndex']});";
		return $this->response;
	}

    function setWebsiteId($params)
    {
        Context::SiteSettings()->setSiteIdFromSession($params['websiteId']);
        $this->response['JS'] = "document.location = adminUrl;";
        return $this->response;
    }

    function buildWebTextsSettings()
    {
        $viewObj = new SmartyView();
        $arrayData = array();

        $Languages = &Languages::getInstance();
        $arrayData['languages'] = $Languages->GetAllLanguages();
        $arrayData['exportFilePath'] = 'http://' . SiteSettings::getSiteUrl() . '/backend/libs/WebTexts/WebTextsExport.php';
        /** import tab  */
        include_once(FRAMEWORK_PATH.'system/helper/WebsiteManager.php');
        $arrayData['websites'] = WebsiteManager::getWebsitesWithLanguages();

        $this->response['HTML'] = $viewObj->fetch(BACKEND_PATH."templates/webTextsImportExport.tpl", $arrayData);
        $this->response['JS'] = 'Menu.leftenable();$( "#tabs" ).tabs();';

        return $this->response;
    }

    function exportWebTexts()
    {
        $viewObj = new SmartyView();
        $arrayData = array();

        //$webTextsExport = new WebTextsExport();
        //$webTextsExport->run(null);

        $this->response['HTML'] = $viewObj->fetch(BACKEND_PATH."templates/webTextsImportExport.tpl", $arrayData);
        $this->response['JS'] = 'Menu.leftenable();$( "#tabs" ).tabs();';

        return $this->response;
    }

    public function sendTestMail($params)
    {
        require_once(FRAMEWORK_PATH."system/WebText.php");
        EventManager::sendTestMail($params['body'], $params['email']);

        $this->response['HTML'] = "&nbsp;";
        $this->response['JS'] = 'Menu.leftenable();$(".eventLoader").hide();alert("' . WebText::getText("BO_TEST_MAIL_SEND", "“естова в≥дправка пройшла усп≥шно") . '")';

        return $this->response;
    }

    public function copySingleItem($params)
    {
        include_once(BACKEND_PATH."libs/FormBuilder/LanguageContent.php");
        $languageContentManager = new LanguageContentManager();
        $siteIds = array();
        if($params['allSites'] == 0)
        {
            $query = "SELECT id, name
                      FROM be_WebSites
                      WHERE id != '" . Context::SiteSettings()->getSiteIdFromSession() . "'
                      ORDER BY name";

            Context::DB()->query($query);
            foreach(Context::DB()->result as $site)
            {
                $siteIds[] = $site['id'];
            }
        }
        else
        {
            $siteIds = $params['siteIds'];
        }

        $result = $languageContentManager->copyItem($params['viewId'], $params['itemId'], $siteIds) ? 1 : 0;

        global $lang;
        $this->response['JS'] = 'Menu.leftenable(); copyItemResult("' .$result.'", "' . $lang['COPY_ITEM_FINISHED_SUCCESS'] . '", "' . $lang['COPY_ITEM_FINISHED_FAILD'] . '"); if (copyContentPopUpObj.isOpen)copyContentPopUpObj.close();';

        return $this->response;
    }

    public function applyOrderChanges($params)
    {
        require_once(FRAMEWORK_PATH."system/webshop/order.php");
        $orderId = Order::getOrderIdById($params['orderId']);
        $order = new Order($orderId);
        $order->setOrderStatus($params['orderStatusId']);

        OrderStatusHistory::saveHistory($params['orderId'], $params['orderStatusId'], $order->properties['paymentStatusId'], true, $params['notificationEmailText']);

        EventManager::Execute(new OrderStatusEvent($order->statuses[$params['orderStatusId']]['description'],$orderId),
                              array("{NOTIFICATION_EMAIL_TEXT}" => $params['notificationEmailText']));

        $this->response['HTML'] = "&nbsp;";
        $this->response['JS'] = 'refreshModeratedOrder('.ORDER_MODERATION_VIEW.');';

        return $this->response;
    }
}