<?php

abstract class BreadCrumbBase{
    protected $pageId                 = null;
    protected $pageClass              = null;
    protected $tableName              = null;
    protected $nodes                  = array();

    public function __construct($pageClass){
        $this->pageClass = $pageClass;
        $this->buildNodes();
    }

    public function getNodes(){
        return $this->nodes;
    }

    public function buildNodes(){
        $this->pageId = Context::PageId();
        $this->tableName = $this->getPageTable();

        $this->getPageInfo($this->pageId, $this->tableName);
    }

    protected function getPageTable(){
        $sql = "SELECT
                    `view`.tblName
                FROM
                    be_View `view`
                WHERE
                    `view`.className = '{$this->pageClass}'";

        if(!Context::DB()->query($sql)) return false;

        return Context::DB()->result[0]['tblName'];
    }

    protected function getPageInfo($id, $tbl){
        $sql = "SELECT
                    cat.title,
                    cat.parentId,
                    cat.codeName,
                    v.className
                FROM
                    {$tbl} cat
                INNER JOIN be_View v ON v.viewId = cat.viewId
                WHERE
                    cat.id = '{$id}'";

        if(!Context::DB()->query($sql)) return false;

        $result = Context::DB()->result[0];
        $result['link'] = appUrl::getUrlByCode($result['codeName'], $result['className']);

        array_unshift($this->nodes, $result);
//        $this->checkParents();
    }

    protected function checkParents(){
        $sql = "SELECT
                    count(*)
                FROM
                    fe_MenuItems
                WHERE
                    link like '%pagecode={$this->nodes[count($this->nodes) - 1]["codeName"]}%'";

        if(!Context::DB()->query($sql)) return false;

        $result = Context::DB()->result[0];
    }

}