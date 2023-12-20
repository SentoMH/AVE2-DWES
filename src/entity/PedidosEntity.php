<?php

namespace AP\Entity;

use AP\Repository\PedidosRepository;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use DateTime;
use JsonSerializable;


#[Entity(repositoryClass: PedidosRepository::class)]
#[Table(name: "pedidos")]
class PedidosEntity implements JsonSerializable
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'idPedidos', type: "integer")]
    private int $idPedidos;

    #[Column(name: 'fecha', type: "datetime")]
    private DateTime $fecha;

    #[Column(name: 'detalles', type: "string", length: 100, nullable: true)]
    private ?string $detalles;

    #[Column(name: 'estado', type: "boolean")]
    private bool $estado;

    #[ManyToOne(targetEntity: ProveedoresEntity::class, inversedBy: 'pedidos')]
    #[JoinColumn(name: 'idProveedor', referencedColumnName: 'idProveedor')]
    private ProveedoresEntity $proveedor;

    public function jsonSerialize() {
        return [
            'idPedidos' => $this->getIdPedidos(),
            'fecha' => $this->getFecha(),
            'detalles' => $this->getDetalles(),
            'estado' => $this->getEstado(),
            'idProveedor' => $this->proveedor
        ];
    }


    public function getIdPedidos()
    {
        return $this->idPedidos;
    }

    public function getFecha()
    {
        return $this->fecha;
    }


    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }


    public function getDetalles()
    {
        return $this->detalles;
    }


    public function setDetalles($detalles)
    {
        $this->detalles = $detalles;

        return $this;
    }


    public function getEstado()
    {
        return $this->estado;
    }


    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }


    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }
}
