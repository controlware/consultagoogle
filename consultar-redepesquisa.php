<?php

require_once(__DIR__."/lib/robogoogle-1.3.0/index.php");

use Source\Crawlers\adsGoogle;

$termo = $_REQUEST["termo"];
if(strlen($termo) === 0){
    die("{}");
}

$exec = new adsGoogle();
$result = $exec->getAdvertsText($termo);

if(!is_string($result)){
    $result = json_encode($result);
}

echo $result;
