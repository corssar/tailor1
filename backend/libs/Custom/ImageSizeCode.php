<?php

class ImageSizeCode
{
    function __construct()
    {
    }

    public function imageSizeCode($id,$params = array())
    {
        if($params['posted'])
        {
            if($params['isNewSize'] == 1){
                //Context::DB()->query("UPDATE be_ImageSizes SET imageSizeCode = '".$params['imageSizeCode']."_".$id."' WHERE id = $id");
                Context::DB()->query("UPDATE be_ImageSizes SET imageSizeCode = '".$params['imageSizeCode']."' WHERE id = $id");
            }
        }
        else
        {
            $html   =   '<input type="hidden" name="customField[posted]" value="1">';
            $isNewSize = 0;
            if(!$id){
                $isNewSize = 1;
                $html  .=   '<input type="hidden" id="imageSizeCode"  name="customField[imageSizeCode]" value="" />';
            }
            $html  .=   '<input type="hidden" id="isNewSize" name="customField[isNewSize]" value="'.$isNewSize.'">';
        }
        $result['html'] = $html;
        $result['js'] = 'setImageSizeCodeField();';
        return $result;
    }
}
?>