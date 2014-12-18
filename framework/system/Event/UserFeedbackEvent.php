<?php

class UserFeedbackEvent extends EventBase
{
    protected $userId;
    function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    public function getEventName()
    {
        return WebText::getText("user_feedback_event_name", "Контакты");
    }

    public function getEventMasks()
    {
        return array(new UserMask($this->userId), new SiteSettingMask());
    }
}

