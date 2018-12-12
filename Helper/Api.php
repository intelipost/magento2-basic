<?php
/*
 * @package     Intelipost_Basic
 * @copyright   Copyright (c) 2016 Gamuza Technologies (http://www.gamuza.com.br/)
 * @author      Eneias Ramos de Melo <eneias@gamuza.com.br>
 */

namespace Intelipost\Basic\Helper;

class Api extends \Magento\Framework\App\Helper\AbstractHelper
{

const POST = 'POST';
const GET  = 'GET';

protected $_scopeConfig;

public function __construct
(
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
)
{
    $this->_scopeConfig = $scopeConfig;
}

public function apiRequest ($httpMethod, $apiMethod, $encPostData = false)
{
    try {
    $apiUrl = $this->_scopeConfig->getValue ('intelipost_basic/settings/api_url');
    $apiKey = $this->_scopeConfig->getValue ('intelipost_basic/settings/api_key');

    $curl = curl_init ();

    curl_setopt($curl, CURLOPT_TIMEOUT, 3);
    curl_setopt($curl, CURLOPT_URL, $apiUrl . $apiMethod);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        "api_key: {$apiKey}",
    ));
    curl_setopt($curl, CURLOPT_ENCODING , "");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    if ($httpMethod === self::POST && $encPostData)
    {
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $encPostData);
    }

    $response = curl_exec ($curl);

    curl_close ($curl);
    
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    file_put_contents('intelipostrequest', $code, FILE_APPEND);
    file_put_contents('intelipostrequest', print_r($response, true), FILE_APPEND);
    
    } catch(\Magento\Framework\Validator\Exception $e)
    {
        file_put_contents('intelipostrequest', $e->getMessage(), FILE_APPEND);
    }
    
    
    return $response;
}

}

