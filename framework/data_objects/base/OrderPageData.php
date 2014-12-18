<?php


class OrderPageData extends DataObject
{
    function __construct($pageId, $pageCode=null)
    {
        parent::__construct($pageId,"fe_Orders", $pageCode);
    }

    protected function getQuery() {
        $id = $this->getId();

        if(!isset($id)) {
            throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Id not defined');
        }

        $query = "
            select
                o.*,
                v.className as handler,
                v.masterPageId as pageViewMasterPageId
            from
                fe_Orders o
            join
                be_View v
                    on (
                        o.viewId = v.viewId
                    )
            where
                o.id = ".$id;
        return $query;
    }

    public function loadBase()
    {
        $q = "SELECT * FROM fe_Orders WHERE id=".$this->getId();
        $orderData = Context::DB()->query($q) ? Context::DB()->result[0] : array();

        if (empty($orderData))
            throw new PageNotFoundException(__CLASS__.'.'.__FUNCTION__.'(...). pagecode wrong');

        $this->setId($orderData['id']);
        $this->setProperties($orderData);

        return $orderData;
    }
}
