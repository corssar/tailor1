<?php

class YandexTranslator {

    public
        $data,
        $text,
        $lang,
        $strResponse,
        $objResponse,
        $TransCurl,
        $TransSentens,
        $TranslateDataArray;
    const translateLink = 'https://translate.yandex.net/api/v1.5/tr.json/translate?';
    const key = "trnsl.1.1.20130821T142526Z.7cd56ea423de8f3a.063feaca90db1fc613b8f7abe33f4b16c525043e";

    function __construct(){
        $this->text = "";
        $this->lang = "";
        $this->strResponse = "";
        $this->objResponse = "";
        $this->TransCurl = "";
        $this->TransSentens = "";
        $this->data = array(
            'key' => "",
            'text' => "",
            'lang' => "",
        );
    }
    function SetData($TranslateText,$lang){
    $this->text = $TranslateText;
    $this->lang = $lang;
    $this->strResponse = "";
    $this->objResponse = "";
    $this->TransCurl = "";
    $this->TransSentens = "";
    $this->data = array(
        'key' => self::key,
        'text' => $this->text,
        'lang' => $this->lang,
    );
}
    function Translate($dataToTranslate,$lang){
        $this->TranslateDataArray = array();
        echo "<div style='display: none' class=\"info\"><table style='border:1px solid #c0c0c0'><tr><td style='border-bottom: 1px solid #c0c0c0'><b>Was<b></td><td style='border-bottom: 1px solid #c0c0c0'><b>Became<b></td></tr>";
        for($i=0;$i<count($dataToTranslate);$i++){
            $this->SetData($dataToTranslate[$i]['title'],$lang);
            $this->TranslateBuildQuery();/*
            echo "<pre>";
            var_dump($this->data);*/
            $this->CurlInitTranslate();
            $this->CurlQuery();
            $this->DecodeResponce();
            $this->ProcessingDate();
            $this->WriteTranslate($i, $dataToTranslate[$i]['id']);
        }
        echo "</table></div><br>";
    }/*
    function TranslateKey($dataToTranslate,$lang){
        echo "<div style='display: none' class=\"info\"><table style='border:1px solid #c0c0c0'><tr><td style='border-bottom: 1px solid #c0c0c0'><b>Was<b></td><td style='border-bottom: 1px solid #c0c0c0'></td><td style='border-bottom: 1px solid #c0c0c0'><b>Became<b></td></tr>";
        for($i=0;$i<count($dataToTranslate);$i++){
            $this->SetData($dataToTranslate[$i]['title'],$lang);
            $this->TranslateBuildQuery();
            $this->CurlInitTranslate();
            $this->CurlQuery();
            $this->DecodeResponce();
            $this->ProcessingDate();
            $this->WriteTranslate($i, $dataToTranslate[$i]['id']);
        }
        echo "</table></div><br>";
    }*/
    function TranslateBuildQuery(){
        $this->data = http_build_query($this->data, '', '&');
    }
    function CurlInitTranslate(){
        $this->TransCurl = curl_init();
        curl_setopt($this->TransCurl, CURLOPT_URL, self::translateLink);
        curl_setopt($this->TransCurl, CURLOPT_POST, TRUE);
        curl_setopt($this->TransCurl, CURLOPT_POSTFIELDS, $this->data);
        curl_setopt($this->TransCurl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->TransCurl, CURLOPT_SSL_VERIFYPEER, false);
    }
    function CurlQuery(){
        $this->strResponse = curl_exec($this->TransCurl);
        curl_close($this->TransCurl);
    }
    function DecodeResponce(){
        $this->objResponse = json_decode($this->strResponse);
    }
    function ProcessingDate(){
        $this->TransSentens = $this->objResponse->text[0];
    }
    function WriteTranslate($j, $id){
        $this->TranslateDataArray[$j]['id'] = $id;
        $this->TranslateDataArray[$j]['title'] = $this->text;
        $this->TranslateDataArray[$j]['transTitle'] = $this->TransSentens;
        $this->WriteToBrowserTranslate($j);
    }
    function WriteToBrowserTranslate($j){
        echo "<tr><td>" . $this->TranslateDataArray[$j]['title'] . "</td><td>" . $this->TranslateDataArray[$j]['transTitle'] . "</td></tr>";
    }
}