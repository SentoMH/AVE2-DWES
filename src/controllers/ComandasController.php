<?php

namespace AP\Controllers;

use AP\Core\AbstractController;
use AP\Core\EntityManager;
use AP\Entity\ComandasEntity;
use AP\Entity\LineasComandasEntity;
use AP\Entity\ProductosEntity;
use AP\Controllers\MainController;
use AP\Entity\MesaEntity;

class ComandasController extends AbstractController
{

    private EntityManager $em;
    private MainController $main;

    public function __construct()
    {
        $this->em = new EntityManager();
        $this->main = new MainController();
        parent::__construct();
    }

    public function createComanda(): void
    {

        $entityM = $this->em->getEntityManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true);
        }
        if ($data) {
            $comanda = new ComandasEntity();
            $mesa = $entityM->getRepository(MesaEntity::class)->find($data['mesa']);
            if (!$mesa) {
                $msg = 'Mesa no encontrada: ' . $data['mesa'];
                $this->main->jsonResponse('POST', $msg, 400);
                return;
            }
            if ($data['comensales'] > $mesa->getComensales()) {
                $msg = 'Número de comensales excede la capacidad de la mesa';
                $this->main->jsonResponse('POST', $msg, 400);
                return;
            }

            $comanda->setMesa($mesa);
            $comanda->setComensales($data['comensales']);
            $comanda->setDetalles($data['detalles']);
            $comanda->setFecha(new \DateTime($data['fecha']));
            $comanda->setEstado(true);

            foreach ($data['lineas'] as $linea) {
                $producto = $entityM->getRepository(ProductosEntity::class)->find($linea['producto']);
                if (!$producto) {
                    $msg = 'Producto no encontrado: ' . $linea['producto'];
                    $this->main->jsonResponse('POST', $msg, 400);
                    return;
                }
                $lineaComanda = new LineasComandasEntity();
                $lineaComanda->setProducto($producto);
                $lineaComanda->setCantidad($linea['cantidad']);
                $lineaComanda->setComanda($comanda);
                $lineaComanda->setEntregado(false);
                $entityM->persist($lineaComanda);
            }

            $entityM->persist($comanda);
            $entityM->flush();
            $msg = 'Comanda creada con éxito';
            $this->main->jsonResponse('POST', $msg, 200);
        } else {
            $msg = 'Error al crear la comanda';
            $this->main->jsonResponse('POST', $msg, 400);
            return;
        }
    }
}
