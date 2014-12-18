<?php
require_once FRAMEWORK_PATH.'data_objects/base/DataObject.php';

/**
 * Класс данных объекта Page
 * 
 * Инкапсулирует в себе работу с БД для данного объекта
 * @author Govorukha Konstantin
 * @version 1.0.0
 *
 */
class PageData extends DataObject  {
	function __construct($pageId, $pageCode=null){
		parent::__construct($pageId,"fe_Pages", $pageCode);
	}
	
	protected function getQuery() {
	    $query = "
            select
                p.*,
                v.masterPageId as pageViewMasterPageId,
                v.className as handler
            from
                fe_Pages p
                    join
                be_View v
                    on (
                        p.viewId = v.viewId
                    )
            where
                ".$this->getPrimaryKeyForQuery();
	    return $query;	    
	}	

	/**
	 * Возвращает true, если запрос вернул запись. иначе false.
	 * В случае возникновения ошибки при выполнении запроса генерирует Exception
	 *
	 * @return boolean
	 */
	public function loadBase() {	    	
	    $query = "
            select
            	p.id,
                p.masterPageId,
                v.masterPageId as pageViewMasterPageId,
                v.viewType,
                v.className,
                p.title,
                p.seoTitle,
                p.seo1,
                p.seo2
            from
                fe_Pages p
                    join
                be_View v
                    on (
                        p.viewId = v.viewId
                    )
            where
                ".$this->getPrimaryKeyForQuery()." AND (v.viewType=1 or v.viewType=2)";
	    return $this->runQuery($query);
	}
}
?>