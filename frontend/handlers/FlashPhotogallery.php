<?php
require_once(FRAMEWORK_PATH."system/WebText.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
require_once(FRAMEWORK_PATH."data_objects/NewsListData.php");

class FlashPhotogallery
{
	var $viewId = 27;
	var $photoId = 0;
	var $galleryId = 0;
	var $gameId = 0;
	
	function __construct()
	{
		if (isset($_POST['photoID']))
		{
			$this->photoId = intval($_POST['photoID']);
			$this->getRatecount();	
		}
		elseif (isset($_GET['newsId']))
		{
			$this->galleryId = intval($_GET['newsId']);
			$this->getXML($this->getPhotosByNewsId());
		}
		else return false;
	}
	
	function getRatecount()
	{
		$db = DB::getInstance();
		$query = "UPDATE fe_PagesRelatedItems SET number1=number1+1 WHERE viewId={$this->viewId} AND id={$this->photoId}";
		if ($db->query($query)) 
		{
			$query = "SELECT number1 FROM fe_PagesRelatedItems WHERE viewId={$this->viewId} AND id={$this->photoId}";
			if ($db->query($query))
			{
				foreach ( $db->result as $item)
				{
					$ratecount = $item['number1'];
				}
				echo "ratesuccess=true&ratecount=".$ratecount;
			}
		}
	}
	
	function getPhotosByNewsId()
    {
        $gallery = new NewsListData(0);
        return $gallery->getPhotos($this->galleryId);
    }
  
    function getXML($photos)
    {
    	$ratebutton = mb_convert_encoding("Проголосувати за це фото", "UTF-8", "cp-1251");
    	$ratetext = mb_convert_encoding("За це фото проголосувало:", "UTF-8", "cp-1251");
    	$authortext = mb_convert_encoding("Автор:", "UTF-8", "cp-1251");
    	header('Content-type: application/xml'); 
		echo '<?xml version="1.0" encoding="utf-8"?>';
		echo "\n<gallery autoplay=\"false\" showtime=\"15\" ratetext=\"{$ratetext}\" authortext=\"{$authortext}\" rateurl=\"".SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/frontend/pages/ajaxHandler.php?handler=FlashPhotogallery&action=getRatecount\"  bgimage=\"\" showrating=\"1\">";
		foreach ($photos as $item)
	    {
	    	echo "\n		<image id=\"{$item['id']}\" src=\"{$item['image']}\" smallsrc=\"{$item['image']}\" rate=\"true\" author=\"{$item['author']}\">{$item['description']}</image>";
	    }
		echo "\n</gallery>";
		
	}
}


$FlashPhotogallery = new FlashPhotogallery();
?>