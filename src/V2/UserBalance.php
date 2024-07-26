<?php

namespace CCPaymentCom\V2;

class UserBalance extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }


    /**
     * Get User Balance List 获取用户余额列表
     * @param $userId   string      用户 ID 应为 5 - 64 个字符的字符串，不能以 "sys "开头。
     *                              注意：商户账户的用户 ID 是 APP ID。请不要为您的用户分配 APP ID。
     * @return void
     */
    public function getUserCoinAssetList($userId)
    {
        $this->content = [];
        if ($userId) $this->content["userId"] = $userId;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getUserCoinAssetList");
    }

    /**
     * 获取用户的硬币余额
     * @param $userId string    用户 ID 应为 5 - 64 个字符的字符串，不能以“sys”开头。
     *                          注意：商家账号的用户ID为APP ID。请不要将APP ID分配给您的用户。
     * @param $coinId string    币种 ID
     * @return void
     */
    public function getUserCoinAsset($userId, $coinId)
    {
        $this->content = [];
        if ($userId) $this->content["userId"] = $userId;
        if ($coinId) $this->content["coinId"] = $coinId;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getUserCoinAsset");
    }

}