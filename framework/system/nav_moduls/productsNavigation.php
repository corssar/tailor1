<?php
/*	Used for generate all data for tree  */
require_once(FRAMEWORK_PATH."data_objects/ProdNavListData.php");
require_once(FRAMEWORK_PATH."system/breadcrumbs/config.php");

class productsNavigation
{
	public $menuItems = array();
	public $selectedMenuItem;
	protected $aSortedMenu;
	public $isMenuLoaded = false;
	public $nodes = array();
	protected $langId;
	
	static protected $_Instance = array();	
	function getInstance($langId=1)
	{
		//static $_Instance = null;
		if (!isset(self::$_Instance[$langId])) 
		{
			self::$_Instance[$langId] = new siteTree($langId);
		}
		return self::$_Instance[$langId];		
	}
	
	function __construct($parentSelectedNode) 
	{		
		//self::$_Instance[$langId] = $this;
		$selectedMenuItemId=0;
		//$this->langId = $langId;
		if($menuId = $this->loadMenuId() and $menuId>0 and $parentSelectedNode===false)
		{
			$selectedMenuItemId = $this->getSelectedMenuItemId();
		}

        $menuTreeData = new ProdNavListData($menuId, $selectedMenuItemId);        
        if($menuTreeData->load()) 
        {
           $menuData = $menuTreeData->getProperties();           
           $this->sortItems($menuData,$menuId);
           $aMarkedItems = $this->markSelectedItems($this->aSortedMenu,$menuId, $selectedMenuItemId);
           $this->selectedMenuItem = $selectedMenuItemId;
           $this->menuItems = $this->transformItemsData($aMarkedItems, $menuId);
           
		   $this->isMenuLoaded=true;           
        }
	}
	private function loadMenuId() 
	{   
		//Getting rootid for product categories tree
		$db = DB::getInstance();
		$query = "Select id from `fe_ProductCategories` where parentId=0";/* and langId = '{$this->langId}'";*/
		if ($db->query($query))
		{
			if(count($db->result)==1)
			{

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
     * Returned ID of menu item which related to the Page curently browsed
     * @return unknown
     */
    private function getSelectedMenuItemId() 
    {
    	$selectedMenuItemId=0;
        if((int)strpos($_SERVER['SCRIPT_FILENAME'], 'catalog.php')>1){
            $pageCode = Request::getInstance()->getString('pagecode','GET');
            $query = "SELECT id FROM fe_ProductCategories WHERE codeName = '$pageCode'";
            if (Context::DB()->query($query)){
                $selectedMenuItemId = (int)Context::DB()->result[0]['id'];
            }
        }
        elseif((int)strpos($_SERVER['SCRIPT_FILENAME'], 'product.php')>1){
            $currClassName = 'product';

            $args = array('pageClass' => $currClassName,
                'controllersDir' => ucfirst($currClassName),
                'controller' => ucfirst($currClassName) . MODULE_SUFiX);

            require_once(DIRECTORY_CLASS_PATH . $args['controllersDir'] . '/' . $args['controller'] . '.php');

            $breadCrumb = new $args['controller']($args['pageClass'] . '.php');

            $this->nodes = $breadCrumb->getNodes();
        }
/*        if($selectedMenuItemId==0 && ((int)strpos($_SERVER['SCRIPT_FILENAME'], 'product.php')>1) && isset($_COOKIE['iprod_navid']))
        {
            $selectedMenuItemId = (int)$_COOKIE['iprod_navid'];
        }
        else
        {// without '/' coockies could not be read
            setcookie("iprod_navid",$selectedMenuItemId, time() + 3600*24, '/');
        }*/
        return $selectedMenuItemId;
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
                    $item['link'] = AppUrl::getUrl($item['id'], $item['className'], $item['codeName']);
	        		//Operate image for menu. Edit by Max Melnychuk(young) - 16.05.2009
	        		if(isset($item['imageActive']))
	        		$item['imageActive'] = AppUrl::checkUrl($item['imageActive']);
	        		if(isset($item['imageInactive']))
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
    	$curSelectedParentMenuItemId=0;
    	$aResItems = array();    	
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
    			if ($curItem['id'] == $curSelectedParentMenuItemId) 
    			{
    				$aResItems[$keyCurItem]['selectedItem'] = "1";
    				$curSelectedParentMenuItemId = $curItem['parentId'];

    				break;
    			}
    		}
    		
    		if( $rootItemId == $curSelectedParentMenuItemId ) 
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
        if (!is_array($aItems)) 
        {
            throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Bad parameter.');
        }
        $aResult = array();
        
        foreach ($aItems as $curItem) 
        {            
            if ($curItem['parentId'] == $parentId ) 
            {
                $aCurItemData['me'] = $curItem;
                $aCurItemData['me']['selectedItemId'] = $this->selectedMenuItem;
                $aChildItems = array();
                
                if ($curItem['count'] > 0) 
                {                    
                    $aChildItems = $this->transformItemsData($aItems,$curItem['id']);
                }                
                $aResult[] = array_merge($aCurItemData, $aChildItems);                
            }
        	
        }        
        return $aResult;
	}	
	public function isMenuLoaded()
	{
		return $this->isMenuLoaded;
	}
}
?>