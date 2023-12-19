<?php

namespace AP\Entity;

use AP\Repository\StockRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

#[Entity(repositoryClass: StockRepository::class)]
#[Table(name: "stock")]
class StockEntity
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'idStock', type: 'integer')]
    private int $idStock;

    #[Column(name: 'fecha', type: 'datetime')]
    private \DateTimeInterface $fecha;

    #[Column(name: 'cantidad', type: 'decimal', precision: 8, scale: 2)]
    private float $cantidad;

    #[ManyToOne(targetEntity: ProductosEntity::class)]
    #[JoinColumn(name: 'id_producto', referencedColumnName: 'idProducto')]
    private ProductosEntity $producto;

    public function getIdStock()
    {
        return $this->idStock;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
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
     * Get the value of producto
     */ 
    public function getProducto()
    {
        return $this->producto;
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
}