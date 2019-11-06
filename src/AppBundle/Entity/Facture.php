<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 * @ORM\Table(name="facture")
 * @ORM\Entity
 */
class Facture
{
	/**
	 * @var string
	 * @ORM\Column(name="facture_code", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $factureCode;

	/**
	 * @var string|null
	 * @ORM\Column(name="facture_numeo_bl", type="string", length=100, nullable=true)
	 */
	private $factureNumeoBl;

	/**
	 * @var string|null
	 * @ORM\Column(name="facture_code_regroupement", type="string", length=100, nullable=true)
	 */
	private $factureCodeRegroupement;

	/**
	 * @var string|null
	 * @ORM\Column(name="facture_code_devis", type="string", length=100, nullable=true)
	 */
	private $factureCodeDevis;

	/**
	 * @var datetime|null
	 * @ORM\Column(name="facture_date_devis", type="datetime", length=100, nullable=true)
	 */
	private $factureDateDevis;

	/**
	 * @var datetime|null
	 * @ORM\Column(name="facture_date_reception", type="datetime", length=100, nullable=true)
	 */
	private $factureDateReception;

	/**
	 * @var datetime|null
	 * @ORM\Column(name="facture_date_validation", type="datetime", length=100, nullable=true)
	 */
	private $factureDateValidation;

	/**
	 * @var integer|null
	 * @ORM\Column(name="facture_etat", type="integer", length=100, nullable=true)
	 */
	private $factureEtat;

	/**
	 * @var \Exercice
	 * @ORM\ManyToOne(targetEntity="Exercice",inversedBy="facture")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="facture_exerice", referencedColumnName="exercice_code")
	 * })
	 */
	private $factureExerice;

	/**
	 * @var \Fournisseur
	 * @ORM\ManyToOne(targetEntity="Fournisseur")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="facture_code_fournisseur", referencedColumnName="fournisseur_code")
	 * })
	 */
	private $factureCodeFournisseur;

	/**
	 * @var \Renouvellement
	 * @ORM\ManyToOne(targetEntity="Renouvellement",inversedBy="detailrenouvellement")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="facture_code_renouvellement", referencedColumnName="renouvellement_code")
	 * })
	 */
	private $factureCodeRenouvellement;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="ArticleBcn", mappedBy="factureCodeRegrouppement" , cascade={"persist"})
	 */
	private $detailFacture;

	/**
	 * @var \Crb
	 * @ORM\ManyToOne(targetEntity="Crb",inversedBy="crbFacture")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="facture_code_crb", referencedColumnName="crb_code")
	 * })
	 */
	private $factureCodeCrb;

	/**
	 * @var float|null
	 * @ORM\Column(name="sumfact", type="float", length=100, nullable=true)
	 */
	private $sumfact;

	/**
	 * @var \Etat
	 * @ORM\ManyToOne(targetEntity="Etat",inversedBy="factureRenouvEtatColl")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="facture_renouv_etat", referencedColumnName="etat_code")
	 * })
	 */
	private $factureRenouvEtat;

	/**
	 * @var string|null
	 * @ORM\Column(name="facture_facture_numero", type="string", length=100, nullable=true)
	 */
	private $factureFactureNumero;

    public function __construct()
    {
        $this->detailFacture = new ArrayCollection();
    }


	public function setFactureCode($factureCode)
                                                                                                      	{
                                                                                                      		$this->factureCode = $factureCode; return $this;
                                                                                                      	}

    public function getFactureCode(): ?string
    {
        return $this->factureCode;
    }

    public function getFactureNumeoBl(): ?string
    {
        return $this->factureNumeoBl;
    }

    public function setFactureNumeoBl(?string $factureNumeoBl): self
    {
        $this->factureNumeoBl = $factureNumeoBl;

        return $this;
    }

    public function getFactureCodeRegroupement(): ?string
    {
        return $this->factureCodeRegroupement;
    }

    public function setFactureCodeRegroupement(?string $factureCodeRegroupement): self
    {
        $this->factureCodeRegroupement = $factureCodeRegroupement;

        return $this;
    }

    public function getFactureCodeDevis(): ?string
    {
        return $this->factureCodeDevis;
    }

    public function setFactureCodeDevis(?string $factureCodeDevis): self
    {
        $this->factureCodeDevis = $factureCodeDevis;

        return $this;
    }

    public function getFactureDateDevis(): ?\DateTimeInterface
    {
        return $this->factureDateDevis;
    }

    public function setFactureDateDevis(?\DateTimeInterface $factureDateDevis): self
    {
        $this->factureDateDevis = $factureDateDevis;

        return $this;
    }

    public function getFactureDateReception(): ?\DateTimeInterface
    {
        return $this->factureDateReception;
    }

    public function setFactureDateReception(?\DateTimeInterface $factureDateReception): self
    {
        $this->factureDateReception = $factureDateReception;

        return $this;
    }

    public function getFactureDateValidation(): ?\DateTimeInterface
    {
        return $this->factureDateValidation;
    }

    public function setFactureDateValidation(?\DateTimeInterface $factureDateValidation): self
    {
        $this->factureDateValidation = $factureDateValidation;

        return $this;
    }

    public function getFactureEtat(): ?int
    {
        return $this->factureEtat;
    }

    public function setFactureEtat(?int $factureEtat): self
    {
        $this->factureEtat = $factureEtat;

        return $this;
    }

    public function getSumfact(): ?float
    {
        return $this->sumfact;
    }

    public function setSumfact(?float $sumfact): self
    {
        $this->sumfact = $sumfact;

        return $this;
    }

    public function getFactureFactureNumero(): ?string
    {
        return $this->factureFactureNumero;
    }

    public function setFactureFactureNumero(?string $factureFactureNumero): self
    {
        $this->factureFactureNumero = $factureFactureNumero;

        return $this;
    }

    public function getFactureExerice(): ?Exercice
    {
        return $this->factureExerice;
    }

    public function setFactureExerice(?Exercice $factureExerice): self
    {
        $this->factureExerice = $factureExerice;

        return $this;
    }

    public function getFactureCodeFournisseur(): ?Fournisseur
    {
        return $this->factureCodeFournisseur;
    }

    public function setFactureCodeFournisseur(?Fournisseur $factureCodeFournisseur): self
    {
        $this->factureCodeFournisseur = $factureCodeFournisseur;

        return $this;
    }

    public function getFactureCodeRenouvellement(): ?Renouvellement
    {
        return $this->factureCodeRenouvellement;
    }

    public function setFactureCodeRenouvellement(?Renouvellement $factureCodeRenouvellement): self
    {
        $this->factureCodeRenouvellement = $factureCodeRenouvellement;

        return $this;
    }

    /**
     * @return Collection|ArticleBcn[]
     */
    public function getDetailFacture(): Collection
    {
        return $this->detailFacture;
    }

    public function addDetailFacture(ArticleBcn $detailFacture): self
    {
        if (!$this->detailFacture->contains($detailFacture)) {
            $this->detailFacture[] = $detailFacture;
            $detailFacture->setFactureCodeRegrouppement($this);
        }

        return $this;
    }

    public function removeDetailFacture(ArticleBcn $detailFacture): self
    {
        if ($this->detailFacture->contains($detailFacture)) {
            $this->detailFacture->removeElement($detailFacture);
            // set the owning side to null (unless already changed)
            if ($detailFacture->getFactureCodeRegrouppement() === $this) {
                $detailFacture->setFactureCodeRegrouppement(null);
            }
        }

        return $this;
    }

    public function getFactureCodeCrb(): ?Crb
    {
        return $this->factureCodeCrb;
    }

    public function setFactureCodeCrb(?Crb $factureCodeCrb): self
    {
        $this->factureCodeCrb = $factureCodeCrb;

        return $this;
    }

    public function getFactureRenouvEtat(): ?Etat
    {
        return $this->factureRenouvEtat;
    }

    public function setFactureRenouvEtat(?Etat $factureRenouvEtat): self
    {
        $this->factureRenouvEtat = $factureRenouvEtat;

        return $this;
    }
}
