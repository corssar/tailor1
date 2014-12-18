<?php

/**
 * Абстрактный класс для скриптов, которые обрабатывают отдельные http-запросы
 *
 */
abstract class Handler {
	
	private $db_superliga;
	
	private $db_ukrbasket;
	
	
	protected function getDBSuperliga() {
		$this->db_superliga = DB::getInstance();
		return $this->db_superliga;
	}
	
	protected function getDBUkrbasket() {
		$this->db_ukrbasket =  DB::getInstance('ukrbasket');
		return $this->db_ukrbasket;
	}
	
	public function __destruct() {
		
		if (isset($this->db_superliga)) {
			$this->db_superliga->close();
		}
		
		if (isset($this->db_ukrbasket)) {
			$this->db_ukrbasket->close();
		}
		
		
		
	}
	
	
	
	
	
}


?>