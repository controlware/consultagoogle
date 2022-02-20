<?php

require_once __DIR__ . '/index.php';

use Source\Crawlers\adsGoogle;

$products = 'iphone 12';
$exec = new adsGoogle();
$result = $exec->getAdsGoogle($products);

var_dump($result);
