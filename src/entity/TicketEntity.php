<?php

namespace AP\Entity;

use AP\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use DateTime;

#[Entity(repositoryClass: TicketRepository::class)]
#[Table(name: "tickets")]
class TicketEntity
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'idTicket', type: 'integer')]
    private int $idTicket;

    #[Column(name: 'fecha', type: 'datetime')]
    private DateTime $fecha;

    #[ManyToOne(targetEntity: ComandasEntity::class)]
    #[JoinColumn(name: 'idComanda', referencedColumnName: 'idComanda')]
    private ComandasEntity $comanda;

    #[Column(name: 'importe', type: 'decimal', precision: 10, scale: 2)]
    private float $importe;

    #[Column(name: 'pagado', type: 'boolean')]
    private bool $pagado;

    public function __construct()
    {
        // Aquí puedes inicializar valores por defecto si lo necesitas
    }

    // Implementación de los getters y setters...
}
