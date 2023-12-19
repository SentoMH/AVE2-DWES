<?php

declare(strict_types=1);
require_once "../vendor/autoload.php";

use Dotenv\Dotenv;
use AP\Core\{Dispatcher, RouteCollection, Request};



//Lo primero que debemos hacer es cargar las variables de entorno con el DotEnv del archivo .env
$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

//Creamos un objeto que contenga todas las rutas de la aplicación.
$route = new RouteCollection();

//Creamos un objeto que contenga la ruta que hemos recibido desde el navegador.
$request = new Request();

//Ahora creamos un objeto que se encarga de redirigir al controller que corresponda la aplicación
$dispacher = new Dispatcher($route, $request);
