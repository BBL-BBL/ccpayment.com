<?php

namespace src;

use src\CCPayment;

class UserInternalTransactionAPI extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }

    /**
     * Create an Internal Transaction 创建内部交易
     * @param $fromUserId   string  从用户 ID 来看，它应该是一个 5 - 64 个字符的字符串，并且不能以“sys”开头。
     * @param $toUserId     string  对于用户ID，它应该是5-64个字符的字符串，并且不能以“sys”开头。
     * @param $coinId       integer 硬币ID
     * @param $amount       string  提款金额。最低限额为 0.001 美元。
     * @param $orderId      string  提现订单ID，长度3-64个字符
     * @param $remark       string  交易备注，255个字符以内
     * @return mixed
     */
    public function userTransfer($fromUserId, $toUserId, $coinId, $amount, $orderId, $remark)
    {
        $this->content = [];
        if ($fromUserId) $this->content["fromUserId"] = $fromUserId;
        if ($toUserId) $this->content["toUserId"] = $toUserId;
        if ($coinId) $this->content["coinId"] = $coinId;
        if ($amount) $this->content["amount"] = $amount;
        if ($orderId) $this->content["orderId"] = $orderId;
        if ($remark) $this->content["remark"] = $remark;
        return $this->Submit("userTransfer");
    }

    /**
     * 获取用户内部事务记录
     * @param $recordId string  CCPayment 交易的唯一 ID
     * @param $orderId  string  提款订单 ID，长度为 3-64 个字符
     * @return mixed
     */
    public function getUserTransferRecord($recordId, $orderId)
    {
        $this->content = [];
        if ($recordId) $this->content["recordId"] = $recordId;
        if ($orderId) $this->content["orderId"] = $orderId;
        return $this->Submit("getUserTransferRecord");
    }

    /**
     * 获取用户内部事务记录列表
     * @param $coinId       integer 币种 ID
     * @param $fromUserId   string  从用户 ID 开始，它应该是一个 5 - 64 个字符的字符串，不能以“sys”开头。
     * @param $toUserId     string  对于用户 ID，它应该是一个 5 - 64 个字符的字符串，不能以“sys”开头。
     * @param $startAt      integer 检索从指定startAt时间戳开始的所有交易记录。
     * @param $endAt        integer 检索指定endAt时间戳内的所有交易记录。
     * @param $nextId       string  下一个 ID
     * @return mixed
     */
    public function getUserTransferRecordList($coinId, $fromUserId, $toUserId, $startAt, $endAt, $nextId)
    {
        $this->content = [];
        if ($coinId) $this->content["coinId"] = $coinId;
        if ($fromUserId) $this->content["fromUserId"] = $fromUserId;
        if ($toUserId) $this->content["toUserId"] = $toUserId;
        if ($startAt) $this->content["startAt"] = $startAt;
        if ($endAt) $this->content["endAt"] = $endAt;
        if ($nextId) $this->content["nextId"] = $nextId;
        return $this->Submit("getUserTransferRecordList");
    }


}