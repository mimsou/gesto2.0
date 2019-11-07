<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ligne
 *
 * @ORM\Table(name="ligne", indexes={@ORM\Index(name="code_groupe", columns={"code_groupe"}), @ORM\Index(name="code_station_orig_2", columns={"code_station_orig"}), @ORM\Index(name="code_nature_ligne", columns={"code_nature_ligne"}), @ORM\Index(name="code_zone", columns={"code_zone"}), @ORM\Index(name="code_type_lig", columns={"code_type_lig"}), @ORM\Index(name="code_station_orig", columns={"code_station_orig"}), @ORM\Index(name="code_section", columns={"code_section"}), @ORM\Index(name="code_station_dest", columns={"code_station_dest"})})
 * @ORM\Entity
 */
class Ligne
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_ligne", type="string", length=5, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeLigne;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=50, nullable=false)
     */
    private $libelle;

    /**
     * @var float
     *
     * @ORM\Column(name="distance_aller", type="float", precision=10, scale=0, nullable=false)
     */
    private $distanceAller;

    /**
     * @var float
     *
     * @ORM\Column(name="distance_retour", type="float", precision=10, scale=0, nullable=true)
     */
    private $distanceRetour;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

    /**
     * @var \Station
     *
     * @ORM\ManyToOne(targetEntity="Station")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_station_orig", referencedColumnName="code_station")
     * })
     */
    private $codeStationOrig;

    /**
     * @var \Station
     *
     * @ORM\ManyToOne(targetEntity="Station")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_station_dest", referencedColumnName="code_station")
     * })
     */
    private $codeStationDest;

    /**
     * @var \Zone
     *
     * @ORM\ManyToOne(targetEntity="Zone")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_zone", referencedColumnName="code_zone")
     * })
     */
    private $codeZone;

    /**
     * @var \Section
     *
     * @ORM\ManyToOne(targetEntity="Section")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_section", referencedColumnName="code_section")
     * })
     */
    private $codeSection;

    /**
     * @var \NatureLigne
     *
     * @ORM\ManyToOne(targetEntity="NatureLigne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_nature_ligne", referencedColumnName="code_nature_ligne")
     * })
     */
    private $codeNatureLigne;

    /**
     * @var \TypeLigne
     *
     * @ORM\ManyToOne(targetEntity="TypeLigne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_type_lig", referencedColumnName="code_type_lig")
     * })
     */
    private $codeTypeLig;

    /**
     * @var \Groupe
     *
     * @ORM\ManyToOne(targetEntity="Groupe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_groupe", referencedColumnName="code_groupe")
     * })
     */
    private $codeGroupe;

    public function getCodeLigne(): ?string
    {
        return $this->codeLigne;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDistanceAller(): ?float
    {
        return $this->distanceAller;
    }

    public function setDistanceAller(float $distanceAller): self
    {
        $this->distanceAller = $distanceAller;

        return $this;
    }

    public function getDistanceRetour(): ?float
    {
        return $this->distanceRetour;
    }

    public function setDistanceRetour(float $distanceRetour): self
    {
        $this->distanceRetour = $distanceRetour;

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

    public function getCodeStationOrig(): ?Station
    {
        return $this->codeStationOrig;
    }

    public function setCodeStationOrig(?Station $codeStationOrig): self
    {
        $this->codeStationOrig = $codeStationOrig;

        return $this;
    }

    public function getCodeStationDest(): ?Station
    {
        return $this->codeStationDest;
    }

    public function setCodeStationDest(?Station $codeStationDest): self
    {
        $this->codeStationDest = $codeStationDest;

        return $this;
    }

    public function getCodeZone(): ?Zone
    {
        return $this->codeZone;
    }

    public function setCodeZone(?Zone $codeZone): self
    {
        $this->codeZone = $codeZone;

        return $this;
    }

    public function getCodeSection(): ?Section
    {
        return $this->codeSection;
    }

    public function setCodeSection(?Section $codeSection): self
    {
        $this->codeSection = $codeSection;

        return $this;
    }

    public function getCodeNatureLigne(): ?NatureLigne
    {
        return $this->codeNatureLigne;
    }

    public function setCodeNatureLigne(?NatureLigne $codeNatureLigne): self
    {
        $this->codeNatureLigne = $codeNatureLigne;

        return $this;
    }

    public function getCodeTypeLig(): ?TypeLigne
    {
        return $this->codeTypeLig;
    }

    public function setCodeTypeLig(?TypeLigne $codeTypeLig): self
    {
        $this->codeTypeLig = $codeTypeLig;

        return $this;
    }

    public function getCodeGroupe(): ?Groupe
    {
        return $this->codeGroupe;
    }

    public function setCodeGroupe(?Groupe $codeGroupe): self
    {
        $this->codeGroupe = $codeGroupe;

        return $this;
    }


}
