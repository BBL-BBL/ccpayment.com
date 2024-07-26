<?php

namespace CCPaymentCom\V1;

use CCPaymentCom\V1\CCPayment;

class WithdrawalAPIIntegration extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }

    /**
     * Create a withdrawal order
     * Users can get instant payouts to their Cwallet account with 0 fees from your sites/apps. They can also withdraw to any other wallet with no minimum withdrawal amount limit.
     * @param string $merchant_order_id 商家系统中的订单ID。每个订单的唯一ID。
     * @param string $address 钱包地址
     *                          情况1：如果用户想要提取到他的Cwallet帐户，传递Cwallet ID或与Cwallet帐户关联的电子邮件地址
     *                          情况2：如果用户想要提取到他的Web3钱包，传递接收地址。
     *                          备注：SATS将发票作为接收地址。每个发票只能接受一笔支付。
     * @param string $token_id 告诉 CCPayment 的服务器应该使用哪种币种和网络进行交易。
     *                          您可以通过调用接口或在此表中找到 token_id。
     *                          如果提款是到 Cwallet，那么任何币种的 token_id 都可以。
     *                          如果提款是到外部地址，只有相应的 token_id 可以使用。
     * @param string $value 取款金额
     * @param Integer $memo 如果接收地址需要备忘录，请传递备忘录参数。如果需要备忘录但未填写，或填写不正确，则资产可能会丢失
     * @param bool $merchant_pays_fee True：网络费用从商家那里收取。未指定时为False：网络费用从用户那里收取。收到的金额=提款金额-网络费用。
     * @return void
     */
    public function CreateWithdrawalOrder(string $merchant_order_id, string $address, string $token_id, string $value, int $memo = 0, bool $merchant_pays_fee = false)
    {
        $this->content = [
            "merchant_order_id" => $merchant_order_id,
            "address" => $address,
            "token_id" => $token_id,
            "value" => $value,
        ];
        if ($memo) $this->content["memo"] = $memo;
        if ($merchant_pays_fee) $this->content["merchant_pays_fee"] = $merchant_pays_fee;

        return $this->Submit("https://admin.ccpayment.com/ccpayment/v1/withdraw");
    }

    /**
     * Withdrawal Order Information Interface
     * 提款订单信息接口
     * When the transaction is completed, the system will push the transaction result to the Webhook URL. You can also call this interface to obtain the order information.
     * 交易完成后，系统将把交易结果推送至Webhook URL。您也可以调用此接口获取订单信息。
     *
     * @param array $merchant_order_ids 商户订单ID，最大限制100。仅传递一种类型的提现订单ID。不要在一个请求中同时传送存款和提现订单ID
     * @return void
     */
    public function WithdrawalOrderInformation(array $merchant_order_ids)
    {
        $this->content["merchant_order_ids"] = $merchant_order_ids;
        return $this->Submit("https://admin.ccpayment.com/ccpayment/v1/bill/info");
    }
}