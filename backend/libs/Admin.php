<?php
/*
     TABLE `be_Admin`
     ---------------
     id			(PRIMARY KEY)
     username	(CHAR 40) 		DEFAULT ''
     password	(CHAR 40)		DEFAULT ''
     email		(CHAR 40)		DEFAULT ''
     rights		(CHAR 255)		DEFAULT '{ALL}{A}{B}{C}{D}{E}{F}{G}{H}{I}{J}{K}{L}{M}{N}{O}{P}{Q}{R}{S}{T}{U}{V}{W}{X}{Y}{Z}{1}{2}{3}{4}{5}{6}{7}{8}{9}{0}'
     name		(CHAR 255)		DEFAULT ''
     lastLogin (INT UNSIGNED)  DEFAULT 0
     
*/
/*
	SESSION OBJECT required
	$session = new SESSION();
*/

class ADMIN
{
	var $session;
	var $auth_ok 	= false;
	var $id		 	= false;	
	var $rights	 	= 'no_rights';
	var $name	 	= '';
	var $email		= '';
	var $last_login = 0;
    var $roleId = 0;
    var $isAccess;
	var $time;
	
	function ADMIN(&$session)
	{
		$this->session = &$session;
		$this->auth_ok	= (isset($this->session->data['c_admin']['auth_ok']) && $this->session->data['c_admin']['auth_ok'])?true:false;
		$this->time		= time();
		if ($this->auth_ok)
		{
			$this->id		  = (isset($this->session->data['c_admin']['id'])	      && $this->session->data['c_admin']['id'])	        ?$this->session->data['c_admin']['id']:false;
			$this->rights	  = (isset($this->session->data['c_admin']['rights'])     && $this->session->data['c_admin']['rights'])     ?$this->session->data['c_admin']['rights']:'no_rights';
			$this->name		  = (isset($this->session->data['c_admin']['name'])       && $this->session->data['c_admin']['name'])       ?$this->session->data['c_admin']['name']:'';
			$this->email	  = (isset($this->session->data['c_admin']['email'])      && $this->session->data['c_admin']['email'])      ?$this->session->data['c_admin']['email']:'';
			$this->last_login = (isset($this->session->data['c_admin']['last_login']) && $this->session->data['c_admin']['last_login']) ?$this->session->data['c_admin']['last_login']:'';
            $this->roleId = (isset($this->session->data['c_admin']['roleId']) && $this->session->data['c_admin']['roleId']) ?$this->session->data['c_admin']['roleId']:'';
            $this->isAccess = (isset($this->session->data['c_admin']['isAccess']) && $this->session->data['c_admin']['isAccess']) ?$this->session->data['c_admin']['isAccess']:'';
		}
		
	}
	
	function login(&$username, &$password)
	{
		global $db;
		if ($db->query('SELECT * from `'.DB_BE_TBL_PREFIX.'Admin` WHERE `username`=\''.$username.'\' AND `password`=\''.sha1($password).'\' LIMIT 1'))
		{
            $this->roleId = $this->session->data['c_admin']['roleId']	= $db->result[0]['roleId'];
            if($this->roleId == null) return false;

			$this->id		  = $this->session->data['c_admin']['id'] 			= $db->result[0]['id'];			
			$this->rights	  = $this->session->data['c_admin']['rights']		= $db->result[0]['rights'];
			$this->name		  = $this->session->data['c_admin']['name']			= $db->result[0]['name'];
			$this->email	  = $this->session->data['c_admin']['email']		= $db->result[0]['email'];
			$this->last_login = $this->session->data['c_admin']['last_login']	= $db->result[0]['lastLogin'];			
			$this->isAccess = $this->session->data['c_admin']['isAccess']	= $db->result[0]['isAccess'];
			$this->auth_ok	  = $this->session->data['c_admin']['auth_ok'] 		= true;
			
			$db->query('UPDATE `'.DB_BE_TBL_PREFIX.'Admin` SET `lastLogin`=\''.$this->time.'\' WHERE `username`=\''.$username.'\' AND `password`=\''.sha1($password).'\' LIMIT 1');
			
			return true;
		}
		else return false;
	}
	
	function logout()
	{
		$this->session->data['c_admin'] = array();
		return true;
	}
	
	
	function checkLevel($level='no_level')
	{
		return strstr($this->level, '{'.$level.'}');
	}
	
	function createMenu()
	{
		foreach ($this->rights as $k=>$v)
		{
			foreach ($v as $k1=>$v1)
			{
				if ($this->checkAction($v1)) $this->menu[$k][$k1] = true;
			}
		}
		$_SESSION['c_admin']['menu'] = $this->menu;
	}
	
	
	
	
	function addAdmin($admin)
	{
		if ( $this->checkAction($this->rights['admin']['add_admin']) && $error = checkArrayValues($admin/*usernm, pass, email, level*/, array('text','text','email','text') ))
		{
			if ($error!==true) return $error;
			global $db;
			return $db->query('INSERT INTO `'.DB_TBL_PREFIX.'Admin` (`username`, `password`, `email`, `level`) VALUES (\''.$admin['username'].'\', \''.sha1($admin['password']).'\', \''.$admin['email'].'\', \''.$admin['level'].'\' )');			
		}
		else 		
		return false;
	}
	
	function getAdmins($id=false)
	{
		if ( strstr($this->level, $this->rights['admin']['view_admin']) )
		{
			global $db;
			$id = is_int($id)?'WHERE `id`=\''.$id.'\'':'';
			return ($db->query('SELECT * FROM `'.DB_TBL_PREFIX.'Admin` '.$id))?$db->result:false;
			
			
		}
	}
	
	function updateAdmin($admin, $id=false)
	{
		
		if ($this->checkAction($this->rights['admin']['edit_admin']) && is_int($id) && $error = checkArrayValues($admin, array('text','text','email','text')) )
		{
			if ($error!==true) return $error;
			global $db;
			$db->query('UPDATE TABLE `'.DB_TBL_PREFIX.'Admin` SET WHERE `id`=\''.$id.'\'');
			return true;
		}
		elseif ( $error = checkArrayValues($admin, array('text','text','email','text')) )
		{
			if ($error!==true) return $error;
			global $db;
			$db->query();
			return true;
		}
		else return false;
	}
	
	function deleteAdmin($id)
	{
		if ( $this->checkAction($this->rights['admin']['del_admin']) && is_int($id))
			{
				global $db;
				return $db->query('DELETE FROM `'.DB_TBL_PREFIX.'Admin` WHERE `id`=\''.$id.'\'');				
			}
		else return false;
	}
	
}
?>