<?php
require_once("../config.php");
require_once(FRAMEWORK_PATH."system/Context.php");
class BackendContentTranslator {
    public
        $db_result,
        $table_info;

    function __construct($tbl_Name){
        for($i=0;$i<count($tbl_Name);$i++){
            if($tbl_Name[$i] === "be_Group"){
                $this->table_info[$i]['updataId'] = "groupName";
                $this->table_info[$i]['updataField'] = "groupName";
                $this->table_info[$i]['tableName'] = $tbl_Name[$i];
                $this->table_info[$i]['fields'] = "groupName As id, groupName As title";
            }
            elseif($tbl_Name[$i] === "be_Fields"){
                $this->table_info[$i]['updataId'] = "fieldId";
                $this->table_info[$i]['updataField'] = "displayName";
                $this->table_info[$i]['tableName'] = $tbl_Name[$i];
                $this->table_info[$i]['fields'] = "fieldId As id, displayName As title";
            }
            elseif($tbl_Name[$i] === "be_Navigation"){
                $this->table_info[$i]['updataId'] = "id";
                $this->table_info[$i]['updataField'] = "title";
                $this->table_info[$i]['tableName'] = $tbl_Name[$i];
                $this->table_info[$i]['fields'] = "id, title";
            }
            else{
                $this->table_info[$i]['updataId'] = "viewId";
                $this->table_info[$i]['updataField'] = "name";
                $this->table_info[$i]['tableName'] = $tbl_Name[$i];
                $this->table_info[$i]['fields'] = "viewId As id, name As title";
            }
        }
    }

    function  SelectForTranslate($j){
        $fields = $this->table_info[$j]['fields'];
        $tableName = $this->table_info[$j]['tableName'];
        $query = "select ".$fields." from ".$tableName."";
        Context::DB()->close();
        Context::DB()->__connect();
        if (Context::DB()->query($query))
        {
            $this->db_result = array();
            Context::DB()->result;
            foreach(Context::DB()->result as $key => $value){
                $this->db_result[$key] = $value;
            }
        }/*
        echo "Data from Tables<br><pre>";
        var_dump($this->db_result);*/
    }
    function  SelectInKeyForTranslate(){
        $query = "SELECT ukr.key as id, ukr.value as title FROM be_AdminLanguage ukr
	LEFT JOIN be_AdminLanguage eng ON ukr.key = eng.key and eng.langId=3
WHERE eng.id is NULL and ukr.langId=1";/*
        unset($this->db_result);*/
        $this->db_result = array();
        if (Context::DB()->query($query))
        {
            Context::DB()->result;
            foreach(Context::DB()->result as $key => $value){
                $this->db_result[$key] = $value;
            }
        }/*
        echo "Data from Keys<br><pre>";
        var_dump($this->db_result);*/
    }
    function UpdateData($trans_result,$j){
        $updataId = $this->table_info[$j]['updataId'];
        $updataField = $this->table_info[$j]['updataField'];
        $tableName = $this->table_info[$j]['tableName'];
        Context::DB()->close();
        Context::DB()->__connect();
        for($i=0;$i<count($trans_result);$i++){
            $query = "UPDATE ".$tableName." SET ".$updataField." = '".$trans_result[$i]['transTitle']."' WHERE ".$updataId." = '".$trans_result[$i]['id']."'";
            if (Context::DB()->query($query))
            {
                Context::DB()->result;
            }
        }
    }
    function InsertNewKeys($trans_result){
        Context::DB()->close();
        Context::DB()->__connect();
        for($i=0;$i<count($trans_result);$i++){
            $query = "INSERT INTO be_AdminLanguage (`langId`,`key`,`value`) VALUES ('3','".$trans_result[$i]['id']."','".$trans_result[$i]['transTitle']."')";
            if (Context::DB()->query($query))
            {
                Context::DB()->result;
            }
        }
    }
}