<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 * @ORM\Table(name="type")
 * @ORM\Entity
 */
class Type
{
	/**
	 * @var string
	 * @ORM\Column(name="id", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $id;

	/**
	 * @var string|null
	 * @ORM\Column(name="libelle", type="string", length=100, nullable=true)
	 */
	private $libelle;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Bus", mappedBy="type" , cascade={"persist"})
	 */
	private $typeColl;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat_type", type="integer", length=100, nullable=true)
	 */
	private $etatType;

    public function __construct()
    {
        $this->typeColl = new ArrayCollection();
    }


	public function setId($id)
                              	{
                              		$this->id = $id; return $this;
                              	}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getEtatType(): ?int
    {
        return $this->etatType;
    }

    public function setEtatType(?int $etatType): self
    {
        $this->etatType = $etatType;

        return $this;
    }

    /**
     * @return Collection|Bus[]
     */
    public function getTypeColl(): Collection
    {
        return $this->typeColl;
    }

    public function addTypeColl(Bus $typeColl): self
    {
        if (!$this->typeColl->contains($typeColl)) {
            $this->typeColl[] = $typeColl;
            $typeColl->setType($this);
        }

        return $this;
    }

    public function removeTypeColl(Bus $typeColl): self
    {
        if ($this->typeColl->contains($typeColl)) {
            $this->typeColl->removeElement($typeColl);
            // set the owning side to null (unless already changed)
            if ($typeColl->getType() === $this) {
                $typeColl->setType(null);
            }
        }

        return $this;
    }
}
