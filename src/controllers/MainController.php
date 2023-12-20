<?php

namespace AP\Controllers;

use AP\Core\AbstractController;


class MainController extends AbstractController
{
    public function main(): void
    {
        $this->render("layout.html.twig", []);
    }

    /*    $method: Una cadena que representa el método o la acción que se ejecutó. Por ejemplo, podría ser "crearPedido" o "obtenerDatos".
    $msg: Un mensaje que se desea enviar en la respuesta. Por ejemplo, podría ser "Pedido creado con éxito" o "Error al procesar la solicitud".
    $status: Un código de estado HTTP. Los códigos de estado HTTP son estándar en la web y comunican el resultado de la solicitud (por ejemplo, 200 para éxito, 400 para solicitud incorrecta, 500 para error interno del servidor, etc.).*/

    public function jsonResponse(?string $method, ?string $msg, ?int $status): void
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
            $arrayJson = array(// El array se codifica en un string JSON usando json_encode. Luego, se utiliza echo para enviar este JSON como la respuesta del servidor.
                'result' => $result,
                'method' => $method
            );
        }
        $json = json_encode($arrayJson, http_response_code($status));

        echo $json;
    }
}
