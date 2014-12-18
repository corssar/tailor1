<?php
require_once FRAMEWORK_PATH.'data_objects/base/DataObject.php';

/**
 * Class with data for product pages
 * 
 * @author Maxim Melnichuk
 * @version 1.0.0 *
 */
class ProductPageData extends DataObject  
{
	function __construct($pageId, $pageCode=null)
	{
		parent::__construct($pageId,"fe_Products", $pageCode);
	}

	protected function getQuery() {
	    $id = $this->getId();

	    if(!isset($id)) {
	        throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Id not defined');
	    }
	    $query = "
            select
                p.*,
                t.masterPageId,
                t.langId,
                t.title,
                li.listItemName as brand,
                t.shortDescription,
                t.html,
                t.material,
                t.seoTitle,
                t.seoDescription,
                t.seoKeywords
            from
                fe_Products p
            inner join
                fe_ProductTranslations t
                on
                (
                    t.productId = p.id
                )
            inner join
                be_ListItems li
                on
                (
                    li.id = p.number1
                )
            join
                be_View v
                    on (
                        p.viewId = v.viewId
                    )
            where
                ".$this->getPrimaryKeyForQuery('p');
	    return $query;
	}
	
	public function loadBase() {
	    $id = $this->getId();

	    if(!isset($id)) {
	        throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Id not defined');
	    }
	    $query = "
            select
                p.id,
                p.itemNumber,
                p.price,
                p.oldPrice,
                v.masterPageId as pageViewMasterPageId,
                t.masterPageId,
                t.langId,
                t.title,
                li.listItemName as brand,
                t.shortDescription,
                t.html,
                t.material,
                t.seoTitle,
                t.seoDescription,
                t.seoKeywords
            from
                fe_Products p
            join
                be_View v
                    on (
                        p.viewId = v.viewId
                    )
            inner join
                be_ListItems li
                on
                (
                    li.id = p.number1
                )
            inner join
                fe_ProductTranslations t
                on
                (
                    t.productId = p.id
                )
            where
                ".$this->getPrimaryKeyForQuery('p');

	    return $this->runQuery($query);
	}

    protected function getPrimaryKeyForQuery($primaryTableName = '')
    {
        if($primaryTableName!='')
            $primaryTableName.='.';

        if(!$this->getId() && !$this->getPageCode())
        {
            throw new CMSException('Id and pageCode for DataClass are not defined');
        }

        if($this->getPageCode())
            $result = " {$primaryTableName}codeName = '".$this->getPageCode()."'";
        else
            $result = " {$primaryTableName}id = ".$this->getId();

        if(Context::SiteSettings()->multiLanguage())
            $result .= ' and t.langId='.Context::LanguageId();
        if(MULTI_SITE)
            $result .= ' and ('.$primaryTableName.'websiteId='.BASE_WEBSITE_ID.' or '.$primaryTableName.'websiteId='.Context::SiteSettings()->getSiteId().')';

        return $result;
    }
}
?>