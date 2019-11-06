<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bcn
 *
 * @ORM\Table(name="bcn", indexes={@ORM\Index(name="fk_bcn_service1_idx", columns={"bcn_code_service"}), @ORM\Index(name="IDX_50C8B26795756681", columns={"bcn_exercice"})})
 * @ORM\Entity
 */
class Bcn
{
    /**
     * @var string
     *
     * @ORM\Column(name="bcn_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bcnCode;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="bcn_date_creation", type="datetime", nullable=true)
     */
    private $bcnDateCreation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="bcn_date_validation", type="datetime", nullable=true)
     */
    private $bcnDateValidation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="bcn_etat", type="integer", nullable=true)
     */
    private $bcnEtat;

    /**
     * @var \Exercice
     *
     * @ORM\ManyToOne(targetEntity="Exercice")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bcn_exercice", referencedColumnName="exercice_code")
     * })
     */
    private $bcnExercice;

    /**
     * @var \Service
     *
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bcn_code_service", referencedColumnName="service_code")
     * })
     */
    private $bcnCodeService;


}
