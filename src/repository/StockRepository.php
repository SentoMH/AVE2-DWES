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

        //iteramos sobre todos los registros de stock.
        foreach ($stocks as $stock) {
            //obtenemos la fecha del registro de stock.
            $stockDate = $stock->getFecha();
            //obtenemos el id del producto del registro de stock.
            $idProducto = $stock->getProducto()->getIdProducto();
            //si la fecha del registro de stock es menor o igual a la fecha actual.
            if ($stockDate <= $actualDate) {
                //si no existe el producto en el array de productos...
                if (!isset($closestStocks[$idProducto])) {
                    //añadimos el registro de stock al array de productos.
                    $closestStocks[$idProducto] = $stock;
                } else {
                    //si el registro de stock ya existe en el array de productos...
                    $existingStockDate = $closestStocks[$idProducto]->getFecha();
                    //y si la fecha del registro de stock es mayor a la fecha del registro de stock que ya existe en el array de productos...
                    if ($stockDate > $existingStockDate) {
                        //sustituimos el registro de stock que ya existe en el array de productos por el nuevo registro de stock.
                        $closestStocks[$idProducto] = $stock;
                    }
                }
            }
        }
        return array_values($closestStocks);
    }

    public function lastStock($stocks, $fecha)
    {
        $lastStock = [];
        foreach ($stocks as $stock) {
            if ($stock->getFecha() <= new DateTime($fecha)) {

                $producto = $stock->getProducto();
                $idProducto = $producto->getIdProducto();

                if (!isset($lastStock[$idProducto]) || $lastStock[$idProducto]->getFecha() < $stock->getFecha()) {
                    $lastStock[$idProducto] = $stock;
                }
            }
        }
        return $lastStock;
    }
}
