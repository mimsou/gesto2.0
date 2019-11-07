<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Crb
 * @ORM\Table(name="crb")
 * @ORM\Entity
 */
class Crb
{
	/**
	 * @var string|null
	 * @ORM\Column(name="crb_libelle", type="string", length=100, nullable=true)
	 */
	private $crbLibelle;

	/**
	 * @var string
	 * @ORM\Column(name="crb_code", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $crbCode;

	/**
	 * @var integer|null
	 * @ORM\Column(name="crb_etat", type="integer", length=100, nullable=true)
	 */
	private $crbEtat;

	/**
	 * @var float|null
	 * @ORM\Column(name="crb_solde", type="float", length=100, nullable=true)
	 */
	private $crbSolde;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Facture", mappedBy="factureCodeCrb" , cascade={"persist"})
	 */
	private $crbFacture;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Renouvellement", mappedBy="renouvellementCodeCrb" , cascade={"persist"})
	 */
	private $crbRenouvellement;

	/**
	 * @var float|null
	 * @ORM\Column(name="fond", type="float", length=100, nullable=true)
	 */
	private $Fond;

	/**
	 * @var float|null
	 * @ORM\Column(name="som_facture", type="float", length=100, nullable=true)
	 */
	private $somFacture;

	/**
	 * @var float|null
	 * @ORM\Column(name="somrenouvellement", type="float", length=100, nullable=true)
	 */
	private $somrenouvellement;

    public function __construct()
    {
        $this->crbFacture = new ArrayCollection();
        $this->crbRenouvellement = new ArrayCollection();
    }


	public function setCrbCode($crbCode)
                                                                  	{
                                                                  		$this->crbCode = $crbCode; return $this;
                                                                  	}

    public function getCrbLibelle(): ?string
    {
        return $this->crbLibelle;
    }

    public function setCrbLibelle(?string $crbLibelle): self
    {
        $this->crbLibelle = $crbLibelle;

        return $this;
    }

    public function getCrbCode(): ?string
    {
        return $this->crbCode;
    }

    public function getCrbEtat(): ?int
    {
        return $this->crbEtat;
    }

    public function setCrbEtat(?int $crbEtat): self
    {
        $this->crbEtat = $crbEtat;

        return $this;
    }

    public function getCrbSolde(): ?float
    {
        return $this->crbSolde;
    }

    public function setCrbSolde(?float $crbSolde): self
    {
        $this->crbSolde = $crbSolde;

        return $this;
    }

    public function getFond(): ?float
    {
        return $this->Fond;
    }

    public function setFond(?float $Fond): self
    {
        $this->Fond = $Fond;

        return $this;
    }

    public function getSomFacture(): ?float
    {
        return $this->somFacture;
    }

    public function setSomFacture(?float $somFacture): self
    {
        $this->somFacture = $somFacture;

        return $this;
    }

    public function getSomrenouvellement(): ?float
    {
        return $this->somrenouvellement;
    }

    public function setSomrenouvellement(?float $somrenouvellement): self
    {
        $this->somrenouvellement = $somrenouvellement;

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getCrbFacture(): Collection
    {
        return $this->crbFacture;
    }

    public function addCrbFacture(Facture $crbFacture): self
    {
        if (!$this->crbFacture->contains($crbFacture)) {
            $this->crbFacture[] = $crbFacture;
            $crbFacture->setFactureCodeCrb($this);
        }

        return $this;
    }

    public function removeCrbFacture(Facture $crbFacture): self
    {
        if ($this->crbFacture->contains($crbFacture)) {
            $this->crbFacture->removeElement($crbFacture);
            // set the owning side to null (unless already changed)
            if ($crbFacture->getFactureCodeCrb() === $this) {
                $crbFacture->setFactureCodeCrb(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Renouvellement[]
     */
    public function getCrbRenouvellement(): Collection
    {
        return $this->crbRenouvellement;
    }

    public function addCrbRenouvellement(Renouvellement $crbRenouvellement): self
    {
        if (!$this->crbRenouvellement->contains($crbRenouvellement)) {
            $this->crbRenouvellement[] = $crbRenouvellement;
            $crbRenouvellement->setRenouvellementCodeCrb($this);
        }

        return $this;
    }

    public function removeCrbRenouvellement(Renouvellement $crbRenouvellement): self
    {
        if ($this->crbRenouvellement->contains($crbRenouvellement)) {
            $this->crbRenouvellement->removeElement($crbRenouvellement);
            // set the owning side to null (unless already changed)
            if ($crbRenouvellement->getRenouvellementCodeCrb() === $this) {
                $crbRenouvellement->setRenouvellementCodeCrb(null);
            }
        }

        return $this;
    }
}
