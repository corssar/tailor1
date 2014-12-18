<?php
require_once(BACKEND_PATH . "libs/Tasks/TaskBase.php");
require_once(FRAMEWORK_PATH . "system/WebText.php");
require_once(SITE_PATH.'framework/system/Context.php');
require_once(SITE_PATH.'backend/config.php');

class UsersExportFile  extends TaskBase
{
    public function getTaskName()
    {
        return WebText::getText('USERS_EXPORT_EXCEL', "Export users");
    }

    public function getTaskParams()
    {
        $params = array();

        $p1 = array('type' => 'export_fields',
            'ext' => '',
            'text' => WebText::getText('SELECT_EXPORT_FIELD', "Select export fields"),
            'export_format' => WebText::getText('SELECT_EXPORT_FORMAT', "Select export format"),
            'export_type_users' => WebText::getText('SELECT_EXPORT_TYPE_USERS', "Select type users"));

        $params['export_fields'] = $p1;

        return $params;
    }

    public function init()
    {
        $this->resultTpl = BACKEND_PATH . "templates/tasksModule/usersExportFile.tpl";
    }

    public function execute($params = null)
    {
        if (!empty($params['export_fields'])&& !empty($params['export_format']) && !empty($params['taskId'])){
            $this->resultData['hrefFile'] = $this->selectUsersData($params['export_fields'],$params['export_format'],$params['taskId'],$params['export_type']);
            $this->resultData['success'] = true;
        }
        return $this->resultData;
    }

    public function getTaskDescription()
        {
        return WebText::getText('USERS_EXPORT_EXCEL_TASK', "Process showing export users");
    }

    function selectUsersData ($export_fields,$export_format,$taskId,$export_type)
    {
        if($export_fields == ""){
            $export_fields = "email,name,surname,patronymic,phoneNumber,birthDate";
            $query = "SELECT $export_fields FROM fe_Users WHERE $export_type = 1";
        }else{
            $export_fields = substr($export_fields, 0, -1);
            $query = "SELECT $export_fields FROM fe_Users WHERE $export_type = 1";
        }

        if (!Context::DB()->query($query))
            return false;
        $UsersData = Context::DB()->result;
        $q = "UPDATE tbl_Tasks SET resultParams ='" . serialize($UsersData) . "' WHERE id = '" . $taskId . "'";
        if (!Context::DB()->query($q))
            return false;
        $hrefFile = (SITE_PROTOCOL . SITE_URL . '/backend/libs/Tasks/UsersExportList.php?id='. $taskId .'&fieldName='. $export_fields .'&format='.$export_format.'');
        return $hrefFile;

    }



 }
