<?php

use Request as GlobalRequest;

class Request
{
    private static $php_self = "";
    private static $request_uri = "";
    private static $script_filename = "";
    private static $document_root = "";

    function __construct()
    {


        //asigno la propiedad del metodo global de server
        self::$php_self = $_SERVER['PHP_SELF'];
        self::$request_uri = $_SERVER['REQUEST_URI'];
        self::$script_filename = $_SERVER['SCRIPT_FILENAME'];
        self::$document_root = $_SERVER['DOCUMENT_ROOT'];
        /*  echo $_SERVER['PHP_SELF'];
        echo "<br>";
        /*echo $_SERVER['REQUEST_URI'];
        echo "<br>";
        echo $_SERVER['SCRIPT_FILENAME'];
        echo "<br>";
        echo $_SERVER['DOCUMENT_ROOT '];
        echo "<br>";*/
    }

    public static function getUrl()
    {
        $path_origin = self::$script_filename;
        $path_main = self::$document_root . self::$php_self;

        //solo muestra la url actual eliminando el path
        $request_url = str_replace($path_origin, '', $path_main);
        //muestra la ruta actual o el index en caso de no haber ninguna otra ruta
        return empty($request_url) ? '/' : $request_url;
    }
    // metodo para retornar la url publica
    public static function getPublicUrl()
    {
        $path_origin = self::$script_filename;
        $request_uri = self::$request_uri;
        $path_main = self::$document_root . self::$php_self;
        $request_url = str_replace($path_origin, '', $path_main);
        $public_path = str_replace($request_url, '', $request_uri);
        return $public_path;
    }

    public static function validate($routes, $rl)
    {
        foreach ($routes as $route) {
            $regex_route = preg_replace_callback(
                '/{([^}]+)}/',
                function ($matches) {
                    return "(?P<" . $matches[1] . ">[^/]+)";
                },
                $route['path']
            );
            $regex_route = str_replace('/', '\/', $regex_route);
            $regex_route = '/^' . $regex_route . '$/';
            /* hago la comparacion para saber si la ruta escrita 
            en el navegador esta creada en la aplicacion*/
            if (preg_match($regex_route, $rl, $matches)) {

                $params = [];
                foreach ($matches as $key => $value) {
                    $params[$key] = $value;
                }
                unset($params[0]); //elimino el primer elemento del array para solo ver los parametros enviados por url
                // print_r($params);
                //verifica si el parametro class es un string para hacer el llamado al controlador
                if (is_string($route['class'])) {
                    $route_class = $route['class'];
                    $array_class = explode('@', $route_class);
                    if (!strpos($route_class, '@')) { //validaq si existe el @ en la ruta
                        header('Content-Type: application/json');
                        echo  json_encode("no existe un nombre de controlador o metodo validos");

                        die();
                    }
                    // si el controlador o el metodo no existen se lanza una excepcion
                    try {
                        if (!class_exists($array_class[0])) {
                            header('Content-Type: application/json');
                            throw new Exception(json_encode("El controlador $array_class[0] no existe"));
                        }
                        if (!method_exists($array_class[0], $array_class[1])) {
                            header('Content-Type: application/json');
                            throw new Exception(json_encode("El metodo $array_class[1] no existe"));
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        die();
                    }
                    $controller = new $array_class[0](); //estraigo el nombre del controlador
                    $method = $array_class[1]; //extraigo el nombre del metodo
                    $response = $controller->$method(...array_values($params)); //recivo el return del metodo
                    //
                    //print_r($response);
                    if (is_array($response) || $response != 1) {

                        Request::isArrayValidate($response);
                    }
                }
                //verifica si el parametro class es una funcion desde route
                if (is_callable($route['class'])) {
                    //recibe la respuesta de la funcion
                    $response = $route['class']($params);
                    // print_r($response);
                    //valido si la respuesta es es o no un un array   
                    if (is_array($response) || $response != 1) {
                    Request::isArrayValidate($response);
                    }              
                }
            }
        }

        //   echo "404";
        return "404";
    }

    public static function isArrayValidate($response)
    {
        if (is_array($response)) { //api
            //echo "if";
            $response = json_encode($response);
            header('Content-Type: application/json');
            echo $response;
            return false;
        } else {
            //echo "else";
            // header('Content-Type: application/json');
            echo $response;
            return $response;
        }
    }
}

