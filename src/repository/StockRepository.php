<?php

namespace AP\Repository;

use Doctrine\ORM\EntityRepository;
use DateTime;

class StockRepository extends EntityRepository
{
    // En StockRepository
    public function findByDate($stocks, $date)
    {

        $closestStocks = [];
        $actualDate = new DateTime($date);

        foreach ($stocks as $stock) {
            $stockDate = $stock->getFecha();
            $idProducto = $stock->getProducto()->getIdProducto();
            if ($stockDate <= $actualDate) {
                if (!isset($closestStocks[$idProducto])) {
                    $closestStocks[$idProducto] = $stock;
                } else {
                    $existingStockDate = $closestStocks[$idProducto]->getFecha();
                    if ($stockDate > $existingStockDate) {
                        $closestStocks[$idProducto] = $stock;
                    }
                }
            }
        }

        return array_values($closestStocks);
    }

    public function lastStock($stocks, $fecha)
    {
        $filteredStocks = [];
        foreach ($stocks as $stock) {
            if ($stock->getFecha() <= new DateTime($fecha)) {

                $producto = $stock->getProducto();
                $idProducto = $producto->getIdProducto();

                if (!isset($filteredStocks[$idProducto]) || $filteredStocks[$idProducto]->getFecha() < $stock->getFecha()) {
                    $filteredStocks[$idProducto] = $stock;
                }
            }
        }
        return $filteredStocks;
    }
}
