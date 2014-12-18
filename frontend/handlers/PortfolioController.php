<?php
require_once(FRAMEWORK_PATH."system/WebText.php");
require_once(FRAMEWORK_PATH."custom/portfolioData.php");

class PortfolioController
{
	public function addRate()
	{   
	   	$portfolio = new PortfolioData();

	   	$portfolioId = Request::getInt('portfolioId',"POST");

   		if ($portfolio->addRate($portfolioId))
   			$templateData['success'] = true;
   		else
   			$templateData['success'] = false;
   		
		return json_encode($templateData);
	}
}

$portfolioController = new PortfolioController();

switch ($_REQUEST['action'])
{
	case 'addRate' 			: echo $portfolioController->addRate(); break;
}
?>