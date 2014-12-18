<?php
require_once(FRAMEWORK_PATH."system/helper/ImageManager.php");

class RaiseImageController
{
    public function CheckImages()
    {
        $imageUrls = array_filter(explode("||", Request::getString("imageUrls")));
        return ImageManager::CheckImagesByUrl($imageUrls);
    }
}

$raiseImageController = new RaiseImageController();

switch ($_REQUEST['action'])
{
    case 'CheckImages'			: echo json_encode($raiseImageController->CheckImages());	break;
}
