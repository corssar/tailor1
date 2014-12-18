<?php

class Validation
{
	var $db;
	
	function __construct(&$db)
	{
		$this->db = &$db;
	}
	
	function isDataUnique($table = 'fe_Pages', $field, $data)
	{
		$query = "SELECT count(*) as itemCount FROM $table WHERE $field='$data'";
		
		if($this->db->query($query))
		{
			if ($this->db->result[0]['itemCount']==0) 
			{
				return true;
			}
		}		
		return false;
	}
	
}

?>