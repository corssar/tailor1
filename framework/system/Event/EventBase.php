<?php

abstract class EventBase
{
    public function getEventCode()
    {
        return $this->getEventClass();
    }

    public function getEventClass()
    {
        return get_class($this);
    }

    abstract public function getEventName();

    abstract public function getEventMasks();
} 