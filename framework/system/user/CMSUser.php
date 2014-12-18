<?php
//require_once(FRAMEWORK_PATH."system/addresses.php");
require_once(FRAMEWORK_PATH."system/ReservedRequestData.php");

class CMSUser
{
	public $userId = NULL;
	public $userName;
	public $loginName;
	public $userSurname;
	public $userEmail;
	public $userAvatar;
    public $preferLangId;
	public $isLogged = false;
	public $defaultAddressId = null;
	protected $userData;
	public $juridicalPersonData=array();
	public $validationErrors=array();
	public $validationError = true;
	protected $guid;
	
	public $handler;  //custom field for Private page link generate
	
	private static $instance = null;
	public static function getInstance()
	{		
		if (self::$instance === null) 
		{
			self::$instance = new CMSUser();			
		}
		return self::$instance;				
	}
	
	function __construct($id=null)
	{
		if(session_id()=="")
			session_start();
			
		//automatic checking is user logged
		$this->init($id);
	}
	
	protected function init($id=null)
	{
        //check UserInfo from Session && Cockie
		if(is_null($id))
		{
			if(isset($_SESSION['userInfo']))
			{
                //TODO: check if coockie and session equal
				$this->getUserDetailFromSession();
				$this->isLogged = true;
                return true;
			}

			if (isset($_COOKIE['userInfo']))
			{
				//check if cookies are correct
				$id = (int)$this->decrypt($_COOKIE['userInfo'], ENCRYPT_KEY);
				//should be added hashing of choockie				
				if($id>0 && $this->getUserDetailById($id))
				{
					$this->putUserToSession();
					$this->isLogged = true;
                    return true;
				}	
			}
            return false;
		}

		if(isset($_SESSION['userInfo']['userid']))
		{
            if($id==$_SESSION['userInfo']['userid'])
            {
                $this->getUserDetailFromSession();
                $this->isLogged = true;
                return true;
            }
            else
            {
                Context::Log()->log("Error initialize user. User from Session and from parameter is not the same. UserId:$id, SessionUserId:{$_SESSION['userInfo']['userid']}");
                return false;
            }
		}


        $query = "  SELECT
                        fe_Users.id userid,
                        fe_Users.loginName,
                        fe_Users.name,
                        fe_Users.surname,
                        fe_Users.email,
                        fe_Users.avatar,
                        fe_Users.langId,
                        fe_Users.defaultAddressId,
                        be_View.className handler
                    FROM fe_Users
                    INNER JOIN be_View ON be_View.viewId = fe_Users.viewId
                    WHERE id='$id'";

        if (Context::DB()->query($query) and count(Context::DB()->result) == 1)
        {
            $this->userId = Context::DB()->result[0]['userid'];
            $this->loginName = Context::DB()->result[0]['loginName'];
            $this->userName = Context::DB()->result[0]['name'];
            $this->userSurname = Context::DB()->result[0]['surname'];
            $this->userEmail = Context::DB()->result[0]['email'];
            $this->userAvatar = Context::DB()->result[0]['avatar'];
            $this->defaultAddressId = Context::DB()->result[0]['defaultAddressId'];
            $this->handler = Context::DB()->result[0]['handler'];
            $this->preferLangId = Context::DB()->result[0]['langId'];
            return true;
        }
        else
        {
            Context::Log()->log("Error initialize user. Can't get information about user. Query: $query");
            return false;
        }
	}
	
	public function login($email, $password, $rememberme=0)
	{
		$query = "	SELECT 
						`fe_Users`.id userid, 
						`fe_Users`.loginName,
						`fe_Users`.name,
						`fe_Users`.surname,
						`fe_Users`.email, 
						`fe_Users`.avatar, 
						`fe_Users`.defaultAddressId,
						`fe_Users`.viewId,
						 be_View.className handler
					FROM `fe_Users` 
					INNER JOIN
						`be_View`
						ON `be_View`.`viewId` = `fe_Users`.`viewId`
					WHERE 
						email='$email' AND password='".md5($password)."' AND `fe_Users`.active=1";
		
		if (Context::DB()->query($query) and count(Context::DB()->result)==1) 
		{
			$this->userId = Context::DB()->result[0]['userid'];
			$this->loginName = Context::DB()->result[0]['loginName'];
			$this->userName = Context::DB()->result[0]['name'];
			$this->userSurname = Context::DB()->result[0]['surname'];
			$this->userEmail = Context::DB()->result[0]['email'];
			$this->userAvatar = Context::DB()->result[0]['avatar'];
			$this->defaultAddressId = Context::DB()->result[0]['defaultAddressId'];
			$this->handler = Context::DB()->result[0]['handler'];
			$this->putUserToSession();

            if(USE_USER_ONLINE==true)
            {
                $query = "update `fe_Users` set lastVisitDate = CURDATE() where id=".$this->userId;
                if(!Context::DB()->query($query))
                {
                    Context::Log()->log("Class user->login(), error updating LastVisitDate, query: $query");
                }
            }
			//customization for SubDomens
            if($rememberme)
			    setcookie ("userInfo",  $this->encrypt($this->userId, ENCRYPT_KEY),time()+COOKIE_AUTH_LIFETIME, "/", COOKIE_DOMAIN);

			$this->isLogged = true;
            return true;
		}
		else
		{
			if (Context::DB()->error !==false){
                // возникла ошибка при выполнении sql-запроса
				Context::Log()->log("Class user->login(), error duaring run query: $query");
			}
			return false;			
		}
	}
	
	public function logout()
	{
		unset($_SESSION['userInfo']);
		setcookie ("userInfo", $this->userId,time()-360, "/", COOKIE_DOMAIN);	
		$this->isLogged = false;
	}

	public function getUserInfo($userId=0, $email = '')
	{
		if($userId>0 || $email!='')
		{
			$queryParam = ($email=='')?"`fe_Users`.`id`=$userId":"`fe_Users`.`email`='$email'";
			if(!isset($this->userData))
			{
				$query = "	SELECT
								`fe_Users`.*, 
								be_View.className handler
				  			FROM `fe_Users`
				  			INNER JOIN `be_View`
								ON `be_View`.`viewId` = `fe_Users`.`viewId`
				  			WHERE $queryParam AND `fe_Users`.`active`=1";

				if (Context::DB()->query($query) and count(Context::DB()->result)==1) 
				{	
					$this->userData = Context::DB()->result[0];
					return $this->userData;				
				} 
				else
				{
					if (Context::DB()->error !==3){}
						// Запрос ничего не вернул
					else 
						throw new CMSException('Error create user data in function createUser()');
				}
			}
			else
			{
				return $this->userData;
			}
		}
		return null;
	}
	public function getUserNameById($userId)
	{
		$userId = intval($userId);
		$query = "SELECT * FROM `fe_Users` WHERE id=$userId AND active=1";
		if (Context::DB()->query($query) and count(Context::DB()->result)==1) 
		{
			return Context::DB()->result[0]['name']." ".Context::DB()->result[0]['surname'];				
		}
		else return null;
	}
	public function createUser($data)
	{
        include_once(FRAMEWORK_PATH."system/Validation.php");
        include_once(FRAMEWORK_PATH."system/helper/Guid.php");

		if(!Validation::validate($data,$this->validationErrors))
			return false;
        $subscriberId = false;
        if(!$this->isEmailNotUsed($data['email']['value'])){
            $this->validationErrors[] = array('field'=>'email', 'value'=>Webtext::getText('email_is_registered', 'This email address is already registered.', true, 'Sign in page text'));
            return false;
        }

		Context::DB()->reset();
        Context::DB()->assign("viewId",36);
		foreach ($data as $name => $value)
		{
			if($name=='password'){
				$value['value'] = md5($value['value']);
			}
            if($name == 'password_confirm'){
                continue;
            }
			Context::DB()->assign($name, $value['value']);
		}

        if($subscriberId)
        {   Context::DB()->where_str = "id = $subscriberId";
            if (!Context::DB()->update("fe_Users"))
                return false;
            $this->userId = $subscriberId;
        }
        else
        {
            //assign system fields, that needed for system
            Context::DB()->assign("active",1); //0 - not active
            Context::DB()->assign("websiteId", Context::SiteSettings()->getSiteId());
            Context::DB()->assign("langId", Context::LanguageId());

            $this->guid = Guid::Generate();
            Context::DB()->assign("guid",$this->guid);

            if (!Context::DB()->insert("fe_Users"))
                return false;
            $this->userId = Context::DB()->LIID;
        }

        /** Save user address */
        /*
        include_once(FRAMEWORK_PATH."system/addresses.php");
        $address = new Addresses();
        $addressId = $address->add(ReservedRequestData::shortAddress());
        if(!$addressId)
        {
            $this->validationErrors = $address->validationErrors;
            $this->deleteUser($this->userId);
            return false;
        }
        */
        /** Set default user address */
        /*
        $address->setDefault($addressId);
        */
        //require_once(FRAMEWORK_PATH."system/Event/Event.php");
        //$amp = USE_REWRITE ? '?' : '&';
        //$confEmailLink = request::getValidatedString($_POST['confirmPage']).$amp.'confirmcode='.$this->guid.'&ch='.$this->userId;

        EventManager::Execute(
            new UserRegistrationEvent($this->userId)
        );

        return true;

	}

	public function changeUser($data)
	{
        if(isset($this->userId))
		{
            require_once(FRAMEWORK_PATH."system/Validation.php");
            if(!Validation::validate($data,$this->validationErrors)){
                return false;
            }
			Context::DB()->reset();
			foreach ($data as $key=>$value){
				Context::DB()->assign($key,$value['value'], false);
            }

			Context::DB()->where_str = "id = $this->userId";
			if(Context::DB()->update("fe_Users"))
			{
 /*               include_once(FRAMEWORK_PATH."system/addresses.php");
                $address = new Addresses();
                $userInfo = $this->getUserInfo($this->userId);
                if($address->isUsed($userInfo['defaultAddressId']) == true)
                {
                    $addressId = $address->add(ReservedRequestData::shortAddress());
                    $address->setDefault($addressId);
                    return true;
                }
                else
                {*/
                    //$address->update(($userInfo['defaultAddressId']),ReservedRequestData::shortAddress());
                    $this->getUserDetailById($this->userId);
                    $this->putUserToSession();
                    return true;
               // }
			}
		}
		return false;
	}
    public function changePasswordUser($data)
    {
        if(isset($this->userId))
        {
            require_once(FRAMEWORK_PATH."system/Validation.php");
            if(!Validation::validate($data,$this->validationErrors)){
                return false;
            }
            Context::DB()->reset();
            foreach ($data as $key=>$value){
                if($key=='password' )
                {
                    if (($value['value']) !=="")
                    {
                        $value['value'] = md5($value['value']);
                    }
                    else {
                        continue;
                    }
                }
                if($key == 'password_confirm'){
                    continue;
                }
                if($key == 'password_old'){
                    continue;
                }
                Context::DB()->assign($key,$value['value'], false);
            }

            Context::DB()->where_str = "id = $this->userId";
            if(Context::DB()->update("fe_Users"))
            {
                    //$address->update(($userInfo['defaultAddressId']),ReservedRequestData::shortAddress());
                    $this->getUserDetailById($this->userId);
                    $this->putUserToSession();
                    return true;
            }
        }
        return false;
    }
	public function confirmUserRegistration($userId)
	{
		$query = "update `fe_Users` set active = 1 where id={$userId} and active=0";
		if (Context::DB()->query($query) && Context::DB()->AFFR == 1)
			return true;			

		Context::Log()->log("Confirmation of user registration error. UserId = $userId, Update query: $query");
		return false;
	}
	private function validateUser($data, $newUser = false)
	{
		/*if(	!isset($data['password']) || (!Validate::checkpassword($data['password'])))
		{
			$this->validationErrors['password'] = WebText::getText('password_error','Некорректные данные в поле пароль', true);
			$this->validationError = true;
		}
		
		if(!isset($data['email']) || (isset($data['email']) && Validate::notEmpty($data['email']) && !Validate::checkUserEmail($data['email'])) )
		{
			$this->validationErrors['email'] = WebText::getText('email_error','Некорректные данные в поле Email', true);
			$this->validationError = true;
		}
		elseif(!$this->isEmailUnique($data['email']))
		{
			$this->validationErrors['email'] = WebText::getText('not_unique_email','Такой email-адресс уже существует в базе данных',true);
			$this->validationError = true;
		}
		
		if(!isset($data['name']) || (isset($data['name']) && !Validate::notEmpty($data['name'])) )
		{
			$this->validationErrors['name'] = WebText::getText('name_error','Имя обязательно', true);
			$this->validationError = true;
		}
		
		if(!isset($data['surname']) || (isset($data['surname']) && !Validate::notEmpty($data['surname'])) )
		{
			$this->validationErrors['surname'] = WebText::getText('surname_error','Фамилия обязательно', true);
			$this->validationError = true;
		}*/
			
		if(!$this->isEmailNotUsed($data['email']))
		{
			$this->validationErrors['email'] = WebText::getText('not_unique_email','Такой email-адресс уже существует в базе данных',true);
			$this->validationError = true;
		}
		
		return !$this->validationError;
	}
	public function isLoginUnique($loginName)
	{
		$where = isset($this->userId)?"and id={$this->userId}":"";

		$query = "SELECT count(*) as count FROM `fe_Users` WHERE loginName='$loginName' $where";
		if (Context::DB()->query($query))
		{
			if(Context::DB()->result[0]['count']==0)
				return true;
		}
		else
		{
			Context::Log()->log("Class user->isLoginUnique(), error duaring run query: $query");
		}
		return false;
	}
    public static function isEmailNotUsed($email)
	{
		$query = "SELECT count(*) as count FROM `fe_Users` WHERE email='$email'";
		if (!Context::DB()->query($query))
            throw new CMSException('Error during getting count of user by email. CMSUser::isEmailNotUsed(), error sql: '.$query);

        if (Context::DB()->result[0]['count']>0)
            return false;

        return true;
	}
	protected function putUserToSession()
	{
		if(isset($this->userId))
		{	
			$_SESSION['userInfo']['userid'] = $this->userId;
			$_SESSION['userInfo']['loginName'] = $this->loginName;
			$_SESSION['userInfo']['name'] = $this->userName;
			$_SESSION['userInfo']['surname'] = $this->userSurname;
			$_SESSION['userInfo']['email'] = $this->userEmail;
			$_SESSION['userInfo']['avatar'] = $this->userAvatar;
			$_SESSION['userInfo']['defaultAddressId'] = $this->defaultAddressId;
			$_SESSION['userInfo']['handler'] = $this->handler;
            $_SESSION['userInfo']['langId'] = $this->preferLangId;
		}
		return true;
	}
	protected function getUserDetailFromSession()
	{
		$this->userId = $_SESSION['userInfo']['userid'];
		$this->loginName = $_SESSION['userInfo']['loginName'];
		$this->userName = $_SESSION['userInfo']['name'];
		$this->userSurname = $_SESSION['userInfo']['surname'];
		$this->userEmail = $_SESSION['userInfo']['email'];
		$this->userAvatar = $_SESSION['userInfo']['avatar'];
		$this->defaultAddressId = $_SESSION['userInfo']['defaultAddressId'];
		$this->handler =  $_SESSION['userInfo']['handler'];
        $this->preferLangId =  $_SESSION['userInfo']['langId'];

		return true;
	}
	public function deleteUser()
	{
		$query = "DELETE FROM `fe_Users` WHERE id=$this->userId";
		if (Context::DB()->query($query))
		{
            include_once(FRAMEWORK_PATH."system/addresses.php");
			$address = new Addresses();
			$address->deleteUserAddress($this->userId);
			return true;
		}
	}
	public function getUserKey($userId)
	{
		$query = "SELECT guid FROM `fe_Users` WHERE id=$userId";
		if (Context::DB()->query($query))
		{
			return Context::DB()->result[0]['guid'];
		}
		return false;
	}
	
	public function getUserGuid()
	{
		return $this->guid;
	}

	static public function generateAndSaveNewPsw($email)
	{
		$query = "SELECT id,email FROM `fe_Users` WHERE email='$email'";
		if (!Context::DB()->query($query))
            throw new CMSException('Error reset password functionality, Cannot get user Id.Error sql: '.$query);

        $userId = Context::DB()->result[0]['id'];
        $arr = array('a','b','c','d','e','f',
                     'g','h','i','j','k','l',
                     'm','n','o','p','r','s',
                     't','u','v','x','y','z',
                     'A','B','C','D','E','F',
                     'G','H','I','J','K','L',
                     'M','N','O','P','R','S',
                     'T','U','V','X','Y','Z',
                     '1','2','3','4','5','6',
                     '7','8','9','0');
        $newPsw = "";
        for($i = 0; $i < 8; $i++)
        {
            $index = rand(0, count($arr) - 1);
            $newPsw .= $arr[$index];
        }
        Context::DB()->reset();
        Context::DB()->assign("password",md5($newPsw));
        Context::DB()->where_str = "id = $userId";
        if (!Context::DB()->update("fe_Users"))
            throw new CMSException('Error during update user password functionality.');

        return $newPsw;
	}
	
	public function parmWhereFrom($uId, $url = "")
    {
    	if($url)
    	{
    		$query	=	"UPDATE fe_Users
    					 SET	fe_Users.text4	=	'".$url."'
    					 WHERE	fe_Users.id	=	'".$uId."'";
    	}
    	else
    	{
    		$query	=	"SELECT fe_Users.text4
    					 FROM	fe_Users
    					 WHERE	fe_Users.id	=	'".$uId."'";
    	}
    	if(Context::DB()->query($query))
    	{
    		if ($url == "")
    		{
    			//echo "<pre>".print_r(Context::DB()->result[0]['text4'],true);
    			return Context::DB()->result[0]['text4'];
    		}
    	}
    }
    
    protected function getUserDetailById($id)
	{
		$query = "  SELECT
		                fe_Users.id userid,
		                fe_Users.name,
		                fe_Users.surname,
		                fe_Users.email,
		                fe_Users.avatar,
		                fe_Users.defaultAddressId,
		                be_View.className handler
		            FROM fe_Users
		            INNER JOIN be_View ON be_View.viewId = fe_Users.viewId
		            WHERE id='$id'";
		if (Context::DB()->query($query) and count(Context::DB()->result)==1) 
		{
			$this->userId = Context::DB()->result[0]['userid'];
			$this->userName = Context::DB()->result[0]['name'];
			$this->userSurname = Context::DB()->result[0]['surname'];
			$this->userEmail = Context::DB()->result[0]['email'];
			$this->userAvatar = Context::DB()->result[0]['avatar'];
			$this->defaultAddressId = Context::DB()->result[0]['defaultAddressId'];
			$this->handler = Context::DB()->result[0]['handler'];

			return true;
		} 
		else
		{
			Context::Log()->log("Error initialize user. Can't get information about user. Query: $query");
			return false;
		}
	}
	/* Encrypting(deccrypting) functions */
	protected function encrypt($string, $key)  
	{  
		$result ='';  
		for( $i = 1; $i <= strlen( $string ); $i++ )  
		{  
			$char = substr( $string, $i - 1, 1 );  
			$keychar = substr( $key, ( $i % strlen( $key ) ) - 1, 1 );  
			$char = chr( ord( $char ) + ord( $keychar ) );  
			$result .= $char;  
		}  
		return $result;  
	}  
	   
	protected function decrypt($string, $key)  
	{  
		$result ='';  
		for( $i = 1; $i <= strlen( $string ); $i++ )  
		{  
			$char = substr( $string, $i - 1, 1 );  
			$keychar = substr( $key, ( $i % strlen( $key ) ) - 1, 1);  
			$char = chr( ord( $char ) - ord( $keychar ) );  
			$result .= $char;  
		}  
		return $result;  
	}

    public function getJuridicalPersonData($userId)
    {
        $query = "	SELECT
						fe_Companies.id,
						fe_Companies.countryId as registerCountryId,
						fe_Companies.title as personTitle,
						fe_Companies.taxIdentificationNumber,
						fe_Companies.employeePosition,
						fe_Companies.employeeName,
						IFNULL(IFNULL(gt.alternateName, gtl.alternateName), country.name) AS registerCountryName
					FROM
						fe_Companies
					WHERE
						userId = $userId
					LIMIT 1";
        if(Context::DB()->query($query)){
            $this->juridicalPersonData = Context::DB()->result[0];
            return true;
        }
        return false;
    }

    public function changeJuridicalPersonData($data)
    {
        if(isset($this->userId))
        {
            require_once(FRAMEWORK_PATH."system/Validation.php");
            if(!Validation::validate($data,$this->validationErrors)){
                return false;
            }
            $isCreated = $this->getJuridicalPersonData($this->userId);
            Context::DB()->reset();
            foreach ($data as $key=>$value)
                Context::DB()->assign($key,$value['value'], false);
            $jPersonDataSuccess = false;
            if($isCreated){
                $jPersonId = $this->juridicalPersonData['id'];
                Context::DB()->where_str = "id = $jPersonId";
                if(Context::DB()->update("fe_Companies")){
                    $jPersonDataSuccess = true;
                }
            }
            else{
                Context::DB()->assign('userId',$this->userId);
                if(Context::DB()->insert("fe_Companies")){
                    $jPersonDataSuccess = true;
                    $jPersonId = Context::DB()->LIID;
                }
            }
            if($jPersonDataSuccess){
                $this->changePhones(0, $jPersonId);
                return true;
            }
        }
        return false;
    }

    public function changePhones($userId = NULL, $jPersonId = NULL)
    {
        $phoneData = array();
        if($userId && !$jPersonId){
            $phoneData = $_POST['userPhoneData'];
        }
        else{
            $phoneData = $_POST['jPersonPhoneData'];
        }
        foreach($phoneData as $key=>$value)
        {
            if(preg_match('/delete/i',$key)){
                $this->deletePhone(str_replace('delete','', $key));
                continue;
            }

            $tmpData = array(	"codeId"    =>  array('value' => request::getValidatedString($value['phoneCode']),
                                                'required' => true, 'rule'=>''),
                                "number"    =>  array('value' => request::getValidatedString($value['phoneNumber']),
                                                'required' => true, 'rule'=>''),
                                "description"=> array('value' => request::getValidatedString($value['phoneDescription']),
                                                'required' => false, 'rule'=>'')
                            );
            if(!Validation::validate($tmpData, $errors)){
                continue;
            }
            if(preg_match('/update/i',$key)){
                $this->updatePhones($tmpData, str_replace('update','', $key));
            }
            if(preg_match('/insert/i',$key)){
                $this->insertPhones($tmpData, $userId, $jPersonId);
            }
        }
    }

    protected  function updatePhones($data, $id)
    {
        Context::DB()->reset();
        foreach ($data as $key=>$value){
            Context::DB()->assign($key,$value['value'], false);
        }
        Context::DB()->where_str = "id = $id";
        if(Context::DB()->update("fe_Phones")){
            return true;
        }
        return false;
    }

    protected  function insertPhones($data, $userId, $jPersonId)
    {
        Context::DB()->reset();
        if($userId || $jPersonId)
        {
            foreach ($data as $key=>$value){
                Context::DB()->assign($key,$value['value'], false);
            }
            if($userId)
                Context::DB()->assign('userId',$userId);
            else
                Context::DB()->assign('companyId',$jPersonId);

            if(Context::DB()->insert("fe_Phones")){
                return true;
            }
        }
        return false;
    }

    protected function deletePhone($phoneId)
    {
        $query = "DELETE FROM fe_Phones WHERE id = $phoneId";
        if(Context::DB()->query($query))
            return true;
        return false;
    }

    public function getPhones($userId = 0, $jPersonId = 0)
    {
        $phoneData = array();
        if($userId && !$jPersonId){
            $where = "userId = $userId";
        }
        else{
            $where = "companyId = $jPersonId";
        }
        $query = "  SELECT
                       fe_Phones.*,
                       fe_PhoneCodes.code
                    FROM fe_Phones
                    LEFT JOIN fe_PhoneCodes ON fe_PhoneCodes.id = fe_Phones.codeId
                    WHERE $where";
        if(Context::DB()->query($query)){
            return Context::DB()->result;
        }
        return array();
    }

    public function isUserNonActive($userId)
    {
        $query = "SELECT active FROM `fe_Users` WHERE id = $userId";
        if (Context::DB()->query($query)){
            if(Context::DB()->result[0]['active'] == 0)
                return true;
        }
        return false;
    }

    public static function isUserIsSubscriberAndNotRegistered($email)
    {
        $query = "SELECT * FROM fe_Users WHERE email='$email' ";
        if (Context::DB()->query($query))
        {
            $result = Context::DB()->result[0];
            if($result['viewId'] == 0)
                return $result['id'];
        }
        return false;
    }
}
?>