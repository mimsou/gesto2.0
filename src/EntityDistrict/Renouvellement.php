<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Renouvellement
 *
 * @ORM\Table(name="renouvellement", indexes={@ORM\Index(name="IDX_442B5C9ACB21C20C", columns={"renouvellement_code_crb"}), @ORM\Index(name="IDX_442B5C9ACC7C8580", columns={"renouvellement_exercice"})})
 * @ORM\Entity
 */
class Renouvellement
{
    /**
     * @var string
     *
     * @ORM\Column(name="renouvellement_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $renouvellementCode;

    /**
     * @var int|null
     *
     * @ORM\Column(name="renouvellement_etat", type="integer", nullable=true)
     */
    private $renouvellementEtat;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="renouvellement_date_validation", type="datetime", nullable=true)
     */
    private $renouvellementDateValidation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="renouvellement_date_reglement", type="datetime", nullable=true)
     */
    private $renouvellementDateReglement;

    /**
     * @var \Crb
     *
     * @ORM\ManyToOne(targetEntity="Crb")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="renouvellement_code_crb", referencedColumnName="crb_code")
     * })
     */
    private $renouvellementCodeCrb;

    /**
     * @var \Exercice
     *
     * @ORM\ManyToOne(targetEntity="Exercice")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="renouvellement_exercice", referencedColumnName="exercice_code")
     * })
     */
    private $renouvellementExercice;


}
