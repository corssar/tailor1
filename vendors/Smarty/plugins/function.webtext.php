<?php

function smarty_function_webtext($params, &$smarty)
{
    $useCache = isset($params['useCache']) ? $params['useCache'] : true;
    $remark = isset($params['remark']) ? $params['remark'] : '';
    return WebText::getText($params['keyword'], $params['value'], $useCache, $remark);
}