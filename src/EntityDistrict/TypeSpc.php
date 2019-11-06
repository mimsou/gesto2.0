<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeSpc
 *
 * @ORM\Table(name="type_spc")
 * @ORM\Entity
 */
class TypeSpc
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_spc", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeSpc;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_spc", type="string", length=100, nullable=false)
     */
    private $libelleSpc;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;


}
