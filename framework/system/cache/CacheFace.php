<?php
class CacheFace
{
    protected $useCache;
    protected $cacheObj;
    protected $alwaysTurnOn; // if called from SiteSettings $alwaysTurnOn == true

    public function __construct($alwaysTurnOn = false)
    {
        $this->alwaysTurnOn = $alwaysTurnOn;
    	//i think we will change it :-)
    	global $cacheOptions;
    	
        if($this->alwaysTurnOn || Context::SiteSettings()->useCache())
            $this->useCache = true;

        if($this->useCache==true)
        {
        	include_once(SITE_PATH."vendors/Pear/Lite.php");
        	// Create a Cache_Lite object
			$this->cacheObj = new Cache_Lite($cacheOptions);
        }
    }

    public function get($casheKey, $cacheGroup='default')
    {
        if($this->useCache==true)
        {
            if($this->alwaysTurnOn){
                return $this->cacheObj->get($casheKey, $cacheGroup);
            }
            else{
                return $this->cacheObj->get($casheKey.'_'.Context::SiteSettings()->getSiteId(), $cacheGroup);
            }
        }
        else
        {
            return false;
        }
    }
    public function getTime($casheKey, $timeInSecond=null, $cacheGroup='default')
    {
        if($this->useCache==true)
        {
            if(!is_null($timeInSecond))
                $this->cacheObj->setLifeTime($timeInSecond);
            return $this->cacheObj->get($casheKey, $cacheGroup);
        }
        else
        {
            return false;
        }
    }

    public function save($data, $casheKey = NULL, $cacheGroup = 'default')
    {
        if($this->useCache==true)
        {
            return $this->cacheObj->save($data, $casheKey, $cacheGroup);
        }
    }

    public function clean($cacheGroup = false)
    {
        if($this->useCache==true)
        {
            $this->cacheObj->clean($cacheGroup);
            return true;

        }
    }


    // Should be used function getTime instead of this method    
    public function setCacheTime($timeInSecond)
    {
        if($this->useCache==true)
        {
            $this->cacheObj->setLifeTime($timeInSecond);
        }
        return true;
    }
    public function removeByKey($key)
    {
        if($this->useCache==true)
            return $this->cacheObj->remove($key.'_'.Context::SiteSettings()->getSiteId());

        return true;
    }
}
?>