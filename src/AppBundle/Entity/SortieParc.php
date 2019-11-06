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
     * @ORM\Column(name="nbre_prévu", type="float", precision=10, scale=0, nullable=false)
     */
    private $nbrePr�vu;

    /**
     * @var int
     *
     * @ORM\Column(name="nbre_réalisé", type="integer", nullable=false)
     */
    private $nbreR�alis�;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
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
     *   @ORM\JoinColumn(name="jour", referencedColumnName="jour")
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrePr�vu(): ?float
    {
        return $this->nbrePr�vu;
    }

    public function setNbrePr�vu(float $nbrePr�vu): self
    {
        $this->nbrePr�vu = $nbrePr�vu;

        return $this;
    }

    public function getNbreR�alis�(): ?int
    {
        return $this->nbreR�alis�;
    }

    public function setNbreR�alis�(int $nbreR�alis�): self
    {
        $this->nbreR�alis� = $nbreR�alis�;

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

    public function getJour(): ?Jour
    {
        return $this->jour;
    }

    public function setJour(?Jour $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getTypeBus(): ?TypeBus
    {
        return $this->typeBus;
    }

    public function setTypeBus(?TypeBus $typeBus): self
    {
        $this->typeBus = $typeBus;

        return $this;
    }

    public function getCodeHr(): ?PlageHoraire
    {
        return $this->codeHr;
    }

    public function setCodeHr(?PlageHoraire $codeHr): self
    {
        $this->codeHr = $codeHr;

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
