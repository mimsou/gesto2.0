<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exercice
 *
 * @ORM\Table(name="exercice")
 * @ORM\Entity
 */
class Exercice
{
    /**
     * @var int
     *
     * @ORM\Column(name="exercice_code", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $exerciceCode;

    /**
     * @var int|null
     *
     * @ORM\Column(name="exercice_libelle", type="integer", nullable=true)
     */
    private $exerciceLibelle;

    /**
     * @var int|null
     *
     * @ORM\Column(name="exerciceetat", type="integer", nullable=true)
     */
    private $exerciceetat;


}
