<?php

/*
	TABLE session
	---------------------------
	uid  unsigned int default 0
	sid  char(40)
	data text
	
	index (uid, sid)
*/

class SESSION
{
	var $use 			= 'session'; /* session | db */
	var $lifeTime 		= 7200; 	 /* seconds 	 */
	var $db				= false;
	var $urlAppendix	= false;
	var $data			= array();
	
	function SESSION($uid=0, $sid='')
	{
		$this->start($uid, $sid);
	}
	
	function start($uid=0, $sid='')
	{
		switch ($this->use)
		{
			case 'session'	:
                    if(!isset($_SESSION))
                    {
                        session_start();
                    }
					$this->data = $_SESSION;
				break;
			case 'db'		:	global $db;
				break;
		}
	}
	
	function assign($k, $v)
	{
	 	$this->data[$k] = is_array($v)?array_merge($this->data[$k],$v):$v;		
	}
	
	function close()
	{
		switch ($this->use)
		{
			case 'session'	: 
							  $_SESSION = $this->data;
							  session_write_close();							  
				break;
			case 'db'		: 
				break;
		}
	}
	
	function clear()
	{
		switch ($this->use)
		{
			case 'session'	: $_SESSION = array();
				break;
			case 'db'		: 
				break;
		}
	}
	
}

?>