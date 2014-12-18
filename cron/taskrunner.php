<?php
require_once ('../config.php');
require_once(BACKEND_PATH.'config.php');
include(BACKEND_PATH.'inc/BackendInit.inc.php');

$query="SELECT * FROM tbl_Tasks
        WHERE ifnull(`interval`,0)>0 AND IFNULL(nextRunDate, '".date('Y-m-d H:i:s', strtotime("-1 minutes"))."') <'".date('Y-m-d H:i:s')."'";
 if(Context::DB()->query($query))
{
    $tasks = Context::DB()->result;
    foreach ($tasks as $task)
    {
        $taskFile = BACKEND_PATH.'libs/Tasks/Processes/'.$task['moduleName'].'.php';
        if (!file_exists($taskFile)){
            Context::Log("file", 'error', "task_log")->log('Task error:    '.$e);
            throw new Exception("Parser module for selected site not found. Module path: $taskFile");
        }

        include_once($taskFile);
        $taskObj = new $task['moduleName']($task['id'], unserialize($task['startParams']), true);
        $taskResult = $taskObj->run();
        if(isset($taskResult["Status"]) && $taskResult["Status"] == true){
            Context::Log("file", date('Y.d.m'), "task_log")->log('Task runned succesfully.Task name: '.$task['moduleName']);
            echo $task['moduleName'].' OK<br>';
        }
        else{
            Context::Log("file", date('Y.d.m'), "task_log")->log('Task finished with false result.Check BE_Log for more detail. Task name: '.$task['moduleName']);
            echo $task['moduleName'].' Not ok<br>';
        }
    }
}
else{
    Context::Log("file", 'error', "task_log")->log('No task for running');
}
exit();