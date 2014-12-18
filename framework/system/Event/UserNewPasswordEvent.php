<?php

class UserNewPasswordEvent extends EventBase
{
    public $userId;
    function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    public function getEventName()
    {
        return WebText::getText("user_new_password_event_name", "Зміна пароля користувачем");
    }

    public function getEventMasks()
    {
        return array(new UserMask($this->userId), new SiteSettingMask());
    }
}