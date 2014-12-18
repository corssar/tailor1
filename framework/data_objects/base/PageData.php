<?php
require_once FRAMEWORK_PATH.'data_objects/base/DataObject.php';

/**
 * ����� ������ ������� Page
 * 
 * ������������� � ���� ������ � �� ��� ������� �������
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
	 * ���������� true, ���� ������ ������ ������. ����� false.
	 * � ������ ������������� ������ ��� ���������� ������� ���������� Exception
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