<?php

namespace CCPaymentCom;

use CCPaymentCom\CCPayment;

class UserDepositAPI extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }

    /**
     * 创建或获取用户存款地址
     * 此终结点创建或获取用户的永久存款地址。
     * 商家将收到向该地址进行的每次付款的 Webhook 通知。这种类型的存款是“用户存款”。
     * @param $userId
     * @param $chain
     * @return void
     */
    public function getOrCreateUserDepositAddress($userId, $chain)
    {
        $this->content = [];
        if ($userId) $this->content["userId"] = $userId;
        if ($chain) $this->content["chain"] = $chain;
        return $this->Submit("getOrCreateUserDepositAddress");
    }

    /**
     * Get User Deposit Record 获取用户存款记录
     * @param $recordId string  CCPayment 交易的唯一 ID
     * @return void
     */
    public function getUserDepositRecord($recordId)
    {
        $this->content = [];
        if ($recordId) $this->content["recordId"] = $recordId;
        return $this->Submit("getUserDepositRecord");
    }

    /**
     * 获取用户充值记录列表
     * @param $coinId   integer 硬币ID
     * @param $userId   string  用户 ID 应为 5 - 64 个字符的字符串，且不能以“sys”开头。
     *                          注：商户账户的用户ID为APP ID。请不要将 APP ID 分配给您的用户。
     * @param $chain    string  链条的象征
     * @param $startAt  integer 检索从指定startAt时间戳开始的所有交易记录。
     * @param $endAt    integer 检索指定 endAt 时间戳之前的所有交易记录。
     * @param $nextId   string  下一个ID
     * @return void
     */
    public function getUserDepositRecordList($coinId, $userId, $chain, $startAt, $endAt, $nextId)
    {
        $this->content = [];
        if ($coinId) $this->content["coinId"] = $coinId;
        if ($userId) $this->content["userId"] = $userId;
        if ($chain) $this->content["chain"] = $chain;
        if ($startAt) $this->content["startAt"] = $startAt;
        if ($endAt) $this->content["endAt"] = $endAt;
        if ($nextId) $this->content["nextId"] = $nextId;
        return $this->Submit("getUserDepositRecordList");
    }
}