<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 * @ORM\Table(name="service")
 * @ORM\Entity
 */
class Service
{
	/**
	 * @var string
	 * @ORM\Column(name="service_code", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $serviceCode;

	/**
	 * @var string|null
	 * @ORM\Column(name="service_libelle", type="string", length=100, nullable=true)
	 */
	private $serviceLibelle;

	/**
	 * @var \Crb
	 * @ORM\ManyToOne(targetEntity="Crb")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="service_code_crb", referencedColumnName="crb_code")
	 * })
	 */
	private $serviceCodeCrb;

	/**
	 * @var \FondType
	 * @ORM\ManyToOne(targetEntity="FondType",inversedBy="serviceTypeFondColl")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="service_type_fond", referencedColumnName="font_type_code")
	 * })
	 */
	private $serviceTypeFond;


	public function setServiceCode($serviceCode)
                     	{
                     		$this->serviceCode = $serviceCode; return $this;
                     	}

    public function getServiceCode(): ?string
    {
        return $this->serviceCode;
    }

    public function getServiceLibelle(): ?string
    {
        return $this->serviceLibelle;
    }

    public function setServiceLibelle(?string $serviceLibelle): self
    {
        $this->serviceLibelle = $serviceLibelle;

        return $this;
    }

    public function getServiceCodeCrb(): ?Crb
    {
        return $this->serviceCodeCrb;
    }

    public function setServiceCodeCrb(?Crb $serviceCodeCrb): self
    {
        $this->serviceCodeCrb = $serviceCodeCrb;

        return $this;
    }

    public function getServiceTypeFond(): ?FondType
    {
        return $this->serviceTypeFond;
    }

    public function setServiceTypeFond(?FondType $serviceTypeFond): self
    {
        $this->serviceTypeFond = $serviceTypeFond;

        return $this;
    }
}
