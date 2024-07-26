<?php

namespace CCPaymentCom\V1;

class PaymentAPI extends CCPayment
{
    public function __construct($app_id, $app_secret)
    {
        parent::__construct($app_id, $app_secret);
    }


    /**
     * Hosted Checkout Page Integration
     * 托管结帐页面集成
     * Receive payment via the checkout page provided by CCPayment
     * 通过CCPayment提供的结账页面进行支付
     * Without development, just call the interface to obtain the checkout page. You can display this page to your users. CCPayment will send the receiving notification to you after the user completes the payment order.
     * 托管结账页集成通过 CCPayment 提供的结账页接收付款，无需开发，只需调用接口获取结账页。您可以向用户显示此页面。用户完成付款订单后，CCPayment 将向您发送收款通知。
     *
     * @param String $product_price 订单应支付的金额（默认为美元，小数点后不超过两位）
     * @param String $merchant_order_id 商家系统中的订单号
     * @param String $product_name 产品名称
     * @param String $return_url 在用户付款后重定向用户到此URL
     * @param String $notify_url 当订单状态发生变化时，URL 地址将通过 POST 请求进行通知。确保 URL 可访问以接收来自支付平台的通知。
     * @param String $custom_value 商家自定义字段 - 该自定义值字段将在交易状态通知中返回。
     * @param Integer $order_valid_period 订单的有效期。时间段为秒（10位数）。
     *                                      商家传递的参数应该小于商家系统中订单的有效期。
     *                                      因为链上交易可能需要一些时间来进行。
     *                                      比特币将在24小时内到达，其他代币通常会在30分钟内到达。
     *                                      订单将默认为24小时有效。
     *                                      最长有效期为10天（Satoshi的最长有效期为2小时）。
     * @return void
     */
    public function HostedCheckoutPageIntegration(string $product_price, string $merchant_order_id, string $product_name, string $return_url = "", string $notify_url = "", string $custom_value = "", int $order_valid_period = 0)
    {
        $this->content = [
            "product_price" => $product_price,
            "merchant_order_id" => $merchant_order_id,
            "product_name" => $product_name,
        ];
        if ($return_url) $this->content["return_url"] = $return_url;
        if ($notify_url) $this->content["notify_url"] = $notify_url;
        if ($custom_value) $this->content["custom_value"] = $custom_value;
        if ($order_valid_period) $this->content["order_valid_period"] = $order_valid_period;

        return $this->Submit("https://admin.ccpayment.com/ccpayment/v1/concise/url/get");
    }

    /**
     * Submit payment order and receive payment address
     * 提交付款订单并接收付款地址
     *
     * @param String $merchant_order_id 商户系统中的订单ID。每个订单的唯一ID。
     * @param String $product_price 订单的应付金额（默认为美元，小数点后不超过两位）
     * @param String $token_id 告诉 CCPayment 的服务器应该使用哪种币种和网络进行交易。您可以通过调用接口或在此表格上找到 token_id。
     * calling the interface: https://doc.ccpayment.com/payment-doc-v1/ccpayment-v1.0-api/resources-document/token-id-interface
     * on this sheet:   https://bit.ly/CCsupportedcoins
     * @param String $denominated_currency 订单的货币。如果您希望以加密货币显示价格，请传递"token"。如果您希望以法定货币显示价格，请传递相应的货币代码。
     * currency code:   https://doc.ccpayment.com/ccpayment-for-developer/resources-document/list-of-denominated-currency-for-api-payment
     * @param Integer $order_valid_period 订单的有效期。时间段为秒（10 位数字）。
     *                                      商户传递的参数应该小于商户系统中订单的有效期限。
     *                                      因为链上交易可能需要一些时间来进行。
     *                                      比特币将在 24 小时内到达，其他代币通常在 30 分钟内到达。
     *                                      订单默认有效期为 24 小时。
     *                                      最长有效期为 10 天（Satoshi 的最长有效期为 2 小时）。
     * @param String $custom_value 商家自定义字段-此自定义值字段将在交易状态通知中返回。
     * @param String $notify_url 在订单状态更改时，URL地址将通过POST请求通知。确保URL可访问以接收来自支付平台的通知。
     * @param String $remark 备注
     * @return mixed
     */
    public function NativeCheckoutIntegration(string $merchant_order_id, string $product_price, string $token_id, string $denominated_currency, int $order_valid_period, string $custom_value, string $notify_url = "", string $remark = "")
    {
        $this->content = [
            "merchant_order_id" => $merchant_order_id,
            "product_price" => $product_price,
            "token_id" => $token_id,
            "denominated_currency" => $denominated_currency,
        ];

        if ($order_valid_period) $this->content["order_valid_period"] = $order_valid_period;
        if ($custom_value) $this->content["custom_value"] = $custom_value;
        if ($notify_url) $this->content["notify_url"] = $notify_url;
        if ($remark) $this->content["remark"] = $remark;

        return $this->Submit("https://admin.ccpayment.com/ccpayment/v1/bill/create");
    }

    /**
     * API Deposit Order Information Interface
     * API存款订单信息接口
     * When the transaction is completed, the system will push the transaction result to the Webhook URL. You can also call this interface to obtain the order information.
     * 交易完成后，系统将结果推送到Webhook URL。您还可以调用此接口来获取订单信息。
     *
     * @param array $merchant_order_ids 商家订单ID，最大限制100。仅传递一种类型的订单ID，即存款OR提款。请勿在一个请求中同时传递存款和取款订单ID
     * @return mixed
     */
    public function ReturnOrderInformation(array $merchant_order_ids)
    {
        $this->content = ["merchant_order_ids" => $merchant_order_ids];

        return $this->Submit("https://admin.ccpayment.com/ccpayment/v1/bill/info");
    }
}