<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NatureLigne
 *
 * @ORM\Table(name="nature_ligne")
 * @ORM\Entity
 */
class NatureLigne
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_nature_ligne", type="string", length=5, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeNatureLigne;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_nature_ligne", type="string", length=100, nullable=false)
     */
    private $libelleNatureLigne;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;


}
