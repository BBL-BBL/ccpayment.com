<?php

namespace CCPaymentCom\V2;

class Signature extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }

    function verifySignature($signature, $content, $timestamp)
    {
        if (is_array($content)) {
            $content = json_encode($content, JSON_UNESCAPED_SLASHES);
        }

        $signText = $this->app_id . $timestamp . $content;
        $serverSign = hash_hmac('sha256', $signText, $this->app_secret);
        return $signature === $serverSign;
    }

    function generate($timestamp)
    {
        $body = json_encode($this->content);
        $sign_text = $this->app_id . $timestamp;
        if (strlen($body) != 2) {
            $sign_text = $sign_text . $body;
        }
        return hash_hmac('sha256', $sign_text, $this->app_secret);
    }
}