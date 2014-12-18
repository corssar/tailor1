<?php
require_once FRAMEWORK_PATH.'system/Validation.php';
require_once FRAMEWORK_PATH.'system/user/CMSUser.php';

class Addresses
{
	private $table = 'fe_Addresses';
    public  $user;
    public  $validationErrors = array();

	function __construct()
	{
        $this->user = CMSUser::getInstance();

	}
	
	public function add($data)
	{
        if(!Validation::validate($data, $this->validationErrors))
        {
            return false;
        }

		Context::DB()->reset();

        foreach ($data as $key => $value)
        {
            Context::DB()->assign($key, $value['value']);
        }

        Context::DB()->assign("userId", $this->user->userId);

        if(Context::DB()->insert($this->table))
        {
            return Context::DB()->LIID;
        }

        throw new CMSException('Error create user address in ' . __METHOD__);
        return false;
	}

    public function get($addressId, $userId = null)
    {
        if(!$userId)
            $userId = $this->user->userId;
        $addressId = (int)$addressId;
        $query = "	SELECT
                        *
					FROM
						{$this->table}
					WHERE
						userId = {$userId} AND id = {$addressId}";

        if(Context::DB()->query($query))
        {
            return Context::DB()->result[0];
        }

        return false;
    }

    /**
     * Set current user default address
     * @param $addressId
     * @return mixed
     */
    public function setDefault($addressId)
    {
        $addressId = (int)$addressId;
        $query = "  UPDATE fe_Users
                    SET defaultAddressId = {$addressId}
                    WHERE id = {$this->user->userId}";

        if(Context::DB()->query($query))
        {
            $this->user->defaultAddressId = $addressId;
            return Context::DB()->AFFR;
        }

        return false;
    }

	public function update($addressId, $data)
	{
        if(!Validation::validate($data, $this->validationErrors))
        {
            return false;
        }

        Context::DB()->reset();

        foreach ($data as $key => $value)
        {
            Context::DB()->assign($key, $value['value']);
        }

		Context::DB()->where_str = "id = $addressId AND userId = {$this->user->userId}";

		if(Context::DB()->update($this->table))
        {
            return $addressId;
        }

		return false;
	}

    /**
     * Check if address used in orders
     * @param $addressId
     * @return bool
     */
    public function isUsed($addressId)
    {

        $query = "  SELECT id FROM fe_Orders
                    WHERE shippingAddressId = ".(int)$addressId." OR billingAddressId = ".(int)$addressId."
                    LIMIT 1";

        return Context::DB()->query($query) ? true : false;
    }
	

}