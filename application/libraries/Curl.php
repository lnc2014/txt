<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/15 0015
 * Time: 下午 3:19
 */


class Curl{

    public function curl_post($url, $data) {
        $header = [
            //'Content-Type: application/json; charset=utf-8',
            'IBkey: X6bBjJROX5Rs34DG'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER,FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60*2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);

        $document = curl_exec ( $ch );
        //$info = curl_getinfo ( $ch );
        curl_close ( $ch );
        return $document;
    }
}