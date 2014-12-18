<?
require_once(FRAMEWORK_PATH.'system/tpl_engine/ViewInterface.php');
require_once(FRAMEWORK_PATH."system/WebText.php");


class SmartyView extends  ViewInterface {
	
	private $smarty = null;
	
    private $templateFileName = null;
    
    
    
    private $viewData = null;
	
	function __construct() {
		//parent::__construct($templateFileName, $data, $childPageHTML);

		// Load library Smarty

        
        require_once(SMARTY_DIR . 'Smarty.class.php');

        $this->smarty = new Smarty();
        
        //$frontendpath = (defined("FRONTEND_PATH")) ? FRONTEND_PATH: DEFAULT_FRONTEND_PATH;
        $frontendpath = FRONTEND_PATH;

        $this->smarty->template_dir = $frontendpath."webcontent/templates/";
        $this->smarty->compile_dir = $frontendpath.'var/smarty_templates_c/';
        $this->smarty->config_dir = $frontendpath.'var/smarty_configs/';
        $this->smarty->cache_dir = $frontendpath.'var/smarty_cache/';

	}
	
	function transfromData($data) {
		//echo var_dump($data);
		return $data;
	} 
	
	function fetch($template, $data) 
	{
		//add values for webtexts from template		
		$webText = new WebText($template);
		if($webText->isKeyFound)
		{
		    //var_dump($webText->webTexts);
		    foreach ($webText->webTexts as $dataValue) 
		    {
		         //echo 'webtext_'.$dataValue['key'].'   '. $dataValue['value'].'-<br>';
			     $this->smarty->assign('webtext_'.$dataValue['key'], $dataValue['value']);
		    }
		}		
		
		$this->viewData = $this->transfromData($data);

		foreach ($this->viewData as $dataKey => $dataValue) {
			$this->smarty->assign($dataKey, $dataValue);
		}

		return $this->smarty->fetch($template);
	}	
}
?>