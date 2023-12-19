<?php

namespace AP\Entity;

use AP\Repository\LineasComandasRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

#[Entity(repositoryClass: LineasComandasRepository::class)]
#[Table(name: "lineascomandas")]
class LineasComandasEntity
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'idlinea', type: 'integer')]
    private int $idlinea;

    #[Column(name: 'cantidad', type: 'decimal', precision: 8, scale: 2)]
    private float $cantidad;

    #[Column(name: 'entregado', type: 'boolean')]
    private bool $entregado;

    #[ManyToOne(targetEntity: ComandasEntity::class, inversedBy: 'lineasComandas')]
    #[JoinColumn(name: 'idComanda', referencedColumnName: 'idComanda')]
    private ComandasEntity $comanda;

    #[ManyToOne(targetEntity: ProductosEntity::class)]
    #[JoinColumn(name: 'idProducto', referencedColumnName: 'idProducto')]
    private ProductosEntity $producto;



    /**
     * Get the value of idlinea
     */ 
    public function getIdlinea()
    {
        return $this->idlinea;
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
     * Get the value of comanda
     */ 
    public function getComanda()
    {
        return $this->comanda;
    }

    /**
     * Set the value of comanda
     *
     * @return  self
     */ 
    public function setComanda($comanda)
    {
        $this->comanda = $comanda;

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
