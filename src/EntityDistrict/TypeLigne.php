<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeLigne
 *
 * @ORM\Table(name="type_ligne")
 * @ORM\Entity
 */
class TypeLigne
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_type_lig", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeTypeLig;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_type_lig", type="string", length=100, nullable=false)
     */
    private $libelleTypeLig;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;


}
