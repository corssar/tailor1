<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."system/appUrl.php");
require_once(FRAMEWORK_PATH."system/Validation.php");
require_once(FRAMEWORK_PATH."system/ReservedRequestData.php");
class Contact extends Page
{
    private $defaultValidationArray = 'contactFormData';
    private $isMailSent = true;
    private $formDataError = false;
    private $pageStateFinished = false;
    private $tmpData 	=	array();
    protected $template	=	'Pages/contact.tpl';

    protected function init()
    {
        $cache = new CacheFace();
        if($this->pageData = $cache->get('contactpage_'.$this->getPageId()))
        {
            $this->tmpData	=	unserialize($this->pageData);
        }
        else
        {
            $this->pageData = new PageData($this->getPageId());
            if(!$this->pageData->load())
                throw new Exception("Data for contact page was not loaded");

            $this->tmpData	= $this->pageData->getProperties();
            $cache->save(serialize($this->tmpData));
        }
        $dataForValidation = $this->receiveValidatedFields($this->tmpData['text7']);

        if(!Request::getInt("postdata","POST"))
            return;

        $postedFields = $this->getPostedFields();
        $this->templateData['form'] = $postedFields;

        //validation section
        $validationErrors = array();

        if(!Validation::validate($dataForValidation,$validationErrors))
        {
            $this->formDataError = true;
            for($i=0; $i<count($validationErrors);$i++)
            {
                $this->tmpData['validationErrors'][$i]['value'] = $validationErrors[$i]['value'];
                $this->tmpData['validationErrors'][$i]['field'] = $validationErrors[$i]['field'];
            }
            return;
        }

        //finalize page
        $this->pageStateFinished = true;
        $this->saveContactFormToDataBase($this->tmpData['title'], Context::SiteSettings()->getDefaultSiteEmail(), $postedFields['email'], $postedFields['name'], $postedFields['contactMessage'], $this->tmpData['langId']);

            if(!EventManager::Execute(new UserFeedbackEvent(),
                array(
                    "{USER_EMAIL}" => $postedFields['email'],
                    "{USER_NAME}" => $postedFields['name'],
                    "{USER_MESSAGE}" => $postedFields['contactMessage']
                )))
                $this->isMailSent = false;

    }

    public function load()
    {
        $this->templateData['title'] = $this->tmpData['title'];

        //if($this->tmpData['introHtml'])
        //$this->templateData['introHtml'] = appUrl::CMSConstantsToValues($this->tmpData['introHtml']);

        //redefine template by selected in backoffice
        if($this->tmpData['text5'])
            $this->template	= $this->tmpData['text5'];
        if($this->pageStateFinished){
            if($this->isMailSent)
                $this->templateData['mailSentText'] = $this->tmpData['text2'];
            else
                $this->templateData['mailSentText'] = $this->tmpData['text3'];

            return $this->templateData;
        }

        $this->templateData['fieldModelData']	=	json_encode($this->tmpData['fieldModelData']);
        $this->templateData['validationErrors'] = json_encode($this->tmpData['validationErrors']);

        return $this->templateData;
    }

    protected function saveContactFormToDataBase($formName, $emailTo, $emailFrom, $name, $contactMessage, $langId)
    {
        if(Context::DB()->query("insert into be_ContactMessages (langId, type, emailTo, emailFrom, name, contactMessage , urlReferer) values ('".$langId."', '".$formName."', '".$emailTo."', '".$emailFrom."', '".$name."', '".$contactMessage."', '".$_SERVER['HTTP_REFERER']."')"))
            return true;
        return false;
    }

    /**
     *  Receive posted fields that used for validation and convert them for validation method
     *
     */
    protected function receiveValidatedFields($validationRulesMethod)
    {
        if(!empty($validationRulesMethod) && method_exists('ReservedRequestData',$validationRulesMethod))
            $resultArray = ReservedRequestData::$validationRulesMethod();
        else
        {
            $validationRulesMethod	=	$this->defaultValidationArray;
            $resultArray = ReservedRequestData::$validationRulesMethod();
        }

        $i = 0;
        foreach ($resultArray as $fieldName=>$fieldValue)
        {
            $this->tmpData['fieldModelData'][$i]['field']	=	$fieldName;
            $this->tmpData['fieldModelData'][$i]['required']=	$fieldValue['required'];
            $this->tmpData['fieldModelData'][$i]['rule']	=	$fieldValue['rule'];
            $i++;
        }
        return $resultArray;
    }
    protected function getPostedFields()
    {
        $postedArray= array('email'=>'','name'=>'','contactMessage'=>'');
        foreach ($_POST['cf'] as $k=>$v)
            $postedArray[$k] = Request::getValidatedString($v);
        return $postedArray;
    }
    protected function createBodyMail($postedFields)
    {
        $postedText='';
        foreach ($postedFields as $fieldName=>$value)
        {
            $postedText.=WebText::getText($fieldName, $fieldName).":<br />&nbsp;&nbsp;&nbsp;&nbsp;".$value."<br />";
        }
        return $postedText;
    }
}
$newPage = new Contact();
$newPage->run();
?>