<?php
class ProductBreadCrumb extends BreadCrumbBase{

    protected function getPageInfo($id, $tbl)
    {
        $sql = "SELECT
                    title,
                    categoryId,
                    codeName
                FROM
                    {$tbl}
                WHERE
                    id = '{$id}'";

        if (!Context::DB()->query($sql))
            return false;

        $result = Context::DB()->result[0];
        $result['link'] = appUrl::getUrlByCode($result['codeName'], $this->pageClass);

        array_unshift($this->nodes, $result);

        $this->getRelatedCategoriesById($result['categoryId']);

        return true;
    }

    private function getRelatedCategoriesById($categoryId){
        $sql = "SELECT
                    cat.title,
                    cat.parentId,
                    cat.codeName,
                    v.className
                FROM
                    fe_ProductCategories cat
                INNER JOIN be_View v ON v.viewId = cat.viewId
                WHERE
                    cat.id = '{$categoryId}'";

        if (!Context::DB()->query($sql))
            return false;

        $result = Context::DB()->result[0];
        $result['link'] = appUrl::getUrlByCode($result['codeName'], $result['className']);
        $aCurItemData['me']['selectedItem'] = 1;


        if(isset($result['parentId']) && $result['parentId'] != 0){
            array_unshift($this->nodes, $result);
            $this->getRelatedCategoriesById($result['parentId']);
        }

        return true;
    }

}