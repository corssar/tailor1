<?php
require_once FRAMEWORK_PATH.'data_objects/base/DataObject.php';

/**
 * Class with data for product pages
 * 
 * @author Andrew Grischuk spizdil from Maxim Melnichuk
 * @version 1.0.0 *
 */
class UserPageData extends DataObject  
{
	function __construct($pageId) 
	{
		parent::__construct($pageId,"fe_Users");
	}
	
	protected function getQuery() {
	    $id = $this->getId();
	    
	    if(!isset($id)) {
	        throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Id not defined');
	    }
	    
	    $query = "
            select
                u.*,
                v.masterPageId as pageViewMasterPageId
            from
                fe_Users u
                    join
                be_View v
                    on (
                        u.viewId = v.viewId
                    )
            where
                id = {$id}	    
        ";
	    return $query;
	}
	

	/**
	 * ¬озвращает true, если запрос вернул запись. иначе false.
	 * ¬ случае возникновени€ ошибки при выполнении запроса генерирует Exception
	 *
	 * @return boolean
	 */
	public function loadBase()
	{
	    $id = $this->getId();
	    
	    if(!isset($id)) {
	        throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Id not defined');
	    }
	    //concat(u.name,',',u.surname,',',u.city) as seo1
	    $query = "
            select
                v.masterPageId as pageViewMasterPageId,
                concat(u.name,' ',u.surname) as title
            from
                fe_Users u
                    join
                be_View v
                    on (
                        u.viewId = v.viewId
                    )
            where
                id = {$id}
        ";

	    return $this->runQuery($query);
	}
}
?>