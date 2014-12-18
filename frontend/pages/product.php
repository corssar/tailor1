<?php
if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/ProductPage.php");
require_once(FRAMEWORK_PATH."system/webshop/productList.php");

class productContent extends ProductPage
{
	protected $template = 'Pages/product.tpl';
    protected 	$CSS = array("/frontend/webcontent/css/catalog.css", "/frontend/webcontent/js/selectik/selectik.css", "/frontend/webcontent/css/product.css", "/frontend/webcontent/js/cloud-zoom_css/cloud-zoom.css");
    protected 	$JS = array("/frontend/webcontent/js/selectik/jquery.mousewheel.js", "/frontend/webcontent/js/selectik/jquery.selectik.js", "/frontend/webcontent/js/product.js", "/frontend/webcontent/js/cloud-zoom.js");
    public function load()
    {
        $this->templateData = array();
        
        $cache = new CacheFace();
        $cache->setCacheTime(600);
		
        if( $this->pageData = $cache->get('product_'.$this->getPageId()))
		{
   			$this->templateData = unserialize($this->pageData);
		}
		else 
		{
	        $this->pageData = new ProductPageData($this->getPageId());
			if($this->pageData->load())
			{
				$this->templateData['productId'] = $this->getPageId();
    		    $this->templateData['title'] = $this->pageData->getValue('title');
                $this->templateData['brand'] = $this->pageData->getValue('brand');
                $this->templateData['model'] = $this->pageData->getValue('itemNumber');
    		    /*$this->templateData['imageSmall'] = appUrl::CMSConstantsToValues($this->pageData->getValue('imageSmall'));
                $this->templateData['image'] = appUrl::CMSConstantsToValues($this->pageData->getValue('image'));*/

				if($this->pageData->getValue('price'))
				{
				    $this->templateData['price'] = appUrl::CMSConstantsToValues($this->pageData->getValue('price'));
				}
                if($this->pageData->getValue('oldPrice'))
                {
                    $this->templateData['oldPrice'] = appUrl::CMSConstantsToValues($this->pageData->getValue('oldPrice'));
                }
				if($this->pageData->getValue('introHtml'))
				{
				    $this->templateData['introHtml'] = appUrl::CMSConstantsToValues($this->pageData->getValue('introHtml'));
				}
                $this->templateData['shortDescription'] = appUrl::CMSConstantsToValues($this->pageData->getValue('shortDescription'));
    		    $this->templateData['html'] = appUrl::CMSConstantsToValues($this->pageData->getValue('html'));
                $this->templateData['material'] = appUrl::CMSConstantsToValues($this->pageData->getValue('material'));
                $products = new ProductList($this->getPageId());
                $this->templateData['photoUrl'] = $products->getProductPhoto($this->getPageId());
                $products = new ProductList($this->getPageId());
                $this->templateData['SizeAndColor'] = $products->getColorAndSize($this->getPageId());
                $this->templateData['SizeAndColorJson'] = json_encode($products->getColorAndSize($this->getPageId()));
                $link = appUrl::getUrl($this->getPageId(), 'product.php');
                $this->templateData['link'] = $link;
                //$json = json_encode($this->templateData['SizeAndColor']);
                //echo json_encode($this->templateData['SizeAndColor']);
				//$this->templateData['ajaxHandler'] = AJAX_HANDLER;
			}
			$cache->save(serialize($this->templateData));
		}			
        return $this->templateData;
    }
}
$newPage = new productContent();
$newPage->run();
?>