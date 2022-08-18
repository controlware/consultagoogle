<?php

namespace Source\Services;

use GuzzleHttp\Client;

class GuzzleClient
{
    private $client;

    public function __construct()
    {
        try {
            $this->client = new Client([
                'connect_timeout' => 0,
                'timeout' => 0,
                'follow_location' => true,
                'binary_transfer' => true,
                'http_errors' => false,
                'verify' => false,
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0',
                ]
            ]);

        } catch (Exception $e) {
            echo('Erro de Conexão - ' . $e);die();
        }
    }

    public function request($method, $url, array $params = [])
    {
        return $this->client->request($method, $url, $params);
    }
}