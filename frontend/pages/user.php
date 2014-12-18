<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/UserPage.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");


class userProfilePage extends UserPage 
{
    private $data;
    protected $template = 'Pages/user.tpl';
	protected $requireAuthorization=true;
    //if page should have full cache, you need define protected function setFullCache() as in base class
    
    public function load()
    {
        $pageData = array();
        
        $cache = new CacheFace();
		
        if( $data = $cache->get('userPage_'.$this->getPageId(), 6000) )
		{
   			$pageData = unserialize($data);
		}
		else 
		{
	        $data = new UserPageData($this->getPageId());
			if($data->load())
			{
				$userObj = CMSUser::getInstance();
				$pageData['currentUserPage'] = ($data->getValue('id')==$userObj->userId)?true:false;
				$pageData['myInfoURL'] = appUrl::getUrl(212,"myinfo.php");
				$pageData['pageId'] = $this->getPageId();
			    $pageData['title'] = $data->getValue('title');

			    $pageData['name'] = $data->getValue('name');
			    $pageData['surname'] = $data->getValue('surname');
				$pageData['ajaxHandler'] = AJAX_HANDLER;
			}
			$cache->save(serialize($pageData));
		}
        return $pageData;
    }
}
$newPage = new userProfilePage();
$newPage->run();
?>