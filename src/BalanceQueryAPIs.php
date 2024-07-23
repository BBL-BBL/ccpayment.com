<?php

namespace src;

use src\CCPayment;

class BalanceQueryAPIs extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }


    /**
     * Balance Query APIs 余额查询 API
     *
     * @return mixed
     */
    public function getAppCoinAssetList()
    {
        return $this->Submit("getAppCoinAssetList");
    }

    /**
     * Get Coin Balance 获取硬币余额
     *
     * @param $coinId integer Coin ID 币种 ID
     * @return mixed
     */
    public function getAppCoinAsset($coinId)
    {
        $this->content = [];
        $this->content["coinId"] = $coinId;
        return $this->Submit("getAppCoinAsset");
    }

}