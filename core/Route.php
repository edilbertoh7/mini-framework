<?php

namespace Core;

class Routes
{
    private static $group = "";
    private static $params = [];

    public static function get($path, $class)
    {
        self::$params[] = [
            "path" => self::$group.$path,
            "http"=> "GET",
            "class" => $class,
        ];
    }

    public static function post($path, $class)
    {
        self::$params[] = [
            "path" => self::$group.$path,
            "http"=> "POST",
            "class" => $class,
        ];
    }
    
    public static function put($path, $class)
    {
        self::$params[] = [
            "path" => self::$group.$path,
            "http"=> "PUT",
            "class" => $class,
        ];
    }
    public static function delete($path, $class)
    {
        self::$params[] = [
            "path" => self::$group.$path,
            "http"=> "delete",
            "class" => $class,
        ];
    }

    //productos
    // /ID=>productos/ID
    // /NOMBRE=>productos/NOMBRE


    public static function group($path, $class)
    {
        self::$group=$path;
        return $class();
    }

    public static function getRoutes(){
        return self::$params;
    }

   public static function Route($method, $url, $class){
        $REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
        if ($REQUEST_METHOD == $method ) {
            return Routes::get($url, $class);
        }
        if ($REQUEST_METHOD == $method ) {
            return Routes::get($url, $class);
        }
        if ($REQUEST_METHOD == $method ) {
            return Routes::get($url, $class);
        }
        if ($REQUEST_METHOD == $method ) {
            return Routes::get($url, $class);
        }
    }



}


