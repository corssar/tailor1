<?php
require_once(FRAMEWORK_PATH."system/user/user.php");
require_once(FRAMEWORK_PATH."system/appUrl.php");
class webtopay
{
	//public $purchaseTime = '';
	public $returnStatus;
	public $errorCode = '';

	protected $order;
	protected $userId;

	public function __construct($orderId, $userId)
	{
		$this->order = new Order($orderId);
		$this->userId = $userId;
	}	

	public function buildPaymentForm()
	{
		$user = new user($this->userId);
		# -- Password --
		$signPassword = '14aa26e12fd66950f0e5d6f17885b86f';
		# -- Values --
		$arrFields = array(
		'merchantid' 	=> '129227',
		'OrderID' 		=> $this->order->getOrderId(),
		'Lang' 			=> 'RUS',
		'Amount' 		=> str_replace(".","",$this->order->totalPrice),
		'Currency' 		=> 'USD',
		'AcceptURL' 	=> appUrl::checkUrl(SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().SHOW_RESULT_URL.'&result=success&ordernr='.$this->order->getOrderId()),//'http://iproaction.com/igotofest/content/123.htm',
		'CancelURL' 	=> appUrl::checkUrl(SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().SHOW_RESULT_URL.'&result=error&ordernr='.$this->order->getOrderId()),//'http://iproaction.com/igotofest/content/124.htm',
		'CallbackURL' 	=> SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().CONFIRM_URL,//'http://iproaction.com/igotofest/frontend/pages/order_process_notify.php',
		'Payment' 		=> 'hanza2',
		//'Country' 		=> '',
		'PayText'		=> '',
		'logo' 			=> '',
		'p_firstname' 	=> $user->userName,
		'p_lastname' 	=> $user->userSurname,
		'p_email' 		=> $user->userEmail, //'maxisfighter@gmail.com',
		'p_street' 		=> '',
		'p_city' 		=> '',
		//'p_state' 		=> '',
		'p_zip' 		=> '',
		'p_countrycode' => 'UKRAINE',// $countriesArray['UA'] = 'UKRAINE';
		'test' 			=> '1'
		);
		# -- Do sign --
		unset($data);
		foreach ($arrFields as $num => $value)
		{
			if (trim($value) != '') $data .= sprintf("%03d", strlen($value)) . strtolower($value);
		}
		$sign = md5($data . $signPassword);
		# -- Do sign, END --

		$paymentForm = '<form method=post action="https://www.webtopay.com/pay/">';
		foreach ($arrFields as $num => $value)
		{
			$paymentForm .= '<input type="hidden" name="' . $num . '" value="' . $value . '">
								';
		}
		$paymentForm.= '<input type="hidden" name="sign" value="' . $sign . '">
						<input type="submit" class="submit_payment_form" value="'.WebText::getText('pay','Оплатить').'">
						</form>';
		return $paymentForm;

	}
	/**
	 * Return TRUE if response from PSP are valid
	 * @return bool
	 */
	public static function validateRequest()
	{
		$_SS2 = "";
        $pKeyP = base64_decode("LS0tLS1CRUdJTiBDRVJUSUZJQ0FURS0tLS0tDQpNSUlETHpDQ0FwaWdBd0lCQWdJQkFUQU5CZ2txaGtpRzl3MEJBUVVGQURCdE1Rc3dDUVlEVlFRR0V3Sk1WREVRDQpNQTRHQTFVRUJ4TUhWbWxzYm1sMWN6RWZNQjBHQTFVRUNoTVdSVlpRSUVsdWRHVnlibUYwYVc5dVlXd3NJRlZCDQpRakVQTUEwR0ExVUVBeE1HWlhad0xteDBNUm93R0FZSktvWklodmNOQVFrQkZndHBibVp2UUdWMmNDNXNkREFlDQpGdzB3T0RBM01ESXhNVFExTURWYUZ3MHdPVEEzTURJeE1UUTFNRFZhTUdVeEN6QUpCZ05WQkFZVEFreFVNUjh3DQpIUVlEVlFRS0V4WkZWbEFnU1c1MFpYSnVZWFJwYjI1aGJDd2dWVUZDTVJrd0Z3WURWUVFERXhCM2QzY3VkMlZpDQpkRzl3WVhrdVkyOXRNUm93R0FZSktvWklodmNOQVFrQkZndHBibVp2UUdWMmNDNXNkRENCbnpBTkJna3Foa2lHDQo5dzBCQVFFRkFBT0JqUUF3Z1lrQ2dZRUF4bEh5T3Z0THgxOVZDUCtaa1hkc0dYS3BGZzVnalc4V1d4UFh5MVlJDQpBTkxaZlhOYkpzRWRzbEUxeDBUdkRMVUU4WUxTaXRVaE9OSDRmVDBCdWVDM3ArRUlkZFdSK01VQ0tEcks0UzFDDQp2VWxta3JoMFU3dkg1OWZLbDc1Q09CR1ArUG9wZjBoamEvNnFpZUpWaHBqQ1VGa0ZCRHpwVjNjMzQyQm9aYWd5DQphVHNDQXdFQUFhT0I1akNCNHpBSkJnTlZIUk1FQWpBQU1Dd0dDV0NHU0FHRytFSUJEUVFmRmgxUGNHVnVVMU5NDQpJRWRsYm1WeVlYUmxaQ0JEWlhKMGFXWnBZMkYwWlRBZEJnTlZIUTRFRmdRVXlUWnBWY3JiVEllVjI2SkpoMkhZDQoxZlp4WUVBd2dZZ0dBMVVkSXdTQmdEQitvWEdrYnpCdE1Rc3dDUVlEVlFRR0V3Sk1WREVRTUE0R0ExVUVCeE1IDQpWbWxzYm1sMWN6RWZNQjBHQTFVRUNoTVdSVlpRSUVsdWRHVnlibUYwYVc5dVlXd3NJRlZCUWpFUE1BMEdBMVVFDQpBeE1HWlhad0xteDBNUm93R0FZSktvWklodmNOQVFrQkZndHBibVp2UUdWMmNDNXNkSUlKQU1nODM2c2cwWVltDQpNQTBHQ1NxR1NJYjNEUUVCQlFVQUE0R0JBRGY1MVlzOWVrQVlNdFZnS3NFMlFaWjhueDZUWnRTejFNN1ZYQ282DQp2U2hLWkI0TlRIM1AyRDNVaG42Y0hLZXMwVGJTWlZWQ2hsRE1ON2MwVjAzQUpXdzJrQlhram5iQTRLeDJxeUlJDQo4R1dlVW1CdmdHYVR4cmZnZXh2TXExN0NEVmVrbUE5ekJoK09FMVZ3THdrVUZmNStSMTRDQ1g4anhFdmRYcU1WDQpLL0dqDQotLS0tLUVORCBDRVJUSUZJQ0FURS0tLS0t");
        $pKey = openssl_pkey_get_public($pKeyP);
        if(!$pKey) return false;
        foreach($_GET As $key => $value)
        {
        	if($key!='_ss2') $_SS2 .= "{$value}|";
        }
        $ok = openssl_verify($_SS2, base64_decode($_GET['_ss2']), $pKey);
        return ($ok === 1);
	}
	/**
	 * Return TRUE if payment finished with success
	 * @return bool
	 */
	public function parseRequest()
	{		
		$this->returnStatus = $_GET['status'];
		if($this->returnStatus==1)
		{
			return true;		
		}
		else 
		{
			$this->errorCode = $_GET['error'];
			return false;
		}
	}
}

/*	upc
public function getOrderSignature()
	{
		//  подготовить данные
		$this->purchaseTime = date("ymdHis");
		$data = MERCHANT_ID.";".TERMINAL_ID.";".$this->purchaseTime.";".$this->order->getOrderId().";".CURRENCY.";".str_replace(".","",$this->totalPrice).";".session_id().";";

		// прочитать RSA ключ торговца
		$fp = fopen($_SERVER['DOCUMENT_ROOT']."/../crt/1752591.pem", "r");
		$priv_key = fread($fp, 8192);
		fclose($fp);
		$pkeyid = openssl_get_privatekey($priv_key);
		//  получить подпись
		openssl_sign( $data , $signature, $pkeyid);
		// free the key from memory
		openssl_free_key($pkeyid);
		// закодировать значение в BASE64 , так как $signature имеет бинарный формат
		$b64sign = base64_encode($signature);
		return $b64sign;
	}
---------------------------------------------------------------------------

$paymentForm = '<FORM  ACTION="https://secure.upc.ua/ecgtest/enter" METHOD="POST">
<INPUT TYPE="HIDDEN" NAME="Version" VALUE="1">
<INPUT TYPE="HIDDEN" NAME="MerchantID" VALUE="'.MERCHANT_ID.'">
<INPUT TYPE="HIDDEN" NAME="TerminalID" VALUE="'.TERMINAL_ID.'">
<INPUT TYPE="HIDDEN" NAME="TotalAmount" VALUE="'.str_replace(".","",$this->totalPrice).'">
<INPUT TYPE="HIDDEN" NAME="Currency" VALUE="'.CURRENCY.'">
<INPUT TYPE="HIDDEN" NAME="locale" VALUE="ru">
<INPUT TYPE="HIDDEN" NAME="SD" VALUE="'.session_id().'">
<INPUT TYPE="HIDDEN" NAME="OrderID" VALUE="'.$this->getOrderId().'">
<INPUT TYPE="HIDDEN" NAME="PurchaseTime" VALUE="'.$this->purchaseTime.'">
<INPUT TYPE="HIDDEN" NAME="PurchaseDesc" VALUE="Test desription of order">
<INPUT TYPE="HIDDEN" NAME="Signature" VALUE="'.$this->getOrderSignature().'">
<input type="submit" class="submit_payment_form" value="'.WebText::getText('pay','Оплатить').'">
</FORM>';
*/
/*------------------------------------------------------------------------*/
?>