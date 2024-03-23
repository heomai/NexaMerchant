<?php
namespace Nicelizhi\Shopify\Helpers;
use GuzzleHttp\Client;

final class Utils {

    // send msg to wcom
    public static function send($text,$msgtype="text") {
        $url = config("shopify.wcom_noticle_url");
        //var_dump($url);
        if(empty($url)) return false;

        echo $url."\r\n";

        $argc = [];
        $argc['msgtype'] = $msgtype;
        $argc['text'] = [
            'content' => $text
        ];

         $header = [];
         $header[] = "Content-Type:application/json";

         var_dump($argc);

        $client = new Client();
        $response = $client->post($url,[
            \GuzzleHttp\RequestOptions::JSON => $argc
        ]);
        //var_dump($response, $argc);     
    }

}