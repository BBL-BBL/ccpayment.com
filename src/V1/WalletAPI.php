<?php

namespace CCPaymentCom\V1;

class WalletAPI extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }

    /**
     * Get permanent deposit address for users
     * 获取用户的永久存款地址
     * Users can deposit any amount flexibly at any time.
     * 用户可以随时灵活存款任意金额。
     * Each App ID of the merchant can obtain 1000 addresses via the interface. If you want more addresses available, please contact customer service for depth help.
     * 每个商户的应用程序ID可以通过接口获取1000个地址。如果您需要更多可用地址，请联系客服深入帮助。
     *
     * @param string $user_id 用户ID，唯一标识3-64个字符
     * @param string $chain 区块链网络，唯一标识
     * 点击此处查看链列表: https://docs.google.com/spreadsheets/d/1YKY-pxCdqer1IurgEkyNqW0xIj7EmtfX3rILoJqkKgw/edit#gid=0
     * @param string $notify_url 当订单状态发生变化时，通过 POST 请求将通知 URL 地址通知。确保 URL 是可访问的，以接收来自支付平台的通知。
     * @return void
     */
    public function GetWalletAddresses(string $user_id, string $chain, string $notify_url = "")
    {
        $this->content["user_id"] = $user_id;
        $this->content["chain"] = $chain;
        if ($notify_url) $this->content["notify_url"] = $notify_url;

        return $this->Submit("https://admin.ccpayment.com/ccpayment/v1/payment/address/get");
    }
}