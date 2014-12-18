<?php
function smarty_function_price_format ($params, &$smarty)
{
        $symbol = WebText::getText ("webtext_euro_symbol", "ˆ ");
        if ($params['price'] == (int)$params['price']){
            $price  = $symbol.(int)$params['price'].".-";
            if ((int)$params['price'] == 0){
                $price = '';
            }
        }else{
            $price = $symbol.$params['price'];
         }
        return $price;
}
?>