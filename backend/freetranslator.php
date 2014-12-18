<?php

echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script type="text/javascript" src="webcontent/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="webcontent/js/showDetails.js"></script>
</head>
<body>
HTML;

if(!isset($_POST['fromLanguage'])){
    echo <<<HTML
<form method="POST" action="">
    <select name="fromLanguage">
        <option value="">Auto</option>
        <option value="en">En</option>
        <option value="ru">Ru</option>
        <option value="uk">Uk</option>
    </select>
    <select name="intoLanguage">
        <option value="en">En</option>
        <option value="ru">Ru</option>
        <option value="uk">Uk</option>
    </select>
    <select name="table">
        <option value="All">All</option>
        <option value="be_Group">be_Group</option>
        <option value="be_Fields">be_Fields</option>
        <option value="be_View">be_View</option>
        <option value="be_Navigation">be_Navigation</option>
    </select>
<!--    be_Group <input type="checkbox" name="be_Group" value="be_Group">
    be_Fields <input type="checkbox" name="be_Fields" value="be_Fields">
    be_View <input type="checkbox" name="be_View" value="be_View">
    be_Navigation <input type="checkbox" name="be_Navigation" value="be_Navigation">-->
    <!--
    <select name="table">
        <option value="be_Group">Group</option>
        <option value="be_Fields">Fields</option>
        <option value="be_View">View</option>
        <option value="be_Navigation">Navigation</option>
    </select>-->
    <input type="submit" value="Translate">
</form>
HTML;
}

else{
    require_once("libs/BackendTranslator/BackendContentTranslator.php");
    require_once(FRAMEWORK_PATH."/system/YandexTranslator.php");

    $tables;
    $count = 0;

    if($_POST['fromLanguage'] === ""){
        $languages = $_POST['intoLanguage'];
    }
    else{
        $languages = $_POST['fromLanguage'] . "-" . $_POST['intoLanguage'];
    }

    if($_POST['table'] === 'All'){
        $tables[0] = 'be_Fields';
        $tables[1] = 'be_Group';
        $tables[2] = 'be_View';
        $tables[3] = 'be_Navigation';
    }
    else{
        if($_POST['table'] === 'be_Fields'){
            $tables[0] = 'be_Fields';
            $count++;
        }
        if($_POST['table'] === 'be_Group'){
            $tables[0] = 'be_Group';
            $count++;
        }
        if($_POST['table'] === 'be_View'){
            $tables[0] = 'be_View';
            $count++;
        }
        if($_POST['table'] === 'be_Navigation'){
            $tables[0] = 'be_Navigation';
            $count++;
        }
    }/*
    $tblName = $_POST['table'];*/
    $count = 0;
    $obj = new BackendContentTranslator($tables);
    $trans = new YandexTranslator();

    for($i=0;$i<count($tables);$i++){
        echo "<div style=\"cursor:pointer\" class=\"btnShowDeteils\">" . $tables[$i] . "</div>";
        echo "-----------------------------------------------------------<br>";
        $obj->SelectForTranslate($i);
        $trans->Translate($obj->db_result,$languages);
        $obj->UpdateData($trans->TranslateDataArray,$i);
        /*
        unset($obj->db_result);*/
    }

    $obj->SelectInKeyForTranslate();
    echo "<div style=\"cursor:pointer\" class=\"btnShowDeteils\">Keys</div>";
    echo "-----------------------------------------------------------<br>";
    $trans->Translate($obj->db_result,$languages);
    //$obj->InsertNewKeys($trans->TranslateDataArray);
    /*echo "<pre>";
    var_dump($trans->TranslateDataArray);*/
}

echo <<<HTML
</body>
</html>
HTML;
