<?php
/*	Used for generate all data for tree  */
require_once(FRAMEWORK_PATH."data_objects/base/PageObjectData.php");
require_once(FRAMEWORK_PATH."data_objects/MenuTreeListData.php");

class siteTree
{
	public $menuItems = array();
	public $nodes = array();
	public $selectedMenuItem;
	protected $itemFromTree = false;
	protected $aSortedMenu;
	protected $isMenuLoaded = false;
	
	static protected $_Instance = array();	
	function getInstance($treeNavigationPOId) 
	{
		//static $_Instance = null;
		if (!isset(self::$_Instance[$treeNavigationPOId])) 
		{
			self::$_Instance[$treeNavigationPOId] = new siteTree($treeNavigationPOId);			
		}
		return self::$_Instance[$treeNavigationPOId];		
	}	
	function __construct($treeNavigationPOId) 
	{		
		self::$_Instance[$treeNavigationPOId] = $this;

	    $selectedMenuItemId = $this->getSelectedMenuItemId();
	    $this->selectedMenuItem = $selectedMenuItemId;
	    $key = "siteTree_".$treeNavigationPOId.($selectedMenuItemId ? "_$selectedMenuItemId":"_".Context::PageCode().'-'.Context::PageId());
	    $cache = new CacheFace();		
        if($data = $cache->get($key))
		{
            $cachedArray = unserialize($data);
            $aMarkedItems = $cachedArray[0];
            $menuId = $cachedArray[1];
		}
		else 
		{
			$menuId = $this->loadMenuId($treeNavigationPOId);		
	        $menuTreeData = new MenuTreeListData($menuId, $selectedMenuItemId);        
	        if(!$menuTreeData->load()) 
	        	throw new CMSException('Site menu tree could not be load');
	        	
			$menuData = $menuTreeData->getProperties();
			$this->sortItems($menuData,$menuId);
			$aMarkedItems = $this->markSelectedItems($this->aSortedMenu,$menuId, $selectedMenuItemId);
			//$this->menuItems = $this->transformItemsData($aMarkedItems, $menuId);

			$cache->save(serialize(array($aMarkedItems, $menuId)));
		}
        $this->menuItems = $this->transformItemsData($aMarkedItems, $menuId);
        if(count($this->nodes) > 0){
            $this->menuItems['other'] = $this->nodes;
        }
		$this->isMenuLoaded=true;
	}
	
	private function loadMenuId($treeNavigationPOId)
	{        
        $treeNavPOData = new PageObjectData($treeNavigationPOId);
        if ($treeNavPOData->load()) 
        {
            $menuId = $treeNavPOData->getValue('number2');
            if(!isset($menuId)) 
            {
                throw new CMSException(__CLASS__.'.'.__FUNCTION__.'(...). menuId(number2) is not defined');
            }
            return (int)$menuId;
        }
    }
    
     /**
     * Returned ID of menu item which related to the Page curently browsed
     * @return unknown
     */
    private function getSelectedMenuItemId() 
    {
        $selectedMenuItemId=0;
        if($menuItem=$this->getSelectedMenuItemIdByURL())
        {
        	$selectedMenuItemId = $menuItem;
        }/*
        if($selectedMenuItemId==0)
        {
            $selectedMenuItemId = isset($_COOKIE['ipr_navid'])?(int)$_COOKIE['ipr_navid']:0;
        }
        else
        {// without '/' coockies could not be read
			setcookie("ipr_navid",$selectedMenuItemId, time() + 3600*24, '/');
			//setcookie("iprod_navid",0, time() - 60, '/');
        }*/
        return $selectedMenuItemId;
    }

    private function getSelectedMenuItemIdByURL() 
    {
    	//current page URL
    	$URL = SITE_PROTOCOL.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
        $URL = Request::getValidatedString($URL);
    	$URL = appUrl::unRewriteUrl($URL);
    	//Getting from tbl MenuItem items with current URL
        $db = DB::getInstance();
		$query = "Select id from `fe_MenuItems` where (link like '{$URL}' or link like '{$URL}&%') and websiteId = ".SiteSettings::getSiteId();
		if ($db->query($query))
		{
			if(count($db->result)==1)
			{
				$this->itemFromTree = true;
				return (int)$db->result[0]['id'];
			}
			else 
				return false;
		}
		else
		{
			return false;
		}
    }
    
    /**
	 * Sort menu items by their parent. like PARENT->CHILDS
	 * Example result of sort:
	 * - Parent1
	 * - Child1(Parent1)
	 * - Child2(Parent1)
	 * - Parent2
	 * - Child1(Parent2)
	 * - Parent3 ...
	 *
	 * @param array $items
	 * @param integer $pid
	 */
	private function sortItems($items, $pid)
	{
		if (count($items) > 0) 
		{
        	foreach ($items as $key => $item) 
        	{
	        	if ($item['parentId'] == $pid) 
	        	{    		
	        		$item['link'] = AppUrl::checkUrl($item['link']);
					
	        		//Operate image for menu. Edit by Max Melnychuk(young) - 16.05.2009
	        		$item['imageActive'] = AppUrl::checkUrl($item['imageActive']);
	        		$item['imageInactive'] = AppUrl::checkUrl($item['imageInactive']);
	        		//End operate image for menu
	        		
	        		//$this->addItemToSortedMenu($item);
	        		$this->aSortedMenu[] = $item;
	        		
	        		unset($items[$key]);
	        		$this->sortItems($items, $item['id']);
	        	}
	        }
        }
	}
	
	private function markSelectedItems($aItems, $rootItemId, $selectedMenuItemId ) 
    {
    	if (!is_array($aItems)){
            return array();
        }   	
    	$aResItems = $aItems;    	
    	
    	foreach ($aItems as $curItem) 
    	{
    		if ($curItem['id'] == $selectedMenuItemId) 
    		{    			
    			$curSelectedParentMenuItemId = $curItem['parentId'];
    			break;
    		}
    	}
    	$i = 1;
    	
    	while (true) 
    	{
    		foreach ($aItems as $keyCurItem => $curItem)
    		{
    			if (isset($curSelectedParentMenuItemId) && $curItem['id'] == $curSelectedParentMenuItemId) 
    			{
    				$aResItems[$keyCurItem]['selectedItem'] = "1";
    				$curSelectedParentMenuItemId = $curItem['parentId'];
    				break;
    			}
    		}
    		
    		if( isset($curSelectedParentMenuItemId) && $rootItemId == $curSelectedParentMenuItemId ) 
    		{
    			break;
    		}    		
    		
    		if ($i > 10) 
    		{
    			break;
    		}
    		$i ++;
    	}
    	return $aResItems;    	
    }
    
    private function transformItemsData($aItems, $parentId = 0) 
	{
        $isProduct = false;
        if (!is_array($aItems)){
            return array();
        }
        
        foreach ($aItems as $curItem) 
        {            
            if($curItem['parentId'] == $parentId )
            {
                $aCurItemData['me'] = $curItem;
                $aCurItemData['me']['selectedItemId'] = $this->selectedMenuItem;
                $aChildItems = array();
                
                if ($curItem['count'] > 0) 
                {                    
                    $aChildItems = $this->transformItemsData($aItems,$curItem['id']);
                }
                elseif(/*$curItem['selectedItem']==1 && */$curItem['moduleId']>0 && strlen($curItem['moduleclass'])>0)
                {
                	include_once(FRAMEWORK_PATH."system/nav_moduls/{$curItem['moduleclass']}.php");
 					$moduleTree = new $curItem['moduleclass']($this->itemFromTree);
					//$this->modulesArray[$curItem['moduleId']]=$moduleTree->menuItems;
					if($moduleTree->isMenuLoaded)
					{
						$aChildItems = $moduleTree->menuItems;
						if($moduleTree->selectedMenuItem)
						{
							$aCurItemData['me']['selectedItem'] = 1;
							$aCurItemData['me']['selectedItemId'] = $moduleTree->selectedMenuItem;
							$this->selectedMenuItem = $aCurItemData['me']['id'];
						}
                        elseif(count($moduleTree->nodes) > 0){
                            $this->nodes = $moduleTree->nodes;
                            $this->nodes['me']['selectedItemId'] = $moduleTree->selectedMenuItem;
                            $isProduct = true;
                        }
					}
                }

                if($parentId == 117)
                {
                    $aResult = $aChildItems;
                }
                elseif($isProduct){
                    $aCurItemData['me']['selectedItem'] = 1;
                    $aResult['other'][] = array_merge($aCurItemData, $aChildItems);
                    $isProduct = false;
                }
                else
                {
                    $aResult[] = array_merge($aCurItemData, $aChildItems);
                }
            }
        	
        }        
        return $aResult;
	}
	
	public function isMenuLoaded()
	{
		return $this->isMenuLoaded;
	}
}