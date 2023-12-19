<?php

namespace AP\Entity;

use AP\Repository\ProductosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity(repositoryClass: ProductosRepository::class)]
#[Table(name: "productos")]
class ProductosEntity
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'idProducto', type: 'integer')]
    private int $idProducto;

    #[Column(name: 'nombre', type: 'string', length: 50)]
    private string $nombre;

    #[Column(name: 'descripcion', type: 'string', length: 100, nullable: true)]
    private ?string $descripcion;

    #[Column(name: 'precio', type: 'decimal', precision: 8, scale: 2)]
    private float $precio;

    #[OneToMany(mappedBy: 'producto', targetEntity: LineasPedidosEntity::class)]
    private Collection $lineasPedidos;

    #[OneToMany(mappedBy: 'producto', targetEntity: LineasComandasEntity::class)]
    private Collection $lineasComandas;

    public function __construct()
    {
        $this->lineasPedidos = new ArrayCollection();
        $this->lineasComandas = new ArrayCollection();
    }

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of lineasPedidos
     */ 
    public function getLineasPedidos()
    {
        return $this->lineasPedidos;
    }

    /**
     * Set the value of lineasPedidos
     *
     * @return  self
     */ 
    public function setLineasPedidos($lineasPedidos)
    {
        $this->lineasPedidos = $lineasPedidos;

        return $this;
    }

    /**
     * Get the value of lineasComandas
     */ 
    public function getLineasComandas()
    {
        return $this->lineasComandas;
    }

    /**
     * Set the value of lineasComandas
     *
     * @return  self
     */ 
    public function setLineasComandas($lineasComandas)
    {
        $this->lineasComandas = $lineasComandas;

        return $this;
    }
}

