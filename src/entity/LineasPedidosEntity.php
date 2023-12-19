<?php

namespace AP\Entity;

use AP\Repository\LineasPedidosRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

#[Entity(repositoryClass: LineasPedidosRepository::class)]
#[Table(name: "lineaspedidos")]
class LineasPedidosEntity
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'idlinea', type: 'integer')]
    private int $idLinea;

    #[ManyToOne(targetEntity: PedidosEntity::class, inversedBy: 'lineasPedidos')]
    #[JoinColumn(name: 'idPedido', referencedColumnName: 'idPedidos')]
    private PedidosEntity $pedido;

    #[ManyToOne(targetEntity: ProductosEntity::class, inversedBy: 'lineasPedidos')]
    #[JoinColumn(name: 'idProducto', referencedColumnName: 'idProducto')]
    private ProductosEntity $producto;

    #[Column(name: 'cantidad', type: 'decimal', precision: 8, scale: 2)]
    private float $cantidad;

    #[Column(name: 'entregado', type: 'boolean')]
    private bool $entregado;

    /**
     * Get the value of idLinea
     */ 
    public function getIdLinea()
    {
        return $this->idLinea;
    }

    /**
     * Set the value of pedido
     *
     * @return  self
     */ 
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Set the value of producto
     *
     * @return  self
     */ 
    public function setProducto($producto)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get the value of producto
     */ 
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get the value of entregado
     */ 
    public function getEntregado()
    {
        return $this->entregado;
    }

    /**
     * Set the value of entregado
     *
     * @return  self
     */ 
    public function setEntregado($entregado)
    {
        $this->entregado = $entregado;

        return $this;
    }

    /**
     * Get the value of pedido
     */ 
    public function getPedido()
    {
        return $this->pedido;
    }
}
