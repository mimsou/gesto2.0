<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SortieParc
 *
 * @ORM\Table(name="sortie_parc", indexes={@ORM\Index(name="code_spc", columns={"code_spc"}), @ORM\Index(name="jour", columns={"jour"}), @ORM\Index(name="code_nat_voy_2", columns={"code_nat_voy"}), @ORM\Index(name="code_hr", columns={"code_hr"}), @ORM\Index(name="type_bus", columns={"type_bus"})})
 * @ORM\Entity
 */
class SortieParc
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="nbre_prÃ©vu", type="float", precision=10, scale=0, nullable=false)
     */
    private $nbrePrã©vu;

    /**
     * @var int
     *
     * @ORM\Column(name="nbre_rÃ©alisÃ©", type="integer", nullable=false)
     */
    private $nbreRã©alisã©;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

    /**
     * @var \NatureVoyage
     *
     * @ORM\ManyToOne(targetEntity="NatureVoyage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_nat_voy", referencedColumnName="code_nat_voy")
     * })
     */
    private $codeNatVoy;

    /**
     * @var \Jour
     *
     * @ORM\ManyToOne(targetEntity="Jour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jour", referencedColumnName="Jour")
     * })
     */
    private $jour;

    /**
     * @var \TypeBus
     *
     * @ORM\ManyToOne(targetEntity="TypeBus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_bus", referencedColumnName="code_type_bus")
     * })
     */
    private $typeBus;

    /**
     * @var \PlageHoraire
     *
     * @ORM\ManyToOne(targetEntity="PlageHoraire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_hr", referencedColumnName="code_hr")
     * })
     */
    private $codeHr;

    /**
     * @var \TypeSpc
     *
     * @ORM\ManyToOne(targetEntity="TypeSpc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_spc", referencedColumnName="code_spc")
     * })
     */
    private $codeSpc;


}
