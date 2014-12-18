<?
	class LanguageContentManager
	{
		protected $db;
		private $tableName = 'fe_Pages';
		
		function __construct()
		{
			global $lang;
			$this->db 	= DB::getInstance();
		}
		
		public function deleteLanguageContent($langId, $siteId=null)
		{
            $websiteParam = is_null($siteId)?'':'and websiteId='.$siteId;
			$sql = "delete FROM be_PageContent where pageId in (select id from fe_Pages where langId = $langId $websiteParam);
					delete FROM fe_Pages where langId = $langId $websiteParam;
					delete FROM fe_PageObjectsInAreas where masterPageId in (select id from fe_MasterPages where langId = $langId $websiteParam);
					delete FROM fe_MasterPages where langId = $langId $websiteParam;
					delete FROM fe_WebText where langId = $langId $websiteParam;
					delete FROM fe_MenuItems where IFNULL(rootId, id) not in (select number2 from fe_Pages where viewId=8);
					delete FROM be_MailTemplates where langId = $langId $websiteParam;";
            return $this->db->runMultipleQueries($sql);
		}
		
		public function createLanguageContent($options)
		{
            $fromLangId = $options['sourceLangId'];
            $fromSiteId = $options['sourceSiteId'];
            $langId = $options['goalLangId'];
            $siteId = $options['goalSiteId'];


			$sql = "Update fe_Pages set relationId = UUID() where Length(ifnull(relationId, 0))<>36;
					insert into fe_Pages(langId, relationId,viewId,codeName,masterPageId,seoTitle,seo1,seo2,visible,introHtml,outroHtml,title,html,shortDescription,dateStartVisible,dateEndVisible,text1,text2,text3,text4,text5,text6,text7,text8,text9,text10,number1,number2,number3,number4,number5,number6,number7, websiteId)
					  select $langId, p.relationId ,p.viewId,p.codeName,p.masterPageId,p.seoTitle,p.seo1,p.seo2,p.visible,p.introHtml,p.outroHtml,p.title,p.html,p.shortDescription,p.dateStartVisible,p.dateEndVisible,p.text1,p.text2,p.text3,p.text4,p.text5,p.text6,p.text7,p.text8,p.text9,p.text10,p.number1,p.number2,p.number3,p.number4,p.number5,p.number6,p.number7, $siteId
					  from fe_Pages p LEFT OUTER JOIN fe_Pages createdPages on p.relationId = createdPages.relationId and createdPages.langId = $langId and createdPages.websiteId = $siteId
					  where p.langId = $fromLangId and p.visible=1 and createdPages.id is null and p.websiteId = $fromSiteId;
					Update fe_MasterPages set relationId = UUID() where Length(ifnull(relationId, 0))<>36;
					insert into fe_WebText(viewId, langId, keyword, description, websiteId)
                    SELECT fe_WebText.viewId, $langId, fe_WebText.keyword, fe_WebText.description,$siteId FROM fe_WebText
                        LEFT OUTER JOIN fe_WebText nw on fe_WebText.keyword = nw.keyword and nw.langId = $langId and nw.websiteId=$siteId
                    where fe_WebText.langId=$fromLangId and fe_WebText.websiteId=$fromSiteId and nw.keyword is null;";

			if(!$this->db->runMultipleQueries($sql))
                return false;

			//create masterPages with localized object
			if(!$this->createMaterPages($options))
				return false;

			//1)update pages with master pages for new language;
			$sql = "update fe_Pages p
							Left join fe_MasterPages mp on p.masterPageId = mp.id
							inner join fe_MasterPages newmp on mp.relationId=newmp.relationId and newmp.websiteId = $siteId
						set masterPageId = newmp.id
						where p.langid=$langId and p.websiteId=$siteId and mp.id is not null and newmp.langid=$langId";
            if(!$this->db->query($sql) && $this->db->error!=false)
                return false;

            //2) Update default MasterPage for Language
            $sql = 'update be_WebsiteLanguages
                set masterpageid = (SELECT newMp.id from fe_MasterPages mp
                                        inner join fe_MasterPages newMp on mp.relationId = newMp.relationId
                                    where mp.langid = '.$fromLangId.' and mp.websiteId = '.$fromSiteId.' and newMp.langid = '.$langId.' and newMp.websiteId = '.$siteId.'
                                    ORDER BY mp.id LIMIT 1)
                where langId='.$langId.' and websiteId='.$siteId;
            if(!$this->db->query($sql))
                return false;

            //3) Update default page for Language
            if(!$this->updateDefaultPage($options))
                return false;

            //4) Copy navigation trees
            if(!$this->CopyNavigationTrees($options))
                return false;

            //5) Copy mail templates
            $sql="UPDATE be_MailTemplates SET relationId = UUID() WHERE Length(ifnull(relationId, 0))<>36;
                    INSERT INTO be_MailTemplates (langId, relationId, title, subject, body, eventId, emails, cc, active, seeAddresses, websiteId)
                    SELECT $langId, mt.relationId, mt.title, mt.subject, mt.body, mt.eventId, mt.emails, mt.cc, mt.active, mt.seeAddresses, $siteId
                    FROM be_MailTemplates mt
                            LEFT OUTER JOIN be_MailTemplates cmt ON mt.relationId = cmt.relationId AND cmt.langId = $langId AND cmt.websiteId = $siteId
                    WHERE cmt.id IS NULL AND mt.langId = $fromLangId and mt.websiteId = $fromSiteId;";
            return $this->db->runMultipleQueries($sql);
		}
		protected function createMaterPages($options)
		{
            $fromLangId = $options['sourceLangId'];
            $fromSiteId = $options['sourceSiteId'];
            $langId = $options['goalLangId'];
            $siteId = $options['goalSiteId'];

			$query="select fe_MasterPages.*
                      from fe_MasterPages
                        left join fe_MasterPages relmp on fe_MasterPages.relationId = relmp.relationId and relmp.langid = $langId and relmp.websiteId = $siteId
				    where fe_MasterPages.langid = $fromLangId and fe_MasterPages.websiteId = $fromSiteId and relmp.id is null";
			if(!$this->db->query($query) && $this->db->error!=false)
				return false;

			$masterPageIds = $this->db->result;
			foreach ($masterPageIds as $curentMasterPage)
			{
				$query = "insert into fe_MasterPages (langId, title, viewId, relationId, websiteId) value($langId, '{$curentMasterPage['title']}', {$curentMasterPage['viewId']}, '{$curentMasterPage['relationId']}', $siteId);";
				if(!$this->db->query($query))
					return false;
				$newMasterId = $this->db->LIID;
				//insert PO for new masterPage
				$query ="insert into fe_PageObjectsInAreas(masterPageId, areaNumber, pageObjectId)
						select $newMasterId, poina.areaNumber, po.id FROM fe_PageObjectsInAreas poina
							inner join fe_Pages nativepo on poina.pageObjectId = nativepo.id
							inner join fe_Pages po on po.relationId = nativepo.relationId and po.langId=$langId and po.websiteId=$siteId
						WHERE poina.masterPageId = {$curentMasterPage['id']} order by poina.id;";
				if(!$this->db->query($query))
					return false;
			}
			return true;
		}
        protected function updateDefaultPage($options)
        {
            $sql = 'SELECT defaultUrl FROM be_WebsiteLanguages
                    where websiteId='.$options['sourceSiteId'].' and langId='.$options['sourceLangId'];

            if(!$this->db->query($sql) && $this->db->error!=false)
                return false;

            require_once(FRAMEWORK_PATH."system/helper/LanguagesRelationManager.php");
            if(!($newUrl = LanguagesRelationManager::GetRelatedUrl($this->db->result[0]['defaultUrl'], $options['goalLangId'], $options['goalSiteId'])))
                return true;

            $sql = "UPDATE be_WebsiteLanguages Set defaultUrl='".appUrl::unRewriteUrl($newUrl)."'
                    WHERE websiteId={$options['goalSiteId']} and langId={$options['goalLangId']}";
            if(!$this->db->query($sql) && $this->db->error!=false)
                return false;

           return true;
        }
		protected function CopyNavigationTrees($options)
        {
            $sql = "select id, number2 treeId FROM fe_Pages WHERE viewId=8 and langId={$options['goalLangId']} and websiteId = {$options['goalSiteId']};";//Update fe_Pages set number2=(select max(rootId)+1 from fe_MenuItems) WHERE viewId=8 and langId=$langId and websiteId = $siteId;';
            if(!$this->db->query($sql) && $this->db->error!=false)
                return false;

            foreach($this->db->result as $values)
            {
                // get all menu items
                $sql = "select * from fe_MenuItems where rootId={$values['treeId']} or id={$values['treeId']} ORDER BY parentId, id";
                if(!$this->db->query($sql))
                    return false;

                $tree = $this->buildTree($this->db->result, 0);
                if(count($tree)==0)
                    return false;

               //create main menu item
                $sql = "INSERT INTO `fe_MenuItems` (parentId, treeItemName, link, visible, orderNumber, isTemp, moduleId, imageActive, imageInactive, websiteId)
                       VALUES (".$tree[0]['parentId'].", '".$tree[0]['treeItemName']."', '".$tree[0]['link']."', ".$tree[0]['visible'].", ".$tree[0]['orderNumber'].", '".$tree[0]['isTemp']."', '".$tree[0]['moduleId']."', '".$tree[0]['imageActive']."', '".$tree[0]['imageInactive']."', {$options['goalSiteId']})";
                if(!$this->db->query($sql))
                    return false;
                $newMenuId = $this->db->LIID;

                //create child nodes
                if(count($tree[0]['children'])>0)
                    $this->createChildTreeItems($tree[0]['children'],$newMenuId, $newMenuId, $options['goalSiteId'], $options['goalLangId']);

                // update object with new menuId
                $sql = "update fe_Pages SET number2 = $newMenuId Where id = {$values['id']}";
                if(!$this->db->query($sql))
                    return false;

                //update all menu with current navigation tree(should be fixed if there are more than one navTree)
                $sql = "update fe_Pages Set number1 = {$values['id']} where viewId = 6 and websiteId={$options['goalSiteId']} and langId = {$options['goalLangId']}";
                if(!$this->db->query($sql))
                    return false;
            }
            return true;
        }
        protected function buildTree($itemList, $parentId) {
            // return an array of items with parent = $parentId
            $result = array();
            foreach ($itemList as $item) {
                if ($item['parentId'] == $parentId) {
                    $newItem = $item;
                    $newItem['children'] = $this->buildTree($itemList, $newItem['id']);
                    $result[] = $newItem;
                }
            }

            if (count($result) > 0) return $result;
            return array();
        }
        protected function createChildTreeItems($itemList,$parentId, $menuId, $websiteId, $langId)
        {
            foreach($itemList as $item)
            {
                if(($url = LanguagesRelationManager::GetRelatedUrl($item['link'], $langId, $websiteId))===false)
                    return false;

                $newUrl = appUrl::unRewriteUrl($url);

                $sql = "INSERT INTO `fe_MenuItems` (rootId, parentId, treeItemName, link, visible, orderNumber, isTemp, moduleId, imageActive, imageInactive, websiteId)
                       VALUES ($menuId, $parentId, '".mysqli_real_escape_string(Context::DB()->pointer,$item['treeItemName'])."', '$newUrl', {$item['visible']}, {$item['orderNumber']}, '{$item['isTemp']}', '{$item['moduleId']}', '{$item['imageActive']}', '{$item['imageInactive']}', $websiteId)";
                if(!$this->db->query($sql))
                    return false;

                //create child nodes
                if(count($item['children'])>0){
                    $itemId = $this->db->LIID;
                    $this->createChildTreeItems($item['children'],$itemId, $menuId, $websiteId, $langId);
                }
            }
        }

		public function specifyTableName($viewId)
		{
			if($this->db->query("SELECT tblName FROM be_View WHERE viewId = ".$viewId))
			{
				$this->tableName = $this->db->result[0]['tblName'];
			}
		}
		
		public function isCreatedPageMergebleByLang($langId,$foundPageId)
		{
			if($this->db->query('SELECT * FROM '.$this->tableName.' LIMIT 1') && array_key_exists('websiteId',$this->db->result[0]))
				$where = ' and relations.websiteId = '.Context::SiteSettings()->getSiteIdFromSession();
			else 
				$where = '';

			if($this->db->query("SELECT 
									relations.relationId 
								FROM 
									$this->tableName foundPage
								LEFT JOIN
									$this->tableName relations
									ON 
										relations.relationId = foundPage.relationId
								WHERE 
									relations.langId = $langId AND 
									foundPage.id = '$foundPageId' $where ") && count($this->db->result)>0)
				return true;
			return false;
		}
		
		public function isPageRelated($pageId,$relatedPageId)
		{
			if($this->db->query("SELECT 
									related.langId 
								FROM 
									$this->tableName page
								LEFT JOIN
									$this->tableName related
									ON 
										related.relationId = page.relationId AND 
										related.langId = (SELECT langId FROM $this->tableName WHERE id = $pageId)
								WHERE 
									page.id = $relatedPageId")
				&& count($this->db->result)>0  
				&& $this->db->result[0]['langId']!='')
				return true;
			return false;
		}
		
		public function updateItemRelationId($pageId,$newRelationId)
		{
			if($this->db->query('SELECT * FROM '.$this->tableName.' LIMIT 1') && array_key_exists('websiteId',$this->db->result[0]))
				$where = ' and websiteId = '.Context::SiteSettings()->getSiteIdFromSession();
			else 
				$where = '';

			
			//обновляет relationId на всех записях, это не правильно
			$this->db->query("SELECT relationId FROM $this->tableName WHERE id = $pageId limit 0,1");
			if($oldRelationId = $this->db->result[0]['relationId'])
			{
				if($this->db->query("UPDATE $this->tableName SET relationId = '$newRelationId' WHERE relationId = '$oldRelationId' $where"))
					return true;
			}
			if($this->db->query("UPDATE $this->tableName SET relationId = '$newRelationId' WHERE id = '$pageId'"))
				return true;
			return false;
		}
		
		public function GetRelatedItems($pageId, $relationId)
		{
			if($this->db->query('SELECT * FROM '.$this->tableName.' LIMIT 1') && array_key_exists('websiteId',$this->db->result[0]))
				$where = ' and pages.websiteId = '.Context::SiteSettings()->getSiteIdFromSession();
			else 
				$where = '';

			
			if($this->db->query("SELECT 	
									pages.id,
									pages.viewId,
									pages.relationId,
									pages.langId,
									pages.title,
									be_Languages.name langName,
									be_Languages.code langCode
								FROM 
									$this->tableName pages
								INNER JOIN be_Languages 
									ON be_Languages.id = pages.langId
								WHERE pages.id != {$pageId} AND pages.relationId = '$relationId' $where") && count($this->db->result)>0)
			{
				$items = '[';
				foreach ($this->db->result as $item)
				{
					$items.= "[".$item['id'].",".$item['viewId'].",'".$item['langName']."','".$item['title']."'],";
				}
				$items = substr($items,0,-1);
				$items.= ']';
				

//				$items = '';
//				foreach ($this->db->result as $item)
//				{
//						viewDataObject'.$item['viewId'].' = new ViewDataObject('.$item['viewId'].',\'general\'); navigation.sendRequest(\'ViewController\',\'viewBuild\',{viewId:'.$item['viewId'].',itemId:'.$item['id'].'});"
//						relatedItemsObj.deletePageRelation('.$item['id'].','.$item['viewId'].');';
//					$items.= '	<td>
//									<img onclick="return;" src="webcontent/img/reply.gif" class="cursor" border="0" />
//									<img onclick="return;" border="0" class="cursor" src="webcontent/img/item_delete.gif" title=""/>
//								</td>
//								<td>'.$item['id'].'</td>
//								<td>'.$item['langName'].'</td>
//								<td>'.$item['title'].'</td>';
//				}
				return $items;
			}
			//insert into log
			return '';
		}
		
		public function deletePageRelation($pageId)
		{
            include_once(FRAMEWORK_PATH."system/helper/Guid.php");
			$newRelationId = Guid::Generate();

			if($this->db->query("UPDATE $this->tableName SET relationId = '$newRelationId' WHERE id = '$pageId'"))
				return true;
			return false;
		}

        public function copyItem($viewId, $itemId, $siteIds)
        {
            if(!Context::DB()->query("SELECT tblName FROM be_View WHERE viewId = $viewId"))
                return false;

            $websiteIDsStr = implode(",", $siteIds);

            switch(Context::DB()->result[0]['tblName'])
            {
                case 'fe_Pages':
                    //navigation tree object
                    if($viewId==8){
                        return false;
                        $options = array();
                        $this->CopyNavigationTrees($options);
                    }

                    //update existing pages
                    $query = "UPDATE fe_Pages SET relationId = UUID() WHERE Length(ifnull(relationId, 0))<>36";
                    Context::DB()->query($query);

                    $query = "  update fe_Pages tmp
                                    inner join fe_Pages pgs on tmp.relationId = pgs.relationId and pgs.langId = tmp.langId
                                set pgs.viewId = tmp.viewId, pgs.codeName = IF(tmp.codeName = '', Null, tmp.codeName), pgs.masterPageId = tmp.masterPageId, pgs.seoTitle = tmp.seoTitle,
                                                pgs.seo1 = tmp.seo1, pgs.seo2 = tmp.seo2, pgs.visible = tmp.visible, pgs.introHtml = tmp.introHtml,
                                                pgs.outroHtml = tmp.outroHtml, pgs.title = tmp.title, pgs.html = tmp.html, pgs.shortDescription = tmp.shortDescription,
                                                pgs.dateStartVisible = tmp.dateStartVisible, pgs.dateEndVisible = tmp.dateEndVisible, pgs.text1 = tmp.text1, pgs.text2 = tmp.text2,
                                                pgs.text3 = tmp.text3, pgs.text4 = tmp.text4, pgs.text5 = tmp.text5, pgs.text6 = tmp.text6, pgs.text7 = tmp.text7, pgs.text8 = tmp.text8,
                                                pgs.text9 = tmp.text9, pgs.text10 = tmp.text10, pgs.number1 = tmp.number1, pgs.number2 = tmp.number2, pgs.number3 = tmp.number3,
                                                pgs.number4 = tmp.number4, pgs.number5 = tmp.number5, pgs.number6 = tmp.number6, pgs.number7 = tmp.number7
                                WHERE tmp.id = $itemId and pgs.websiteId in ($websiteIDsStr)";
                    Context::DB()->query($query);
                    //insert pages to webites
                    foreach ($siteIds as $siteId)
                    {
                        if(!$this->copyPage($itemId,$siteId))
                            return false;
                    }
                    //update correct masterPages for pages
                    $query = "UPDATE fe_Pages
                              INNER JOIN fe_MasterPages cur ON cur.id = fe_Pages.masterPageId
                              INNER JOIN fe_MasterPages goal ON cur.relationId = goal.relationId AND goal.websiteId = fe_Pages.websiteId AND cur.langId = goal.langId
                              SET fe_Pages.masterPageId = goal.id
                              WHERE goal.id <> cur.id and fe_Pages.websiteId in ($websiteIDsStr)";
                    Context::DB()->query($query);

                    break;
                case "be_MailTemplates":
                    //update mail templates
                    $query = "UPDATE be_MailTemplates SET relationId = UUID() WHERE Length(ifnull(relationId, 0))<>36";
                    Context::DB()->query($query);

                    $query = "UPDATE be_MailTemplates mt
                              INNER JOIN be_MailTemplates mtt ON mt.relationId = mtt.relationId AND mt.langId = mtt.langId
                              SET mtt.langId = mt.langId, mtt.title = mt.title, mtt.subject = mt.subject, mtt.body = mt.body, mtt.eventId = mt.eventId,
                                  mtt.emails = mt.emails, mtt.cc = mt.cc, mtt.active = mt.active, mtt.seeAddresses = mt.seeAddresses
                              WHERE mt.id = $itemId and mtt.websiteId in ($websiteIDsStr)";

                    Context::DB()->query($query);

                    //insert mail templates
                    foreach ($siteIds as $siteId)
                    {
                        $query = "INSERT INTO be_MailTemplates (langId, relationId, title, subject, body, eventId, emails, cc, active, seeAddresses, websiteId)
                                  SELECT mt.langId, mt.relationId, mt.title, mt.subject, mt.body, mt.eventId, mt.emails, mt.cc, mt.active, mt.seeAddresses, $siteId
                                  FROM be_MailTemplates mt
                                  LEFT OUTER JOIN be_MailTemplates cmt ON mt.relationId = cmt.relationId AND mt.langId = cmt.langId AND cmt.websiteId = $siteId
					              WHERE cmt.id IS NULL AND mt.id = $itemId";

                        if(!Context::DB()->query($query) && Context::DB()->error!=false)
                            return false;
                    }
                    break;

                case "fe_MasterPages";
                    foreach ($siteIds as $siteId)
                    {
                        $query="SELECT fe_MasterPages.*, relmp.id existId
                                FROM fe_MasterPages
                                LEFT JOIN fe_MasterPages relmp ON fe_MasterPages.relationId = relmp.relationId AND fe_MasterPages.langId = relmp.langId AND relmp.websiteId = $siteId
                                WHERE fe_MasterPages.websiteId = '" . Context::SiteSettings()->getSiteIdFromSession() . "' and fe_MasterPages.id = '$itemId'";

                        if(!$this->db->query($query) && $this->db->error!=false)
                            return false;

                        $masterPageIds = $this->db->result;
                        foreach ($masterPageIds as $curentMasterPage)
                        {
                            if($curentMasterPage['existId'] == null){
                                $query = "INSERT INTO fe_MasterPages (langId, title, viewId, relationId, websiteId)
                                          VALUE('{$curentMasterPage['langId']}', '{$curentMasterPage['title']}', {$curentMasterPage['viewId']}, '{$curentMasterPage['relationId']}', $siteId);";
                                if(!$this->db->query($query))
                                    return false;

                                $newMasterId = $this->db->LIID;
                            }
                            else{
                                $newMasterId = $curentMasterPage['existId'];
                                //clear all relation with PageObjects
                                $query="Delete from fe_PageObjectsInAreas
                                        WHERE masterPageId=$newMasterId";
                                if(!$this->db->query($query) && $this->db->error!=false)
                                    return false;
                            }
                            //insert PageObjects relation for masterPage
                            $query ="INSERT INTO fe_PageObjectsInAreas(masterPageId, areaNumber, pageObjectId)
                                     SELECT $newMasterId, poina.areaNumber, po.id
                                     FROM fe_PageObjectsInAreas poina
                                     INNER JOIN fe_MasterPages mp ON mp.id = $newMasterId
                                     INNER JOIN fe_Pages nativepo ON poina.pageObjectId = nativepo.id
                                     INNER JOIN fe_Pages po ON po.relationId = nativepo.relationId AND po.websiteId=$siteId AND po.langId = mp.langId
                                     WHERE poina.masterPageId = {$curentMasterPage['id']}
                                     ORDER BY poina.id;";
                            if(!$this->db->query($query) && $this->db->error!=false)
                                return false;

                            //update pages with master pages for new language;
                            $langId = $curentMasterPage['langId'];
                            $sql = "update fe_Pages p
                                        inner join fe_Pages rp on p.relationId = rp.relationId
                                        Left join fe_MasterPages mp on rp.masterPageId = mp.id
                                        inner join fe_MasterPages newmp on mp.relationId=newmp.relationId and newmp.websiteId = $siteId
                                    set p.masterPageId = newmp.id
                                    where p.langid=$langId and p.websiteId=$siteId and mp.id is not null and newmp.langid=$langId";
                            if(!$this->db->query($sql) && $this->db->error!=false)
                                return false;
                        }
                    }
                    break;
            }

            return true;
        }

        private function copyPage($itemId, $siteId)
        {
            $query = "insert into fe_Pages(langId, relationId,viewId,codeName,masterPageId,seoTitle,seo1,seo2,visible,introHtml,outroHtml,title,html,shortDescription,dateStartVisible,dateEndVisible,text1,text2,text3,text4,text5,text6,text7,text8,text9,text10,number1,number2,number3,number4,number5,number6,number7, websiteId)
                      select p.langId, p.relationId ,p.viewId,p.codeName,p.masterPageId,p.seoTitle,p.seo1,p.seo2,p.visible,p.introHtml,p.outroHtml,p.title,p.html,p.shortDescription,p.dateStartVisible,p.dateEndVisible,p.text1,p.text2,p.text3,p.text4,p.text5,p.text6,p.text7,p.text8,p.text9,p.text10,p.number1,p.number2,p.number3,p.number4,p.number5,p.number6,p.number7, $siteId
					  from fe_Pages p
								LEFT OUTER JOIN fe_Pages createdPages on p.relationId = createdPages.relationId and p.langId = createdPages.langId and createdPages.websiteId = $siteId
					  where createdPages.id is null and p.id = $itemId";
            if(!Context::DB()->query($query) && Context::DB()->error!=false)
                return false;
            return true;
            //update masterPages
            /*$query = "UPDATE fe_Pages
	                  INNER JOIN fe_MasterPages cur ON cur.id = fe_Pages.masterPageId
	                  INNER JOIN fe_MasterPages goal ON cur.relationId = goal.relationId AND goal.websiteId = fe_Pages.websiteId AND cur.langId = goal.langId
	                  INNER JOIN be_View on be_View.viewId = fe_Pages.viewId
                      SET fe_Pages.masterPageId = goal.id
                      WHERE goal.id <> cur.id and be_View.viewType in (13)";

            return Context::DB()->query($query) || Context::DB()->error==false;*/
        }
	}
?>