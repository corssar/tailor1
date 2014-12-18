<?php
require_once ('../../../../../../../config.php');
require_once(FRAMEWORK_PATH."system/Context.php");

class ImageData
{
    public function getImageData()
    {
        session_start();
        $useImageProcessing = Context::SiteSettings()->useImageProcessing();
        $toRet = "var useImageProcessing = ".$useImageProcessing.";";

        if($useImageProcessing)
        {
            if($sizes = $this->getImageSizes())
                $toRet.= $sizes;
                if($waterMarks = $this->getWaterMarks())
                    $toRet.= $waterMarks;
        }
        if($siteLanguages = $this->getSiteLanguages())
            $toRet.= $siteLanguages;

        return $toRet;
    }

    private function getImageSizes()
    {
        $query = "  SELECT be_ImageSizes.* FROM be_ImageSizes
                        WHERE be_ImageSizes.websiteId = ".Context::SiteSettings()->getSiteIdFromSession()."
                        ORDER BY be_ImageSizes.id";
        if(Context::DB()->query($query)){
            $sizes = "var imageSizesArr = [";
            $i=0;
            foreach (Context::DB()->result as $item){
                if($i)
                    $pref = ',';
                else
                    $pref = '';
                $sizes.= $pref."['".$item['id']."','".$item['title']."','".$item['folderName']."','".$item['useWatermark']."','".$item['isProportion']."','".$item['width']."','".$item['height']."','".$item['imageSizeCode']."']";
                $i++;
            }
            $sizes .= "];";
            }
            else {
                $sizes = "var imageSizesArr = [];";
            }

        return $sizes;
    }

    private function getWaterMarks()
    {
        $query = "  SELECT be_WaterMarks.* FROM be_WaterMarks
                        ORDER BY be_WaterMarks.id";
        if(Context::DB()->query($query)){
            $waterMarks = "var waterMarksArr = [";
            $i=0;
            foreach (Context::DB()->result as $item){
                if($i)
                    $pref = ',';
                else
                    $pref = '';
                $waterMarks.= $pref."['".$item['id']."','".$item['title']."']";
                $i++;
            }
            $waterMarks .= "];";
        }
        else {
            $waterMarks = "var waterMarksArr = [];";
        }
        return $waterMarks;
        //return false;
    }

    private function getSiteLanguages()
    {
        $query = "  SELECT be_Languages.* FROM be_Languages
                    INNER JOIN be_WebsiteLanguages
                      ON be_WebsiteLanguages.langId = be_Languages.id
                    WHERE be_WebsiteLanguages.websiteId = ".Context::SiteSettings()->getSiteIdFromSession()."
                    ORDER BY be_Languages.priority";
        if(Context::DB()->query($query)){
            $languages = "var siteLanguagesArr = [";
            foreach (Context::DB()->result as $item){
                $languages.= "['".$item['id']."','".$item['name']."'],";
            }
            $languages .= "];";
            return $languages;
        }
        return false;
    }
}

$imageData = new ImageData();
echo $imageData->getImageData();
