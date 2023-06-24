<?php
include_once './env.php';
//include_once './core/Conex.php';
include_once './core/Request.php';
include_once './core/Route.php';
include_once './core/utils.php';
include_once './core/App.php';
include_once './core/Model.php';
include_once './app/model/Persona.php';
include_once './app/model/Categorias.php';

include_once './app/Controller/MainController.php';
include_once './app/Controller/ProductoController.php';
include_once './app/Controller/CategoriaController.php';
include_once './routes/web.php';
use Core\Routes;


$request = new Request();
App::assets($request->getPublicUrl());
//echo App::getPath();
$routes = Routes::getRoutes();
$url = $request->getUrl();
$request->validate($routes,$url);

//avenida primera 25-41
?>  