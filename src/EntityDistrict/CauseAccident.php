<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CauseAccident
 *
 * @ORM\Table(name="cause_accident")
 * @ORM\Entity
 */
class CauseAccident
{
    /**
     * @var int
     *
     * @ORM\Column(name="code_cause_acc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeCauseAcc;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=200, nullable=false)
     */
    private $libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;


}
