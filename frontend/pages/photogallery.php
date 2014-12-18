<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."system/WebText.php");
require_once(FRAMEWORK_PATH."data_objects/PhotoGalleryData.php");

class photogallery extends Page 
{
    private $data;
	protected $template	=	'Pages/photogallery.tpl';    
    public $paging=array('isPaging'=>0);
	public $countOnPage=0;
	public $total_pages=1;
	public $current_page=1;

    public function load() 
    {
    	//((int) Request::getInstance()->getValue('page'))>0?$currentPage=(int) Request::getInstance()->getValue('page'):$currentPage=1;    	
        $currentPage = (Request::getInstance()->getInt('page', 'GET'))?Request::getInstance()->getInt('page', 'GET'):1;
        /*
        	test for using cache
        */	
		// Create a Cache_Lite object
		$cache = new CacheFace();		
		// Test if there is a valide cache item for this data
		if( $cacheData = $cache->get('page_'.$this->getPageId()."_".$currentPage) )
		{
			// Cache hit
   			$this->templateData = unserialize($cacheData);
		}
		else 
		{
			//$cache->save(serialize($data));
			$this->pageData = new PageData($this->getPageId());
			if(!$this->pageData->load())
			{
				throw new CMSExeption("Data for this page was not loaded");
			}
			    
			if($this->pageData->getValue('title'))
			{
			    $this->templateData['title'] = $this->pageData->getValue('title');
			}
			$this->templateData['galleryId'] = $this->getPageId();
			$this->templateData['introHtml'] = appUrl::CMSConstantsToValues($this->pageData->getValue('introHtml'));
			//getting count neas on page
			if(is_numeric($this->pageData->getValue('number2')))
				$countOnPage = $this->pageData->getValue('number2');	
			else 
			    $countOnPage= 0;
			    
			$gallery = new PhotoGalleryData($this->pageData->getValue('langId'));
			$gallery->photoGalleryId = $this->getPageId();
			if($gallery->getPhotos($countOnPage,$currentPage))
			{
				/*echo "<pre>";
				var_dump($gallery->getProperties());
				echo "</pre>";*/
				$this->templateData['photos']=$gallery->getProperties();
				$this->templateData['paging']=$gallery->paging;
				$this->templateData['currentPageUrl']=appUrl::getUrl($this->getPageId(), 'photogallery.php');
			}
				
			$this->templateData['photogalleryPlSource'] = appUrl::CMSConstantsToValues('{SITE_URL}/frontend/webcontent/file/swf/gallery.swf');
			$this->templateData['photogalleryPlXMLSource'] = appUrl::CMSConstantsToValues('{SITE_URL}/frontend/handlers/FlashPhotogallery.php');
			
			$cache->save(serialize($this->templateData));
		}        
       
        return $this->templateData;
        
    }
}
$newPage = new photogallery();
$newPage->run();
?>