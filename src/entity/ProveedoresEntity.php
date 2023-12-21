<?php


namespace AP\Entity;

use AP\Repository\ProveedoresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use JsonSerializable;

#[Entity(repositoryClass: ProveedoresRepository::class)]
#[Table(name: "proveedores")]
class ProveedoresEntity implements JsonSerializable
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'idProveedor', type: "integer", length: 11)]
    private int $idProveedor;

    #[Column(name: 'nombre', type: "string", length: 255)]
    private string $nombreProveedor;

    #[Column(name: 'cif', type: "string", length: 9)]
    private string $cifProveedor;

    #[Column(name: 'direccion', type: "text")]
    private string $direccionProveedor;

    #[Column(name: 'telefono', type: "string", length: 11, nullable: true)]
    private ?int $telefonoProveedor;

    #[Column(name: 'email', type: "string", length: 100, nullable: true)]
    private ?string $emailProveedor;

    #[Column(name: 'contacto', type: "string", length: 100, nullable: true)]
    private ?string $contactoProveedor;

    #[OneToMany(mappedBy: "proveedor", targetEntity: PedidosEntity::class)]
    private Collection $pedidos;

    public function __construct()
    {
        $this->pedidos = new ArrayCollection();
    }
    public function jsonSerialize()
    {
        return [
            'idProveedor' => $this->getIdProveedor(),
            'nombreProveedor' => $this->getNombreProveedor(),
            'cifProveedor' => $this->getCifProveedor(),
            'direccionProveedor' => $this->getDireccionProveedor(),
            'telefonoProveedor' => $this->getTelefonoProveedor(),
            'emailProveedor' => $this->getEmailProveedor(),
            'contactoProveedor' => $this->getContactoProveedor(),
            'pedidos' => $this->getPedidos()
        ];
    }


    public function getIdProveedor()
    {
        return $this->idProveedor;
    }

    public function getNombreProveedor()
    {
        return $this->nombreProveedor;
    }


    public function setNombreProveedor($nombreProveedor)
    {
        $this->nombreProveedor = $nombreProveedor;

        return $this;
    }

    public function getCifProveedor()
    {
        return $this->cifProveedor;
    }


    public function setCifProveedor($cifProveedor)
    {
        $this->cifProveedor = $cifProveedor;

        return $this;
    }

    public function getDireccionProveedor()
    {
        return $this->direccionProveedor;
    }

    public function setDireccionProveedor($direccionProveedor)
    {
        $this->direccionProveedor = $direccionProveedor;

        return $this;
    }

    public function getTelefonoProveedor()
    {
        return $this->telefonoProveedor;
    }


    public function setTelefonoProveedor($telefonoProveedor)
    {
        $this->telefonoProveedor = $telefonoProveedor;

        return $this;
    }


    public function getEmailProveedor()
    {
        return $this->emailProveedor;
    }


    public function setEmailProveedor($emailProveedor)
    {
        $this->emailProveedor = $emailProveedor;

        return $this;
    }


    public function getPedidos()
    {
        return $this->pedidos;
    }


    public function setPedidos($pedidos)
    {
        $this->pedidos = $pedidos;

        return $this;
    }

    public function getContactoProveedor()
    {
        return $this->contactoProveedor;
    }

    public function setContactoProveedor($contactoProveedor)
    {
        $this->contactoProveedor = $contactoProveedor;

        return $this;
    }
}
