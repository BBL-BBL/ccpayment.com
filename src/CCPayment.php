<?php

namespace CCPaymentCom;

class CCPayment
{
    protected $app_id = "*** your app_id ***";
    protected $app_secret = "*** your app_secret ***";
    protected $url = "https://ccpayment.com/ccpayment/v2/";
    protected $content = [];

    public function __construct($app_id, $app_secret)
    {
        $this->app_id = $app_id;
        $this->app_secret = $app_secret;
    }

    public function Submit($url)
    {
        $timestamp = time();
        $body = json_encode($this->content);
        $sign_text = $this->app_id . $timestamp;
        if (strlen($body) != 2) {
            $sign_text = $sign_text . $body;
        } else {
            $body = "";
        }

        $server_sign = hash_hmac('sha256', $sign_text, $this->app_secret);

        $data = array(
            "headers" => array(
                "Content-Type: application/json;charset=utf-8",
                "Appid: " . $this->app_id,
                "Sign: " . $server_sign,
                "Timestamp: " . $timestamp
            ),
            "body" => $body
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url . $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data['body']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $data['headers']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}