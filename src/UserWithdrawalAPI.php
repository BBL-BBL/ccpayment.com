<?php

namespace CCPaymentCom;

use CCPaymentCom\CCPayment;

class UserWithdrawalAPI extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }

    /**
     * 提现到区块链地址
     *
     * @param $userId   string  用户 ID 应为 5 - 64 个字符的字符串，不能以“sys”开头。
     * @param $coinId   string  币种 ID
     * @param $chain    string  链条的象征
     * @param $address  string  提款目的地地址
     * @param $memo     string  地址备忘录
     * @param $orderId  string  提款单 ID，长度为 3-64 个字符
     * @param $amount   string  提款金额
     * @return mixed
     */
    public function applyUserWithdrawToNetwork($userId, $coinId, $chain, $address, $memo, $orderId, $amount)
    {
        $this->content = [];
        if ($userId) $this->content["userId"] = $userId;
        if ($coinId) $this->content["coinId"] = $coinId;
        if ($chain) $this->content["chain"] = $chain;
        if ($address) $this->content["address"] = $address;
        if ($memo) $this->content["memo"] = $memo;
        if ($orderId) $this->content["orderId"] = $orderId;
        if ($amount) $this->content["amount"] = $amount;
        return $this->Submit("applyUserWithdrawToNetwork");
    }

    /**
     * WithdrawalApi to Cwallet Account 提现至Cwallet账户
     * @param $userId       string  用户 ID 应为 5 - 64 个字符的字符串，且不能以“sys”开头。
     * @param $coinId       string  硬币ID
     * @param $cwalletUser  string  Cwallet用户、Cwallet ID、Email都可以。
     * @param $amount       string  提款金额。最低限额为 0.001 美元。
     * @param $orderId      string  订单ID，长度3-64个字符
     * @return mixed
     */
    public function applyUserWithdrawToCwallet($userId, $coinId, $cwalletUser, $amount, $orderId)
    {
        $this->content = [];
        if ($userId) $this->content["userId"] = $userId;
        if ($coinId) $this->content["coinId"] = $coinId;
        if ($cwalletUser) $this->content["cwalletUser"] = $cwalletUser;
        if ($amount) $this->content["amount"] = $amount;
        if ($orderId) $this->content["orderId"] = $orderId;
        return $this->Submit("applyUserWithdrawToCwallet");
    }

    /**
     * Get User WithdrawalApi Record  获取用户提现记录
     * @param $recordId string  CCPayment 交易的唯一 ID
     * @param $orderId  string  提现订单ID，长度3-64个字符
     * @return mixed
     */
    public function getUserWithdrawRecord($recordId, $orderId)
    {
        $this->content = [];
        if ($recordId) $this->content["recordId"] = $recordId;
        if ($orderId) $this->content["orderId"] = $orderId;
        return $this->Submit("getUserWithdrawRecord");
    }

    /**
     * 获取用户退出记录列表
     * @param $coinId       integer 硬币ID
     * @param $toAddress    string  目的地地址
     * @param $userId       string  用户 ID 应为 5 - 64 个字符的字符串，且不能以“sys”开头。
     * @param $chain        string  链条的象征
     * @param $startAt      integer 读取从指定的 startAt 时间戳开始的所有事务记录。
     * @param $endAt        integer 读取截至指定 endAt 时间戳的所有交易记录。
     * @param $nextId       string  下一个 ID
     * @return mixed
     */
    public function getUserWithdrawRecordList($coinId, $toAddress, $userId, $chain, $startAt, $endAt, $nextId)
    {
        $this->content = [];
        if ($coinId) $this->content["coinId"] = $coinId;
        if ($toAddress) $this->content["toAddress"] = $toAddress;
        if ($userId) $this->content["userId"] = $userId;
        if ($chain) $this->content["chain"] = $chain;
        if ($startAt) $this->content["startAt"] = $startAt;
        if ($endAt) $this->content["endAt"] = $endAt;
        if ($nextId) $this->content["nextId"] = $nextId;
        return $this->Submit("getUserWithdrawRecordList");
    }
}