<?php

require_once(__DIR__."/lib/robogoogle-1.0.0/index.php");

use Source\Crawlers\adsGoogle;

$termo = $_REQUEST["termo"];
if(strlen($termo) === 0){
    die("{}");
}

$exec = new adsGoogle();
$result = $exec->getAdsGoogle($termo);

echo json_encode($result);
