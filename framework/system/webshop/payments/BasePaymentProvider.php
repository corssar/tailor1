<?php

abstract class BasePaymentProvider{
    protected $httpCode;
    protected $httpInfo;

    abstract function getForm($data, $paymentMethod);
    abstract function processRequest();


    /**
     * Send http post
     * @param $url
     * @param null $postfields
     * @return mixed
     * @throws CMSException
     */
    protected function post($url, $postfields = NULL) {
        if (!function_exists('curl_init'))
        {
            throw new CMSException('Curl module is missing');
        }
        $this->http_info = array();
        $ci = curl_init();
        curl_setopt($ci, CURLOPT_USERAGENT, '');
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ci, CURLOPT_TIMEOUT, 30);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ci, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ci, CURLOPT_HEADER, FALSE);
        curl_setopt($ci, CURLOPT_POST, TRUE);
        if (!empty($postfields))
        {
            curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
        }

        curl_setopt($ci, CURLOPT_URL, $url);
        $response = curl_exec($ci);
        $this->httpCode = curl_getinfo($ci, CURLINFO_HTTP_CODE);
        $this->httpInfo = array_merge($this->http_info, curl_getinfo($ci));
        curl_close ($ci);
        return $response;
    }
}