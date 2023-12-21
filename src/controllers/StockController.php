<?php

namespace AP\Controllers;

use AP\Entity\StockEntity;
use AP\Core\AbstractController;
use AP\Core\EntityManager;
use DateTime;

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
        $allStocks = $stockRepository->findAll();

        $dateTime = new DateTime();
        $stocksToShow = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fecha'])) {

            $date = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['fecha']);
            if ($date) {
                $stocksToShow = $stockRepository->findByDate($allStocks, $date->format('Y-m-d H:i:s'));
            }
        } else {

            $stocksToShow = $stockRepository->lastStock($allStocks, $dateTime->format('Y-m-d H:i:s'));
        }

        $this->render("stock.html.twig", [
            'title' => 'Stock',
            'fecha' => $dateTime->format('Y-m-d H:i:s'),
            'stocks' => $stocksToShow
        ]);
    }
}
