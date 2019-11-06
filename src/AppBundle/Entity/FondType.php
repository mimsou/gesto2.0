<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FondType
 * @ORM\Table(name="fondtype")
 * @ORM\Entity
 */
class FondType
{
	/**
	 * @var string
	 * @ORM\Column(name="font_type_code", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $fontTypeCode;

	/**
	 * @var string|null
	 * @ORM\Column(name="font_type_libelle", type="string", length=100, nullable=true)
	 */
	private $fontTypeLibelle;

	/**
	 * @var integer|null
	 * @ORM\Column(name="font_type_etat", type="integer", length=100, nullable=true)
	 */
	private $FontTypeEtat;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Service", mappedBy="serviceTypeFond" , cascade={"persist"})
	 */
	private $serviceTypeFondColl;

    public function __construct()
    {
        $this->serviceTypeFondColl = new ArrayCollection();
    }


	public function setFontTypeCode($fontTypeCode)
                              	{
                              		$this->fontTypeCode = $fontTypeCode; return $this;
                              	}

    public function getFontTypeCode(): ?string
    {
        return $this->fontTypeCode;
    }

    public function getFontTypeLibelle(): ?string
    {
        return $this->fontTypeLibelle;
    }

    public function setFontTypeLibelle(?string $fontTypeLibelle): self
    {
        $this->fontTypeLibelle = $fontTypeLibelle;

        return $this;
    }

    public function getFontTypeEtat(): ?int
    {
        return $this->FontTypeEtat;
    }

    public function setFontTypeEtat(?int $FontTypeEtat): self
    {
        $this->FontTypeEtat = $FontTypeEtat;

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServiceTypeFondColl(): Collection
    {
        return $this->serviceTypeFondColl;
    }

    public function addServiceTypeFondColl(Service $serviceTypeFondColl): self
    {
        if (!$this->serviceTypeFondColl->contains($serviceTypeFondColl)) {
            $this->serviceTypeFondColl[] = $serviceTypeFondColl;
            $serviceTypeFondColl->setServiceTypeFond($this);
        }

        return $this;
    }

    public function removeServiceTypeFondColl(Service $serviceTypeFondColl): self
    {
        if ($this->serviceTypeFondColl->contains($serviceTypeFondColl)) {
            $this->serviceTypeFondColl->removeElement($serviceTypeFondColl);
            // set the owning side to null (unless already changed)
            if ($serviceTypeFondColl->getServiceTypeFond() === $this) {
                $serviceTypeFondColl->setServiceTypeFond(null);
            }
        }

        return $this;
    }
}
