<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoyageTombe
 *
 * @ORM\Table(name="voyage_tombe", indexes={@ORM\Index(name="code_spc", columns={"code_spc"}), @ORM\Index(name="code_tour", columns={"code_tour"}), @ORM\Index(name="code_ligne", columns={"code_ligne"}), @ORM\Index(name="IDX_89B9AE29B916834C", columns={"code_nat_voy"})})
 * @ORM\Entity
 */
class VoyageTombe
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_defaillance", type="string", length=3, nullable=false)
     */
    private $codeDefaillance;

    /**
     * @var string
     *
     * @ORM\Column(name="num_bus", type="string", length=5, nullable=false)
     */
    private $numBus;

    /**
     * @var float
     *
     * @ORM\Column(name="nombre_voy_tomb", type="float", precision=10, scale=0, nullable=false)
     */
    private $nombreVoyTomb;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

    /**
     * @var \NatureVoyage
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="NatureVoyage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_nat_voy", referencedColumnName="code_nat_voy")
     * })
     */
    private $codeNatVoy;

    /**
     * @var \Tour
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Tour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_tour", referencedColumnName="code_tour")
     * })
     */
    private $codeTour;

    /**
     * @var \Ligne
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Ligne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_ligne", referencedColumnName="code_ligne")
     * })
     */
    private $codeLigne;

    /**
     * @var \TypeSpc
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="TypeSpc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_spc", referencedColumnName="code_spc")
     * })
     */
    private $codeSpc;

    public function getCodeDefaillance(): ?string
    {
        return $this->codeDefaillance;
    }

    public function setCodeDefaillance(string $codeDefaillance): self
    {
        $this->codeDefaillance = $codeDefaillance;

        return $this;
    }

    public function getNumBus(): ?string
    {
        return $this->numBus;
    }

    public function setNumBus(string $numBus): self
    {
        $this->numBus = $numBus;

        return $this;
    }

    public function getNombreVoyTomb(): ?float
    {
        return $this->nombreVoyTomb;
    }

    public function setNombreVoyTomb(float $nombreVoyTomb): self
    {
        $this->nombreVoyTomb = $nombreVoyTomb;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCodeNatVoy(): ?NatureVoyage
    {
        return $this->codeNatVoy;
    }

    public function setCodeNatVoy(?NatureVoyage $codeNatVoy): self
    {
        $this->codeNatVoy = $codeNatVoy;

        return $this;
    }

    public function getCodeTour(): ?Tour
    {
        return $this->codeTour;
    }

    public function setCodeTour(?Tour $codeTour): self
    {
        $this->codeTour = $codeTour;

        return $this;
    }

    public function getCodeLigne(): ?Ligne
    {
        return $this->codeLigne;
    }

    public function setCodeLigne(?Ligne $codeLigne): self
    {
        $this->codeLigne = $codeLigne;

        return $this;
    }

    public function getCodeSpc(): ?TypeSpc
    {
        return $this->codeSpc;
    }

    public function setCodeSpc(?TypeSpc $codeSpc): self
    {
        $this->codeSpc = $codeSpc;

        return $this;
    }


}
