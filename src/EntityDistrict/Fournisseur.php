<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur", indexes={@ORM\Index(name="fk_fournisseur_step1_idx", columns={"fournisseur_etat"})})
 * @ORM\Entity
 */
class Fournisseur
{
    /**
     * @var string
     *
     * @ORM\Column(name="fournisseur_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fournisseurCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fournisseur_libelle", type="string", length=100, nullable=true)
     */
    private $fournisseurLibelle;

    /**
     * @var int|null
     *
     * @ORM\Column(name="fournisseur_etat", type="integer", nullable=true)
     */
    private $fournisseurEtat;


}
