<?php
/*
 * @package     Intelipost_Basic
 * @copyright   Copyright (c) 2020 Intelipost
 */

namespace Intelipost\Basic\Client;
use Psr\Log\LoggerInterface;

class Intelipost
{
    const POST = 'POST';
    const GET = 'GET';

    protected $scopeConfig;
    protected $logger;
    protected $apiUrl;
    protected $apiKey;
    protected $httpMethod;
    protected $apiMethod;
    protected $headers;
    protected $encPostData;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        LoggerInterface $logger
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
    }

    /**
     * @param $httpMethod
     * @param $apiMethod
     * @param bool|string $encPostData
     * @return bool|string
     */
    public function apiRequest($httpMethod, $apiMethod, $encPostData = false)
    {
        $response = false;

        $this->apiUrl = $this->scopeConfig->getValue('intelipost_basic/settings/api_url');
        $this->apiKey = $this->scopeConfig->getValue('intelipost_basic/settings/api_key');
        $this->httpMethod = $httpMethod;
        $this->apiMethod = $apiMethod;
        $this->headers = ['Content-Type: application/json', "api_key: {$this->apiKey}", "platform: Magento2"];
        $this->encPostData = $encPostData;

        $curl = curl_init();
        if (!$curl) {
            $this->logger->error("Erro ao tentar iniciar o cURL");
            return $response;
        }

        if (!$this->encPostData) {
            $this->logger->debug("Informações enviadas para a API: " . $encPostData);
        }
        $this->buildCurlOptions($curl);

        $response = curl_exec($curl);

        curl_close($curl);

        if (!$response) {
            $this->logger->error("Erro ao consultar a API da Intelipost");
            return $response;
        }

        $this->logger->debug("Informações recebidas da API: " . $response);

        $this->handleResponse($response);

        return $response;
    }

    protected function buildCurlOptions($curl)
    {
        curl_setopt($curl, CURLOPT_TIMEOUT, 3);
        curl_setopt($curl, CURLOPT_URL, $this->apiUrl . $this->apiMethod);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        if ($this->httpMethod === self::POST && $this->encPostData) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($this->encPostData));
        }
    }

    protected function handleResponse($response)
    {
        var_dump($response);
    }
}
