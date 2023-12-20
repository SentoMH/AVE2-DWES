<?php

namespace AP\Controllers;

use AP\Entity\PedidosEntity;
use AP\Entity\ProductosEntity;
use AP\Entity\ProveedoresEntity;
use AP\Entity\LineasPedidosEntity;
use AP\Core\AbstractController;
use AP\Core\EntityManager;
use AP\Controllers\MainController;

class PedidosController extends AbstractController
{
    private EntityManager $em;
    private MainController $main;

    public function __construct()
    {
        $this->em = new EntityManager();
        parent::__construct();
        $this->main = new MainController();
    }

    public function pedidos(): void
    {
        $entityM = $this->em->getEntityManager();
        $pedidosRepository = $entityM->getRepository(PedidosEntity::class);
        $productosRepository = $entityM->getRepository(ProductosEntity::class);
        $lineasPedidoRepository = $entityM->getRepository(LineasPedidosEntity::class);
        $productos = $productosRepository->findAll();
        $mensajeExito = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'proveedor' => $_POST['idProveedor'],
                'detalles' => $_POST['detalles'],
                'productos' => $_POST['productos'],
            ];

            $pedido = $pedidosRepository->createPedido($data);

            $lineas = $lineasPedidoRepository->createLineaPedido($data['productos'], $pedido);

            
            if ($pedido) {
                $this->main->jsonResponse("crearPedido", "Pedido creado con éxito", 200);
                return; 
            } else {
                $this->main->jsonResponse("crearPedido", "Error al crear el pedido", 500);
                return; 
            }
        }

        $this->render("pedidos.html.twig", [
            'title' => 'Pedidos',
            'mensajeExito' => $mensajeExito,
            'productos' => $productos
        ]);
    }
}
