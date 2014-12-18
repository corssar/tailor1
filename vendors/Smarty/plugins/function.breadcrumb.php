<?php

function smarty_function_breadcrumb($params, &$smarty)
{
    $html = '';
    if(isset($params['nodes']['other'])){
        $param = $params['nodes']['other'];
        $params['nodes'] = array();
        $params['nodes'][0] = $param;
        unset($params['nodes'][0]['me']);
        for($i = 0; $i < count($params['nodes'][0]); ++$i){
            $html .= '<li class="btn-crumb" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" itemprop="url">';
            $html .= '<a href="';
            $html .= ($i == count($params['nodes'][0]) - 1) ? 'javascript: void(0)' : $params['nodes'][0][$i]['link'];
            $html .= '" typeof="v:Breadcrumb" itemprop="item">';
            $html .= '<span class="text-el" itemprop="name">' . $params['nodes'][0][$i]["title"] . '<span class="divider">&#8594;</span></span></a></li>';
        }
        /*foreach($params['nodes'][0] as $v){
            $html .= '<li class="btn-crumb">';
            $html .= '<a href="' . $v['link'] . '" typeof="v:Breadcrumb">';
            $html .= '<span class="text-el">' . $v["title"] . '<span class="divider">&#8594;</span></span></a></li>';
        }*/
        return $html;
    }
    if(isset($params['nodes'][0]['me']) && $params['nodes'][0]['me']['selectedItem'] == '0'){
        array_splice($params['nodes'], 0, 1);
        $html .= smarty_function_breadcrumb($params, $smarty);
    }
    elseif($params['nodes'][0]['me']['selectedItem'] == '1'){
        $selectedMenuItemId = $params['nodes'][0]['me']['selectedItemId'];

        if(!isset($params['nodes'][0]['me']['moduleId']) || ($params['nodes'][0]['me']['moduleId'] == '0')){
            $html .= '<li class="btn-crumb" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" itemprop="url">';
            $html .= '<a href="';
            $html .= ($params['nodes'][0]['me']['id'] == $selectedMenuItemId) ? 'javascript: void(0)' : $params['nodes'][0]['me']['link'];
            $html .= '" typeof="v:Breadcrumb" itemprop="item">';
            $html .= '<span class="text-el" itemprop="name">' . $params["nodes"][0]["me"]["treeItemName"] . '<span class="divider">&#8594;</span></span></a></li>';
        }
        foreach($params['nodes'][0] as $k => $v){
            if($k !== 'me'){
                $html .= smarty_function_breadcrumb(array ('nodes' => array($v)), $smarty);
            }
        }
    }

    return $html;
}