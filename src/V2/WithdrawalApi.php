<?php

namespace CCPaymentCom\V2;

class WithdrawalApi extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }

    /**
     * Create Network WithdrawalApi Order 创建网络提现订单
     *
     * @param $coinId   integer Coin ID 币种 ID
     * @param $chain    string  Symbol of the chain  链条的象征
     * @param $address  string WithdrawalApi destination address 提款目的地地址
     * @param $memo string  提款地址备忘录
     * @param $orderId  string  提款单 ID，长度为 3-64 个字符
     * @param $amount string    提款金额
     * @param $merchantPayNetworkFee    boolean True：商户支付网络费 应收净额 = 取款金额
     *                                          False：（默认）用户支付网络费 应收净额 = 取款金额 - 网络费
     * @return void
     */
    public function applyAppWithdrawToNetwork($coinId, $chain, $address, $memo, $orderId, $amount, $merchantPayNetworkFee)
    {
        $this->content = [];
        if ($coinId) $this->content["coinId"] = $coinId;
        if ($chain) $this->content["chain"] = $chain;
        if ($address) $this->content["address"] = $address;
        if ($memo) $this->content["memo"] = $memo;
        if ($orderId) $this->content["orderId"] = $orderId;
        if ($amount) $this->content["amount"] = $amount;
        if ($merchantPayNetworkFee) $this->content["merchantPayNetworkFee"] = $merchantPayNetworkFee;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/applyAppWithdrawToNetwork");
    }

    /**
     * WithdrawalApi to Cwallet Account 提现至Cwallet账户
     * 此端点创建到 Cwallet 账户的提款订单
     *
     * @param $coinId integer 币种 ID
     * @param $cwalletUser  string  Cwallet 用户、Cwallet ID 和电子邮件都可以。
     * @param $amount   string  提款金额。最低限额为 0.001 美元。
     * @param $orderId  string  订单编号，长度为 3-64 个字符
     * @return mixed
     */
    public function applyAppWithdrawToCwallet($coinId, $cwalletUser, $amount, $orderId)
    {
        $this->content = [];
        if ($coinId) $this->content["coinId"] = $coinId;
        if ($cwalletUser) $this->content["cwalletUser"] = $cwalletUser;
        if ($amount) $this->content["amount"] = $amount;
        if ($orderId) $this->content["orderId"] = $orderId;

        return $this->Submit("https://ccpayment.com/ccpayment/v2/applyAppWithdrawToCwallet");
    }

    /**
     * Get WithdrawalApi Record  获取提款记录
     *
     * @param $recordId string  CCPayment 交易的唯一 ID
     * @param $orderId  string  订单编号，长度为 3-64 个字符
     * @return mixed
     */
    public function getAppWithdrawRecord($recordId, $orderId)
    {
        $this->content = [];
        if ($recordId) $this->content["recordId"] = $recordId;
        if ($orderId) $this->content["orderId"] = $orderId;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getAppWithdrawRecord");
    }

    /**
     * Get WithdrawalApi Record List 获取提款记录列表
     *
     * @param $coinId   integer Coin ID 币种 ID
     * @param $orderIds array   提款的订单 ID。长度为3-64。一个查询的最大限制为 20 个订单 ID。
     * @param $chain    string  链条的象征
     * @param $startAt  integer 检索从指定startAt时间戳开始的所有交易记录。
     * @param $endAt    integer 检索指定endAt时间戳内的所有交易记录。
     * @param $nextId   string  Next ID 下一个 ID
     * @return mixed
     */
    public function getAppWithdrawRecordList($coinId, $orderIds, $chain, $startAt, $endAt, $nextId)
    {
        $this->content = [];
        if ($coinId) $this->content["coinId"] = $coinId;
        if ($orderIds) $this->content["orderIds"] = $orderIds;
        if ($chain) $this->content["chain"] = $chain;
        if ($startAt) $this->content["startAt"] = $startAt;
        if ($endAt) $this->content["endAt"] = $endAt;
        if ($nextId) $this->content["nextId"] = $nextId;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getAppWithdrawRecordList");
    }

}