<?php

namespace CCPaymentCom;

use CCPaymentCom\CCPayment;

class Webhook extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }

    /**
     * 调用API重新发送Webhook
     * 通过该接口重新发送指定时间段内交易的webhook。
     * @param $startTimestamp   integer 重新发送在此开始时间之后创建的所有事务的 Webhook。它应该是一个 10 位数字的时间戳
     * @param $endTimestamp integer 重新发送在此开始时间之前创建的所有事务的 Webhooks。它应该是一个10位时间戳
     *                              如果end_timestamp为空，则为开始时间后一小时内创建的所有事务重新发送webhook。
     *                              注意： 和 start_timestamp 为 1 小时。
     * @param $webhookResult string Failed ：（默认）仅在指定时间范围内重新发送失败的 Webhook。
     *                              AllResult：在指定时间范围内重新发送所有 Webhook。
     * @param $transactionType  string  Webhook 将重新发送哪种类型的事务
     *                                  AllType ： （默认） 重新发送所有类型
     *                                  ApiDeposit ： 重新发送 API 充值交易
     *                                  DirectDeposit ： 重新发送永久地址存款交易
     *                                  ApiWithdrwal ： 重新发送 API 提现交易
     *                                  UserDeposit ： 重新发送用户存款交易
     *                                  UserWithdrawalAPI ： 重新发送用户存款交易
     * @return mixed
     */
    public function resend($startTimestamp, $endTimestamp, $webhookResult, $transactionType)
    {
        $this->content = [];
        if ($startTimestamp) $this->content["startTimestamp"] = $startTimestamp;
        if ($endTimestamp) $this->content["endTimestamp"] = $endTimestamp;
        if ($webhookResult) $this->content["webhookResult"] = $webhookResult;
        if ($transactionType) $this->content["transactionType"] = $transactionType;
        return $this->Submit("webhook/resend");
    }

    /**
     * Webhook for API Deposit 用于 API 存款的 Webhook
     * After receiving a webhook, the merchant's server should call the Get Order Information API to confirm the order and payment information.
     * 商户服务器收到Webhook后，应调用获取订单信息API来确认订单和支付信息。
     *
     * @param $recordId     string  CCPayment 交易的唯一 ID
     * @param $orderId      string  您的订单的唯一 ID。如果一笔订单有多次支付，则一个订单ID可能有多个记录ID。
     * @param $coinId       integer Coin ID 硬币ID
     * @param $coinSymbol   string  Coin symbol 硬币符号
     * @param $status       string  Success：交易已确认；Processing：区块链正在处理交易；
     *
     * @return void
     */
    public function deposit($recordId, $orderId, $coinId, $coinSymbol, $status)
    {

    }
}