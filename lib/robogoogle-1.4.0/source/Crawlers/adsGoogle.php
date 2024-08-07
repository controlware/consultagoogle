<?php

namespace Source\Crawlers;

use Source\Helpers\StringHelper;
use Source\Services\GuzzleClient;

class adsGoogle
{
    private $guzzle;
    private $user;
    private $password;
    private $proxy;

    public function __construct()
    {

        //$this->user = $user;
        //$this->password = $password;
        //$this->proxy = $proxy;
        $this->guzzle = new GuzzleClient();
        // https://www.globo.com/
        // https://www.google.com/search?q=Sat+Gertec&oq=Sat+Gertec&sclient=gws-wiz/
        //$proxyauth = $this->user . ':' . $this->password;
    }

    public function getAdsGoogle($products)
    {
        $products = str_replace(" ", "+", $products);
        $result = $this->guzzle->request('GET', 'https://www.google.com/search?q='.$products.'&oq='.$products.'&sclient=gws-wiz/'

        );
        $text = $result->getBody()->getContents();
        $textS = StringHelper::doRegex($text, '/zPEcBd VZqTOd[\w\W]+?">([\w\W]+?)</i')[1];
        $textP = StringHelper::doRegex ($text, '/e10twf T4OwTb">([\w\W]+?)</i')[1];
        if (!$textP){
            $textP = StringHelper::doRegex($text, '/class="pla-unit-container[\w\W]+?<img[\w\W]+?id="platop[\w\W]+?alt="[\w\W]+?R\$([\w\W]+?)</i')[1];
        }

        $textProduct = StringHelper::doRegex($text, '/class="pla-unit-container[\w\W]+?<img[\w\W]+?id="platop[\w\W]+?alt="([\w\W]+?)"/i')[1];
        $textLinks = StringHelper::doRegex($text, '/<a data-impdclcc="1" href="([\w\W]+?)" data-agdh="arwt"/i')[1];


        $stores = [];

        if ($textP) {
            for ($i = 0; $i < 10; $i++) {
                if ($textP[$i]) {
                    $stores[] = [
                        'produto' => str_replace("Imagem de", " ", $textProduct[$i]),
                        'loja' => str_replace(".com", " ", $textS[$i]),
                        'preco' => trim(str_replace("R$", " ", $textP[$i])),
                        'link' => $textLinks[$i]
                    ];
                }
            }
        }

        return $stores;
    }

    public function getAdvertsText($products)
    {
        $products = str_replace(" ", "+", $products);
        $result = $this->guzzle->request('GET', 'https://www.google.com/search?q='.$products.'&oq='.$products.'&sclient=gws-wiz/');
        $text = $result->getBody()->getContents();
        $textS = StringHelper::doRegex($text, '/class="uEierd"[\w\W]+?>([\w\W]+?class="aii")/i')[1];
        $textS = StringHelper::removeHtmlCharsArrayValues ($textS);

        $adverts = [];

        for ($i = 0; $i < 10; $i++) {
            if(isset($textS[$i])) {
                $adverts[] = [
                    'anúncio' => $textS[$i],
                ];
            }
        }

        return  $adverts;
    }



}