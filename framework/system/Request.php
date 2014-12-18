<?
class Request
{
    private static $instance = null;

	/**
	 * Возвращает объект класса
	 *
	 * @return unknown
	 */
	static function getInstance() {
		//static $_Instance = null;

		if (self::$instance === null) {
			self::$instance = new Request();

		}
		return self::$instance;

	}

    /**
     * Return request parameter value
     * If request method is null, then request method will be used from $_SERVER['REQUEST_METHOD']
     *
     * @param string $requestParam
     * @param string/null $requestMethod
     * @return unknown
     */
    private static function getRequestValue($requestParam, $requestMethod = null) {

        if (!self::validateRequestMethod($requestMethod)) {
            throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Bad parameter requestMethod.');
        }

        if (is_null($requestMethod)) {
            $requestMethod = $_SERVER['REQUEST_METHOD'];
        } else {
            $requestMethod = strtoupper($requestMethod);
        }

        switch ($requestMethod) {
        	case "GET":
        	    if (array_key_exists($requestParam,$_GET)) {
        	        $value = $_GET[$requestParam];
        	    } else {
        	        $value = null;
        	    }
        		break;
        	case "POST":
        	    if (array_key_exists($requestParam,$_POST)) {
        	        $value = $_POST[$requestParam];
        	    } else {
        	        $value = null;
        	    }
        	    break;
        	case "REQUEST":
        	    $value = self::checkRequestValue($requestParam, $_REQUEST);
        	    break;
        	default:
        	    $value = null;
        		break;
        }
        return $value;
    }
    private function checkRequestValue($requestParam,&$request)
     {
     	if (array_key_exists($requestParam,$request)) {
	        $value = $request[$requestParam];
	    } else {
	        $value = null;
	    }
	    return $value;
     }
    /**
     * Validate requestMethod.
     * Return true if:
     *   - $requestMethod == null
     *   - $requestMethod == "GET"
     *   - $requestMethod == "POST"
     *
     * @param string/null $requestMethod
     * @return boolean
     */
    private static function validateRequestMethod ($requestMethod) {
        switch (strtoupper($requestMethod)) {
        	case null:
        		break;
        	case "GET":
        	    break;
        	case "POST":
        	    break;
			case "REQUEST":
        	    break;
        	default:
        	    return false;
        		break;
        }
        return true;
    }

    /**
    * возвращает целое число
    *
    * @param unknown_type $requestParam
    * @param unknown_type $requestMethod
    * @return unknown
    */
    public static function getInt($requestParam, $requestMethod = null) {
        $value = self::getRequestValue($requestParam, $requestMethod);

        if (!is_null($value)) {
            return (int) $value;
        } else {
            return null;
        }
    }

    /**
     * Возвращает вещественное значение
     *
     * @param string $requestParam
     * @param string/null $requestMethod
     * @return float/null
     */
    public static function getFloat($requestParam, $requestMethod = null) {
        $value = self::getRequestValue($requestParam, $requestMethod);

        if (!is_null($value)) {
            return (float)$value;
        } else {
            return null;
        }
    }

    /**
     * Get string parameter
     *
     * @param unknown_type $requestParam
     * @param unknown_type $requestMethod
     * @return unknown
     */
    public static function getString($requestParam, $requestMethod = null, $sqlValidate = true) {
        $value = self::getRequestValue($requestParam, $requestMethod);

        // дописать
        if (!is_null($value)) {
            if ($sqlValidate) {
                // дописать проверку на sql-инъекции
                if (self::validateStrForSQL($value)) {
                    $value = $value;
                } else {
                    $value = null;
                }
            }
            // Добавляем экранирование, если оно не включено в конфиге PHP
            if (!get_magic_quotes_gpc() ) {
                $value = addslashes($value);
            }

            return (string)$value;
        } else {
            return null;
        }
    }

    /**
     * Get string parameter that should be protected from XSS
     */
    public static function getStringCleanXSS($requestParam, $requestMethod = null, $sqlValidate = true, $filterMode = false)
    {
        if (is_null($value = self::getString($requestParam, $requestMethod, $sqlValidate)))
            return $value;

        if(!$filterMode)
            return htmlspecialchars($value);

        $filter = array("<", ">","="," (",")");
        return str_replace ($filter, "|", $value);
    }

    /**
     * Проверяет строку на sql-инъекции
     *
     * @param string $str
     * @return boolean
     */
    private static function validateStrForSQL($str) {
        return !preg_match('/insert|update|delete|select|drop|alter|create|union/', strtolower($str));
    }
    public static function validateStrSymbols($str) {
		return !preg_match('/[^A-Za-z0-9]/i', $str);
    }

    public static function getValidatedString($str)
    {
    	if(self::validateStrForSQL($str))
    	{
    		if (!get_magic_quotes_gpc() )
    		{
                return addslashes($str);
            }
            return $str;
    	} else
    		return null;
    }

    /**
     * Возвращает вещественное значение приведения типа
     *
     * @param string $requestParam
     * @param string/null $requestMethod
     * @return float/null
     */
    public function getValue($requestParam, $requestMethod = null) {
        $value = self::getRequestValue($requestParam, $requestMethod);

        if (!is_null($value)) {
            return $value;
        } else {
            return null;
        }
    }

    public function OLD_validateRequestArray($requestMethod = null)
    {
    	switch ($requestMethod)
    	{
    		case "POST":
        	    $Request = $_POST;
        		break;
        	default:
        		$Request = $_REQUEST;
        		break;
    	}

    	$validatedRequestArray = array();
    	foreach ($Request as $key=>$value)
    	{
    		$validatedRequestArray[$key] = self::getValidatedString($value);
    	}
    	return $validatedRequestArray;
    }

}