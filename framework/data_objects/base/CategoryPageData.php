<?php
require_once FRAMEWORK_PATH.'data_objects/base/DataObject.php';

/**
 * Class with data for product pages
 * 
 * @author Andrew Grischuk spizdil from Maxim Melnichuk
 * @version 1.0.0 *
 */
class CategoryPageData extends DataObject  
{
	function __construct($pageId, $pageCode=null)
	{
		parent::__construct($pageId,"fe_ProductCategories", $pageCode);
	}
	
	protected function getQuery() {
	    $id = $this->getId();
	    
	    if(!isset($id)) {
	        throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Id not defined');
	    }
	    
	    $query = "
            select
                c.*,
                v.className as handler,
                v.masterPageId as pageViewMasterPageId,
                t.masterPageId,
                t.langId,
                t.title,
                t.description,
                t.seoTitle,
                t.seoDescription,
                t.seoKeywords
            from
                fe_ProductCategories c
            inner join
                fe_ProductCategoryTranslations t
                on
                (
                    t.categoryId = c.id
                )
            join
                be_View v
                    on (
                        c.viewId = v.viewId
                    )
            where
                ".$this->getPrimaryKeyForQuery('c');
	    return $query;	    
	}
	

	/**
	 * ¬озвращает true, если запрос вернул запись. иначе false.
	 * ¬ случае возникновени€ ошибки при выполнении запроса генерирует Exception
	 *
	 * @return boolean
	 */
	public function loadBase() {
	    $id = $this->getId();
	    
	    if(!isset($id)) {
	        throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Id not defined');
	    }
	    $query = "
            select
                c.id,
                t.masterPageId,
                t.langId,
                t.title,
                t.description,
                t.seoTitle,
                t.seoDescription,
                t.seoKeywords
            from
                fe_ProductCategories c
            join
                be_View v
                on
                (
                    c.viewId = v.viewId
                )
            inner join
                fe_ProductCategoryTranslations t
                on
                (
                    t.categoryId = c.id
                )
            where
                ".$this->getPrimaryKeyForQuery('c');
	    return $this->runQuery($query);
	}
}
?>