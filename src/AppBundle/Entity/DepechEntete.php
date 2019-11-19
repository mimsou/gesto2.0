<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * DepechEntete
 * @ORM\Table(name="DepechEntete")
 * @ORM\Entity
 */
class DepechEntete
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
	 * @ORM\Column(name="code_depeche", type="string", length=100, nullable=true)
	 */
	private $codeDepeche;

	/**
	 * @var datetime|null
	 * @ORM\Column(name="date_creation", type="datetime", length=100, nullable=true)
	 */
	private $dateCreation;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="DepechDetail", mappedBy="depecheCode" , cascade={"persist"})
	 */
	private $depecheCodeColl;

    public function __construct()
    {
        $this->depecheCodeColl = new ArrayCollection();
    }


	public function setId($id)
                              	{
                              		$this->id = $id; return $this;
                              	}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCodeDepeche(): ?string
    {
        return $this->codeDepeche;
    }

    public function setCodeDepeche(?string $codeDepeche): self
    {
        $this->codeDepeche = $codeDepeche;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection|DepechDetail[]
     */
    public function getDepecheCodeColl(): Collection
    {
        return $this->depecheCodeColl;
    }

    public function addDepecheCodeColl(DepechDetail $depecheCodeColl): self
    {
        if (!$this->depecheCodeColl->contains($depecheCodeColl)) {
            $this->depecheCodeColl[] = $depecheCodeColl;
            $depecheCodeColl->setDepecheCode($this);
        }

        return $this;
    }

    public function removeDepecheCodeColl(DepechDetail $depecheCodeColl): self
    {
        if ($this->depecheCodeColl->contains($depecheCodeColl)) {
            $this->depecheCodeColl->removeElement($depecheCodeColl);
            // set the owning side to null (unless already changed)
            if ($depecheCodeColl->getDepecheCode() === $this) {
                $depecheCodeColl->setDepecheCode(null);
            }
        }

        return $this;
    }
}
