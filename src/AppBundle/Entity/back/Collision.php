<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Collision
 *
 * @ORM\Table(name="collision", indexes={@ORM\Index(name="code_ligne", columns={"code_ligne"}), @ORM\Index(name="code_cause_acc", columns={"code_cause_acc"}), @ORM\Index(name="code_degat", columns={"code_degat"}), @ORM\Index(name="IDX_5BCD23BEDA17D9C5", columns={"jour"})})
 * @ORM\Entity
 */
class Collision
{
    /**
     * @var int
     *
     * @ORM\Column(name="matricule", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="num_bus", type="string", length=5, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $numBus;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_acc", type="string", length=200, nullable=true)
     */
    private $lieuAcc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_rapport", type="date", nullable=true)
     */
    private $dateRapport;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

    /**
     * @var \Jour
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Jour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jour", referencedColumnName="jour")
     * })
     */
    private $jour;

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
     * @var \CauseAccident
     *
     * @ORM\ManyToOne(targetEntity="CauseAccident")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_cause_acc", referencedColumnName="code_cause_acc")
     * })
     */
    private $codeCauseAcc;

    /**
     * @var \Degat
     *
     * @ORM\ManyToOne(targetEntity="Degat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_degat", referencedColumnName="code_degat")
     * })
     */
    private $codeDegat;

    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function getNumBus(): ?string
    {
        return $this->numBus;
    }

    public function getLieuAcc(): ?string
    {
        return $this->lieuAcc;
    }

    public function setLieuAcc(string $lieuAcc): self
    {
        $this->lieuAcc = $lieuAcc;

        return $this;
    }

    public function getDateRapport(): ?\DateTimeInterface
    {
        return $this->dateRapport;
    }

    public function setDateRapport(\DateTimeInterface $dateRapport): self
    {
        $this->dateRapport = $dateRapport;

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

    public function getJour(): ?Jour
    {
        return $this->jour;
    }

    public function setJour(?Jour $jour): self
    {
        $this->jour = $jour;

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

    public function getCodeCauseAcc(): ?CauseAccident
    {
        return $this->codeCauseAcc;
    }

    public function setCodeCauseAcc(?CauseAccident $codeCauseAcc): self
    {
        $this->codeCauseAcc = $codeCauseAcc;

        return $this;
    }

    public function getCodeDegat(): ?Degat
    {
        return $this->codeDegat;
    }

    public function setCodeDegat(?Degat $codeDegat): self
    {
        $this->codeDegat = $codeDegat;

        return $this;
    }


}
