<?php
require_once(FRAMEWORK_PATH."system/WebText.php");

class ImageManager
{
    public static function CheckImagesByUrl($imageUrls)
    {
        $imageList = array();
        global $gallerySizes;
        $params = '';
        foreach ($imageUrls as $imageUrl)
        {
            $params.= "'" . appUrl::ValuesToCMSConstants($imageUrl) . "',";
        }
        $params = substr($params, 0, -1);

        $query = "SELECT imageId, url FROM be_ImageSizeRelations WHERE url in ($params)";
        Context::DB()->query($query);

        $params = '';
        $res = array();
        foreach (Context::DB()->result as $result)
        {
            $params.= "'{$result['imageId']}',";

            $res[$result['imageId']] = $result['url'];
        }
        $params = substr($params, 0, -1);

        $query = "SELECT isr.id, isr.imageId, isr.url, be_ImageDescription.* FROM be_ImageSizeRelations isr
                  INNER JOIN be_ImageDescription ON be_ImageDescription.imageId = isr.imageId
                  WHERE isr.imageId in ($params) AND isr.sizeCode = '{$gallerySizes['size_1']}'";

        Context::DB()->query($query);

        foreach(Context::DB()->result as $result)
        {
            if($res[$result['imageId']] != null) $result['smallImageUrl'] = appUrl::CMSConstantsToValues($res[$result['imageId']]);
            $result['bigImageUrl'] = appUrl::CMSConstantsToValues($result['url']);
            $result['altText'] = "{$result['workName']} &lt;br&gt; " . WebText::getText("photograph","Фотограф:") .
                                 " &lt;a href=&quot;{$result['authorUrl']}&quot;&gt; {$result['author']}&lt;/a&gt; &lt;/br&gt;";

            $imageList[] = $result;
        }

        return $imageList;
    }

    public static function CheckImageByUrl($imageUrl)
    {

    }
}
