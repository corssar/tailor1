<?php

require_once('../../../config.php');
if (file_exists(SITE_PATH.'vendors/Excel/PHPExcel.php')) {
    require_once(SITE_PATH.'vendors/Excel/PHPExcel.php');
}

require_once(SITE_PATH.'framework/system/SiteSettings.php');
require_once(SITE_PATH.'framework/system/Context.php');
require_once(SITE_PATH.'backend/config.php');

class WebTextsExport
{
    protected $settings;
    protected $mime;
    protected $ext;
    protected $exts = array(  'CSV'       => 'csv',
        'PDF'       => 'pdf',
        'Excel5'    => 'xls',
        'Excel2007' => 'xlsx');
    protected $mimes = array( 'CSV'       => 'text/csv',
        'PDF'       => 'application/pdf',
        'Excel5'    => 'application/vnd.ms-excel',
        'Excel2007' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    protected $errorText = "";
    protected $importFileName = "";
    protected $webtextArray;

    public function __construct($settings=array())
    {
        $this->settings = array_merge(array('format' => 'Excel5', 'name' => 'WebTexts_'.date('m-d-Y')), $settings);
        //define mime type and extention of document
        $this->mime	= $this->mimes[$this->settings['format']];
        $this->ext	= $this->exts[$this->settings['format']];
        //needed for mysql_real_escape_string
        Context::DB()->__connect();
    }

    private function getWebTexts()
    {
        $langs = explode("_", $_GET["langs"]);
        $webTexts = array();

        foreach($langs as $lang)
        {
            if($lang != null || $lang != "")
            {
                $query = "SELECT wt.keyword, wt.description, l.name as langName, l.id as langId
                          FROM fe_WebText wt
                          INNER JOIN be_Languages l on l.id = wt.langId
                          WHERE langId = $lang and wt.keyword not like 'BE_%' and wt.keyword not like 'bo_%' and wt.keyword not like 'BO_%'
                          Group BY wt.keyword";

                if(Context::DB()->query($query))
                {
                    foreach(Context::DB()->result as $webText)
                    {
                        if(self::startsWith(strtoupper($webText['keyword']), "bo_")) continue;

                        $item = array('description_'.$webText['langId'] => $webText['description'],
                                      'langName' => $webText['langName']);
                        $webTexts[$webText['keyword']][$webText['langId']] = $item;
                    }
                }
                else
                {
                    $query = "SELECT name
                              FROM be_Languages
                              WHERE id = $lang";

                    Context::DB()->query($query);
                    $langName  = Context::DB()->result[0]['name'];

                    $query = "SELECT wt.keyword, wt.description, '$langName' as langName, $lang as langId
                              FROM fe_WebText wt
                              INNER JOIN be_Languages l on l.id = wt.langId
                              WHERE langId = 1 and wt.keyword not like 'BE_%' and wt.keyword not like 'bo_%' and wt.keyword not like 'BO_%'
                              Group BY wt.keyword";

                    Context::DB()->query($query);

                    foreach(Context::DB()->result as $webText)
                    {
                        if(self::startsWith(strtoupper($webText['keyword']), "bo_")) continue;

                        $item = array('description_'.$webText['langId'] => $webText['description'],
                            'langName' => $webText['langName']);
                        $webTexts[$webText['keyword']][$webText['langId']] = $item;
                    }
                }
            }
        }

        return $webTexts;
    }

    function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    public function run()
    {
        if(Request::getInt("fileImport")>0)
        {
            if(!$this->importFile()){
                Context::Log()->Log($this->errorText);
                echo '<script type="text/javascript">
                    window.parent.webtextImportReqponse(false);
                </script> 2';
            }

            echo '<script type="text/javascript">
                window.parent.webtextImportReqponse(true);
            </script> 1';
            //delete uploaded file
            if(strlen($this->importFileName)>0)
                unlink($this->importFileName);
        }
        else{
            //export
            self::exportWebtexts();
        }
        exit;
    }
    private function importFile(){
        if(!$this->fileUpload()){
            $this->errorText .= "; File was not uploaded;";
            return false;
        }

        if($this->parseExcel() and $this->insertToDatabase()){
            return true;
        }
        else{
            return false;
        }


    }
    private function parseExcel(){
        $objPHPExcel = PHPExcel_IOFactory::load($this->importFileName);
        $objWorksheet = $objPHPExcel->getActiveSheet();

        $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
        $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

        $langMapping = array();
        for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            $langId = (int)$objWorksheet->getCellByColumnAndRow($col, 2)->getValue();
            if($langId > 0)
                $langMapping[$langId] = $col;
        }

        //skip first Two row
        if(count($langMapping)==0){
            $this->errorText .= ";Parse Error.Cannot determine list of languages.";
            return false;
        }

        for ($row = 3; $row <= $highestRow; ++$row)
        {
            foreach($langMapping as $langId => $columnNr)
            {
                //array list 'keyword'=>'value'
                $this->webtextArray[$langId][$objWorksheet->getCellByColumnAndRow(0, $row)->getValue()] = $objWorksheet->getCellByColumnAndRow($columnNr, $row)->getValue();
            }
        }
        return true;
    }
    private function insertToDatabase()
    {
        //prepare site list
        if(Request::getInt("importAll")==1)
        {
            include_once(FRAMEWORK_PATH.'system/helper/WebsiteManager.php');
            $siteList = WebsiteManager::getWebsitesWithLanguages();
        }
        else
            $siteList[] = array('id'=>Request::getInt("siteId"));


        //generate script for languages
        foreach($this->webtextArray as $langId => $keywords)
        {
            $query = "REPLACE INTO fe_WebText( `langId`, `keyword`, `description`, `websiteId` )
                          VALUES";
            $firstItem = true;
            foreach($keywords as $key => $value)
            {
                if($firstItem)
                    $firstItem = false;
                else
                    $query .= ",\n";

                $query .= "( $langId, '$key', '".mysqli_real_escape_string(Context::DB()->pointer,$value)."', _websiteId_ )";
            }

            //create script for sites
            foreach($siteList as $key => $site)
            {
                $insertSql = str_replace('_websiteId_', $site['id'], $query);
                if(!Context::DB()->query($insertSql)){
                    $this->errorText .= ";Error Insert to DB. query: ".$insertSql;
                    return false;
                }
            }
        }
        return true;
    }
    private function exportWebtexts()
    {
        $webTexts = self::getWebTexts();
        if($webTexts == null) return null;

        date_default_timezone_set('UTC');

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set properties
        $objPHPExcel->getProperties()->setCreator("IGo to World WebTexts export")
            ->setTitle("IGo to World WebTexts export")
            ->setSubject("IGo to World WebTexts export")
            ->setDescription("IGo to World WebTexts export");

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "Keyword");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, "LangId");
        $i = 1;

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(60);

        foreach(reset($webTexts) as $k=>$data)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 1, $data['langName']);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 2, $k);

            $i++;
        }

        $j = 3;
        foreach ($webTexts as $keyword=>$webText)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $j, $keyword);

            $i = 1;
            foreach($webText as $k=>$wt)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, $j, $wt['description_'.$k]);
                $i++;
            }

            $j++;
        }
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a clients web browser (Excel2007)
        header('Content-Type: ' . $this->mime);
        header('Content-Disposition: attachment;filename="'.$this->settings['name'].'.'.$this->ext.'"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $this->settings['format']);
        $objWriter->save('php://output');
    }
    private function fileUpload($folderName='webtext', $postFileName = 'webtextFile')
    {
        $error = "";
        if(!empty($_FILES[$postFileName]['error']))
        {
            switch($_FILES[$postFileName]['error'])
            {
                case '1':
                    $error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                    break;
                case '2':
                    $error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                    break;
                case '3':
                    $error = 'The uploaded file was only partially uploaded';
                    break;
                case '4':
                    $error = 'No file was uploaded.';
                    break;
                case '6':
                    $error = 'Missing a temporary folder';
                    break;
                case '7':
                    $error = 'Failed to write file to disk';
                    break;
                case '8':
                    $error = 'File upload stopped by extension';
                    break;
                case '999':
                default:
                    $error = 'No error code avaiable';
            }
        }
        else{
            if(!file_exists(IMPORT_PATH.$folderName))
                if(!mkdir(IMPORT_PATH.$folderName, 0777))
                {
                    $error = "Error creating directory";
                }
        }

        if($error==""){
            $tmp_name = $_FILES[$postFileName]["tmp_name"];
            move_uploaded_file($tmp_name, IMPORT_PATH.$folderName.'/'.$_FILES[$postFileName]["name"]);
            $this->importFileName = IMPORT_PATH.$folderName.'/'.$_FILES[$postFileName]["name"];
            return true;
        }
        else{
            $this->errorText = $error;
            return false;
        }
    }
}

$webTextsExport = new WebTextsExport();
$webTextsExport->run();