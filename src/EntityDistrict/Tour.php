<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tour
 *
 * @ORM\Table(name="tour", indexes={@ORM\Index(name="code_type_tour", columns={"code_type_tour"}), @ORM\Index(name="code_saison", columns={"code_saison"}), @ORM\Index(name="code_ligne", columns={"code_ligne"})})
 * @ORM\Entity
 */
class Tour
{
    /**
     * @var int
     *
     * @ORM\Column(name="code_tour", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeTour;

    /**
     * @var float
     *
     * @ORM\Column(name="amplitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $amplitude;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_deb1", type="time", nullable=false)
     */
    private $heureDeb1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin1", type="time", nullable=false)
     */
    private $heureFin1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_deb2", type="time", nullable=false)
     */
    private $heureDeb2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin2", type="time", nullable=false)
     */
    private $heureFin2;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

    /**
     * @var \Ligne
     *
     * @ORM\ManyToOne(targetEntity="Ligne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_ligne", referencedColumnName="code_ligne")
     * })
     */
    private $codeLigne;

    /**
     * @var \TypeTour
     *
     * @ORM\ManyToOne(targetEntity="TypeTour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_type_tour", referencedColumnName="code_type_tour")
     * })
     */
    private $codeTypeTour;

    /**
     * @var \Saison
     *
     * @ORM\ManyToOne(targetEntity="Saison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_saison", referencedColumnName="code_saison")
     * })
     */
    private $codeSaison;


}
