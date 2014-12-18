<?php

class UserMask extends EventMask
{
    public $userId;

    function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function getMask()
    {
        return array("{USER_NAME}" => WebText::getText("USER_MASKS_USER_NAME", "Ім'я користувача"),
                     "{USER_EMAIL}" => WebText::getText("USER_MASKS_USER_EMAIL", "Email користувача"),
                     "{USER_LOGIN}" => WebText::getText("USER_MASKS_USER_LOGIN", "Логін користувача"),
                     "{USER_CONFIRMATION_LINK}" => WebText::getText("USER_MASKS_USER_CONFIRMATION_LINK", "Адреса підтвердження"),
                     "{USER_PASSWORD}" => WebText::getText("USER_MASKS_USER_PASSWORD", "Пароль користувача"),
                     "{USER_NEW_PASSWORD}" => WebText::getText("USER_MASKS_USER_NEW_PASSWORD", "Пароль користувача"));
    }

    public function replaceMask()
    {
        $user = null;
        if($this->userId == null)
        {
            $user = CMSUser::getInstance();
        }
        else
        {
            $user = new CMSUser($this->userId);
        }

        if($user != null)
        {
            return array("{USER_NAME}" => $user->userName,
                "{USER_EMAIL}"=> $user->userEmail,
                "{USER_LOGIN}" => $user->loginName,
                "{USER_CONFIRMATION_LINK}" => "",   //TODO: Add method for generation
                "{USER_NEW_PASSWORD}" => "",        //TODO: Add method for generation
                "{USER_PASSWORD}" => request::getString("regPassword","POST",true));


        }

        return array();
    }

    public function getMaskName()
    {
        return WebText::getText("user_mask_group_name", "Користувач");
    }
}