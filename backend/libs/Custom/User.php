<?php

class User
{
	public $lang;
	public $db;
	
	private static $instance = null;
	
	function __construct()
	{
		global $lang;
		$this->lang = $lang;
		$this->db 	= DB::getInstance();
	}
	
	function getInstance() 
	{		
		if (self::$instance === null) 
		{
			self::$instance = new User();
		}
		return self::$instance;				
	}
	
	public function getUserInfo($id,$params = array())
	{
		$query = "	SELECT 
						fe_Users.*,
						fe_Addresses.street,
						fe_Addresses.houseNumber,
						fe_Addresses.flatNumber,
						fe_Addresses.addressFull,
						country.name as country,
						region.id as regionId,
						region.name as region,
						city.name as city
					FROM
						fe_Users
					LEFT JOIN
						fe_Addresses
						ON fe_Addresses.userId = fe_Users.id
					LEFT JOIN
						fe_Location as country
						ON country.id = fe_Addresses.countryId
					LEFT JOIN
						fe_Location as region
						ON region.id = fe_Addresses.regionId
					LEFT JOIN
						fe_Location as city
						ON city.id = fe_Addresses.cityId
					WHERE `fe_Users`.`id` = $id";

		if($this->db->query($query))
		{
			$userRegionId = $this->db->result[0]['regionId'];
			$html = '	<table class="userData">
							<tr><td width="200px">'.$this->lang['SURNAME'].'</td><td>'.$this->db->result[0]['surname'].'</td></tr>
							<tr><td>'.$this->lang['NAME'].'</td><td>'.$this->db->result[0]['name'].'</td></tr>							
							<tr><td>'.$this->lang['PATRONYMIC'].'</td><td>'.$this->db->result[0]['patronymic'].'</td></tr>
							<tr><td>'.$this->lang['BIRTHDATE'].'</td><td>'.$this->db->result[0]['birthDate'].'</td></tr>
							<tr><td>'.$this->lang['COUNTRY'].'</td><td>'.$this->db->result[0]['country'].'</td></tr>
							<tr><td>'.$this->lang['REGION'].'</td><td>'.$this->db->result[0]['region'].'</td></tr>
							<tr><td>'.$this->lang['CITY'].'</td><td>'.$this->db->result[0]['city'].'</td></tr>
							<tr><td>'.$this->lang['EMAIL'].'</td><td>'.$this->db->result[0]['email'].'</td></tr>
							<tr><td>'.$this->lang['FAX'].'</td><td>'.$this->db->result[0]['text1'].'</td></tr>
							<tr><td>'.$this->lang['PHONE_NUMBER'].'</td><td>'.$this->db->result[0]['phoneNumber'].'</td></tr>';
			
			$html.= '</table>';
		}
		
		return $html;
	}
	
	public function getCurrentUser($id,$postData = array())
	{
		global $admin;
		
		if($postData['documentRedactor'])
		{
			$this->db->query("UPDATE fe_Products SET documentRedactor='{$postData['documentRedactor']}' WHERE id = {$id}");
		}
		else 
		{
			$html = '<input type="hidden" name="customField[documentRedactor]" value="'.$admin->name.'">';
		}
		return $html;
	}
	
	public function setRedactorPassword($id,$postData = array())
	{
        $html ='';
		if(isset($postData['newRedactorPswd']) && $postData['newRedactorPswd'])
		{
			$this->db->query("UPDATE be_Admin SET password='".sha1($postData['newRedactorPswd'])."' WHERE id = {$id}");
		}
		else 
		{
			$html = '<input type="text" size=25 name="customField[newRedactorPswd]" value="">';
		}
		return $html;
	}
	
	public function userStatus($id,$params = array())
	{
		if($params['posted'])
		{
			$this->db->query("UPDATE `fe_Users` SET referee = {$params['userStatus']} WHERE id = $id");
			if(strlen(trim($params['emailText'])) > 0)
			{
				require_once(FRAMEWORK_PATH."system/MailBus.php");
				MailBus::changedUserStatusNotification($params['userEmail'],$params['emailText']);
			}
		}
		else 
		{
			$html = '';
			$descriptions = '';
			$query = "	SELECT 
							`be_UserStatus`.*,
							`fe_Users`.`referee`,
							`fe_Users`.`email`
						FROM 
							`be_UserStatus` 
						LEFT JOIN
							`fe_Users`
							ON `fe_Users`.`id` = $id
						WHERE 
							1";

			if($this->db->query($query))
			{
				$html.= '	<input type="hidden" name="customField[posted]" value="1">
							<input type="hidden" name="customField[userEmail]" value="'.$this->db->result[0]['email'].'">
							<select name="customField[userStatus]" onchange="changeUserStatus(this);">';
				foreach ($this->db->result as $item)
				{
					$html.= '	<option value="'.$item['id'].'"'.($item['id']==$item['referee']?" selected ":"").'>'.$item['description'].'</option>';
					$descriptions.= '<input type="hidden" id="emailTextVariant'.$item['id'].'" value="'.htmlspecialchars($item['emailText']).'">';
				}
				$html.= '</select>';
			}
			$html.=	$descriptions;
			$html.= '<textarea name="customField[emailText]" id="emailText" cols="60" rows="10" style="display:none;"></textarea>';
			return $html;
		}
	}
}
?>