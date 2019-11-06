<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Exercice
 * @ORM\Table(name="exercice")
 * @ORM\Entity
 */
class Exercice
{
	/**
	 * @var string
	 * @ORM\Column(name="exercice_code", type="integer", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $exerciceCode;

	/**
	 * @var integer|null
	 * @ORM\Column(name="exercice_libelle", type="integer", length=100, nullable=true)
	 */
	private $exerciceLibelle;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Facture", mappedBy="factureExerice" , cascade={"persist"})
	 */
	private $facture;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Bcn", mappedBy="bcnExercice" , cascade={"persist"})
	 */
	private $bcn;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Renouvellement", mappedBy="renouvellementExercice" , cascade={"persist"})
	 */
	private $renouvellement;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Solde", mappedBy="exercice" , cascade={"persist"})
	 */
	private $solde;

	/**
	 * @var integer|null
	 * @ORM\Column(name="exerciceetat", type="integer", length=100, nullable=true)
	 */
	private $exerciceetat;

    public function __construct()
    {
        $this->facture = new ArrayCollection();
        $this->bcn = new ArrayCollection();
        $this->renouvellement = new ArrayCollection();
        $this->solde = new ArrayCollection();
    }


	public function setExerciceCode($exerciceCode)
                                                                  	{
                                                                  		$this->exerciceCode = $exerciceCode; return $this;
                                                                  	}

    public function getExerciceCode(): ?int
    {
        return $this->exerciceCode;
    }

    public function getExerciceLibelle(): ?int
    {
        return $this->exerciceLibelle;
    }

    public function setExerciceLibelle(?int $exerciceLibelle): self
    {
        $this->exerciceLibelle = $exerciceLibelle;

        return $this;
    }

    public function getExerciceetat(): ?int
    {
        return $this->exerciceetat;
    }

    public function setExerciceetat(?int $exerciceetat): self
    {
        $this->exerciceetat = $exerciceetat;

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFacture(): Collection
    {
        return $this->facture;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->facture->contains($facture)) {
            $this->facture[] = $facture;
            $facture->setFactureExerice($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->facture->contains($facture)) {
            $this->facture->removeElement($facture);
            // set the owning side to null (unless already changed)
            if ($facture->getFactureExerice() === $this) {
                $facture->setFactureExerice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bcn[]
     */
    public function getBcn(): Collection
    {
        return $this->bcn;
    }

    public function addBcn(Bcn $bcn): self
    {
        if (!$this->bcn->contains($bcn)) {
            $this->bcn[] = $bcn;
            $bcn->setBcnExercice($this);
        }

        return $this;
    }

    public function removeBcn(Bcn $bcn): self
    {
        if ($this->bcn->contains($bcn)) {
            $this->bcn->removeElement($bcn);
            // set the owning side to null (unless already changed)
            if ($bcn->getBcnExercice() === $this) {
                $bcn->setBcnExercice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Renouvellement[]
     */
    public function getRenouvellement(): Collection
    {
        return $this->renouvellement;
    }

    public function addRenouvellement(Renouvellement $renouvellement): self
    {
        if (!$this->renouvellement->contains($renouvellement)) {
            $this->renouvellement[] = $renouvellement;
            $renouvellement->setRenouvellementExercice($this);
        }

        return $this;
    }

    public function removeRenouvellement(Renouvellement $renouvellement): self
    {
        if ($this->renouvellement->contains($renouvellement)) {
            $this->renouvellement->removeElement($renouvellement);
            // set the owning side to null (unless already changed)
            if ($renouvellement->getRenouvellementExercice() === $this) {
                $renouvellement->setRenouvellementExercice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Solde[]
     */
    public function getSolde(): Collection
    {
        return $this->solde;
    }

    public function addSolde(Solde $solde): self
    {
        if (!$this->solde->contains($solde)) {
            $this->solde[] = $solde;
            $solde->setExercice($this);
        }

        return $this;
    }

    public function removeSolde(Solde $solde): self
    {
        if ($this->solde->contains($solde)) {
            $this->solde->removeElement($solde);
            // set the owning side to null (unless already changed)
            if ($solde->getExercice() === $this) {
                $solde->setExercice(null);
            }
        }

        return $this;
    }
}
