<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cr_distrinct
 * @ORM\Table(name="Cr_distrinct")
 * @ORM\Entity
 */  
class Cr_distrinct
{
	/**
	 * @var string
	 * @ORM\Column(name="codedistrict", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $codedistrict;

	/**
	 * @var string|null
	 * @ORM\Column(name="district_libelle", type="string", length=100, nullable=true)
	 */
	private $districtLibelle;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Cr_be_entete", mappedBy="codeDistrict" , cascade={"persist"})
	 */
	private $codeDistrictColl;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;

    public function __construct()
    {
        $this->codeDistrictColl = new ArrayCollection();
    }


	public function setCodedistrict($codedistrict)
                              	{
                              		$this->codedistrict = $codedistrict; return $this;
                              	}

    public function getCodedistrict(): ?string
    {
        return $this->codedistrict;
    }

    public function getDistrictLibelle(): ?string
    {
        return $this->districtLibelle;
    }

    public function setDistrictLibelle(?string $districtLibelle): self
    {
        $this->districtLibelle = $districtLibelle;

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
     * @return Collection|Cr_be_entete[]
     */
    public function getCodeDistrictColl(): Collection
    {
        return $this->codeDistrictColl;
    }

    public function addCodeDistrictColl(Cr_be_entete $codeDistrictColl): self
    {
        if (!$this->codeDistrictColl->contains($codeDistrictColl)) {
            $this->codeDistrictColl[] = $codeDistrictColl;
            $codeDistrictColl->setCodeDistrict($this);
        }

        return $this;
    }

    public function removeCodeDistrictColl(Cr_be_entete $codeDistrictColl): self
    {
        if ($this->codeDistrictColl->contains($codeDistrictColl)) {
            $this->codeDistrictColl->removeElement($codeDistrictColl);
            // set the owning side to null (unless already changed)
            if ($codeDistrictColl->getCodeDistrict() === $this) {
                $codeDistrictColl->setCodeDistrict(null);
            }
        }

        return $this;
    }
}
