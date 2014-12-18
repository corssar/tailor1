<?php

class AutoLoader
{
    static protected $_paths = array();
    static protected $_classMap = array();

    static public function registerPath($path)
    {
        if(!in_array($path , self::$_paths))
            self::$_paths[] = $path;
    }

    public static function load($class)
    {
        if(!empty(self::$_classMap) && array_key_exists($class,self::$_classMap[$class])){
            require self::$_classMap[$class];
            return true;
        }

        $file = implode(DIRECTORY_SEPARATOR , array_map('ucfirst',explode('_', $class))) . '.php';

        foreach(self::$_paths as $path){
            if(file_exists($path . DIRECTORY_SEPARATOR . $file)){
                include $path . DIRECTORY_SEPARATOR . $file;
                return true;
            }
        }
        return false;
    }

    static public function loadMap($path)
    {
        if(!file_exists($path)){
            self::$_classMap =  array();
            return;
        }
        self::$_classMap = include($path);
    }
}