<?php
use Core\Route;
use Core\Routes;

Routes::get('/', function(){
    return [
        'status' => 404,
        'message' => 'Bienvenido a la API de productos'
    ];
});
Routes::get('/api/{id}', "ProductoController@index");
Routes::get('/categoria/{id}', function($route){
    return $route['id'];
});


//productos
Routes::Route("GET", '/producto', "MainController@index");
Routes::Route('GET', '/producto/{id}', "MainController@show");

Routes::Route('POST', '/producto', "MainController@store");
Routes::Route('PUT', '/producto/{id}', "MainController@update");
Routes::Route('DELETE', '/producto/{id}', "MainController@destroy");
//categorias
Routes::Route('GET', '/categoria', "CategoriaController@index");
Routes::Route('GET', '/categoria/{id}', "CategoriaController@show");

//creo grupos de rutas
Routes::group('/persona', function(){
    Routes::get('/id', function(){
        return view('index');
    });
    Routes::get('/nombre/{name}', function($route){
        $miarray = [
            "name" => $route['name'],
            "apellido" => "Gonzalez",
            "edad" => 25,
            "casa" => 2,
            "arreglo" => [
                "nombre2" => "juan",
                "apellido2" => "perez",
                "edad2" => 55,
                "casa2" => 55,
            ]
        ];
        $casa = 2;
        $user_agent = $_SERVER["HTTP_USER_AGENT"];
        $array_agent = explode('/', $user_agent);
       $agent = $array_agent[0];
       //https://parzibyte.me/blog/2019/07/24/php-obtener-navegador-web-informacion-usuario/

        if ( $agent == "PostmanRuntime" ) {
             return  $miarray;

        }
        
        return view("producto.index", $miarray);
    });
   
});
