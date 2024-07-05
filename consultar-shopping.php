<?php


require_once(__DIR__."/lib/robogoogle-1.4.0/vendor/autoload.php");

use Source\Crawlers\adsGoogle;

$termo = $_REQUEST["termo"];
if(strlen($termo) === 0){
    die("{}");
}

$exec = new adsGoogle();
$result = $exec->getAdsGoogle($termo);

if(!is_string($result)){
    $result = json_encode($result);
}

echo $result;
