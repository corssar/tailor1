<?php
require_once(BACKEND_PATH.'libs/Custom/FileUpload.php');
require_once(BACKEND_PATH.'ajaxcontrollers/FileController.php');
require_once(FRAMEWORK_PATH.'system/ReservedRequestData.php');

class UploadManager
{
    private $poiImagesDir;
    private $poiImagesUrl;
    public $uploadedInfo;
    public function uploadImage($dirName, $paramName, $sizesArray)
    {
        $this->prepareUrls($dirName);

        $upload_handler = new UploadHandler();
        $upload_handler->setUploadPath($this->poiImagesDir, $this->poiImagesUrl);
        $upload_handler->setParamName($paramName);
        //$upload_handler->setIsTempVar(1);
        $fileNameArr = explode('.', $_FILES[$paramName]['name']);
        $upload_handler->setImageFileName(FileController::ruslat($fileNameArr[0]));
        //retrieve sizes detail
        $gallerySizesStr = "'".implode("','", $sizesArray)."'";
        $query =    "SELECT
                        be_ImageSizes.imageSizeCode as id ,
                        be_ImageSizes.imageSizeCode,
                        be_ImageSizes.folderName,
                        be_ImageSizes.width,
                        be_ImageSizes.height,
                        be_ImageSizes.useWatermark,
                        be_ImageSizes.isProportion
                    FROM be_ImageSizes
                    WHERE be_ImageSizes.websiteId = ".Context::SiteSettings()->getSiteId()."
                        AND be_ImageSizes.imageSizeCode in ($gallerySizesStr)
                    ORDER BY be_ImageSizes.id";
        if(!Context::DB()->query($query) && Context::DB()->error !== false)
            //there are no available sizes in database
            return false;

        $sizes = new stdClass();
        $sizes->sizes = json_decode(json_encode(Context::DB()->result));
        if(count($sizes->sizes)>0)
            $upload_handler->setImageVersions($this->poiImagesDir, $sizes->sizes, $this->poiImagesUrl);
        //watermark settings
        if(!$upload_handler->setWaterMark(POI_IMAGES_DEFAULT_WATERMARK_ID)){
            Context::Log()->log("Error watermark settings. (be_WaterMarks OR backend/config.php-> \$imageProcessingSettings)");
        }

        $result = $upload_handler->post();

        foreach($result[0] as $key=>$value){
            if(strpos($key, '_url'))
                $this->uploadedInfo['images'][str_replace('_url', '', $key)] = $value;
        }
        $this->uploadedInfo['origImageName'] = $result[0]->name;
        $this->uploadedInfo['origImageId'] = $result[0]->origImageId;

        return $result[0]->origImageId;
    }
    private function prepareUrls($dirName)
    {
        $this->poiImagesDir = FRONTEND_PATH."webcontent/websites/".Context::SiteSettings()->getSiteId()."/images/".$dirName;
        if(!file_exists($this->poiImagesDir))
            mkdir($this->poiImagesDir);
        $this->poiImagesDir.= "/";
        $this->poiImagesUrl = SITE_PROTOCOL.SITE_URL."/frontend/webcontent/websites/".Context::SiteSettings()->getSiteId()."/images/".$dirName."/";
    }
}
