<?php
include_once(BACKEND_PATH."libs/Tasks/TaskBase.php");
include_once(FRAMEWORK_PATH."system/DataHelpers/StringHelper.php");
include_once(FRAMEWORK_PATH."system/WebText.php");
set_time_limit(100000);
ini_set('memory_limit', '-1');
define("FATAL", E_USER_ERROR);
define("ERROR", E_USER_WARNING);
define("WARNING", E_USER_NOTICE);

error_reporting (FATAL | ERROR | WARNING);

class TasksModule
{
    public $resultTpl;

    public function getTasksForm()
    {
        global $lang;

        $tasksData = array();
        $tasksData["title"] = $lang['TASKS_FORM_TITLE'];
        $tasksData["tasks"] = $this->getTasksData();

        return $tasksData;
    }

    public function runTaskById($params)
    {
        $taskId = $params['taskId'];
        set_error_handler("myErrorHandler");
        $taskResult = array("Status" =>false);

         try
         {
            $q = "SELECT * FROM tbl_Tasks WHERE id = '$taskId'";
            Context::DB()->query($q);
            $task = Context::DB()->result[0];
            if($task == null) return $taskResult;

            $taskFile = BACKEND_PATH.'libs/Tasks/Processes/'.$task['moduleName'].'.php';
            if (!file_exists($taskFile))
                throw new Exception("Parser module for selected site not found. Module path: $taskFile");
            include_once($taskFile);

            $taskClass = new $task['moduleName']();

            $q = "UPDATE tbl_Tasks SET startDate = '" . date("Y-m-d h:s") . "' WHERE id = '$taskId'";
            Context::DB()->query($q);

            $taskResult["ResultData"] = $taskClass->run($params);
            $this->resultTpl = $taskClass->resultTpl;
            $taskResult["Status"] = true;

            $q = "UPDATE tbl_Tasks SET finishDate = '" . date("Y-m-d h:s") . "' WHERE id = '$taskId'";
            Context::DB()->query($q);
         }
         catch(Exception $e)
         {
             Context::Log(true, "task_errors")->err($e);
         }
        return $taskResult;
    }

    function myErrorHandler($errorNumber, $errorMessage, $errorFile, $errorLine)
    {
            Context::Log(true, "task_errors")->err("ErrorNumber: $errorNumber;
                                               ErrorMessage: $errorMessage
                                               ErrorFile: $errorFile
                                               ErrorLine: $errorLine");
    }

    private function getTasksData()
    {
        $taskList = array();
        $this->initTasks();

        $q = "SELECT * FROM tbl_Tasks WHERE visible = '1'";
        Context::DB()->query($q);
        foreach(Context::DB()->result as $result)
        {
            $startParams = unserialize($result['startParams']);

            if($startParams['export_fields']['type'] == 'export_fields')
            {
                $query = "SHOW FIELDS FROM fe_Users WHERE FIELD IN ('email','name','surname','patronymic','phoneNumber','birthDate')";

                if (!Context::DB()->query($query))
                    return false;
                $set_fields = Context::DB()->result;
                $results = array();
                $i = 0;
                foreach($set_fields as $item)
                {
                        $results[$i]['name'] = $item['Field'];
                        $i++;
                }
                $startParams['export_fields']['export_fields'] = $results;
            }

            $taskList[] = array('id' => $result['id'],
                                'name' => $result['name'],
                                'description' => $result['description'],
                                'module' => $result['moduleName'],
                                'startDate' => $result['startDate'],
                                'finishDate' => $result['finishDate'],
                                'startParams' => $startParams);
        }

        return $taskList;
    }

    private function initTasks()
    {
        $dir = BACKEND_PATH.'libs/Tasks/Processes/';
        if (!is_dir($dir)) return;
        if (!($dh = opendir($dir))) return ;

        while (($file = readdir($dh)) !== false)
        {
            if(!StringHelper::endsWith($file, ".php")) continue;

            if (!file_exists(BACKEND_PATH."libs/Tasks/Processes/$file"))
                throw new Exception("Parser module for selected site not found. Module name: $file");
            include_once(BACKEND_PATH."libs/Tasks/Processes/$file");

            $class = str_replace(".php", "", $file);

            $object = new $class();
            $method = $object->getBaseClassName();
            if($method == null) continue;
            if($method != "TaskBase") continue;


            $q = "SELECT * FROM tbl_Tasks where moduleName = '$class'";
            Context::DB()->query($q);
            $taskId = Context::DB()->result[0]['id'];
            if(Context::DB()->AFFR >= 1)
            {
                $taskName = addslashes($object->getTaskName());
                $taskDescription = addslashes($object->getTaskDescription());

                $q = "UPDATE tbl_Tasks SET name = '$taskName',
                                           description = '$taskDescription'
                      WHERE id = $taskId";

                Context::DB()->query($q);
                continue;
            }

            $taskName = addslashes($object->getTaskName());
            $taskDescription = addslashes($object->getTaskDescription());

            $params = $object->getTaskParams();
            $q = "INSERT INTO tbl_Tasks (name, description, moduleName, visible, startParams) VALUES('$taskName', '$taskDescription', '$class', '1', '" . serialize($params) . "')";
            Context::DB()->query($q);
        }
        closedir($dh);
    }
}