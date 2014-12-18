<?php

class UserRegistrationEvent extends EventBase
{
    public $userId;
    function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    public function getEventName()
    {
        return WebText::getText("user_registration_event_name", "Реєстрація користувача");
    }

    public function getEventMasks()
    {
        return array(new UserMask($this->userId), new SiteSettingMask());
    }
}