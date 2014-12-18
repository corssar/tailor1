<?php
require_once(FRAMEWORK_PATH . "system/breadcrumbs/config.php");

class CatalogBreadCrumb extends BreadCrumbBase
{

    protected function getPageInfo($id, $tbl)
    {
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

        if (!Context::DB()->query($sql))
            return false;

        $result = Context::DB()->result[0];
        $result['link'] = appUrl::getUrlByCode($result['codeName'], $result['className']);


        if(isset($result['parentId']) && $result['parentId'] != 0){
            array_unshift($this->nodes, $result);
            $this->getPageInfo($result['parentId'], $tbl);
        }

        return true;
    }

}