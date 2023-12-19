<?php

namespace AP\Controllers;

use AP\Entity\PedidosEntity;
use AP\Entity\ProductosEntity;
use AP\Entity\ProveedoresEntity;
use AP\Repository\LineasPedidoRepository;
use AP\Core\AbstractController;
use AP\Core\EntityManager;

class PedidosController extends AbstractController
{
    private EntityManager $em;

    public function __construct()
    {
        $this->em = new EntityManager();
        parent::__construct();
    }

    public function pedidos(): void
    {
        $entityM = $this->em->getEntityManager();
        $pedidosRepository = $entityM->getRepository(PedidosEntity::class);
        $productosRepository = $entityM->getRepository(ProductosEntity::class);
        $productos = $productosRepository->findAll();
        $mensajeExito = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'proveedor' => $_POST['idProveedor'],
                'detalles' => $_POST['detalles'],
                'productos' => $_POST['productos'][1],
            ];

            $pedido = $pedidosRepository->createPedido($data);
            $linea = $lineaPedidoRepository->createLineaPedido($data);


            if ($pedido) {

                $mensajeExito = 'El pedido ha sido creado con éxito.';
            }else{
                $mensajeExito = 'El pedido no ha sido creado.';
            }
        }

        $this->render("pedidos.html.twig", [
            'title' => 'Pedidos',
            'mensajeExito' => $mensajeExito,
            'productos' => $productos
        ]);
    }
}
