<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."system/appUrl.php");
require_once(FRAMEWORK_PATH."system/Languages.php");
require_once(FRAMEWORK_PATH."system/Context.php");
require_once(FRAMEWORK_PATH."core/Handler.php");


class MainBanner extends Handler 
{	
	protected	$bannerId;
	
	function getClips()
    {
		$this->bannerId	=	(Request::getInstance()->getInt('page', 'GET'))?Request::getInstance()->getInt('page', 'GET'):0;
    	
    	$cache = new CacheFace();
		
        if( $cacheData = $cache->get('bannerPage_'.$this->bannerId, 600) )
		{
   			$port_list = unserialize($cacheData);
		}
		else
		{
			$db = DB::getInstance();
	        $query="SELECT 
	        			fe_PagesRelatedItems.*, be_View.className as classname
					FROM fe_PagesRelatedItems
					    INNER JOIN be_View ON fe_PagesRelatedItems.Viewid = be_View.viewId
					    INNER JOIN be_PageContent ON be_PageContent.contentId = fe_PagesRelatedItems.id
					WHERE 
						be_PageContent.pageId = {$this->bannerId}
					ORDER BY be_PageContent.id ASC";
	        if ($db->query($query))
			{
				$properties = $db->result;
				for($i=0;$i<count($properties);$i++)
				{
					$port_list[$i]['clipURL']		=	appUrl::CMSConstantsToValues($properties[$i]['text1']);
					$port_list[$i]['clipText']		=	html_entity_decode(strip_tags($properties[$i]['text2'], '<br>'));
					$port_list[$i]['clipTextColor']	=	$properties[$i]['text3'];
					$port_list[$i]['clipTime']		=	$properties[$i]['number1'];
					$port_list[$i]['clipLink']		=	"";
				}
				
				$cache->save(serialize($port_list));
			}
			else 
			{
				$port_list=array();
//				throw new CMSExeption("Data for this page was not loaded");
			}			
		}    	



		return $port_list;
    }
    function getXML()
    {	
    	header('Content-type: application/xml'); 
		echo '<?xml version="1.0" encoding="utf-8"?>';
		echo "\n<mainbannerdata>";
		foreach ($this->getClips() as $item)
		{
		    echo "\n	<item imgsrc=\"".$item['clipURL']."\" link=\"".$item['clipLink']."\" color=\"".$item['clipTextColor']."\" time=\"".$item['clipTime']."\">";
		    echo "\n		<![CDATA[".$item['clipText']."]]>";
		    echo "\n	</item>";			
		}
		echo "\n</mainbannerdata>";
	}
}
$MainBanner = new MainBanner();
$MainBanner->getXML();
?>