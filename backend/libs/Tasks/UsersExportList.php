<?php
require_once '../../../config.php';
include_once(SITE_PATH . 'vendors/aws/sdk.class.php');
include_once(SITE_PATH . 'vendors/Excel/PHPExcel.php');
include_once(SITE_PATH . 'vendors/Excel/PHPExcel/Writer/Excel5.php');
require_once(SITE_PATH.'framework/system/Context.php');
include(BACKEND_PATH.'inc/BackendInit.inc.php');

if (!$admin->auth_ok)
{
    header('Location: ../../Access.php');
}
class UsersExportList{

    protected $settings;
    protected $mime;
    protected $ext;
    protected $taskId;
    protected $export_fields;
    protected $export_format;

    protected $exts = array(  'CSV'       => 'csv',
        'PDF'       => 'pdf',
        'Excel5'    => 'xls',
        'Excel2007' => 'xlsx');

    protected $mimes = array( 'CSV'       => 'text/csv',
        'PDF'       => 'application/pdf',
        'Excel5'    => 'application/vnd.ms-excel',
        'Excel2007' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    public function __construct($settings=array())
    {
        $this->taskId = (Request::getInt('id', 'GET')) ? Request::getInt('id', 'GET'): 0;
        $this->export_fields = (Request::getString('fieldName', 'GET')) ? Request::getString('fieldName', 'GET'): '';
        $this->export_format = (Request::getString('format', 'GET')) ? Request::getString('format', 'GET'): 'Excel5';
        $this->settings = array_merge(array('format' => $this->export_format, 'name' => 'UsersExportList_'.date('m-d-Y')), $settings);
        //define mime type and extention of document
        $this->mime	= $this->mimes[$this->settings['format']];
        $this->ext	= $this->exts[$this->settings['format']];
        //needed for mysql_real_escape_string
        Context::DB()->__connect();
    }
    public function run()
    {
            self::getFile();
    }
    public function getFile(){

        $q = "SELECT resultParams FROM tbl_Tasks WHERE id = $this->taskId";
        if (!Context::DB()->query($q))
            return false;
        $resultParams = unserialize(Context::DB()->result[0]['resultParams']);
        $fields = explode(",",$this->export_fields);
        $xls = new PHPExcel();

        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();
        $sheet->setTitle('Users Information');
        $fields_title = array ("A1"=>"","B1"=>"","C1"=>"","D1"=>"","E1"=>"","F1"=>"");
        $index = 0;
        foreach ($fields_title as $key =>$val){
            if ($index==count($fields)){
                break;
            }
        $fields_title[$key] = $fields[$index];
        $index++;
        }

        $i = 1;
        foreach($resultParams as $arrays)
        {
            foreach($fields_title as $field => $field_value){
                if ($field_value !=null){
                    $sheet->setCellValue($field, $field_value);
                    $sheet->getStyle($field)->getFill()->setFillType(
                        PHPExcel_Style_Fill::FILL_SOLID);
                    $sheet->getStyle($field)->getFill()->getStartColor()->setRGB('EEEEEE');
                    $sheet->getColumnDimension(substr($field, 0, -1))->setAutoSize (true);
                }
            }
            $j=0;
            foreach ($arrays as $value) {
                $sheet->setCellValueByColumnAndRow($j,$i,$value);
                $j++;
            }
        $i++;
        }
        header('Content-Type: ' . $this->mime);
        header('Content-Disposition: attachment;filename="'.$this->settings['name'].'.'.$this->ext.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($xls, $this->settings['format']);
        $objWriter->save('php://output');

    }
}
$usersExportList = new UsersExportList();
$usersExportList->run();





