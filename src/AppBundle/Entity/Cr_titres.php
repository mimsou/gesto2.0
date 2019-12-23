<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cr_titres
 * @ORM\Table(name="Cr_titres")
 * @ORM\Entity
 */ 
class Cr_titres
{
	/**
	 * @var string
	 * @ORM\Column(name="titre", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $titre;

	/**
	 * @var string|null
	 * @ORM\Column(name="libelle_titre", type="string", length=100, nullable=true)
	 */
	private $libelleTitre;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Cr_bureau_defaillant", mappedBy="titre" , cascade={"persist"})
	 */
	private $titreColl;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;

    public function __construct()
    {
        $this->titreColl = new ArrayCollection();
    }


	public function setTitre($titre)
                              	{
                              		$this->titre = $titre; return $this;
                              	}

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function getLibelleTitre(): ?string
    {
        return $this->libelleTitre;
    }

    public function setLibelleTitre(?string $libelleTitre): self
    {
        $this->libelleTitre = $libelleTitre;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(?int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection|Cr_bureau_defaillant[]
     */
    public function getTitreColl(): Collection
    {
        return $this->titreColl;
    }

    public function addTitreColl(Cr_bureau_defaillant $titreColl): self
    {
        if (!$this->titreColl->contains($titreColl)) {
            $this->titreColl[] = $titreColl;
            $titreColl->setTitre($this);
        }

        return $this;
    }

    public function removeTitreColl(Cr_bureau_defaillant $titreColl): self
    {
        if ($this->titreColl->contains($titreColl)) {
            $this->titreColl->removeElement($titreColl);
            // set the owning side to null (unless already changed)
            if ($titreColl->getTitre() === $this) {
                $titreColl->setTitre(null);
            }
        }

        return $this;
    }
}
