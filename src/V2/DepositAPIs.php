<?php

namespace CCPaymentCom\V2;

class DepositAPIs extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }


    /**
     * Get Coin Balance 获取硬币余额
     *
     * @param $coinId       integer Coin ID 币种 ID
     * @param $fiatId       Integer 如果fiatId有价值，则产品的价格将是提供的法定货币。
     *                              CCPayment会将法币价值转换为币量，并根据提供的coinID生成地址，fiatId调用法币列表接口进行检索。
     * @param $price        string  产品价格，可以是法定货币或加密货币.
     *                              如果你通过fiatId，价格将是法定货币。如果fiatId留空，价格将与要支付的硬币相同。
     * @param $chain        String  链条的象征
     * @param $orderId      string  提款单 ID，长度为 3-64 个字符
     * @param $expiredAt    integer 10 位数的时间戳。订单将在此时过期。默认值为 10 天。
     *                              Example:如果订单有效期只有 30 分钟。
     *                              expiredAt = 创建时间戳 + 60*30
     *                              在到期时间之前，汇率将被锁定。加密货币市场非常不稳定。我们建议您在较短时间内锁定汇率，以防止潜在损失。
     *                              过期后，您的账户仍将在 7 天内收到所有支付到存款地址的款项。
     * @param $buyerEmail   string  CCPayment将向所提供的邮件地址发送订单和付款信息。CCPayment 不会将所提供的邮件地址用于其他目的。
     * @param $generateCheckoutURL  boolean true：为此订单创建结账 URL false ：（默认）不创建结账 URL
     * @param $product      string  产品名称将显示在结账页面上。该参数仅在创建了结账 URL 时有效。不能超过 120 个字符。
     * @param $returnUrl    string  付款成功后的下一个 URL。它将显示在结账页面上，仅在创建了结账 URL 时有效。
     * @return mixed
     */
    public function createAppOrderDepositAddress($coinId, $fiatId, $price, $chain, $orderId, $expiredAt, $buyerEmail, $generateCheckoutURL, $product, $returnUrl)
    {
        $this->content = [];
        $this->content["coinId"] = $coinId;
        $this->content["fiatId"] = $fiatId;
        $this->content["price"] = $price;
        $this->content["chain"] = $chain;
        $this->content["orderId"] = $orderId;
        $this->content["expiredAt"] = $expiredAt;
        $this->content["buyerEmail"] = $buyerEmail;
        $this->content["generateCheckoutURL"] = $generateCheckoutURL;
        $this->content["product"] = $product;
        $this->content["returnUrl"] = $returnUrl;

        return $this->Submit("https://ccpayment.com/ccpayment/v2/createAppOrderDepositAddress");
    }


    /**
     * Get Order Information 获取订单信息
     * @param $orderId string   长度为 3 和 64 个字符。订单在系统中的唯一 ID。
     * @return void
     */
    public function getAppOrderInfo($orderId)
    {
        $this->content = [];
        if ($orderId) $this->content["orderId"] = $orderId;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getAppOrderInfo");
    }

    /**
     * Get Permanent Deposit Address 获取永久存款地址
     *
     * 当您使用 referenceId 和 chain 向该端点发出请求时，CCPayment 会首先检查是否存在与给定引用 ID 相关联的永久地址。
     * Address Handling: 地址处理：
     *      现有地址：如果永久地址已与参考编号关联，则 CCPayment 将在回复中返回该地址。
     *      新地址：如果参考 ID 没有链接地址，CCPayment 将在指定的区块链网络上为该参考 ID 生成一个新的存款地址，并返回该新地址。
     * 每个 APP ID 可通过该接口获取 1000 个地址。如果您需要更多地址，请联系客服人员寻求帮助。
     *
     * @param $referenceId  string  长度为 3 至 64 个字符。用户在系统中的唯一参考 ID。
     * @param $chain    string  链条的象征
     *
     * @return void
     */
    public function getOrCreateAppDepositAddress($referenceId, $chain)
    {
        $this->content = [];
        if ($referenceId) $this->content["referenceId"] = $referenceId;
        if ($chain) $this->content["chain"] = $chain;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getOrCreateAppDepositAddress");
    }

    /**
     * Get Deposit Record 获取存款记录
     * 此终结点检索特定记录 ID 的详细信息。这是一个非常关键的端点，用于获取交易详细信息并确认交易状态。
     * 您将需要界面返回的信息来更新交易状态并相应地记入您的用户。
     * @param $recordId string CCPayment 交易的唯一 ID
     * @return mixed
     */
    public function getAppDepositRecord($recordId)
    {
        $this->content = [];
        if ($recordId) $this->content["recordId"] = $recordId;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getAppDepositRecord");
    }

    /**
     * Get Deposit Record List 获取存款记录列表
     * 获取特定时间范围内的存款记录列表。存款记录按创建时间降序排序。
     * @param $coinId integer   币种 ID
     * @param $referenceId  string  长度为 3 个字符和 64 个字符。系统中用户的唯一引用 ID。
     * @param $orderId  string  订单 ID，长度为 3-64 个字符。不要在同一请求中同时传递订单 ID 和参考 ID。
     * @param $chain    string  链条的象征
     * @param $startAt  integer 检索从指定startAt时间戳开始的所有交易记录。
     * @param $endAt    integer 检索指定endAt时间戳内的所有交易记录。
     * @param $nextId   string  Next ID 下一个 ID
     * @return mixed
     */
    public function getAppDepositRecordList($coinId, $referenceId, $orderId, $chain, $startAt, $endAt, $nextId)
    {
        $this->content = [];
        if ($coinId) $this->content["coinId"] = $coinId;
        if ($referenceId) $this->content["referenceId"] = $referenceId;
        if ($orderId) $this->content["orderId"] = $orderId;
        if ($chain) $this->content["chain"] = $chain;
        if ($startAt) $this->content["startAt"] = $startAt;
        if ($endAt) $this->content["endAt"] = $endAt;
        if ($nextId) $this->content["nextId"] = $nextId;

        return $this->Submit("https://ccpayment.com/ccpayment/v2/getAppDepositRecordList");
    }
}