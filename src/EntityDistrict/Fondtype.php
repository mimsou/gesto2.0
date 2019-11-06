<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fondtype
 *
 * @ORM\Table(name="fondtype")
 * @ORM\Entity
 */
class Fondtype
{
    /**
     * @var string
     *
     * @ORM\Column(name="font_type_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fontTypeCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="font_type_libelle", type="string", length=100, nullable=true)
     */
    private $fontTypeLibelle;

    /**
     * @var int|null
     *
     * @ORM\Column(name="font_type_etat", type="integer", nullable=true)
     */
    private $fontTypeEtat;


}
