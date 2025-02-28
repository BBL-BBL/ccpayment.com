<?php

namespace CCPaymentCom\V2;

class CommonAPI extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }

    /**
     * Get Coin List 获取代币列表
     * @return mixed
     */
    public function getCoinList()
    {
        $this->content = [];
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getCoinList");
    }

    /**
     * Get Coin Information 获取代币信息
     * @param $coinId integer 硬币ID
     * @return mixed
     */
    public function getCoin($coinId)
    {
        $this->content = [];
        if ($coinId) $this->content["coinId"] = $coinId;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getCoin");
    }

    /**
     * Get Coin Price 获取代币价格
     * @param $coinIds array 硬币ID
     * @return mixed
     */
    public function getCoinUSDTPrice($coinIds)
    {
        $this->content = [];
        if ($coinIds) $this->content["coinIds"] = $coinIds;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getCoinUSDTPrice");
    }

    /**
     * Get C wallet User Information 获取 C wallet 用户信息
     * @param $CWalletUserId string C wallet 用户 ID
     * @return mixed
     */
    public function getCWalletUserId($CWalletUserId)
    {
        $this->content = [];
        if ($CWalletUserId) $this->content["cwalletUserId"] = $CWalletUserId;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getCwalletUserId");
    }

    /**
     * Get WithdrawalApi Network Fee 获取提款网络费用
     *
     * @param $coinId integer 币种 ID
     * @param $chain string 链条的象征
     * @return mixed
     */
    public function getWithdrawFee($coinId, $chain)
    {
        $this->content = [];
        if ($coinId) $this->content["coinId"] = $coinId;
        if ($chain) $this->content["chain"] = $chain;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getWithdrawFee");
    }

    /**
     * Get Fiat List 获取法币清单
     *
     * @return mixed
     */
    public function getFiatList()
    {
        $this->content = [];
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getFiatList");
    }

    /**
     * Get Swap Coin List 获取交换硬币列表
     *
     * @return mixed
     */
    public function getSwapCoinList()
    {
        $this->content = [];
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getSwapCoinList");
    }

    /**
     * Get Chain List 获取链列表
     *
     * @param $chains array 链符号。例如，'chains'： ['BSC']
     * @return mixed
     */
    public function getChainList($chains)
    {
        $this->content = [];
        if ($chains) $this->content["chains"] = $chains;
        return $this->Submit("https://ccpayment.com/ccpayment/v2/getChainList");
    }

}