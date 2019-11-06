<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlageHoraire
 *
 * @ORM\Table(name="plage_horaire")
 * @ORM\Entity
 */
class PlageHoraire
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_hr", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeHr;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_hr", type="string", length=50, nullable=false)
     */
    private $libelleHr;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;


}
