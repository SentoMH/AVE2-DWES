<?php

namespace AP\Entity;

use AP\Repository\ComandasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

#[Entity(repositoryClass: ComandasRepository::class)]
#[Table(name: "comandas")]
class ComandasEntity
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'idComanda', type: 'integer')]
    private int $idComanda;

    #[Column(name: 'fecha', type: 'datetime')]
    private \DateTime $fecha;

    #[Column(name: 'comensales', type: 'integer')]
    private int $comensales;

    #[Column(name: 'detalles', type: 'string', length: 250, nullable: true)]
    private ?string $detalles;

    #[Column(name: 'estado', type: 'boolean')]
    private bool $estado;

    #[ManyToOne(targetEntity: MesaEntity::class, inversedBy: 'comandas')]
    #[JoinColumn(name: 'idMesa', referencedColumnName: 'idMesa')]
    private MesaEntity $mesa;

    #[OneToMany(mappedBy: 'comanda', targetEntity: LineasComandasEntity::class)]
    private Collection $lineasComandas;

    public function __construct()
    {
        $this->lineasComandas = new ArrayCollection();
    }

    /**
     * Get the value of idComanda
     */ 
    public function getIdComanda()
    {
        return $this->idComanda;
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
     * Get the value of comensales
     */ 
    public function getComensales()
    {
        return $this->comensales;
    }

    /**
     * Set the value of comensales
     *
     * @return  self
     */ 
    public function setComensales($comensales)
    {
        $this->comensales = $comensales;

        return $this;
    }

    /**
     * Get the value of detalles
     */ 
    public function getDetalles()
    {
        return $this->detalles;
    }

    /**
     * Set the value of detalles
     *
     * @return  self
     */ 
    public function setDetalles($detalles)
    {
        $this->detalles = $detalles;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of mesa
     */ 
    public function getMesa()
    {
        return $this->mesa;
    }

    /**
     * Set the value of mesa
     *
     * @return  self
     */ 
    public function setMesa($mesa)
    {
        $this->mesa = $mesa;

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
