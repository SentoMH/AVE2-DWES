<?php

declare(strict_types=1);

namespace AP\Core;


use AP\Core\Interfaces\IRequest;
use AP\Core\Interfaces\IRoute;


class Dispatcher
{

    private array $routeList;
    private IRequest $currentRequest;
    private string $appFolder;

    /**
     * Para poder crear un objeto Dispatcher debemos enviar las rutas de la aplicación y la URI del navegador
     * para que el dispatcher puéda redirigir al lugar controller correcto con los parámetros adecuados.
     * además tenemos que recibir el contenedor que nos ayuda con la Inyección de dependencias que usaremos con PHP-DI.

     * @param IRoute $routeCollection
     * @param IRequest $request
     */
    public function __construct(IRoute $routeCollection, IRequest $request)
    {
        $this->routeList = $routeCollection->getRoutes();
        $this->currentRequest = $request;
        $this->appFolder = $_ENV['APP_FOLDER'];
        $this->dispatch();
    }

    /**
     * El cerebro de nuestra aplicación, se encarga de lanzar el controlador adecuado para cada ruta solicitada
     * @return void
     */
    private function dispatch(): void
    {
        //Verificamos que la ruta que hemos recibido está dentro de las rutás de la aplicación
        if (isset($this->routeList[$this->currentRequest->getRoute()])) {
            //Aquí dentro tenemos un texto del tipo AP2\Controller\DetalleController
            $controllerClass = $this->appFolder . "\\Controllers\\" . $this->routeList[$this->currentRequest->getRoute()]["controller"];
           //var_dump($controllerClass);
            $action = $this->routeList[$this->currentRequest->getRoute()]["action"];
        } else {

            $controllerClass = $this->appFolder . "\\Controllers\\NoRuta";
            //var_dump($controllerClass);
            $action = "noRuta";
        }

        if (!is_null($this->currentRequest->getParams())) {
            $params = $this->currentRequest->getParams();
        } else {

            $params = null;
        }

        $controller = new $controllerClass();
        $controller->$action(...$params);
    }
}
