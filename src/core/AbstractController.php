<?php

declare(strict_types=1);

namespace AP\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Clase abstracta que nos permite extender de ella para crear cualquier controller en nuestra aplicación.
 * Es nuestro controlador padre.
 */
abstract class AbstractController
{

    private Environment $twigEnvironment;



    public function __construct()
    {

        $loader = new FilesystemLoader(__DIR__ . "../../../" . $_ENV["TEMPLATESFOLDER"]);
        $this->twigEnvironment = new Environment($loader);
    }

    /**
     * Método que simplifica el renderizado de twig que podemos usar en cualquier controller que extienda esta clase
     * abstracta. Gracias a este método reutilizamos el código en cada uno de los controladores.
     * @param string $template
     * @param array $params
     * @return void
     */
    public function render(string $template, array $params): void
    {

        echo $this->twigEnvironment->render($template, $params);
    }
}
