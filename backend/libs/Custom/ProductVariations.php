<?php
include_once(FRAMEWORK_PATH."system/tpl_engine/SmartyView.php");

class ProductVariations
{
    public $fieldId;
    public $viewId;
    public $fieldName;
    public $additionalParams = array();

    public function genProductVariations($id, $params = array())
    {
        $result = array();

        if(isset($id) && $id)
        {
            $result['html'] = '';
            $result['js'] = '';
            return $result;
        }

        $variationsListFieldId = $params[0];
        unset($params[0]);

        $view = new SmartyView();
        $templateData = array();

        $attributes = array();
        $query = "  SELECT
                        fe_ProductAttributes.id as attributeId,
                        fe_ProductAttributes.title as attributeTitle,
                        fe_ProductAttributeItems.id as attributeItemId,
                        fe_ProductAttributeItems.title as attributeItemTitle
                    FROM
                        fe_ProductAttributes
                    INNER JOIN
                        fe_ProductAttributeItems
                        ON
                            fe_ProductAttributeItems.attributeId = fe_ProductAttributes.id
                    ";
        if(Context::DB()->query($query))
        {
            $i = 0;
            $j = 0;
            $lastAttributeId = 0;
            foreach(Context::DB()->result as $attribute)
            {
                if($lastAttributeId != $attribute['attributeId'])
                {
                    $i++;
                    $lastAttributeId = $attribute['attributeId'];
                    $attributes[$i]['attributeId'] = $attribute['attributeId'];
                    $attributes[$i]['attributeTitle'] = $attribute['attributeTitle'];
                    $attributes[$i]['attributeItems'] = array();
                    $j = 0;
                    $attributes[$i]['attributeItems'][$j]['attributeItemId'] = $attribute['attributeItemId'];
                    $attributes[$i]['attributeItems'][$j]['attributeItemTitle'] = $attribute['attributeItemTitle'];
                }
                else
                {
                    $j++;
                    $attributes[$i]['attributeItems'][$j]['attributeItemId'] = $attribute['attributeItemId'];
                    $attributes[$i]['attributeItems'][$j]['attributeItemTitle'] = $attribute['attributeItemTitle'];
                }
            }
        }

        $templateData['attributes'] = $attributes;
        $templateData['variationsListFieldId'] = $variationsListFieldId;
        $templateData['productViewId'] = $this->viewId;
        $html = $view->fetch(BACKEND_PATH.'templates/productAttributes.tpl', $templateData);

        $result['html'] = $html;
        $result['js'] = '';

        return $result;
    }

}
