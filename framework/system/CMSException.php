<?php
class CMSException extends Exception
{
	// Redefine the exception so message isn't optional
   public function __construct($message, $code = 0) 
   {
       // make sure everything is assigned properly
		parent::__construct($message, $code);
       //Code for logging
		include_once(SITE_PATH.'vendors/Pear/Log.php');
		$logger = &Log::singleton('cmssql', 'be_Log');
		$logData = array("message"=>$message,
						"fileName"=>$this->getFile(), 
						"lineNum"=>$this->getLine(),
						"traceStr"=>addslashes($this->getTraceAsString()));
		$logger->log($logData);
		//$this->getTrace(); ["file"]=>  string(55) "/home/virtwww/w_maxand-net_a518e8c9/http/umniy/test.php" ["line"]=>  int(17) ["function"]=>  string(7) "inverse" 
   }
   
   public function terminateApplication()
   {	   	
		if(!FRIENDLY_ERROR)
		{
			echo $this->getMessage().'<br/>';
			echo $this->getTraceAsString();
		}
		else {
			//redirect to the error page
		   	include_once(FRAMEWORK_PATH."system/appUrl.php");
			header('Location: '.SITE_PROTOCOL.ERRORPAGE_URL);
		}
		//close db connection
	   	Context::DB()->close();
	   	exit;
   }
}

class PageNotFoundException extends CMSException
{
   public function __construct($message, $code = 0) 
   {
       // make sure everything is assigned properly
		parent::__construct($message, $code);
   }
}
?>