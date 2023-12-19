<?php

namespace AP\Entity;

use AP\Repository\MesaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity(repositoryClass: MesaRepository::class)]
#[Table(name: "mesa")]
class MesaEntity
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'idMesa', type: 'integer')]
    private int $idMesa;

    #[Column(name: 'nombre', type: 'string', length: 50)]
    private string $nombre;

    #[Column(name: 'comensales', type: 'integer')]
    private int $comensales;

    #[OneToMany(mappedBy: 'mesa', targetEntity: ComandasEntity::class)]
    private Collection $comandas;

    public function __construct()
    {
        $this->comandas = new ArrayCollection();
    }

    /**
     * Get the value of idMesa
     */ 
    public function getIdMesa()
    {
        return $this->idMesa;
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
     * Get the value of comandas
     */ 
    public function getComandas()
    {
        return $this->comandas;
    }

    /**
     * Set the value of comandas
     *
     * @return  self
     */ 
    public function setComandas($comandas)
    {
        $this->comandas = $comandas;

        return $this;
    }
}
