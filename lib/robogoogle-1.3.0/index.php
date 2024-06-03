<?php

require_once __DIR__ . '/vendor/autoload.php';
use Source\Helpers\StringHelper;
use Source\Crawlers\adsGoogle;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;

/*
//Sat Gertec, Balança Toledo prix 4uno, Sat Sweda, Leitor codigo de barras Zebra, epson tmt20x
$products = 'sat dimep';
$exec = new adsGoogle();
//$result = $exec->getAdsGoogle($products);
$result = $exec->getAdvertsText($products);
var_dump($result);die();
*/