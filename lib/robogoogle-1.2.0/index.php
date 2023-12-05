<?php

require_once __DIR__ . '/vendor/autoload.php';

/*
use Source\Helpers\StringHelper;
use Source\Crawlers\adsGoogle;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;


//Sat Gertec, Balança Toledo prix 4uno, Sat Sweda, Leitor codigo de barras Zebra, epson tmt20x
$products = 'Sat Gertec';
$exec = new adsGoogle();
$result = $exec->getAdsGoogle($products);
//$result = $exec->getAdvertsText($products);
var_dump($result);die();
*/




//METODO 2 COM CURL
/*
$url = 'https://www.google.com/search?q=Sat+Gertec&oq=Sat+Gertec&sclient=gws-wiz/';
$proxy = 'http://user-sp26387852:automatizando@gate.smartproxy.com:7000';
$proxyauth = 'user-sp26387852:automatizando';

$ch = curl_init($url);
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
ob_start();
curl_exec($ch);
curl_close($ch);
$site = ob_get_contents();
ob_end_clean();
$text = StringHelper::doRegex($site, '/zPEcBd VZqTOd[\w\W]+?">([\w\W]+?)</i');

echo $site;
*/





//METODO 3
/*
function add_proxy_callback($proxy_callback)
{
    return function (callable $handler) use ($proxy_callback) {
        return function (RequestInterface $request, $options) use ($handler, $proxy_callback) {
            $ip = $proxy_callback();
            $options['proxy'] = $ip;
            return $handler($request, $options);
        };
    };
}

$stack = new HandlerStack();
$stack->setHandler(new CurlHandler());
$stack->push(add_proxy_callback(function ()
{
    return 'http://user-sp26387852:automatizando@gate.smartproxy.com:7000';
}));
$client = new Client(['handler' => $stack]);
$response = $client->request('GET', 'https://www.globo.com/');
var_dump((string)$response->getBody());
*/







