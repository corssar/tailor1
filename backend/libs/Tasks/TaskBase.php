<?php

abstract class TaskBase
{
    public $taskId;
    public $resultData;
    public $resultTpl;
    public $logFile;
    private $taskParams = array();
    protected $calculateNextRunDate;

    function __construct($taskId = 0, $params = array(), $calculateNextRunDate = false){
        $this->taskId = $taskId;
        $this->calculateNextRunDate = $calculateNextRunDate;
        $this->taskParams = array_merge($params, $this->taskParams);
    }
    abstract public function init();

    abstract public function execute($params = null);

    abstract public function getTaskName();

    abstract public function getTaskDescription();

    protected function saveTaskParams($params = null){
        if($params == null)
            return null;

        $query = "UPDATE tbl_Tasks
                  SET startParams = '".serialize($params)."'
                  WHERE id=".$this->taskId;

        return Context::DB()->query($query);
    }

    public function getTaskParams(){
        return $this->taskParams;
    }

    public function run($params)
    {
        $this->logFile = "tasks/taskId[" . $this->taskId . "]_" . date('d-m-Y_H.i.s');
        $this->init();
        $result = $this->execute($params);

        if($this->calculateNextRunDate){

            $query="SELECT `interval` FROM tbl_Tasks
                    WHERE id = ".$this->taskId;
            Context::DB()->query($query);
            $interval = Context::DB()->result[0]['interval'];

            //ADDDATE(now(), interval `interval` MINUTE)
            $query="UPDATE tbl_Tasks
                    SET nextRunDate = '" .date('Y-m-d H:i:s', strtotime("+" . $interval . " minutes")) . "'
                    WHERE id = ".$this->taskId;
            Context::DB()->query($query);
        }

        return $result;
    }

    public function getBaseClassName()
    {
        return get_parent_class($this);
    }
}