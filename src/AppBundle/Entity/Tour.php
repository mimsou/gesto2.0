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
     * @ORM\Column(name="amplitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $amplitude;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_deb1", type="time", nullable=true)
     */
    private $heureDeb1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin1", type="time", nullable=true)
     */
    private $heureFin1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_deb2", type="time", nullable=true)
     */
    private $heureDeb2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin2", type="time", nullable=true)
     */
    private $heureFin2;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
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

    public function getCodeTour(): ?int
    {
        return $this->codeTour;
    }

    public function getAmplitude(): ?float
    {
        return $this->amplitude;
    }

    public function setAmplitude(float $amplitude): self
    {
        $this->amplitude = $amplitude;

        return $this;
    }

    public function getHeureDeb1(): ?\DateTimeInterface
    {
        return $this->heureDeb1;
    }

    public function setHeureDeb1(\DateTimeInterface $heureDeb1): self
    {
        $this->heureDeb1 = $heureDeb1;

        return $this;
    }

    public function getHeureFin1(): ?\DateTimeInterface
    {
        return $this->heureFin1;
    }

    public function setHeureFin1(\DateTimeInterface $heureFin1): self
    {
        $this->heureFin1 = $heureFin1;

        return $this;
    }

    public function getHeureDeb2(): ?\DateTimeInterface
    {
        return $this->heureDeb2;
    }

    public function setHeureDeb2(\DateTimeInterface $heureDeb2): self
    {
        $this->heureDeb2 = $heureDeb2;

        return $this;
    }

    public function getHeureFin2(): ?\DateTimeInterface
    {
        return $this->heureFin2;
    }

    public function setHeureFin2(\DateTimeInterface $heureFin2): self
    {
        $this->heureFin2 = $heureFin2;

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

    public function getCodeLigne(): ?Ligne
    {
        return $this->codeLigne;
    }

    public function setCodeLigne(?Ligne $codeLigne): self
    {
        $this->codeLigne = $codeLigne;

        return $this;
    }

    public function getCodeTypeTour(): ?TypeTour
    {
        return $this->codeTypeTour;
    }

    public function setCodeTypeTour(?TypeTour $codeTypeTour): self
    {
        $this->codeTypeTour = $codeTypeTour;

        return $this;
    }

    public function getCodeSaison(): ?Saison
    {
        return $this->codeSaison;
    }

    public function setCodeSaison(?Saison $codeSaison): self
    {
        $this->codeSaison = $codeSaison;

        return $this;
    }


}
