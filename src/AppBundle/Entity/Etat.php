<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Etat
 * @ORM\Table(name="etat")
 * @ORM\Entity
 */
class Etat
{
	/**
	 * @var string
	 * @ORM\Column(name="etat_code", type="integer", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $etatCode;

	/**
	 * @var string|null
	 * @ORM\Column(name="etat_libelle", type="string", length=100, nullable=true)
	 */
	private $etatLibelle;

	/**
	 * @var string|null
	 * @ORM\Column(name="etat_type", type="string", length=100, nullable=true)
	 */
	private $etatType;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="ArticleBcn", mappedBy="articleBcnRenouvEtat" , cascade={"persist"})
	 */
	private $articleBcnRenouvEtatColl;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Facture", mappedBy="factureRenouvEtat" , cascade={"persist"})
	 */
	private $factureRenouvEtatColl;

    public function __construct()
    {
        $this->articleBcnRenouvEtatColl = new ArrayCollection();
        $this->factureRenouvEtatColl = new ArrayCollection();
    }


	public function setEtatCode($etatCode)
                                          	{
                                          		$this->etatCode = $etatCode; return $this;
                                          	}

    public function getEtatCode(): ?int
    {
        return $this->etatCode;
    }

    public function getEtatLibelle(): ?string
    {
        return $this->etatLibelle;
    }

    public function setEtatLibelle(?string $etatLibelle): self
    {
        $this->etatLibelle = $etatLibelle;

        return $this;
    }

    public function getEtatType(): ?string
    {
        return $this->etatType;
    }

    public function setEtatType(?string $etatType): self
    {
        $this->etatType = $etatType;

        return $this;
    }

    /**
     * @return Collection|ArticleBcn[]
     */
    public function getArticleBcnRenouvEtatColl(): Collection
    {
        return $this->articleBcnRenouvEtatColl;
    }

    public function addArticleBcnRenouvEtatColl(ArticleBcn $articleBcnRenouvEtatColl): self
    {
        if (!$this->articleBcnRenouvEtatColl->contains($articleBcnRenouvEtatColl)) {
            $this->articleBcnRenouvEtatColl[] = $articleBcnRenouvEtatColl;
            $articleBcnRenouvEtatColl->setArticleBcnRenouvEtat($this);
        }

        return $this;
    }

    public function removeArticleBcnRenouvEtatColl(ArticleBcn $articleBcnRenouvEtatColl): self
    {
        if ($this->articleBcnRenouvEtatColl->contains($articleBcnRenouvEtatColl)) {
            $this->articleBcnRenouvEtatColl->removeElement($articleBcnRenouvEtatColl);
            // set the owning side to null (unless already changed)
            if ($articleBcnRenouvEtatColl->getArticleBcnRenouvEtat() === $this) {
                $articleBcnRenouvEtatColl->setArticleBcnRenouvEtat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFactureRenouvEtatColl(): Collection
    {
        return $this->factureRenouvEtatColl;
    }

    public function addFactureRenouvEtatColl(Facture $factureRenouvEtatColl): self
    {
        if (!$this->factureRenouvEtatColl->contains($factureRenouvEtatColl)) {
            $this->factureRenouvEtatColl[] = $factureRenouvEtatColl;
            $factureRenouvEtatColl->setFactureRenouvEtat($this);
        }

        return $this;
    }

    public function removeFactureRenouvEtatColl(Facture $factureRenouvEtatColl): self
    {
        if ($this->factureRenouvEtatColl->contains($factureRenouvEtatColl)) {
            $this->factureRenouvEtatColl->removeElement($factureRenouvEtatColl);
            // set the owning side to null (unless already changed)
            if ($factureRenouvEtatColl->getFactureRenouvEtat() === $this) {
                $factureRenouvEtatColl->setFactureRenouvEtat(null);
            }
        }

        return $this;
    }
}
