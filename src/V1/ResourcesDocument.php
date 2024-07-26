<?php

namespace CCPaymentCom\V1;

class ResourcesDocument extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }

    /**
     * Token ID Interface
     * Call this interface to get the Token ID for your supported tokens. Token ID is the parameter that you should pass to CCPayment's server when you create payment and withdrawal orders with CCPayment.
     * CCPayment provides merchants with 100+ tokens on various blockchains.
     * To simplify the management of token assets with the same symbol for both merchants and their customers, CCPayment consolidates balances of tokens with identical symbols.
     * For instance, when users receive USDT on the ETH chain, they can withdraw USDT from any supported chain.
     * You can view the complete list of supported tokens through the form below.  https://bit.ly/CCsupportedcoins
     *
     * 令牌ID接口调用此接口获取您支持的令牌的令牌ID。
     * 令牌ID是您在使用CCPayment创建付款和提现订单时应传递给CCPayment服务器的参数。
     * CCPayment为商户提供100多种代币，涵盖各种区块链。为了简化商户及其客户的相同符号的代币资产管理，CCPayment合并具有相同符号的代币余额。
     * 例如，当用户在ETH链上收到USDT时，他们可以从任何受支持的链提取USDT。您可以通过以下表单查看受支持代币的完整列表。https://bit.ly/CCsupportedcoins
     *
     * @return void
     */
    public function GetTokenID()
    {
        return $this->Submit("https://admin.ccpayment.com/ccpayment/v1/coin/all");
    }

    /**
     * Current Token Rate Interface
     * Amount in USD = Amount in the target token * Current Token Rate. Take BTC for an example: 10000 USD = 0.059 BTC*16944.3 USD (the current rate of BTC)
     *
     * 当前令牌汇率接口
     * 美元金额=目标令牌*当前令牌汇率。以 BTC 为例： 10000 美元 = 0.059 BTC*16944.3 美元（BTC 的当前汇率）
     *
     * @param string $amount 美元金额
     * @param string $token_id 用于调用接口获取目标令牌ID，可以通过调用接口或在表格中查找来获取令牌ID。
     * https://doc.ccpayment.com/payment-doc-v1/ccpayment-v1.0-api/resources-document/token-id-interface
     * https://bit.ly/CCsupportedcoins
     * @return void
     */
    public function CurrentTokenRateInterface($amount, $token_id)
    {
        $this->content = [
            "amount" => $amount,
            "token_id" => $token_id,
        ];
        return $this->Submit("https://admin.ccpayment.com/ccpayment/v1/token/rate");
    }

    /**
     * Asset Balance Interface
     * 资产余额界面
     * @param string $coin_id 获取目标币的币ID。通过调用接口或在表上检查获取币ID。如果请求体中不包含任何参数，则获取所有资产的余额。
     * @return void
     */
    public function AssetBalanceInterface(string $coin_id = "")
    {
        $this->content = [];
        if ($coin_id) $this->content["coin_id"] = $coin_id;
        return $this->Submit("https://admin.ccpayment.com/ccpayment/v1/assets");
    }

    /**
     * Network Fee Interface | Return network fee of target token
     * 网络费接口 | CCPayment网络费接口返回目标令牌的网络费
     *
     * @param string $token_id 获取目标令牌的标记ID。通过调用接口或在表上检查来获取令牌ID
     * https://doc.ccpayment.com/payment-doc-v1/ccpayment-v1.0-api/resources-document/token-id-interface
     * https://bit.ly/CCsupportedcoins
     * @param string $address 如果传递了此参数，CCPayment 将告诉地址是内部地址还是外部地址。内部地址的网络费为0。
     * @return mixed
     */
    public function NetworkFeeInterface(string $token_id, string $address)
    {
        $this->content = ["token_id" => $token_id];
        if ($address) $this->content["address"] = $address;
        return $this->Submit("https://admin.ccpayment.com/ccpayment/v1/network/fee");
    }

    /**
     * Block Height Information Retrieval API
     * 区块高度信息检索API
     * Merchants use this API to receive the block height to confirm the transaction and the current block height from different networks.
     * 商户使用此API从不同网络接收区块高度来确认交易以及当前区块高度。
     * @return void
     */
    public function GetBlockHeightInformation()
    {
        $this->content = [];
        return $this->Submit("https://admin.ccpayment.com/ccpayment/v1/get/network/height/info");
    }

    /**
     * Check the Validity of Cwallet ID
     * 检查Cwallet ID的有效性
     * Check if the Cwallet User ID is correct and return the nickname
     * 检查Cwallet用户ID是否正确并返回昵称
     * @param string $c_id Cwallet ID
     *
     * List of Supported Coins
     * Click the following link to check the information of 60+ coins CCPayment supports:
     * https://bit.ly/CCsupportedcoins、
     *
     * @return void
     */
    public function CheckTheValidityOfCwalletID(string $c_id)
    {
        $this->content = ["c_id" => $c_id];
        return $this->Submit("https://admin.ccpayment.com/ccpayment/v1/check/user");
    }
}