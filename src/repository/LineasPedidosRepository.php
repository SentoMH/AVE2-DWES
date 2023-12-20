<?php

declare(strict_types=1);

namespace AP\Repository;

use Doctrine\ORM\EntityRepository;
use AP\Entity\PedidosEntity;
use AP\Entity\ProductosEntity;
use AP\Entity\LineasPedidosEntity;


class LineasPedidosRepository extends EntityRepository
{
    public function createLineaPedido($dataProductos, $pedido)
    {
        $lineasPedido = [];
        foreach ($dataProductos as $key => $value) {
            if ($value['producto'] != "") {
                $lineaPedido = new LineasPedidosEntity();
                $lineaPedido->setPedido($pedido);
                $producto = $this->getEntityManager()->getRepository(ProductosEntity::class)->find($value['producto']);
                $lineaPedido->setProducto($producto);
                $lineaPedido->setCantidad($value['cantidad']);
                $lineaPedido->setEntregado(false);
                $this->getEntityManager()->persist($lineaPedido);
                $this->getEntityManager()->flush();
                $lineasPedido[] = $lineaPedido;
            }
        }
        return $lineasPedido;
    }
}
