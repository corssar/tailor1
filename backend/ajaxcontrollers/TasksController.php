<?php
include_once(BACKEND_PATH."libs/Tasks/TasksModule.php");

class TasksController
{
    public $response = array('HTML'=>'', 'JS' => '');

    public function buildTasksForm()
    {
        $tasksModule = new TasksModule();
        $viewObj = new SmartyView();
        $arrayData = $tasksModule->getTasksForm();
        $this->response['HTML'] = $viewObj->fetch(BACKEND_PATH."templates/tasksModule/tasksModuleForm.tpl", $arrayData);
        $this->response['JS'] = "Menu.leftenable();showTaskHelpDescription();";

        return $this->response;
    }

    public function runTask($params)
    {
        $tasksModule = new TasksModule();
        $viewObj = new SmartyView();
        $arrayData = $tasksModule->runTaskById($params);
        $usersExportFile = $arrayData['ResultData'];
        if ($usersExportFile['success'] == true){
            $this->response['JS'] = "Menu.leftenable(); window.open('$usersExportFile[hrefFile]')";
            $this->response['HTML'] = $viewObj->fetch($tasksModule->resultTpl, $arrayData);
            return $this->response;
        }
        $this->response['HTML'] = $viewObj->fetch($tasksModule->resultTpl, $arrayData);
        $this->response['JS'] = "Menu.leftenable();";
        return $this->response;
    }
}