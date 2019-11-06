<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Degat
 *
 * @ORM\Table(name="degat")
 * @ORM\Entity
 */
class Degat
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_degat", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeDegat;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=10, nullable=false)
     */
    private $libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;


}
