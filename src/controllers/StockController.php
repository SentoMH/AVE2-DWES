<?php

namespace AP\Controllers;

use AP\Entity\StockEntity;
use AP\Core\AbstractController;
use AP\Core\EntityManager;

class StockController extends AbstractController
{
    private EntityManager $em;

    public function __construct()
    {
        $this->em = new EntityManager();
        parent::__construct();
    }

    public function stock(): void
    {
        $entityM = $this->em->getEntityManager();
        $stockRepository = $entityM->getRepository(StockEntity::class);

        $fecha = $_POST['fecha'] ?? null;

        if ($fecha) {
            $stocks = $stockRepository->findByDate($fecha);
        } else {
            $stocks = $stockRepository->findAll();
        }
        $this->render("stock.html.twig", [
            'title' => 'Stock',
            'stocks' => $stocks,
        ]);
    }
}
