<?php

namespace AP\Controllers;

use AP\Entity\ProductosEntity;
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
        $productosRepository = $entityM->getRepository(ProductosEntity::class);
        $productos = $productosRepository->findAll();

        $this->render("pedidos.html.twig", [
            'title' => 'Pedidos',
            'productos' => $productos
        ]);
    }
}
