<?php
/**
 * Класс доступа к БД
 *
 * DB_HOST ** DB_USER ** DB_PASS ** DB_NAME - must be defined before;
 *
 *  $this->error
 *
 *         0 - no errors.
 *         1 - can't connect to db. Wrong host, user or password
 *         2 - DB doesn't exists. Wrong db name
 *         3 - invalid query *
 */


class DB
{
	var $write_error_file = MYSQL_LOG_FILE;
	var $connected  =false;
	var $pointer;
	var $error      = false;
	var $error_str  = "";
	var $is_rus     = true;
	var $result     = array();
	var $LIID  		= false;
	var $AFFR       = false;
	var $vars       = array();
	var $where_str  = "";
	//statistic variables
	var $queryCount  = 0;
	var $connectCount  = 0;

	static protected $_Instance = array();
	private $_dbName = null;

	function __construct($dbName) {
		//die ('You must call getInstance() in class DB');

		self::$_Instance[$dbName] = $this;
		$this->_dbName = $dbName;
	}

	static function getInstance($dbName='default')
	{
		//static $_Instance = null;
        if (!isset(self::$_Instance[$dbName]))
        {
            include_once(FRAMEWORK_PATH."system/MySqlIDb.php");
            self::$_Instance[$dbName]['MYSQLI'] = new MySqlIDb($dbName);
        }

        return self::$_Instance[$dbName]['MYSQLI'];
	}

    // Предотвращает клонирование экземпляра класса
    public function __clone(){
        trigger_error("Class: ".__CLASS__."\n".'Cloning is disabled. You must use getInstance()', E_USER_ERROR);
    }

	function write_error($sql='')
	{
		$i=0;
		/*if ($fp=fopen($this->write_error_file,"a+"))
		{
			fwrite($fp,"Error. Time=[".date("d-m-Y  -  H:i:s")."]".$this->error_str."\t $sql \n");
			fclose($fp);
			return true;
		}*/
        if ($fp=fopen($this->write_error_file,"a+"))
        {
            $e = new Exception;
            $errorString =$e->getTraceAsString();
            fwrite($fp,"Error. Time=[".date("d-m-Y  -  H:i:s")."]".$this->error_str."\t $sql \n$errorString err\n\n");
            fclose($fp);
            return true;
        }
		return false;
	}

    function save_query($sql='', $time)
    {
        $i=0;
        if ($fp=fopen($this->write_error_file.'1',"a+"))
        {
            fwrite($fp,"Time=[".date("d-m-Y  -  H:i:s")." Time: $time]".$this->error_str."\t $sql ?\n");
            fclose($fp);
            return true;
        }
        return false;
    }

	function __connect()
	{
		if (!$this->connected)
	    {
			global $dbConnect;
		   	//echo "$this->_dbName<br>";
		   	$DB_HOST=$dbConnect[$this->_dbName]['DB_HOST'];
		   	$DB_USER=$dbConnect[$this->_dbName]['DB_USER'];
		   	$DB_PASS=$dbConnect[$this->_dbName]['DB_PASS'];
		   	$DB_NAME=$dbConnect[$this->_dbName]['DB_NAME'];

		   	//echo "DB_HOST - $DB_HOST<br>DB_USER - $DB_USER<br>DB_PASS - $DB_PASS<br>DB_NAME - $DB_NAME<br>";
		    if ($this->pointer = mysql_connect($DB_HOST, $DB_USER, $DB_PASS))
	        {
	        	$this->connectCount++;
		       	if(mysql_select_db($DB_NAME, $this->pointer))
		       	{
		       	     $this->connected = true;
		       	     if ($this->is_rus)
		       	     {
		       	     	mysql_query("SET NAMES 'utf8'", $this->pointer);
		       	     }
		       	}
		       	else
		       	{
		       		$this->error = 2;
		       		$this->error_str = mysql_error($this->pointer);
		       		$this->write_error();
		       	}
	        }
		    else
		    {
		    	$this->error = 1;
		    	$this->error_str = mysql_error($this->pointer);
		    	$this->write_error();
		    }
		    if ($this->error)
		    {
		    	die('DB_error');
		    }
	    }
	}

	/**
	 * Выполняет SQL-команду (SELECT, INSERT, UPDATE, DELETE)
	 *
	 * @param string $query
	 * @return mixed
	 */
	function query($query)
	{
		$this->queryCount = $this->queryCount + 1;
		$query = trim($query);
		if (!$this->connected)
		{
			$this->__connect();
		}

        $time1 = microtime(true);
		$res = mysql_query($query, $this->pointer);
        $time2 = microtime(true);

        if(defined('DEBUG_MODE') && TRUE===DEBUG_MODE)
            if(round(($time2 - $time1),4)>0.3)
                $this->save_query($query, round(($time2 - $time1),4));

                
		if ($res !== false && strlen(mysql_error($this->pointer))==0)
        {
            //  --- Выполняем действия при отсутствии ошибок выполнения sql-команды ---
            if ( strtoupper(substr($query, 0, 6)) == "INSERT" )
			{
				$this->LIID = mysql_insert_id($this->pointer);
                $this->AFFR   = mysql_affected_rows($this->pointer);
			}
            elseif (strtoupper(substr($query, 0, 6)) == "DELETE" || strtoupper(substr($query, 0, 4)) == "DROP" || strtoupper(substr($query, 0, 5)) == "ALTER")
			{
				return $this->AFFR = mysql_affected_rows($this->pointer);
			}
            elseif (strtoupper(substr($query, 0, 6)) == "UPDATE")
			{
				preg_match('~[0-9]+~', mysql_info($this->pointer), $ret);
				return intval($ret[0]);
			}
			elseif (strtoupper(substr($query, 0, 7)) == "REPLACE")
			{
				return $this->AFFR = mysql_affected_rows($this->pointer);
			}
            elseif (strtoupper(substr($query, 0, 8)) == "TRUNCATE")
            {
                return $this->AFFR = mysql_affected_rows($this->pointer);
            }
            else
			{
			    $this->AFFR   = mysql_affected_rows($this->pointer);
			    $this->result = array();
			    while ($this->result[] = mysql_fetch_assoc($res)) continue;
			    @array_pop($this->result);

			    if (!empty($this->result))  {
			    	return true;
			    }
			    else  {
			    	return false;
			    }
                return true;
			}
        }
		else
		{
			$this->error = 3;
			$this->error_str = mysql_error($this->pointer);
			$this->write_error($query);
			$this->result     = array();
			return false;
		}
		return true;
	}

	function reset()
	{
		$this->error     = false;
		$this->error_str = "";
		if ( $this->connected === false) $this->__connect();
	    $this->result = array();
	    $this->LIID   = false;
	    $this->AFFR   = false;
	    $this->vars   = array();
	    $this->where  = "";

	}

	function assign($name, $value)
	{
        if(is_null($value)) return;
		$this->vars[$name] = get_magic_quotes_gpc()?$value:addslashes($value);
	}

	function insert($table_name)
	{
		if (!$this->connected) {
			$this->__connect();
		}

		$keys = "";
		$vals = "";

		$q = "INSERT into `$table_name` (";

		foreach ($this->vars as $k=>$v)
		{
			$keys .= "`$k`,";
			$vals .= "'$v',";
		}
		$keys{strlen($keys)-1} = '';
		$keys = trim($keys);

		$vals{strlen($vals)-1} = '';
		$vals = trim($vals);

		$q .= $keys.") VALUES (".$vals.")";

		@mysql_query($q, $this->pointer);

		if (mysql_errno($this->pointer))
		{
			$this->error     = 3;
			$this->error_str = mysql_error($this->pointer);
			$this->write_error();
			return false;
		}
		else $this->LIID = mysql_insert_id($this->pointer);
		return true;
	}

	function update($table_name)
	{
		if (!$this->connected) $this->__connect();
		$t = "";
		$q = "UPDATE `$table_name` SET ";
		foreach ($this->vars as $k=>$v)
		{
			$t .= "`$k`='$v',";
		}
		$t{strlen($t)-1} = '';
		$q .= trim($t);
		$q .= trim($this->where_str=="")?"":" WHERE ".$this->where_str;
		$q  = str_replace("\n","", $q);
		mysql_query($q, $this->pointer);
		if (mysql_errno($this->pointer))
		{
            $this->error     = 3;
		   	$this->error_str = mysql_error($this->pointer);
		   	$this->write_error();
		   	return false;
		}
		else $this->AFFR = mysql_affected_rows($this->pointer);
		return true;
	}

	function searchTable($fields, $table, $rules = false)
	{
		$res_query = ' \'1\'=\'1\' ';
	 	if(is_array($fields))
		 	foreach ($fields as $key => $val)
		 	 {
		 	 	$rule = isset($rules[$key])?$rules[$key]:'=';
		 	 	$res_query .= ' AND '.'`'.$table.'`.`'.$key.'` '.$rule.' \''.$val.'\'';
		 	 }
	 	return $res_query;
	}

	function close()
	{
		$this->reset();
		if ($this->connected)
		{
			if(!mysql_close($this->pointer))
			{
				//Echo 'closed successfully';
				//mysql_error();
			}
            $this->connected = false;
		}
		return true;
	}

	function closeAll()
	{
		foreach (self::$_Instance as $key => $obj)
		{
			if(!mysql_close($obj->pointer))
			{
				//Echo 'closed successfully';
				//mysql_error();
			}
            $this->connected = false;
		}
	}

    function runMultipleQueries($sqlStatamens)
    {
        $queries = preg_split("/;+(?=([^'|^\\\']*['|\\\'][^'|^\\\']*['|\\\'])*[^'|^\\\']*[^'|^\\\']$)/", $sqlStatamens);
        foreach ($queries as $query)
        {
            if (strlen(trim($query)) > 0)
                if($this->query($query)===false)
                {
                    return false;
                }
        }
        return true;
    }
}

?>