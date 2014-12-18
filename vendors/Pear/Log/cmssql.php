<?php

class Log_cmssql extends Log
{
    /**
     * String containing the SQL insertion statement.
     *
     * @var string
     * @access private
     */
    var $sql = '';

    /**
     * Object holding the database handle.
     * @var object
     * @access private
     */
    var $db = null;

    /**
     * Resource holding the prepared statement handle.
     * @var resource
     * @access private
     */
    var $_statement = null;

    /**
     * String holding the database table to use.
     * @var string
     * @access private
     */
    var $table = 'be_Log';

    /**
     * Constructs a new sql logging object.
     *
     * @param string $name         The target SQL table.
     * @param string $ident        The identification field.
     * @param array $conf          The connection configuration array.
     * @param int $level           Log messages up to and including this level.
     * @access public
     */
    function Log_cmssql($name = '', $ident = '', $conf = array(), $level = PEAR_LOG_DEBUG)
    {
        $this->table = $name?$name:$this->table;
        $this->db = DB::getInstance();
    }

    /**
     * Inserts $message to the currently open database.
     * 
     *
     * @param mixed  $message  String or object containing the message to log.
     * @param string $priority The priority of the message.  Valid
     *                  values are: PEAR_LOG_EMERG, PEAR_LOG_ALERT,
     *                  PEAR_LOG_CRIT, PEAR_LOG_ERR, PEAR_LOG_WARNING,
     *                  PEAR_LOG_NOTICE, PEAR_LOG_INFO, and PEAR_LOG_DEBUG.
     * @return boolean  True on success or false on failure.
     * @access public
     */
    function log($data, $priority = null)
    {
		
        if ($priority === null)
        {
            $priority = $this->_priority;
        }
        //two way of working: with array and with message
        if(is_array($data)){
        	$sqldata = $data;
        }
        else{        	
        	$sqldata['message'] = $data;
            $sqldata['traceStr']=serialize(debug_backtrace());
        }
        include_once(FRAMEWORK_PATH.'system/visitorInfo.php');
        include_once(FRAMEWORK_PATH.'system/Request.php');  
		$sqldata['visitorIp'] = visitorInfo::getIP();
		$sqldata['request']	= serialize(Request::OLD_validateRequestArray('POST'));
		$sqldata['pageUrl']	= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];//$_SERVER['PHP_SELF'];//{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}
        foreach ($sqldata as $k=>$v)
        {
        	$this->db->assign($k,$v);
        }
        if ($this->db->insert($this->table))
        {
            return true;
        }
	    return false;
    }
}
