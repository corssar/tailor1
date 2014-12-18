<?php

class TREE
{
	var $db;
	var $rootId;
	var $result = array();
	var $relatedTable = '';
	var $selectedItem = 0;
	
	function TREE(&$db, $rootId=0, $treeTableName='fe_MenuItems')
	{
		$this->db = &$db;
		$this->relatedTable = $treeTableName;
		if($rootId==0)
		{
			$this->rootId = $this->createParrentItem();
		} 
		else 
		{
			$this->rootId	= $rootId;
		}
	}
	
	private function createParrentItem()
	{
		$sql="insert into $this->relatedTable (rootId, parentId, treeItemName, visible) values (0, 0, 'Root', 1)";
		if($this->db->query($sql))
		{
			if($this->db->LIID)
			{
				$rootItem = $this->db->LIID;
				$this->db->query("update $this->relatedTable set rootId=$rootItem where id=".$this->db->LIID);
				return $rootItem;
			}
		}
	}
	
	public function getItems()
	{
		/* 	we don't need to select main parent item (root node) of menu, because we add it as hardcoded part in the method this.buildTreeNodes(); 
			Actually there are two way to reslove this part :the first one is as Andrew done (adding of the root node is hardcoded )
															:the second is to select main parent note from DB and put it in the this.buildTreeNodes();*/
		if($this->db->query("
					SELECT *, (select count(child.id) from `$this->relatedTable` child where child.parentId=items.id) `count`
					FROM `$this->relatedTable` items
					WHERE `rootId`=$this->rootId and id!=$this->rootId
					ORDER BY parentId, orderNumber"))
		{
			$this->sortItems($this->db->result, $this->rootId);
			return $this->result;
		}
		else
			return false;
	}
	
	public function deleteTree()
	{
		if($this->db->query("DELETE FROM `$this->relatedTable` WHERE id='$this->rootId' or `rootId`=".$this->rootId))
		{
			return true;
		}
		else
			return false;
	}

	public function cancelTreeChanges()
	{
		if($this->db->query("	DELETE FROM 
									`$this->relatedTable` 
								WHERE 
									isTemp=1 AND websiteId=".Context::SiteSettings()->getSiteIdFromSession()))
		{
			return true;
		}
		else
			return false;
	}
	
	static function deleteTempItems($db,$table)
	{
		if($db->query("	DELETE FROM 
							`$table` 
						WHERE 
							isTemp=1"))
		{
			return true;
		}
		else
			return false;
	}
	
	public function saveTree($saveString)
	{
		$treeIds='';
		$lastParent=0;
		
		$items = explode(",",$saveString);
		for($no=0;$no<count($items);$no++)
		{
			$tokens = explode("-",$items[$no]);
			if(count($tokens)==2)
			{
                $sql = "UPDATE `$this->relatedTable`
										SET
											parentId='{$tokens[1]}',
											orderNumber='$no',
											isTemp=0,
											rootId=$this->rootId
										WHERE id='{$tokens[0]}'";
				if($this->db->query($sql))
				{
					if($no>0)
						$treeIds.=", ".$tokens[0];
					else 
						$treeIds.=$tokens[0];
					
					if(USE_MENU_NAVID)
					{
						$this->db->query("SELECT `id`,`link` FROM `$this->relatedTable` WHERE id='{$tokens[0]}'");
						$linkItem = $this->db->result[0];
						$anchor = '';
						$anchorPositon = false;
						$anchorPositon = strpos($linkItem['link'],'#');
	
						if($anchorPositon !== false)
						{
							$anchor = substr( 	$linkItem['link'],
												$anchorPositon,
												strlen($linkItem['link'])-$anchorPositon );
							$linkItem['link'] = str_replace($anchor,'',$linkItem['link']);
						}
						if( ($anchorPositon>0 && $anchorPositon !== false) || $anchorPositon === false)
						{
							$linkItem['link'] = str_replace('&navid='.$linkItem['id'],'',$linkItem['link']);
							$linkItem['link'] = $linkItem['link'].'&navid='.$linkItem['id'];
						}
						$linkItem['link'] = $linkItem['link'].$anchor;
						$this->db->query("Update `$this->relatedTable` SET link = '{$linkItem['link']}' WHERE id='{$tokens[0]}'");
					}
				}
			}
			// update nodes set parentID='".$tokens[1]."',position='$no' where ID='".$tokens[0]."'"
		}
        $sql = "DELETE FROM `$this->relatedTable` WHERE rootId=$this->rootId and id not in ($treeIds) and id!=".$this->rootId;
		$this->db->query($sql);
	}
	
	private function sortItems($items, $parentId)
	{		
		if (count($items)>0)
        {
        	foreach ($items as $key=>$item)
	        {
	        	if ($item['parentId'] == $parentId)
	        	{
	        		$this->result[] = $item;
	        		unset($items[$key]);
	        		$this->sortItems($items, $item['id']);
	        	}
	        }
        }
	}
	
	public function buildTreeNodes(&$items, $parentId = 0, $root = 0)
	{
		$html = $root == 1?'<a href="#">Root</a><ul>':'<ul>';
		if(is_array($items) && count($items)>0)
		{
			foreach ($items as $key=>$item)
	        {
	        	if ($item['parentId'] == $parentId)
	        	{
        			$style 		= !$item['visible']?' style="color:#ccc;"':'';
	        		$itemImage 	= isset($item['moduleId']) && $item['moduleId']?' noChildren="true" noRename="true"  isModule="true" itemImage="tree_module.gif"':'';
	        		
	        		$html.='<li id="node'.$item['id'].'" '.$itemImage.'><a'.$style.' href="#">'.$item['treeItemName'].'</a>';

	        		if($item['count']>0)
	        		{
	        			$html.= $this->buildTreeNodes($items,$item['id']);
	        		}
	        		$html.='</li>';
	        	}
	        }
		}
        $html.="</ul>";
        return $html;
	}
	
	public function buildDdNodes(&$items, $parentId = 0, $level = '')
	{
		$html = '';
		if(is_array($items) && count($items)>0)
		{
			foreach ($items as $key=>$item)
	        {
	        	if ($item['parentId'] == $parentId)
	        	{
	        		$selected = $item['id']==$this->selectedItem?' selected ':'';
	        		$html.='<option value="'.$item['id'].'" '.$selected.'>'.$level.$item['treeItemName'].'</option>';
	        		if($item['count']>0)
	        		{
	        			$html.= $this->buildDdNodes($items,$item['id'],$level."-");
	        		}
	        	}
	        }
		}
        return $html;
	}
	
	public function buildProductsCategoriesNodes(&$items, $parentId = 0, $level = '')
	{
		$html = '';
		if(is_array($items) && count($items)>0)
		{
			foreach ($items as $key=>$item)
	        {
	        	if ($item['parentId'] == $parentId)
	        	{
	        		$selected = in_array($item['id'],$this->selectedItems)?' selected ':'';
	        		$disabled = $item['parentId']==1?' disabled':'';
	        		$html.='<option value="'.$item['id'].'" '.$selected.' '.$disabled.' style="font-size:12px;"> '.$level.' '.$item['treeItemName'].'</option>';
	        		if($item['count']>0)
	        		{
	        			$html.= $this->buildProductsCategoriesNodes($items,$item['id'],$level."--");
	        		}
	        	}
	        }
		}
        return $html;
	}
}
?>