<?php

namespace AP\Repository;

use Doctrine\ORM\EntityRepository;

class StockRepository extends EntityRepository
{
    public function findByDate($fecha)
    {
        $stocks = $this->findAll();
        $stocksEnFecha = [];

        foreach ($stocks as $stock) {
            if ($stock->getFecha()->format('Y-m-d') == $fecha) {
                $stocksEnFecha[] = $stock;
            }
        }

        return $stocksEnFecha;
    }
}

