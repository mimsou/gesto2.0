<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity
 */
class Fournisseur
{
	/**
	 * @var string
	 * @ORM\Column(name="fournisseur_code", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $fournisseurCode;

	/**
	 * @var string|null
	 * @ORM\Column(name="fournisseur_libelle", type="string", length=100, nullable=true)
	 */
	private $fournisseurLibelle;

	/**
	 * @var integer|null
	 * @ORM\Column(name="fournisseur_etat", type="integer", length=100, nullable=true)
	 */
	private $fournisseurEtat;

	/**
	 * @var float|null
	 * @ORM\Column(name="mntfact", type="float", length=100, nullable=true)
	 */
	private $mntfact;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Test", mappedBy="FournisseurTest" , cascade={"persist"})
	 */
	private $FournisseurTestColl;

    public function __construct()
    {
        $this->FournisseurTestColl = new ArrayCollection();
    }


	public function setFournisseurCode($fournisseurCode)
                                    	{
                                    		$this->fournisseurCode = $fournisseurCode; return $this;
                                    	}

    public function getFournisseurCode(): ?string
    {
        return $this->fournisseurCode;
    }

    public function getFournisseurLibelle(): ?string
    {
        return $this->fournisseurLibelle;
    }

    public function setFournisseurLibelle(?string $fournisseurLibelle): self
    {
        $this->fournisseurLibelle = $fournisseurLibelle;

        return $this;
    }

    public function getFournisseurEtat(): ?int
    {
        return $this->fournisseurEtat;
    }

    public function setFournisseurEtat(?int $fournisseurEtat): self
    {
        $this->fournisseurEtat = $fournisseurEtat;

        return $this;
    }

    public function getMntfact(): ?float
    {
        return $this->mntfact;
    }

    public function setMntfact(?float $mntfact): self
    {
        $this->mntfact = $mntfact;

        return $this;
    }

    /**
     * @return Collection|Test[]
     */
    public function getFournisseurTestColl(): Collection
    {
        return $this->FournisseurTestColl;
    }

    public function addFournisseurTestColl(Test $fournisseurTestColl): self
    {
        if (!$this->FournisseurTestColl->contains($fournisseurTestColl)) {
            $this->FournisseurTestColl[] = $fournisseurTestColl;
            $fournisseurTestColl->setFournisseurTest($this);
        }

        return $this;
    }

    public function removeFournisseurTestColl(Test $fournisseurTestColl): self
    {
        if ($this->FournisseurTestColl->contains($fournisseurTestColl)) {
            $this->FournisseurTestColl->removeElement($fournisseurTestColl);
            // set the owning side to null (unless already changed)
            if ($fournisseurTestColl->getFournisseurTest() === $this) {
                $fournisseurTestColl->setFournisseurTest(null);
            }
        }

        return $this;
    }
}
