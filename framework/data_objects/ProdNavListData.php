<?php

require_once(FRAMEWORK_PATH."data_objects/base/DataObject.php");

class ProdNavListData extends DataObject  {
    private $menuId = null;
    private $selectedMenuItemId = null;
  
	//function __construct($menuId, $rootMenuItemId = null) {
	function __construct($menuId, $selectedMenuItemId) {
	    if (!is_integer($menuId)) {
	        throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Bad parameter');
	    }
        if (!is_integer($selectedMenuItemId)) {
            throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Bad parameter');
        }
	    
	    $this->menuId = $menuId;
	    $this->selectedMenuItemId = $selectedMenuItemId;
	    
		parent::__construct();
	}    
	
	private function getMenuId() 
	{
	    return $this->menuId;
	}
    private function getSelectedMenuItemId(){
        return $this->selectedMenuItemId;
    }
    
    protected function getQuery() {
        $menuId = $this->getMenuId();
        $selectedMenuItemId = $this->getSelectedMenuItemId();

        $query = "
            SELECT 
                items.id, items.rootId, items.parentId, items.codeName, items.treeItemName, items.link, items.visible, items.orderNumber,
                (
                    select 
                        count(child.id) 
                    from 
                        `fe_ProductCategories` child
                    where 
                        child.parentId = items.id
                ) `count`,
                (if (items.id = {$selectedMenuItemId}, 1, 0 )  ) `selectedItem`, 
                be_View.className
			FROM 
			    `fe_ProductCategories` items
			    INNER JOIN `be_View` ON items.viewId = be_View.viewId
			WHERE 
			    items.`rootId` = {$menuId} and items.id <> {$menuId}
            ORDER BY
                items.parentId, 
                items.orderNumber
        ";
        return $query;
    }
    
	public function load() 
	{
    	//$query = $this->getQuery();
    	//return $this->runQuery($query); 
    	
    	
    	$result = $this->runListQuery($this->getQuery());
    	$this->setProperties($result);
    	return true;        
	}	
}




?>