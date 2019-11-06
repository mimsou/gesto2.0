<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NatureVoyage
 *
 * @ORM\Table(name="nature_voyage")
 * @ORM\Entity
 */
class NatureVoyage
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_nat_voy", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeNatVoy;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_nat_voy", type="string", length=100, nullable=false)
     */
    private $libelleNatVoy;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;


}
