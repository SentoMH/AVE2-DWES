<?php

namespace AP\Controllers;

use AP\Entity\ProductosEntity;
use AP\Core\AbstractController;
use AP\Core\EntityManager;
use AP\Entity\PedidosEntity;
use AP\Entity\LineasPedidosEntity;
use AP\Controllers\MainController;




class PedidosController extends AbstractController
{
    private EntityManager $em;
    private MainController $main;

    public function __construct()
    {
        $this->em = new EntityManager();
        $this->main = new MainController();
        parent::__construct();
    }

    public function pedidos(): void
    {
        $entityM = $this->em->getEntityManager();
        $productosRepository = $entityM->getRepository(ProductosEntity::class);
        $productos = $productosRepository->findAll();

        $this->render("pedidos.html.twig", [
            'title' => 'Pedidos',
            'productos' => $productos
        ]);
    }

    public function crearPedidos()
    {

        $entityM = $this->em->getEntityManager();
        $pedidosRepository = $entityM->getRepository(PedidosEntity::class);
        $lineasPedidoRepository = $entityM->getRepository(LineasPedidosEntity::class);
        $data = [];

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'POST') {
            $data = [
                'proveedor' => $_POST['idProveedor'],
                'detalles' => $_POST['detalles'],
                'productos' => $_POST['productos'],
            ];
        }
        if (empty($data)) {
            $msg = 'No se han recibido los parámetros correctos';
            $this->main->jsonResponse($method, $msg, 400);
        } else {
            $pedido = $pedidosRepository->createPedido($data);
            if (!$pedido) {
                $msg = 'No se ha podido crear el pedido';
                $this->main->jsonResponse("createPedido", $msg, 400);
            } else {
                $lineas = $lineasPedidoRepository->createLineaPedido($data['productos'], $pedido);
                if (!$lineas) {
                    $msg = 'No se ha podido crear el pedido';
                    $this->main->jsonResponse("createLineaPedido", $msg, 400);
                } else {
                    $result = [];
                    foreach ($lineas as $linea) {
                        if (isset($linea)) {
                            $result[] = $linea->jsonSerialize();
                        }
                    }
                    $msg = [
                        'message' => 'Se ha creado el pedido correctamente',
                        'lineas' => $result,
                    ];
                    $this->main->jsonResponse(null, $msg, 200);
                }
            }
        }
    }

    public function listarPedidos()
    {
        $entityM = $this->em->getEntityManager();
        $pedidosRepository = $entityM->getRepository(PedidosEntity::class);
        $pedidos = $pedidosRepository->findAll();
        $result = [];

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'POST') {

            foreach ($pedidos as $pedido) {
                if (isset($pedido)) {
                    $result[] = $pedido->jsonSerialize();
                }
            }
            $msg = [
                'message' => 'Se han listado los pedidos correctamente',
                'pedidos' => $result,
            ];
            $this->main->jsonResponse(null, $msg, 200);
        }
    }
}
