<?php
require_once(BACKEND_PATH . "libs/Tasks/TaskBase.php");
require_once(FRAMEWORK_PATH . "system/WebText.php");
include_once(SITE_PATH . 'vendors/aws/sdk.class.php');

class TaskTest extends TaskBase
{
    public $factorial;
    public function getTaskName()
    {
        return WebText::getText('TEST_TASK', "Тестовий процес");
    }
    public function getTaskParams()
    {
        $params = array();
        $p1 = array('type' => 'input',
            'ext' => '',
            'text' => WebText::getText('ENTER_NUMBER_FACTORIAL', "Введть число факторіала:"));
        $params['input'] = $p1;
        return $params;
    }

    public function init()
    {
        $this->resultTpl = BACKEND_PATH . "templates/tasksModule/testModule.tpl";
    }

    public function execute($params = null)
    {
        $this->resultData['factorial'] = $this->factorial($params['inputName']);
        return $this->resultData;
    }

    public function getTaskDescription()
    {
        return WebText::getText('TEST_SHOW_TASK', "Процес показу тестового процеса");
    }
    function factorial($n)
    {
        $factorial = 1;
        for ($i = 2; $i <= $n; $i++)
        {
            $factorial = $factorial * $i;
        }
        return $factorial;
    }
}