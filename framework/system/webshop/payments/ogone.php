<?php
require_once(FRAMEWORK_PATH."system/webshop/payments/BasePaymentProvider.php");
/**
 * Class for working with the payment service Pay2pay.com
 */
class ogone extends BasePaymentProvider{
    private $currency;
    private $providerUrl = 'https://secure.ogone.com/ncol/test/orderstandard.asp';
    private $merchantId;
    private $secretKey;
    private $hiddenKey;
    private $apiKey;
    private $successUrl;
    private $failUrl;
    private $resultUrl;
    private $providerId;

    public function __construct($config)
    {
        $this->providerId = $config['id'];
        $this->merchantId = $config['merchantId'];
        $this->secretKey = $config['secretKey'];
        $this->hiddenKey = $config['hiddenKey'];
        $this->apiKey = $config['apiKey'];
        $this->successUrl = $config['successUrl'];
        $this->failUrl = $config['failUrl'];
        $this->resultUrl = $config['resultUrl'];
        $this->currency = $config['currency'];
    }

    /**
     * Generate code for all active payment methods
     * @param $orderId
     * @param $paymentMethod
     * @return string
     */
    public function getForm($orderId, $paymentMethod)
    {

        $user = CMSUser::getInstance();
        $order = new Order($orderId, $user->userId);

        $amount = $order->properties['totalPrice'] * 100;
        $language = 'en_us';

        $sha1 = "AMOUNT=$amount
                 CANCELURL=$this->failUrl
                 CURRENCY={$this->currency}
                 LANGUAGE=$language
                 ORDERID=$orderId
                 PSPID={$this->merchantId}";

        $sha1 = sha1($sha1);


        $form = '<form name="directpayment1" id="directpayment" action="' . $this->providerUrl . '" method="post" >
                <input name="PSPID" type="hidden" value="'. $this->merchantId .'" />
                <input name="AMOUNT" type="hidden" value="'.$amount.'" />
                <input name="ACCEPTURL" type="hidden" value="'.$this->resultUrl.'?orderId='.$orderId.'" />
                <input name="CANCELURL" type="hidden" value="'.$this->failUrl.'?orderId='.$orderId.'" />
                <input name="ORDERID" type="hidden" value="'.$orderId.'" />
                <input name="CURRENCY" type="hidden" value="'.$this->currency.'" />
                <input name="LANGUAGE" type="hidden" value="'.$language.'" />
                <input name="SHASIGN" type="hidden" value="'.$sha1.'" />
                <input name="PM" type="hidden" value="'.$paymentMethod.'" />
                </form>';

        return $form;
    }

    public function getSign($xml)
    {
        return md5($this->secretKey.$xml.$this->secretKey);
    }

    /**
     * Get, verify and process request with result of payment from provider
     */
    public function processRequest()
    {
//        if (isset($_REQUEST['xml']) and isset($_REQUEST['sign']))
//        {
//            $xml = base64_decode(str_replace(' ', '+', $_REQUEST['xml']));
//            $sign = str_replace(' ', '+', $_REQUEST['sign']);
//
//            $validSign = base64_encode(md5($this->hiddenKey.$xml.$this->hiddenKey));
//
//            $request = simplexml_load_string($xml);
//
//            // data for log
//            $params['xml'] = $xml;
//            $params['sign'] = $sign;
//            $params['secretKey'] = $this->secretKey;
//            $params['currency'] = $this->currency;
//            $logdata['userId'] = CMSUser::getInstance()->userId;
//            $logdata['chargeId'] = $request->order_id;
//
//
//            // Check sign for verify xml data
//            if($sign != $validSign){
//                $this->sendResponse('no', 'Error verify sign');
//                $logdata['message'] = 'Pay2pay: processRequest, Error verify sign';
//                $logdata['params'] = serialize($params);
//                Context::Log('cmssql','fe_PaymentLog')->log($logdata);
//                return false;
//            }
//
//
//            // find order by $request->order_id
//            $charge = Charge::getByChargeId($request->order_id);
//            if ( $charge === false ){
//                $this->sendResponse('no', 'Unknown order_id');
//
//                $logdata['message'] = 'Pay2pay: processRequest, Unknown order_id (fe_Charges.chargeId)';
//                $logdata['params'] = serialize($params);
//                Context::Log('cmssql','fe_PaymentLog')->log($logdata);
//                return false;
//            }
//
//            // 2 - success, 3 - fail
//            if($charge['chargeStatusId'] == 2 or $charge['chargeStatusId'] == 3){
//                $this->sendResponse('no', 'This order has already been paid or canceled');
//
//                $logdata['message'] = 'Pay2pay: processRequest, This order has already been paid or canceled';
//                $logdata['params'] = serialize($params);
//                Context::Log('cmssql','fe_PaymentLog')->log($logdata);
//                return false;
//            }
//
//            if ($this->currency != $request->currency){
//                $this->sendResponse('no', 'Currency check failed');
//
//                $logdata['message'] = 'Pay2pay: processRequest, Currency check failed';
//                $logdata['params'] = serialize($params);
//                Context::Log('cmssql','fe_PaymentLog')->log($logdata);
//                return false;
//            }
//
//            if ($request->amount < $charge['price']){
//                $this->sendResponse('no', 'Amount check failed');
//
//                $logdata['message'] = 'Pay2pay: processRequest, Amount check failed';
//                $logdata['params'] = serialize($params);
//                Context::Log('cmssql','fe_PaymentLog')->log($logdata);
//                return false;
//            }
//
//            if ($request->status == 'success'){
//                // change order status to success
//                Charge::changeStatus($request->order_id, 2);
//                // add coins to user balance
//                $charge = Charge::getByChargeId($request->order_id);
//                Charge::changeUserBalance($charge['userId'], $charge['coins']);
//                CMSUser::getInstance()->reloadUserData();
//                // answer payment provider that their response is processed success
//                $this->sendResponse('yes');
//                return true;
//            }
//            if ($request->status == 'fail'){
//                // change order status to fail
//                Charge::changeStatus($request->order_id, 3);
//                // answer payment provider that their response is processed success
//                $this->sendResponse('yes');
//                return true;
//            }
//
//            $this->sendResponse('no','Undefined status: '.$request->status);
//
//            $logdata['message'] = 'Pay2pay: processRequest, Undefined status: '.$request->status;
//            $logdata['params'] = serialize($params);
//            Context::Log('cmssql','fe_PaymentLog')->log($logdata);
//            return false;
//        }

    }
}