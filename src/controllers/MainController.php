<?php

namespace AP\Controllers;

use AP\Core\AbstractController;




class MainController extends AbstractController
{

    public function main(): void
    {
        $this->render("layout.html.twig", []);
    }

    public function jsonResponse($method, $msg, $status)
    {
        if (is_null($status)) {
            $status = 400; //solicitud incorrecta si el status es null
        }

        if (is_null($msg)) {
            $result = 'Petición inválida realizada: ' . date("d-m-Y-H-i-s");
        } else {
            $result = $msg; //mensaje de confirmación que deberemos definir en los controladores correspondientes
        }

        if (is_null($method)) { //Se crea un array asociativo $arrayJson que incluye el mensaje de respuesta. Si se proporcionó $method, también se incluye en este array.
            $arrayJson = array(
                'result' => $result
            );
        } else {
            $arrayJson = array( // El array se codifica en un string JSON usando json_encode. Luego, se utiliza echo para enviar este JSON como la respuesta del servidor.
                'result' => $result,
                'method' => $method
            );
        }
        $json = json_encode($arrayJson, http_response_code($status));

        echo $json;
    }

}
