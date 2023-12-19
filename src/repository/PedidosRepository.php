<?php

namespace AP\Repository;

use Doctrine\ORM\EntityRepository;
use AP\Entity\PedidosEntity;
use AP\Entity\ProveedoresEntity;

class PedidosRepository extends EntityRepository
{
    public function createPedido($data)
    {
        dump($data);
        $pedido = new PedidosEntity();
        $proveedorRepository = $this->getEntityManager()->getRepository(ProveedoresEntity::class);

        $proveedor = $proveedorRepository->find($data['proveedor']);


        if (!$proveedor) {
            throw new \Exception('Proveedor no encontrado');
        }

        $pedido->setProveedor($proveedor);
        $pedido->setFecha(new \DateTime(date('Y-m-d H:i:s')));
        $pedido->setDetalles($data['detalles']);
        $pedido->setEstado(false);

        $this->getEntityManager()->persist($pedido);
        $this->getEntityManager()->flush();

        return $pedido;
    }
}
