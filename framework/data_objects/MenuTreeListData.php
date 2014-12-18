<?php

require_once(FRAMEWORK_PATH."data_objects/base/DataObject.php");

class MenuTreeListData extends DataObject  {
    private $menuId = null;
    private $selectedMenuItemId = null;
  
	function __construct($menuId, $selectedMenuItemId) {
	    if (!is_integer($menuId)) {
	        throw new CMSException('Menu object does not have integer MenuId parameter');
	    }
        if (!is_integer($selectedMenuItemId)) {
           throw new CMSException('Menu object does not have integer selectedMenuId parameter');
        }
	    
	    $this->menuId = $menuId;
	    $this->selectedMenuItemId = $selectedMenuItemId;
	    
		/*parent::__construct();*/
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
                items.*, 
                (
                    select 
                        count(child.id) 
                    from 
                        `fe_MenuItems` child 
                    where 
                        child.parentId = items.id
                ) `count`,
                (if (items.id = {$selectedMenuItemId}, 1, 0 )  ) `selectedItem`,
                litems.description moduleclass
			FROM 
			    `fe_MenuItems` items
			    left outer join `be_ListItems` litems on items.moduleId = litems.id
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