<?php
class Paging
{
    public static $offset = 3;
    public static $tag = '?';

    public static function buildPaganation($pagesCount, $currentPage, $handler, $templatePath = 'PageObjects/pagingObject.tpl')
    {
        $arrayData['pagesCount'] = $pagesCount;
        $arrayData['currentPage'] = $currentPage;
        $arrayData['handler'] = $handler;
        $arrayData['tag'] = self::$tag;
        $arrayData['startPaginingPage'] = ($currentPage - self::$offset)>=1 ? $currentPage - self::$offset : 1;
        $arrayData['endPaginingPage'] = ($currentPage + self::$offset)<= $pagesCount ? $currentPage + self::$offset : $pagesCount;

        $view = new SmartyView();
        return $view->fetch(FRONTEND_TEMPL_PATH.$templatePath, $arrayData);
    }
}