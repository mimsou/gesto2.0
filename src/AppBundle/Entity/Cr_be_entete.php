<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/** 
 * Cr_be_entete
 * @ORM\Table(name="Cr_be_entete")
 * @ORM\Entity
 */
class Cr_be_entete
{
	/**
	 * @var datetime|null
	 * @ORM\Column(name="date_be", type="datetime", length=100, nullable=true)
	 */
	private $date_be;

	/**
	 * @var string
	 * @ORM\Column(name="nbe", type="integer", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $nbe;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Cr_bureau_defaillant", mappedBy="nbe" , cascade={"persist"})
	 */
	private $nbeColl;

	/**
	 * @var \Cr_distrinct
	 * @ORM\ManyToOne(targetEntity="Cr_distrinct",inversedBy="codeDistrictColl")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="code_district", referencedColumnName="codedistrict")
	 * })
	 */
	private $codeDistrict;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;

    public function __construct()
    {
        $this->nbeColl = new ArrayCollection();
    }


	public function setNbe($nbe)
                                    	{
                                    		$this->nbe = $nbe; return $this;
                                    	}

    public function getDateBe(): ?\DateTimeInterface
    {
        return $this->date_be;
    }

    public function setDateBe(?\DateTimeInterface $date_be): self
    {
        $this->date_be = $date_be;

        return $this;
    }

    public function getNbe(): ?int
    {
        return $this->nbe;
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
    public function getNbeColl(): Collection
    {
        return $this->nbeColl;
    }

    public function addNbeColl(Cr_bureau_defaillant $nbeColl): self
    {
        if (!$this->nbeColl->contains($nbeColl)) {
            $this->nbeColl[] = $nbeColl;
            $nbeColl->setNbe($this);
        }

        return $this;
    }

    public function removeNbeColl(Cr_bureau_defaillant $nbeColl): self
    {
        if ($this->nbeColl->contains($nbeColl)) {
            $this->nbeColl->removeElement($nbeColl);
            // set the owning side to null (unless already changed)
            if ($nbeColl->getNbe() === $this) {
                $nbeColl->setNbe(null);
            }
        }

        return $this;
    }

    public function getCodeDistrict(): ?Cr_distrinct
    {
        return $this->codeDistrict;
    }

    public function setCodeDistrict(?Cr_distrinct $codeDistrict): self
    {
        $this->codeDistrict = $codeDistrict;

        return $this;
    }
}
