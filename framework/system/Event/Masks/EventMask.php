<?php

abstract class EventMask
{
    abstract public function getMask();

    abstract public function replaceMask();

    abstract public function getMaskName();
} 