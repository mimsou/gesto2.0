<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solde
 *
 * @ORM\Table(name="solde", indexes={@ORM\Index(name="IDX_66918367E418C74D", columns={"exercice"})})
 * @ORM\Entity
 */
class Solde
{
    /**
     * @var string
     *
     * @ORM\Column(name="crb_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $crbCode;

    /**
     * @var float|null
     *
     * @ORM\Column(name="solde", type="float", precision=10, scale=0, nullable=true)
     */
    private $solde;

    /**
     * @var \Exercice
     *
     * @ORM\ManyToOne(targetEntity="Exercice")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="exercice", referencedColumnName="exercice_code")
     * })
     */
    private $exercice;


}
