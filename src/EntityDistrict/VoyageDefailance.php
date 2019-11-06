<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoyageDefailance
 *
 * @ORM\Table(name="voyage_defailance", indexes={@ORM\Index(name="code_hr_2", columns={"code_hr"}), @ORM\Index(name="code_defaillance", columns={"code_defaillance"}), @ORM\Index(name="jour_2", columns={"jour"}), @ORM\Index(name="code_hr_3", columns={"code_hr"}), @ORM\Index(name="code_hr", columns={"code_hr"}), @ORM\Index(name="code_type_def", columns={"code_type_def"})})
 * @ORM\Entity
 */
class VoyageDefailance
{
    /**
     * @var float
     *
     * @ORM\Column(name="nbre_voy", type="float", precision=10, scale=0, nullable=false)
     */
    private $nbreVoy;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

    /**
     * @var \Jour
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Jour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jour", referencedColumnName="Jour")
     * })
     */
    private $jour;

    /**
     * @var \TypeDefaillance
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="TypeDefaillance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_type_def", referencedColumnName="code_type_def")
     * })
     */
    private $codeTypeDef;

    /**
     * @var \Defailance
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Defailance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_defaillance", referencedColumnName="code_defaillance")
     * })
     */
    private $codeDefaillance;

    /**
     * @var \PlageHoraire
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="PlageHoraire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_hr", referencedColumnName="code_hr")
     * })
     */
    private $codeHr;


}
