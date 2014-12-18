<?php
@define("DEBUG_MODE", true);
define("DB_BE_TBL_PREFIX", "be_");
define("DB_FE_TBL_PREFIX", "fe_");

//define("SERVER_ROOT_PATH",SERVER_PATH.'http/');

//define("CMS_PATH", SITE_PATH);

//Constants for work filemanager
define("PATH_TO_CMS_FOR_FILEMANAGER", SITE_DIR);
define("DIR_FOR_FILEMANAGER_PATH","frontend/webcontent/");
define("PATH_TO_NORMAL_IMAGE_FILES","frontend/webcontent/images");
define("PATH_TO_SMALL_IMAGE_FILES","frontend/webcontent/other");
//define("FILEMANAGER_CONTROLLER","../ajaxcontrollers/FileController.php");
$filemanagertypes = array();
$filemanagertypes['file'] = "file";
$filemanagertypes['javascript'] = "js";
$filemanagertypes['css'] = "css";
$filemanagertypes['video'] = "video";
$filemanagertypes['audio'] = "audio";
$filemanagertypes['templates'] = "templates";
$filemanagertypes['image'] = "images";
define("TRANSLIT",true);
define("FILEMANAGER_PREVIEW_IMAGE", false);
define("SEARCHED_ITEMS_ON_PAGE",20);

define("USE_MENU_NAVID",false);

//Constants for PageBuilder. Contain view types
define("TREE_NAVIGATION_VIEW",8);
define("MAINPAGE_TPL_VIEW",13);
define("SEARCH_VIEW_TYPE",4);
define("ORDER_MODERATION_VIEW",65);
@define("IMPORT_PATH", SITE_PATH . "import/");

$imageProcessingSettings = array(
    "deleteOriginalImage" => true,
    "originalImagesPath"=>FRONTEND_PATH.FRONTEND_CONTENT_PATH."system_images/originalImages",
    "waterMarksPath"=>FRONTEND_PATH.FRONTEND_CONTENT_PATH."images/waterMarks",
    "waterMarksTransparency"=>75,
    "waterMarksFactor"=>0.2);

?>
