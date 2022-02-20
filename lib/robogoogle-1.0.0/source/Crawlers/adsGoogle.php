<?php

namespace Source\Crawlers;

use Source\Services\GuzzleClient;
use Source\Helpers\StringHelper;

class adsGoogle
{
    private $guzzle;

    public function __construct()
    {
        $this->guzzle = new GuzzleClient();
    }

    public function getAdsGoogle($products)
    {
        $products = str_replace(" ", "+", $products);
        $result = $this->guzzle->request('GET', 'https://www.google.com/search?q=' . $products . '&oq=' . $products . '&sclient=gws-wiz');
        $text = $result->getBody()->getContents();
        $textS = StringHelper::doRegex($text, '/zPEcBd VZqTOd[\w\W]+?">([\w\W]+?)</i')[1];
        $textP = StringHelper::doRegex ($text, '/e10twf T4OwTb">([\w\W]+?)</i')[1];
        if (!$textP){
            $textP = StringHelper::doRegex($text, '/class="pla-unit-container[\w\W]+?<img[\w\W]+?id="platop[\w\W]+?alt="[\w\W]+?R\$([\w\W]+?)</i')[1];
        }

        $textProduct = StringHelper::doRegex($text, '/class="pla-unit-container[\w\W]+?<img[\w\W]+?id="platop[\w\W]+?alt="([\w\W]+?)"/i')[1];

        $stores = [];

        if ($textP) {
            for ($i = 0; $i < 10; $i++) {
                if ($textP[$i]) {
                    $stores[] = [
                        'produto' => trim(str_replace("Imagem de", " ", $textProduct[$i])),
                        'loja' => trim(str_replace(".com", " ", $textS[$i])),
                        'preco' => trim(str_replace("R$", " ", $textP[$i]))
                    ];
                }
            }
        }

        return $stores;

    }


}